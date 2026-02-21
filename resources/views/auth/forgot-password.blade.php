<x-layouts.auth>
    @section('title', __('messages.forgot_password'))

    <div class="flex min-h-[calc(100vh-8rem)] items-center justify-center px-4 py-8">

        <div class="animate-slide-up w-full max-w-md">

            {{-- Header --}}
            <div class="mb-8 text-center">
                <div
                    class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-gradient-to-br from-amber-500 to-orange-600 shadow-xl shadow-amber-500/25">
                    <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 5.25a3 3 0 0 1 3 3m3 0a6 6 0 0 1-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1 1 21.75 8.25Z" />
                    </svg>
                </div>
                <h1 class="text-2xl font-bold tracking-tight th-text">{{ __('messages.forgot_title') }}</h1>
                <p class="mt-1 text-sm th-text-muted">{{ __('messages.forgot_subtitle') }}</p>
            </div>

            {{-- Card --}}
            <div class="rounded-2xl border p-8 th-shadow-lg backdrop-blur-xl transition-colors duration-300"
                style="background-color: var(--t-bg-card); border-color: var(--t-border);">

                {{-- Info Alert --}}
                <div class="mb-6 flex items-start gap-3 rounded-xl border border-blue-500/20 bg-blue-500/10 px-4 py-3">
                    <svg class="mt-0.5 h-5 w-5 shrink-0 text-blue-500" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                    </svg>
                    <p class="text-xs text-blue-600 dark:text-blue-400 leading-relaxed">
                        {{ __('messages.forgot_info') }}
                    </p>
                </div>

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

                <form method="POST" action="{{ url('/forgot-password') }}" class="space-y-5">
                    @csrf

                    {{-- Username --}}
                    <div>
                        <label for="username"
                            class="mb-1.5 block text-xs font-semibold uppercase tracking-wider th-text-muted">
                            {{ __('messages.username') }} <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                                <svg class="h-4 w-4 th-text-faint" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                </svg>
                            </div>
                            <input type="text" id="username" name="username" value="{{ old('username') }}" required
                                autofocus
                                class="th-input w-full rounded-xl border py-3 pl-11 pr-4 text-sm transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-brand-500/20"
                                placeholder="{{ __('messages.username_placeholder') }}">
                        </div>
                    </div>

                    {{-- Office Email --}}
                    <div>
                        <label for="email"
                            class="mb-1.5 block text-xs font-semibold uppercase tracking-wider th-text-muted">
                            {{ __('messages.office_email') }} <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                                <svg class="h-4 w-4 th-text-faint" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                                </svg>
                            </div>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                class="th-input w-full rounded-xl border py-3 pl-11 pr-4 text-sm transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-brand-500/20"
                                placeholder="nama@perusahaan.com">
                        </div>
                    </div>

                    {{-- Submit --}}
                    <button type="submit"
                        class="group relative w-full overflow-hidden rounded-xl bg-gradient-to-r from-amber-600 to-orange-500 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-amber-500/25 transition-all duration-300 hover:shadow-xl hover:shadow-amber-500/30 active:scale-[0.98]">
                        <span class="relative z-10 flex items-center justify-center gap-2">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                            </svg>
                            {{ __('messages.send_password') }}
                        </span>
                        <div
                            class="absolute inset-0 -translate-x-full bg-gradient-to-r from-transparent via-white/10 to-transparent transition-transform duration-700 group-hover:translate-x-full">
                        </div>
                    </button>
                </form>

                {{-- Back to Login --}}
                <div class="mt-6 text-center">
                    <a href="{{ url('/login') }}"
                        class="inline-flex items-center gap-1.5 text-sm font-medium text-brand-500 hover:text-brand-400 transition">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                        </svg>
                        {{ __('messages.back_to_login') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

</x-layouts.auth>