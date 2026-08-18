<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    public function run(): void
    {
        $vehicles = [
            [
                'slug' => 'c-class',
                'name' => 'Mercedes-Benz C-Class',
                'class' => 'Executive Sedan',
                'description' => 'The perfect balance of luxury and comfort. Ideal for couples, business travelers, and seamless airport transfers.',
                'features' => [
                    ['icon' => 'fa-user', 'label' => 'Up to 3 Passengers'],
                    ['icon' => 'fa-suitcase', 'label' => '2 Large Bags'],
                    ['icon' => 'fa-snowflake', 'label' => 'Climate Control'],
                    ['icon' => 'fa-wifi', 'label' => 'Wi-Fi on request'],
                ],
                'image' => 'images/fleet/mercedes-c-class-vineyard.jpg',
                'cta_label' => 'Request This Vehicle',
                'featured' => true,
                'sort_order' => 1,
            ],
            [
                'slug' => 'amg',
                'name' => 'Mercedes-Benz AMG Line',
                'class' => 'Sport Executive',
                'description' => 'A dynamic, stylish option offering an elevated ride experience for evening events and premium city transfers.',
                'features' => [
                    ['icon' => 'fa-user', 'label' => 'Up to 3 Passengers'],
                    ['icon' => 'fa-suitcase', 'label' => '2 Large Bags'],
                    ['icon' => 'fa-gem', 'label' => 'Premium Interior'],
                    ['icon' => 'fa-bolt', 'label' => 'Sport Styling'],
                ],
                'image' => 'images/fleet/mercedes-amg-city.jpg',
                'cta_label' => 'Request This Vehicle',
                'featured' => true,
                'sort_order' => 2,
            ],
            [
                'slug' => 'suv',
                'name' => 'Honda BR-V / Similar',
                'class' => 'Premium SUV',
                'description' => 'Spacious, safe, and versatile. The ultimate choice for families, small groups, and multi-day Garden Route journeys.',
                'features' => [
                    ['icon' => 'fa-user', 'label' => 'Up to 6 Passengers'],
                    ['icon' => 'fa-suitcase', 'label' => '4 Large Bags'],
                    ['icon' => 'fa-map', 'label' => 'Safari & Scenic Ready'],
                    ['icon' => 'fa-users', 'label' => 'Spacious Cabin'],
                ],
                'image' => 'images/fleet/honda-brv-studio.jpg',
                'cta_label' => 'Request This Vehicle',
                'featured' => true,
                'sort_order' => 3,
            ],
            [
                'slug' => 'van',
                'name' => 'Premium 7-14 Seater',
                'class' => 'Group Van',
                'description' => 'Perfect for large families, corporate retreats, and group day tours across the Cape Winelands.',
                'features' => [
                    ['icon' => 'fa-user', 'label' => '7-14 Passengers'],
                    ['icon' => 'fa-suitcase', 'label' => 'Group Luggage'],
                    ['icon' => 'fa-chair', 'label' => 'Captain Seating'],
                    ['icon' => 'fa-music', 'label' => 'PA System'],
                ],
                'image' => null,
                'cta_label' => 'Enquire About Groups',
                'featured' => false,
                'sort_order' => 4,
            ],
        ];

        foreach ($vehicles as $vehicle) {
            Vehicle::updateOrCreate(['slug' => $vehicle['slug']], $vehicle);
        }
    }
}
