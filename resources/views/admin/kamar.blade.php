@extends('layouts.app')
@section('title', 'Kamar | Bapak Kos')
@section('content')

    <div class="p-6">

        <!-- Statistik kamar berdasarkan status -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-6">
            <div class="bg-white rounded-xl border border-indigo-100 p-4 flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600">
                    <i class='bx bx-bed text-xl'></i>
                </div>
                <div>
                    <p class="text-xs text-indigo-500">Total Kamar</p>
                    <p class="text-lg font-semibold text-gray-800" id="statTotal">0</p>
                </div>
            </div>
            <div class="bg-white rounded-xl border border-green-100 p-4 flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center text-green-600">
                    <i class='bx bx-check-circle text-xl'></i>
                </div>
                <div>
                    <p class="text-xs text-green-500">Tersedia</p>
                    <p class="text-lg font-semibold text-gray-800" id="statTersedia">0</p>
                </div>
            </div>
            <div class="bg-white rounded-xl border border-amber-100 p-4 flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-amber-100 flex items-center justify-center text-amber-600">
                    <i class='bx bx-user-check text-xl'></i>
                </div>
                <div>
                    <p class="text-xs text-amber-500">Terisi</p>
                    <p class="text-lg font-semibold text-gray-800" id="statTerisi">0</p>
                </div>
            </div>
            <div class="bg-white rounded-xl border border-rose-100 p-4 flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-rose-100 flex items-center justify-center text-rose-600">
                    <i class='bx bx-wrench text-xl'></i>
                </div>
                <div>
                    <p class="text-xs text-rose-500">Perbaikan</p>
                    <p class="text-lg font-semibold text-gray-800" id="statPerbaikan">0</p>
                </div>
            </div>
        </div>
        <!-- header + button tambah kamar -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-lg font-semibold text-gray-800 flex items-center gap-2"><i
                    class='bx bx-door-open text-indigo-500'></i> Daftar Kamar</h2>
            <button id="createKamarBtn"
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-xl text-sm font-medium flex items-center gap-2 transition shadow-sm"
                data-modal-target="kamarModal" data-modal-toggle="kamarModal" onclick="openCreateModal()">
                <i class='bx bx-plus-circle'></i> Tambah Kamar
            </button>
        </div>

        <!-- Tabel Kamar (tipe_kamar_id, kode_kamar, status) -->
        <div class="bg-white rounded-2xl border border-indigo-100 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-indigo-50/70 text-indigo-800">
                        <tr>
                            <th class="px-6 py-3 text-left font-medium">ID</th>
                            <th class="px-6 py-3 text-left font-medium">Kode Kamar</th>
                            <th class="px-6 py-3 text-left font-medium">Tipe Kamar</th>
                            <th class="px-6 py-3 text-left font-medium">Harga</th>
                            <th class="px-6 py-3 text-left font-medium">Status</th>
                            <th class="px-6 py-3 text-left font-medium">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-indigo-100">
                        @forelse($kamar as $item)
                            <tr class="hover:bg-indigo-50/40 transition">
                                <td class="px-6 py-3">{{ $item->id }}</td>

                                <td class="px-6 py-3">
                                    {{ $item->kode_kamar }}
                                </td>

                                <td class="px-6 py-3">
                                    {{ $item->tipe_kamar->tipe ?? '-' }}
                                </td>

                                <td class="px-6 py-3">
                                    Rp {{ number_format($item->tipe_kamar->harga ?? 0, 0, ',', '.') }}
                                </td>

                                <td class="px-6 py-3">
                                    @if ($item->status == 'kosong')
                                        <span class="px-2 py-1 text-xs bg-green-100 text-green-700 rounded-lg">
                                            Kosong
                                        </span>
                                    @else
                                        <span class="px-2 py-1 text-xs bg-red-100 text-red-700 rounded-lg">
                                            Terisi
                                        </span>
                                    @endif
                                </td>

                                <td class="px-6 py-3 flex gap-2">
                                    {{-- <a href="{{ route('kamar.edit', $item->id) }}"
                                        class="px-3 py-1 text-sm bg-yellow-400 text-white rounded-lg hover:bg-yellow-500">
                                        Edit
                                    </a> --}}

                                    <form action="{{ route('kamar.destroy', $item->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin hapus kamar ini?')">
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
                                    Data kamar belum tersedia
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
            <div class="px-6 py-3 border-t border-indigo-100 flex justify-between items-center text-xs text-indigo-400">
                <div class="flex gap-3">
                    <span class="flex items-center gap-1"><span class="w-2 h-2 rounded-full bg-green-500"></span>
                        Tersedia</span>
                    <span class="flex items-center gap-1"><span class="w-2 h-2 rounded-full bg-amber-500"></span>
                        Terisi</span>
                    <span class="flex items-center gap-1"><span class="w-2 h-2 rounded-full bg-rose-500"></span>
                        Perbaikan</span>
                </div>
                <span>total <span id="kamarCount">0</span> kamar</span>
            </div>
        </div>
    </div>


    <!-- MODAL FLOWBITE (untuk create & edit kamar) -->
    <div id="kamarModal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-2xl shadow-lg border border-indigo-100">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b border-indigo-100 rounded-t-2xl">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2" id="modalTitle">
                        <i class='bx bx-door-open text-indigo-600'></i> Tambah Kamar
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-indigo-100 hover:text-indigo-700 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                        data-modal-hide="kamarModal">
                        <i class='bx bx-x text-2xl'></i>
                    </button>
                </div>
                <!-- Modal body form (field: tipe_kamar_id, kode_kamar, status) -->
                <div class="p-4 md:p-5">
                    <form action="{{ route('kamar.store') }}" method="POST" id="kamarForm" class="space-y-4">
                        @csrf
                        <div>
                            <label for="tipe_kamar_id"
                                class="block mb-2 text-sm font-medium text-gray-700 flex items-center gap-1"><i
                                    class='bx bx-purchase-tag-alt text-indigo-400'></i> Tipe Kamar</label>
                            <select id="tipe_kamar_id" name="tipe_kamar_id"
                                class="bg-indigo-50/30 border border-indigo-200 text-gray-900 text-sm rounded-xl focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5"
                                required>
                                <option value="" disabled selected>Pilih tipe kamar</option>
                                @foreach ($tipe as $item)
                                    <option value="{{ $item->id }}">{{ $item->tipe }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="kode_kamar"
                                class="block mb-2 text-sm font-medium text-gray-700 flex items-center gap-1"><i
                                    class='bx bx-barcode text-indigo-400'></i> Kode Kamar</label>
                            <input type="text" name="kode_kamar" id="kode_kamar"
                                class="bg-indigo-50/30 border border-indigo-200 text-gray-900 text-sm rounded-xl focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5"
                                placeholder="Contoh: A-101, Melati-01" required>
                        </div>

                        <div>
                            <label for="status"
                                class="block mb-2 text-sm font-medium text-gray-700 flex items-center gap-1"><i
                                    class='bx bx-info-circle text-indigo-400'></i> Status</label>
                            <select id="status" name="status"
                                class="bg-indigo-50/30 border border-indigo-200 text-gray-900 text-sm rounded-xl focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5"
                                required>
                                <option value="" disabled selected>Pilih status</option>
                                <option value="tersedia">Tersedia</option>
                                <option value="terisi">Terisi</option>
                                <option value="perbaikan">Perbaikan</option>
                            </select>
                        </div>

                        <div class="flex gap-3 pt-2">
                            <button type="submit" id="submitBtn"
                                class="w-full text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-xl text-sm px-5 py-2.5 text-center transition">Simpan</button>
                            <button type="button" data-modal-hide="kamarModal"
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
                    <h3 class="mb-5 text-lg font-normal text-gray-700">Hapus kamar <span id="deleteKamarName"
                            class="font-semibold text-indigo-600"></span>?</h3>
                    <p class="text-sm text-gray-500 mb-4">Data kamar akan dihapus permanen.</p>
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
