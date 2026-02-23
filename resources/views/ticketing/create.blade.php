<x-layouts.app>
    @section('page-title', 'Buat Tiket Baru')
    @section('page-subtitle', 'Ticketing System')

    <div class="mx-auto max-w-3xl">

        {{-- Back --}}
        <a href="{{ route('ticketing.index') }}"
            class="mb-6 inline-flex items-center gap-2 text-sm th-text-muted transition hover:text-brand-500">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
            Kembali ke Daftar Tiket
        </a>

        {{-- Form Card --}}
        <div class="rounded-2xl border p-6 transition-colors duration-300"
            style="background-color: var(--t-bg-card); border-color: var(--t-border);">

            <div class="mb-6 flex items-center gap-3">
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-brand-500/10 text-brand-500">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 0 1 0 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 0 1 0-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375Z" />
                    </svg>
                </div>
                <h2 class="text-lg font-semibold th-text">Buat Tiket Baru</h2>
            </div>

            <form action="{{ route('ticketing.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf

                {{-- Subject --}}
                <div>
                    <label for="subject" class="mb-1.5 block text-sm font-medium th-text">Subject <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="subject" id="subject" value="{{ old('subject') }}" required
                        placeholder="Jelaskan masalah secara singkat..."
                        class="w-full rounded-xl border px-4 py-2.5 text-sm th-text transition-colors focus:border-brand-500 focus:outline-none focus:ring-1 focus:ring-brand-500 @error('subject') border-red-500 @enderror"
                        style="background-color: var(--t-bg-input); border-color: var(--t-border);">
                    @error('subject')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Category & Priority --}}
                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <label for="category_id" class="mb-1.5 block text-sm font-medium th-text">Kategori <span
                                class="text-red-500">*</span></label>
                        <select name="category_id" id="category_id" required
                            class="w-full rounded-xl border px-4 py-2.5 text-sm th-text transition-colors focus:border-brand-500 focus:outline-none @error('category_id') border-red-500 @enderror"
                            style="background-color: var(--t-bg-input); border-color: var(--t-border);">
                            <option value="">Pilih Kategori</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="priority" class="mb-1.5 block text-sm font-medium th-text">Prioritas <span
                                class="text-red-500">*</span></label>
                        <select name="priority" id="priority" required
                            class="w-full rounded-xl border px-4 py-2.5 text-sm th-text transition-colors focus:border-brand-500 focus:outline-none @error('priority') border-red-500 @enderror"
                            style="background-color: var(--t-bg-input); border-color: var(--t-border);">
                            <option value="low" {{ old('priority') === 'low' ? 'selected' : '' }}>Low</option>
                            <option value="medium" {{ old('priority', 'medium') === 'medium' ? 'selected' : '' }}>Medium
                            </option>
                            <option value="high" {{ old('priority') === 'high' ? 'selected' : '' }}>High</option>
                            <option value="critical" {{ old('priority') === 'critical' ? 'selected' : '' }}>Critical
                            </option>
                        </select>
                        @error('priority')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Description --}}
                <div>
                    <label for="description" class="mb-1.5 block text-sm font-medium th-text">Deskripsi <span
                            class="text-red-500">*</span></label>
                    <textarea name="description" id="description" rows="8" required
                        placeholder="Jelaskan masalah Anda secara detail. Sertakan langkah-langkah untuk mereproduksi masalah jika ada..."
                        class="w-full rounded-xl border px-4 py-3 text-sm th-text transition-colors focus:border-brand-500 focus:outline-none focus:ring-1 focus:ring-brand-500 resize-y @error('description') border-red-500 @enderror"
                        style="background-color: var(--t-bg-input); border-color: var(--t-border);">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Attachments --}}
                <div>
                    <label class="mb-1.5 block text-sm font-medium th-text">Lampiran <span
                            class="text-xs th-text-muted font-normal">(Opsional, max 10MB/file)</span></label>
                    <div class="rounded-xl border-2 border-dashed p-6 text-center transition-colors hover:border-brand-500/50"
                        style="border-color: var(--t-border);">
                        <svg class="mx-auto h-10 w-10 th-text-faint" fill="none" viewBox="0 0 24 24" stroke-width="1"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m18.375 12.739-7.693 7.693a4.5 4.5 0 0 1-6.364-6.364l10.94-10.94A3 3 0 1 1 19.5 7.372L8.552 18.32m.009-.01-.01.01m5.699-9.941-7.81 7.81a1.5 1.5 0 0 0 2.112 2.13" />
                        </svg>
                        <p class="mt-2 text-sm th-text-muted">Drag & drop file atau</p>
                        <label
                            class="mt-2 inline-flex cursor-pointer items-center gap-2 rounded-lg bg-brand-500/10 px-4 py-2 text-sm font-medium text-brand-500 transition hover:bg-brand-500/20">
                            <span>Pilih File</span>
                            <input type="file" name="attachments[]" multiple class="hidden"
                                accept=".jpg,.jpeg,.png,.gif,.pdf,.doc,.docx,.xls,.xlsx,.zip,.rar">
                        </label>
                    </div>
                </div>

                {{-- Actions --}}
                <div class="flex items-center justify-end gap-3 pt-4 border-t" style="border-color: var(--t-border);">
                    <a href="{{ route('ticketing.index') }}"
                        class="rounded-xl border px-5 py-2.5 text-sm font-medium th-text-secondary transition hover:th-bg-hover"
                        style="border-color: var(--t-border);">
                        Batal
                    </a>
                    <button type="submit"
                        class="rounded-xl bg-brand-600 px-6 py-2.5 text-sm font-medium text-white shadow-lg shadow-brand-500/25 transition hover:bg-brand-700">
                        Kirim Tiket
                    </button>
                </div>
            </form>
        </div>
    </div>

</x-layouts.app>