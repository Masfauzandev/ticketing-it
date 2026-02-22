<x-layouts.app>
    @section('page-title', __('messages.edit_profile'))
    @section('page-subtitle', __('messages.profile_subtitle'))

    <div class="mx-auto max-w-2xl">

        {{-- Back Button --}}
        <a href="{{ route('profile.show') }}"
            class="mb-6 inline-flex items-center gap-2 text-sm font-medium th-text-muted transition-colors hover:text-brand-500">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
            {{ __('messages.back_to_profile') }}
        </a>

        {{-- ═══ Edit Form Card ═══ --}}
        <div class="rounded-2xl border p-8 transition-colors duration-300"
            style="background-color: var(--t-bg-card); border-color: var(--t-border);">

            <div class="mb-6 flex items-center gap-3">
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-brand-500/10 text-brand-500">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-lg font-semibold th-text">{{ __('messages.edit_profile') }}</h2>
                    <p class="text-xs th-text-muted">{{ __('messages.profile_subtitle') }}</p>
                </div>
            </div>

            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PUT')

                <div class="space-y-5">

                    {{-- Full Name --}}
                    <div>
                        <label for="name" class="mb-1.5 block text-sm font-medium th-text">
                            {{ __('messages.full_name') }} <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required
                            class="w-full rounded-xl border px-4 py-2.5 text-sm transition-colors duration-200 th-text focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500/20"
                            style="background-color: var(--t-bg-input); border-color: var(--t-border);">
                        @error('name')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Call Name --}}
                    <div>
                        <label for="callname" class="mb-1.5 block text-sm font-medium th-text">
                            {{ __('messages.call_name') }}
                        </label>
                        <input type="text" id="callname" name="callname" value="{{ old('callname', $user->callname) }}"
                            class="w-full rounded-xl border px-4 py-2.5 text-sm transition-colors duration-200 th-text focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500/20"
                            style="background-color: var(--t-bg-input); border-color: var(--t-border);">
                        @error('callname')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Gender --}}
                    <div>
                        <label for="gender" class="mb-1.5 block text-sm font-medium th-text">
                            {{ __('messages.gender') }}
                        </label>
                        <select id="gender" name="gender"
                            class="w-full rounded-xl border px-4 py-2.5 text-sm transition-colors duration-200 th-text focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500/20"
                            style="background-color: var(--t-bg-input); border-color: var(--t-border);">
                            <option value="">{{ __('messages.select_gender') }}</option>
                            <option value="male" {{ old('gender', $user->gender) === 'male' ? 'selected' : '' }}>
                                {{ __('messages.gender_male') }}
                            </option>
                            <option value="female" {{ old('gender', $user->gender) === 'female' ? 'selected' : '' }}>
                                {{ __('messages.gender_female') }}
                            </option>
                        </select>
                        @error('gender')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Phone --}}
                    <div>
                        <label for="phone" class="mb-1.5 block text-sm font-medium th-text">
                            {{ __('messages.phone') }}
                        </label>
                        <input type="text" id="phone" name="phone" value="{{ old('phone', $user->phone) }}"
                            class="w-full rounded-xl border px-4 py-2.5 text-sm transition-colors duration-200 th-text focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500/20"
                            style="background-color: var(--t-bg-input); border-color: var(--t-border);"
                            placeholder="08xxxxxxxxxx">
                        @error('phone')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Employee ID --}}
                    <div>
                        <label for="employee_id" class="mb-1.5 block text-sm font-medium th-text">
                            {{ __('messages.employee_id') }}
                        </label>
                        <input type="text" id="employee_id" name="employee_id"
                            value="{{ old('employee_id', $user->employee_id) }}"
                            class="w-full rounded-xl border px-4 py-2.5 text-sm transition-colors duration-200 th-text focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500/20"
                            style="background-color: var(--t-bg-input); border-color: var(--t-border);"
                            placeholder="EMP-XXXX">
                        @error('employee_id')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Division --}}
                    <div>
                        <label for="department" class="mb-1.5 block text-sm font-medium th-text">
                            {{ __('messages.division') }}
                        </label>
                        @php
                            $divisions = ['IT', 'HRD', 'Finance', 'Marketing', 'Sales', 'Operations', 'Legal', 'Procurement', 'Logistic', 'General Affairs'];
                        @endphp
                        <select id="department" name="department"
                            class="w-full rounded-xl border px-4 py-2.5 text-sm transition-colors duration-200 th-text focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500/20"
                            style="background-color: var(--t-bg-input); border-color: var(--t-border);">
                            <option value="">{{ __('messages.select_division') }}</option>
                            @foreach($divisions as $div)
                                <option value="{{ $div }}" {{ old('department', $user->department) === $div ? 'selected' : '' }}>
                                    {{ $div }}
                                </option>
                            @endforeach
                        </select>
                        @error('department')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Branch --}}
                    <div>
                        <label for="branch" class="mb-1.5 block text-sm font-medium th-text">
                            {{ __('messages.branch') }}
                        </label>
                        @php
                            $branches = ['Jakarta - Head Office', 'Surabaya', 'Bandung', 'Medan', 'Semarang', 'Makassar', 'Denpasar', 'Palembang', 'Yogyakarta', 'Balikpapan'];
                        @endphp
                        <select id="branch" name="branch"
                            class="w-full rounded-xl border px-4 py-2.5 text-sm transition-colors duration-200 th-text focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500/20"
                            style="background-color: var(--t-bg-input); border-color: var(--t-border);">
                            <option value="">{{ __('messages.select_branch') }}</option>
                            @foreach($branches as $br)
                                <option value="{{ $br }}" {{ old('branch', $user->branch) === $br ? 'selected' : '' }}>
                                    {{ $br }}
                                </option>
                            @endforeach
                        </select>
                        @error('branch')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Office Email --}}
                    <div>
                        <label for="email" class="mb-1.5 block text-sm font-medium th-text">
                            {{ __('messages.office_email') }}
                        </label>
                        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                            class="w-full rounded-xl border px-4 py-2.5 text-sm transition-colors duration-200 th-text focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500/20"
                            style="background-color: var(--t-bg-input); border-color: var(--t-border);"
                            placeholder="nama@perusahaan.com">
                        @error('email')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                {{-- Buttons --}}
                <div class="mt-8 flex items-center justify-end gap-3">
                    <a href="{{ route('profile.show') }}"
                        class="rounded-xl border px-5 py-2.5 text-sm font-medium th-text-secondary transition-colors hover:th-bg-hover"
                        style="border-color: var(--t-border);">
                        {{ __('messages.cancel') }}
                    </a>
                    <button type="submit"
                        class="inline-flex items-center gap-2 rounded-xl bg-brand-600 px-5 py-2.5 text-sm font-semibold text-white shadow-lg shadow-brand-500/25 transition-all duration-200 hover:bg-brand-500 hover:shadow-brand-500/40 hover:-translate-y-0.5">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                        </svg>
                        {{ __('messages.save_changes') }}
                    </button>
                </div>

            </form>
        </div>

    </div>

</x-layouts.app>