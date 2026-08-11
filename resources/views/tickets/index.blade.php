<x-layouts::app :title="__('My tickets')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="flex items-center justify-between">
            <h1 class="text-xl font-semibold">{{ __('Mis tickets') }}</h1>
            <flux:button href="{{ route('ticket.create') }}" wire:navigate>
                {{ __('Nuevo ticket') }}
            </flux:button>
        </div>

        <livewire:tickets.ticket-list />
    </div>
</x-layouts::app>