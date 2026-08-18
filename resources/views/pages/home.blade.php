@extends('layouts.app')

@section('title', 'SIXTY04 PLACES — Premium Cape Town Tours & Private Transport')
@section('description', "Premium private tours, chauffeur services & safari extensions in Cape Town and South Africa. Book your bespoke travel experience with SIXTY04 PLACES.")

@section('navbar-class', '')

@section('nav-cta')
    <a href="{{ route('booking') }}" class="btn btn-primary btn-sm">Book Now</a>
@endsection

@section('content')

<!-- HERO -->
<section class="hero" id="hero">
<div class="hero-bg" style="background-image:url('{{ asset('images/hero/index-hero.jpg') }}')"></div>
<div class="hero-content">
<div class="hero-meta-row" style="justify-content:center;">
<div class="hero-badge">Premium Cape Town Experiences</div>
<span class="coord-tag"><i class="fas fa-location-arrow"></i> S 33.9249&deg; / E 18.4241&deg;</span>
</div>
<h1>Discover South Africa in Luxury</h1>
<p>Private tours, chauffeur services & bespoke travel experiences across Cape Town, the Winelands, Garden Route & beyond.</p>
<div class="btn-group" style="justify-content:center;">
<a href="{{ route('tours') }}" class="btn btn-primary btn-lg">Explore Tours</a>
<a href="{{ route('booking') }}" class="btn btn-outline btn-lg">Request a Ride</a>
</div>
</div>
<div class="hero-scroll"><span>Scroll to discover</span><span class="route-line"></span></div>
</section>

<!-- TRUST BAR -->
<section class="section-sm section-dark" id="trust">
<div class="container">
<div class="trust-bar animate-on-scroll">
<div class="trust-item"><div class="trust-stat" data-count="8" data-suffix="+">0</div><p>Years Experience</p></div>
<div class="trust-item"><div class="trust-stat" data-count="2500" data-suffix="+">0</div><p>Tours Completed</p></div>
<div class="trust-item"><div class="trust-stat" data-count="4200" data-suffix="+">0</div><p>Happy Guests</p></div>
<div class="trust-item"><div class="trust-stat" data-count="500" data-suffix="+">0</div><p>5-Star Reviews</p></div>
</div>
</div>
</section>

<!-- FEATURED TOURS -->
<section class="section section-cream" id="tours">
<div class="container">
<div class="text-center mb-48 animate-on-scroll">
<span class="section-label">Our Experiences</span>
<h2>Featured Tour Categories</h2>
<p class="subtitle">From coastal drives to wine country handcrafted private tours tailored to you.</p>
</div>
<div class="grid-3">
@foreach ($featuredTours as $tour)
<div class="card animate-on-scroll animate-delay-{{ ($loop->index % 3) + 1 }}">
<div class="card-img">
<img src="{{ asset($tour->image) }}" alt="{{ $tour->title }}" loading="lazy">
@if ($tour->badge)
<span class="card-badge">{{ $tour->badge }}</span>
@endif
</div>
<div class="card-body">
<h3>{{ $tour->title }}</h3>
<div class="card-meta"><span><i class="fas fa-clock"></i> {{ $tour->duration }}</span><span><i class="fas fa-users"></i> 1-6 guests</span></div>
<p>{{ $tour->description }}</p>
<div class="flex-between">
<span class="card-price" data-price-zar="{{ $tour->price_zar }}">R{{ number_format($tour->price_zar) }} <span>/ person</span></span>
<a href="{{ $tour->category === 'safari' ? route('safari') : route('tours') }}" class="btn btn-primary btn-sm">View Details</a>
</div>
</div>
</div>
@endforeach
</div>
<div class="text-center mt-48 animate-on-scroll">
<a href="{{ route('tours') }}" class="btn btn-outline-dark">View All Tours <i class="fas fa-arrow-right"></i></a>
</div>
</div>
</section>

