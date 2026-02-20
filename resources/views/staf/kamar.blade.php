@extends('layouts.app')
@section('title', 'Data Kamar | Bapak Kos')
@section('content')
    <div id="kamarSection">
        <div class="bg-white rounded-2xl border border-indigo-100 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-indigo-100 flex justify-between items-center">
                <h3 class="font-semibold text-gray-800 flex items-center gap-2"><i class='bx bx-bed text-indigo-500'></i> Data
                    Kamar & Update Status</h3>
                <div class="flex gap-2">
                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs flex items-center gap-1"><i
                            class='bx bx-check-circle'></i> Tersedia</span>
                    <span class="bg-amber-100 text-amber-700 px-3 py-1 rounded-full text-xs flex items-center gap-1"><i
                            class='bx bx-user'></i> Terisi</span>
                    <span class="bg-rose-100 text-rose-700 px-3 py-1 rounded-full text-xs flex items-center gap-1"><i
                            class='bx bx-wrench'></i> Perbaikan</span>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-indigo-50/70 text-indigo-800">
                        <tr>
                            <th class="px-6 py-3 text-left">Kode Kamar</th>
                            <th class="px-6 py-3 text-left">Tipe Kamar</th>
                            <th class="px-6 py-3 text-left">Harga/bulan</th>
                            <th class="px-6 py-3 text-left">Status</th>
                            <th class="px-6 py-3 text-left">Penghuni Saat Ini</th>
                            <th class="px-6 py-3 text-left">Aksi Update</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-indigo-100" id="dataKamarTable">
                        <!-- akan diisi javascript -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
@endpush
