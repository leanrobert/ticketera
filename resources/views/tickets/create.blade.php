<x-layouts::app :title="__('New ticket')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <flux:heading size="lg">{{ __('New ticket') }}</flux:heading>

        <livewire:tickets.create-ticket />
    </div>
</x-layouts::app>