<!-- WHY CHOOSE SIXTY04 -->
<section class="section" id="why-us">
<div class="container">
<div class="text-center mb-48 animate-on-scroll">
<span class="section-label">Why SIXTY04 Places</span>
<h2>Your Journey, Our Passion</h2>
<p class="subtitle">We don't do generic. Every trip is private, personal and crafted with local insight.</p>
</div>
<div class="grid-4">
<div class="feature-tile feature-tile--center animate-on-scroll animate-delay-1">
<div class="feature-tile-icon"><i class="fas fa-user-shield"></i></div>
<h4>Private & Tailored</h4>
<p>No crowds, no rushing. Just you, your group, and a personalised itinerary.</p>
</div>
<div class="feature-tile feature-tile--center animate-on-scroll animate-delay-2">
<div class="feature-tile-icon"><i class="fas fa-map-marked-alt"></i></div>
<h4>Local Expertise</h4>
<p>Born & raised in Cape Town. We know the hidden gems others miss.</p>
</div>
<div class="feature-tile feature-tile--center animate-on-scroll animate-delay-3">
<div class="feature-tile-icon"><i class="fas fa-car"></i></div>
<h4>Premium Fleet</h4>
<p>Travel in style with our Mercedes fleet comfort, safety & elegance.</p>
</div>
<div class="feature-tile feature-tile--center animate-on-scroll animate-delay-4">
<div class="feature-tile-icon"><i class="fas fa-globe-africa"></i></div>
<h4>International Ready</h4>
<p>Airport pickups, multi-currency pricing & worldwide booking support.</p>
</div>
</div>
</div>
</section>

<!-- POPULAR ROUTES -->
<section class="section section-cream" id="routes">
<div class="container">
<div class="text-center mb-48 animate-on-scroll">
<span class="section-label">Route Inspiration</span>
<h2>Popular Routes</h2>
<p class="subtitle">Explore South Africa's most breathtaking journeys from coast to country.</p>
</div>
<div class="grid-3">
<div class="card animate-on-scroll animate-delay-1" style="position:relative;">
<div class="card-img" style="height:200px;"><img src="{{ asset('images/tours/winelands.jpg') }}" alt="Cape Town to Winelands" width="1024" height="1024" loading="lazy"></div>
<div class="card-body">
<h4 style="font-size:1.1rem;">Cape Town &rarr; Stellenbosch Winelands</h4>
<div class="card-meta"><span><i class="fas fa-road"></i> 50 km</span><span><i class="fas fa-clock"></i> Full Day</span></div>
<p style="font-size:0.85rem;">Wine estates, gourmet lunch & mountain views.</p>
</div>
</div>
<div class="card animate-on-scroll animate-delay-2" style="position:relative;">
<div class="card-img" style="height:200px;"><img src="{{ asset('images/tours/whale-coast.webp') }}" alt="Cape Town to Hermanus" width="474" height="315" loading="lazy"></div>
<div class="card-body">
<h4 style="font-size:1.1rem;">Cape Town &rarr; Hermanus Coast</h4>
<div class="card-meta"><span><i class="fas fa-road"></i> 120 km</span><span><i class="fas fa-clock"></i> Full Day</span></div>
<p style="font-size:0.85rem;">Whale watching, coastal cliffs & seaside dining.</p>
</div>
</div>
<div class="card animate-on-scroll animate-delay-3" style="position:relative;">
<div class="card-img" style="height:200px;"><img src="{{ asset('images/tours/coastline.jpg') }}" alt="Garden Route" width="1000" height="800" loading="lazy"></div>
<div class="card-body">
<h4 style="font-size:1.1rem;">Cape Town &rarr; Garden Route</h4>
<div class="card-meta"><span><i class="fas fa-road"></i> 300+ km</span><span><i class="fas fa-clock"></i> Multi-Day</span></div>
<p style="font-size:0.85rem;">Forests, lagoons, Tsitsikamma & adventure.</p>
</div>
</div>
</div>
</div>
</section>

