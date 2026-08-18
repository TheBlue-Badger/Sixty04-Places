import './echo';

document.addEventListener('livewire:init', () => {
    Livewire.hook('commit', ({ respond }) => {
        respond(() => {
            document.querySelectorAll('[data-chat-scroll]').forEach((el) => {
                el.scrollTop = el.scrollHeight;
            });
        });
    });
});
