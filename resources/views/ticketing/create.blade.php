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

                {{-- Category --}}
                <div>
                    <label for="category_id" class="mb-1.5 block text-sm font-medium th-text">Kategori <span
                            class="text-red-500">*</span></label>
                    <select name="category_id" id="category_id" required
                        class="w-full rounded-xl border px-4 py-2.5 text-sm th-text transition-colors focus:border-brand-500 focus:outline-none @error('category_id') border-red-500 @enderror"
                        style="background-color: var(--t-bg-input); border-color: var(--t-border);">
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- CC Users (Multi-select) --}}
                <div x-data="ccSelect()" class="relative">
                    <label class="mb-1.5 block text-sm font-medium th-text">CC
                        <span class="text-xs th-text-muted font-normal">(Opsional)</span>
                    </label>

                    {{-- Selected chips + search input --}}
                    <div @click="open = true; $nextTick(() => $refs.searchInput.focus())"
                        class="min-h-[42px] w-full cursor-text rounded-xl border px-3 py-2 flex flex-wrap items-center gap-1.5 transition-colors"
                        :class="open ? 'border-brand-500 ring-1 ring-brand-500' : ''"
                        style="background-color: var(--t-bg-input); border-color: var(--t-border);">

                        {{-- Selected user chips --}}
                        <template x-for="userId in selected" :key="userId">
                            <span
                                class="inline-flex items-center gap-1 rounded-lg bg-brand-500/15 px-2.5 py-1 text-xs font-medium text-brand-600">
                                <span x-text="getUserName(userId)"></span>
                                <button type="button" @click.stop="removeUser(userId)"
                                    class="ml-0.5 rounded-full hover:bg-brand-500/20 p-0.5">
                                    <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </span>
                        </template>

                        {{-- Search input --}}
                        <input type="text" x-ref="searchInput" x-model="search" @focus="open = true" @click.stop
                            @keydown.backspace="search === '' && selected.length > 0 ? removeUser(selected[selected.length - 1]) : null"
                            placeholder="Cari user..."
                            class="flex-1 min-w-[100px] border-0 bg-transparent p-0 text-sm th-text focus:outline-none focus:ring-0"
                            autocomplete="off">
                    </div>

                    {{-- Dropdown list --}}
                    <div x-show="open" @click.away="open = false" x-transition
                        class="absolute z-50 mt-1 w-full rounded-xl border shadow-xl overflow-hidden"
                        style="background-color: var(--t-bg-card); border-color: var(--t-border);">
                        <div class="max-h-48 overflow-y-auto p-1">
                            <template x-for="user in filteredUsers" :key="user.id">
                                <button type="button" @click="toggleUser(user.id)"
                                    class="w-full flex items-center gap-3 rounded-lg px-3 py-2 text-sm transition hover:bg-brand-500/10"
                                    :class="selected.includes(user.id) ? 'bg-brand-500/10 text-brand-600' : 'th-text'">
                                    <div class="flex h-7 w-7 items-center justify-center rounded-full text-xs font-semibold text-white"
                                        :style="'background-color: ' + stringToColor(user.name)">
                                        <span x-text="user.name.charAt(0).toUpperCase()"></span>
                                    </div>
                                    <span class="flex-1 text-left" x-text="user.name"></span>
                                    <svg x-show="selected.includes(user.id)" class="h-4 w-4 text-brand-500" fill="none"
                                        viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M4.5 12.75l6 6 9-13.5" />
                                    </svg>
                                </button>
                            </template>
                            <div x-show="filteredUsers.length === 0"
                                class="px-3 py-4 text-center text-sm th-text-muted">
                                Tidak ada user ditemukan
                            </div>
                        </div>
                    </div>

                    {{-- Hidden inputs --}}
                    <template x-for="userId in selected" :key="'input-' + userId">
                        <input type="hidden" name="cc_users[]" :value="userId">
                    </template>
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
                <div x-data="fileUpload()" class="relative">
                    <label class="mb-1.5 block text-sm font-medium th-text">Lampiran <span
                            class="text-xs th-text-muted font-normal">(Opsional, max 10MB/file)</span></label>

                    {{-- Drop Zone --}}
                    <div @dragover.prevent="dragging = true" @dragleave.prevent="dragging = false"
                        @drop.prevent="handleDrop($event)" @click="$refs.fileInput.click()"
                        class="cursor-pointer rounded-xl border-2 border-dashed p-6 text-center transition-all duration-200"
                        :class="dragging ? 'border-brand-500 bg-brand-500/5' : 'hover:border-brand-500/50'"
                        style="border-color: var(--t-border);"
                        :style="dragging ? 'border-color: var(--brand-500, #6366f1)' : ''">
                        <svg class="mx-auto h-10 w-10 th-text-faint" fill="none" viewBox="0 0 24 24" stroke-width="1"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m18.375 12.739-7.693 7.693a4.5 4.5 0 0 1-6.364-6.364l10.94-10.94A3 3 0 1 1 19.5 7.372L8.552 18.32m.009-.01-.01.01m5.699-9.941-7.81 7.81a1.5 1.5 0 0 0 2.112 2.13" />
                        </svg>
                        <p class="mt-2 text-sm th-text-muted">Drag & drop file atau</p>
                        <span
                            class="mt-2 inline-flex items-center gap-2 rounded-lg bg-brand-500/10 px-4 py-2 text-sm font-medium text-brand-500 transition hover:bg-brand-500/20">
                            Pilih File
                        </span>
                        <input type="file" x-ref="fileInput" multiple class="hidden"
                            accept=".jpg,.jpeg,.png,.gif,.pdf,.doc,.docx,.xls,.xlsx,.zip,.rar"
                            @change="handleFileSelect($event)">
                    </div>

                    {{-- File List Preview --}}
                    <template x-if="files.length > 0">
                        <div class="mt-3 space-y-2">
                            <template x-for="(file, index) in files" :key="index">
                                <div class="flex items-center justify-between gap-3 rounded-xl border px-4 py-2.5 text-sm transition-colors"
                                    style="background-color: var(--t-bg-input); border-color: var(--t-border);">
                                    <div class="flex items-center gap-3 min-w-0">
                                        <svg class="h-5 w-5 shrink-0 text-brand-500" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                        </svg>
                                        <span class="truncate th-text" x-text="file.name"></span>
                                        <span class="shrink-0 text-xs th-text-muted"
                                            x-text="formatSize(file.size)"></span>
                                    </div>
                                    <button type="button" @click="removeFile(index)"
                                        class="shrink-0 rounded-lg p-1 text-red-500 transition hover:bg-red-500/10">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M6 18 18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            </template>
                        </div>
                    </template>

                    {{-- Error messages --}}
                    <template x-if="error">
                        <p class="mt-2 text-xs text-red-500" x-text="error"></p>
                    </template>

                    {{-- Real hidden file input for form submission --}}
                    <input type="file" name="attachments[]" x-ref="realInput" multiple class="hidden">
                </div>

                {{-- Actions --}}
                <div class="flex flex-col gap-3 pt-6 border-t" style="border-color: var(--t-border);">
                    <button type="submit"
                        class="group relative w-full overflow-hidden rounded-xl px-8 py-4 text-base font-semibold text-white shadow-lg shadow-brand-500/30 transition-all duration-300 hover:shadow-xl hover:shadow-brand-500/40 hover:-translate-y-0.5 active:translate-y-0"
                        style="background: linear-gradient(135deg, var(--brand-500, #6366f1), var(--brand-600, #4f46e5), var(--brand-700, #4338ca));">
                        <span
                            class="absolute inset-0 bg-white/10 opacity-0 transition-opacity duration-300 group-hover:opacity-100"></span>
                        <span class="relative flex items-center justify-center gap-2.5">
                            <svg class="h-5 w-5 transition-transform duration-300 group-hover:translate-x-0.5"
                                fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
                            </svg>
                            Kirim Tiket
                        </span>
                    </button>
                    <a href="{{ route('ticketing.index') }}"
                        class="block w-full text-center rounded-xl border px-5 py-3 text-sm font-medium th-text-secondary transition hover:th-bg-hover"
                        style="border-color: var(--t-border);">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            function ccSelect() {
                return {
                    open: false,
                    search: '',
                    selected: @json(old('cc_users', [])),
                    users: @json($users->map(fn($u) => ['id' => $u->id, 'name' => $u->full_name ?? $u->name])),

                    get filteredUsers() {
                        const q = this.search.toLowerCase();
                        return this.users.filter(u => u.name.toLowerCase().includes(q));
                    },

                    getUserName(id) {
                        const u = this.users.find(u => u.id === id);
                        return u ? u.name : '';
                    },

                    toggleUser(id) {
                        if (this.selected.includes(id)) {
                            this.selected = this.selected.filter(s => s !== id);
                        } else {
                            this.selected.push(id);
                        }
                        this.search = '';
                        this.$refs.searchInput.focus();
                    },

                    removeUser(id) {
                        this.selected = this.selected.filter(s => s !== id);
                    },

                    stringToColor(str) {
                        let hash = 0;
                        for (let i = 0; i < str.length; i++) {
                            hash = str.charCodeAt(i) + ((hash << 5) - hash);
                        }
                        const h = hash % 360;
                        return `hsl(${h}, 55%, 50%)`;
                    }
                };
            }

            function fileUpload() {
                return {
                    files: [],
                    dragging: false,
                    error: '',
                    maxSize: 10 * 1024 * 1024, // 10MB
                    allowedExtensions: ['jpg','jpeg','png','gif','pdf','doc','docx','xls','xlsx','zip','rar'],

                    handleFileSelect(event) {
                        this.addFiles(event.target.files);
                        // Reset the visible input so the same file can be re-selected
                        event.target.value = '';
                    },

                    handleDrop(event) {
                        this.dragging = false;
                        this.addFiles(event.dataTransfer.files);
                    },

                    addFiles(fileList) {
                        this.error = '';
                        for (const file of fileList) {
                            // Validate size
                            if (file.size > this.maxSize) {
                                this.error = `File "${file.name}" melebihi batas 10MB.`;
                                continue;
                            }
                            // Validate extension
                            const ext = file.name.split('.').pop().toLowerCase();
                            if (!this.allowedExtensions.includes(ext)) {
                                this.error = `File "${file.name}" tidak didukung. Ekstensi yang diizinkan: ${this.allowedExtensions.join(', ')}`;
                                continue;
                            }
                            // Avoid duplicates
                            const exists = this.files.some(f => f.name === file.name && f.size === file.size);
                            if (!exists) {
                                this.files.push(file);
                            }
                        }
                        this.syncRealInput();
                    },

                    removeFile(index) {
                        this.files.splice(index, 1);
                        this.error = '';
                        this.syncRealInput();
                    },

                    syncRealInput() {
                        // Use DataTransfer to build a proper FileList for the hidden input
                        const dt = new DataTransfer();
                        this.files.forEach(f => dt.items.add(f));
                        this.$refs.realInput.files = dt.files;
                    },

                    formatSize(bytes) {
                        if (bytes < 1024) return bytes + ' B';
                        if (bytes < 1024 * 1024) return (bytes / 1024).toFixed(1) + ' KB';
                        return (bytes / (1024 * 1024)).toFixed(1) + ' MB';
                    }
                };
            }
        </script>
    @endpush

</x-layouts.app>