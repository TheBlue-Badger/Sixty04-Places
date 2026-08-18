@extends('layouts.app')

@section('title', 'Our Premium Fleet | SIXTY04 PLACES')
@section('description', "Travel in comfort and luxury with our premium fleet of vehicles suitable for private tours, chauffeur services, and airport transfers in Cape Town.")

@section('nav-cta')
    <a href="{{ route('booking') }}" class="btn btn-primary">Book Now</a>
@endsection

@section('content')

<header class="hero" style="min-height: 50vh; background-color: var(--green-900);">
<div class="hero-content" style="padding-top: 80px;">
<div class="hero-meta-row" style="justify-content:center;">
<span class="coord-tag animate-on-scroll"><i class="fas fa-car-side"></i> {{ $vehicles->count() }} vehicles in the fleet</span>
</div>
<h1 class="animate-on-scroll">Our Premium Fleet</h1>
<p class="animate-on-scroll animate-delay-1">Comfort, safety, and elegance for your journey across the Mother City and beyond.</p>
</div>
</header>

<section class="section section-cream">
<div class="container">
<div class="text-center mb-48 animate-on-scroll">
<span class="section-label">Travel in Style</span>
<h2 style="margin-bottom: 24px;">Vehicles for Every Occasion</h2>
<p style="max-width: 800px; margin: 0 auto; color: var(--gray-600); font-size: 1.05rem; line-height: 1.8;">Our vehicles range from executive sedans to premium SUVs. We have a chauffeur solution for small and large groups, whether for corporate or leisure travel.</p>
</div>

<div class="grid-2">
@foreach ($vehicles as $vehicle)
<div class="fleet-card animate-on-scroll animate-delay-{{ ($loop->index % 2) + 1 }}">
<div class="fleet-card-img {{ $vehicle->image ? '' : 'placeholder' }}">
@if ($vehicle->image)
<img src="{{ asset($vehicle->image) }}" alt="{{ $vehicle->name }}" loading="lazy">
@endif
</div>
<div class="fleet-card-body">
<div class="fleet-card-class">{{ $vehicle->class }}</div>
<h3>{{ $vehicle->name }}</h3>
<div class="fleet-specs">
@foreach ($vehicle->features as $feature)
<div class="fleet-spec"><i class="fas {{ $feature['icon'] }}"></i> {{ $feature['label'] }}</div>
@endforeach
</div>
<p style="color: var(--gray-500); font-size: 0.95rem; margin-bottom: 24px;">{{ $vehicle->description }}</p>
<a href="{{ route('booking', ['vehicle' => $vehicle->slug]) }}" class="btn {{ $vehicle->featured ? 'btn-primary' : 'btn-outline-dark' }} w-full" style="justify-content: center;">{{ $vehicle->cta_label }}</a>
</div>
</div>
@endforeach
</div>
</div>
</section>

@endsection
