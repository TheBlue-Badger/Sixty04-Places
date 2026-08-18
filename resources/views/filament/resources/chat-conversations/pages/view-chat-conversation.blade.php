<x-filament-panels::page>
    <div
        x-data="{
            channel: null,
            subscribe(uuid) {
                if (this.channel || ! uuid) return;
                this.channel = window.Echo.channel('chat.' + uuid).listen('.message.sent', (e) => {
                    $wire.receiveMessage(e.message);
                });
            },
        }"
        x-init="subscribe(@js($this->getRecord()->uuid))"
        class="flex flex-col gap-4"
    >
        <div
            data-chat-scroll
            class="flex h-[28rem] flex-col gap-3 overflow-y-auto rounded-xl border border-gray-200 bg-gray-50 p-4 dark:border-gray-700 dark:bg-gray-900"
        >
            @forelse ($messages as $message)
                <div class="flex {{ $message['sender_type'] === 'admin' ? 'justify-end' : 'justify-start' }}">
                    <div
                        @class([
                            'max-w-[75%] rounded-2xl px-4 py-2 text-sm leading-relaxed',
                            'bg-[#2d6a4f] text-white rounded-br-sm' => $message['sender_type'] === 'admin',
                            'bg-white text-gray-800 rounded-bl-sm dark:bg-gray-800 dark:text-gray-100' => $message['sender_type'] !== 'admin',
                        ])
                    >
                        @if ($message['attachment_url'])
                            <a href="{{ $message['attachment_url'] }}" target="_blank" rel="noopener">
                                <img src="{{ $message['attachment_url'] }}" alt="Attachment" class="mb-1 max-w-[220px] rounded-lg">
                            </a>
                        @endif
                        @if ($message['body'])
                            <p class="whitespace-pre-wrap break-words">{{ $message['body'] }}</p>
                        @endif
                    </div>
                </div>
            @empty
                <p class="m-auto text-sm text-gray-400">No messages yet.</p>
            @endforelse
        </div>

        <form wire:submit.prevent="sendReply" class="flex items-center gap-2">
            <input
                type="text"
                wire:model="body"
                placeholder="Type a reply…"
                autocomplete="off"
                class="fi-input flex-1 rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-[#2d6a4f] focus:outline-none focus:ring-1 focus:ring-[#2d6a4f] dark:border-gray-600 dark:bg-gray-800 dark:text-white"
            >
            <button
                type="submit"
                wire:loading.attr="disabled"
                wire:target="sendReply"
                class="rounded-lg bg-[#2d6a4f] px-4 py-2 text-sm font-medium text-white transition hover:bg-[#357a5b] disabled:opacity-60"
            >
                Send
            </button>
        </form>
        @error('body') <p class="text-sm text-danger-600">{{ $message }}</p> @enderror
    </div>
</x-filament-panels::page>
