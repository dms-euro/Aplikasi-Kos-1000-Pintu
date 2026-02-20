@extends('layouts.app')
@section('title', 'Daftarkan Penghuni | Bapak Kos')
@section('content')
    <div id="penghuniSection">
        <div class="bg-white rounded-2xl border border-indigo-100 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-indigo-100 flex justify-between items-center">
                <h3 class="font-semibold text-gray-800 flex items-center gap-2"><i
                        class='bx bx-user-plus text-indigo-500'></i> Form Input Penghuni Baru</h3>
            </div>
            <div class="p-6">
                <form id="formPenghuni" class="space-y-4" onsubmit="simpanPenghuni(event)">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-700">Nama Lengkap</label>
                            <input type="text" id="namaPenghuni"
                                class="bg-indigo-50/30 border border-indigo-200 text-gray-900 text-sm rounded-xl focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5"
                                required>
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-700">NIK</label>
                            <input type="text" id="nikPenghuni"
                                class="bg-indigo-50/30 border border-indigo-200 text-gray-900 text-sm rounded-xl focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5"
                                required>
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-700">Email</label>
                            <input type="email" id="emailPenghuni"
                                class="bg-indigo-50/30 border border-indigo-200 text-gray-900 text-sm rounded-xl focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5"
                                required>
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-700">No. Telepon</label>
                            <input type="text" id="teleponPenghuni"
                                class="bg-indigo-50/30 border border-indigo-200 text-gray-900 text-sm rounded-xl focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5"
                                required>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block mb-2 text-sm font-medium text-gray-700">Alamat Asal</label>
                            <textarea id="alamatPenghuni" rows="2"
                                class="bg-indigo-50/30 border border-indigo-200 text-gray-900 text-sm rounded-xl focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5"
                                required></textarea>
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-700">Pilih Kamar</label>
                            <select id="kamarPenghuni"
                                class="bg-indigo-50/30 border border-indigo-200 text-gray-900 text-sm rounded-xl focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5"
                                required>
                                <option value="" disabled selected>Pilih kamar tersedia</option>
                            </select>
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-700">Tanggal Masuk</label>
                            <input type="date" id="tanggalMasuk"
                                class="bg-indigo-50/30 border border-indigo-200 text-gray-900 text-sm rounded-xl focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5"
                                required>
                        </div>
                    </div>
                    <div class="flex gap-3 pt-4">
                        <button type="submit"
                            class="text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-xl text-sm px-5 py-2.5 text-center transition">Simpan
                            Penghuni</button>
                        <button type="button" onclick="resetFormPenghuni()"
                            class="text-indigo-600 bg-white border border-indigo-200 hover:bg-indigo-50 focus:ring-4 focus:outline-none focus:ring-indigo-100 font-medium rounded-xl text-sm px-5 py-2.5 text-center transition">Reset</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tabel Daftar Penghuni (untuk referensi) -->
        <div class="bg-white rounded-2xl border border-indigo-100 shadow-sm overflow-hidden mt-6">
            <div class="px-6 py-4 border-b border-indigo-100">
                <h3 class="font-semibold text-gray-800 flex items-center gap-2"><i class='bx bx-group text-indigo-500'></i>
                    Daftar Penghuni Aktif</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-indigo-50/70 text-indigo-800">
                        <tr>
                            <th class="px-6 py-3 text-left">Nama</th>
                            <th class="px-6 py-3 text-left">Kamar</th>
                            <th class="px-6 py-3 text-left">No. Telepon</th>
                            <th class="px-6 py-3 text-left">Tanggal Masuk</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-indigo-100" id="daftarPenghuniTable">
                        <!-- akan diisi javascript -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
@endpush