<!-- CHAUFFEUR HIGHLIGHT -->
<section class="section section-dark" id="chauffeur-highlight">
<div class="container">
<div class="grid-2-1 animate-on-scroll">
<div>
<span class="section-label-light">Premium Transport</span>
<h2>Chauffeur & Ride Services</h2>
<p style="color:rgba(255,255,255,0.8);margin-bottom:24px;">Beyond tours we offer premium chauffeur services for airport transfers, hotel pickups, events & hourly hire across Cape Town and beyond.</p>
<ul class="checklist checklist--on-dark mb-32">
<li><i class="fas fa-check-circle"></i> Airport & hotel transfers</li>
<li><i class="fas fa-check-circle"></i> Event & wedding transport</li>
<li><i class="fas fa-check-circle"></i> Hourly & full-day hire</li>
<li><i class="fas fa-check-circle"></i> Long-distance journeys</li>
</ul>
<div class="btn-group">
<a href="{{ route('chauffeur') }}" class="btn btn-primary">Learn More</a>
<a href="{{ route('booking') }}" class="btn btn-outline">Book a Ride</a>
</div>
</div>
<div style="border-radius:var(--radius-lg);overflow:hidden;box-shadow:var(--shadow-xl);">
<img src="{{ asset('images/tours/chauffeur.jpg') }}" alt="SIXTY04 Chauffeur Service" width="1000" height="800" loading="lazy" style="width:100%;height:400px;object-fit:cover;">
</div>
</div>
</div>
</section>

<!-- CUSTOM ITINERARY CTA -->
<section class="cta-band">
<div class="container animate-on-scroll">
<h2>Design Your Own Journey</h2>
<p>Can't find exactly what you're looking for? Let us craft a bespoke itinerary tailored to your interests, pace & budget.</p>
<div class="btn-group" style="justify-content:center;">
<a href="{{ route('private-tours') }}" class="btn btn-primary btn-lg">Create Custom Tour</a>
<a href="https://wa.me/27683282839?text=Hi%20SIXTY04!%20I'd%20like%20to%20plan%20a%20custom%20tour." class="btn btn-whatsapp btn-lg" target="_blank" rel="noopener noreferrer"><i class="fab fa-whatsapp"></i> Chat on WhatsApp</a>
</div>
</div>
</section>

<!-- FLEET PREVIEW -->
<section class="section" id="fleet-preview">
<div class="container">
<div class="text-center mb-48 animate-on-scroll">
<span class="section-label">Our Vehicles</span>
<h2>Travel in Style</h2>
<p class="subtitle">Our premium fleet ensures every journey is as comfortable as the destination is beautiful.</p>
</div>
<div class="grid-3">
@foreach ($featuredVehicles as $vehicle)
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

<!-- TESTIMONIALS -->
<section class="section section-cream" id="testimonials">
<div class="container">
<div class="text-center mb-48 animate-on-scroll">
<span class="section-label">Guest Reviews</span>
<h2>What Travellers Say</h2>
<p class="subtitle">Real stories from guests who explored South Africa with SIXTY04 PLACES.</p>
</div>
<div style="overflow:hidden;">
<div class="grid-3 testimonial-track" style="transition:transform 0.5s ease;">
<div class="testimonial-card animate-on-scroll animate-delay-1">
<div class="testimonial-stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
<p class="testimonial-text">An incredible day on the Cape Peninsula. Our guide knew every secret viewpoint and hidden beach. The Mercedes was spotless and comfortable. Truly a premium experience!</p>
<div class="testimonial-author">
<div class="testimonial-avatar">SJ</div>
<div><div class="testimonial-name">Sarah Johnson</div><div class="testimonial-origin">London, United Kingdom</div></div>
</div>
</div>
<div class="testimonial-card animate-on-scroll animate-delay-2">
<div class="testimonial-stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
<p class="testimonial-text">We booked the Winelands tour and it exceeded every expectation. From Stellenbosch to Franschhoek, the wine, food and scenery were perfect. Can't recommend SIXTY04 enough!</p>
<div class="testimonial-author">
<div class="testimonial-avatar">MK</div>
<div><div class="testimonial-name">Michael Klein</div><div class="testimonial-origin">Munich, Germany</div></div>
</div>
</div>
<div class="testimonial-card animate-on-scroll animate-delay-3">
<div class="testimonial-stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
<p class="testimonial-text">Used SIXTY04 for airport transfers and a city tour. Punctual, professional and so friendly. They made our first visit to Cape Town absolutely seamless and memorable.</p>
<div class="testimonial-author">
<div class="testimonial-avatar">AT</div>
<div><div class="testimonial-name">Aiko Tanaka</div><div class="testimonial-origin">Tokyo, Japan</div></div>
</div>
</div>
</div>
</div>
<div style="display:flex;justify-content:center;gap:8px;margin-top:32px;">
<button class="testimonial-dot active" style="width:10px;height:10px;border-radius:50%;background:var(--green-700);border:none;cursor:pointer;"></button>
<button class="testimonial-dot" style="width:10px;height:10px;border-radius:50%;background:var(--gray-300);border:none;cursor:pointer;"></button>
<button class="testimonial-dot" style="width:10px;height:10px;border-radius:50%;background:var(--gray-300);border:none;cursor:pointer;"></button>
</div>
</div>
</section>

