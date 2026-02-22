<!DOCTYPE html>
<html lang="id" x-data="{ sidebarOpen: true, profileOpen: false }" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') — IT System Gasindogroup</title>
    <meta name="description" content="IT System Gasindogroup — Dashboard">
    <link rel="icon" href="{{ asset('assets/img/favicon.ico') }}" type="image/x-icon">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>

<body class="h-full bg-surface-950 text-white font-sans antialiased">
    <div class="flex h-full">

        {{-- ════════ SIDEBAR ════════ --}}
        <aside x-show="sidebarOpen" x-transition:enter="transition-transform duration-300 ease-out"
            x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
            x-transition:leave="transition-transform duration-200 ease-in" x-transition:leave-start="translate-x-0"
            x-transition:leave-end="-translate-x-full"
            class="fixed inset-y-0 left-0 z-40 flex w-64 flex-col border-r border-white/5 bg-surface-900 lg:relative">
            {{-- Logo --}}
            <div class="flex h-16 items-center gap-3 border-b border-white/5 px-6">
                <div
                    class="flex h-9 w-9 items-center justify-center rounded-lg bg-gradient-to-br from-brand-500 to-brand-700 shadow-lg shadow-brand-500/25">
                    <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0V12a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 12V5.25" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-sm font-bold tracking-tight">IT System</h1>
                    <p class="text-[10px] font-medium uppercase tracking-widest text-brand-400">Gasindogroup</p>
                </div>
            </div>

            {{-- Navigation --}}
            <nav class="flex-1 overflow-y-auto px-3 py-4">
                <p class="mb-2 px-3 text-[10px] font-semibold uppercase tracking-widest text-white/30">Menu</p>

                {{-- Dashboard --}}
                <a href="{{ url('/dashboard') }}"
                    class="group mb-1 flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition-all duration-200
                          {{ request()->is('dashboard') ? 'bg-brand-600/15 text-brand-400' : 'text-white/60 hover:bg-white/5 hover:text-white' }}">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m2.25 12 8.954-8.955a1.126 1.126 0 0 1 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                    Dashboard
                </a>

                @php $modules = config('modules', []); @endphp

                @if(auth()->check())
                    @foreach($modules as $key => $module)
                        @if(auth()->user()->hasPermission($module['permission']))
                            <a href="{{ route($module['route']) }}"
                                class="group mb-1 flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition-all duration-200
                                                          {{ request()->routeIs($key . '.*') ? 'bg-brand-600/15 text-brand-400' : 'text-white/60 hover:bg-white/5 hover:text-white' }}">
                                <i class="{{ $module['icon'] }} w-5 text-center"></i>
                                {{ $module['name'] }}
                            </a>
                        @endif
                    @endforeach
                @endif

                {{-- Admin Section --}}
                @if(auth()->check() && (auth()->user()->hasRole('super_admin') || auth()->user()->hasRole('admin')))
                    <div class="mt-6">
                        <p class="mb-2 px-3 text-[10px] font-semibold uppercase tracking-widest text-white/30">Admin</p>
                        <a href="{{ url('/admin/users') }}"
                            class="group mb-1 flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition-all duration-200
                                      {{ request()->is('admin/users*') ? 'bg-brand-600/15 text-brand-400' : 'text-white/60 hover:bg-white/5 hover:text-white' }}">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                            </svg>
                            Kelola User
                        </a>
                        <a href="{{ url('/admin/roles') }}"
                            class="group mb-1 flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition-all duration-200
                                      {{ request()->is('admin/roles*') ? 'bg-brand-600/15 text-brand-400' : 'text-white/60 hover:bg-white/5 hover:text-white' }}">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                            </svg>
                            Kelola Role
                        </a>
                    </div>
                @endif
            </nav>

            {{-- User Profile --}}
            @if(auth()->check())
                <div class="border-t border-white/5 p-3">
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open"
                            class="flex w-full items-center gap-3 rounded-xl px-3 py-2.5 transition-all duration-200 hover:bg-white/5">
                            <div
                                class="flex h-8 w-8 items-center justify-center rounded-full bg-gradient-to-br from-brand-500 to-purple-600 text-xs font-bold">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                            <div class="flex-1 text-left">
                                <p class="text-sm font-medium text-white/90">{{ auth()->user()->name }}</p>
                                <p class="text-[11px] text-white/40">{{ auth()->user()->email }}</p>
                            </div>
                            <svg class="h-4 w-4 text-white/40 transition-transform" :class="open && 'rotate-180'"
                                fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                            </svg>
                        </button>
                        <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            class="absolute bottom-full left-0 mb-2 w-full rounded-xl border border-white/10 bg-surface-800 p-1 shadow-2xl">
                            <a href="{{ url('/profile') }}"
                                class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm text-white/70 hover:bg-white/5 hover:text-white">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                </svg>
                                Profil Saya
                            </a>
                            <form method="POST" action="{{ url('/logout') }}">
                                @csrf
                                <button type="submit"
                                    class="flex w-full items-center gap-2 rounded-lg px-3 py-2 text-sm text-red-400 hover:bg-red-500/10">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                                    </svg>
                                    Keluar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        </aside>

        {{-- ════════ MAIN CONTENT ════════ --}}
        <div class="flex flex-1 flex-col overflow-hidden">
            {{-- Top Navbar --}}
            <header
                class="flex h-16 items-center justify-between border-b border-white/5 bg-surface-900/50 px-6 backdrop-blur-xl">
                <div class="flex items-center gap-4">
                    <button @click="sidebarOpen = !sidebarOpen"
                        class="rounded-lg p-2 text-white/60 transition hover:bg-white/5 hover:text-white">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </button>
                    <div>
                        <h2 class="text-base font-semibold text-white/90">@yield('page-title', 'Dashboard')</h2>
                        <p class="text-xs text-white/40">
                            @yield('page-subtitle', 'Selamat datang di IT System Gasindogroup')
                        </p>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    {{-- Notification Bell --}}
                    <button class="relative rounded-lg p-2 text-white/60 transition hover:bg-white/5 hover:text-white">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                        </svg>
                        <span class="absolute right-1.5 top-1.5 h-2 w-2 rounded-full bg-red-500"></span>
                    </button>

                    {{-- Date/Time --}}
                    <div
                        class="hidden items-center gap-2 rounded-lg border border-white/5 bg-white/5 px-3 py-1.5 md:flex">
                        <svg class="h-4 w-4 text-white/40" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        <span class="text-xs font-medium text-white/50" x-data
                            x-text="new Date().toLocaleDateString('id-ID', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' })"></span>
                    </div>
                </div>
            </header>

            {{-- Page Content --}}
            <main class="flex-1 overflow-y-auto p-6">
                {{-- Flash Messages --}}
                @if(session('success'))
                    <div
                        class="mb-4 flex items-center gap-3 rounded-xl border border-green-500/20 bg-green-500/10 px-4 py-3 text-sm text-green-400">
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
                        class="mb-4 flex items-center gap-3 rounded-xl border border-red-500/20 bg-red-500/10 px-4 py-3 text-sm text-red-400">
                        <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                        </svg>
                        {{ session('error') }}
                    </div>
                @endif

                {{ $slot }}
            </main>
        </div>
    </div>

    @stack('scripts')
</body>

</html>