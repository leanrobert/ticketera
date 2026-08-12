<x-layouts::app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <flux:heading size="lg">{{ __('Dashboard') }}</flux:heading>

        <livewire:dashboard />
    </div>
</x-layouts::app>
