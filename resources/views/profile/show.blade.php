<x-layouts.app>
    @section('page-title', __('messages.profile_title'))
    @section('page-subtitle', __('messages.profile_subtitle'))

    <div class="mx-auto max-w-4xl">

        {{-- ═══ Profile Header Card ═══ --}}
        <div class="relative mb-6 overflow-hidden rounded-2xl border p-8 transition-colors duration-300"
            style="border-color: var(--t-border); background: linear-gradient(135deg, rgba(99,102,241,0.08), var(--t-bg-card), rgba(147,51,234,0.05));">
            <div class="pointer-events-none absolute -right-16 -top-16 h-64 w-64 rounded-full blur-[80px]"
                style="background-color: var(--t-orb-1);"></div>
            <div class="pointer-events-none absolute -bottom-8 -left-8 h-48 w-48 rounded-full blur-[60px]"
                style="background-color: var(--t-orb-2);"></div>

            <div class="relative z-10 flex flex-col items-center gap-5 sm:flex-row sm:items-center">

                {{-- Info --}}
                <div class="flex-1 text-center sm:text-left">
                    <h1 class="text-2xl font-bold th-text">{{ $user->callname ?: $user->name }}</h1>
                    <p class="mt-1 text-sm th-text-muted">{{ $user->department ?: __('messages.not_set') }}</p>
                </div>

                {{-- Edit Button --}}
                <a href="{{ route('profile.edit') }}"
                    class="inline-flex items-center gap-2 rounded-xl border px-4 py-2 text-sm font-medium th-text-secondary transition-all duration-200 hover:th-bg-hover hover:text-brand-500"
                    style="border-color: var(--t-border);">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                    </svg>
                    {{ __('messages.edit_profile') }}
                </a>
            </div>
        </div>

        <div class="grid gap-6 lg:grid-cols-2">

            {{-- ═══ Biodata Card ═══ --}}
            <div class="rounded-2xl border p-6 transition-colors duration-300"
                style="background-color: var(--t-bg-card); border-color: var(--t-border);">
                <div class="mb-5 flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-500/10 text-indigo-500">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>
                    </div>
                    <h2 class="text-lg font-semibold th-text">{{ __('messages.biodata_info') }}</h2>
                </div>

                <div class="space-y-4">
                    {{-- Full Name --}}
                    <div
                        class="flex items-start justify-between gap-4 rounded-xl p-3 transition-colors hover:th-bg-hover">
                        <span class="text-sm th-text-muted whitespace-nowrap">{{ __('messages.full_name') }}</span>
                        <span class="text-sm font-medium th-text text-right">{{ $user->name }}</span>
                    </div>
                    {{-- Call Name --}}
                    <div
                        class="flex items-start justify-between gap-4 rounded-xl p-3 transition-colors hover:th-bg-hover">
                        <span class="text-sm th-text-muted whitespace-nowrap">{{ __('messages.call_name') }}</span>
                        <span
                            class="text-sm font-medium th-text text-right">{{ $user->callname ?: __('messages.not_set') }}</span>
                    </div>
                    {{-- Gender --}}
                    <div
                        class="flex items-start justify-between gap-4 rounded-xl p-3 transition-colors hover:th-bg-hover">
                        <span class="text-sm th-text-muted whitespace-nowrap">{{ __('messages.gender') }}</span>
                        <span class="text-sm font-medium th-text text-right">
                            @if($user->gender === 'male')
                                {{ __('messages.gender_male') }}
                            @elseif($user->gender === 'female')
                                {{ __('messages.gender_female') }}
                            @else
                                {{ __('messages.not_set') }}
                            @endif
                        </span>
                    </div>
                    {{-- Employee ID --}}
                    <div
                        class="flex items-start justify-between gap-4 rounded-xl p-3 transition-colors hover:th-bg-hover">
                        <span class="text-sm th-text-muted whitespace-nowrap">{{ __('messages.employee_id') }}</span>
                        <span
                            class="text-sm font-medium th-text text-right font-mono">{{ $user->employee_id ?: __('messages.not_set') }}</span>
                    </div>
                    {{-- Phone --}}
                    <div
                        class="flex items-start justify-between gap-4 rounded-xl p-3 transition-colors hover:th-bg-hover">
                        <span class="text-sm th-text-muted whitespace-nowrap">{{ __('messages.phone') }}</span>
                        <span
                            class="text-sm font-medium th-text text-right">{{ $user->phone ?: __('messages.not_set') }}</span>
                    </div>
                    {{-- Division --}}
                    <div
                        class="flex items-start justify-between gap-4 rounded-xl p-3 transition-colors hover:th-bg-hover">
                        <span class="text-sm th-text-muted whitespace-nowrap">{{ __('messages.division') }}</span>
                        <span
                            class="text-sm font-medium th-text text-right">{{ $user->department ?: __('messages.not_set') }}</span>
                    </div>
                    {{-- Branch --}}
                    <div
                        class="flex items-start justify-between gap-4 rounded-xl p-3 transition-colors hover:th-bg-hover">
                        <span class="text-sm th-text-muted whitespace-nowrap">{{ __('messages.branch') }}</span>
                        <span
                            class="text-sm font-medium th-text text-right">{{ $user->branch ?: __('messages.not_set') }}</span>
                    </div>
                    {{-- Office Email --}}
                    <div
                        class="flex items-start justify-between gap-4 rounded-xl p-3 transition-colors hover:th-bg-hover">
                        <span class="text-sm th-text-muted whitespace-nowrap">{{ __('messages.office_email') }}</span>
                        <span class="text-sm font-medium th-text text-right">{{ $user->email }}</span>
                    </div>
                </div>
            </div>

            {{-- ═══ Account Info Card ═══ --}}
            <div class="rounded-2xl border p-6 transition-colors duration-300"
                style="background-color: var(--t-bg-card); border-color: var(--t-border);">
                <div class="mb-5 flex items-center gap-3">
                    <div
                        class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-500/10 text-emerald-500">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                        </svg>
                    </div>
                    <h2 class="text-lg font-semibold th-text">{{ __('messages.account_info') }}</h2>
                </div>

                <div class="space-y-4">
                    {{-- Username --}}
                    <div
                        class="flex items-start justify-between gap-4 rounded-xl p-3 transition-colors hover:th-bg-hover">
                        <span class="text-sm th-text-muted whitespace-nowrap">{{ __('messages.username') }}</span>
                        <span class="text-sm font-medium th-text text-right font-mono">{{ $user->username }}</span>
                    </div>
                    {{-- Member Since --}}
                    <div
                        class="flex items-start justify-between gap-4 rounded-xl p-3 transition-colors hover:th-bg-hover">
                        <span class="text-sm th-text-muted whitespace-nowrap">{{ __('messages.member_since') }}</span>
                        <span class="text-sm font-medium th-text text-right">
                            {{ $user->created_at->translatedFormat('d F Y') }}
                        </span>
                    </div>
                </div>
            </div>

        </div>
    </div>

</x-layouts.app>