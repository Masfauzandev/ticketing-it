<x-layouts.app>
    @section('page-title', __('messages.manage_users'))
    @section('page-subtitle', __('messages.edit_user'))

    <div class="mx-auto max-w-4xl">
        <div class="mb-6 flex items-center justify-between">
            <h2 class="text-xl font-bold th-text">{{ __('messages.edit_user') }}: {{ $user->name }}</h2>
            <a href="{{ route('admin.users.index') }}" class="inline-flex items-center gap-2 text-sm font-medium th-text-secondary hover:text-brand-500 transition-colors">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                </svg>
                {{ __('messages.back') }}
            </a>
        </div>

        <form action="{{ route('admin.users.update', $user) }}" method="POST" class="overflow-hidden rounded-2xl border th-border p-6 shadow-sm relative" style="background-color: var(--t-bg-card);">
            @csrf
            @method('PUT')
            
            <div class="pointer-events-none absolute -right-32 -top-32 h-64 w-64 rounded-full blur-[80px]" style="background-color: var(--t-orb-1); opacity: 0.2"></div>

            <div class="relative z-10 grid gap-6 md:grid-cols-2">
                <div>
                    <label class="mb-2 block text-sm font-medium th-text">{{ __('messages.name') }}</label>
                    <input type="text" value="{{ $user->name }}" class="w-full rounded-xl border th-border px-4 py-2.5 outline-none transition-colors" style="background-color: var(--t-bg-input); color: var(--t-text-muted);" disabled>
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium th-text">{{ __('messages.email') }}</label>
                    <input type="email" value="{{ $user->email }}" class="w-full rounded-xl border th-border px-4 py-2.5 outline-none transition-colors" style="background-color: var(--t-bg-input); color: var(--t-text-muted);" disabled>
                </div>

                <div class="md:col-span-2 mt-4">
                    <label class="mb-3 block text-sm font-medium th-text">{{ __('messages.roles') }}</label>
                    <div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach($roles as $role)
                            <label class="flex cursor-pointer items-start gap-3 rounded-xl border th-border p-4 transition-all duration-200 hover:th-bg-hover hover:border-brand-500/30 relative overflow-hidden group">
                                <div class="mt-0.5">
                                    <input type="checkbox" name="roles[]" value="{{ $role->id }}" 
                                        class="peer h-4 w-4 rounded border-gray-300 text-brand-600 focus:ring-brand-500"
                                        {{ $user->roles->contains($role->id) ? 'checked' : '' }}>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold th-text">{{ $role->display_name ?? $role->name }}</p>
                                    <p class="text-[11px] th-text-muted mt-0.5 leading-relaxed">{{ $role->description ?? 'No description' }}</p>
                                </div>
                                <div class="absolute inset-x-0 bottom-0 h-0.5 bg-brand-500 opacity-0 transition-opacity peer-checked:opacity-100"></div>
                            </label>
                        @endforeach
                    </div>
                    @error('roles')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:col-span-2 mt-4">
                    <label class="mb-3 block text-sm font-medium th-text">{{ __('messages.account_status') }}</label>
                    <div class="flex items-center rounded-xl border th-border p-4" style="background-color: var(--t-bg-input);">
                        <label class="relative inline-flex cursor-pointer items-center">
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" name="is_active" value="1" class="peer sr-only" {{ $user->is_active ? 'checked' : '' }}>
                            <div class="peer h-6 w-11 rounded-full bg-gray-300 dark:bg-gray-700 after:absolute after:start-[2px] after:top-[2px] after:h-5 after:w-5 after:rounded-full after:border after:border-gray-300 after:bg-white after:transition-all after:content-[''] peer-checked:bg-green-500 peer-checked:after:translate-x-full peer-checked:after:border-white rtl:peer-checked:after:-translate-x-full"></div>
                            <span class="ms-4 text-sm font-medium th-text">
                                {{ __('messages.active') }}
                            </span>
                        </label>
                        <p class="ml-auto text-xs th-text-muted hidden sm:block">Toggle to activate or deactivate user account access</p>
                    </div>
                    @error('is_active')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="relative z-10 mt-8 flex justify-end gap-3 border-t th-border pt-6">
                <a href="{{ route('admin.users.index') }}" class="rounded-xl border th-border px-5 py-2.5 text-sm font-medium th-text transition-colors hover:th-bg-hover">
                    {{ __('messages.cancel') }}
                </a>
                <button type="submit" class="rounded-xl bg-gradient-to-r from-brand-600 to-brand-500 px-6 py-2.5 text-sm font-medium text-white shadow-lg shadow-brand-500/25 transition-all hover:-translate-y-0.5 hover:shadow-brand-500/40">
                    {{ __('messages.save_changes') }}
                </button>
            </div>
        </form>
    </div>
</x-layouts.app>