<!-- FAQ PREVIEW -->
<section class="section" id="faq-preview">
<div class="container" style="max-width:800px;">
<div class="text-center mb-48 animate-on-scroll">
<span class="section-label">Common Questions</span>
<h2>Frequently Asked</h2>
</div>
<div class="accordion animate-on-scroll">
<div class="accordion-item">
<div class="accordion-header"><span>How do I book a tour or ride?</span><i class="fas fa-chevron-down"></i></div>
<div class="accordion-content"><p>You can book directly through our website using the Book Now button, send us a WhatsApp message, or email us. We'll confirm your booking within 2 hours during business hours.</p></div>
</div>
<div class="accordion-item">
<div class="accordion-header"><span>Are your tours private or shared?</span><i class="fas fa-chevron-down"></i></div>
<div class="accordion-content"><p>All SIXTY04 PLACES tours are 100% private. It's just you, your group, and your driver-guide. No strangers, no waiting your pace, your schedule.</p></div>
</div>
<div class="accordion-item">
<div class="accordion-header"><span>What vehicles do you use?</span><i class="fas fa-chevron-down"></i></div>
<div class="accordion-content"><p>We operate a premium fleet including Mercedes C-Class sedans, a Mercedes AMG, and a Honda BR-V crossover SUV. All vehicles are fully air-conditioned, insured, and immaculately maintained.</p></div>
</div>
<div class="accordion-item">
<div class="accordion-header"><span>Do you offer airport transfers?</span><i class="fas fa-chevron-down"></i></div>
<div class="accordion-content"><p>Yes! We provide meet-and-greet airport transfers to and from Cape Town International Airport. Your driver will be waiting with a name board at arrivals.</p></div>
</div>
<div class="accordion-item">
<div class="accordion-header"><span>Can I create a custom itinerary?</span><i class="fas fa-chevron-down"></i></div>
<div class="accordion-content"><p>Absolutely. We specialise in bespoke journeys. Tell us your interests, budget, and travel dates, and we'll design a personalised itinerary just for you.</p></div>
</div>
</div>
</div>
</section>

<!-- FINAL CTA -->
<section class="section section-dark" id="final-cta">
<div class="container text-center animate-on-scroll">
<h2 style="margin-bottom:16px;">Ready to Explore South Africa?</h2>
<p style="color:rgba(255,255,255,0.8);max-width:600px;margin:0 auto 32px;font-size:1.1rem;">Whether it's a scenic tour, airport transfer or a multi-day adventure let SIXTY04 PLACES make it unforgettable.</p>
<div class="btn-group" style="justify-content:center;">
<a href="{{ route('booking') }}" class="btn btn-primary btn-lg">Book Your Experience</a>
<a href="https://wa.me/27683282839?text=Hi%20SIXTY04!%20I'd%20like%20to%20enquire%20about%20your%20services." class="btn btn-whatsapp btn-lg" target="_blank" rel="noopener noreferrer"><i class="fab fa-whatsapp"></i> WhatsApp Us</a>
</div>
</div>
</section>

@endsection
