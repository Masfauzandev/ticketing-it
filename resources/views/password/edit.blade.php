<x-layouts.app>
    @section('page-title', __('messages.change_password'))
    @section('page-subtitle', __('messages.change_password_subtitle'))

    <div class="mx-auto max-w-2xl">

        {{-- Back Button --}}
        <a href="{{ route('profile.show') }}"
            class="mb-6 inline-flex items-center gap-2 text-sm font-medium th-text-muted transition-colors hover:text-brand-500">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
            {{ __('messages.back_to_profile') }}
        </a>

        {{-- ═══ Change Password Card ═══ --}}
        <div class="rounded-2xl border p-8 transition-colors duration-300"
            style="background-color: var(--t-bg-card); border-color: var(--t-border);">

            <div class="mb-6 flex items-center gap-3">
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-amber-500/10 text-amber-500">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-lg font-semibold th-text">{{ __('messages.change_password') }}</h2>
                    <p class="text-xs th-text-muted">{{ __('messages.change_password_subtitle') }}</p>
                </div>
            </div>

            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                @method('PUT')

                <div class="space-y-5">

                    {{-- Current Password --}}
                    <div>
                        <label for="current_password" class="mb-1.5 block text-sm font-medium th-text">
                            {{ __('messages.current_password') }} <span class="text-red-500">*</span>
                        </label>
                        <input type="password" id="current_password" name="current_password" required
                            class="w-full rounded-xl border px-4 py-2.5 text-sm transition-colors duration-200 th-text focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500/20"
                            style="background-color: var(--t-bg-input); border-color: var(--t-border);">
                        @error('current_password')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- New Password --}}
                    <div>
                        <label for="password" class="mb-1.5 block text-sm font-medium th-text">
                            {{ __('messages.new_password') }} <span class="text-red-500">*</span>
                        </label>
                        <input type="password" id="password" name="password" required
                            class="w-full rounded-xl border px-4 py-2.5 text-sm transition-colors duration-200 th-text focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500/20"
                            style="background-color: var(--t-bg-input); border-color: var(--t-border);"
                            placeholder="{{ __('messages.min_chars') }}">
                        @error('password')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Confirm New Password --}}
                    <div>
                        <label for="password_confirmation" class="mb-1.5 block text-sm font-medium th-text">
                            {{ __('messages.confirm_new_password') }} <span class="text-red-500">*</span>
                        </label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required
                            class="w-full rounded-xl border px-4 py-2.5 text-sm transition-colors duration-200 th-text focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500/20"
                            style="background-color: var(--t-bg-input); border-color: var(--t-border);">
                    </div>

                </div>

                {{-- Buttons --}}
                <div class="mt-12 flex items-center justify-end gap-3 border-t pt-6"
                    style="border-color: var(--t-border);">
                    <a href="{{ route('profile.show') }}"
                        class="rounded-xl border px-5 py-2.5 text-sm font-medium th-text-secondary transition-colors hover:th-bg-hover"
                        style="border-color: var(--t-border);">
                        {{ __('messages.cancel') }}
                    </a>
                    <button type="submit"
                        class="inline-flex items-center gap-2 rounded-xl bg-amber-600 px-5 py-2.5 text-sm font-semibold text-white shadow-lg shadow-amber-500/25 transition-all duration-200 hover:bg-amber-500 hover:shadow-amber-500/40 hover:-translate-y-0.5">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                        </svg>
                        {{ __('messages.update_password') }}
                    </button>
                </div>

            </form>
        </div>

    </div>

</x-layouts.app>