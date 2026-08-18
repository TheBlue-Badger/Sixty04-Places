<?php

namespace App\Filament\Resources\Bookings\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class BookingInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('service'),
                TextEntry::make('trip_date')
                    ->date(),
                TextEntry::make('pickup_time')
                    ->time(),
                TextEntry::make('passengers')
                    ->numeric(),
                TextEntry::make('first_name'),
                TextEntry::make('last_name'),
                TextEntry::make('email')
                    ->label('Email address'),
                TextEntry::make('phone'),
                TextEntry::make('pickup_location'),
                TextEntry::make('payment_method')
                    ->placeholder('-'),
                TextEntry::make('amount_cents')
                    ->label('Amount')
                    ->formatStateUsing(fn (?int $state): string => $state === null ? '-' : 'R' . number_format($state / 100, 2)),
                TextEntry::make('stripe_payment_intent_id')
                    ->label('Stripe Payment Intent')
                    ->placeholder('-')
                    ->copyable(),
                TextEntry::make('paid_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('status'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
