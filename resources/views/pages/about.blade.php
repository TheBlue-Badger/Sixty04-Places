@extends('layouts.app')

@section('title', 'About Us | SIXTY04 PLACES')
@section('description', "Learn about SIXTY04 PLACES, Cape Town's premier private travel, tour, and chauffeur company.")

@section('nav-cta')
    <a href="{{ route('booking') }}" class="btn btn-primary">Book Now</a>
@endsection

@section('content')

<header class="hero" style="min-height: 60vh;">
<div class="hero-bg" style="background-image: url('{{ asset('images/tours/cape-point.jpg') }}'); background-position: center; background-size: cover; background-color: var(--brown-900);"></div>
<div class="hero-content">
<div class="hero-meta-row" style="justify-content:center;">
<span class="section-label-light animate-on-scroll">Our Story</span>
</div>
<h1 class="animate-on-scroll">About SIXTY04 PLACES</h1>
</div>
</header>

<section class="section section-cream" style="padding-top: 60px; padding-bottom: 60px;">
<div class="container">
<div class="text-center mb-48 animate-on-scroll">
<p style="max-width: 800px; margin: 0 auto; color: var(--gray-600); font-size: 1.1rem; line-height: 1.8;">
SIXTY04 PLACES was founded with a singular vision: to elevate the standard of private travel in Cape Town and South Africa. We believe that luxury is not just about high-end vehicles. It's about time, personalization, and peace of mind.
</p>
</div>

<div class="grid-2" style="margin-top: 48px;">
<div class="panel animate-on-scroll">
<span class="panel-eyebrow">01 &mdash; Mission</span>
<h2 style="margin-bottom: 16px; font-size: 1.75rem;">Our Mission</h2>
<p style="color: var(--gray-600); line-height: 1.8;">To curate seamless, luxurious, and deeply personal travel experiences. From the moment you step off the plane to the moment you depart, we handle the logistics so you can immerse yourself in the beauty of South Africa.</p>
</div>
<div class="panel animate-on-scroll animate-delay-1">
<span class="panel-eyebrow">02 &mdash; Origin</span>
<h2 style="margin-bottom: 16px; font-size: 1.75rem;">Why &ldquo;SIXTY04&rdquo;?</h2>
<p style="color: var(--gray-600); line-height: 1.8;">The name SIXTY04 represents a commitment to punctuality, precision, and place. We ensure that every coordinate on your itinerary is reached safely, comfortably, and exactly on schedule.</p>
<div class="coord-tag on-light mt-24"><i class="fas fa-location-arrow"></i> S 33.9249&deg; / E 18.4241&deg; &mdash; where it all starts</div>
</div>
</div>
</div>
</section>

<!-- TRUST BAR -->
<section class="section-sm section-dark">
<div class="container">
<div class="trust-bar animate-on-scroll">
<div class="trust-item"><div class="trust-stat" data-count="8" data-suffix="+">0</div><p>Years Experience</p></div>
<div class="trust-item"><div class="trust-stat" data-count="2500" data-suffix="+">0</div><p>Tours Completed</p></div>
<div class="trust-item"><div class="trust-stat" data-count="4200" data-suffix="+">0</div><p>Happy Guests</p></div>
<div class="trust-item"><div class="trust-stat" data-count="500" data-suffix="+">0</div><p>5-Star Reviews</p></div>
</div>
</div>
</section>

<!-- WHAT SETS US APART -->
<section class="section">
<div class="container">
<div class="text-center mb-48 animate-on-scroll">
<span class="section-label">What Sets Us Apart</span>
<h2>Why Travellers Choose SIXTY04</h2>
<p class="subtitle">A small, hands-on team means every detail gets our full attention.</p>
</div>
<div class="grid-4">
<div class="feature-tile feature-tile--center animate-on-scroll animate-delay-1">
<div class="feature-tile-icon"><i class="fas fa-heart"></i></div>
<h4>Hands-On Team</h4>
<p>Every itinerary is planned and checked by a real person who knows Cape Town, not a booking algorithm.</p>
</div>
<div class="feature-tile feature-tile--center animate-on-scroll animate-delay-2">
<div class="feature-tile-icon"><i class="fas fa-shield-alt"></i></div>
<h4>Safety First</h4>
<p>Vetted, licensed drivers and well-maintained vehicles on every route, no exceptions.</p>
</div>
<div class="feature-tile feature-tile--center animate-on-scroll animate-delay-3">
<div class="feature-tile-icon"><i class="fas fa-sliders-h"></i></div>
<h4>Flexible by Design</h4>
<p>Change the pace, swap a stop, or extend the day. Your itinerary bends around you.</p>
</div>
<div class="feature-tile feature-tile--center animate-on-scroll animate-delay-4">
<div class="feature-tile-icon"><i class="fas fa-comments"></i></div>
<h4>Always Reachable</h4>
<p>A direct WhatsApp line to your consultant before, during, and after your trip.</p>
</div>
</div>
</div>
</section>

<!-- CTA -->
<section class="cta-band">
<div class="container animate-on-scroll">
<h2>Ready to Start Planning?</h2>
<p>Tell us what you have in mind and we'll put together an itinerary built around you.</p>
<div class="btn-group" style="justify-content:center;">
<a href="{{ route('booking') }}" class="btn btn-primary btn-lg">Request a Booking</a>
<a href="{{ route('contact') }}" class="btn btn-outline btn-lg">Get in Touch</a>
</div>
</div>
</section>

@endsection
