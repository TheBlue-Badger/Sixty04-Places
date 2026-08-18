<?php

use App\Models\Enquiry;
use Livewire\Component;

new class extends Component
{
    public string $first_name = '';
    public string $last_name = '';
    public string $email = '';
    public string $phone = '';
    public string $interest = '';
    public string $travel_date = '';
    public string $group_size = '';
    public string $vehicle_preference = 'any';
    public string $pickup_location = '';
    public string $message = '';

    public bool $submitted = false;

    protected function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:30'],
            'interest' => ['required', 'string'],
            'travel_date' => ['nullable', 'date'],
            'group_size' => ['nullable', 'integer', 'min:1', 'max:20'],
            'vehicle_preference' => ['nullable', 'string'],
            'pickup_location' => ['nullable', 'string', 'max:255'],
            'message' => ['required', 'string'],
        ];
    }

    public function submit(): void
    {
        $data = $this->validate();

        $data['travel_date'] = $data['travel_date'] ?: null;
        $data['group_size'] = $data['group_size'] ?: null;
        $data['pickup_location'] = $data['pickup_location'] ?: null;

        Enquiry::create($data);

        $this->reset([
            'first_name', 'last_name', 'email', 'phone', 'interest',
            'travel_date', 'group_size', 'vehicle_preference', 'pickup_location', 'message',
        ]);
        $this->vehicle_preference = 'any';

        $this->submitted = true;
    }
};
?>

<div>
    @if ($submitted)
        <div class="notification notification-success" style="position: static; margin-bottom: 24px; animation: none;" role="status" aria-live="polite">
            <i class="fas fa-check-circle" aria-hidden="true"></i> Message sent successfully! We'll be in touch shortly.
        </div>
    @endif

    <form wire:submit="submit">
        <h5 class="form-section-title">Your Details</h5>
        <div class="form-row">
            <div class="form-group">
                <label class="form-label" for="contact-first-name">First Name</label>
                <input type="text" id="contact-first-name" class="form-input" wire:model="first_name" placeholder="John" autocomplete="given-name">
                @error('first_name') <small class="text-red">{{ $message }}</small> @enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="contact-last-name">Last Name</label>
                <input type="text" id="contact-last-name" class="form-input" wire:model="last_name" placeholder="Doe" autocomplete="family-name">
                @error('last_name') <small class="text-red">{{ $message }}</small> @enderror
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label class="form-label" for="contact-email">Email Address</label>
                <input type="email" id="contact-email" class="form-input" wire:model="email" placeholder="john@example.com" autocomplete="email">
                @error('email') <small class="text-red">{{ $message }}</small> @enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="contact-phone">Phone / WhatsApp</label>
                <input type="tel" id="contact-phone" class="form-input" wire:model="phone" placeholder="+1 234 567 8900" autocomplete="tel">
                @error('phone') <small class="text-red">{{ $message }}</small> @enderror
            </div>
        </div>

        <h5 class="form-section-title">Trip Details</h5>
        <div class="form-group">
            <label class="form-label" for="contact-interest">Primary Interest</label>
            <select class="form-select" id="contact-interest" wire:model="interest">
                <option value="" disabled>Select an option</option>
                <option value="tour_day">Private Day Tour</option>
                <option value="tour_multi">Multi-Day Travel Itinerary</option>
                <option value="safari">Safari Extension</option>
                <option value="chauffeur">Chauffeur / VIP Transport</option>
                <option value="airport">Airport Transfer</option>
                <option value="other">Other / Custom Request</option>
            </select>
            @error('interest') <small class="text-red">{{ $message }}</small> @enderror
        </div>

        <div class="form-row">
            <div class="form-group">
                <label class="form-label" for="contact-travel-date">Travel Date (Approx)</label>
                <input type="date" id="contact-travel-date" class="form-input" wire:model="travel_date" autocomplete="off">
            </div>
            <div class="form-group">
                <label class="form-label" for="contact-group-size">Group Size</label>
                <input type="number" id="contact-group-size" min="1" max="20" class="form-input" wire:model="group_size" placeholder="E.g. 2" inputmode="numeric" autocomplete="off">
            </div>
        </div>

        <div class="form-group">
            <label class="form-label" for="contact-vehicle-preference">Vehicle Preference (Optional)</label>
            <select class="form-select" id="contact-vehicle-preference" wire:model="vehicle_preference">
                <option value="any">No Preference / Recommend for me</option>
                <option value="sedan">Executive Sedan (1-3 Pax)</option>
                <option value="suv">Premium SUV (1-6 Pax)</option>
                <option value="van">Group Van (7-14 Pax)</option>
            </select>
        </div>

        <div class="form-group">
            <label class="form-label" for="contact-pickup-location">Accommodation / Pickup Location</label>
            <input type="text" id="contact-pickup-location" class="form-input" wire:model="pickup_location" placeholder="E.g. One&Only Cape Town" autocomplete="off">
        </div>

        <div class="form-group">
            <label class="form-label" for="contact-message">Message / Special Requests</label>
            <textarea class="form-textarea" id="contact-message" wire:model="message" placeholder="Tell us about your interests, dietary requirements, or specific places you want to see…"></textarea>
            @error('message') <small class="text-red">{{ $message }}</small> @enderror
        </div>

        <button type="submit" class="btn btn-primary w-full" style="justify-content: center;" wire:loading.attr="disabled">
            <span wire:loading.remove wire:target="submit">Submit Enquiry</span>
            <span wire:loading wire:target="submit">Sending…</span>
        </button>
    </form>
</div>
