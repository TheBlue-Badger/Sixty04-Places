<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title', 'SIXTY04 PLACES')</title>
<meta name="description" content="@yield('description', "Premium private tours, chauffeur services & safari extensions in Cape Town and South Africa. Book your bespoke travel experience with SIXTY04 PLACES.")">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500&family=Inter:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">

@livewireStyles
@stack('styles')
</head>
<body>

@include('partials.navbar')
@include('partials.mobile-menu')

@yield('content')

@include('partials.footer')
@include('partials.whatsapp-float')
<livewire:chat-widget />

<script src="{{ asset('js/main.js') }}"></script>
@vite(['resources/js/app.js'])
@livewireScripts
@stack('scripts')
</body>
</html>
