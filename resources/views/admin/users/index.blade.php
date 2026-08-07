<x-layouts::app :title="__('Users')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <h1 class="text-xl font-semibold">{{ __('Users') }}</h1>

        <table class="w-full text-left text-sm">
            <thead>
                <tr class="border-b border-neutral-200 dark:border-neutral-700">
                    <th class="py-2">{{ __('Name') }}</th>
                    <th class="py-2">{{ __('Email') }}</th>
                    <th class="py-2">{{ __('Role') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr class="border-b border-neutral-100 dark:border-neutral-800">
                        <td class="py-2">{{ $user->name }}</td>
                        <td class="py-2">{{ $user->email }}</td>
                        <td class="py-2">{{ $user->role->value }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $users->links() }}
    </div>
</x-layouts::app>
