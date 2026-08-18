@extends('layouts.app')

@section('title', 'Book Your Experience | SIXTY04 PLACES')
@section('description', "Book your private Cape Town tour, airport transfer, or chauffeur service securely online with SIXTY04 PLACES.")

@section('nav-cta')
    <a href="https://wa.me/27683282839" class="btn btn-whatsapp"><i class="fab fa-whatsapp"></i> Chat Now</a>
@endsection

@section('content')

<section class="section section-cream" style="padding-top: 120px; padding-bottom: 60px;">
<div class="container" style="max-width: 800px;">

<div class="text-center mb-48">
<div class="hero-meta-row" style="justify-content:center;">
<span class="coord-tag on-light"><i class="fas fa-route"></i> 3 steps to confirmation</span>
</div>
<h1 style="margin-bottom: 16px;">Request Your Booking</h1>
<p style="color: var(--gray-600);">Tell us what you need in 3 simple steps — we'll confirm availability and payment details by email.</p>
</div>

<livewire:booking-wizard
    :service="request()->query('service', '')"
    :tour="request()->query('tour', '')"
    :type="request()->query('type', '')"
    :vehicle="request()->query('vehicle', '')"
/>

</div>
</section>

@endsection

@push('scripts')
<script src="https://js.stripe.com/v3/"></script>
<script>
    document.addEventListener('livewire:init', () => {
        Livewire.on('stripe-intent-ready', ({ clientSecret, publishableKey }) => {
            if (typeof Stripe === 'undefined') {
                return;
            }

            if (!window.__stripe) {
                window.__stripe = Stripe(publishableKey);
            }

            const elements = window.__stripe.elements();
            window.__stripeCardElement = elements.create('card', {
                style: {
                    base: {
                        fontSize: '16px',
                        color: '#1a1a1a',
                        fontFamily: 'inherit',
                        '::placeholder': { color: '#94a3b8' },
                    },
                },
            });

            const mountPoint = document.getElementById('stripe-card-element');
            if (mountPoint) {
                window.__stripeCardElement.mount('#stripe-card-element');
            }

            window.__stripeClientSecret = clientSecret;
        });
    });

    window.handleStripeSubmit = async function (wire, event) {
        event.preventDefault();

        const errorBox = document.getElementById('stripe-card-errors');
        if (errorBox) errorBox.textContent = '';

        let ok = false;
        try {
            ok = await wire.preparePayment();
        } catch (e) {
            return;
        }
        if (!ok) return;

        if (!window.__stripe || !window.__stripeCardElement || !window.__stripeClientSecret) {
            if (errorBox) errorBox.textContent = 'Payment form is still loading. Please wait a moment and try again.';
            return;
        }

        const button = event.currentTarget;
        button.disabled = true;

        const { error } = await window.__stripe.confirmCardPayment(window.__stripeClientSecret, {
            payment_method: {
                card: window.__stripeCardElement,
                billing_details: {
                    name: `${wire.first_name} ${wire.last_name}`.trim(),
                    email: wire.email,
                },
            },
        });

        if (error) {
            if (errorBox) errorBox.textContent = error.message;
            button.disabled = false;
            return;
        }

        await wire.submit();
    };
</script>
@endpush
