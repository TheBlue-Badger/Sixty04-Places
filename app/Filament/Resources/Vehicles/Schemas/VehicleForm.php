<?php

namespace App\Filament\Resources\Vehicles\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class VehicleForm
{
    public const FEATURE_ICONS = [
        'fa-user' => 'Passengers',
        'fa-users' => 'Group seating',
        'fa-suitcase' => 'Luggage space',
        'fa-snowflake' => 'Air conditioning',
        'fa-wifi' => 'Wi-Fi',
        'fa-gem' => 'Premium interior',
        'fa-bolt' => 'Sport styling',
        'fa-map' => 'Safari & scenic ready',
        'fa-chair' => 'Captain seating',
        'fa-music' => 'Sound system',
        'fa-child' => 'Child seat available',
        'fa-shield-alt' => 'Safety features',
        'fa-glass-cheers' => 'Refreshments',
        'fa-star' => 'Top rated',
    ];

    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Vehicle Name')
                    ->required()
                    ->placeholder('Mercedes C-Class'),
                TextInput::make('class')
                    ->label('Vehicle Type')
                    ->required()
                    ->placeholder('Executive Sedan'),
                Textarea::make('description')
                    ->required()
                    ->rows(3)
                    ->columnSpanFull(),
                FileUpload::make('image')
                    ->label('Photo')
                    ->image()
                    ->disk('public_root')
                    ->directory('images/fleet')
                    ->imageEditor()
                    ->helperText('Upload a photo of the vehicle. Leave blank to show a "photo coming soon" placeholder.')
                    ->columnSpanFull(),
                Repeater::make('features')
                    ->label('Highlights')
                    ->schema([
                        Select::make('icon')
                            ->label('Type')
                            ->options(self::FEATURE_ICONS)
                            ->searchable()
                            ->native(false)
                            ->required(),
                        TextInput::make('label')
                            ->label('Description')
                            ->required()
                            ->placeholder('Up to 3 Passengers'),
                    ])
                    ->columns(2)
                    ->reorderable()
                    ->collapsible()
                    ->defaultItems(1)
                    ->addActionLabel('Add highlight')
                    ->helperText('Short highlights shown on the vehicle card, e.g. "Up to 3 Passengers" or "Wi-Fi on request".')
                    ->columnSpanFull(),
                TextInput::make('cta_label')
                    ->label('Button Text')
                    ->required()
                    ->default('Request This Vehicle'),
                Toggle::make('featured')
                    ->label('Show as Featured Vehicle')
                    ->helperText('Featured vehicles are highlighted on the fleet page.'),
                TextInput::make('sort_order')
                    ->label('Display Order')
                    ->required()
                    ->numeric()
                    ->default(0)
                    ->helperText('Vehicles with a lower number appear first in the list.'),
            ]);
    }
}
