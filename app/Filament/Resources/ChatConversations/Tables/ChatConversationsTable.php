<?php

namespace App\Filament\Resources\ChatConversations\Tables;

use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ChatConversationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('display_name')
                    ->label('Visitor')
                    ->searchable(['guest_name', 'guest_email']),
                TextColumn::make('guest_email')
                    ->label('Email')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('unread_count')
                    ->label('Unread')
                    ->state(fn ($record) => $record->messages()
                        ->where('sender_type', 'visitor')
                        ->whereNull('read_at')
                        ->count())
                    ->badge()
                    ->color(fn (int $state): string => $state > 0 ? 'danger' : 'gray'),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'open' => 'success',
                        'closed' => 'gray',
                        default => 'gray',
                    }),
                TextColumn::make('last_message_at')
                    ->label('Last message')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('last_message_at', 'desc')
            ->recordActions([
                ViewAction::make(),
            ]);
    }
}
