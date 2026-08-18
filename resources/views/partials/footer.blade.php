<footer class="footer">
<div class="container">
<div class="grid-4" style="margin-bottom:40px;">
<div>
<a href="{{ route('home') }}" class="navbar-logo" style="margin-bottom:16px;">
<img src="{{ asset('images/logo.png') }}" alt="SIXTY04 PLACES" style="height:40px;">
<div><span class="navbar-logo-text" style="font-size:1.3rem;">SIXTY04</span><span class="navbar-logo-sub">Places</span></div>
</a>
<p style="font-size:0.9rem;margin-top:12px;color:rgba(255,255,255,0.6);">Premium private tours & chauffeur services in Cape Town and South Africa. Your journey, our passion.</p>
<div class="footer-signature"><i class="fas fa-location-arrow"></i> S 33.9249&deg; / E 18.4241&deg; &mdash; CAPE TOWN</div>
<div class="footer-social">
<a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
<a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
<a href="#" aria-label="TikTok"><i class="fab fa-tiktok"></i></a>
<a href="#" aria-label="TripAdvisor"><i class="fas fa-star"></i></a>
</div>
</div>
<div>
<h4>Quick Links</h4>
<div class="footer-links">
<a href="{{ route('about') }}">About Us</a>
<a href="{{ route('tours') }}">Cape Town Tours</a>
<a href="{{ route('private-tours') }}">Private Tours</a>
<a href="{{ route('chauffeur') }}">Chauffeur Services</a>
<a href="{{ route('safari') }}">Safari Extensions</a>
</div>
</div>
<div>
<h4>Services</h4>
<div class="footer-links">
<a href="{{ route('fleet') }}">Our Fleet</a>
<a href="{{ route('booking') }}">Book a Tour</a>
<a href="{{ route('booking') }}">Request a Ride</a>
<a href="{{ route('contact') }}">Contact Us</a>
</div>
</div>
<div>
<h4>Contact</h4>
<div class="footer-links">
<a href="tel:+27683282839"><i class="fas fa-phone" style="margin-right:8px;"></i> +27 68 328 2839</a>
<a href="mailto:mandundutaicy1@gmail.com"><i class="fas fa-envelope" style="margin-right:8px;"></i> mandundutaicy1@gmail.com</a>
<a href="https://wa.me/27683282839" target="_blank" rel="noopener noreferrer"><i class="fab fa-whatsapp" style="margin-right:8px;"></i> WhatsApp Us</a>
<p style="margin-top:12px;font-size:0.85rem;color:rgba(255,255,255,0.5);"><i class="fas fa-map-marker-alt" style="margin-right:8px;"></i> Cape Town, South Africa</p>
</div>
</div>
</div>
<div class="footer-bottom">
<p>&copy; {{ date('Y') }} SIXTY04 PLACES. All rights reserved. &middot; <a href="{{ route('terms') }}" style="color:inherit;">Terms &amp; Conditions</a> &middot; <a href="{{ route('cancellation-policy') }}" style="color:inherit;">Cancellation Policy</a></p>
<span class="coord-tag"><i class="fas fa-route"></i> Cape Town &middot; Winelands &middot; Garden Route</span>
</div>
</div>
</footer>
