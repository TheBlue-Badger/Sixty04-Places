<?php

namespace Database\Seeders;

use App\Models\Tour;
use Illuminate\Database\Seeder;

class TourSeeder extends Seeder
{
    public function run(): void
    {
        $tours = [
            [
                'slug' => 'cape-peninsula',
                'title' => 'Cape Peninsula & Cape Point',
                'category' => 'cape-town',
                'duration' => 'Full Day (8 hrs)',
                'price_zar' => 3800,
                'image' => 'images/tours/cape-peninsula.jpg',
                'description' => "Our signature tour. Drive the dramatic Atlantic Seaboard, visit the African penguins at Boulders Beach, and stand at the edge of the continent at Cape Point.",
                'badge' => 'Most Popular',
                'featured' => true,
                'sort_order' => 1,
            ],
            [
                'slug' => 'cape-town-city-table-mountain',
                'title' => 'Cape Town City & Table Mountain',
                'category' => 'cape-town',
                'duration' => 'Half Day (4-5 hrs)',
                'price_zar' => 2800,
                'image' => 'images/tours/city-tour.jpg',
                'description' => "Explore the vibrant heart of the Mother City. Visit the colorful Bo-Kaap, the historic Castle of Good Hope, and ascend the iconic Table Mountain.",
                'badge' => null,
                'featured' => true,
                'sort_order' => 2,
            ],
            [
                'slug' => 'cape-winelands',
                'title' => 'Cape Winelands',
                'category' => 'cape-town',
                'duration' => 'Full Day (8 hrs)',
                'price_zar' => 3500,
                'image' => 'images/tours/winelands.jpg',
                'description' => "A tasting journey through Stellenbosch and Franschhoek. Enjoy world-class wines, historic estates, and spectacular mountain scenery.",
                'badge' => null,
                'featured' => true,
                'sort_order' => 3,
            ],
            [
                'slug' => 'township-culture',
                'title' => 'Township Culture Experience',
                'category' => 'cape-town',
                'duration' => 'Half Day (4 hrs)',
                'price_zar' => 2500,
                'image' => 'images/tours/township-sa.jpg',
                'description' => "An authentic, respectful dive into South African culture. Walk the streets, meet the locals, and understand the deep history of our communities.",
                'badge' => null,
                'featured' => true,
                'sort_order' => 4,
            ],
            [
                'slug' => 'whale-coast-hermanus',
                'title' => 'Whale Coast & Hermanus',
                'category' => 'cape-town',
                'duration' => 'Full Day (9 hrs)',
                'price_zar' => 4200,
                'image' => 'images/tours/whale-coast.webp',
                'description' => "Travel the stunning Clarence Drive to Hermanus, the whale watching capital. Spot Southern Right Whales (in season) and explore seaside towns.",
                'badge' => null,
                'featured' => true,
                'sort_order' => 5,
            ],
            [
                'slug' => 'safari-extension',
                'title' => 'Safari Extension',
                'category' => 'safari',
                'duration' => 'Multi-Day',
                'price_zar' => 9500,
                'image' => 'images/tours/safari.jpg',
                'description' => "Extend your trip with a Big Five safari — Kruger, Aquila & more.",
                'badge' => 'Adventure',
                'featured' => true,
                'sort_order' => 6,
            ],
        ];

        foreach ($tours as $tour) {
            Tour::updateOrCreate(['slug' => $tour['slug']], $tour);
        }
    }
}
