<x-layouts.app>
    @section('page-title', request('filter') === 'my' ? 'My Ticket' : (request('filter') === 'all' ? 'All Ticket' : 'Dashboard'))
    @section('page-subtitle', request('filter') === 'my' ? 'Daftar semua tiket yang telah Anda buat' : (request('filter') === 'all' ? 'Daftar seluruh tiket di dalam sistem' : 'Ringkasan dan statistik tiket support IT'))

    <div class="mx-auto max-w-7xl">

        {{-- ═══ Header ═══ --}}
        <div class="mb-6">
            <div>
                @if(request('filter') === 'my')
                    <h1 class="text-2xl font-bold th-text">My Ticket</h1>
                    <p class="mt-1 text-sm th-text-muted">Daftar semua tiket yang telah Anda buat</p>
                @elseif(request('filter') === 'all')
                    <h1 class="text-2xl font-bold th-text">All Ticket</h1>
                    <p class="mt-1 text-sm th-text-muted">Daftar seluruh tiket di dalam sistem</p>
                @endif
            </div>
        </div>

        {{-- ═══ Quick Stats ═══ --}}
        <div class="mb-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            {{-- Total --}}
            <div class="rounded-2xl border p-5 transition-colors duration-300"
                style="background-color: var(--t-bg-card); border-color: var(--t-border);">
                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-500/10 text-indigo-500">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6Z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-2xl font-bold th-text">{{ $stats['total'] }}</p>
                        <p class="text-xs th-text-muted">Total Tiket</p>
                    </div>
                </div>
            </div>
            {{-- Open --}}
            <div class="rounded-2xl border p-5 transition-colors duration-300"
                style="background-color: var(--t-bg-card); border-color: var(--t-border);">
                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-amber-500/10 text-amber-500">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-2xl font-bold th-text">{{ $stats['open'] }}</p>
                        <p class="text-xs th-text-muted">Open</p>
                    </div>
                </div>
            </div>
            {{-- In Progress --}}
            <div class="rounded-2xl border p-5 transition-colors duration-300"
                style="background-color: var(--t-bg-card); border-color: var(--t-border);">
                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-500/10 text-blue-500">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-2xl font-bold th-text">{{ $stats['in_progress'] }}</p>
                        <p class="text-xs th-text-muted">In Progress</p>
                    </div>
                </div>
            </div>
            {{-- Resolved --}}
            <div class="rounded-2xl border p-5 transition-colors duration-300"
                style="background-color: var(--t-bg-card); border-color: var(--t-border);">
                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-500/10 text-emerald-500">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-2xl font-bold th-text">{{ $stats['resolved'] + $stats['closed'] }}</p>
                        <p class="text-xs th-text-muted">Selesai</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- ═══ Filters ═══ --}}
        <div class="mb-6 rounded-2xl border p-4 transition-colors duration-300"
            style="background-color: var(--t-bg-card); border-color: var(--t-border);">
            <form method="GET" action="{{ route('ticketing.index') }}" class="flex flex-wrap items-center gap-3">
                {{-- Search --}}
                <div class="flex-1 min-w-[200px]">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari nomor tiket atau subjek..."
                        class="w-full rounded-xl border px-4 py-2.5 text-sm th-text transition-colors focus:border-brand-500 focus:outline-none focus:ring-1 focus:ring-brand-500"
                        style="background-color: var(--t-bg-input); border-color: var(--t-border);">
                </div>
                {{-- Status --}}
                <select name="status"
                    class="rounded-xl border px-4 py-2.5 text-sm th-text transition-colors focus:border-brand-500 focus:outline-none"
                    style="background-color: var(--t-bg-input); border-color: var(--t-border);">
                    <option value="">Semua Status</option>
                    <option value="open" {{ request('status') === 'open' ? 'selected' : '' }}>Open</option>
                    <option value="in_progress" {{ request('status') === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="resolved" {{ request('status') === 'resolved' ? 'selected' : '' }}>Resolved</option>
                    <option value="closed" {{ request('status') === 'closed' ? 'selected' : '' }}>Closed</option>
                </select>
                {{-- Priority --}}
                <select name="priority"
                    class="rounded-xl border px-4 py-2.5 text-sm th-text transition-colors focus:border-brand-500 focus:outline-none"
                    style="background-color: var(--t-bg-input); border-color: var(--t-border);">
                    <option value="">Semua Prioritas</option>
                    <option value="low" {{ request('priority') === 'low' ? 'selected' : '' }}>Low</option>
                    <option value="medium" {{ request('priority') === 'medium' ? 'selected' : '' }}>Medium</option>
                    <option value="high" {{ request('priority') === 'high' ? 'selected' : '' }}>High</option>
                    <option value="critical" {{ request('priority') === 'critical' ? 'selected' : '' }}>Critical</option>
                </select>
                {{-- Category --}}
                <select name="category"
                    class="rounded-xl border px-4 py-2.5 text-sm th-text transition-colors focus:border-brand-500 focus:outline-none"
                    style="background-color: var(--t-bg-input); border-color: var(--t-border);">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
                <button type="submit"
                    class="rounded-xl bg-brand-600 px-5 py-2.5 text-sm font-medium text-white transition hover:bg-brand-700">
                    Filter
                </button>
                @if(request()->hasAny(['search', 'status', 'priority', 'category']))
                    <a href="{{ route('ticketing.index') }}"
                        class="rounded-xl border px-4 py-2.5 text-sm th-text-secondary transition hover:th-bg-hover"
                        style="border-color: var(--t-border);">
                        Reset
                    </a>
                @endif
            </form>
        </div>

        {{-- ═══ Tickets Table ═══ --}}
        <div class="rounded-2xl border overflow-hidden transition-colors duration-300"
            style="background-color: var(--t-bg-card); border-color: var(--t-border);">

            @if($tickets->isEmpty())
                <div class="p-12 text-center">
                    <svg class="mx-auto h-16 w-16 th-text-faint" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 0 1 0 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 0 1 0-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375Z" />
                    </svg>
                    <h3 class="mt-4 text-lg font-semibold th-text">Belum ada tiket</h3>
                    <p class="mt-2 text-sm th-text-muted">Gunakan menu di samping untuk membuat tiket baru.</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b" style="border-color: var(--t-border);">
                                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider th-text-muted">No. Tiket</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider th-text-muted">Subject</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider th-text-muted">Kategori</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider th-text-muted">Prioritas</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider th-text-muted">Status</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider th-text-muted">Pembuat</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider th-text-muted">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y" style="border-color: var(--t-border);">
                            @foreach($tickets as $ticket)
                                @php
                                    $statusColors = [
                                        'open' => 'bg-amber-500/10 text-amber-600 dark:text-amber-400 border-amber-500/20',
                                        'in_progress' => 'bg-blue-500/10 text-blue-600 dark:text-blue-400 border-blue-500/20',
                                        'resolved' => 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border-emerald-500/20',
                                        'closed' => 'bg-gray-500/10 text-gray-600 dark:text-gray-400 border-gray-500/20',
                                    ];
                                    $statusLabels = [
                                        'open' => 'Open',
                                        'in_progress' => 'In Progress',
                                        'resolved' => 'Resolved',
                                        'closed' => 'Closed',
                                    ];
                                    $priorityColors = [
                                        'low' => 'bg-gray-500/10 text-gray-600 dark:text-gray-400',
                                        'medium' => 'bg-blue-500/10 text-blue-600 dark:text-blue-400',
                                        'high' => 'bg-orange-500/10 text-orange-600 dark:text-orange-400',
                                        'critical' => 'bg-red-500/10 text-red-600 dark:text-red-400',
                                    ];
                                @endphp
                                <tr class="transition-colors hover:th-bg-hover cursor-pointer"
                                    onclick="window.location='{{ route('ticketing.show', $ticket) }}'">
                                    <td class="px-6 py-4">
                                        <span class="font-mono text-sm font-semibold text-brand-500">{{ $ticket->ticket_number }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="font-medium th-text">{{ Str::limit($ticket->subject, 50) }}</span>
                                    </td>
                                    <td class="px-6 py-4 th-text-muted">{{ $ticket->category->name ?? '-' }}</td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex rounded-full border px-2 py-0.5 text-[11px] font-medium {{ $priorityColors[$ticket->priority] ?? '' }}">
                                            {{ ucfirst($ticket->priority) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center gap-1 rounded-full border px-2 py-0.5 text-[11px] font-medium {{ $statusColors[$ticket->status] ?? '' }}">
                                            <span class="h-1.5 w-1.5 rounded-full {{ $ticket->status === 'open' ? 'bg-amber-500' : ($ticket->status === 'in_progress' ? 'bg-blue-500 animate-pulse' : ($ticket->status === 'resolved' ? 'bg-emerald-500' : 'bg-gray-500')) }}"></span>
                                            {{ $statusLabels[$ticket->status] ?? $ticket->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 th-text-muted">{{ $ticket->creator->callname ?: $ticket->creator->name }}</td>
                                    <td class="px-6 py-4 text-xs th-text-muted">{{ $ticket->created_at->format('d M Y H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                @if($tickets->hasPages())
                    <div class="border-t px-6 py-4" style="border-color: var(--t-border);">
                        {{ $tickets->links() }}
                    </div>
                @endif
            @endif
        </div>
    </div>

</x-layouts.app>
