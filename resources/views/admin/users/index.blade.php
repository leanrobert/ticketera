<x-layouts::app :title="__('Users')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <flux:heading size="lg">{{ __('Usuarios') }}</flux:heading>

        <livewire:users.admin-user-list />
    </div>
</x-layouts::app>
