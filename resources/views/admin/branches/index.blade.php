<x-layouts.app>
    @section('page-title', 'Kelola Cabang')
    @section('page-subtitle', 'Manajemen Data Cabang Sistem')

    <div class="mx-auto max-w-6xl" x-data="{ 
        addModalOpen: false, 
        editModalOpen: false, 
        deleteModalOpen: false,
        editingBranch: null,
        deletingBranch: null
    }">
        <div class="mb-6 flex flex-col sm:flex-row items-center justify-between gap-4">
            <h2 class="text-xl font-bold th-text">Daftar Cabang</h2>
            <button @click="addModalOpen = true"
                class="inline-flex items-center justify-center gap-2 rounded-xl bg-brand-500 px-4 py-2.5 text-sm font-semibold text-white shadow-lg shadow-brand-500/25 transition-all duration-200 hover:bg-brand-600 hover:shadow-brand-500/40 hover:-translate-y-0.5">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Tambah Cabang
            </button>
        </div>

        @if(session('success'))
            <div class="mb-4 rounded-xl border border-green-500/20 bg-green-500/10 p-4 text-green-600 dark:text-green-400">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-4 rounded-xl border border-red-500/20 bg-red-500/10 p-4 text-red-600 dark:text-red-400">
                <ul class="list-inside list-disc text-sm">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="overflow-hidden rounded-2xl border th-border shadow-sm" style="background-color: var(--t-bg-card);">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="border-b th-border" style="background-color: var(--t-bg-input);">
                        <tr>
                            <th class="whitespace-nowrap px-6 py-4 font-semibold th-text">Nama Cabang</th>
                            <th class="whitespace-nowrap px-6 py-4 font-semibold th-text">Status</th>
                            <th class="whitespace-nowrap px-6 py-4 text-right font-semibold th-text">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y th-border">
                        @forelse($branches as $branch)
                            <tr class="transition-colors hover:th-bg-hover">
                                <td class="px-6 py-4 font-medium th-text">{{ $branch->name }}</td>
                                <td class="px-6 py-4">
                                    @if($branch->is_active)
                                        <span
                                            class="inline-flex items-center gap-1 rounded-full border border-green-500/20 bg-green-500/10 px-2.5 py-1 text-xs font-semibold text-green-600 dark:text-green-400">
                                            <span class="h-1.5 w-1.5 rounded-full bg-green-500"></span>
                                            Aktif
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center gap-1 rounded-full border border-slate-500/20 bg-slate-500/10 px-2.5 py-1 text-xs font-semibold th-text-muted">
                                            <span class="h-1.5 w-1.5 rounded-full bg-slate-500"></span>
                                            Nonaktif
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <button @click="editingBranch = {{ json_encode($branch) }}; editModalOpen = true"
                                            class="inline-flex items-center justify-center rounded-xl p-2 th-text-secondary transition-all duration-200 hover:bg-brand-500/10 hover:text-brand-500"
                                            title="Edit">
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                            </svg>
                                        </button>
                                        <button @click="deletingBranch = {{ json_encode($branch) }}; deleteModalOpen = true"
                                            class="inline-flex items-center justify-center rounded-xl p-2 th-text-secondary transition-all duration-200 hover:bg-red-500/10 hover:text-red-500"
                                            title="Hapus">
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-8 text-center text-sm th-text-muted">
                                    Belum ada data cabang.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Add Modal --}}
        <div x-show="addModalOpen"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4 backdrop-blur-sm"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" style="display: none;">
            <div class="w-full max-w-md rounded-2xl border th-border p-6 shadow-2xl" @click.away="addModalOpen = false"
                style="background-color: var(--t-bg-card);">
                <div class="mb-4 flex items-center justify-between">
                    <h3 class="text-lg font-bold th-text">Tambah Cabang</h3>
                    <button @click="addModalOpen = false"
                        class="rounded-lg p-1.5 th-text-muted transition-colors hover:th-bg-hover">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <form action="{{ route('admin.branches.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="mb-1 block text-sm font-medium th-text">Nama Cabang</label>
                        <input type="text" name="name" required
                            class="w-full rounded-xl border th-border px-4 py-2 text-sm th-text focus:border-brand-500 focus:outline-none focus:ring-1 focus:ring-brand-500"
                            style="background-color: var(--t-bg-input);">
                    </div>
                    <div class="mb-6 flex items-center gap-2">
                        <input type="checkbox" name="is_active" id="add_is_active" value="1" checked
                            class="h-4 w-4 rounded border-gray-300 text-brand-500 focus:ring-brand-500">
                        <label for="add_is_active" class="text-sm th-text">Aktif</label>
                    </div>
                    <div class="flex justify-end gap-3">
                        <button type="button" @click="addModalOpen = false"
                            class="rounded-xl border th-border px-4 py-2 text-sm font-medium th-text-secondary transition-colors hover:th-bg-hover">
                            Batal
                        </button>
                        <button type="submit"
                            class="rounded-xl bg-brand-500 px-4 py-2 text-sm font-semibold text-white transition-all hover:bg-brand-600">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Edit Modal --}}
        <div x-show="editModalOpen"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4 backdrop-blur-sm"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" style="display: none;">
            <div class="w-full max-w-md rounded-2xl border th-border p-6 shadow-2xl" @click.away="editModalOpen = false"
                style="background-color: var(--t-bg-card);">
                <div class="mb-4 flex items-center justify-between">
                    <h3 class="text-lg font-bold th-text">Edit Cabang</h3>
                    <button @click="editModalOpen = false"
                        class="rounded-lg p-1.5 th-text-muted transition-colors hover:th-bg-hover">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <form :action="editingBranch ? '{{ url('admin/branches') }}/' + editingBranch.id : ''" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label class="mb-1 block text-sm font-medium th-text">Nama Cabang</label>
                        <input type="text" name="name" :value="editingBranch ? editingBranch.name : ''" required
                            class="w-full rounded-xl border th-border px-4 py-2 text-sm th-text focus:border-brand-500 focus:outline-none focus:ring-1 focus:ring-brand-500"
                            style="background-color: var(--t-bg-input);">
                    </div>
                    <div class="mb-6 flex items-center gap-2">
                        <input type="checkbox" name="is_active" id="edit_is_active" value="1"
                            :checked="editingBranch && editingBranch.is_active"
                            class="h-4 w-4 rounded border-gray-300 text-brand-500 focus:ring-brand-500">
                        <label for="edit_is_active" class="text-sm th-text">Aktif</label>
                    </div>
                    <div class="flex justify-end gap-3">
                        <button type="button" @click="editModalOpen = false"
                            class="rounded-xl border th-border px-4 py-2 text-sm font-medium th-text-secondary transition-colors hover:th-bg-hover">
                            Batal
                        </button>
                        <button type="submit"
                            class="rounded-xl bg-brand-500 px-4 py-2 text-sm font-semibold text-white transition-all hover:bg-brand-600">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Delete Modal --}}
        <div x-show="deleteModalOpen"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4 backdrop-blur-sm"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" style="display: none;">
            <div class="w-full max-w-sm text-center rounded-2xl border th-border p-6 shadow-2xl"
                @click.away="deleteModalOpen = false" style="background-color: var(--t-bg-card);">
                <div
                    class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-full bg-red-500/10 text-red-500">
                    <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3Z" />
                    </svg>
                </div>
                <h3 class="mb-2 text-xl font-bold th-text">Hapus Cabang?</h3>
                <p class="mb-6 text-sm th-text-muted">
                    Apakah Anda yakin ingin menghapus cabang <strong class="th-text"
                        x-text="deletingBranch ? deletingBranch.name : ''"></strong>?<br>Tindakan ini tidak dapat
                    dibatalkan.
                </p>
                <form :action="deletingBranch ? '{{ url('admin/branches') }}/' + deletingBranch.id : ''" method="POST"
                    class="flex justify-center gap-3">
                    @csrf
                    @method('DELETE')
                    <button type="button" @click="deleteModalOpen = false"
                        class="rounded-xl border th-border px-5 py-2.5 text-sm font-medium th-text-secondary transition-colors hover:th-bg-hover">
                        Batal
                    </button>
                    <button type="submit"
                        class="rounded-xl bg-red-500 px-5 py-2.5 text-sm font-semibold text-white transition-all hover:bg-red-600">
                        Hapus
                    </button>
                </form>
            </div>
        </div>

    </div>
</x-layouts.app>