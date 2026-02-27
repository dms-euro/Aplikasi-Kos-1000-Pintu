@extends('layouts.public')
@section('title', 'Detail Pemesanan - Kosan优雅')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="container mx-auto px-4 max-w-4xl">
        <!-- Header -->
        <div class="flex items-center gap-4 mb-6">
            <a href="{{ route('penghuni.kamar.saya') }}" class="w-10 h-10 bg-white border border-gray-200 rounded-full flex items-center justify-center hover:bg-gray-50 transition">
                <i class='bx bx-arrow-back text-gray-600'></i>
            </a>
            <h1 class="text-2xl font-bold text-gray-800">Detail Pemesanan #{{ $pemesanan->id }}</h1>
        </div>

        <!-- Status Card -->
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden mb-6">
            <div class="p-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-indigo-100 rounded-full flex items-center justify-center">
                            <i class='bx bx-info-circle text-2xl text-indigo-600'></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Status Pemesanan</p>
                            @php
                                $statusClass = [
                                    'pending' => 'bg-amber-100 text-amber-700',
                                    'confirmed' => 'bg-green-100 text-green-700',
                                    'cancelled' => 'bg-red-100 text-red-700'
                                ][$pemesanan->status] ?? 'bg-gray-100 text-gray-700';
                            @endphp
                            <span class="{{ $statusClass }} px-4 py-2 rounded-full text-sm font-medium capitalize">
                                {{ $pemesanan->status }}
                            </span>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-500">Total Pembayaran</p>
                        <p class="text-2xl font-bold text-indigo-600">Rp{{ number_format($pemesanan->total, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Informasi Kamar -->
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden mb-6">
            <div class="p-6 border-b border-gray-100">
                <h2 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                    <i class='bx bx-bed text-indigo-600'></i>
                    Informasi Kamar
                </h2>
            </div>
            <div class="p-6">
                <div class="flex flex-col md:flex-row gap-6">
                    <div class="md:w-1/3">
                        <img src="{{ asset('storage/' . $pemesanan->kamar->foto_kamar) }}"
                             alt="{{ $pemesanan->kamar->kode_kamar }}"
                             class="w-full h-40 object-cover rounded-xl shadow-md">
                    </div>
                    <div class="md:w-2/3">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-xs text-gray-500">Kode Kamar</p>
                                <p class="font-medium">{{ $pemesanan->kamar->kode_kamar }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Tipe Kamar</p>
                                <p class="font-medium">{{ $pemesanan->kamar->tipe_kamar->tipe }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Tanggal Masuk</p>
                                <p class="font-medium">{{ \Carbon\Carbon::parse($pemesanan->tanggal_masuk)->format('d/m/Y') }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Tanggal Keluar</p>
                                <p class="font-medium">{{ \Carbon\Carbon::parse($pemesanan->tanggal_keluar)->format('d/m/Y') }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Durasi</p>
                                <p class="font-medium">{{ $pemesanan->durasi_bulanan }} bulan</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Harga per Bulan</p>
                                <p class="font-medium">Rp{{ number_format($pemesanan->kamar->tipe_kamar->harga, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Riwayat Pembayaran -->
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-gray-100">
                <h2 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                    <i class='bx bx-credit-card text-indigo-600'></i>
                    Riwayat Pembayaran
                </h2>
            </div>
            <div class="p-6">
                @if($pemesanan->pembayaran->count() > 0)
                    @foreach($pemesanan->pembayaran as $pembayaran)
                    <div class="border rounded-xl p-4 {{ $pembayaran->status == 'paid' ? 'bg-green-50 border-green-200' : 'bg-amber-50 border-amber-200' }} mb-3 last:mb-0">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-500">Tanggal Bayar</p>
                                <p class="font-medium">{{ \Carbon\Carbon::parse($pembayaran->tanggal_bayar)->format('d/m/Y H:i') }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Jumlah</p>
                                <p class="font-semibold text-indigo-600">Rp{{ number_format($pembayaran->jumlah, 0, ',', '.') }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Status</p>
                                @php
                                    $payStatusClass = [
                                        'pending' => 'bg-amber-100 text-amber-700',
                                        'paid' => 'bg-green-100 text-green-700',
                                        'failed' => 'bg-red-100 text-red-700'
                                    ][$pembayaran->status] ?? 'bg-gray-100 text-gray-700';
                                @endphp
                                <span class="{{ $payStatusClass }} px-3 py-1 rounded-full text-xs capitalize">
                                    {{ $pembayaran->status }}
                                </span>
                            </div>
                        </div>
                        @if($pembayaran->bukti_bayar)
                        <div class="mt-3">
                            <a href="{{ asset('storage/' . $pembayaran->bukti_bayar) }}" target="_blank"
                               class="text-indigo-600 hover:text-indigo-800 text-sm flex items-center gap-1">
                                <i class='bx bx-image'></i> Lihat Bukti Transfer
                            </a>
                        </div>
                        @endif
                    </div>
                    @endforeach
                @else
                    <div class="text-center py-6">
                        <i class='bx bx-credit-card text-4xl text-gray-300 mb-2'></i>
                        <p class="text-gray-500">Belum ada pembayaran</p>
                        @if($pemesanan->status == 'pending')
                        <a href="{{ route('penghuni.pembayaran.create', $pemesanan->id) }}"
                           class="inline-flex items-center gap-2 mt-4 bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-xl font-medium transition">
                            <i class='bx bx-wallet'></i>
                            Lakukan Pembayaran
                        </a>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
