<x-layouts.app>
    @section('page-title', __('messages.manage_roles'))
    @section('page-subtitle', __('messages.edit_role'))

    <div class="mx-auto max-w-4xl">
        <div class="mb-6 flex items-center justify-between">
            <h2 class="text-xl font-bold th-text">{{ __('messages.edit_role') }}: {{ $role->display_name ?? $role->name }}</h2>
            <a href="{{ route('admin.roles.index') }}" class="inline-flex items-center gap-2 text-sm font-medium th-text-secondary hover:text-brand-500 transition-colors">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                </svg>
                {{ __('messages.back') }}
            </a>
        </div>

        <form action="{{ route('admin.roles.update', $role) }}" method="POST" class="overflow-hidden rounded-2xl border th-border p-6 shadow-sm relative" style="background-color: var(--t-bg-card);">
            @csrf
            @method('PUT')
            
            <div class="pointer-events-none absolute -left-32 -bottom-32 h-64 w-64 rounded-full blur-[80px]" style="background-color: var(--t-orb-2); opacity: 0.2"></div>

            <div class="relative z-10 grid gap-6 md:grid-cols-2">
                <div>
                    <label class="mb-2 block text-sm font-medium th-text">{{ __('messages.role_name') }}</label>
                    <input type="text" name="name" value="{{ $role->name }}" class="w-full rounded-xl border th-border px-4 py-2.5 outline-none transition-colors" style="background-color: var(--t-bg-input); color: var(--t-text-muted);" readonly>
                    <p class="mt-1 text-[11px] th-text-muted">System name cannot be changed.</p>
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium th-text">{{ __('messages.display_name') }}</label>
                    <input type="text" name="display_name" value="{{ old('display_name', $role->display_name) }}" class="w-full rounded-xl border th-border bg-transparent px-4 py-2.5 th-text outline-none transition-colors focus:border-brand-500 focus:ring-1 focus:ring-brand-500">
                    @error('display_name')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="md:col-span-2">
                    <label class="mb-2 block text-sm font-medium th-text">{{ __('messages.description') }}</label>
                    <textarea name="description" rows="2" class="w-full rounded-xl border th-border bg-transparent px-4 py-2.5 th-text outline-none transition-colors focus:border-brand-500 focus:ring-1 focus:ring-brand-500">{{ old('description', $role->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:col-span-2 mt-4">
                    <div class="mb-4 flex items-center justify-between border-b th-border pb-3">
                        <label class="block text-base font-semibold th-text">{{ __('messages.permissions') }}</label>
                    </div>
                    
                    <div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach($permissions as $permission)
                            <label class="flex cursor-pointer items-start gap-3 rounded-xl border th-border p-4 transition-all duration-200 hover:th-bg-hover hover:border-brand-500/30 relative overflow-hidden group" style="background-color: var(--t-bg-input);">
                                <div class="mt-0.5">
                                    <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" 
                                        class="peer h-4 w-4 rounded border-gray-300 text-brand-600 focus:ring-brand-500"
                                        {{ $role->permissions->contains($permission->id) ? 'checked' : '' }}>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold th-text">{{ $permission->display_name ?? $permission->name }}</p>
                                    <p class="text-[11px] th-text-muted mt-0.5 leading-relaxed">{{ $permission->description ?? '' }}</p>
                                </div>
                                <div class="absolute inset-x-0 bottom-0 h-0.5 bg-brand-500 opacity-0 transition-opacity peer-checked:opacity-100"></div>
                            </label>
                        @endforeach
                    </div>
                    @error('permissions')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="relative z-10 mt-8 flex justify-end gap-3 border-t th-border pt-6">
                <a href="{{ route('admin.roles.index') }}" class="rounded-xl border th-border px-5 py-2.5 text-sm font-medium th-text transition-colors hover:th-bg-hover">
                    {{ __('messages.cancel') }}
                </a>
                <button type="submit" class="rounded-xl bg-gradient-to-r from-brand-600 to-brand-500 px-6 py-2.5 text-sm font-medium text-white shadow-lg shadow-brand-500/25 transition-all hover:-translate-y-0.5 hover:shadow-brand-500/40">
                    {{ __('messages.save_changes') }}
                </button>
            </div>
        </form>
    </div>
</x-layouts.app>
