@extends('layouts.app')

@section('title', 'Contact Us | SIXTY04 PLACES')
@section('description', "Get in touch with SIXTY04 PLACES to book your Cape Town private tours, chauffeur rides, and custom travel itineraries.")

@section('nav-cta')
    <a href="{{ route('booking') }}" class="btn btn-primary">Book Now</a>
@endsection

@section('content')

<header class="hero" style="min-height: 50vh;">
<div class="hero-bg" style="background-image: url('{{ asset('images/hero/index-hero.jpg') }}');"></div>
<div class="hero-content" style="padding-top: 80px;">
<div class="hero-meta-row" style="justify-content:center;">
<span class="coord-tag animate-on-scroll"><i class="fas fa-clock"></i> Replies within 2 hours, business hours</span>
</div>
<h1 class="animate-on-scroll">Contact Us</h1>
<p class="animate-on-scroll animate-delay-1">Get in touch to plan your perfect Cape Town experience.</p>
</div>
</header>

<section class="section section-cream">
<div class="container">
<div class="grid-2-1" style="gap: 40px; align-items: start;">
<div class="animate-on-scroll">
<div style="background: var(--white); padding: 40px; border-radius: var(--radius-lg); box-shadow: var(--shadow-sm); margin-bottom: 24px;">
<i class="fab fa-whatsapp" style="font-size: 2rem; color: #25D366; margin-bottom: 16px;"></i>
<h3 style="margin-bottom: 8px;">WhatsApp Us</h3>
<p style="color: var(--gray-500); margin-bottom: 16px; font-size: 0.95rem;">The fastest way to get a response for bookings and quotes.</p>
<a href="https://wa.me/27683282839" class="btn btn-whatsapp" target="_blank" rel="noopener noreferrer">Chat Now</a>
</div>

<div style="background: var(--white); padding: 40px; border-radius: var(--radius-lg); box-shadow: var(--shadow-sm);">
<div style="margin-bottom: 24px;">
<h4 style="margin-bottom: 8px; font-size: 1.1rem;"><i class="fas fa-phone text-green" style="margin-right: 8px;"></i> Call Us</h4>
<p style="color: var(--gray-600);">+27 68 328 2839</p>
</div>
<div style="margin-bottom: 24px;">
<h4 style="margin-bottom: 8px; font-size: 1.1rem;"><i class="fas fa-envelope text-green" style="margin-right: 8px;"></i> Email Us</h4>
<p style="color: var(--gray-600);">mandundutaicy1@gmail.com</p>
</div>
<div>
<h4 style="margin-bottom: 8px; font-size: 1.1rem;"><i class="fas fa-map-marker-alt text-green" style="margin-right: 8px;"></i> Location</h4>
<p style="color: var(--gray-600);">Cape Town, South Africa<br><span style="font-size: 0.85rem;">(Available for travel nationwide)</span></p>
</div>
</div>
</div>

<div class="animate-on-scroll animate-delay-1" style="background: var(--white); padding: 40px; border-radius: var(--radius-lg); box-shadow: var(--shadow-md);">
<h3 style="margin-bottom: 16px;">Send a Detailed Enquiry</h3>
<p style="color: var(--gray-500); margin-bottom: 24px;">The more details you provide, the better we can tailor your experience.</p>

<livewire:contact-form />
</div>
</div>
</div>
</section>

@endsection
