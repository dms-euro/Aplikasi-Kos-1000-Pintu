@extends('layouts.app')
@section('title', 'Tipe Kamar | Bapak Kos')
@section('content')

    <div class="p-6">

        <!-- Info tambahan: statistik kecil -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
            <div class="bg-white rounded-xl border border-indigo-100 p-4 flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600">
                    <i class='bx bx-bed text-xl'></i>
                </div>
                <div>
                    <p class="text-xs text-indigo-500">Rata-rata harga</p>
                    <p class="text-lg font-semibold text-gray-800" id="avgHarga">Rp 0</p>
                </div>
            </div>
            <div class="bg-white rounded-xl border border-indigo-100 p-4 flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600">
                    <i class='bx bx-purchase-tag-alt text-xl'></i>
                </div>
                <div>
                    <p class="text-xs text-emerald-500">Tipe termahal</p>
                    <p class="text-lg font-semibold text-gray-800" id="termahal">-</p>
                </div>
            </div>
            <div class="bg-white rounded-xl border border-indigo-100 p-4 flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-amber-100 flex items-center justify-center text-amber-600">
                    <i class='bx bx-home text-xl'></i>
                </div>
                <div>
                    <p class="text-xs text-amber-500">Total kamar</p>
                    <p class="text-lg font-semibold text-gray-800" id="totalKamar">0</p>
                </div>
            </div>
        </div>

        <!-- header + button tambah kategori -->
        <div class="flex justify-between items-center m-6">
            <h2 class="text-lg font-semibold text-gray-800 flex items-center gap-2"><i
                    class='bx bx-category-alt text-indigo-500'></i> Daftar Tipe Kamar</h2>
            <button
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-xl text-sm font-medium flex items-center gap-2 transition shadow-sm"
                data-modal-target="kategoriModal" data-modal-toggle="kategoriModal">
                <i class='bx bx-plus-circle'></i> Tambah Tipe Kamar
            </button>

        </div>

        <!-- Tabel Kategori (tipe, harga, deskripsi) -->
        <div class="bg-white rounded-2xl border border-indigo-100 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-indigo-50/70 text-indigo-800">
                        <tr>
                            <th class="px-6 py-3 text-left font-medium">ID</th>
                            <th class="px-6 py-3 text-left font-medium">Tipe Kamar</th>
                            <th class="px-6 py-3 text-left font-medium">Harga/bulan</th>
                            <th class="px-6 py-3 text-left font-medium">Deskripsi</th>
                            <th class="px-6 py-3 text-left font-medium">Jml Kamar</th>
                            <th class="px-6 py-3 text-left font-medium">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-indigo-100">
                        @forelse($kategori as $item)
                            <tr class="hover:bg-indigo-50/40 transition">
                                <td class="px-6 py-3">{{ $item->id }}</td>
                                <td class="px-6 py-3">{{ $item->tipe }}</td>
                                <td class="px-6 py-3">
                                    Rp {{ number_format($item->harga, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-3">{{ $item->deskripsi }}</td>
                                <td class="px-6 py-3">{{ $item->jumlah_kamar }}</td>
                                <td class="px-6 py-3 flex gap-2">

                                    <button class="px-3 py-1 text-sm bg-yellow-400 text-white rounded-lg"
                                        data-modal-target="editModal" data-modal-toggle="editModal"
                                        data-id="{{ $item->id }}" data-tipe="{{ $item->tipe }}"
                                        data-harga="{{ $item->harga }}" data-deskripsi="{{ $item->deskripsi }}"
                                        onclick="setEditData(this)">
                                        Edit
                                    </button>

                                    <form id="delete-form-{{ $item->id }}"
                                        action="{{ route('kategori.destroy', $item->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="confirmDelete({{ $item->id }})"
                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium text-red-600 bg-red-50 border border-red-200 rounded-lg hover:bg-red-100 hover:text-red-700 hover:border-red-300 transition-all duration-150 ease-in-out focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-6 text-gray-500">
                                    Data belum tersedia
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-3 border-t border-indigo-100 text-right text-xs text-indigo-400">
                total <span id="kategoriCount">{{ $kategori->count() }}</span> tipe kamar
            </div>
        </div>
    </div>

    <div id="kategoriModal" tabindex="-1"
        class="hidden fixed top-0 right-0 left-0 z-50 flex justify-center items-center w-full h-full bg-black/40">

        <div class="relative p-4 w-full max-w-md">
            <div class="bg-white rounded-2xl shadow-lg border border-indigo-100">

                <!-- Header -->
                <div class="flex items-center justify-between p-4 border-b">
                    <h3 class="text-lg font-semibold text-gray-900">
                        Tambah Tipe Kamar
                    </h3>
                    <button data-modal-hide="kategoriModal">
                        <i class='bx bx-x text-2xl'></i>
                    </button>
                </div>

                <!-- Body -->
                <div class="p-5">
                    <form action="{{ route('kategori.store') }}" method="POST" class="space-y-4">
                        @csrf

                        <div>
                            <label class="block mb-1 text-sm font-medium">Tipe Kamar</label>
                            <input type="text" name="tipe" class="w-full border rounded-xl p-2.5" required>
                        </div>

                        <div>
                            <label class="block mb-1 text-sm font-medium">Harga</label>
                            <input type="number" name="harga" class="w-full border rounded-xl p-2.5" required>
                        </div>

                        <div>
                            <label class="block mb-1 text-sm font-medium">Deskripsi</label>
                            <textarea name="deskripsi" class="w-full border rounded-xl p-2.5"></textarea>
                        </div>

                        <div class="flex gap-3">
                            <button type="submit" class="w-full bg-indigo-600 text-white rounded-xl py-2.5">
                                Simpan
                            </button>
                            <button type="button" data-modal-hide="kategoriModal" class="w-full border rounded-xl py-2.5">
                                Batal
                            </button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>

    <div id="editModal" tabindex="-1"
        class="hidden fixed top-0 right-0 left-0 z-50 flex justify-center items-center w-full h-full bg-black/40">

        <div class="relative p-4 w-full max-w-md">
            <div class="bg-white rounded-2xl shadow-lg border border-indigo-100">

                <div class="flex items-center justify-between p-4 border-b">
                    <h3 class="text-lg font-semibold">
                        Edit Tipe Kamar
                    </h3>
                    <button data-modal-hide="editModal">
                        ✕
                    </button>
                </div>

                <div class="p-5">
                    <form id="editForm" method="POST" class="space-y-4"
                        data-action-template="{{ route('kategori.update', ':id') }}">
                        @csrf
                        @method('PUT')

                        <div>
                            <label>Tipe</label>
                            <input type="text" name="tipe" id="edit_tipe" class="w-full border rounded-xl p-2.5"
                                required>
                        </div>

                        <div>
                            <label>Harga</label>
                            <input type="number" name="harga" id="edit_harga" class="w-full border rounded-xl p-2.5"
                                required>
                        </div>

                        <div>
                            <label>Deskripsi</label>
                            <textarea name="deskripsi" id="edit_deskripsi" class="w-full border rounded-xl p-2.5"></textarea>
                        </div>

                        <button type="submit" class="w-full bg-indigo-600 text-white rounded-xl py-2.5">
                            Update
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        function setEditData(button) {
            let id = button.getAttribute('data-id');
            let tipe = button.getAttribute('data-tipe');
            let harga = button.getAttribute('data-harga');
            let deskripsi = button.getAttribute('data-deskripsi');

            document.getElementById('edit_tipe').value = tipe;
            document.getElementById('edit_harga').value = harga;
            document.getElementById('edit_deskripsi').value = deskripsi;

            let template = document.getElementById('editForm')
                .getAttribute('data-action-template');

            document.getElementById('editForm').action =
                template.replace(':id', id);
        }
    </script>
@endpush
