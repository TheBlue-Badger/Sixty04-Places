<?php

namespace App\Filament\Resources\ChatConversations\Pages;

use App\Events\ChatMessageSent;
use App\Filament\Resources\ChatConversations\ChatConversationResource;
use App\Models\ChatMessage;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use Filament\Resources\Pages\Page;

class ViewChatConversation extends Page
{
    use InteractsWithRecord;

    protected static string $resource = ChatConversationResource::class;

    protected string $view = 'filament.resources.chat-conversations.pages.view-chat-conversation';

    public array $messages = [];

    public string $body = '';

    public function mount(int|string $record): void
    {
        $this->record = $this->resolveRecord($record);

        $this->authorizeAccess();

        $this->record->messages()
            ->where('sender_type', 'visitor')
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        $this->messages = $this->formatMessages();
    }

    protected function authorizeAccess(): void
    {
        abort_unless(static::getResource()::canView($this->getRecord()), 403);
    }

    public function getTitle(): string
    {
        return $this->getRecord()->display_name;
    }

    protected function rules(): array
    {
        return [
            'body' => ['required', 'string', 'max:2000'],
        ];
    }

    public function sendReply(): void
    {
        $this->validate();

        $conversation = $this->getRecord();

        $message = $conversation->messages()->create([
            'sender_type' => 'admin',
            'sender_id' => auth()->id(),
            'body' => $this->body,
        ]);

        $conversation->update(['last_message_at' => now()]);
        $message->setRelation('conversation', $conversation);

        broadcast(new ChatMessageSent($message));

        $this->messages[] = $this->formatMessage($message);

        $this->reset('body');
    }

    public function receiveMessage(array $message): void
    {
        if (collect($this->messages)->contains('id', $message['id'])) {
            return;
        }

        $this->messages[] = $message;

        ChatMessage::where('id', $message['id'])->update(['read_at' => now()]);
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    protected function formatMessages(): array
    {
        return $this->getRecord()->messages()
            ->orderBy('created_at')
            ->get()
            ->map(fn (ChatMessage $message) => $this->formatMessage($message))
            ->toArray();
    }

    /**
     * @return array<string, mixed>
     */
    protected function formatMessage(ChatMessage $message): array
    {
        return [
            'id' => $message->id,
            'sender_type' => $message->sender_type,
            'body' => $message->body,
            'attachment_url' => $message->attachment_url,
            'attachment_type' => $message->attachment_type,
            'created_at' => $message->created_at->toIso8601String(),
        ];
    }
}
