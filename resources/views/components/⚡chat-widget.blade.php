<?php

use App\Events\ChatMessageSent;
use App\Models\ChatConversation;
use App\Models\ChatMessage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

new class extends Component
{
    use WithFileUploads;

    public ?ChatConversation $conversation = null;

    public array $messages = [];

    public string $body = '';

    public $attachment = null;

    public function mount(): void
    {
        $uuid = session('chat_conversation_uuid');

        if ($uuid) {
            $this->conversation = ChatConversation::where('uuid', $uuid)->first();
        }

        if ($this->conversation) {
            $this->messages = $this->formatMessages($this->conversation);
        }
    }

    protected function rules(): array
    {
        return [
            'body' => ['nullable', 'string', 'max:2000'],
            'attachment' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        ];
    }

    public function removeAttachment(): void
    {
        $this->reset('attachment');
    }

    public function sendMessage(): void
    {
        $this->validate();

        if (blank($this->body) && ! $this->attachment) {
            $this->addError('body', 'Please enter a message or attach a photo.');

            return;
        }

        if (! $this->conversation) {
            $this->conversation = ChatConversation::create([
                'uuid' => (string) Str::uuid(),
            ]);

            session(['chat_conversation_uuid' => $this->conversation->uuid]);

            $this->dispatch('conversation-ready', uuid: $this->conversation->uuid);
        }

        $attachmentPath = null;
        $attachmentType = null;

        if ($this->attachment) {
            $attachmentPath = $this->attachment->store('chat-attachments', 'public');
            $attachmentType = 'image';
        }

        $message = $this->conversation->messages()->create([
            'sender_type' => 'visitor',
            'body' => $this->body ?: null,
            'attachment_path' => $attachmentPath,
            'attachment_type' => $attachmentType,
        ]);

        $this->conversation->update(['last_message_at' => now()]);
        $message->setRelation('conversation', $this->conversation);

        broadcast(new ChatMessageSent($message));

        $this->messages[] = $this->formatMessage($message);

        $this->reset(['body', 'attachment']);
    }

    public function receiveMessage(array $message): void
    {
        if (collect($this->messages)->contains('id', $message['id'])) {
            return;
        }

        $this->messages[] = $message;
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    protected function formatMessages(ChatConversation $conversation): array
    {
        return $conversation->messages()
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
};
?>

<div
    class="chat-widget"
    x-data="{
        open: false,
        uuid: @js($conversation?->uuid),
        channel: null,
        subscribe(uuid) {
            if (this.channel || ! uuid) return;
            this.channel = window.Echo.channel('chat.' + uuid).listen('.message.sent', (e) => {
                $wire.receiveMessage(e.message);
            });
        },
    }"
    x-init="if (uuid) subscribe(uuid)"
    @conversation-ready.window="subscribe($event.detail.uuid)"
>
    <button
        type="button"
        class="chat-bubble"
        @click="open = ! open"
        :aria-expanded="open"
        aria-label="Chat with us"
    >
        <svg x-show="! open" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="26" height="26">
            <path d="M4 4h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H9l-5 4V6a2 2 0 0 1 2-2z"/>
        </svg>
        <svg x-show="open" x-cloak xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="22" height="22">
            <path d="M6 6l12 12M18 6L6 18" stroke-linecap="round"/>
        </svg>
    </button>

    <div class="chat-panel" x-show="open" x-cloak x-transition @click.outside="open = false">
        <div class="chat-panel-header">
            <span>Chat with us</span>
            <button type="button" class="chat-panel-close" @click="open = false" aria-label="Close chat">&times;</button>
        </div>

        <div class="chat-panel-messages" data-chat-scroll role="log" aria-live="polite">
            @forelse ($messages as $message)
                <div class="chat-message chat-message-{{ $message['sender_type'] }}">
                    <div class="chat-bubble-content">
                        @if ($message['attachment_url'])
                            <a href="{{ $message['attachment_url'] }}" target="_blank" rel="noopener">
                                <img src="{{ $message['attachment_url'] }}" alt="Attachment" class="chat-attachment-thumb">
                            </a>
                        @endif
                        @if ($message['body'])
                            <p>{{ $message['body'] }}</p>
                        @endif
                    </div>
                </div>
            @empty
                <p class="chat-empty-state">Send us a message and we'll reply here.</p>
            @endforelse
        </div>

        @if ($attachment)
            <div class="chat-attachment-preview">
                @if ($attachment->isPreviewable())
                    <img src="{{ $attachment->temporaryUrl() }}" alt="Selected attachment">
                @else
                    <span class="chat-attachment-filename">{{ $attachment->getClientOriginalName() }}</span>
                @endif
                <button type="button" wire:click="removeAttachment" aria-label="Remove attachment">&times;</button>
            </div>
        @endif

        @error('attachment') <small class="chat-error">{{ $message }}</small> @enderror
        @error('body') <small class="chat-error">{{ $message }}</small> @enderror

        <form wire:submit.prevent="sendMessage" class="chat-panel-input">
            <input
                type="file"
                x-ref="fileInput"
                wire:model="attachment"
                accept="image/jpeg,image/png,image/webp"
                class="chat-file-input"
            >
            <button type="button" class="chat-attach-btn" @click="$refs.fileInput.click()" aria-label="Attach photo">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="18" height="18">
                    <path d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
            <input
                type="text"
                wire:model="body"
                placeholder="Type a message…"
                class="chat-text-input"
                autocomplete="off"
            >
            <button type="submit" class="chat-send-btn" wire:loading.attr="disabled" wire:target="sendMessage,attachment" aria-label="Send message">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="18" height="18">
                    <path d="M2 21l21-9L2 3v7l15 2-15 2z"/>
                </svg>
            </button>
        </form>
    </div>
</div>
