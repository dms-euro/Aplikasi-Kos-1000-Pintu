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
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-lg font-semibold text-gray-800 flex items-center gap-2"><i
                    class='bx bx-category-alt text-indigo-500'></i> Daftar Tipe Kamar</h2>
            <button id="createKategoriBtn"
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-xl text-sm font-medium flex items-center gap-2 transition shadow-sm"
                data-modal-target="kategoriModal" data-modal-toggle="kategoriModal" onclick="openCreateModal()">
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

                                    <!-- Tombol Edit -->
                                    <a href=""
                                        class="px-3 py-1 text-sm bg-yellow-400 text-white rounded-lg hover:bg-yellow-500">
                                        Edit
                                    </a>

                                    <!-- Tombol Hapus -->
                                    <form action="{{ route('kategori.destroy', $item->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin hapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="px-3 py-1 text-sm bg-red-500 text-white rounded-lg hover:bg-red-600">
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
                total <span id="kategoriCount">0</span> tipe kamar
            </div>
        </div>
    </div>

    <!-- MODAL FLOWBITE (untuk create & edit kategori) -->
    <div id="kategoriModal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-2xl shadow-lg border border-indigo-100">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b border-indigo-100 rounded-t-2xl">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2" id="modalTitle">
                        <i class='bx bx-purchase-tag-alt text-indigo-600'></i> Tambah Tipe Kamar
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-indigo-100 hover:text-indigo-700 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                        data-modal-hide="kategoriModal">
                        <i class='bx bx-x text-2xl'></i>
                    </button>
                </div>
                <!-- Modal body form (field: tipe, harga, deskripsi) -->
                <div class="p-4 md:p-5">
                    <form action="{{ route('kategori.store') }}" id="kategoriForm" class="space-y-4">
                        <div>
                            <label for="tipe"
                                class="block mb-2 text-sm font-medium text-gray-700 flex items-center gap-1"><i
                                    class='bx bx-tag text-indigo-400'></i> Tipe Kamar</label>
                            <input type="text" name="tipe" id="tipe"
                                class="bg-indigo-50/30 border border-indigo-200 text-gray-900 text-sm rounded-xl focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5"
                                placeholder="Contoh: Standar, Premium, VIP" required>
                        </div>

                        <div>
                            <label for="harga"
                                class="block mb-2 text-sm font-medium text-gray-700 flex items-center gap-1"><i
                                    class='bx bx-money text-indigo-400'></i> Harga per Bulan (Rp)</label>
                            <input type="number" name="harga" id="harga"
                                class="bg-indigo-50/30 border border-indigo-200 text-gray-900 text-sm rounded-xl focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5"
                                placeholder="1000000" min="0" required>
                        </div>

                        <div>
                            <label for="deskripsi"
                                class="block mb-2 text-sm font-medium text-gray-700 flex items-center gap-1"><i
                                    class='bx bx-detail text-indigo-400'></i> Deskripsi</label>
                            <textarea id="deskripsi" name="deskripsi" rows="3"
                                class="bg-indigo-50/30 border border-indigo-200 text-gray-900 text-sm rounded-xl focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5"
                                placeholder="Fasilitas, ukuran kamar, dll..."></textarea>
                        </div>

                        <div class="flex gap-3 pt-2">
                            <button type="submit" id="submitBtn"
                                class="w-full text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-xl text-sm px-5 py-2.5 text-center transition">Simpan</button>
                            <button type="button" data-modal-hide="kategoriModal"
                                class="w-full text-indigo-600 bg-white border border-indigo-200 hover:bg-indigo-50 focus:ring-4 focus:outline-none focus:ring-indigo-100 font-medium rounded-xl text-sm px-5 py-2.5 text-center transition">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Hapus -->
    <div id="deleteModal" tabindex="-1"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-2xl shadow-lg border border-rose-100">
                <div class="p-4 md:p-5 text-center">
                    <i class='bx bx-error-circle text-rose-500 text-6xl mb-3'></i>
                    <h3 class="mb-5 text-lg font-normal text-gray-700">Hapus tipe kamar <span id="deleteTipeName"
                            class="font-semibold text-indigo-600"></span>?</h3>
                    <p class="text-sm text-gray-500 mb-4">Tindakan ini akan mempengaruhi kamar dengan tipe ini.</p>
                    <div class="flex justify-center gap-3">
                        <button id="confirmDeleteBtn" type="button"
                            class="text-white bg-rose-600 hover:bg-rose-700 focus:ring-4 focus:outline-none focus:ring-rose-200 font-medium rounded-xl text-sm px-5 py-2.5 text-center transition">Ya,
                            hapus</button>
                        <button data-modal-hide="deleteModal" type="button"
                            class="text-gray-600 bg-white border border-gray-200 hover:bg-gray-50 focus:ring-4 focus:outline-none focus:ring-gray-100 font-medium rounded-xl text-sm px-5 py-2.5 text-center transition">Batal</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
