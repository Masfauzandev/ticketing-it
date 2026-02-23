<x-layouts.app>
    @section('page-title', 'Kelola Kategori Tiket')
    @section('page-subtitle', 'Ticketing System')

    <div class="mx-auto max-w-4xl">

        {{-- Back --}}
        <a href="{{ route('ticketing.index') }}"
            class="mb-6 inline-flex items-center gap-2 text-sm th-text-muted transition hover:text-brand-500">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
            Kembali ke Ticketing
        </a>

        <div class="mb-6 flex items-center justify-between">
            <h1 class="text-2xl font-bold th-text">Kelola Kategori Tiket</h1>
        </div>

        <div class="grid gap-6 lg:grid-cols-3">

            {{-- Add Category Form --}}
            <div class="lg:col-span-1">
                <div class="rounded-2xl border p-6 transition-colors duration-300"
                    style="background-color: var(--t-bg-card); border-color: var(--t-border);">
                    <h3 class="mb-4 text-sm font-semibold th-text">Tambah Kategori</h3>
                    <form action="{{ route('ticketing.categories.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="mb-1 block text-xs font-medium th-text-muted">Nama</label>
                            <input type="text" name="name" value="{{ old('name') }}" required
                                class="w-full rounded-xl border px-3 py-2 text-sm th-text focus:border-brand-500 focus:outline-none @error('name') border-red-500 @enderror"
                                style="background-color: var(--t-bg-input); border-color: var(--t-border);">
                            @error('name')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="mb-1 block text-xs font-medium th-text-muted">Deskripsi</label>
                            <textarea name="description" rows="3"
                                class="w-full rounded-xl border px-3 py-2 text-sm th-text focus:border-brand-500 focus:outline-none resize-y"
                                style="background-color: var(--t-bg-input); border-color: var(--t-border);">{{ old('description') }}</textarea>
                        </div>
                        <button type="submit"
                            class="w-full rounded-xl bg-brand-600 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-brand-700">
                            Tambah Kategori
                        </button>
                    </form>
                </div>
            </div>

            {{-- Categories List --}}
            <div class="lg:col-span-2">
                <div class="rounded-2xl border overflow-hidden transition-colors duration-300"
                    style="background-color: var(--t-bg-card); border-color: var(--t-border);">
                    @forelse($categories as $category)
                        <div x-data="{ editing: false }" class="border-b p-4 transition-colors last:border-b-0"
                            style="border-color: var(--t-border);">

                            {{-- Display --}}
                            <div x-show="!editing" class="flex items-center justify-between">
                                <div>
                                    <div class="flex items-center gap-2">
                                        <h4 class="text-sm font-semibold th-text">{{ $category->name }}</h4>
                                        <span
                                            class="rounded-full px-2 py-0.5 text-[10px] font-medium {{ $category->is_active ? 'bg-green-500/10 text-green-600 dark:text-green-400' : 'bg-red-500/10 text-red-600 dark:text-red-400' }}">
                                            {{ $category->is_active ? 'Aktif' : 'Nonaktif' }}
                                        </span>
                                        <span
                                            class="rounded-full bg-brand-500/10 px-2 py-0.5 text-[10px] font-medium text-brand-500">
                                            {{ $category->tickets_count }} tiket
                                        </span>
                                    </div>
                                    @if($category->description)
                                        <p class="mt-1 text-xs th-text-muted">{{ $category->description }}</p>
                                    @endif
                                </div>
                                <div class="flex items-center gap-2">
                                    <button @click="editing = true"
                                        class="rounded-lg p-1.5 th-text-muted transition hover:th-bg-hover hover:text-brand-500">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125" />
                                        </svg>
                                    </button>
                                    @if($category->tickets_count === 0)
                                        <form action="{{ route('ticketing.categories.destroy', $category) }}" method="POST"
                                            onsubmit="return confirm('Yakin hapus kategori ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="rounded-lg p-1.5 text-red-500 transition hover:bg-red-500/10">
                                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                </svg>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>

                            {{-- Edit Form --}}
                            <div x-show="editing" x-cloak>
                                <form action="{{ route('ticketing.categories.update', $category) }}" method="POST"
                                    class="space-y-3">
                                    @csrf
                                    @method('PUT')
                                    <input type="text" name="name" value="{{ $category->name }}" required
                                        class="w-full rounded-xl border px-3 py-2 text-sm th-text focus:border-brand-500 focus:outline-none"
                                        style="background-color: var(--t-bg-input); border-color: var(--t-border);">
                                    <textarea name="description" rows="2"
                                        class="w-full rounded-xl border px-3 py-2 text-sm th-text focus:border-brand-500 focus:outline-none resize-y"
                                        style="background-color: var(--t-bg-input); border-color: var(--t-border);">{{ $category->description }}</textarea>
                                    <div class="flex items-center gap-3">
                                        <label class="flex items-center gap-2 text-sm th-text-muted">
                                            <input type="hidden" name="is_active" value="0">
                                            <input type="checkbox" name="is_active" value="1" {{ $category->is_active ? 'checked' : '' }}
                                                class="rounded border-gray-300 text-brand-600 focus:ring-brand-500">
                                            Aktif
                                        </label>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <button type="submit"
                                            class="rounded-xl bg-brand-600 px-4 py-2 text-sm font-medium text-white transition hover:bg-brand-700">
                                            Simpan
                                        </button>
                                        <button type="button" @click="editing = false"
                                            class="rounded-xl border px-4 py-2 text-sm th-text-secondary transition hover:th-bg-hover"
                                            style="border-color: var(--t-border);">
                                            Batal
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="p-8 text-center">
                            <p class="text-sm th-text-muted">Belum ada kategori</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

</x-layouts.app>