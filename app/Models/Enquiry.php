<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'interest',
        'travel_date',
        'group_size',
        'vehicle_preference',
        'pickup_location',
        'message',
        'status',
    ];

    protected $casts = [
        'travel_date' => 'date',
    ];
}
