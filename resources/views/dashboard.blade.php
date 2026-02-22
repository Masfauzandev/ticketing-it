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
                    $moduleStatus = $module['status'] ?? 'nonaktif';

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

                    // Status config
                    $statusConfig = [
                        'aktif' => ['label' => __('messages.status_active'), 'bg' => 'bg-green-500/10', 'border' => 'border-green-500/20', 'text' => 'text-green-600 dark:text-green-400', 'dot' => 'bg-green-500', 'animate' => 'animate-pulse'],
                        'on_progress' => ['label' => __('messages.status_on_progress'), 'bg' => 'bg-amber-500/10', 'border' => 'border-amber-500/20', 'text' => 'text-amber-600 dark:text-amber-400', 'dot' => 'bg-amber-500', 'animate' => 'animate-pulse'],
                        'nonaktif' => ['label' => __('messages.status_nonactive'), 'bg' => 'bg-red-500/10', 'border' => 'border-red-500/20', 'text' => 'text-red-600 dark:text-red-400', 'dot' => 'bg-red-500', 'animate' => ''],
                    ];
                    $sc = $statusConfig[$moduleStatus] ?? $statusConfig['nonaktif'];
                @endphp

                <div class="animate-slide-up" style="animation-delay: {{ $delay }}ms;"
                    x-data="{ statusOpen: false, currentStatus: '{{ $moduleStatus }}' }">
                    @if($hasAccess && $moduleStatus === 'aktif')
                        <a href="{{ route($module['route']) }}"
                            class="group relative flex overflow-visible rounded-2xl border transition-all duration-300 hover:-translate-y-1 hover:th-shadow-lg"
                            style="background-color: var(--t-bg-card); border-color: var(--t-border);">
                            
                            {{-- Effects Container --}}
                            <div class="pointer-events-none absolute inset-0 overflow-hidden rounded-2xl">
                                {{-- Hover glow --}}
                                <div class="absolute -right-12 -top-12 h-40 w-40 rounded-full opacity-0 blur-[60px] transition-opacity duration-500 group-hover:opacity-100"
                                    style="background-color: {{ $module['color'] }}20;"></div>
                                {{-- Bottom accent line --}}
                                <div class="absolute bottom-0 left-0 h-[2px] w-0 transition-all duration-500 group-hover:w-full"
                                    style="background: linear-gradient(to right, {{ $module['color'] }}, transparent);"></div>
                            </div>

                            <div class="relative flex w-full p-6">
                                {{-- Icon --}}
                                <div class="mr-5 flex h-14 w-14 shrink-0 items-center justify-center rounded-xl transition-all duration-300 group-hover:scale-110"
                                    style="background-color: {{ $module['color'] }}12; color: {{ $module['color'] }};">
                                    {!! $icon !!}
                                </div>

                                {{-- Content --}}
                                <div class="flex flex-1 flex-col">
                                    <div class="mb-1 flex items-start justify-between">
                                        <h3 class="text-base font-semibold th-text transition-colors group-hover:text-brand-500">
                                            {{ $module['name'] }}</h3>
                                        
                                        <div class="flex items-center gap-2">
                                            <span class="flex items-center gap-1 rounded-full border {{ $sc['border'] }} {{ $sc['bg'] }} px-2 py-0.5">
                                                <span class="h-1.5 w-1.5 rounded-full {{ $sc['dot'] }} {{ $sc['animate'] }}"></span>
                                                <span class="text-[10px] font-medium {{ $sc['text'] }}">{{ $sc['label'] }}</span>
                                            </span>

                                            {{-- Admin Status Toggle --}}
                                            @if(auth()->check() && auth()->user()->hasRole('super_admin'))
                                                <div class="relative">
                                                    <button @click.prevent="statusOpen = !statusOpen"
                                                        class="rounded p-1 th-text-muted transition-colors hover:th-bg-hover">
                                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 0 1 1.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.559.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.894.149c-.424.07-.764.383-.929.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 0 1-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.398.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.109l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 0 1-.12-1.45l.527-.737c.25-.35.272-.806.108-1.204-.165-.397-.506-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.108-1.204l-.526-.738a1.125 1.125 0 0 1 .12-1.45l.773-.773a1.125 1.125 0 0 1 1.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894Z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                        </svg>
                                                    </button>
                                                    <div x-show="statusOpen" @click.away="statusOpen = false"
                                                        x-transition:enter="transition ease-out duration-150"
                                                        x-transition:enter-start="opacity-0 scale-95"
                                                        x-transition:enter-end="opacity-100 scale-100"
                                                        class="absolute right-0 top-full z-20 mt-1 w-40 rounded-xl border th-border p-1 th-shadow-lg"
                                                        style="background-color: var(--t-bg-card);">
                                                        @foreach(['aktif' => __('messages.status_active'), 'on_progress' => __('messages.status_on_progress'), 'nonaktif' => __('messages.status_nonactive')] as $statusKey => $statusLabel)
                                                            <button @click.prevent="updateModuleStatus('{{ $key }}', '{{ $statusKey }}', $el)"
                                                                class="flex w-full items-center gap-2 rounded-lg px-3 py-2 text-xs transition-colors hover:th-bg-hover {{ $moduleStatus === $statusKey ? 'font-semibold text-brand-500' : 'th-text-secondary' }}">
                                                                <span class="h-2 w-2 rounded-full {{ $statusConfig[$statusKey]['dot'] }}"></span>
                                                                {{ $statusLabel }}
                                                                @if($moduleStatus === $statusKey)
                                                                    <svg class="ml-auto h-3.5 w-3.5 text-brand-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                                                    </svg>
                                                                @endif
                                                            </button>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <p class="mb-3 text-sm th-text-muted leading-relaxed">{{ $module['description'] }}</p>
                                    <div class="mt-auto flex items-center justify-between">
                                        <span class="inline-flex items-center gap-1.5 rounded-lg px-2.5 py-1 text-xs font-medium"
                                            style="background-color: {{ $module['color'] }}08; color: {{ $module['color'] }};">
                                            {!! $icon !!}
                                            {{ $countLabel }}
                                        </span>
                                        <span class="flex items-center gap-1 text-xs font-medium th-text-faint transition-colors group-hover:text-brand-500">
                                            {{ __('messages.open_module') }}
                                            <svg class="h-3.5 w-3.5 transition-transform duration-300 group-hover:translate-x-1"
                                                fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @else
                        <div class="relative flex overflow-visible rounded-2xl border transition-colors duration-300"
                            style="background-color: var(--t-bg-card); border-color: {{ $moduleStatus === 'on_progress' ? $module['color'] . '30' : 'var(--t-border-light)' }};">
                            
                            <div class="relative flex w-full p-6 {{ $moduleStatus === 'nonaktif' ? 'opacity-50' : '' }}">
                                <div class="mr-5 flex h-14 w-14 shrink-0 items-center justify-center rounded-xl {{ $moduleStatus === 'on_progress' ? '' : 'th-text-faint' }}"
                                    style="background-color: {{ $moduleStatus === 'on_progress' ? $module['color'] . '12' : 'var(--t-bg-input)' }}; {{ $moduleStatus === 'on_progress' ? 'color: ' . $module['color'] : '' }}">
                                    {!! $icon !!}
                                </div>
                                <div class="flex flex-1 flex-col">
                                    <div class="mb-1 flex items-start justify-between">
                                        <h3 class="text-base font-semibold {{ $moduleStatus === 'on_progress' ? 'th-text' : 'th-text-faint' }}">{{ $module['name'] }}</h3>
                                        
                                        <div class="flex items-center gap-2">
                                            <span class="flex items-center gap-1 rounded-full border {{ $sc['border'] }} {{ $sc['bg'] }} px-2 py-0.5"
                                                {!! $moduleStatus === 'nonaktif' ? 'style="border-color: var(--t-border-light);"' : '' !!}>
                                                <span class="h-1.5 w-1.5 rounded-full {{ $sc['dot'] }} {{ $sc['animate'] }}"></span>
                                                <span class="text-[10px] font-medium {{ $sc['text'] }}">{{ $sc['label'] }}</span>
                                            </span>

                                            {{-- Admin Status Toggle --}}
                                            @if(auth()->check() && auth()->user()->hasRole('super_admin'))
                                                <div class="relative">
                                                    <button @click.prevent="statusOpen = !statusOpen"
                                                        class="rounded p-1 th-text-muted transition-colors hover:th-bg-hover">
                                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 0 1 1.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.559.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.894.149c-.424.07-.764.383-.929.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 0 1-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.398.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.109l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 0 1-.12-1.45l.527-.737c.25-.35.272-.806.108-1.204-.165-.397-.506-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.108-1.204l-.526-.738a1.125 1.125 0 0 1 .12-1.45l.773-.773a1.125 1.125 0 0 1 1.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894Z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                        </svg>
                                                    </button>
                                                    <div x-show="statusOpen" @click.away="statusOpen = false"
                                                        x-transition:enter="transition ease-out duration-150"
                                                        x-transition:enter-start="opacity-0 scale-95"
                                                        x-transition:enter-end="opacity-100 scale-100"
                                                        class="absolute right-0 top-full z-20 mt-1 w-40 rounded-xl border th-border p-1 th-shadow-lg"
                                                        style="background-color: var(--t-bg-card);">
                                                        @foreach(['aktif' => __('messages.status_active'), 'on_progress' => __('messages.status_on_progress'), 'nonaktif' => __('messages.status_nonactive')] as $statusKey => $statusLabel)
                                                            <button @click.prevent="updateModuleStatus('{{ $key }}', '{{ $statusKey }}', $el)"
                                                                class="flex w-full items-center gap-2 rounded-lg px-3 py-2 text-xs transition-colors hover:th-bg-hover {{ $moduleStatus === $statusKey ? 'font-semibold text-brand-500' : 'th-text-secondary' }}">
                                                                <span class="h-2 w-2 rounded-full {{ $statusConfig[$statusKey]['dot'] }}"></span>
                                                                {{ $statusLabel }}
                                                                @if($moduleStatus === $statusKey)
                                                                    <svg class="ml-auto h-3.5 w-3.5 text-brand-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                                                    </svg>
                                                                @endif
                                                            </button>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <p class="mb-3 text-sm {{ $moduleStatus === 'on_progress' ? 'th-text-muted' : 'th-text-faint' }}">{{ $module['description'] }}</p>
                                    <p class="mt-auto text-xs th-text-faint">
                                        @if($moduleStatus === 'nonaktif')
                                            {{ __('messages.contact_admin') }}
                                        @elseif($moduleStatus === 'on_progress')
                                            {{ __('messages.status_on_progress') }}...
                                        @else
                                            {{ __('messages.contact_admin') }}
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
            @endforeach
        </div>
    </div>

    {{-- Add System Modal Placeholder --}}
    <div id="addSystemModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/50 backdrop-blur-sm"
        onclick="if(event.target===this)this.classList.add('hidden')">
        <div class="w-full max-w-md rounded-2xl border p-6 th-shadow-lg"
            style="background-color: var(--t-bg-card); border-color: var(--t-border);">
            <div class="mb-4 flex items-center justify-between">
                <h3 class="text-lg font-semibold th-text">{{ __('messages.add_system') }}</h3>
                <button onclick="this.closest('#addSystemModal').classList.add('hidden')"
                    class="rounded-lg p-1.5 th-text-muted hover:th-bg-hover transition-colors">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <p class="text-sm th-text-muted">Fitur tambah sistem baru akan segera tersedia. Saat ini, sistem dikelola melalui file konfigurasi.</p>
            <div class="mt-6 flex justify-end">
                <button onclick="this.closest('#addSystemModal').classList.add('hidden')"
                    class="rounded-xl border px-4 py-2 text-sm font-medium th-text-secondary hover:th-bg-hover transition-colors"
                    style="border-color: var(--t-border);">
                    {{ __('messages.cancel') }}
                </button>
            </div>
        </div>
    </div>

@push('scripts')
<script>
function updateModuleStatus(module, status, btn) {
    fetch('{{ route("dashboard.module.status") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json',
        },
        body: JSON.stringify({ module, status })
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            window.location.reload();
        }
    })
    .catch(err => console.error(err));
}
</script>
@endpush

</x-layouts.app>