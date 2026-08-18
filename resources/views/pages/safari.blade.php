@extends('layouts.app')

@section('title', 'Safari Extensions | SIXTY04 PLACES')
@section('description', "Add a big five safari to your Cape Town trip. Full day, overnight, and multi-day safari experiences arranged seamlessly.")

@section('nav-cta')
    <a href="{{ route('booking') }}" class="btn btn-primary">Book Now</a>
@endsection

@section('content')

<header class="hero" style="min-height: 60vh;">
<div class="hero-bg" style="background-image: url('{{ asset('images/tours/safari.jpg') }}'); background-position: center; background-size: cover; background-color: var(--brown-900);"></div>
<div class="hero-content">
<div class="hero-meta-row" style="justify-content:center;">
<span class="coord-tag animate-on-scroll"><i class="fas fa-paw"></i> Big 5 reserves, 2&ndash;4 hrs from Cape Town</span>
</div>
<h1 class="animate-on-scroll">Safari Extensions</h1>
<p class="animate-on-scroll animate-delay-1">Let the adventure of the wilderness guide you to memories that will stay with you forever.</p>
</div>
</header>

<section class="section section-cream">
<div class="container">
<div class="grid-2-1">
<div class="animate-on-scroll">
<span class="section-label">Beyond the City</span>
<h2 style="margin-bottom: 24px;">Experience the Wild</h2>
<p style="color: var(--gray-600); font-size: 1.05rem; line-height: 1.8; margin-bottom: 16px;">When it comes to adding a Safari to your Cape Town tour, we coordinate seamlessly with premium game reserves. Whether it's a full day excursion or an overnight Safari, part of a romantic getaway or a family holiday, we have something to suit you.</p>
<p style="color: var(--gray-600); font-size: 1.05rem; line-height: 1.8; margin-bottom: 32px;">We handle the private road transfers, custom routing, and logistics so you can simply embrace the unknown, take the bumpy ride, and let the beauty of the wilderness awaken your soul.</p>

<ul class="checklist mb-32" style="color: var(--gray-700);">
<li><i class="fas fa-check-circle"></i> Full-Day Private Transfers to Aquila & Inverdoorn</li>
<li><i class="fas fa-check-circle"></i> Multi-Day Garden Route Safari Planning</li>
<li><i class="fas fa-check-circle"></i> Executive Comfort & Safety</li>
</ul>

<a href="{{ route('booking', ['service' => 'safari-extension']) }}" class="btn btn-primary">Enquire About Safari Transport</a>
</div>
<div class="animate-on-scroll animate-delay-1" style="background: var(--brown-100); border-radius: var(--radius-lg); padding: 40px;">
<span class="panel-eyebrow" style="color: var(--brown-700);">Waypoints</span>
<h3 style="margin-bottom: 20px; color: var(--brown-900);">Popular Game Reserves</h3>
<div style="display: flex; flex-direction: column; gap: 16px;">
<div style="background: var(--white); padding: 16px 24px; border-radius: var(--radius-sm); box-shadow: var(--shadow-sm); display: flex; align-items: baseline; gap: 14px;">
<span class="coord-tag on-light" style="flex-shrink:0;">01</span>
<div><h4 style="margin-bottom: 4px; color: var(--green-700);">Aquila Private Game Reserve</h4>
<p style="font-size: 0.85rem; color: var(--gray-500);">Closest Big 5 Reserve to Cape Town</p></div>
</div>
<div style="background: var(--white); padding: 16px 24px; border-radius: var(--radius-sm); box-shadow: var(--shadow-sm); display: flex; align-items: baseline; gap: 14px;">
<span class="coord-tag on-light" style="flex-shrink:0;">02</span>
<div><h4 style="margin-bottom: 4px; color: var(--green-700);">Gondwana Game Reserve</h4>
<p style="font-size: 0.85rem; color: var(--gray-500);">Premium Garden Route Safari</p></div>
</div>
<div style="background: var(--white); padding: 16px 24px; border-radius: var(--radius-sm); box-shadow: var(--shadow-sm); display: flex; align-items: baseline; gap: 14px;">
<span class="coord-tag on-light" style="flex-shrink:0;">03</span>
<div><h4 style="margin-bottom: 4px; color: var(--green-700);">Sanbona Wildlife Reserve</h4>
<p style="font-size: 0.85rem; color: var(--gray-500);">Expansive Klein Karoo Wilderness</p></div>
</div>
</div>
</div>
</div>
</div>
</section>

@endsection
