<?php

namespace App\Filament\Resources\Vehicles\Pages;

use App\Filament\Resources\Vehicles\VehicleResource;
use App\Models\Vehicle;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Str;

class CreateVehicle extends CreateRecord
{
    protected static string $resource = VehicleResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $base = Str::slug($data['name']);
        $slug = $base;
        $suffix = 2;

        while (Vehicle::where('slug', $slug)->exists()) {
            $slug = "{$base}-{$suffix}";
            $suffix++;
        }

        $data['slug'] = $slug;

        return $data;
    }
}
