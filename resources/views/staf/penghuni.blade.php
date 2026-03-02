@extends('layouts.app')
@section('title', 'Data Penghuni Aktif - Staf')

@section('content')
<div class="p-6">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Data Penghuni Aktif</h1>

        <!-- Search Form -->
        <form method="GET" action="{{ route('staf.penghuni.index') }}" class="flex gap-2">
            <div class="relative">
                <i class='bx bx-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400'></i>
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Cari nama atau kontak..."
                       class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg w-full md:w-64 focus:ring-2 focus:ring-indigo-500">
            </div>
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg transition">
                Cari
            </button>
        </form>
    </div>

    <!-- Statistik Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-8">
        <div class="bg-white rounded-xl border border-green-100 p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-green-500 font-medium">Penghuni Aktif</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $totalAktif }}</p>
                    <p class="text-xs text-gray-500 mt-1">Sudah konfirmasi</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center text-green-600">
                    <i class='bx bx-user-check text-2xl'></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-amber-100 p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-amber-500 font-medium">Menunggu Konfirmasi</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $totalPending }}</p>
                    <p class="text-xs text-gray-500 mt-1">Belum konfirmasi</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-amber-100 flex items-center justify-center text-amber-600">
                    <i class='bx bx-time-five text-2xl'></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Status -->
    <div class="bg-white rounded-xl border border-gray-200 p-4 mb-6">
        <div class="flex flex-wrap items-center gap-3">
            <span class="text-sm font-medium text-gray-700">Filter Status:</span>
            <a href="{{ route('staf.penghuni.index') }}"
               class="px-4 py-2 text-sm rounded-full transition-all
                      {{ !request('status') ? 'bg-indigo-600 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                Semua
            </a>
            <a href="{{ route('staf.penghuni.index', ['status' => 'confirmed']) }}"
               class="px-4 py-2 text-sm rounded-full transition-all
                      {{ request('status') == 'confirmed' ? 'bg-green-600 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                Aktif
            </a>
            <a href="{{ route('staf.penghuni.index', ['status' => 'pending']) }}"
               class="px-4 py-2 text-sm rounded-full transition-all
                      {{ request('status') == 'pending' ? 'bg-amber-600 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                Menunggu
            </a>
        </div>
    </div>

    <!-- Tabel Penghuni -->
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-gray-700">
                    <tr>
                        <th class="px-4 py-3 text-left">No</th>
                        <th class="px-4 py-3 text-left">Nama</th>
                        <th class="px-4 py-3 text-left">Kontak</th>
                        <th class="px-4 py-3 text-left">Kamar</th>
                        <th class="px-4 py-3 text-left">Tipe Kamar</th>
                        <th class="px-4 py-3 text-left">Tanggal Masuk</th>
                        <th class="px-4 py-3 text-left">Tanggal Keluar</th>
                        <th class="px-4 py-3 text-left">Status</th>
                        <th class="px-4 py-3 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($penghuni as $index => $item)
                        @php
                            $pemesanan = $item->pemesanan->first();
                        @endphp
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3">{{ $index + 1 }}</td>
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-700 text-xs font-bold">
                                        {{ substr($item->nama, 0, 1) }}
                                    </div>
                                    <span class="font-medium">{{ $item->nama }}</span>
                                </div>
                            </td>
                            <td class="px-4 py-3">{{ $item->kontak }}</td>
                            <td class="px-4 py-3 font-medium">{{ $pemesanan->kamar->kode_kamar ?? '-' }}</td>
                            <td class="px-4 py-3">{{ $pemesanan->kamar->tipe_kamar->tipe ?? '-' }}</td>
                            <td class="px-4 py-3">{{ $pemesanan ? \Carbon\Carbon::parse($pemesanan->tanggal_masuk)->format('d/m/Y') : '-' }}</td>
                            <td class="px-4 py-3">{{ $pemesanan ? \Carbon\Carbon::parse($pemesanan->tanggal_keluar)->format('d/m/Y') : '-' }}</td>
                            <td class="px-4 py-3">
                                @if($pemesanan)
                                    @if($pemesanan->status == 'confirmed')
                                        <span class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs">Aktif</span>
                                    @elseif($pemesanan->status == 'pending')
                                        <span class="bg-amber-100 text-amber-700 px-2 py-1 rounded-full text-xs">Menunggu</span>
                                    @else
                                        <span class="bg-gray-100 text-gray-700 px-2 py-1 rounded-full text-xs">{{ $pemesanan->status }}</span>
                                    @endif
                                @else
                                    <span class="bg-gray-100 text-gray-700 px-2 py-1 rounded-full text-xs">Tidak Ada</span>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                <a href="{{ route('staf.penghuni.show', $item->id) }}"
                                   class="text-indigo-600 hover:text-indigo-800 bg-indigo-50 hover:bg-indigo-100 p-2 rounded-lg transition"
                                   title="Detail">
                                    <i class='bx bx-show text-lg'></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-8 text-gray-500">
                                <i class='bx bx-user-x text-4xl text-gray-300 mb-2'></i>
                                <br>Tidak ada data penghuni
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-3 border-t border-gray-100">
            {{ $penghuni->links() }}
        </div>
    </div>
</div>
@endsection
