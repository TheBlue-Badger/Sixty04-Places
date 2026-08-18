<?php

use App\Http\Controllers\StripeWebhookController;
use App\Models\Tour;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home', [
        'featuredTours' => Tour::where('featured', true)->orderBy('sort_order')->get(),
        'featuredVehicles' => Vehicle::where('featured', true)->orderBy('sort_order')->take(3)->get(),
    ]);
})->name('home');

Route::get('/about', function () {
    return view('pages.about');
})->name('about');

Route::get('/cape-town-tours', function () {
    return view('pages.tours', [
        'tours' => Tour::where('category', 'cape-town')->orderBy('sort_order')->get(),
    ]);
})->name('tours');

Route::get('/chauffeur', function () {
    return view('pages.chauffeur', [
        'vehicles' => Vehicle::where('featured', true)->orderBy('sort_order')->take(3)->get(),
    ]);
})->name('chauffeur');

Route::get('/fleet', function () {
    return view('pages.fleet', [
        'vehicles' => Vehicle::orderBy('sort_order')->get(),
    ]);
})->name('fleet');

Route::get('/safari-extensions', function () {
    return view('pages.safari');
})->name('safari');

Route::get('/private-tours', function () {
    return view('pages.private-tours');
})->name('private-tours');

Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');

Route::get('/booking', function () {
    return view('pages.booking');
})->name('booking');

Route::get('/terms', function () {
    return view('pages.terms');
})->name('terms');

Route::get('/cancellation-policy', function () {
    return view('pages.cancellation-policy');
})->name('cancellation-policy');

Route::post('/stripe/webhook', [StripeWebhookController::class, 'handle'])->name('stripe.webhook');
