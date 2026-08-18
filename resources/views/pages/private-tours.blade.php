@extends('layouts.app')

@section('title', 'Private Tours & Custom Itineraries | SIXTY04 PLACES')
@section('description', "Design your dream Cape Town holiday with a fully custom, private itinerary. Tailor-made experiences managed by local experts.")

@section('nav-cta')
    <a href="{{ route('booking') }}" class="btn btn-primary">Book Now</a>
@endsection

@section('content')

<section class="section section-dark" style="padding-top: 150px; padding-bottom: 60px;">
<div class="container text-center animate-on-scroll">
<div class="hero-meta-row" style="justify-content:center;">
<span class="section-label-light">Tailor-Made Travel</span>
</div>
<h1 style="margin-bottom: 16px;">Fully Custom Itineraries</h1>
<p style="color: rgba(255,255,255,0.8); max-width: 600px; margin: 0 auto;">No two travelers are the same. Let us design a day or multi-day trip perfectly aligned with your pace, interests, and style.</p>
</div>
</section>

<section class="section section-cream">
<div class="container text-center">
<span class="section-label" style="justify-content:center;">The Process</span>
<h3 style="margin-bottom: 40px;">How It Works</h3>
<div class="process-track">
<div class="process-step animate-on-scroll animate-delay-1">
<div class="process-step-index">WP.01</div>
<h4>Consultation</h4>
<p>Tell us what you love&mdash;be it fine wine, wildlife, hiking, or history. We listen to your preferences and travel style.</p>
</div>
<div class="process-step animate-on-scroll animate-delay-2">
<div class="process-step-index">WP.02</div>
<h4>Design</h4>
<p>Our local experts craft a bespoke itinerary, selecting the best restaurants, hidden gems, and premium transport.</p>
</div>
<div class="process-step animate-on-scroll animate-delay-3">
<div class="process-step-index">WP.03</div>
<h4>Experience</h4>
<p>Your private driver-guide picks you up in a luxury vehicle. Sit back, relax, and enjoy an unforgettable day.</p>
</div>
</div>

<div style="margin-top: 48px;">
<a href="{{ route('contact') }}" class="btn btn-primary btn-lg">Start Planning Your Trip</a>
</div>
</div>
</section>

@endsection
