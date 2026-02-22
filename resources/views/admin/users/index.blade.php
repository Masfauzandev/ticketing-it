<x-layouts.app>
    @section('page-title', __('messages.manage_users'))
    @section('page-subtitle', __('messages.manage_system_users'))

    <div class="mx-auto max-w-6xl">
        <div class="mb-6 flex flex-col sm:flex-row items-center justify-between gap-4">
            <h2 class="text-xl font-bold th-text">{{ __('messages.users_list') }}</h2>
        </div>

        <div class="overflow-hidden rounded-2xl border th-border shadow-sm" style="background-color: var(--t-bg-card);">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="border-b th-border" style="background-color: var(--t-bg-input);">
                        <tr>
                            <th class="whitespace-nowrap px-6 py-4 font-semibold th-text">
                                {{ __('messages.name') }}
                            </th>
                            <th class="whitespace-nowrap px-6 py-4 font-semibold th-text">
                                {{ __('messages.email') }}
                            </th>
                            <th class="whitespace-nowrap px-6 py-4 font-semibold th-text">
                                {{ __('messages.roles') }}
                            </th>
                            <th class="whitespace-nowrap px-6 py-4 font-semibold th-text">
                                {{ __('messages.status') }}
                            </th>
                            <th class="whitespace-nowrap px-6 py-4 font-semibold th-text text-right">
                                {{ __('messages.actions') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y th-border">
                        @forelse($users as $user)
                            <tr class="transition-colors hover:th-bg-hover">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-brand-500/10 text-brand-600 font-bold">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <p class="font-medium th-text">{{ $user->name }}</p>
                                            <p class="text-[11px] th-text-muted">{{ $user->employee_id ?? '-' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 th-text-secondary">{{ $user->email }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-wrap gap-1">
                                        @foreach($user->roles as $role)
                                            <span
                                                class="inline-flex items-center rounded-lg px-2.5 py-1 text-[11px] font-medium border th-border"
                                                style="background-color: var(--t-bg-input); color: var(--t-text);">
                                                {{ $role->display_name ?? $role->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    @if($user->is_active)
                                        <span
                                            class="inline-flex items-center gap-1.5 rounded-full border border-green-500/20 bg-green-500/10 px-2.5 py-1 text-xs font-medium text-green-600 dark:text-green-400">
                                            <span
                                                class="h-1.5 w-1.5 rounded-full bg-green-500 shadow-[0_0_5px_rgba(34,197,94,0.5)]"></span>
                                            {{ __('messages.active') }}
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center gap-1.5 rounded-full border border-red-500/20 bg-red-500/10 px-2.5 py-1 text-xs font-medium text-red-600 dark:text-red-400">
                                            <span
                                                class="h-1.5 w-1.5 rounded-full bg-red-500 shadow-[0_0_5px_rgba(239,68,68,0.5)]"></span>
                                            {{ __('messages.inactive') }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('admin.users.edit', $user) }}"
                                        class="inline-flex items-center justify-center rounded-xl p-2 th-text-secondary transition-all duration-200 hover:bg-brand-500/10 hover:text-brand-500"
                                        title="{{ __('messages.edit') }}">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-sm th-text-muted">
                                    {{ __('messages.no_data') }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($users->hasPages())
                <div class="border-t th-border px-6 py-4" style="background-color: var(--t-bg-input);">
                    {{ $users->links() }}
                </div>
            @endif
        </div>
    </div>
</x-layouts.app>