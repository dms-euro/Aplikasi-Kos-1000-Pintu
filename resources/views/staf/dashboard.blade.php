@extends('layouts.app')
@section('title', 'Dashboard Admin | Bapak Kos')
@section('content')
<div id="dashboardSection">
                <!-- Statistik Cepat -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-6">
                    <div class="bg-white rounded-2xl shadow-sm border border-indigo-100 p-5 flex items-center justify-between hover:shadow-md transition">
                        <div>
                            <p class="text-sm text-indigo-500 font-medium flex items-center gap-1"><i class='bx bx-group text-indigo-400'></i> Total Penghuni</p>
                            <p class="text-3xl font-bold text-gray-800" id="totalPenghuni">24</p>
                            <p class="text-xs text-gray-400 mt-1">Aktif semua</p>
                        </div>
                        <div class="w-12 h-12 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 text-2xl">
                            <i class='bx bx-group'></i>
                        </div>
                    </div>
                    <div class="bg-white rounded-2xl shadow-sm border border-indigo-100 p-5 flex items-center justify-between hover:shadow-md transition">
                        <div>
                            <p class="text-sm text-emerald-500 font-medium flex items-center gap-1"><i class='bx bx-bed text-emerald-400'></i> Kamar Terisi</p>
                            <p class="text-3xl font-bold text-gray-800" id="kamarTerisi">19</p>
                            <p class="text-xs text-gray-400 mt-1">dari 24 kamar</p>
                        </div>
                        <div class="w-12 h-12 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600 text-2xl">
                            <i class='bx bx-bed'></i>
                        </div>
                    </div>
                    <div class="bg-white rounded-2xl shadow-sm border border-indigo-100 p-5 flex items-center justify-between hover:shadow-md transition">
                        <div>
                            <p class="text-sm text-amber-500 font-medium flex items-center gap-1"><i class='bx bx-error-circle text-amber-400'></i> Tagihan Bulan Ini</p>
                            <p class="text-3xl font-bold text-gray-800" id="tagihanBulanIni">18</p>
                            <p class="text-xs text-amber-600 mt-1">3 belum dibayar</p>
                        </div>
                        <div class="w-12 h-12 rounded-full bg-amber-100 flex items-center justify-center text-amber-600 text-2xl">
                            <i class='bx bx-receipt'></i>
                        </div>
                    </div>
                    <div class="bg-white rounded-2xl shadow-sm border border-indigo-100 p-5 flex items-center justify-between hover:shadow-md transition">
                        <div>
                            <p class="text-sm text-rose-500 font-medium flex items-center gap-1"><i class='bx bx-calendar-check text-rose-400'></i> Check-out Hari Ini</p>
                            <p class="text-3xl font-bold text-gray-800" id="checkOutHariIni">2</p>
                            <p class="text-xs text-rose-600 mt-1">Perlu persiapan</p>
                        </div>
                        <div class="w-12 h-12 rounded-full bg-rose-100 flex items-center justify-center text-rose-600 text-2xl">
                            <i class='bx bx-calendar-x'></i>
                        </div>
                    </div>
                </div>

                <!-- Grafik dan Aktivitas -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
                    <!-- Grafik Okupansi -->
                    <div class="lg:col-span-2 bg-white rounded-2xl border border-indigo-100 p-5 shadow-sm">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="font-semibold text-gray-800 flex items-center gap-2"><i class='bx bx-line-chart text-indigo-500 text-xl'></i> Okupansi 7 Hari Terakhir</h3>
                            <span class="text-xs bg-indigo-100 text-indigo-700 px-3 py-1 rounded-full">rata-rata 79%</span>
                        </div>
                        <div class="h-64">
                            <canvas id="okupansiChart"></canvas>
                        </div>
                    </div>

                    <!-- Aktivitas Terkini -->
                    <div class="bg-white rounded-2xl border border-indigo-100 p-5 shadow-sm">
                        <h3 class="font-semibold text-gray-800 flex items-center gap-2 mb-4"><i class='bx bx-bell-ring text-amber-500 text-xl'></i> Aktivitas Terkini</h3>
                        <div class="space-y-4" id="aktivitasList">
                            <!-- akan diisi javascript -->
                        </div>
                    </div>
                </div>

                <!-- Tabel Penghuni Baru -->
                <div class="bg-white rounded-2xl border border-indigo-100 shadow-sm overflow-hidden">
                    <div class="px-6 py-4 border-b border-indigo-100 flex justify-between items-center">
                        <h3 class="font-semibold text-gray-800 flex items-center gap-2"><i class='bx bx-user-plus text-indigo-500'></i> Penghuni Baru (7 Hari Terakhir)</h3>
                        <button class="text-xs bg-indigo-50 text-indigo-600 px-4 py-2 rounded-full hover:bg-indigo-100 transition" onclick="showSection('penghuni')">Lihat Semua</button>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead class="bg-indigo-50/70 text-indigo-800">
                                <tr>
                                    <th class="px-6 py-3 text-left">Nama</th>
                                    <th class="px-6 py-3 text-left">Kamar</th>
                                    <th class="px-6 py-3 text-left">Tanggal Masuk</th>
                                    <th class="px-6 py-3 text-left">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-indigo-100" id="penghuniBaruTable">
                                <!-- akan diisi javascript -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
@endsection
@push('scripts')

@endpush
