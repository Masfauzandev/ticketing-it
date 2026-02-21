<x-layouts.auth>
    @section('title', 'Daftar Akun')

    <div class="relative flex min-h-screen items-center justify-center overflow-hidden px-4 py-8">

        {{-- ═══ Animated Background ═══ --}}
        <div class="pointer-events-none absolute inset-0">
            <div class="animate-float absolute -left-32 -top-32 h-96 w-96 rounded-full bg-brand-600/20 blur-[120px]">
            </div>
            <div
                class="animate-float-delayed absolute -bottom-32 -right-32 h-96 w-96 rounded-full bg-purple-600/15 blur-[120px]">
            </div>
            <div
                class="absolute inset-0 bg-[linear-gradient(rgba(99,102,241,0.03)_1px,transparent_1px),linear-gradient(90deg,rgba(99,102,241,0.03)_1px,transparent_1px)] bg-[size:60px_60px]">
            </div>
        </div>

        {{-- ═══ Register Card ═══ --}}
        <div class="animate-slide-up relative z-10 w-full max-w-lg">

            {{-- Logo & Header --}}
            <div class="mb-8 text-center">
                <div
                    class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-gradient-to-br from-brand-500 to-brand-700 shadow-xl shadow-brand-500/25">
                    <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                    </svg>
                </div>
                <h1 class="text-2xl font-bold tracking-tight text-white">Buat Akun Baru</h1>
                <p class="mt-1 text-sm text-white/50">Daftar untuk menggunakan IT Support System</p>
            </div>

            {{-- Card Body --}}
            <div class="rounded-2xl border border-white/[0.06] bg-surface-900/80 p-8 shadow-2xl backdrop-blur-xl">

                @if($errors->any())
                    <div class="mb-6 flex items-start gap-3 rounded-xl border border-red-500/20 bg-red-500/10 px-4 py-3">
                        <svg class="mt-0.5 h-5 w-5 shrink-0 text-red-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                        </svg>
                        <div>
                            @foreach($errors->all() as $error)
                                <p class="text-sm text-red-400">{{ $error }}</p>
                            @endforeach
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ url('/register') }}" class="space-y-4" x-data="{ showPassword: false }">
                    @csrf

                    {{-- Name --}}
                    <div>
                        <label for="name"
                            class="mb-1.5 block text-xs font-semibold uppercase tracking-wider text-white/40">Nama
                            Lengkap</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required
                            class="w-full rounded-xl border border-white/[0.06] bg-white/[0.03] px-4 py-3 text-sm text-white placeholder-white/25 transition focus:border-brand-500/50 focus:bg-white/[0.05] focus:outline-none focus:ring-2 focus:ring-brand-500/20"
                            placeholder="Nama Lengkap Anda">
                    </div>

                    {{-- Username --}}
                    <div>
                        <label for="username"
                            class="mb-1.5 block text-xs font-semibold uppercase tracking-wider text-white/40">Username</label>
                        <input type="text" id="username" name="username" value="{{ old('username') }}" required
                            class="w-full rounded-xl border border-white/[0.06] bg-white/[0.03] px-4 py-3 text-sm text-white placeholder-white/25 transition focus:border-brand-500/50 focus:bg-white/[0.05] focus:outline-none focus:ring-2 focus:ring-brand-500/20"
                            placeholder="username_anda">
                    </div>

                    {{-- Email --}}
                    <div>
                        <label for="email"
                            class="mb-1.5 block text-xs font-semibold uppercase tracking-wider text-white/40">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required
                            class="w-full rounded-xl border border-white/[0.06] bg-white/[0.03] px-4 py-3 text-sm text-white placeholder-white/25 transition focus:border-brand-500/50 focus:bg-white/[0.05] focus:outline-none focus:ring-2 focus:ring-brand-500/20"
                            placeholder="email@perusahaan.com">
                    </div>

                    {{-- Two columns: Phone & Department --}}
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="phone"
                                class="mb-1.5 block text-xs font-semibold uppercase tracking-wider text-white/40">No.
                                HP</label>
                            <input type="text" id="phone" name="phone" value="{{ old('phone') }}"
                                class="w-full rounded-xl border border-white/[0.06] bg-white/[0.03] px-4 py-3 text-sm text-white placeholder-white/25 transition focus:border-brand-500/50 focus:bg-white/[0.05] focus:outline-none focus:ring-2 focus:ring-brand-500/20"
                                placeholder="08xxxxxxxxxx">
                        </div>
                        <div>
                            <label for="department"
                                class="mb-1.5 block text-xs font-semibold uppercase tracking-wider text-white/40">Divisi</label>
                            <input type="text" id="department" name="department" value="{{ old('department') }}"
                                class="w-full rounded-xl border border-white/[0.06] bg-white/[0.03] px-4 py-3 text-sm text-white placeholder-white/25 transition focus:border-brand-500/50 focus:bg-white/[0.05] focus:outline-none focus:ring-2 focus:ring-brand-500/20"
                                placeholder="IT, HRD, dll">
                        </div>
                    </div>

                    {{-- Password --}}
                    <div>
                        <label for="password"
                            class="mb-1.5 block text-xs font-semibold uppercase tracking-wider text-white/40">Password</label>
                        <div class="relative">
                            <input :type="showPassword ? 'text' : 'password'" id="password" name="password" required
                                class="w-full rounded-xl border border-white/[0.06] bg-white/[0.03] px-4 py-3 pr-12 text-sm text-white placeholder-white/25 transition focus:border-brand-500/50 focus:bg-white/[0.05] focus:outline-none focus:ring-2 focus:ring-brand-500/20"
                                placeholder="Minimal 8 karakter">
                            <button type="button" @click="showPassword = !showPassword"
                                class="absolute inset-y-0 right-0 flex items-center pr-4 text-white/30 hover:text-white/60">
                                <svg x-show="!showPassword" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                                <svg x-show="showPassword" x-cloak class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    {{-- Confirm Password --}}
                    <div>
                        <label for="password_confirmation"
                            class="mb-1.5 block text-xs font-semibold uppercase tracking-wider text-white/40">Konfirmasi
                            Password</label>
                        <input :type="showPassword ? 'text' : 'password'" id="password_confirmation"
                            name="password_confirmation" required
                            class="w-full rounded-xl border border-white/[0.06] bg-white/[0.03] px-4 py-3 text-sm text-white placeholder-white/25 transition focus:border-brand-500/50 focus:bg-white/[0.05] focus:outline-none focus:ring-2 focus:ring-brand-500/20"
                            placeholder="Ulangi password">
                    </div>

                    {{-- Submit --}}
                    <button type="submit"
                        class="group relative mt-2 w-full overflow-hidden rounded-xl bg-gradient-to-r from-brand-600 to-brand-500 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-brand-500/25 transition-all duration-300 hover:shadow-xl hover:shadow-brand-500/30 active:scale-[0.98]">
                        <span class="relative z-10 flex items-center justify-center gap-2">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                            </svg>
                            Daftar
                        </span>
                        <div
                            class="absolute inset-0 -translate-x-full bg-gradient-to-r from-transparent via-white/10 to-transparent transition-transform duration-700 group-hover:translate-x-full">
                        </div>
                    </button>
                </form>

                <div class="mt-6 text-center">
                    <p class="text-sm text-white/40">
                        Sudah punya akun?
                        <a href="{{ url('/login') }}"
                            class="font-medium text-brand-400 transition hover:text-brand-300">Masuk di sini</a>
                    </p>
                </div>
            </div>

            <p class="mt-8 text-center text-xs text-white/20">&copy; {{ date('Y') }} IT Support System. All rights
                reserved.</p>
        </div>
    </div>

</x-layouts.auth>