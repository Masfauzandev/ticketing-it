<x-layouts.app>
    @section('page-title', $ticket->ticket_number)
    @section('page-subtitle', 'Detail Tiket')

    @php
        $statusConfig = [
            'open' => [
                'color' => 'bg-amber-500/10 text-amber-600 dark:text-amber-400 border-amber-500/20',
                'dot' => 'bg-amber-500',
                'label' => 'Open',
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />',
            ],
            'in_progress' => [
                'color' => 'bg-blue-500/10 text-blue-600 dark:text-blue-400 border-blue-500/20',
                'dot' => 'bg-blue-500 animate-pulse',
                'label' => 'In Progress',
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />',
            ],
            'resolved' => [
                'color' => 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border-emerald-500/20',
                'dot' => 'bg-emerald-500',
                'label' => 'Resolved',
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />',
            ],
            'closed' => [
                'color' => 'bg-gray-500/10 text-gray-600 dark:text-gray-400 border-gray-500/20',
                'dot' => 'bg-gray-500',
                'label' => 'Closed',
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />',
            ],
        ];
        $currentStatus = $statusConfig[$ticket->status] ?? $statusConfig['open'];
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

        {{-- ═══ Success Banner ═══ --}}
        @if(session('success'))
            <div class="mb-6 flex items-center gap-3 rounded-2xl border border-emerald-500/20 bg-emerald-500/10 p-4">
                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-emerald-500/20">
                    <svg class="h-5 w-5 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-semibold text-emerald-600 dark:text-emerald-400">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        {{-- ═══ Ticket Header Card ═══ --}}
        <div class="mb-6 rounded-2xl border overflow-hidden transition-colors duration-300"
            style="background-color: var(--t-bg-card); border-color: var(--t-border);">
            {{-- Status Banner --}}
            <div class="px-6 py-4 {{ $currentStatus['color'] }} border-b" style="border-color: inherit;">
                <div class="flex flex-wrap items-center justify-between gap-3">
                    <div class="flex items-center gap-3">
                        <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-current/10">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                {!! $currentStatus['icon'] !!}
                            </svg>
                        </div>
                        <div>
                            <span class="text-xs font-medium opacity-70">Status Tiket</span>
                            <p class="text-sm font-bold">{{ $currentStatus['label'] }}</p>
                        </div>
                    </div>
                    <span class="inline-flex items-center gap-1.5 rounded-full border px-3 py-1.5 text-xs font-semibold {{ $currentStatus['color'] }}">
                        <span class="h-2 w-2 rounded-full {{ $currentStatus['dot'] }}"></span>
                        {{ $currentStatus['label'] }}
                    </span>
                </div>
            </div>

            {{-- Ticket Title --}}
            <div class="px-6 py-5">
                <div class="flex flex-wrap items-start justify-between gap-4">
                    <div class="min-w-0 flex-1">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="inline-flex items-center gap-1.5 rounded-lg bg-brand-500/10 px-2.5 py-1 font-mono text-xs font-bold text-brand-500">
                                <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 8.25h15m-16.5 7.5h15m-1.8-13.5-3.9 19.5m-2.1-19.5-3.9 19.5" />
                                </svg>
                                {{ $ticket->ticket_number }}
                            </span>
                            @if($ticket->category)
                                <span class="rounded-lg bg-purple-500/10 px-2.5 py-1 text-xs font-medium text-purple-600 dark:text-purple-400">
                                    {{ $ticket->category->name }}
                                </span>
                            @endif
                        </div>
                        <h1 class="text-xl font-bold th-text leading-snug">{{ $ticket->subject }}</h1>
                        <p class="mt-2 text-xs th-text-muted">
                            Dibuat oleh <span class="font-semibold th-text">{{ $ticket->creator->callname ?: $ticket->creator->name }}</span>
                            · {{ $ticket->created_at->diffForHumans() }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid gap-6 lg:grid-cols-3">

            {{-- ═══ Main Content (2/3) ═══ --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- Description --}}
                <div class="rounded-2xl border p-6 transition-colors duration-300"
                    style="background-color: var(--t-bg-card); border-color: var(--t-border);">
                    <div class="flex items-center gap-2 mb-4">
                        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-brand-500/10 text-brand-500">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                            </svg>
                        </div>
                        <h3 class="text-sm font-semibold th-text">Deskripsi</h3>
                    </div>
                    <div class="rounded-xl p-4 text-sm th-text leading-relaxed"
                        style="background-color: var(--t-bg-input);">
                        {!! nl2br(e($ticket->description)) !!}
                    </div>
                </div>

                {{-- Attachments --}}
                @if($ticket->attachments->isNotEmpty())
                    <div class="rounded-2xl border p-6 transition-colors duration-300"
                        style="background-color: var(--t-bg-card); border-color: var(--t-border);">
                        <div class="flex items-center gap-2 mb-4">
                            <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-orange-500/10 text-orange-500">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m18.375 12.739-7.693 7.693a4.5 4.5 0 0 1-6.364-6.364l10.94-10.94A3 3 0 1 1 19.5 7.372L8.552 18.32m.009-.01-.01.01m5.699-9.941-7.81 7.81a1.5 1.5 0 0 0 2.112 2.13" />
                                </svg>
                            </div>
                            <h3 class="text-sm font-semibold th-text">Lampiran
                                <span class="ml-1 text-xs font-normal th-text-muted">({{ $ticket->attachments->whereNull('comment_id')->count() }} file)</span>
                            </h3>
                        </div>
                        <div class="grid gap-2 sm:grid-cols-2">
                            @foreach($ticket->attachments->whereNull('comment_id') as $attachment)
                                <a href="{{ asset('storage/' . $attachment->path) }}" target="_blank"
                                    class="group flex items-center gap-3 rounded-xl border p-3 transition-all hover:shadow-md hover:border-brand-500/30"
                                    style="border-color: var(--t-border);">
                                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-brand-500/10 text-brand-500 transition group-hover:bg-brand-500/20">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                        </svg>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <p class="truncate text-sm font-medium th-text group-hover:text-brand-500 transition">{{ $attachment->filename }}</p>
                                        <p class="text-xs th-text-muted">{{ number_format($attachment->size / 1024, 1) }} KB</p>
                                    </div>
                                    <svg class="h-4 w-4 shrink-0 th-text-faint transition group-hover:text-brand-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                    </svg>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Comments --}}
                <div class="rounded-2xl border p-6 transition-colors duration-300"
                    style="background-color: var(--t-bg-card); border-color: var(--t-border);">
                    <div class="flex items-center gap-2 mb-4">
                        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-500/10 text-blue-500">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.076-4.076a1.526 1.526 0 0 1 1.037-.443 48.282 48.282 0 0 0 5.386-.512c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                            </svg>
                        </div>
                        <h3 class="text-sm font-semibold th-text">
                            Komentar
                            <span class="ml-1 rounded-full bg-brand-500/10 px-2 py-0.5 text-xs font-medium text-brand-500">{{ $ticket->comments->count() }}</span>
                        </h3>
                    </div>

                    @forelse($ticket->comments as $comment)
                        <div class="mb-4 last:mb-0 rounded-xl border p-4 transition-colors {{ $comment->is_internal ? 'border-amber-500/30 bg-amber-500/5' : '' }}"
                            style="{{ !$comment->is_internal ? 'border-color: var(--t-border);' : '' }}">
                            <div class="mb-3 flex items-center justify-between">
                                <div class="flex items-center gap-2.5">
                                    <div class="flex h-8 w-8 items-center justify-center rounded-full bg-gradient-to-br from-brand-500 to-purple-600 text-xs font-bold text-white shadow-sm">
                                        {{ strtoupper(substr($comment->user->callname ?: $comment->user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <span class="text-sm font-semibold th-text">{{ $comment->user->callname ?: $comment->user->name }}</span>
                                        @if($comment->is_internal)
                                            <span class="ml-1.5 inline-flex items-center gap-1 rounded-full bg-amber-500/15 px-2 py-0.5 text-[10px] font-semibold text-amber-600 dark:text-amber-400">
                                                <svg class="h-2.5 w-2.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                                                </svg>
                                                Internal
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <span class="text-[11px] th-text-muted">{{ $comment->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-sm th-text leading-relaxed pl-10">{{ $comment->body }}</p>
                        </div>
                    @empty
                        <div class="flex flex-col items-center justify-center py-8">
                            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gray-500/5 mb-3">
                                <svg class="h-7 w-7 th-text-faint" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.076-4.076a1.526 1.526 0 0 1 1.037-.443 48.282 48.282 0 0 0 5.386-.512c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                                </svg>
                            </div>
                            <p class="text-sm font-medium th-text-muted">Belum ada komentar</p>
                            <p class="text-xs th-text-faint">Komentar akan muncul di sini</p>
                        </div>
                    @endforelse

                    {{-- Add Comment Form --}}
                    @if($ticket->status !== 'closed')
                        <form action="{{ route('ticketing.update', $ticket) }}" method="POST" enctype="multipart/form-data"
                            class="mt-5 border-t pt-5" style="border-color: var(--t-border);">
                            @csrf
                            @method('PUT')
                            <textarea name="comment" rows="3" required
                                placeholder="Tulis komentar..."
                                class="w-full rounded-xl border px-4 py-3 text-sm th-text transition-colors focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500/20 resize-y"
                                style="background-color: var(--t-bg-input); border-color: var(--t-border);"></textarea>
                            <div class="mt-3 flex items-center justify-between">
                                @if($isAdmin)
                                    <label class="flex items-center gap-2 text-sm th-text-muted cursor-pointer select-none">
                                        <input type="checkbox" name="is_internal" value="1"
                                            class="h-4 w-4 rounded border-gray-300 text-brand-600 focus:ring-brand-500">
                                        <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                                        </svg>
                                        Internal note
                                    </label>
                                @else
                                    <div></div>
                                @endif
                                <button type="submit"
                                    class="flex items-center gap-2 rounded-xl bg-gradient-to-r from-brand-600 to-brand-500 px-5 py-2.5 text-sm font-semibold text-white shadow-md shadow-brand-500/25 transition-all hover:shadow-lg hover:from-brand-700 hover:to-brand-600 active:scale-[0.98]">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                                    </svg>
                                    Kirim
                                </button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>

            {{-- ═══ Sidebar (1/3) ═══ --}}
            <div class="space-y-6">

                {{-- Ticket Info --}}
                <div class="rounded-2xl border overflow-hidden transition-colors duration-300"
                    style="background-color: var(--t-bg-card); border-color: var(--t-border);">
                    <div class="bg-gradient-to-r from-brand-600 to-brand-500 px-5 py-3">
                        <h3 class="text-sm font-bold text-white flex items-center gap-2">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                            </svg>
                            Informasi Tiket
                        </h3>
                    </div>
                    <div class="p-5 space-y-4">
                        {{-- Creator --}}
                        <div class="flex items-center gap-3">
                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-brand-500/10 text-brand-500">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <p class="text-[11px] font-medium uppercase tracking-wider th-text-muted">Pembuat</p>
                                <p class="text-sm font-semibold th-text truncate">{{ $ticket->creator->callname ?: $ticket->creator->name }}</p>
                            </div>
                        </div>

                        {{-- Assignee --}}
                        <div class="flex items-center gap-3">
                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg {{ $ticket->assignee ? 'bg-emerald-500/10 text-emerald-500' : 'bg-gray-500/10 th-text-muted' }}">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <p class="text-[11px] font-medium uppercase tracking-wider th-text-muted">Ditugaskan ke</p>
                                <p class="text-sm font-semibold th-text truncate">
                                    {{ $ticket->assignee ? ($ticket->assignee->callname ?: $ticket->assignee->name) : 'Belum ditugaskan' }}
                                </p>
                            </div>
                        </div>

                        {{-- Category --}}
                        <div class="flex items-center gap-3">
                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-purple-500/10 text-purple-500">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <p class="text-[11px] font-medium uppercase tracking-wider th-text-muted">Kategori</p>
                                <p class="text-sm font-semibold th-text truncate">{{ $ticket->category->name ?? '-' }}</p>
                            </div>
                        </div>

                        <div class="border-t my-2" style="border-color: var(--t-border);"></div>

                        {{-- Dates --}}
                        <div class="flex items-center gap-3">
                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-sky-500/10 text-sky-500">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <p class="text-[11px] font-medium uppercase tracking-wider th-text-muted">Dibuat</p>
                                <p class="text-sm font-semibold th-text">{{ $ticket->created_at->translatedFormat('d M Y, H:i') }}</p>
                            </div>
                        </div>

                        @if($ticket->resolved_at)
                            <div class="flex items-center gap-3">
                                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-emerald-500/10 text-emerald-500">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                </div>
                                <div class="min-w-0">
                                    <p class="text-[11px] font-medium uppercase tracking-wider th-text-muted">Diselesaikan</p>
                                    <p class="text-sm font-semibold th-text">{{ $ticket->resolved_at->translatedFormat('d M Y, H:i') }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Admin Actions --}}
                @if($isAdmin && $ticket->status !== 'closed')
                    <div class="rounded-2xl border overflow-hidden transition-colors duration-300"
                        style="background-color: var(--t-bg-card); border-color: var(--t-border);">
                        <div class="bg-gradient-to-r from-amber-500 to-orange-500 px-5 py-3">
                            <h3 class="text-sm font-bold text-white flex items-center gap-2">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17 17.25 21A2.652 2.652 0 0 0 21 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 1 1-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 0 0 4.486-6.336l-3.276 3.277a3.004 3.004 0 0 1-2.25-2.25l3.276-3.276a4.5 4.5 0 0 0-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437 1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008Z" />
                                </svg>
                                Aksi Admin
                            </h3>
                        </div>
                        <form action="{{ route('ticketing.update', $ticket) }}" method="POST" class="p-5 space-y-4">
                            @csrf
                            @method('PUT')

                            {{-- Status --}}
                            <div>
                                <label class="mb-1.5 block text-xs font-semibold th-text-muted">Ubah Status</label>
                                <select name="status"
                                    class="w-full rounded-xl border px-3 py-2.5 text-sm th-text focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500/20"
                                    style="background-color: var(--t-bg-input); border-color: var(--t-border);">
                                    <option value="open" {{ $ticket->status === 'open' ? 'selected' : '' }}>Open</option>
                                    <option value="in_progress" {{ $ticket->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                    <option value="resolved" {{ $ticket->status === 'resolved' ? 'selected' : '' }}>Resolved</option>
                                    <option value="closed" {{ $ticket->status === 'closed' ? 'selected' : '' }}>Closed</option>
                                </select>
                            </div>

                            {{-- Assign --}}
                            @if($agents)
                                <div>
                                    <label class="mb-1.5 block text-xs font-semibold th-text-muted">Tugaskan ke</label>
                                    <select name="assigned_to"
                                        class="w-full rounded-xl border px-3 py-2.5 text-sm th-text focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500/20"
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
                                class="w-full flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-amber-500 to-orange-500 px-4 py-2.5 text-sm font-semibold text-white shadow-md shadow-amber-500/25 transition-all hover:shadow-lg hover:from-amber-600 hover:to-orange-600 active:scale-[0.98]">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                </svg>
                                Simpan Perubahan
                            </button>
                        </form>
                    </div>
                @endif

                {{-- History Timeline --}}
                <div class="rounded-2xl border overflow-hidden transition-colors duration-300"
                    style="background-color: var(--t-bg-card); border-color: var(--t-border);">
                    <div class="px-5 py-3 border-b" style="border-color: var(--t-border);">
                        <h3 class="text-sm font-bold th-text flex items-center gap-2">
                            <svg class="h-4 w-4 text-brand-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            Riwayat Aktivitas
                        </h3>
                    </div>
                    <div class="p-5">
                        <div class="relative">
                            {{-- Timeline Line --}}
                            <div class="absolute left-[7px] top-2 bottom-2 w-px" style="background-color: var(--t-border);"></div>

                            <div class="space-y-4">
                                @forelse($ticket->histories->sortByDesc('created_at') as $history)
                                    <div class="relative flex items-start gap-3 pl-0">
                                        <div class="relative z-10 mt-1 h-[15px] w-[15px] shrink-0 rounded-full border-2 border-brand-500 bg-brand-500/20"></div>
                                        <div class="min-w-0 pb-1">
                                            <p class="text-xs th-text leading-relaxed">
                                                <span class="font-semibold">{{ $history->user->callname ?: $history->user->name }}</span>
                                                @if($history->field === 'created')
                                                    <span class="text-emerald-500">membuat tiket</span>
                                                @elseif($history->field === 'status')
                                                    mengubah status
                                                    <span class="rounded bg-gray-500/10 px-1.5 py-0.5 font-mono text-[10px]">{{ $history->old_value }}</span>
                                                    →
                                                    <span class="rounded bg-brand-500/10 px-1.5 py-0.5 font-mono text-[10px] text-brand-500">{{ $history->new_value }}</span>
                                                @elseif($history->field === 'assigned_to')
                                                    <span class="text-blue-500">menugaskan tiket</span>
                                                @elseif($history->field === 'comment')
                                                    <span class="text-purple-500">menambahkan komentar</span>
                                                @else
                                                    mengubah {{ $history->field }}
                                                @endif
                                            </p>
                                            <p class="text-[10px] th-text-muted mt-0.5">{{ $history->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-sm th-text-muted text-center py-2">Belum ada riwayat</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layouts.app>
