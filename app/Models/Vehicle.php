<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'slug',
        'name',
        'class',
        'description',
        'features',
        'image',
        'cta_label',
        'featured',
        'sort_order',
    ];

    protected $casts = [
        'features' => 'array',
        'featured' => 'boolean',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
