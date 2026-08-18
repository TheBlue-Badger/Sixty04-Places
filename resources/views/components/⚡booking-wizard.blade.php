<?php

use App\Models\Booking;
use App\Models\Tour;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Stripe\PaymentIntent;
use Stripe\Stripe;

new class extends Component
{
    public int $step = 1;

    // Step 1: trip details
    public string $service = '';
    public string $trip_date = '';
    public string $pickup_time = '';
    public int $passengers = 2;

    // Step 2: guest info
    public string $first_name = '';
    public string $last_name = '';
    public string $email = '';
    public string $phone = '';
    public string $pickup_location = '';

    // Step 3: payment
    public string $payment_method = 'card';
    public bool $terms_accepted = false;

    public bool $confirmed = false;
    public ?int $bookingId = null;
    public ?string $requestedVehicleSlug = null;

    // Stripe payment state
    public ?string $paymentIntentId = null;
    public ?string $clientSecret = null;

    protected array $transferOptions = [
        'trans_airport' => ['label' => 'Premium Airport Transfer', 'from' => null],
        'trans_event' => ['label' => 'Event & Wedding Transport', 'from' => null],
        'trans_hourly' => ['label' => 'Hourly Chauffeur Driver', 'from' => null],
    ];

    public function mount(string $service = '', string $tour = '', string $type = '', string $vehicle = ''): void
    {
        // Pre-select a service when arriving from a "Book" link elsewhere on the site.
        $hint = $service ?: $tour ?: ($type ? "trans_{$type}" : '');

        if ($hint && array_key_exists($hint, $this->services)) {
            $this->service = $hint;
        }

        $this->requestedVehicleSlug = $vehicle ?: null;
    }

    public function getRequestedVehicleProperty(): ?\App\Models\Vehicle
    {
        return $this->requestedVehicleSlug
            ? \App\Models\Vehicle::where('slug', $this->requestedVehicleSlug)->first()
            : null;
    }

    public function getServicesProperty(): array
    {
        $tours = Tour::orderBy('sort_order')->get()
            ->mapWithKeys(fn (Tour $tour) => [
                $tour->slug => ['label' => $tour->title, 'from' => $tour->price_zar],
            ])
            ->all();

        return $tours + $this->transferOptions;
    }

    public function getSelectedServiceProperty(): ?array
    {
        return $this->services[$this->service] ?? null;
    }

    public function getTotalAmountCentsProperty(): ?int
    {
        $service = $this->selectedService;

        if (! $service || $service['from'] === null) {
            return null;
        }

        return (int) $service['from'] * 100 * max(1, $this->passengers);
    }

    protected function stepRules(int $step): array
    {
        return match ($step) {
            1 => [
                'service' => ['required', 'in:' . implode(',', array_keys($this->services))],
                'trip_date' => ['required', 'date', 'after_or_equal:today'],
                'pickup_time' => ['required'],
                'passengers' => ['required', 'integer', 'min:1', 'max:14'],
            ],
            2 => [
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email', 'max:255'],
                'phone' => ['required', 'string', 'max:30'],
                'pickup_location' => ['required', 'string', 'max:255'],
            ],
            3 => [
                'payment_method' => ['required', 'in:card,paypal'],
                'terms_accepted' => ['accepted'],
            ],
            default => [],
        };
    }

    public function nextStep(): void
    {
        $this->validate($this->stepRules($this->step));

        if ($this->step < 3) {
            $this->step++;

            if ($this->step === 3) {
                $this->ensurePaymentIntent();
            }
        }
    }

    protected function ensurePaymentIntent(): void
    {
        $amount = $this->totalAmountCents;

        if ($amount === null) {
            $this->paymentIntentId = null;
            $this->clientSecret = null;

            return;
        }

        Stripe::setApiKey(config('services.stripe.secret'));

        $metadata = [
            'service' => $this->service,
            'trip_date' => $this->trip_date,
            'pickup_time' => $this->pickup_time,
            'passengers' => (string) $this->passengers,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'pickup_location' => $this->pickup_location,
        ];

        try {
            $intent = $this->paymentIntentId
                ? PaymentIntent::update($this->paymentIntentId, [
                    'amount' => $amount,
                    'currency' => 'zar',
                    'metadata' => $metadata,
                ])
                : PaymentIntent::create([
                    'amount' => $amount,
                    'currency' => 'zar',
                    'payment_method_types' => ['card'],
                    'metadata' => $metadata,
                ]);
        } catch (\Throwable $e) {
            Log::error('Stripe PaymentIntent error: ' . $e->getMessage());
            $this->addError('payment', 'Unable to set up payment right now. Please try again shortly.');

            return;
        }

        $this->paymentIntentId = $intent->id;
        $this->clientSecret = $intent->client_secret;

        $this->dispatch('stripe-intent-ready', clientSecret: $this->clientSecret, publishableKey: config('services.stripe.key'));
    }

    public function preparePayment(): bool
    {
        $this->validate($this->stepRules(3));

        return true;
    }

    public function prevStep(): void
    {
        if ($this->step > 1) {
            $this->step--;
        }
    }

    public function selectPaymentMethod(string $method): void
    {
        $this->payment_method = $method;
    }

    public function submit(): void
    {
        $this->validate($this->stepRules(3));

        $amount = $this->totalAmountCents;
        $status = 'pending';
        $paidAt = null;

        if ($amount !== null) {
            if (! $this->paymentIntentId) {
                $this->addError('payment', 'Please complete payment before submitting.');

                return;
            }

            Stripe::setApiKey(config('services.stripe.secret'));

            try {
                $intent = PaymentIntent::retrieve($this->paymentIntentId);
            } catch (\Throwable $e) {
                Log::error('Stripe PaymentIntent retrieve error: ' . $e->getMessage());
                $this->addError('payment', 'We could not verify your payment. Please try again.');

                return;
            }

            if ($intent->status !== 'succeeded') {
                $this->addError('payment', 'Payment was not completed. Please try again.');

                return;
            }

            $status = 'paid';
            $paidAt = now();
        }

        $booking = Booking::create([
            'service' => $this->service,
            'trip_date' => $this->trip_date,
            'pickup_time' => $this->pickup_time,
            'passengers' => $this->passengers,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'pickup_location' => $this->pickup_location,
            'payment_method' => $this->payment_method,
            'status' => $status,
            'amount_cents' => $amount,
            'currency' => $amount !== null ? 'zar' : null,
            'stripe_payment_intent_id' => $this->paymentIntentId,
            'paid_at' => $paidAt,
        ]);

        $this->bookingId = $booking->id;
        $this->confirmed = true;
    }
};
?>

