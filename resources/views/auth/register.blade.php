<x-layouts.auth>
    @section('title', __('messages.register_title'))

    <div class="flex min-h-[calc(100vh-8rem)] items-center justify-center px-4 py-10">

        <div class="animate-slide-up w-full max-w-4xl">

            {{-- Header --}}
            <div class="mb-8 text-center">
                <div
                    class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-gradient-to-br from-brand-500 to-brand-700 shadow-xl shadow-brand-500/25">
                    <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                    </svg>
                </div>
                <h1 class="text-2xl font-bold tracking-tight th-text">{{ __('messages.register_title') }}</h1>
                <p class="mt-1 text-sm th-text-muted">{{ __('messages.register_subtitle') }}</p>
            </div>

            {{-- Errors --}}
            @if($errors->any())
                <div class="mb-6 flex items-start gap-3 rounded-xl border border-red-500/20 bg-red-500/10 px-4 py-3">
                    <svg class="mt-0.5 h-5 w-5 shrink-0 text-red-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                    </svg>
                    <div>
                        @foreach($errors->all() as $error)
                            <p class="text-sm text-red-500">{{ $error }}</p>
                        @endforeach
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ url('/register') }}" x-data="{ showPassword: false }">
                @csrf

                <div class="grid gap-6 lg:grid-cols-5">

                    {{-- ═══════════ CARD 1: BIODATA KARYAWAN ═══════════ --}}
                    <div class="lg:col-span-3 rounded-2xl border p-6 th-shadow-lg backdrop-blur-xl transition-colors duration-300"
                        style="background-color: var(--t-bg-card); border-color: var(--t-border);">

                        {{-- Card Header --}}
                        <div class="mb-6 flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-brand-500/10">
                                <svg class="h-5 w-5 text-brand-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-base font-semibold th-text">{{ __('messages.biodata_card_title') }}</h2>
                                <p class="text-xs th-text-muted">{{ __('messages.biodata_card_subtitle') }}</p>
                            </div>
                        </div>

                        <div class="space-y-4">
                            {{-- Row 1: Full Name & Call Name --}}
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="name"
                                        class="mb-1.5 block text-xs font-semibold uppercase tracking-wider th-text-muted">{{ __('messages.full_name') }}
                                        <span class="text-red-500">*</span></label>
                                    <input type="text" id="name" name="name" value="{{ old('name') }}" required
                                        class="th-input w-full rounded-xl border px-4 py-2.5 text-sm transition focus:outline-none focus:ring-2 focus:ring-brand-500/20"
                                        placeholder="{{ __('messages.full_name') }}">
                                </div>
                                <div>
                                    <label for="callname"
                                        class="mb-1.5 block text-xs font-semibold uppercase tracking-wider th-text-muted">{{ __('messages.call_name') }}</label>
                                    <input type="text" id="callname" name="callname" value="{{ old('callname') }}"
                                        class="th-input w-full rounded-xl border px-4 py-2.5 text-sm transition focus:outline-none focus:ring-2 focus:ring-brand-500/20"
                                        placeholder="{{ __('messages.call_name') }}">
                                </div>
                            </div>

                            {{-- Row 2: Gender & Employee ID --}}
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="gender"
                                        class="mb-1.5 block text-xs font-semibold uppercase tracking-wider th-text-muted">{{ __('messages.gender') }}
                                        <span class="text-red-500">*</span></label>
                                    <select id="gender" name="gender" required
                                        class="th-input w-full rounded-xl border px-4 py-2.5 text-sm transition focus:outline-none focus:ring-2 focus:ring-brand-500/20 appearance-none bg-[url('data:image/svg+xml;charset=UTF-8,%3Csvg%20xmlns%3D%22http%3A//www.w3.org/2000/svg%22%20viewBox%3D%220%200%2020%2020%22%20fill%3D%22%239CA3AF%22%3E%3Cpath%20fill-rule%3D%22evenodd%22%20d%3D%22M5.22%208.22a.75.75%200%20011.06%200L10%2011.94l3.72-3.72a.75.75%200%20111.06%201.06l-4.25%204.25a.75.75%200%2001-1.06%200L5.22%209.28a.75.75%200%20010-1.06z%22/%3E%3C/svg%3E')] bg-[length:1.25rem] bg-[right_0.75rem_center] bg-no-repeat pr-10">
                                        <option value="">{{ __('messages.select_gender') }}</option>
                                        <option value="male" {{ old('gender') === 'male' ? 'selected' : '' }}>
                                            {{ __('messages.gender_male') }}</option>
                                        <option value="female" {{ old('gender') === 'female' ? 'selected' : '' }}>
                                            {{ __('messages.gender_female') }}</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="employee_id"
                                        class="mb-1.5 block text-xs font-semibold uppercase tracking-wider th-text-muted">{{ __('messages.employee_id') }}</label>
                                    <input type="text" id="employee_id" name="employee_id"
                                        value="{{ old('employee_id') }}"
                                        class="th-input w-full rounded-xl border px-4 py-2.5 text-sm transition focus:outline-none focus:ring-2 focus:ring-brand-500/20"
                                        placeholder="EMP-XXXX">
                                </div>
                            </div>

                            {{-- Row 3: Divisi & Cabang (Dropdown) --}}
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="department"
                                        class="mb-1.5 block text-xs font-semibold uppercase tracking-wider th-text-muted">{{ __('messages.division') }}
                                        <span class="text-red-500">*</span></label>
                                    <select id="department" name="department" required
                                        class="th-input w-full rounded-xl border px-4 py-2.5 text-sm transition focus:outline-none focus:ring-2 focus:ring-brand-500/20 appearance-none bg-[url('data:image/svg+xml;charset=UTF-8,%3Csvg%20xmlns%3D%22http%3A//www.w3.org/2000/svg%22%20viewBox%3D%220%200%2020%2020%22%20fill%3D%22%239CA3AF%22%3E%3Cpath%20fill-rule%3D%22evenodd%22%20d%3D%22M5.22%208.22a.75.75%200%20011.06%200L10%2011.94l3.72-3.72a.75.75%200%20111.06%201.06l-4.25%204.25a.75.75%200%2001-1.06%200L5.22%209.28a.75.75%200%20010-1.06z%22/%3E%3C/svg%3E')] bg-[length:1.25rem] bg-[right_0.75rem_center] bg-no-repeat pr-10">
                                        <option value="">{{ __('messages.select_division') }}</option>
                                        @php
                                            $divisions = ['IT', 'HRD', 'Finance', 'Marketing', 'Sales', 'Operations', 'Legal', 'Procurement', 'Logistic', 'General Affairs'];
                                        @endphp
                                        @foreach($divisions as $div)
                                            <option value="{{ $div }}" {{ old('department') === $div ? 'selected' : '' }}>
                                                {{ $div }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label for="branch"
                                        class="mb-1.5 block text-xs font-semibold uppercase tracking-wider th-text-muted">{{ __('messages.branch') }}
                                        <span class="text-red-500">*</span></label>
                                    <select id="branch" name="branch" required
                                        class="th-input w-full rounded-xl border px-4 py-2.5 text-sm transition focus:outline-none focus:ring-2 focus:ring-brand-500/20 appearance-none bg-[url('data:image/svg+xml;charset=UTF-8,%3Csvg%20xmlns%3D%22http%3A//www.w3.org/2000/svg%22%20viewBox%3D%220%200%2020%2020%22%20fill%3D%22%239CA3AF%22%3E%3Cpath%20fill-rule%3D%22evenodd%22%20d%3D%22M5.22%208.22a.75.75%200%20011.06%200L10%2011.94l3.72-3.72a.75.75%200%20111.06%201.06l-4.25%204.25a.75.75%200%2001-1.06%200L5.22%209.28a.75.75%200%20010-1.06z%22/%3E%3C/svg%3E')] bg-[length:1.25rem] bg-[right_0.75rem_center] bg-no-repeat pr-10">
                                        <option value="">{{ __('messages.select_branch') }}</option>
                                        @php
                                            $branches = ['Jakarta - Head Office', 'Surabaya', 'Bandung', 'Medan', 'Semarang', 'Makassar', 'Denpasar', 'Palembang', 'Yogyakarta', 'Balikpapan'];
                                        @endphp
                                        @foreach($branches as $br)
                                            <option value="{{ $br }}" {{ old('branch') === $br ? 'selected' : '' }}>{{ $br }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- Row 4: No HP & Office Email --}}
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="phone"
                                        class="mb-1.5 block text-xs font-semibold uppercase tracking-wider th-text-muted">{{ __('messages.phone') }}</label>
                                    <input type="text" id="phone" name="phone" value="{{ old('phone') }}"
                                        class="th-input w-full rounded-xl border px-4 py-2.5 text-sm transition focus:outline-none focus:ring-2 focus:ring-brand-500/20"
                                        placeholder="08xxxxxxxxxx">
                                </div>
                                <div>
                                    <label for="email"
                                        class="mb-1.5 block text-xs font-semibold uppercase tracking-wider th-text-muted">{{ __('messages.office_email') }}
                                        <span class="text-red-500">*</span></label>
                                    <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                        class="th-input w-full rounded-xl border px-4 py-2.5 text-sm transition focus:outline-none focus:ring-2 focus:ring-brand-500/20"
                                        placeholder="nama@perusahaan.com">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- ═══════════ CARD 2: INFORMASI AKUN ═══════════ --}}
                    <div class="lg:col-span-2 flex flex-col">
                        <div class="flex-1 rounded-2xl border p-6 th-shadow-lg backdrop-blur-xl transition-colors duration-300"
                            style="background-color: var(--t-bg-card); border-color: var(--t-border);">

                            {{-- Card Header --}}
                            <div class="mb-6 flex items-center gap-3">
                                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-purple-500/10">
                                    <svg class="h-5 w-5 text-purple-500" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                                    </svg>
                                </div>
                                <div>
                                    <h2 class="text-base font-semibold th-text">{{ __('messages.account_card_title') }}
                                    </h2>
                                    <p class="text-xs th-text-muted">{{ __('messages.account_card_subtitle') }}</p>
                                </div>
                            </div>

                            <div class="space-y-4">
                                {{-- Username --}}
                                <div>
                                    <label for="username"
                                        class="mb-1.5 block text-xs font-semibold uppercase tracking-wider th-text-muted">{{ __('messages.username') }}
                                        <span class="text-red-500">*</span></label>
                                    <div class="relative">
                                        <div
                                            class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                                            <span class="text-sm th-text-faint">@</span>
                                        </div>
                                        <input type="text" id="username" name="username" value="{{ old('username') }}"
                                            required
                                            class="th-input w-full rounded-xl border py-2.5 pl-9 pr-4 text-sm transition focus:outline-none focus:ring-2 focus:ring-brand-500/20"
                                            placeholder="username">
                                    </div>
                                </div>

                                {{-- Password --}}
                                <div>
                                    <label for="password"
                                        class="mb-1.5 block text-xs font-semibold uppercase tracking-wider th-text-muted">{{ __('messages.password') }}
                                        <span class="text-red-500">*</span></label>
                                    <div class="relative">
                                        <input :type="showPassword ? 'text' : 'password'" id="password" name="password"
                                            required
                                            class="th-input w-full rounded-xl border px-4 py-2.5 pr-12 text-sm transition focus:outline-none focus:ring-2 focus:ring-brand-500/20"
                                            placeholder="{{ __('messages.min_chars') }}">
                                        <button type="button" @click="showPassword = !showPassword"
                                            class="absolute inset-y-0 right-0 flex items-center pr-4 th-text-faint hover:th-text-secondary transition">
                                            <svg x-show="!showPassword" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                            </svg>
                                            <svg x-show="showPassword" x-cloak class="h-4 w-4" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                                {{-- Confirm Password --}}
                                <div>
                                    <label for="password_confirmation"
                                        class="mb-1.5 block text-xs font-semibold uppercase tracking-wider th-text-muted">{{ __('messages.confirm_password') }}
                                        <span class="text-red-500">*</span></label>
                                    <input :type="showPassword ? 'text' : 'password'" id="password_confirmation"
                                        name="password_confirmation" required
                                        class="th-input w-full rounded-xl border px-4 py-2.5 text-sm transition focus:outline-none focus:ring-2 focus:ring-brand-500/20"
                                        placeholder="{{ __('messages.confirm_password') }}">
                                </div>
                            </div>

                            {{-- Divider + Submit --}}
                            <div class="mt-6 border-t pt-6" style="border-color: var(--t-border);">
                                <button type="submit"
                                    class="group relative w-full overflow-hidden rounded-xl bg-gradient-to-r from-brand-600 to-brand-500 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-brand-500/25 transition-all duration-300 hover:shadow-xl hover:shadow-brand-500/30 active:scale-[0.98]">
                                    <span class="relative z-10 flex items-center justify-center gap-2">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                                        </svg>
                                        {{ __('messages.register_btn') }}
                                    </span>
                                    <div
                                        class="absolute inset-0 -translate-x-full bg-gradient-to-r from-transparent via-white/10 to-transparent transition-transform duration-700 group-hover:translate-x-full">
                                    </div>
                                </button>

                                <p class="mt-4 text-center text-sm th-text-muted">
                                    {{ __('messages.have_account') }}
                                    <a href="{{ url('/login') }}"
                                        class="font-medium text-brand-500 hover:text-brand-400 transition">{{ __('messages.login_here') }}</a>
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>

</x-layouts.auth>