@extends('layouts.app')

@section('title', 'Cape Town Tours | SIXTY04 PLACES')
@section('description', "Explore Cape Town with our private, curated day tours. From the Cape Peninsula to the Winelands, experience the Mother City your way.")

@section('nav-cta')
    <div class="currency-toggle">
        <button class="active" data-currency="ZAR">ZAR</button>
        <button data-currency="USD">USD</button>
        <button data-currency="EUR">EUR</button>
    </div>
    <a href="{{ route('booking') }}" class="btn btn-primary">Book Now</a>
@endsection

@section('content')

<header class="hero" style="min-height: 60vh;">
<div class="hero-bg" style="background-image: url('{{ asset('images/hero/index-hero.jpg') }}');"></div>
<div class="hero-content">
<div class="hero-meta-row" style="justify-content:center;">
<span class="coord-tag animate-on-scroll"><i class="fas fa-route"></i> {{ $tours->count() }} curated routes</span>
</div>
<h1 class="animate-on-scroll">Cape Town Tours</h1>
<p class="animate-on-scroll animate-delay-1">Discover the beauty, culture, and flavors of the Cape with our premium private day tours.</p>
</div>
</header>

<section class="section" style="padding-bottom: 20px;">
<div class="container text-center animate-on-scroll">
<span class="section-label">Why Choose Us</span>
<h2 style="margin-bottom: 24px;">We Specialize in Private, Guided Cape Town Tours</h2>
<div style="max-width: 800px; margin: 0 auto; color: var(--gray-600); font-size: 1.05rem; line-height: 1.8;">
<p style="margin-bottom: 16px;">SIXTY04 PLACES is a premium Cape Town Tours Operator specialising in Private Personalised Cape Town Tours. The best way to experience Cape Town is to have your itinerary focused on your interests, and our job is to assist you in making this happen. We work with you to curate luxurious, bespoke experiences of South Africa's 'Mother City' and the surrounding regions.</p>
<p style="margin-bottom: 16px;">Our Cape Town Tours combine intimate local knowledge and world-class refinement. From the iconic landmarks that have made this one of the world's most beloved destinations to the best-kept secrets that few ever get to enjoy, we show off Cape Town in all its splendour and variety.</p>
<p>At SIXTY04 PLACES, we put people first. We are committed to offering service and creating experiences that cater to each client's individual needs, so that your visit to Cape Town is unique and unforgettable.</p>
</div>
</div>
</section>

<section class="section section-cream">
<div class="container">
<div class="grid-3">
@foreach ($tours as $tour)
<div class="card animate-on-scroll animate-delay-{{ ($loop->index % 3) + 1 }}">
<div class="card-img">
<img src="{{ asset($tour->image) }}" alt="{{ $tour->title }}" loading="lazy">
</div>
<div class="card-body">
<h3>{{ $tour->title }}</h3>
<div class="card-meta">
<span><i class="far fa-clock"></i> {{ $tour->duration }}</span>
<span><i class="far fa-user"></i> Private</span>
</div>
<p>{{ $tour->description }}</p>
<div class="flex-between mt-24">
<div class="card-price">From <span data-price-zar="{{ $tour->price_zar }}">R{{ number_format($tour->price_zar) }}</span></div>
<a href="{{ route('booking', ['service' => $tour->slug]) }}" class="btn btn-outline-dark btn-sm">Book Tour</a>
</div>
</div>
</div>
@endforeach

<div class="card animate-on-scroll">
<div class="card-img">
<img src="{{ asset('images/tours/safari.jpg') }}" alt="Custom Tour" width="1024" height="1024" loading="lazy">
</div>
<div class="card-body">
<h3>Fully Custom Itinerary</h3>
<div class="card-meta">
<span><i class="far fa-clock"></i> Flexible</span>
<span><i class="far fa-user"></i> Private</span>
</div>
<p>Mix and match your favorite experiences. Our travel concierges will design a day or multi-day trip perfectly aligned with your pace and interests.</p>
<div class="flex-between mt-24">
<div class="card-price"><span>Custom Quote</span></div>
<a href="{{ route('private-tours') }}" class="btn btn-outline-dark btn-sm">Plan Now</a>
</div>
</div>
</div>
</div>
</div>
</section>

@endsection
