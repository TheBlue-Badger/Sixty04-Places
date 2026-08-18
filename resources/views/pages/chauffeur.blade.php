@extends('layouts.app')

@section('title', 'Chauffeur & Transport Services | SIXTY04 PLACES')
@section('description', "Premium chauffeur services, airport transfers, and private rides across Cape Town. Executive Mercedes fleet available for corporate and leisure travel.")

@section('nav-cta')
    <a href="{{ route('booking') }}" class="btn btn-primary">Book Now</a>
@endsection

@section('content')

<header class="hero" style="min-height: 60vh;">
<div class="hero-bg" style="background-image: url('{{ asset('images/tours/chauffeur.jpg') }}'); background-position: center; background-size: cover; background-color: var(--brown-900);"></div>
<div class="hero-content">
<div class="hero-meta-row" style="justify-content:center;">
<span class="section-label-light animate-on-scroll">Executive Travel</span>
</div>
<h1 class="animate-on-scroll">Premium Chauffeur Services</h1>
<p class="animate-on-scroll animate-delay-1" style="max-width: 600px; margin: 0 auto; margin-top: 16px;">Reliable, elegant, and discreet private transportation across Cape Town and the surrounding regions.</p>
</div>
</header>

<section class="section section-cream">
<div class="container">
<div class="text-center mb-48 animate-on-scroll">
<span class="section-label">What We Offer</span>
<h2>Three Ways to Ride</h2>
<p class="subtitle">Pick the service that fits your trip, or ask us to combine them.</p>
</div>
<div class="grid-3">
<div class="card animate-on-scroll" style="padding: 32px;">
<div class="feature-tile feature-tile--center">
<div class="feature-tile-icon"><i class="fas fa-plane-arrival"></i></div>
<h3 style="margin-bottom: 0;">Airport Transfers</h3>
<p style="margin-bottom: 8px;">Seamless meet-and-greet service at Cape Town International Airport. We track your flight and assist with luggage.</p>
<a href="{{ route('booking', ['type' => 'airport']) }}" class="btn btn-outline-dark btn-sm">Request Transfer</a>
</div>
</div>
<div class="card animate-on-scroll animate-delay-1" style="padding: 32px;">
<div class="feature-tile feature-tile--center">
<div class="feature-tile-icon"><i class="fas fa-glass-cheers"></i></div>
<h3 style="margin-bottom: 0;">Event Transport</h3>
<p style="margin-bottom: 8px;">Arrive in style at weddings, corporate galas, and fine-dining restaurants. Enjoy your evening with a dedicated driver on standby.</p>
<a href="{{ route('booking', ['type' => 'event']) }}" class="btn btn-outline-dark btn-sm">Book Driver</a>
</div>
</div>
<div class="card animate-on-scroll animate-delay-2" style="padding: 32px;">
<div class="feature-tile feature-tile--center">
<div class="feature-tile-icon"><i class="fas fa-clock"></i></div>
<h3 style="margin-bottom: 0;">Hourly Hire</h3>
<p style="margin-bottom: 8px;">Ultimate flexibility. Hire a luxury vehicle and professional chauffeur by the hour or for a full day of meetings and errands.</p>
<a href="{{ route('booking', ['type' => 'hourly']) }}" class="btn btn-outline-dark btn-sm">Enquire Hourly Rates</a>
</div>
</div>
</div>
</div>
</section>

<!-- WHY RIDE WITH US -->
<section class="section">
<div class="container">
<div class="text-center mb-48 animate-on-scroll">
<span class="section-label">Why Ride With Us</span>
<h2>Every Detail, Handled</h2>
</div>
<div class="grid-4">
<div class="feature-tile feature-tile--center animate-on-scroll animate-delay-1">
<div class="feature-tile-icon"><i class="fas fa-id-badge"></i></div>
<h4>Vetted Drivers</h4>
<p>Every chauffeur is licensed, background-checked, and trained in guest service.</p>
</div>
<div class="feature-tile feature-tile--center animate-on-scroll animate-delay-2">
<div class="feature-tile-icon"><i class="fas fa-car-side"></i></div>
<h4>Well-Maintained Fleet</h4>
<p>Late-model Mercedes vehicles, cleaned and inspected before every trip.</p>
</div>
<div class="feature-tile feature-tile--center animate-on-scroll animate-delay-3">
<div class="feature-tile-icon"><i class="fas fa-satellite-dish"></i></div>
<h4>Flight Tracking</h4>
<p>We monitor your arrival time and adjust pickup automatically for delays.</p>
</div>
<div class="feature-tile feature-tile--center animate-on-scroll animate-delay-4">
<div class="feature-tile-icon"><i class="fas fa-user-secret"></i></div>
<h4>Discreet Service</h4>
<p>Quiet, professional, and attentive, whether it's a business trip or a night out.</p>
</div>
</div>
</div>
</section>

@if ($vehicles->isNotEmpty())
<!-- FLEET PREVIEW -->
<section class="section section-cream">
<div class="container">
<div class="text-center mb-48 animate-on-scroll">
<span class="section-label">Our Vehicles</span>
<h2>The Fleet You'll Ride In</h2>
</div>
<div class="grid-3">
@foreach ($vehicles as $vehicle)
<div class="fleet-card animate-on-scroll animate-delay-{{ $loop->iteration }}">
<div class="fleet-card-img"><img src="{{ asset($vehicle->image) }}" alt="{{ $vehicle->name }}" loading="lazy"></div>
<div class="fleet-card-body">
<span class="fleet-card-class">{{ $vehicle->class }}</span>
<h3>{{ $vehicle->name }}</h3>
<div class="fleet-specs">
@foreach ($vehicle->features as $feature)
<div class="fleet-spec"><i class="fas {{ $feature['icon'] }}"></i> {{ $feature['label'] }}</div>
@endforeach
</div>
<a href="{{ route('fleet') }}" class="btn btn-outline-dark btn-sm w-full" style="justify-content:center;">View Details</a>
</div>
</div>
@endforeach
</div>
<div class="text-center mt-48 animate-on-scroll"><a href="{{ route('fleet') }}" class="btn btn-outline-dark">View Full Fleet <i class="fas fa-arrow-right"></i></a></div>
</div>
</section>
@endif

<!-- CTA -->
<section class="cta-band">
<div class="container animate-on-scroll">
<h2>Ready to Book Your Ride?</h2>
<p>Tell us your pickup details and we'll take care of the rest.</p>
<div class="btn-group" style="justify-content:center;">
<a href="{{ route('booking') }}" class="btn btn-primary btn-lg">Book Now</a>
<a href="https://wa.me/27683282839?text=Hi%20SIXTY04!%20I'd%20like%20to%20enquire%20about%20chauffeur%20services." class="btn btn-whatsapp btn-lg" target="_blank" rel="noopener noreferrer"><i class="fab fa-whatsapp"></i> Chat on WhatsApp</a>
</div>
</div>
</section>

@endsection
