<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'service',
        'trip_date',
        'pickup_time',
        'passengers',
        'first_name',
        'last_name',
        'email',
        'phone',
        'pickup_location',
        'payment_method',
        'status',
        'amount_cents',
        'currency',
        'stripe_payment_intent_id',
        'paid_at',
    ];

    protected $casts = [
        'trip_date' => 'date',
        'paid_at' => 'datetime',
    ];
}
