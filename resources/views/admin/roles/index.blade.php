<x-layouts.app>
    @section('page-title', __('messages.manage_roles'))
    @section('page-subtitle', __('messages.manage_system_roles'))

    <div class="mx-auto max-w-6xl">
        <div class="mb-6 flex flex-col sm:flex-row items-center justify-between gap-4">
            <h2 class="text-xl font-bold th-text">{{ __('messages.roles_list') }}</h2>
        </div>

        <div class="overflow-hidden rounded-2xl border th-border shadow-sm" style="background-color: var(--t-bg-card);">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="border-b th-border" style="background-color: var(--t-bg-input);">
                        <tr>
                            <th class="whitespace-nowrap px-6 py-4 font-semibold th-text">
                                {{ __('messages.role_name') }}
                            </th>
                            <th class="whitespace-nowrap px-6 py-4 font-semibold th-text">
                                {{ __('messages.description') }}
                            </th>
                            <th class="whitespace-nowrap px-6 py-4 font-semibold th-text">
                                {{ __('messages.permissions') }}
                            </th>
                            <th class="whitespace-nowrap px-6 py-4 font-semibold th-text text-right">
                                {{ __('messages.actions') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y th-border">
                        @forelse($roles as $role)
                            <tr class="transition-colors hover:th-bg-hover">
                                <td class="px-6 py-4 font-medium th-text">{{ $role->display_name ?? $role->name }}</td>
                                <td class="px-6 py-4 th-text-secondary">{{ $role->description ?? '-' }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <span
                                            class="inline-flex items-center rounded-lg bg-brand-500/10 px-2.5 py-1 text-xs font-semibold text-brand-600 border border-brand-500/20">
                                            {{ $role->permissions->count() }}
                                        </span>
                                        <span class="text-xs th-text-muted">{{ __('messages.permissions_count') }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('admin.roles.edit', $role) }}"
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
                                <td colspan="4" class="px-6 py-8 text-center text-sm th-text-muted">
                                    {{ __('messages.no_data') }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layouts.app>