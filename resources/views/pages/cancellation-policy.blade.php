@extends('layouts.app')

@section('title', 'Cancellation Policy | SIXTY04 PLACES')
@section('description', "Cancellation, rescheduling, and refund policy for tours, chauffeur services, and safari extensions booked with SIXTY04 PLACES.")

@section('nav-cta')
    <a href="{{ route('booking') }}" class="btn btn-primary">Book Now</a>
@endsection

@section('content')

<section class="section section-cream" style="padding-top: 120px; padding-bottom: 60px;">
<div class="container" style="max-width: 800px;">

<div class="text-center mb-48">
<span class="section-label">Legal</span>
<h1 style="margin-bottom: 16px;">Cancellation Policy</h1>
<p style="color: var(--gray-600);">Last updated {{ now()->format('d F Y') }}</p>
</div>

<div style="color: var(--gray-600); line-height: 1.8;">

<h3 style="margin-bottom: 12px; color: var(--green-800);">Cancelling Your Booking</h3>
<p style="margin-bottom: 24px;">You can cancel or request to reschedule a booking by replying to your confirmation email, messaging us on WhatsApp, or emailing <a href="mailto:mandundutaicy1@gmail.com" style="color: var(--green-600);">mandundutaicy1@gmail.com</a>. Please include your booking reference number.</p>

<h3 style="margin-bottom: 12px; color: var(--green-800);">Refund Schedule</h3>
<p style="margin-bottom: 12px;">For bookings paid online, refunds are calculated from the scheduled pickup date and time:</p>
<ul style="margin: 0 0 24px 20px; padding: 0;">
<li style="margin-bottom: 8px;"><strong>72+ hours before pickup:</strong> full refund, less any card processing fees.</li>
<li style="margin-bottom: 8px;"><strong>24&ndash;72 hours before pickup:</strong> 50% refund.</li>
<li style="margin-bottom: 8px;"><strong>Less than 24 hours before pickup, or no-show:</strong> no refund, as the vehicle and driver-guide are already committed to your booking.</li>
</ul>

<h3 style="margin-bottom: 12px; color: var(--green-800);">Rescheduling</h3>
<p style="margin-bottom: 24px;">We're happy to move your booking to a new date at no charge where at least 24 hours' notice is given and availability allows. Requests inside 24 hours will be accommodated where possible but are not guaranteed.</p>

<h3 style="margin-bottom: 12px; color: var(--green-800);">Cancellations by SIXTY04 PLACES</h3>
<p style="margin-bottom: 24px;">If we need to cancel a booking due to safety concerns, severe weather, or vehicle/driver unavailability, you'll receive a full refund or the option to reschedule at no additional cost, regardless of how close to the pickup date this occurs.</p>

<h3 style="margin-bottom: 12px; color: var(--green-800);">Requests Without a Listed Price</h3>
<p style="margin-bottom: 24px;">For custom itineraries, hourly hire, and transfer requests where no payment was taken online, simply let us know as early as possible if your plans change — no cancellation fee applies before a quote has been accepted and paid.</p>

<h3 style="margin-bottom: 12px; color: var(--green-800);">How Refunds Are Paid</h3>
<p>Approved refunds are returned to your original payment method via Stripe and typically appear within 5&ndash;10 business days, depending on your bank.</p>

</div>
</div>
</section>

@endsection
