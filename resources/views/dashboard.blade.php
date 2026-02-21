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

        {{-- ═══ Module Cards Grid ═══ --}}
        @php $modules = config('modules', []);
        $index = 0; @endphp

        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-2">
            @foreach($modules as $key => $module)
                @php
                    $hasAccess = auth()->check() && auth()->user()->hasPermission($module['permission']);
                    $delay = $index * 100;
                    $index++;
                @endphp

                <div class="animate-slide-up" style="animation-delay: {{ $delay }}ms;">
                    @if($hasAccess)
                        <a href="{{ route($module['route']) }}"
                            class="group relative flex flex-col overflow-hidden rounded-2xl border p-6 transition-all duration-300 hover:-translate-y-1 hover:th-shadow-lg"
                            style="background-color: var(--t-bg-card); border-color: var(--t-border);">
                            <div class="pointer-events-none absolute -right-12 -top-12 h-40 w-40 rounded-full opacity-0 blur-[60px] transition-opacity duration-500 group-hover:opacity-100"
                                style="background-color: {{ $module['color'] }}20;"></div>
                            <div class="mb-4 flex items-center justify-between">
                                <div class="flex h-12 w-12 items-center justify-center rounded-xl transition-all duration-300 group-hover:scale-110"
                                    style="background-color: {{ $module['color'] }}12; color: {{ $module['color'] }};">
                                    <i class="{{ $module['icon'] }} text-xl"></i>
                                </div>
                                <div
                                    class="flex items-center gap-1 rounded-full border border-green-500/20 bg-green-500/10 px-2.5 py-1">
                                    <div class="h-1.5 w-1.5 rounded-full bg-green-500"></div>
                                    <span
                                        class="text-[10px] font-medium text-green-600 dark:text-green-400">{{ __('messages.active') }}</span>
                                </div>
                            </div>
                            <h3 class="mb-1 text-lg font-semibold th-text transition-colors group-hover:text-brand-500">
                                {{ $module['name'] }}</h3>
                            <p class="mb-4 flex-1 text-sm th-text-muted">{{ $module['description'] }}</p>
                            <div
                                class="flex items-center gap-2 text-xs font-medium th-text-faint transition-colors group-hover:text-brand-500">
                                <span>{{ __('messages.open_module') }}</span>
                                <svg class="h-3.5 w-3.5 transition-transform duration-300 group-hover:translate-x-1" fill="none"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                </svg>
                            </div>
                            <div class="absolute bottom-0 left-0 h-[2px] w-0 transition-all duration-500 group-hover:w-full"
                                style="background: linear-gradient(to right, {{ $module['color'] }}, transparent);"></div>
                        </a>
                    @else
                        <div class="relative flex flex-col overflow-hidden rounded-2xl border p-6 opacity-50 transition-colors duration-300"
                            style="background-color: var(--t-bg-card); border-color: var(--t-border-light);">
                            <div class="mb-4 flex items-center justify-between">
                                <div class="flex h-12 w-12 items-center justify-center rounded-xl th-text-faint"
                                    style="background-color: var(--t-bg-input);">
                                    <i class="{{ $module['icon'] }} text-xl"></i>
                                </div>
                                <div class="flex items-center gap-1 rounded-full border px-2.5 py-1 th-border"
                                    style="background-color: var(--t-bg-input);">
                                    <svg class="h-3 w-3 th-text-faint" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                                    </svg>
                                    <span class="text-[10px] font-medium th-text-faint">{{ __('messages.locked') }}</span>
                                </div>
                            </div>
                            <h3 class="mb-1 text-lg font-semibold th-text-faint">{{ $module['name'] }}</h3>
                            <p class="mb-4 flex-1 text-sm th-text-faint">{{ $module['description'] }}</p>
                            <p class="text-xs th-text-faint">{{ __('messages.contact_admin') }}</p>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>

        {{-- ═══ Quick Stats ═══ --}}
        <div class="mt-8 grid gap-4 sm:grid-cols-4">
            @php
                $stats = [
                    ['label' => __('messages.total_tickets'), 'value' => '—', 'icon' => 'fas fa-ticket-alt', 'color' => '#6366F1'],
                    ['label' => __('messages.devices_online'), 'value' => '—', 'icon' => 'fas fa-network-wired', 'color' => '#10B981'],
                    ['label' => __('messages.total_assets'), 'value' => '—', 'icon' => 'fas fa-laptop', 'color' => '#F59E0B'],
                    ['label' => __('messages.guide_articles'), 'value' => '—', 'icon' => 'fas fa-book-open', 'color' => '#EF4444'],
                ];
            @endphp

            @foreach($stats as $stat)
                <div class="flex items-center gap-4 rounded-xl border p-4 transition-colors duration-300"
                    style="background-color: var(--t-bg-card); border-color: var(--t-border);">
                    <div class="flex h-10 w-10 items-center justify-center rounded-lg"
                        style="background-color: {{ $stat['color'] }}12; color: {{ $stat['color'] }};">
                        <i class="{{ $stat['icon'] }} text-sm"></i>
                    </div>
                    <div>
                        <p class="text-lg font-bold th-text">{{ $stat['value'] }}</p>
                        <p class="text-xs th-text-muted">{{ $stat['label'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</x-layouts.app>