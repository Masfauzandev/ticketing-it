<x-layouts.app>
    @section('page-title', 'Dashboard')
    @section('page-subtitle', 'Pilih modul yang ingin Anda akses')

    <div class="mx-auto max-w-6xl">

        {{-- ═══ Welcome Banner ═══ --}}
        <div
            class="relative mb-8 overflow-hidden rounded-2xl border border-white/[0.06] bg-gradient-to-br from-brand-600/20 via-surface-800 to-purple-600/10 p-8">
            {{-- Background decoration --}}
            <div
                class="pointer-events-none absolute -right-16 -top-16 h-64 w-64 rounded-full bg-brand-500/10 blur-[80px]">
            </div>
            <div
                class="pointer-events-none absolute -bottom-8 -left-8 h-48 w-48 rounded-full bg-purple-500/10 blur-[60px]">
            </div>

            <div class="relative z-10">
                <h1 class="text-2xl font-bold text-white">
                    Selamat Datang, <span
                        class="bg-gradient-to-r from-brand-400 to-purple-400 bg-clip-text text-transparent">{{ auth()->user()->name ?? 'User' }}</span>
                    👋
                </h1>
                <p class="mt-2 text-sm text-white/50">Pilih salah satu modul di bawah untuk memulai. Akses Anda
                    disesuaikan dengan role yang diberikan oleh administrator.</p>
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
                        {{-- ═══ Accessible Module Card ═══ --}}
                        <a href="{{ route($module['route']) }}"
                            class="group relative flex flex-col overflow-hidden rounded-2xl border border-white/[0.06] bg-surface-900/80 p-6 transition-all duration-300 hover:-translate-y-1 hover:border-white/[0.12] hover:shadow-2xl hover:shadow-brand-500/5">

                            {{-- Glow effect on hover --}}
                            <div class="pointer-events-none absolute -right-12 -top-12 h-40 w-40 rounded-full opacity-0 blur-[60px] transition-opacity duration-500 group-hover:opacity-100"
                                style="background-color: {{ $module['color'] }}20;"></div>

                            {{-- Header --}}
                            <div class="mb-4 flex items-center justify-between">
                                <div class="flex h-12 w-12 items-center justify-center rounded-xl transition-all duration-300 group-hover:scale-110"
                                    style="background-color: {{ $module['color'] }}15; color: {{ $module['color'] }};">
                                    <i class="{{ $module['icon'] }} text-xl"></i>
                                </div>
                                <div
                                    class="flex items-center gap-1 rounded-full border border-green-500/20 bg-green-500/10 px-2.5 py-1">
                                    <div class="h-1.5 w-1.5 rounded-full bg-green-400"></div>
                                    <span class="text-[10px] font-medium text-green-400">Aktif</span>
                                </div>
                            </div>

                            {{-- Content --}}
                            <h3 class="mb-1 text-lg font-semibold text-white transition-colors group-hover:text-brand-400">
                                {{ $module['name'] }}
                            </h3>
                            <p class="mb-4 flex-1 text-sm text-white/40">{{ $module['description'] }}</p>

                            {{-- Footer --}}
                            <div
                                class="flex items-center gap-2 text-xs font-medium text-white/30 transition-colors group-hover:text-brand-400">
                                <span>Buka Modul</span>
                                <svg class="h-3.5 w-3.5 transition-transform duration-300 group-hover:translate-x-1" fill="none"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                </svg>
                            </div>

                            {{-- Bottom accent line --}}
                            <div class="absolute bottom-0 left-0 h-[2px] w-0 transition-all duration-500 group-hover:w-full"
                                style="background: linear-gradient(to right, {{ $module['color'] }}, transparent);"></div>
                        </a>

                    @else
                        {{-- ═══ Locked Module Card ═══ --}}
                        <div
                            class="relative flex flex-col overflow-hidden rounded-2xl border border-white/[0.03] bg-surface-900/40 p-6 opacity-50">
                            <div class="mb-4 flex items-center justify-between">
                                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-white/5 text-white/20">
                                    <i class="{{ $module['icon'] }} text-xl"></i>
                                </div>
                                <div class="flex items-center gap-1 rounded-full border border-white/10 bg-white/5 px-2.5 py-1">
                                    <svg class="h-3 w-3 text-white/30" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                                    </svg>
                                    <span class="text-[10px] font-medium text-white/30">Terkunci</span>
                                </div>
                            </div>
                            <h3 class="mb-1 text-lg font-semibold text-white/30">{{ $module['name'] }}</h3>
                            <p class="mb-4 flex-1 text-sm text-white/20">{{ $module['description'] }}</p>
                            <p class="text-xs text-white/20">Hubungi administrator untuk akses.</p>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>

        {{-- ═══ Quick Stats (optional) ═══ --}}
        <div class="mt-8 grid gap-4 sm:grid-cols-4">
            @php
                $stats = [
                    ['label' => 'Total Tiket', 'value' => '—', 'icon' => 'fas fa-ticket-alt', 'color' => '#6366F1', 'trend' => null],
                    ['label' => 'Perangkat Online', 'value' => '—', 'icon' => 'fas fa-network-wired', 'color' => '#10B981', 'trend' => null],
                    ['label' => 'Total Aset', 'value' => '—', 'icon' => 'fas fa-laptop', 'color' => '#F59E0B', 'trend' => null],
                    ['label' => 'Artikel Guide', 'value' => '—', 'icon' => 'fas fa-book-open', 'color' => '#EF4444', 'trend' => null],
                ];
            @endphp

            @foreach($stats as $stat)
                <div class="flex items-center gap-4 rounded-xl border border-white/[0.06] bg-surface-900/50 p-4">
                    <div class="flex h-10 w-10 items-center justify-center rounded-lg"
                        style="background-color: {{ $stat['color'] }}15; color: {{ $stat['color'] }};">
                        <i class="{{ $stat['icon'] }} text-sm"></i>
                    </div>
                    <div>
                        <p class="text-lg font-bold text-white">{{ $stat['value'] }}</p>
                        <p class="text-xs text-white/40">{{ $stat['label'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>

    </div>

</x-layouts.app>