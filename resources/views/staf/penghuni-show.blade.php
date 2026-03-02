@extends('layouts.app')
@section('title', 'Detail Penghuni - Staf')

@section('content')
<div class="p-6 max-w-6xl mx-auto">
    <!-- Header dengan Tombol Kembali -->
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('staf.penghuni.index') }}" class="w-10 h-10 bg-white border border-indigo-200 rounded-full flex items-center justify-center hover:bg-indigo-50 transition">
            <i class='bx bx-arrow-back text-indigo-600'></i>
        </a>
        <h1 class="text-2xl font-bold text-gray-800">Detail Penghuni</h1>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Kartu Profil Penghuni -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                <div class="bg-gradient-to-r from-indigo-500 to-purple-600 h-24"></div>
                <div class="px-6 pb-6 text-center -mt-12">
                    <div class="w-24 h-24 rounded-full bg-white border-4 border-white shadow-lg mx-auto flex items-center justify-center text-3xl font-bold text-indigo-600 bg-indigo-100">
                        {{ substr($penghuni->nama, 0, 1) }}
                    </div>
                    <h2 class="text-xl font-bold text-gray-800 mt-4">{{ $penghuni->nama }}</h2>

                    <div class="mt-4 space-y-2 text-left">
                        <div class="flex items-center gap-2 text-sm">
                            <i class='bx bx-phone text-indigo-400 w-5'></i>
                            <span>{{ $penghuni->kontak }}</span>
                        </div>
                        <div class="flex items-center gap-2 text-sm">
                            <i class='bx bx-envelope text-indigo-400 w-5'></i>
                            <span>{{ $penghuni->user->email ?? '-' }}</span>
                        </div>
                        <div class="flex items-center gap-2 text-sm">
                            <i class='bx bx-calendar text-indigo-400 w-5'></i>
                            <span>{{ \Carbon\Carbon::parse($penghuni->tanggal_lahir)->format('d/m/Y') }}</span>
                        </div>
                        <div class="flex items-center gap-2 text-sm">
                            <i class='bx bx-user-circle text-indigo-400 w-5'></i>
                            <span>{{ $penghuni->kelamin }}</span>
                        </div>
                        <div class="flex items-center gap-2 text-sm">
                            <i class='bx bx-briefcase text-indigo-400 w-5'></i>
                            <span>{{ $penghuni->pekerjaan }}</span>
                        </div>
                        <div class="flex items-center gap-2 text-sm">
                            <i class='bx bx-phone-call text-indigo-400 w-5'></i>
                            <span>{{ $penghuni->kontak_darurat }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Riwayat Pemesanan -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                    <h2 class="font-semibold text-gray-800 flex items-center gap-2">
                        <i class='bx bx-history text-indigo-600'></i>
                        Riwayat Pemesanan Kamar
                    </h2>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-50 text-gray-700">
                            <tr>
                                <th class="px-4 py-3 text-left">No</th>
                                <th class="px-4 py-3 text-left">Kamar</th>
                                <th class="px-4 py-3 text-left">Tipe</th>
                                <th class="px-4 py-3 text-left">Tgl Masuk</th>
                                <th class="px-4 py-3 text-left">Tgl Keluar</th>
                                <th class="px-4 py-3 text-left">Durasi</th>
                                <th class="px-4 py-3 text-left">Total</th>
                                <th class="px-4 py-3 text-left">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($penghuni->pemesanan as $index => $item)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3">{{ $index + 1 }}</td>
                                <td class="px-4 py-3 font-medium">{{ $item->kamar->kode_kamar }}</td>
                                <td class="px-4 py-3">{{ $item->kamar->tipe_kamar->tipe }}</td>
                                <td class="px-4 py-3">{{ \Carbon\Carbon::parse($item->tanggal_masuk)->format('d/m/Y') }}</td>
                                <td class="px-4 py-3">{{ \Carbon\Carbon::parse($item->tanggal_keluar)->format('d/m/Y') }}</td>
                                <td class="px-4 py-3">{{ $item->durasi_bulanan }} bln</td>
                                <td class="px-4 py-3 font-semibold text-indigo-600">Rp{{ number_format($item->total, 0, ',', '.') }}</td>
                                <td class="px-4 py-3">
                                    @php
                                        $statusClass = [
                                            'pending' => 'bg-amber-100 text-amber-700',
                                            'confirmed' => 'bg-green-100 text-green-700',
                                            'cancelled' => 'bg-red-100 text-red-700'
                                        ][$item->status] ?? 'bg-gray-100 text-gray-700';
                                    @endphp
                                    <span class="{{ $statusClass }} px-2 py-1 rounded-full text-xs capitalize">
                                        {{ $item->status }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center py-8 text-gray-500">
                                    <i class='bx bx-folder-open text-4xl text-gray-300 mb-2'></i>
                                    <br>Belum ada riwayat pemesanan
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Ringkasan -->
            <div class="grid grid-cols-2 gap-4 mt-4">
                <div class="bg-green-50 rounded-xl p-4 border border-green-100">
                    <p class="text-xs text-green-600">Total Pemesanan</p>
                    <p class="text-2xl font-bold text-green-700">{{ $penghuni->pemesanan->count() }}</p>
                </div>
                <div class="bg-indigo-50 rounded-xl p-4 border border-indigo-100">
                    <p class="text-xs text-indigo-600">Total Dibayar</p>
                    <p class="text-2xl font-bold text-indigo-700">
                        Rp{{ number_format($penghuni->pemesanan->sum('total'), 0, ',', '.') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
