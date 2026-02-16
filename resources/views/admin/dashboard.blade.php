@extends('layouts.app')
@section('title', 'Dashboard Admin | Bapak Kos')
@section('content')

<div class="p-6 space-y-6">

            <!-- Kartu statistik dengan variasi warna: indigo, violet, emerald, amber, rose -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                <div class="bg-white rounded-2xl shadow-sm border border-indigo-100 p-5 flex items-center justify-between hover:shadow-md transition group">
                    <div>
                        <p class="text-sm text-indigo-500 font-medium flex items-center gap-1"><i class='bx bx-door-open text-indigo-400'></i> Total Kamar</p>
                        <p class="text-3xl font-bold text-gray-800">24 <span class="text-sm font-normal text-emerald-500 ml-1">kamar</span></p>
                        <p class="text-xs text-gray-400 mt-1">3 tipe kos</p>
                    </div>
                    <div class="w-12 h-12 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 text-2xl group-hover:scale-110 transition">
                        <i class='bx bx-bed'></i>
                    </div>
                </div>
                <div class="bg-white rounded-2xl shadow-sm border border-indigo-100 p-5 flex items-center justify-between hover:shadow-md transition group">
                    <div>
                        <p class="text-sm text-emerald-500 font-medium flex items-center gap-1"><i class='bx bx-user-check text-emerald-400'></i> Penghuni Aktif</p>
                        <p class="text-3xl font-bold text-gray-800">19 <span class="text-sm font-normal text-violet-500 ml-1">org</span></p>
                        <p class="text-xs text-emerald-600 mt-1 flex items-center"><i class='bx bx-trending-up mr-1'></i> ↑ 2 minggu ini</p>
                    </div>
                    <div class="w-12 h-12 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600 text-2xl group-hover:scale-110 transition">
                        <i class='bx bx-group'></i>
                    </div>
                </div>
                <div class="bg-white rounded-2xl shadow-sm border border-indigo-100 p-5 flex items-center justify-between hover:shadow-md transition group">
                    <div>
                        <p class="text-sm text-amber-500 font-medium flex items-center gap-1"><i class='bx bx-key text-amber-400'></i> Tersedia</p>
                        <p class="text-3xl font-bold text-gray-800">5 <span class="text-sm font-normal text-amber-500 ml-1">kamar</span></p>
                        <p class="text-xs text-amber-600 mt-1">3 kosong, 2 perawatan</p>
                    </div>
                    <div class="w-12 h-12 rounded-full bg-amber-100 flex items-center justify-center text-amber-600 text-2xl group-hover:scale-110 transition">
                        <i class='bx bx-home'></i>
                    </div>
                </div>
                <div class="bg-white rounded-2xl shadow-sm border border-indigo-100 p-5 flex items-center justify-between hover:shadow-md transition group">
                    <div>
                        <p class="text-sm text-rose-500 font-medium flex items-center gap-1"><i class='bx bx-wallet text-rose-400'></i> Pendapatan Bulan</p>
                        <p class="text-2xl font-bold text-gray-800">Rp 42,5jt</p>
                        <p class="text-xs text-rose-600 mt-1 flex items-center"><i class='bx bx-stats mr-1'></i> +12% dari bulan lalu</p>
                    </div>
                    <div class="w-12 h-12 rounded-full bg-rose-100 flex items-center justify-center text-rose-600 text-2xl group-hover:scale-110 transition">
                        <i class='bx bx-money'></i>
                    </div>
                </div>
            </div>

            <!-- dua kolom: grafik (indigo/putih) + notifikasi (violet/amber) dengan boxicon -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- card grafik okupansi -->
                <div class="lg:col-span-2 bg-white rounded-2xl border border-indigo-100 p-5 shadow-sm">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="font-semibold text-gray-800 flex items-center gap-2"><i class='bx bx-line-chart text-indigo-500 text-xl'></i> Tingkat Okupansi 30 hari</h3>
                        <span class="text-xs bg-indigo-100 text-indigo-700 px-3 py-1 rounded-full flex items-center"><i class='bx bx-stats bx-xs mr-1'></i>rata-rata 82%</span>
                    </div>
                    <!-- grafik batangan -->
                    <div class="space-y-3">
                        <div><div class="flex justify-between text-sm text-gray-500 mb-1"><span class="flex items-center gap-1"><i class='bx bx-flower text-emerald-400'></i>Kos Melati</span><span class="font-medium text-indigo-600">92%</span></div><div class="w-full bg-indigo-100 h-2 rounded-full"><div class="bg-indigo-500 h-2 rounded-full" style="width:92%"></div></div></div>
                        <div><div class="flex justify-between text-sm text-gray-500 mb-1"><span class="flex items-center gap-1"><i class='bx bx-flower text-rose-300'></i>Kos Mawar</span><span class="font-medium text-indigo-600">78%</span></div><div class="w-full bg-indigo-100 h-2 rounded-full"><div class="bg-indigo-400 h-2 rounded-full" style="width:78%"></div></div></div>
                        <div><div class="flex justify-between text-sm text-gray-500 mb-1"><span class="flex items-center gap-1"><i class='bx bx-flower text-violet-400'></i>Kos Anggrek</span><span class="font-medium text-indigo-600">64%</span></div><div class="w-full bg-indigo-100 h-2 rounded-full"><div class="bg-violet-400 h-2 rounded-full" style="width:64%"></div></div></div>
                        <div><div class="flex justify-between text-sm text-gray-500 mb-1"><span class="flex items-center gap-1"><i class='bx bx-flower text-amber-400'></i>Kos Tulip</span><span class="font-medium text-indigo-600">95%</span></div><div class="w-full bg-indigo-100 h-2 rounded-full"><div class="bg-indigo-500 h-2 rounded-full" style="width:95%"></div></div></div>
                    </div>
                    <div class="mt-4 flex gap-4 text-xs text-gray-400 border-t border-indigo-50 pt-3">
                        <span><i class='bx bxs-circle text-indigo-500 mr-1 text-[8px]'></i> terisi </span>
                        <span><i class='bx bxs-circle text-violet-300 mr-1 text-[8px]'></i> maintenance</span>
                    </div>
                </div>

                <!-- aktivitas terbaru (warna lebih hidup) -->
                <div class="bg-white rounded-2xl border border-indigo-100 p-5 shadow-sm">
                    <h3 class="font-semibold text-gray-800 flex items-center gap-2 mb-4"><i class='bx bx-bell-ring text-amber-500 text-xl'></i> Aktivitas terkini</h3>
                    <ul class="space-y-4">
                        <li class="flex gap-3">
                            <span class="w-2 h-2 mt-2 rounded-full bg-emerald-400"></span>
                            <div><p class="text-sm text-gray-700"><span class="font-medium">Kamar 5A</span> dihuni oleh Andi <i class='bx bxs-user-check text-emerald-400 ml-1 text-xs'></i></p><p class="text-xs text-indigo-400">10 menit lalu</p></div>
                        </li>
                        <li class="flex gap-3">
                            <span class="w-2 h-2 mt-2 rounded-full bg-amber-400"></span>
                            <div><p class="text-sm text-gray-700">Pembayaran <span class="font-medium">Rp 1.200.000</span> dari Siti <i class='bx bx-check-circle text-amber-500 ml-1 text-xs'></i></p><p class="text-xs text-indigo-400">1 jam lalu</p></div>
                        </li>
                        <li class="flex gap-3">
                            <span class="w-2 h-2 mt-2 rounded-full bg-rose-400"></span>
                            <div><p class="text-sm text-gray-700">Keluhan AC di kamar 12 <i class='bx bx-bug text-rose-400 ml-1 text-xs'></i></p><p class="text-xs text-indigo-400">3 jam lalu</p></div>
                        </li>
                        <li class="flex gap-3">
                            <span class="w-2 h-2 mt-2 rounded-full bg-indigo-400"></span>
                            <div><p class="text-sm text-gray-700">Kos Mawar: 2 kamar tersedia <i class='bx bx-key text-indigo-400 ml-1 text-xs'></i></p><p class="text-xs text-indigo-400">kemarin</p></div>
                        </li>
                        <li class="flex gap-3">
                            <span class="w-2 h-2 mt-2 rounded-full bg-violet-400"></span>
                            <div><p class="text-sm text-gray-700">Kontrak <span class="font-medium">Rina</span> berakhir 3 hari <i class='bx bx-calendar-exclamation text-violet-400 ml-1 text-xs'></i></p><p class="text-xs text-indigo-400">kemarin</p></div>
                        </li>
                    </ul>
                    <button class="w-full mt-4 text-sm text-indigo-600 bg-indigo-50 hover:bg-indigo-100 py-2 rounded-xl transition flex items-center justify-center gap-1"><i class='bx bx-time'></i> Lihat semua aktivitas →</button>
                </div>
            </div>

            <!-- daftar properti kos (tabel) dengan boxicon -->
            <div class="bg-white rounded-2xl border border-indigo-100 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-indigo-100 flex justify-between items-center">
                    <h3 class="font-semibold text-gray-800 flex items-center gap-2"><i class='bx bx-buildings text-violet-500 text-xl'></i> Properti kos anda</h3>
                    <button class="text-xs bg-indigo-600 text-white px-4 py-2 rounded-full hover:bg-indigo-700 transition flex items-center gap-1"><i class='bx bx-plus'></i> Tambah kos</button>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-indigo-50/70 text-indigo-800">
                            <tr>
                                <th class="px-6 py-3 text-left font-medium">Nama kos</th>
                                <th class="px-6 py-3 text-left font-medium">Lokasi</th>
                                <th class="px-6 py-3 text-left font-medium">Total kamar</th>
                                <th class="px-6 py-3 text-left font-medium">Terisi</th>
                                <th class="px-6 py-3 text-left font-medium">Pendapatan/bln</th>
                                <th class="px-6 py-3 text-left font-medium">Status</th>
                                <th class="px-6 py-3 text-left font-medium"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-indigo-100">
                            <tr>
                                <td class="px-6 py-4 font-medium text-gray-800 flex items-center gap-2"><i class='bx bxs-tree text-emerald-400'></i> Kos Melati</td>
                                <td class="px-6 py-4 text-gray-600">Jl. Anggrek No 5</td>
                                <td class="px-6 py-4 text-gray-700">8</td>
                                <td class="px-6 py-4 text-indigo-600 font-medium">7</td>
                                <td class="px-6 py-4 text-gray-700">Rp 11,2jt</td>
                                <td class="px-6 py-4"><span class="bg-emerald-100 text-emerald-700 text-xs px-2 py-1 rounded-full flex items-center gap-1 w-fit"><i class='bx bx-check-circle'></i> Aktif</span></td>
                                <td class="px-6 py-4"><button class="text-indigo-500 hover:text-indigo-700"><i class='bx bx-show'></i></button></td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 font-medium text-gray-800 flex items-center gap-2"><i class='bx bxs-flower text-rose-300'></i> Kos Mawar</td>
                                <td class="px-6 py-4 text-gray-600">Jl. Kenanga 12</td>
                                <td class="px-6 py-4 text-gray-700">6</td>
                                <td class="px-6 py-4 text-indigo-600 font-medium">4</td>
                                <td class="px-6 py-4 text-gray-700">Rp 6,8jt</td>
                                <td class="px-6 py-4"><span class="bg-emerald-100 text-emerald-700 text-xs px-2 py-1 rounded-full flex items-center gap-1 w-fit"><i class='bx bx-check-circle'></i> Aktif</span></td>
                                <td class="px-6 py-4"><button class="text-indigo-500 hover:text-indigo-700"><i class='bx bx-show'></i></button></td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 font-medium text-gray-800 flex items-center gap-2"><i class='bx bxs-flower text-violet-400'></i> Kos Anggrek</td>
                                <td class="px-6 py-4 text-gray-600">Jl. Flamboyan 3</td>
                                <td class="px-6 py-4 text-gray-700">5</td>
                                <td class="px-6 py-4 text-indigo-600 font-medium">3</td>
                                <td class="px-6 py-4 text-gray-700">Rp 5,4jt</td>
                                <td class="px-6 py-4"><span class="bg-amber-100 text-amber-700 text-xs px-2 py-1 rounded-full flex items-center gap-1 w-fit"><i class='bx bx-wrench'></i> Renovasi</span></td>
                                <td class="px-6 py-4"><button class="text-indigo-500 hover:text-indigo-700"><i class='bx bx-show'></i></button></td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 font-medium text-gray-800 flex items-center gap-2"><i class='bx bxs-flower text-amber-400'></i> Kos Tulip</td>
                                <td class="px-6 py-4 text-gray-600">Jl. Mawar 7</td>
                                <td class="px-6 py-4 text-gray-700">5</td>
                                <td class="px-6 py-4 text-indigo-600 font-medium">5</td>
                                <td class="px-6 py-4 text-gray-700">Rp 9,5jt</td>
                                <td class="px-6 py-4"><span class="bg-emerald-100 text-emerald-700 text-xs px-2 py-1 rounded-full flex items-center gap-1 w-fit"><i class='bx bx-check-circle'></i> Aktif</span></td>
                                <td class="px-6 py-4"><button class="text-indigo-500 hover:text-indigo-700"><i class='bx bx-show'></i></button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="px-6 py-3 border-t border-indigo-100 text-right text-xs text-indigo-400">
                    menampilkan 4 dari 5 properti
                </div>
            </div>

            <!-- info tagihan dan pesan dengan variasi warna -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="bg-gradient-to-br from-white to-indigo-50/50 rounded-2xl border border-indigo-200 p-5 flex items-start gap-3">
                    <div class="w-10 h-10 rounded-full bg-amber-200 flex items-center justify-center text-amber-700"><i class='bx bx-time-five text-xl'></i></div>
                    <div><p class="font-semibold text-gray-800 flex items-center gap-1"><i class='bx bx-credit-card-front text-amber-500'></i> Tagihan mendatang</p>
                    <ul class="text-sm mt-2 space-y-1">
                        <li class="flex justify-between"><span><i class='bx bxs-tree text-emerald-400 mr-1'></i>Kos Melati (3 kamar) </span><span class="font-medium text-indigo-600 bg-indigo-50 px-2 py-0.5 rounded-full text-xs">4 hari lagi</span></li>
                        <li class="flex justify-between"><span><i class='bx bxs-flower text-rose-300 mr-1'></i>Kos Mawar (2 kamar) </span><span class="font-medium text-violet-600 bg-violet-50 px-2 py-0.5 rounded-full text-xs">6 hari lagi</span></li>
                        <li class="flex justify-between"><span><i class='bx bxs-flower text-violet-400 mr-1'></i>Kos Anggrek (1 kamar) </span><span class="font-medium text-indigo-600 bg-indigo-50 px-2 py-0.5 rounded-full text-xs">9 hari lagi</span></li>
                    </ul>
                    <button class="mt-3 text-xs text-indigo-600 bg-white border border-indigo-200 px-4 py-1.5 rounded-full hover:bg-indigo-50 flex items-center gap-1"><i class='bx bx-bell'></i> Ingatkan semua</button>
                    </div>
                </div>
                <div class="bg-white rounded-2xl border border-indigo-100 p-5 flex items-start gap-3">
                    <div class="w-10 h-10 rounded-full bg-rose-200 flex items-center justify-center text-rose-700"><i class='bx bx-envelope text-xl'></i></div>
                    <div><p class="font-semibold text-gray-800 flex items-center gap-1"><i class='bx bx-message-dots text-rose-500'></i> Pesan dari penyewa</p>
                    <p class="text-sm text-gray-600 mt-1 line-clamp-2"><span class="font-medium text-indigo-600">Dina (Kamar 3B):</span> “Mohon perbaiki keran kamar mandi” <i class='bx bx-water text-cyan-400 ml-1'></i></p>
                    <p class="text-sm text-gray-600"><span class="font-medium text-violet-600">Rizal (Kamar 7):</span> “Kapan ada kamar kosong?” <i class='bx bx-question-mark text-violet-400'></i></p>
                    <button class="mt-3 text-xs text-rose-600 bg-rose-50 border border-rose-200 px-4 py-1.5 rounded-full hover:bg-rose-100 flex items-center gap-1"><i class='bx bx-conversation'></i> Lihat semua pesan</button>
                    </div>
                </div>
            </div>
        </div> <!-- akhir p-6 -->

@endsection
