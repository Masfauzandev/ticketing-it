<x-layouts.app>
    @section('page-title', $ticket->ticket_number)
    @section('page-subtitle', 'Detail Tiket')

    @php
        $statusColors = [
            'open' => 'bg-amber-500/10 text-amber-600 dark:text-amber-400 border-amber-500/20',
            'in_progress' => 'bg-blue-500/10 text-blue-600 dark:text-blue-400 border-blue-500/20',
            'resolved' => 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border-emerald-500/20',
            'closed' => 'bg-gray-500/10 text-gray-600 dark:text-gray-400 border-gray-500/20',
        ];
        $statusLabels = ['open' => 'Open', 'in_progress' => 'In Progress', 'resolved' => 'Resolved', 'closed' => 'Closed'];
        $priorityColors = [
            'low' => 'bg-gray-500/10 text-gray-600 dark:text-gray-400',
            'medium' => 'bg-blue-500/10 text-blue-600 dark:text-blue-400',
            'high' => 'bg-orange-500/10 text-orange-600 dark:text-orange-400',
            'critical' => 'bg-red-500/10 text-red-600 dark:text-red-400',
        ];
        $isAdmin = auth()->user()->hasRole('super_admin') || auth()->user()->hasRole('admin') || auth()->user()->hasRole('agent');
    @endphp

    <div class="mx-auto max-w-5xl">

        {{-- Back --}}
        <a href="{{ route('ticketing.index') }}"
            class="mb-6 inline-flex items-center gap-2 text-sm th-text-muted transition hover:text-brand-500">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
            Kembali ke Daftar Tiket
        </a>

        <div class="grid gap-6 lg:grid-cols-3">

            {{-- ═══ Main Content (2/3) ═══ --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- Ticket Header --}}
                <div class="rounded-2xl border p-6 transition-colors duration-300"
                    style="background-color: var(--t-bg-card); border-color: var(--t-border);">
                    <div class="flex flex-wrap items-start justify-between gap-3">
                        <div>
                            <span class="font-mono text-sm font-semibold text-brand-500">{{ $ticket->ticket_number }}</span>
                            <h1 class="mt-1 text-xl font-bold th-text">{{ $ticket->subject }}</h1>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="inline-flex items-center gap-1 rounded-full border px-2.5 py-1 text-xs font-medium {{ $priorityColors[$ticket->priority] ?? '' }}">
                                {{ ucfirst($ticket->priority) }}
                            </span>
                            <span class="inline-flex items-center gap-1.5 rounded-full border px-2.5 py-1 text-xs font-medium {{ $statusColors[$ticket->status] ?? '' }}">
                                <span class="h-1.5 w-1.5 rounded-full {{ $ticket->status === 'open' ? 'bg-amber-500' : ($ticket->status === 'in_progress' ? 'bg-blue-500 animate-pulse' : ($ticket->status === 'resolved' ? 'bg-emerald-500' : 'bg-gray-500')) }}"></span>
                                {{ $statusLabels[$ticket->status] ?? $ticket->status }}
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Description --}}
                <div class="rounded-2xl border p-6 transition-colors duration-300"
                    style="background-color: var(--t-bg-card); border-color: var(--t-border);">
                    <h3 class="mb-4 text-sm font-semibold uppercase tracking-wider th-text-muted">Deskripsi</h3>
                    <div class="prose prose-sm max-w-none th-text leading-relaxed">
                        {!! nl2br(e($ticket->description)) !!}
                    </div>
                </div>

                {{-- Attachments --}}
                @if($ticket->attachments->isNotEmpty())
                    <div class="rounded-2xl border p-6 transition-colors duration-300"
                        style="background-color: var(--t-bg-card); border-color: var(--t-border);">
                        <h3 class="mb-4 text-sm font-semibold uppercase tracking-wider th-text-muted">Lampiran</h3>
                        <div class="grid gap-2 sm:grid-cols-2">
                            @foreach($ticket->attachments->whereNull('comment_id') as $attachment)
                                <a href="{{ asset('storage/' . $attachment->path) }}" target="_blank"
                                    class="flex items-center gap-3 rounded-xl border p-3 transition-colors hover:th-bg-hover"
                                    style="border-color: var(--t-border);">
                                    <svg class="h-8 w-8 text-brand-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                    </svg>
                                    <div class="min-w-0">
                                        <p class="truncate text-sm font-medium th-text">{{ $attachment->filename }}</p>
                                        <p class="text-xs th-text-muted">{{ number_format($attachment->size / 1024, 1) }} KB</p>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Comments --}}
                <div class="rounded-2xl border p-6 transition-colors duration-300"
                    style="background-color: var(--t-bg-card); border-color: var(--t-border);">
                    <h3 class="mb-4 text-sm font-semibold uppercase tracking-wider th-text-muted">
                        Komentar ({{ $ticket->comments->count() }})
                    </h3>

                    @forelse($ticket->comments as $comment)
                        <div class="mb-4 rounded-xl border p-4 {{ $comment->is_internal ? 'border-amber-500/20 bg-amber-500/5' : '' }}"
                            style="{{ !$comment->is_internal ? 'border-color: var(--t-border);' : '' }}">
                            <div class="mb-2 flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <div class="flex h-7 w-7 items-center justify-center rounded-full bg-gradient-to-br from-brand-500 to-purple-600 text-[10px] font-bold text-white">
                                        {{ strtoupper(substr($comment->user->callname ?: $comment->user->name, 0, 1)) }}
                                    </div>
                                    <span class="text-sm font-medium th-text">{{ $comment->user->callname ?: $comment->user->name }}</span>
                                    @if($comment->is_internal)
                                        <span class="rounded-full bg-amber-500/10 px-2 py-0.5 text-[10px] font-medium text-amber-600 dark:text-amber-400">Internal</span>
                                    @endif
                                </div>
                                <span class="text-xs th-text-muted">{{ $comment->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-sm th-text leading-relaxed">{{ $comment->body }}</p>
                        </div>
                    @empty
                        <p class="text-sm th-text-muted text-center py-4">Belum ada komentar</p>
                    @endforelse

                    {{-- Add Comment Form --}}
                    @if($ticket->status !== 'closed')
                        <form action="{{ route('ticketing.update', $ticket) }}" method="POST" class="mt-4 border-t pt-4" style="border-color: var(--t-border);">
                            @csrf
                            @method('PUT')
                            <textarea name="comment" rows="3" required
                                placeholder="Tulis komentar..."
                                class="w-full rounded-xl border px-4 py-3 text-sm th-text transition-colors focus:border-brand-500 focus:outline-none focus:ring-1 focus:ring-brand-500 resize-y"
                                style="background-color: var(--t-bg-input); border-color: var(--t-border);"></textarea>
                            <div class="mt-3 flex items-center justify-between">
                                @if($isAdmin)
                                    <label class="flex items-center gap-2 text-sm th-text-muted">
                                        <input type="checkbox" name="is_internal" value="1"
                                            class="rounded border-gray-300 text-brand-600 focus:ring-brand-500">
                                        Internal note
                                    </label>
                                @else
                                    <div></div>
                                @endif
                                <button type="submit"
                                    class="rounded-xl bg-brand-600 px-5 py-2 text-sm font-medium text-white transition hover:bg-brand-700">
                                    Kirim Komentar
                                </button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>

            {{-- ═══ Sidebar (1/3) ═══ --}}
            <div class="space-y-6">

                {{-- Ticket Info --}}
                <div class="rounded-2xl border p-6 transition-colors duration-300"
                    style="background-color: var(--t-bg-card); border-color: var(--t-border);">
                    <h3 class="mb-4 text-sm font-semibold uppercase tracking-wider th-text-muted">Informasi Tiket</h3>
                    <div class="space-y-4">
                        <div>
                            <p class="text-xs th-text-muted">Pembuat</p>
                            <p class="text-sm font-medium th-text">{{ $ticket->creator->callname ?: $ticket->creator->name }}</p>
                        </div>
                        <div>
                            <p class="text-xs th-text-muted">Ditugaskan ke</p>
                            <p class="text-sm font-medium th-text">{{ $ticket->assignee ? ($ticket->assignee->callname ?: $ticket->assignee->name) : 'Belum ditugaskan' }}</p>
                        </div>
                        <div>
                            <p class="text-xs th-text-muted">Kategori</p>
                            <p class="text-sm font-medium th-text">{{ $ticket->category->name ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs th-text-muted">Dibuat</p>
                            <p class="text-sm font-medium th-text">{{ $ticket->created_at->translatedFormat('d F Y, H:i') }}</p>
                        </div>
                        @if($ticket->resolved_at)
                            <div>
                                <p class="text-xs th-text-muted">Diselesaikan</p>
                                <p class="text-sm font-medium th-text">{{ $ticket->resolved_at->translatedFormat('d F Y, H:i') }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Admin Actions --}}
                @if($isAdmin && $ticket->status !== 'closed')
                    <div class="rounded-2xl border p-6 transition-colors duration-300"
                        style="background-color: var(--t-bg-card); border-color: var(--t-border);">
                        <h3 class="mb-4 text-sm font-semibold uppercase tracking-wider th-text-muted">Aksi</h3>

                        <form action="{{ route('ticketing.update', $ticket) }}" method="POST" class="space-y-4">
                            @csrf
                            @method('PUT')

                            {{-- Status --}}
                            <div>
                                <label class="mb-1.5 block text-xs font-medium th-text-muted">Ubah Status</label>
                                <select name="status"
                                    class="w-full rounded-xl border px-3 py-2 text-sm th-text focus:border-brand-500 focus:outline-none"
                                    style="background-color: var(--t-bg-input); border-color: var(--t-border);">
                                    <option value="open" {{ $ticket->status === 'open' ? 'selected' : '' }}>Open</option>
                                    <option value="in_progress" {{ $ticket->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                    <option value="resolved" {{ $ticket->status === 'resolved' ? 'selected' : '' }}>Resolved</option>
                                    <option value="closed" {{ $ticket->status === 'closed' ? 'selected' : '' }}>Closed</option>
                                </select>
                            </div>

                            {{-- Priority --}}
                            <div>
                                <label class="mb-1.5 block text-xs font-medium th-text-muted">Ubah Prioritas</label>
                                <select name="priority"
                                    class="w-full rounded-xl border px-3 py-2 text-sm th-text focus:border-brand-500 focus:outline-none"
                                    style="background-color: var(--t-bg-input); border-color: var(--t-border);">
                                    <option value="low" {{ $ticket->priority === 'low' ? 'selected' : '' }}>Low</option>
                                    <option value="medium" {{ $ticket->priority === 'medium' ? 'selected' : '' }}>Medium</option>
                                    <option value="high" {{ $ticket->priority === 'high' ? 'selected' : '' }}>High</option>
                                    <option value="critical" {{ $ticket->priority === 'critical' ? 'selected' : '' }}>Critical</option>
                                </select>
                            </div>

                            {{-- Assign --}}
                            @if($agents)
                                <div>
                                    <label class="mb-1.5 block text-xs font-medium th-text-muted">Tugaskan ke</label>
                                    <select name="assigned_to"
                                        class="w-full rounded-xl border px-3 py-2 text-sm th-text focus:border-brand-500 focus:outline-none"
                                        style="background-color: var(--t-bg-input); border-color: var(--t-border);">
                                        <option value="">Belum ditugaskan</option>
                                        @foreach($agents as $agent)
                                            <option value="{{ $agent->id }}" {{ $ticket->assigned_to == $agent->id ? 'selected' : '' }}>
                                                {{ $agent->callname ?: $agent->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif

                            <button type="submit"
                                class="w-full rounded-xl bg-brand-600 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-brand-700">
                                Simpan Perubahan
                            </button>
                        </form>
                    </div>
                @endif

                {{-- History --}}
                <div class="rounded-2xl border p-6 transition-colors duration-300"
                    style="background-color: var(--t-bg-card); border-color: var(--t-border);">
                    <h3 class="mb-4 text-sm font-semibold uppercase tracking-wider th-text-muted">Riwayat</h3>
                    <div class="space-y-3">
                        @forelse($ticket->histories->sortByDesc('created_at') as $history)
                            <div class="flex items-start gap-3">
                                <div class="mt-1 h-2 w-2 shrink-0 rounded-full bg-brand-500"></div>
                                <div class="min-w-0">
                                    <p class="text-xs th-text">
                                        <span class="font-medium">{{ $history->user->callname ?: $history->user->name }}</span>
                                        @if($history->field === 'created')
                                            membuat tiket
                                        @elseif($history->field === 'status')
                                            mengubah status dari <span class="font-medium">{{ $history->old_value }}</span> ke <span class="font-medium">{{ $history->new_value }}</span>
                                        @elseif($history->field === 'priority')
                                            mengubah prioritas dari <span class="font-medium">{{ $history->old_value }}</span> ke <span class="font-medium">{{ $history->new_value }}</span>
                                        @elseif($history->field === 'assigned_to')
                                            menugaskan tiket
                                        @elseif($history->field === 'comment')
                                            menambahkan komentar
                                        @else
                                            mengubah {{ $history->field }}
                                        @endif
                                    </p>
                                    <p class="text-[10px] th-text-muted">{{ $history->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        @empty
                            <p class="text-sm th-text-muted text-center">Belum ada riwayat</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layouts.app>
