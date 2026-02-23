<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" x-data="themeManager()" :class="{ 'dark': isDark }" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', __('messages.dashboard')) — {{ __('messages.app_name') }}</title>
    <meta name="description" content="{{ __('messages.app_name') }} — {{ __('messages.dashboard') }}">
    <link rel="icon" href="{{ asset('assets/img/favicon.ico') }}" type="image/x-icon">
    <script>
        if (localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        }
    </script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>

<body class="flex h-full flex-col font-sans antialiased transition-colors duration-300"
    style="background-color: var(--t-bg); color: var(--t-text);">

    {{-- Public Header (logos, lang, theme) --}}
    @include('partials.header')

    <div class="flex flex-1 pt-14 lg:pt-16 overflow-hidden" x-data="{ sidebarOpen: window.innerWidth >= 1024 }"
        @resize.window="if(window.innerWidth >= 1024) sidebarOpen = true">

        {{-- Sidebar Overlay (Mobile Only) --}}
        <div x-show="sidebarOpen" x-cloak @click="sidebarOpen = false"
            x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-20 bg-black/50 backdrop-blur-sm lg:hidden">
        </div>

        {{-- Sidebar --}}
        <aside x-show="sidebarOpen" x-cloak x-transition:enter="transition-transform duration-300 ease-out"
            x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
            x-transition:leave="transition-transform duration-200 ease-in" x-transition:leave-start="translate-x-0"
            x-transition:leave-end="-translate-x-full"
            class="fixed inset-y-0 left-0 z-30 flex w-64 flex-col border-r pt-14 th-border lg:relative lg:pt-0 transition-colors duration-300 overflow-y-auto"
            style="background-color: var(--t-bg-sidebar);">
            {{-- Logo --}}
            <div class="flex h-16 items-center gap-3 border-b th-border px-6">
                <div
                    class="flex h-9 w-9 items-center justify-center rounded-lg bg-gradient-to-br from-brand-500 to-brand-700 shadow-lg shadow-brand-500/25">
                    <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0V12a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 12V5.25" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-sm font-bold tracking-tight th-text">IT</h1>
                    <p class="text-[10px] font-medium uppercase tracking-widest text-brand-400">System</p>
                </div>
            </div>

            {{-- Navigation --}}
            <nav class="flex-1 overflow-y-auto px-3 py-4">
                @if(request()->is('ticketing*'))
                    {{-- ═══ TICKETING SYSTEM MENUS ═══ --}}
                    <p class="mb-2 px-3 text-[10px] font-semibold uppercase tracking-widest th-text-faint">
                        Ticketing System
                    </p>

                    <a href="{{ route('ticketing.index') }}"
                        class="group mb-1 flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition-all duration-200
                                      {{ request()->routeIs('ticketing.index') && !request()->has('filter') ? 'th-bg-active text-brand-500' : 'th-text-secondary hover:th-bg-hover' }}">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m2.25 12 8.954-8.955a1.126 1.126 0 0 1 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>
                        Dashboard
                    </a>

                    {{-- Ticket Dropdown Menus --}}
                    <div
                        x-data="{ open: {{ request()->routeIs('ticketing.create') || request()->has('filter') ? 'true' : 'false' }} }">
                        <button @click="open = !open"
                            class="group mb-1 flex w-full items-center justify-between gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition-all duration-200 th-text-secondary hover:th-bg-hover">
                            <div class="flex items-center gap-3">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 0 1 0 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 0 1 0-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375Z" />
                                </svg>
                                Ticket
                            </div>
                            <svg class="h-4 w-4 transition-transform duration-200" :class="open ? 'rotate-180' : ''"
                                fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                            </svg>
                        </button>

                        <div x-show="open" x-collapse>
                            <div class="mb-1 pl-11 pr-3 py-1 space-y-1">
                                <a href="{{ route('ticketing.create') }}"
                                    class="block rounded-lg px-3 py-2.5 text-sm font-medium text-center text-white bg-emerald-600 shadow-md shadow-emerald-500/20 transition-all hover:bg-emerald-700 hover:shadow-emerald-500/40">
                                    <span class="flex items-center justify-center gap-2">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 4.5v15m7.5-7.5h-15" />
                                        </svg>
                                        Buat Tiket Baru
                                    </span>
                                </a>
                                <a href="{{ route('ticketing.index', ['filter' => 'all']) }}"
                                    class="block rounded-lg px-3 py-2 text-sm font-medium transition-colors {{ request('filter') === 'all' ? 'text-brand-500 bg-brand-50' : 'th-text-muted hover:text-brand-500 hover:th-bg-hover' }}">
                                    All Ticket
                                </a>
                                <a href="{{ route('ticketing.index', ['filter' => 'my']) }}"
                                    class="block rounded-lg px-3 py-2 text-sm font-medium transition-colors {{ request('filter') === 'my' ? 'text-brand-500 bg-brand-50' : 'th-text-muted hover:text-brand-500 hover:th-bg-hover' }}">
                                    My Ticket
                                </a>
                            </div>
                        </div>
                    </div>

                    @if(auth()->user()->hasRole('super_admin') || auth()->user()->hasRole('admin') || auth()->user()->hasRole('agent'))
                        <a href="{{ route('ticketing.categories.index') }}"
                            class="group mb-1 flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition-all duration-200
                                              {{ request()->routeIs('ticketing.categories.*') ? 'th-bg-active text-brand-500' : 'th-text-secondary hover:th-bg-hover' }}">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                            </svg>
                            Kategori
                        </a>
                        <a href="{{ route('ticketing.reports.index') }}"
                            class="group mb-1 flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition-all duration-200
                                              {{ request()->routeIs('ticketing.reports.*') ? 'th-bg-active text-brand-500' : 'th-text-secondary hover:th-bg-hover' }}">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
                            </svg>
                            Laporan
                        </a>
                    @endif

                    <div class="mt-4 pt-4 border-t th-border">
                        <a href="{{ url('/dashboard') }}"
                            class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition-all duration-200 th-text-muted hover:text-brand-500 hover:th-bg-hover">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m9 15 3-3m0 0 3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                            </svg>
                            Kembali ke Main Dashboard
                        </a>
                    </div>
                @else
                    {{-- ═══ MAIN DASHBOARD MENUS ═══ --}}
                    <p class="mb-2 px-3 text-[10px] font-semibold uppercase tracking-widest th-text-faint">
                        {{ __('messages.menu') }}
                    </p>

                    <a href="{{ url('/dashboard') }}"
                        class="group mb-1 flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition-all duration-200
                                      {{ request()->is('dashboard') ? 'th-bg-active text-brand-500' : 'th-text-secondary hover:th-bg-hover' }}">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m2.25 12 8.954-8.955a1.126 1.126 0 0 1 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>
                        {{ __('messages.dashboard') }}
                    </a>

                    @php $modules = config('modules', []); @endphp

                    @if(auth()->check())
                        @foreach($modules as $key => $module)
                            @if(auth()->user()->hasPermission($module['permission']))
                                <a href="{{ route($module['route']) }}"
                                    class="group mb-1 flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition-all duration-200
                                                                                                                                                          {{ request()->routeIs($key . '.*') ? 'th-bg-active text-brand-500' : 'th-text-secondary hover:th-bg-hover' }}">
                                    <i class="{{ $module['icon'] }} w-5 text-center"></i>
                                    {{ $module['name'] }}
                                </a>
                            @endif
                        @endforeach
                    @endif

                    @if(auth()->check() && (auth()->user()->hasRole('super_admin') || auth()->user()->hasRole('admin')))
                        <div class="mt-6">
                            <p class="mb-2 px-3 text-[10px] font-semibold uppercase tracking-widest th-text-faint">
                                {{ __('messages.admin') }}
                            </p>
                            <a href="{{ url('/admin/users') }}"
                                class="group mb-1 flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition-all duration-200
                                                                              {{ request()->is('admin/users*') ? 'th-bg-active text-brand-500' : 'th-text-secondary hover:th-bg-hover' }}">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                                </svg>
                                {{ __('messages.manage_users') }}
                            </a>
                            <a href="{{ url('/admin/roles') }}"
                                class="group mb-1 flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition-all duration-200
                                                                              {{ request()->is('admin/roles*') ? 'th-bg-active text-brand-500' : 'th-text-secondary hover:th-bg-hover' }}">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                                </svg>
                                {{ __('messages.manage_roles') }}
                            </a>
                            <a href="{{ url('/admin/branches') }}"
                                class="group mb-1 flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition-all duration-200
                                                                              {{ request()->is('admin/branches*') ? 'th-bg-active text-brand-500' : 'th-text-secondary hover:th-bg-hover' }}">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Z" />
                                </svg>
                                Kelola Cabang
                            </a>
                            <a href="{{ url('/admin/divisions') }}"
                                class="group mb-1 flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition-all duration-200
                                                                              {{ request()->is('admin/divisions*') ? 'th-bg-active text-brand-500' : 'th-text-secondary hover:th-bg-hover' }}">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0 0 12 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75Z" />
                                </svg>
                                Kelola Divisi
                            </a>
                        </div>
                    @endif
                @endif
            </nav>
            {{-- User Profile --}}
            @if(auth()->check())
                <div class="border-t th-border p-3">
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open"
                            class="flex w-full items-center gap-3 rounded-xl px-3 py-2.5 transition-all duration-200 hover:th-bg-hover">
                            <div
                                class="flex h-8 w-8 items-center justify-center rounded-full bg-gradient-to-br from-brand-500 to-purple-600 text-xs font-bold text-white">
                                {{ strtoupper(substr(auth()->user()->callname ?: auth()->user()->name, 0, 1)) }}
                            </div>
                            <div class="flex-1 text-left">
                                <p class="text-sm font-medium th-text">
                                    {{ auth()->user()->callname ?: auth()->user()->name }}
                                </p>
                                <p class="text-[11px] th-text-muted">{{ auth()->user()->department ?: '-' }}</p>
                            </div>
                            <svg class="h-4 w-4 th-text-muted transition-transform" :class="open && 'rotate-180'"
                                fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                            </svg>
                        </button>
                        <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            class="absolute bottom-full left-0 mb-2 w-full rounded-xl border th-border p-1 th-shadow-lg"
                            style="background-color: var(--t-bg-card);">
                            <a href="{{ url('/profile') }}"
                                class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm th-text-secondary hover:th-bg-hover transition-colors">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                </svg>
                                {{ __('messages.my_profile') }}
                            </a>
                            <a href="{{ url('/password/change') }}"
                                class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm th-text-secondary hover:th-bg-hover transition-colors">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                                </svg>
                                {{ __('messages.change_password') }}
                            </a>
                            <form method="POST" action="{{ url('/logout') }}">
                                @csrf
                                <button type="submit"
                                    class="flex w-full items-center gap-2 rounded-lg px-3 py-2 text-sm text-red-500 hover:bg-red-500/10 transition-colors">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                                    </svg>
                                    {{ __('messages.logout') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        </aside>

        {{-- ════════ MAIN CONTENT ════════ --}}
        <div class="flex flex-1 flex-col overflow-hidden">
            {{-- Sub Navbar --}}
            <header
                class="flex h-14 items-center justify-between border-b th-border px-6 transition-colors duration-300"
                style="background-color: var(--t-bg-header);">
                <div class="flex items-center gap-4">
                    <button @click="sidebarOpen = !sidebarOpen"
                        class="rounded-lg p-2 th-text-secondary transition hover:th-bg-hover">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </button>
                    <div>
                        <h2 class="text-base font-semibold th-text">@yield('page-title', __('messages.dashboard'))</h2>
                        <p class="text-xs th-text-muted">@yield('page-subtitle', __('messages.welcome_system'))</p>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    {{-- Notification Bell --}}
                    <button class="relative rounded-lg p-2 th-text-secondary transition hover:th-bg-hover">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                        </svg>
                        <span class="absolute right-1.5 top-1.5 h-2 w-2 rounded-full bg-red-500"></span>
                    </button>

                    {{-- Date/Time --}}
                    <div class="hidden items-center gap-2 rounded-lg border th-border px-3 py-1.5 md:flex"
                        style="background-color: var(--t-bg-input);">
                        <svg class="h-4 w-4 th-text-muted" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        <span class="text-xs font-medium th-text-muted" x-data
                            x-text="new Date().toLocaleDateString('{{ app()->getLocale() === 'id' ? 'id-ID' : 'en-US' }}', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' })"></span>
                    </div>
                </div>
            </header>

            {{-- Page Content (with background) --}}
            <main class="relative flex-1 overflow-y-auto z-0">
                {{-- Background --}}
                <div class="fixed inset-0 -z-10"
                    style="background: url('{{ asset('assets/background/langit.png') }}') center/cover no-repeat fixed;">
                </div>
                <div class="fixed inset-0 -z-10 transition-colors duration-300"
                    style="background-color: var(--t-bg); opacity: 0.88;"></div>

                <div class="p-6">
                    {{-- Flash Messages --}}
                    @if(session('success'))
                        <div
                            class="mb-4 flex items-center gap-3 rounded-xl border border-green-500/20 bg-green-500/10 px-4 py-3 text-sm text-green-600 dark:text-green-400">
                            <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div
                            class="mb-4 flex items-center gap-3 rounded-xl border border-red-500/20 bg-red-500/10 px-4 py-3 text-sm text-red-600 dark:text-red-400">
                            <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                            </svg>
                            {{ session('error') }}
                        </div>
                    @endif

                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>

    {{-- Footer --}}
    @include('partials.footer')

    @stack('scripts')
</body>

</html>