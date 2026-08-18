@extends('layouts.app')

@section('title', 'Terms & Conditions | SIXTY04 PLACES')
@section('description', "Terms and conditions for booking private tours, chauffeur services, and safari extensions with SIXTY04 PLACES.")

@section('nav-cta')
    <a href="{{ route('booking') }}" class="btn btn-primary">Book Now</a>
@endsection

@section('content')

<section class="section section-cream" style="padding-top: 120px; padding-bottom: 60px;">
<div class="container" style="max-width: 800px;">

<div class="text-center mb-48">
<span class="section-label">Legal</span>
<h1 style="margin-bottom: 16px;">Terms &amp; Conditions</h1>
<p style="color: var(--gray-600);">Last updated {{ now()->format('d F Y') }}</p>
</div>

<div style="color: var(--gray-600); line-height: 1.8;">

<h3 style="margin-bottom: 12px; color: var(--green-800);">1. Booking &amp; Confirmation</h3>
<p style="margin-bottom: 24px;">A booking request submitted through our website, WhatsApp, or email is not confirmed until you receive written confirmation from SIXTY04 PLACES. We reserve the right to decline or reschedule a booking where availability, safety, or logistical constraints require it, in which case we will offer an alternative date or a full refund of any amount paid.</p>

<h3 style="margin-bottom: 12px; color: var(--green-800);">2. Pricing &amp; Payment</h3>
<p style="margin-bottom: 24px;">Prices are quoted in South African Rand (ZAR) unless otherwise stated, with USD/EUR estimates shown for convenience only; the amount charged is always the ZAR value at prevailing rates. For services with a listed price, payment is collected securely via Stripe at the time of booking. For custom, transfer, or hourly-hire requests with no listed price, no payment is taken online — we will follow up with a quote and payment link before your trip is confirmed.</p>

<h3 style="margin-bottom: 12px; color: var(--green-800);">3. Your Responsibilities</h3>
<p style="margin-bottom: 24px;">Please arrive at the agreed pickup point on time and provide accurate contact and pickup details when booking. SIXTY04 PLACES is not responsible for delays caused by incorrect information supplied at booking. Guests are expected to treat vehicles, drivers, guides, and fellow travellers with respect; we reserve the right to end a tour early, without refund, in cases of dangerous or abusive behaviour.</p>

<h3 style="margin-bottom: 12px; color: var(--green-800);">4. Liability</h3>
<p style="margin-bottom: 24px;">SIXTY04 PLACES takes reasonable care in selecting vehicles, drivers, and third-party partners (game reserves, activity operators, restaurants), but is not liable for injury, loss, or damage arising from circumstances outside our reasonable control, including third-party negligence, road conditions, or acts of nature. Personal travel insurance is strongly recommended for all guests.</p>

<h3 style="margin-bottom: 12px; color: var(--green-800);">5. Force Majeure</h3>
<p style="margin-bottom: 24px;">Where a tour or transfer cannot proceed due to events beyond our reasonable control (severe weather, civil unrest, government restrictions, medical emergencies), we will work with you to reschedule or provide a refund in line with our <a href="{{ route('cancellation-policy') }}" style="color: var(--green-600);">Cancellation Policy</a>.</p>

<h3 style="margin-bottom: 12px; color: var(--green-800);">6. Governing Law</h3>
<p style="margin-bottom: 24px;">These terms are governed by the laws of the Republic of South Africa.</p>

<h3 style="margin-bottom: 12px; color: var(--green-800);">7. Contact</h3>
<p>Questions about these terms can be sent to <a href="mailto:mandundutaicy1@gmail.com" style="color: var(--green-600);">mandundutaicy1@gmail.com</a> or via WhatsApp on +27 68 328 2839.</p>

</div>
</div>
</section>

@endsection
