@extends('layouts.public')
@section('title', 'Kamar Saya - Bapak Kos')

@section('content')
<!-- Header -->
<div class="bg-indigo-600 text-white py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl md:text-4xl font-bold mb-2">Kamar Saya</h1>
        <p class="text-indigo-100">Riwayat pemesanan dan kamar yang sedang Anda huni</p>
    </div>
</div>

<!-- Main Content -->
<div class="container mx-auto px-4 py-8 max-w-6xl">
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-6">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl mb-6">
            {{ session('error') }}
        </div>
    @endif

    <!-- Statistik Singkat -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
        <div class="bg-white rounded-xl border border-indigo-100 p-5 shadow-sm">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 bg-indigo-100 rounded-full flex items-center justify-center">
                    <i class='bx bx-calendar-check text-2xl text-indigo-600'></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Total Pemesanan</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $pemesanan->total() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-green-100 p-5 shadow-sm">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                    <i class='bx bx-check-circle text-2xl text-green-600'></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Sudah Dikonfirmasi</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $pemesanan->where('status', 'confirmed')->count() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-amber-100 p-5 shadow-sm">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 bg-amber-100 rounded-full flex items-center justify-center">
                    <i class='bx bx-time-five text-2xl text-amber-600'></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Menunggu Konfirmasi</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $pemesanan->where('status', 'pending')->count() }}</p>
                </div>
            </div>
        </div>
    </div>

    @if($pemesanan->count() > 0)
        <!-- Kamar Aktif (jika ada yang status confirmed) -->
        @php
            $aktif = $pemesanan->where('status', 'confirmed')->first();
        @endphp

        @if($aktif)
        <div class="mb-10">
            <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                <i class='bx bx-home text-indigo-600'></i>
                Kamar Aktif
            </h2>

            <div class="bg-gradient-to-r from-indigo-50 to-purple-50 rounded-2xl border border-indigo-100 p-6 shadow-md">
                <div class="flex flex-col md:flex-row gap-6">
                    <!-- Gambar Kamar -->
                    <div class="md:w-1/3">
                        <img src="{{ asset('storage/' . $aktif->kamar->foto_kamar) }}"
                             alt="{{ $aktif->kamar->kode_kamar }}"
                             class="w-full h-40 object-cover rounded-xl shadow-md">
                    </div>

                    <!-- Info Kamar -->
                    <div class="md:w-2/3">
                        <div class="flex justify-between items-start mb-3">
                            <div>
                                <h3 class="text-xl font-bold text-gray-800">{{ $aktif->kamar->kode_kamar }}</h3>
                                <p class="text-sm text-gray-600">{{ $aktif->kamar->tipe_kamar->tipe }}</p>
                            </div>
                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-medium">
                                Aktif
                            </span>
                        </div>

                        <div class="grid grid-cols-2 gap-4 mt-4">
                            <div>
                                <p class="text-xs text-gray-500">Tanggal Masuk</p>
                                <p class="font-medium">{{ \Carbon\Carbon::parse($aktif->tanggal_masuk)->format('d/m/Y') }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Tanggal Keluar</p>
                                <p class="font-medium">{{ \Carbon\Carbon::parse($aktif->tanggal_keluar)->format('d/m/Y') }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Durasi</p>
                                <p class="font-medium">{{ $aktif->durasi_bulanan }} bulan</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Total Sewa</p>
                                <p class="font-bold text-indigo-600">Rp{{ number_format($aktif->total, 0, ',', '.') }}</p>
                            </div>
                        </div>

                        <a href="{{ route('penghuni.pemesanan.show', $aktif->id) }}"
                           class="inline-flex items-center gap-2 mt-4 text-indigo-600 hover:text-indigo-700 font-medium">
                            Lihat Detail <i class='bx bx-right-arrow-alt'></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Riwayat Pemesanan -->
        <div>
            <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                <i class='bx bx-history text-indigo-600'></i>
                Riwayat Pemesanan
            </h2>

            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-50 text-gray-700">
                            <tr>
                                <th class="px-6 py-3 text-left">Kode Kamar</th>
                                <th class="px-6 py-3 text-left">Tipe</th>
                                <th class="px-6 py-3 text-left">Tanggal Masuk</th>
                                <th class="px-6 py-3 text-left">Tanggal Keluar</th>
                                <th class="px-6 py-3 text-left">Durasi</th>
                                <th class="px-6 py-3 text-left">Total</th>
                                <th class="px-6 py-3 text-left">Status</th>
                                <th class="px-6 py-3 text-left">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($pemesanan as $item)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 font-medium">{{ $item->kamar->kode_kamar }}</td>
                                <td class="px-6 py-4">{{ $item->kamar->tipe_kamar->tipe }}</td>
                                <td class="px-6 py-4">{{ \Carbon\Carbon::parse($item->tanggal_masuk)->format('d/m/Y') }}</td>
                                <td class="px-6 py-4">{{ \Carbon\Carbon::parse($item->tanggal_keluar)->format('d/m/Y') }}</td>
                                <td class="px-6 py-4">{{ $item->durasi_bulanan }} bln</td>
                                <td class="px-6 py-4 font-semibold text-indigo-600">Rp{{ number_format($item->total, 0, ',', '.') }}</td>
                                <td class="px-6 py-4">
                                    @php
                                        $statusClass = [
                                            'pending' => 'bg-amber-100 text-amber-700',
                                            'confirmed' => 'bg-green-100 text-green-700',
                                            'cancelled' => 'bg-red-100 text-red-700'
                                        ][$item->status] ?? 'bg-gray-100 text-gray-700';
                                    @endphp
                                    <span class="{{ $statusClass }} px-3 py-1 rounded-full text-xs font-medium capitalize">
                                        {{ $item->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('penghuni.pemesanan.show', $item->id) }}"
                                       class="text-indigo-600 hover:text-indigo-800">
                                        <i class='bx bx-show text-lg'></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="px-6 py-4 border-t border-gray-100">
                    {{ $pemesanan->links() }}
                </div>
            </div>
        </div>
    @else
        <!-- Empty State -->
        <div class="text-center py-16 bg-white rounded-2xl border border-gray-200">
            <div class="w-24 h-24 bg-indigo-50 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class='bx bx-bed text-4xl text-indigo-400'></i>
            </div>
            <h3 class="text-xl font-medium text-gray-800 mb-2">Belum Ada Pemesanan</h3>
            <p class="text-gray-500 mb-6">Anda belum melakukan pemesanan kamar.</p>
            <a href="{{ route('penghuni.kamar.index') }}"
               class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-xl font-medium transition">
                <i class='bx bx-search'></i>
                Cari Kamar
            </a>
        </div>
    @endif
</div>
@endsection
