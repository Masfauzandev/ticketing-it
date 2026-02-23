<x-layouts.app>
    @section('page-title', 'Laporan Tiket')
    @section('page-subtitle', 'Ticketing System')

    <div class="mx-auto max-w-6xl">

        {{-- Back --}}
        <a href="{{ route('ticketing.index') }}"
            class="mb-6 inline-flex items-center gap-2 text-sm th-text-muted transition hover:text-brand-500">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
            Kembali ke Ticketing
        </a>

        <h1 class="mb-6 text-2xl font-bold th-text">Laporan Tiket</h1>

        {{-- ═══ Summary Stats ═══ --}}
        <div class="mb-6 grid gap-4 sm:grid-cols-3">
            <div class="rounded-2xl border p-5 transition-colors duration-300"
                style="background-color: var(--t-bg-card); border-color: var(--t-border);">
                <p class="text-3xl font-bold th-text">{{ $totalTickets }}</p>
                <p class="text-sm th-text-muted">Total Tiket</p>
            </div>
            <div class="rounded-2xl border p-5 transition-colors duration-300"
                style="background-color: var(--t-bg-card); border-color: var(--t-border);">
                <p class="text-3xl font-bold th-text">{{ $avgResolution ? round($avgResolution, 1) : '-' }}</p>
                <p class="text-sm th-text-muted">Rata-rata Resolusi (jam)</p>
            </div>
            <div class="rounded-2xl border p-5 transition-colors duration-300"
                style="background-color: var(--t-bg-card); border-color: var(--t-border);">
                @php $resolvedPct = $totalTickets > 0 ? round((($byStatus['resolved'] ?? 0) + ($byStatus['closed'] ?? 0)) / $totalTickets * 100) : 0; @endphp
                <p class="text-3xl font-bold th-text">{{ $resolvedPct }}%</p>
                <p class="text-sm th-text-muted">Tingkat Penyelesaian</p>
            </div>
        </div>

        <div class="grid gap-6 lg:grid-cols-2">

            {{-- ═══ By Status ═══ --}}
            <div class="rounded-2xl border p-6 transition-colors duration-300"
                style="background-color: var(--t-bg-card); border-color: var(--t-border);">
                <h3 class="mb-4 text-sm font-semibold uppercase tracking-wider th-text-muted">Per Status</h3>
                @php
                    $statusConfig = [
                        'open' => ['label' => 'Open', 'color' => '#F59E0B'],
                        'in_progress' => ['label' => 'In Progress', 'color' => '#3B82F6'],
                        'resolved' => ['label' => 'Resolved', 'color' => '#10B981'],
                        'closed' => ['label' => 'Closed', 'color' => '#6B7280'],
                    ];
                @endphp
                <div class="space-y-3">
                    @foreach($statusConfig as $key => $config)
                        @php $count = $byStatus[$key] ?? 0;
                        $pct = $totalTickets > 0 ? round($count / $totalTickets * 100) : 0; @endphp
                        <div>
                            <div class="mb-1 flex items-center justify-between">
                                <span class="text-sm th-text">{{ $config['label'] }}</span>
                                <span class="text-sm font-semibold th-text">{{ $count }}</span>
                            </div>
                            <div class="h-2 w-full rounded-full" style="background-color: var(--t-bg-input);">
                                <div class="h-2 rounded-full transition-all duration-700"
                                    style="width: {{ $pct }}%; background-color: {{ $config['color'] }};"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- ═══ By Priority ═══ --}}
            <div class="rounded-2xl border p-6 transition-colors duration-300"
                style="background-color: var(--t-bg-card); border-color: var(--t-border);">
                <h3 class="mb-4 text-sm font-semibold uppercase tracking-wider th-text-muted">Per Prioritas</h3>
                @php
                    $priorityConfig = [
                        'critical' => ['label' => 'Critical', 'color' => '#EF4444'],
                        'high' => ['label' => 'High', 'color' => '#F97316'],
                        'medium' => ['label' => 'Medium', 'color' => '#3B82F6'],
                        'low' => ['label' => 'Low', 'color' => '#6B7280'],
                    ];
                @endphp
                <div class="space-y-3">
                    @foreach($priorityConfig as $key => $config)
                        @php $count = $byPriority[$key] ?? 0;
                        $pct = $totalTickets > 0 ? round($count / $totalTickets * 100) : 0; @endphp
                        <div>
                            <div class="mb-1 flex items-center justify-between">
                                <span class="text-sm th-text">{{ $config['label'] }}</span>
                                <span class="text-sm font-semibold th-text">{{ $count }}</span>
                            </div>
                            <div class="h-2 w-full rounded-full" style="background-color: var(--t-bg-input);">
                                <div class="h-2 rounded-full transition-all duration-700"
                                    style="width: {{ $pct }}%; background-color: {{ $config['color'] }};"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- ═══ By Category ═══ --}}
            <div class="rounded-2xl border p-6 transition-colors duration-300"
                style="background-color: var(--t-bg-card); border-color: var(--t-border);">
                <h3 class="mb-4 text-sm font-semibold uppercase tracking-wider th-text-muted">Per Kategori</h3>
                <div class="space-y-3">
                    @forelse($byCategory as $cat)
                        @php $pct = $totalTickets > 0 ? round($cat->tickets_count / $totalTickets * 100) : 0; @endphp
                        <div>
                            <div class="mb-1 flex items-center justify-between">
                                <span class="text-sm th-text">{{ $cat->name }}</span>
                                <span class="text-sm font-semibold th-text">{{ $cat->tickets_count }}</span>
                            </div>
                            <div class="h-2 w-full rounded-full" style="background-color: var(--t-bg-input);">
                                <div class="h-2 rounded-full bg-brand-500 transition-all duration-700"
                                    style="width: {{ $pct }}%;"></div>
                            </div>
                        </div>
                    @empty
                        <p class="text-sm th-text-muted text-center">Belum ada data</p>
                    @endforelse
                </div>
            </div>

            {{-- ═══ Agent Performance ═══ --}}
            <div class="rounded-2xl border p-6 transition-colors duration-300"
                style="background-color: var(--t-bg-card); border-color: var(--t-border);">
                <h3 class="mb-4 text-sm font-semibold uppercase tracking-wider th-text-muted">Performa Agent</h3>
                <div class="space-y-3">
                    @forelse($agentStats as $agent)
                        <div class="flex items-center justify-between rounded-xl p-3 transition-colors hover:th-bg-hover">
                            <div class="flex items-center gap-3">
                                <div
                                    class="flex h-8 w-8 items-center justify-center rounded-full bg-gradient-to-br from-brand-500 to-purple-600 text-xs font-bold text-white">
                                    {{ strtoupper(substr($agent->callname ?: $agent->name, 0, 1)) }}
                                </div>
                                <div>
                                    <p class="text-sm font-medium th-text">{{ $agent->callname ?: $agent->name }}</p>
                                    <p class="text-xs th-text-muted">{{ $agent->total_assigned }} ditugaskan</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-semibold text-emerald-500">{{ $agent->resolved_count }}</p>
                                <p class="text-xs th-text-muted">selesai</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-sm th-text-muted text-center">Belum ada data agent</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

</x-layouts.app>