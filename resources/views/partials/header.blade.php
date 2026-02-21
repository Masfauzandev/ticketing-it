{{-- ═══ PUBLIC HEADER ═══ --}}
{{-- Used on login, register, and public pages --}}
<header class="fixed top-0 left-0 right-0 z-50 border-b backdrop-blur-xl transition-colors duration-300"
    style="background-color: var(--t-bg-header); border-color: var(--t-border);">
    <div class="mx-auto flex h-16 max-w-7xl items-center justify-between px-4 sm:px-6">

        {{-- LEFT: Language Switcher --}}
        <div x-data="{ langOpen: false }" class="relative">
            <button @click="langOpen = !langOpen"
                class="flex items-center gap-2 rounded-lg border px-3 py-1.5 text-xs font-medium transition-all duration-200 hover:th-shadow"
                style="border-color: var(--t-border); background-color: var(--t-bg-input);">
                @if(app()->getLocale() === 'id')
                    <img src="{{ asset('assets/icon/Flag_of_Indonesia.png') }}" alt="ID"
                        class="h-4 w-6 rounded-sm object-cover">
                    <span class="th-text-secondary">ID</span>
                @else
                    <img src="{{ asset('assets/icon/Flag_of_UK.png') }}" alt="EN" class="h-4 w-6 rounded-sm object-cover">
                    <span class="th-text-secondary">EN</span>
                @endif
                <svg class="h-3 w-3 th-text-muted transition-transform" :class="langOpen && 'rotate-180'" fill="none"
                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                </svg>
            </button>
            <div x-show="langOpen" @click.away="langOpen = false" x-transition:enter="transition ease-out duration-150"
                x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0"
                class="absolute left-0 top-full mt-1 w-36 rounded-xl border p-1 th-shadow-lg"
                style="background-color: var(--t-bg-card); border-color: var(--t-border);">
                <a href="{{ route('locale.switch', 'id') }}"
                    class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm transition-colors hover:th-bg-hover {{ app()->getLocale() === 'id' ? 'text-brand-500 font-semibold' : 'th-text-secondary' }}">
                    <img src="{{ asset('assets/icon/Flag_of_Indonesia.png') }}" alt="ID"
                        class="h-4 w-6 rounded-sm object-cover">
                    Indonesia
                </a>
                <a href="{{ route('locale.switch', 'en') }}"
                    class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm transition-colors hover:th-bg-hover {{ app()->getLocale() === 'en' ? 'text-brand-500 font-semibold' : 'th-text-secondary' }}">
                    <img src="{{ asset('assets/icon/Flag_of_UK.png') }}" alt="EN"
                        class="h-4 w-6 rounded-sm object-cover">
                    English
                </a>
            </div>
        </div>

        {{-- CENTER: Company Logos --}}
        <div class="flex items-center gap-3 sm:gap-5">
            <img src="{{ asset('assets/logo/aga.png') }}" alt="Logo" class="h-8 w-auto object-contain sm:h-9">
            <img src="{{ asset('assets/logo/bag.png') }}" alt="Logo" class="h-8 w-auto object-contain sm:h-9">
            <img src="{{ asset('assets/logo/mag.png') }}" alt="Logo" class="h-8 w-auto object-contain sm:h-9">
            <img src="{{ asset('assets/logo/mbg.jpg') }}" alt="Logo" class="h-8 w-auto rounded object-contain sm:h-9">
            <img src="{{ asset('assets/logo/sea.png') }}" alt="Logo" class="h-8 w-auto object-contain sm:h-9">
            <img src="{{ asset('assets/logo/tbg.png') }}" alt="Logo" class="h-8 w-auto object-contain sm:h-9">
        </div>

        {{-- RIGHT: Theme Toggle --}}
        <button @click="toggleTheme()"
            class="flex h-9 w-9 items-center justify-center rounded-lg border transition-all duration-200 hover:th-shadow"
            style="border-color: var(--t-border); background-color: var(--t-bg-input);"
            title="{{ app()->getLocale() === 'id' ? 'Ganti Tema' : 'Change Theme' }}">
            <svg x-show="isDark" x-cloak class="h-4.5 w-4.5 text-yellow-400" fill="none" viewBox="0 0 24 24"
                stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
            </svg>
            <svg x-show="!isDark" class="h-4.5 w-4.5 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" />
            </svg>
        </button>
    </div>
</header>