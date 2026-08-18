<nav class="navbar @yield('navbar-class', 'scrolled')" id="navbar">
<div class="container-wide navbar-inner">
<a href="{{ route('home') }}" class="navbar-logo">
<img src="{{ asset('images/logo.png') }}" alt="SIXTY04 PLACES Logo" onerror="this.style.display='none'">
<div>
<span class="navbar-logo-text">SIXTY04</span>
<span class="navbar-logo-sub">Places</span>
</div>
</a>
<div class="nav-links" id="nav-links">
<a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
<a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About</a>
<a href="{{ route('tours') }}" class="{{ request()->routeIs('tours') ? 'active' : '' }}">Tours</a>
<a href="{{ route('chauffeur') }}" class="{{ request()->routeIs('chauffeur') ? 'active' : '' }}">Chauffeur</a>
<a href="{{ route('fleet') }}" class="{{ request()->routeIs('fleet') ? 'active' : '' }}">Fleet</a>
<a href="{{ route('safari') }}" class="{{ request()->routeIs('safari') ? 'active' : '' }}">Safari</a>
<a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a>
</div>
<div class="nav-cta">
@yield('nav-cta')
<button class="mobile-toggle" id="mobile-toggle" aria-label="Open menu" aria-controls="mobile-menu" aria-expanded="false"><i class="fas fa-bars"></i></button>
</div>
</div>
</nav>