<div id="multi-step-form" style="background: var(--white); padding: 40px; border-radius: var(--radius-lg); box-shadow: var(--shadow-lg); position: relative; overflow: hidden;">

    <div wire:loading.class="active" wire:target="submit" class="processing-overlay">
        <div class="spinner"></div>
        <h3 style="color: var(--green-700);">Processing Your Booking</h3>
        <p style="color: var(--gray-500);">Please do not close this window…</p>
    </div>

    @if ($confirmed)
        <div class="text-center" style="padding: 40px 20px;">
            <i class="fas fa-check-circle" style="font-size: 4rem; color: var(--green-500); margin-bottom: 24px;"></i>
            <h2 style="margin-bottom: 16px;">Booking Confirmed!</h2>
            <p style="color: var(--gray-600); margin-bottom: 8px;">Reference #{{ str_pad($bookingId, 6, '0', STR_PAD_LEFT) }}</p>
            <p style="color: var(--gray-600); margin-bottom: 24px;">Thank you. Your enquiry has been received — we'll confirm your itinerary and payment details by email shortly.</p>
            <a href="{{ route('home') }}" class="btn btn-primary">Return to Home</a>
        </div>
    @else
        <div class="stepper">
            <div class="step-indicator {{ $step === 1 ? 'active' : ($step > 1 ? 'completed' : '') }}">
                <div class="step-number">1</div>
                <span>Trip Details</span>
            </div>
            <div class="step-indicator {{ $step === 2 ? 'active' : ($step > 2 ? 'completed' : '') }}">
                <div class="step-number">2</div>
                <span>Guest Info</span>
            </div>
            <div class="step-indicator {{ $step === 3 ? 'active' : '' }}">
                <div class="step-number">3</div>
                <span>Payment</span>
            </div>
        </div>

        <form wire:submit="submit">
            @if ($step === 1)
                <div class="booking-step active">
                    <span class="panel-eyebrow">Step 01 / 03</span>
                    <h3 style="margin-bottom: 24px; color: var(--green-800);">Select Your Service</h3>
                    @if ($this->requestedVehicle)
                        <div class="secure-badge" style="margin-bottom: 24px;">
                            <i class="fas fa-car"></i> Requesting the {{ $this->requestedVehicle->name }} — mention this to your consultant when we confirm your booking.
                        </div>
                    @endif
                    <div class="form-group">
                        <label class="form-label" for="booking-service">Service Category</label>
                        <select class="form-select" id="booking-service" wire:model="service">
                            <option value="" disabled>Choose an option</option>
                            @foreach ($this->services as $value => $option)
                                <option value="{{ $value }}">{{ $option['label'] }}{{ $option['from'] ? ' (From R' . number_format($option['from']) . ')' : '' }}</option>
                            @endforeach
                        </select>
                        @error('service') <small class="text-red">{{ $message }}</small> @enderror
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label" for="booking-trip-date">Date</label>
                            <input type="date" id="booking-trip-date" class="form-input" wire:model="trip_date" autocomplete="off">
                            @error('trip_date') <small class="text-red">{{ $message }}</small> @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="booking-pickup-time">Pickup Time</label>
                            <input type="time" id="booking-pickup-time" class="form-input" wire:model="pickup_time" autocomplete="off">
                            @error('pickup_time') <small class="text-red">{{ $message }}</small> @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="booking-passengers">Number of Passengers</label>
                        <input type="number" id="booking-passengers" min="1" max="14" class="form-input" wire:model="passengers" inputmode="numeric" autocomplete="off">
                        @error('passengers') <small class="text-red">{{ $message }}</small> @enderror
                    </div>

                    <div style="display: flex; justify-content: flex-end; margin-top: 32px;">
                        <button type="button" class="btn btn-primary btn-next" wire:click="nextStep">Next Step <i class="fas fa-arrow-right" style="margin-left:8px;"></i></button>
                    </div>
                </div>
            @endif

            @if ($step === 2)
                <div class="booking-step active">
                    <span class="panel-eyebrow">Step 02 / 03</span>
                    <h3 style="margin-bottom: 24px; color: var(--green-800);">Your Information</h3>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label" for="booking-first-name">First Name</label>
                            <input type="text" id="booking-first-name" class="form-input" wire:model="first_name" placeholder="John" autocomplete="given-name">
                            @error('first_name') <small class="text-red">{{ $message }}</small> @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="booking-last-name">Last Name</label>
                            <input type="text" id="booking-last-name" class="form-input" wire:model="last_name" placeholder="Doe" autocomplete="family-name">
                            @error('last_name') <small class="text-red">{{ $message }}</small> @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="booking-email">Email Address</label>
                        <input type="email" id="booking-email" class="form-input" wire:model="email" placeholder="john@example.com" autocomplete="email">
                        @error('email') <small class="text-red">{{ $message }}</small> @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="booking-phone">Phone / WhatsApp</label>
                        <input type="tel" id="booking-phone" class="form-input" wire:model="phone" placeholder="+1 234 567 8900" autocomplete="tel">
                        @error('phone') <small class="text-red">{{ $message }}</small> @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="booking-pickup-location">Pickup Location (Hotel / Address)</label>
                        <input type="text" id="booking-pickup-location" class="form-input" wire:model="pickup_location" placeholder="E.g. The Silo Hotel, V&A Waterfront" autocomplete="off">
                        @error('pickup_location') <small class="text-red">{{ $message }}</small> @enderror
                    </div>

                    <div style="display: flex; justify-content: space-between; margin-top: 32px;">
                        <button type="button" class="btn btn-outline-dark btn-prev" wire:click="prevStep"><i class="fas fa-arrow-left" style="margin-right:8px;"></i> Back</button>
                        <button type="button" class="btn btn-primary btn-next" wire:click="nextStep">Proceed to Payment <i class="fas fa-credit-card" style="margin-left:8px;"></i></button>
                    </div>
                </div>
            @endif

            @if ($step === 3)
                <div class="booking-step active">
                    <span class="panel-eyebrow">Step 03 / 03</span>
                    <h3 style="margin-bottom: 24px; color: var(--green-800);">Secure Payment</h3>

                    <div class="secure-badge">
                        <i class="fas fa-lock"></i> 256-bit SSL Encrypted
                        @if ($this->totalAmountCents)
                            &nbsp;|&nbsp; <i class="fas fa-shield-alt"></i> Payments secured by Stripe
                        @else
                            &nbsp;|&nbsp; <i class="fas fa-shield-alt"></i> No payment is taken for this request
                        @endif
                    </div>

                    <div class="payment-tabs">
                        <button type="button" class="pay-tab {{ $payment_method === 'card' ? 'active' : '' }}" onclick="switchPayTab('card')" wire:click="selectPaymentMethod('card')">
                            <i class="fas fa-credit-card"></i> Pay by Card
                        </button>
                        @unless ($this->totalAmountCents)
                            <button type="button" class="pay-tab {{ $payment_method === 'paypal' ? 'active' : '' }}" id="tab-paypal" onclick="switchPayTab('paypal')" wire:click="selectPaymentMethod('paypal')">
                                <i class="fab fa-paypal"></i> PayPal
                            </button>
                        @endunless
                    </div>

                    <div class="accepted-cards" id="accepted-cards" style="{{ $payment_method === 'paypal' ? 'display:none;' : '' }}">
                        <span class="card-network" id="icon-visa" title="Visa"><i class="fab fa-cc-visa"></i></span>
                        <span class="card-network" id="icon-mastercard" title="Mastercard"><i class="fab fa-cc-mastercard"></i></span>
                        <span class="card-network" id="icon-amex" title="American Express"><i class="fab fa-cc-amex"></i></span>
                        <span class="card-network" id="icon-discover" title="Discover"><i class="fab fa-cc-discover"></i></span>
                        <span class="card-network" id="icon-diners" title="Diners Club"><i class="fab fa-cc-diners-club"></i></span>
                        <span class="card-network" id="icon-jcb" title="JCB"><i class="fab fa-cc-jcb"></i></span>
                    </div>

                    <div id="panel-card" class="pay-panel {{ $payment_method === 'card' ? 'active' : '' }}" style="{{ $payment_method === 'card' ? '' : 'display:none;' }}">
                        @if ($this->totalAmountCents)
                            {{-- Real Stripe Elements card field. Card data is entered directly into Stripe's
                                 hosted iframe and never touches our server or Livewire state. --}}
                            <div class="payment-mock" wire:ignore>
                                <div class="form-group">
                                    <label class="form-label">Card Details</label>
                                    <div id="stripe-card-element" class="form-input" style="padding: 14px; height: auto;"></div>
                                    <small class="text-red" id="stripe-card-errors" style="display:block; margin-top:8px;"></small>
                                </div>
                            </div>
                        @else
                            {{-- No price is captured for this service, so no card details are collected here.
                                 This is a request-only booking; payment/quote is handled manually afterward. --}}
                            <div class="payment-mock">
                                <p style="color: var(--gray-500); font-size: 0.9rem;">
                                    <i class="fas fa-info-circle"></i> No price is listed for this service yet. Submit your request and our team will follow up with a quote and payment link.
                                </p>
                            </div>
                        @endif
                    </div>

                    @unless ($this->totalAmountCents)
                        <div id="panel-paypal" class="pay-panel {{ $payment_method === 'paypal' ? 'active' : '' }}" style="{{ $payment_method === 'paypal' ? '' : 'display:none;' }}">
                            <div class="paypal-panel">
                                <div class="paypal-logo-wrap">
                                    <i class="fab fa-paypal" style="font-size:3.5rem;color:#003087;"></i>
                                    <span style="font-size:2rem;font-weight:700;color:#003087;">Pay</span><span style="font-size:2rem;font-weight:700;color:#009cde;">Pal</span>
                                </div>
                                <p style="color:var(--gray-500);font-size:0.95rem;margin-bottom:24px;text-align:center;">
                                    You'll be redirected to PayPal to complete your payment securely. No PayPal account needed — pay with any card via PayPal Guest Checkout.
                                </p>
                                <div class="paypal-features">
                                    <span><i class="fas fa-check-circle" style="color:#009cde;"></i> Buyer Protection</span>
                                    <span><i class="fas fa-check-circle" style="color:#009cde;"></i> No account required</span>
                                    <span><i class="fas fa-check-circle" style="color:#009cde;"></i> 190+ countries</span>
                                </div>
                            </div>
                        </div>
                    @endunless

                    <div class="order-summary-box">
                        <div class="summary-row"><span>Selected Service</span><span style="font-weight:600;">{{ $this->selectedService['label'] ?? '—' }}</span></div>
                        <div class="summary-row"><span>Date</span><span>{{ $trip_date ? \Illuminate\Support\Carbon::parse($trip_date)->format('d M Y') : '—' }}</span></div>
                        <div class="summary-row summary-total">
                            <span>Total</span>
                            <span style="color:var(--green-700);">
                                @if ($this->totalAmountCents)
                                    R{{ number_format($this->totalAmountCents / 100, 2) }}
                                @else
                                    TBC on confirmation
                                @endif
                            </span>
                        </div>
                    </div>

                    <div class="form-group" style="margin-bottom: 24px;">
                        <label style="display: flex; align-items: flex-start; gap: 12px; font-size: 0.85rem; color: var(--gray-600); cursor: pointer;">
                            <input type="checkbox" wire:model="terms_accepted" style="margin-top: 4px; width:16px; height:16px; flex-shrink:0;">
                            <span>I authorise SIXTY04 PLACES to process this booking request. I have read and agree to the <a href="{{ route('terms') }}" target="_blank" rel="noopener noreferrer" style="color: var(--green-600);">Terms &amp; Conditions</a> and <a href="{{ route('cancellation-policy') }}" target="_blank" rel="noopener noreferrer" style="color: var(--green-600);">Cancellation Policy</a>.</span>
                        </label>
                        @error('terms_accepted') <small class="text-red">{{ $message }}</small> @enderror
                    </div>

                    <div style="display: flex; justify-content: space-between; align-items: center; gap: 16px; flex-wrap: wrap;">
                        <button type="button" class="btn btn-outline-dark btn-prev" wire:click="prevStep"><i class="fas fa-arrow-left" style="margin-right:8px;"></i> Back</button>

                        @if ($this->totalAmountCents && $payment_method === 'card')
                            <button type="button" class="btn btn-pay-now" x-on:click="handleStripeSubmit($wire, $event)">
                                <i class="fas fa-lock"></i> <span>Pay R{{ number_format($this->totalAmountCents / 100, 2) }} &amp; Confirm</span>
                            </button>
                        @else
                            <button type="submit" class="btn btn-pay-now" wire:loading.attr="disabled" wire:target="submit">
                                <i class="fas fa-lock"></i> <span>Confirm Booking Request</span>
                            </button>
                        @endif
                    </div>

                    <p style="text-align:center;margin-top:20px;font-size:0.8rem;color:var(--gray-400);">
                        @if ($this->totalAmountCents)
                            <i class="fas fa-shield-alt"></i> Card details are entered directly into Stripe's secure form and never stored on our servers.
                        @else
                            <i class="fas fa-shield-alt"></i> No payment is taken yet. Card details are never stored on our servers.
                        @endif
                    </p>
                </div>
            @endif
        </form>
    @endif
</div>
