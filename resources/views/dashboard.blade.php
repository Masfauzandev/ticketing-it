<x-layouts.app>
    @section('page-title', __('messages.dashboard'))
    @section('page-subtitle', __('messages.choose_module'))

    <div class="mx-auto max-w-6xl">

        {{-- ═══ Welcome Banner ═══ --}}
        <div class="relative mb-8 overflow-hidden rounded-2xl border p-8 transition-colors duration-300"
            style="border-color: var(--t-border); background: linear-gradient(135deg, rgba(99,102,241,0.08), var(--t-bg-card), rgba(147,51,234,0.05));">
            <div class="pointer-events-none absolute -right-16 -top-16 h-64 w-64 rounded-full blur-[80px]"
                style="background-color: var(--t-orb-1);"></div>
            <div class="pointer-events-none absolute -bottom-8 -left-8 h-48 w-48 rounded-full blur-[60px]"
                style="background-color: var(--t-orb-2);"></div>
            <div class="relative z-10">
                <h1 class="text-2xl font-bold th-text">
                    {{ __('messages.welcome') }} <span
                        class="bg-gradient-to-r from-brand-500 to-purple-500 bg-clip-text text-transparent">{{ auth()->user()->name ?? 'User' }}</span>
                    👋
                </h1>
                <p class="mt-2 text-sm th-text-muted">{{ __('messages.welcome_subtitle') }}</p>
            </div>
        </div>

        {{-- ═══ Quick Stats ═══ --}}
        <div class="mb-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            {{-- Total Tickets --}}
            <div class="group relative overflow-hidden rounded-2xl border p-5 transition-all duration-300 hover:-translate-y-0.5 hover:th-shadow-lg"
                style="background-color: var(--t-bg-card); border-color: var(--t-border);">
                <div
                    class="pointer-events-none absolute -right-6 -top-6 h-24 w-24 rounded-full bg-indigo-500/10 blur-2xl transition-all group-hover:bg-indigo-500/20">
                </div>
                <div class="relative flex items-center gap-4">
                    <div
                        class="flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-500/10 text-indigo-500 transition-transform duration-300 group-hover:scale-110">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 0 1 0 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 0 1 0-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375Z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-2xl font-bold th-text">{{ $stats['total_tickets'] ?? 0 }}</p>
                        <p class="text-xs th-text-muted">{{ __('messages.total_tickets') }}</p>
                    </div>
                </div>
                <div class="mt-3 flex items-center gap-1 text-xs">
                    <span
                        class="inline-flex items-center gap-1 rounded-full bg-amber-500/10 px-2 py-0.5 font-medium text-amber-600 dark:text-amber-400">
                        <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                        {{ $stats['open_tickets'] ?? 0 }} {{ __('messages.open') }}
                    </span>
                </div>
            </div>

            {{-- Devices Online --}}
            <div class="group relative overflow-hidden rounded-2xl border p-5 transition-all duration-300 hover:-translate-y-0.5 hover:th-shadow-lg"
                style="background-color: var(--t-bg-card); border-color: var(--t-border);">
                <div
                    class="pointer-events-none absolute -right-6 -top-6 h-24 w-24 rounded-full bg-emerald-500/10 blur-2xl transition-all group-hover:bg-emerald-500/20">
                </div>
                <div class="relative flex items-center gap-4">
                    <div
                        class="flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-500/10 text-emerald-500 transition-transform duration-300 group-hover:scale-110">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8.288 15.038a5.25 5.25 0 0 1 7.424 0M5.106 11.856c3.807-3.808 9.98-3.808 13.788 0M1.924 8.674c5.565-5.565 14.587-5.565 20.152 0M12.53 18.22l-.53.53-.53-.53a.75.75 0 0 1 1.06 0Z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-2xl font-bold th-text">{{ $stats['devices_online'] ?? 0 }}<span
                                class="text-sm font-normal th-text-muted">/{{ $stats['devices_total'] ?? 0 }}</span></p>
                        <p class="text-xs th-text-muted">{{ __('messages.devices_online') }}</p>
                    </div>
                </div>
                <div class="mt-3">
                    @php $pct = ($stats['devices_total'] ?? 0) > 0 ? round(($stats['devices_online'] ?? 0) / $stats['devices_total'] * 100) : 0; @endphp
                    <div class="h-1.5 w-full rounded-full" style="background-color: var(--t-bg-input);">
                        <div class="h-1.5 rounded-full bg-emerald-500 transition-all duration-700"
                            style="width: {{ $pct }}%;"></div>
                    </div>
                </div>
            </div>

            {{-- Total Assets --}}
            <div class="group relative overflow-hidden rounded-2xl border p-5 transition-all duration-300 hover:-translate-y-0.5 hover:th-shadow-lg"
                style="background-color: var(--t-bg-card); border-color: var(--t-border);">
                <div
                    class="pointer-events-none absolute -right-6 -top-6 h-24 w-24 rounded-full bg-amber-500/10 blur-2xl transition-all group-hover:bg-amber-500/20">
                </div>
                <div class="relative flex items-center gap-4">
                    <div
                        class="flex h-12 w-12 items-center justify-center rounded-xl bg-amber-500/10 text-amber-500 transition-transform duration-300 group-hover:scale-110">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0V12a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 12V5.25" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-2xl font-bold th-text">{{ $stats['total_assets'] ?? 0 }}</p>
                        <p class="text-xs th-text-muted">{{ __('messages.total_assets') }}</p>
                    </div>
                </div>
                <div class="mt-3 flex items-center gap-1 text-xs">
                    <span
                        class="inline-flex items-center gap-1 rounded-full bg-blue-500/10 px-2 py-0.5 font-medium text-blue-600 dark:text-blue-400">
                        <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375" />
                        </svg>
                        {{ __('messages.managed') }}
                    </span>
                </div>
            </div>

            {{-- Guide Articles --}}
            <div class="group relative overflow-hidden rounded-2xl border p-5 transition-all duration-300 hover:-translate-y-0.5 hover:th-shadow-lg"
                style="background-color: var(--t-bg-card); border-color: var(--t-border);">
                <div
                    class="pointer-events-none absolute -right-6 -top-6 h-24 w-24 rounded-full bg-rose-500/10 blur-2xl transition-all group-hover:bg-rose-500/20">
                </div>
                <div class="relative flex items-center gap-4">
                    <div
                        class="flex h-12 w-12 items-center justify-center rounded-xl bg-rose-500/10 text-rose-500 transition-transform duration-300 group-hover:scale-110">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-2xl font-bold th-text">{{ $stats['guide_articles'] ?? 0 }}</p>
                        <p class="text-xs th-text-muted">{{ __('messages.guide_articles') }}</p>
                    </div>
                </div>
                <div class="mt-3 flex items-center gap-1 text-xs">
                    <span
                        class="inline-flex items-center gap-1 rounded-full bg-purple-500/10 px-2 py-0.5 font-medium text-purple-600 dark:text-purple-400">
                        <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342" />
                        </svg>
                        {{ __('messages.knowledge_base') }}
                    </span>
                </div>
            </div>
        </div>

        {{-- ═══ Module Cards Grid ═══ --}}
        @php $modules = config('modules', []);
        $index = 0; @endphp

        <h2 class="mb-4 text-lg font-semibold th-text">{{ __('messages.system_modules') }}</h2>

        <div class="grid gap-6 sm:grid-cols-2">
            @foreach($modules as $key => $module)
                @php
                    $hasAccess = auth()->check() && auth()->user()->hasPermission($module['permission']);
                    $delay = $index * 100;
                    $index++;

                    // SVG icons per module
                    $svgIcons = [
                        'ticketing' => '<svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 0 1 0 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 0 1 0-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375Z" /></svg>',
                        'monitoring' => '<svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.288 15.038a5.25 5.25 0 0 1 7.424 0M5.106 11.856c3.807-3.808 9.98-3.808 13.788 0M1.924 8.674c5.565-5.565 14.587-5.565 20.152 0M12.53 18.22l-.53.53-.53-.53a.75.75 0 0 1 1.06 0Z" /></svg>',
                        'asset' => '<svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0V12a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 12V5.25" /></svg>',
                        'userguide' => '<svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" /></svg>',
                    ];
                    $icon = $svgIcons[$key] ?? '<svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6Z" /></svg>';

                    // Module-specific count
                    $moduleCounts = [
                        'ticketing' => ($stats['total_tickets'] ?? 0) . ' ' . __('messages.total_tickets'),
                        'monitoring' => ($stats['devices_online'] ?? 0) . '/' . ($stats['devices_total'] ?? 0) . ' ' . __('messages.online'),
                        'asset' => ($stats['total_assets'] ?? 0) . ' ' . __('messages.items'),
                        'userguide' => ($stats['guide_articles'] ?? 0) . ' ' . __('messages.articles'),
                    ];
                    $countLabel = $moduleCounts[$key] ?? '';
                @endphp

                <div class="animate-slide-up" style="animation-delay: {{ $delay }}ms;">
                    @if($hasAccess)
                        <a href="{{ route($module['route']) }}"
                            class="group relative flex overflow-hidden rounded-2xl border p-6 transition-all duration-300 hover:-translate-y-1 hover:th-shadow-lg"
                            style="background-color: var(--t-bg-card); border-color: var(--t-border);">
                            {{-- Hover glow --}}
                            <div class="pointer-events-none absolute -right-12 -top-12 h-40 w-40 rounded-full opacity-0 blur-[60px] transition-opacity duration-500 group-hover:opacity-100"
                                style="background-color: {{ $module['color'] }}20;"></div>

                            {{-- Icon --}}
                            <div class="mr-5 flex h-14 w-14 shrink-0 items-center justify-center rounded-xl transition-all duration-300 group-hover:scale-110"
                                style="background-color: {{ $module['color'] }}12; color: {{ $module['color'] }};">
                                {!! $icon !!}
                            </div>

                            {{-- Content --}}
                            <div class="flex flex-1 flex-col">
                                <div class="mb-1 flex items-center justify-between">
                                    <h3 class="text-base font-semibold th-text transition-colors group-hover:text-brand-500">
                                        {{ $module['name'] }}</h3>
                                    <span
                                        class="flex items-center gap-1 rounded-full border border-green-500/20 bg-green-500/10 px-2 py-0.5">
                                        <span class="h-1.5 w-1.5 rounded-full bg-green-500 animate-pulse"></span>
                                        <span
                                            class="text-[10px] font-medium text-green-600 dark:text-green-400">{{ __('messages.active') }}</span>
                                    </span>
                                </div>
                                <p class="mb-3 text-sm th-text-muted leading-relaxed">{{ $module['description'] }}</p>
                                <div class="mt-auto flex items-center justify-between">
                                    <span class="inline-flex items-center gap-1.5 rounded-lg px-2.5 py-1 text-xs font-medium"
                                        style="background-color: {{ $module['color'] }}08; color: {{ $module['color'] }};">
                                        {!! $icon !!}
                                        {{ $countLabel }}
                                    </span>
                                    <span
                                        class="flex items-center gap-1 text-xs font-medium th-text-faint transition-colors group-hover:text-brand-500">
                                        {{ __('messages.open_module') }}
                                        <svg class="h-3.5 w-3.5 transition-transform duration-300 group-hover:translate-x-1"
                                            fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                        </svg>
                                    </span>
                                </div>
                            </div>

                            {{-- Bottom accent line --}}
                            <div class="absolute bottom-0 left-0 h-[2px] w-0 transition-all duration-500 group-hover:w-full"
                                style="background: linear-gradient(to right, {{ $module['color'] }}, transparent);"></div>
                        </a>
                    @else
                        <div class="relative flex overflow-hidden rounded-2xl border p-6 opacity-50 transition-colors duration-300"
                            style="background-color: var(--t-bg-card); border-color: var(--t-border-light);">
                            <div class="mr-5 flex h-14 w-14 shrink-0 items-center justify-center rounded-xl th-text-faint"
                                style="background-color: var(--t-bg-input);">
                                {!! $icon !!}
                            </div>
                            <div class="flex flex-1 flex-col">
                                <div class="mb-1 flex items-center justify-between">
                                    <h3 class="text-base font-semibold th-text-faint">{{ $module['name'] }}</h3>
                                    <span class="flex items-center gap-1 rounded-full border px-2 py-0.5 th-border"
                                        style="background-color: var(--t-bg-input);">
                                        <svg class="h-3 w-3 th-text-faint" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                                        </svg>
                                        <span class="text-[10px] font-medium th-text-faint">{{ __('messages.locked') }}</span>
                                    </span>
                                </div>
                                <p class="mb-3 text-sm th-text-faint">{{ $module['description'] }}</p>
                                <p class="mt-auto text-xs th-text-faint">{{ __('messages.contact_admin') }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>

</x-layouts.app>