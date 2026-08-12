<x-layouts::app :title="$ticket->title">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="flex items-center justify-between">
            <div>
                <flux:button href="{{ route('ticket.index') }}" wire:navigate variant="ghost" size="sm" icon="arrow-left">
                    {{ __('Volver a mis tickets') }}
                </flux:button>
                <flux:heading size="lg">{{ $ticket->title }}</flux:heading>
                <p class="text-sm text-neutral-500">{{ $ticket->description }}</p>
            </div>
            <div class="flex items-center gap-2">
                <flux:badge size="sm" :color="$ticket->statusColor()">{{ $ticket->statusLabel() }}</flux:badge>
            </div>
        </div>

        <livewire:tickets.ticket-chat :ticket="$ticket" />
    </div>
</x-layouts::app>
