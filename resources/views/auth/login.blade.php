<x-layouts.auth>
    @section('title', __('messages.login_title'))

    <div class="flex min-h-[calc(100vh-8rem)] items-center justify-center px-4 py-8">

        {{-- ═══ Login Card ═══ --}}
        <div class="animate-slide-up w-full max-w-md">

            {{-- Logo & Header --}}
            <div class="mb-8 text-center">
                <div
                    class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-gradient-to-br from-brand-500 to-brand-700 shadow-xl shadow-brand-500/25">
                    <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0V12a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 12V5.25" />
                    </svg>
                </div>
                <h1 class="text-2xl font-bold tracking-tight th-text">{{ __('messages.app_name') }}</h1>
                <p class="mt-1 text-sm th-text-muted">{{ __('messages.login_subtitle') }}</p>
            </div>

            {{-- Card Body --}}
            <div class="rounded-2xl border p-8 th-shadow-lg backdrop-blur-xl transition-colors duration-300"
                style="background-color: var(--t-bg-card); border-color: var(--t-border);">

                {{-- Errors --}}
                @if($errors->any())
                    <div class="mb-6 flex items-start gap-3 rounded-xl border border-red-500/20 bg-red-500/10 px-4 py-3">
                        <svg class="mt-0.5 h-5 w-5 shrink-0 text-red-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                        </svg>
                        <div>
                            @foreach($errors->all() as $error)
                                <p class="text-sm text-red-500">{{ $error }}</p>
                            @endforeach
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ url('/login') }}" class="space-y-5" x-data="{ showPassword: false }">
                    @csrf

                    {{-- Email / Username --}}
                    <div>
                        <label for="login"
                            class="mb-1.5 block text-xs font-semibold uppercase tracking-wider th-text-muted">
                            {{ __('messages.email_or_username') }}
                        </label>
                        <div class="relative">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                                <svg class="h-4 w-4 th-text-faint" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                </svg>
                            </div>
                            <input type="text" id="login" name="login" value="{{ old('login') }}" required autofocus
                                class="th-input w-full rounded-xl border py-3 pl-11 pr-4 text-sm transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-brand-500/20"
                                placeholder="admin@company.com">
                        </div>
                    </div>

                    {{-- Password --}}
                    <div>
                        <label for="password"
                            class="mb-1.5 block text-xs font-semibold uppercase tracking-wider th-text-muted">
                            {{ __('messages.password') }}
                        </label>
                        <div class="relative">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                                <svg class="h-4 w-4 th-text-faint" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                                </svg>
                            </div>
                            <input :type="showPassword ? 'text' : 'password'" id="password" name="password" required
                                class="th-input w-full rounded-xl border py-3 pl-11 pr-12 text-sm transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-brand-500/20"
                                placeholder="••••••••">
                            <button type="button" @click="showPassword = !showPassword"
                                class="absolute inset-y-0 right-0 flex items-center pr-4 th-text-faint hover:th-text-secondary transition">
                                <svg x-show="!showPassword" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                                <svg x-show="showPassword" x-cloak class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    {{-- Remember & Forgot --}}
                    <div class="flex items-center justify-between">
                        <label class="flex cursor-pointer items-center gap-2">
                            <input type="checkbox" name="remember"
                                class="h-4 w-4 rounded border-gray-300 text-brand-500 focus:ring-brand-500/20 focus:ring-offset-0 dark:border-white/20 dark:bg-white/5">
                            <span class="text-xs th-text-muted">{{ __('messages.remember_me') }}</span>
                        </label>
                        <a href="{{ url('/forgot-password') }}"
                            class="text-xs font-medium text-brand-500 hover:text-brand-400 transition">
                            {{ __('messages.forgot_password') }}
                        </a>
                    </div>

                    {{-- Submit --}}
                    <button type="submit"
                        class="group relative w-full overflow-hidden rounded-xl bg-gradient-to-r from-brand-600 to-brand-500 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-brand-500/25 transition-all duration-300 hover:shadow-xl hover:shadow-brand-500/30 active:scale-[0.98]">
                        <span class="relative z-10 flex items-center justify-center gap-2">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
                            </svg>
                            {{ __('messages.login_btn') }}
                        </span>
                        <div
                            class="absolute inset-0 -translate-x-full bg-gradient-to-r from-transparent via-white/10 to-transparent transition-transform duration-700 group-hover:translate-x-full">
                        </div>
                    </button>
                </form>

                {{-- Register Link --}}
                <div class="mt-6 text-center">
                    <p class="text-sm th-text-muted">
                        {{ __('messages.no_account') }}
                        <a href="{{ url('/register') }}"
                            class="font-medium text-brand-500 hover:text-brand-400 transition">{{ __('messages.register_now') }}</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

</x-layouts.auth>