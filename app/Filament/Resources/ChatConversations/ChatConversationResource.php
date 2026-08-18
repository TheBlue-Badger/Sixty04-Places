<?php

namespace App\Filament\Resources\ChatConversations;

use App\Filament\Resources\ChatConversations\Pages\ListChatConversations;
use App\Filament\Resources\ChatConversations\Pages\ViewChatConversation;
use App\Filament\Resources\ChatConversations\Tables\ChatConversationsTable;
use App\Models\ChatConversation;
use App\Models\ChatMessage;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ChatConversationResource extends Resource
{
    protected static ?string $model = ChatConversation::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChatBubbleLeftEllipsis;

    protected static string|\UnitEnum|null $navigationGroup = 'Leads';

    protected static ?string $navigationLabel = 'Live Chat';

    public static function table(Table $table): Table
    {
        return ChatConversationsTable::configure($table);
    }

    public static function getNavigationBadge(): ?string
    {
        $count = ChatMessage::where('sender_type', 'visitor')->whereNull('read_at')->count();

        return $count > 0 ? (string) $count : null;
    }

    public static function getPages(): array
    {
        return [
            'index' => ListChatConversations::route('/'),
            'view' => ViewChatConversation::route('/{record}'),
        ];
    }
}
