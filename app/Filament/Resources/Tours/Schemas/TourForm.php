<?php

namespace App\Filament\Resources\Tours\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class TourForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true),
                TextInput::make('title')
                    ->required(),
                Select::make('category')
                    ->options([
                        'cape-town' => 'Cape Town',
                        'safari' => 'Safari',
                    ])
                    ->required(),
                TextInput::make('duration')
                    ->required()
                    ->placeholder('Full Day (8 hrs)'),
                TextInput::make('price_zar')
                    ->numeric()
                    ->prefix('R')
                    ->minValue(0),
                TextInput::make('image')
                    ->required()
                    ->helperText('Path relative to /public, e.g. images/tours/cape-peninsula.jpg'),
                Textarea::make('description')
                    ->required()
                    ->rows(4)
                    ->columnSpanFull(),
                TextInput::make('badge')
                    ->placeholder('Most Popular'),
                Toggle::make('featured'),
                TextInput::make('sort_order')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
