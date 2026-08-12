<x-layouts::app :title="__('Tickets')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <flux:heading size="lg">{{ __('Tickets') }}</flux:heading>

        <livewire:tickets.admin-ticket-list />
    </div>
</x-layouts::app>
