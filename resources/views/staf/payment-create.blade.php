@extends('layouts.app')
@section('title', 'Input Pembayaran Langsung - Staf')

@section('content')
<div class="p-6 max-w-3xl mx-auto">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('staf.pemesanan.index') }}" class="w-10 h-10 bg-white border border-indigo-200 rounded-full flex items-center justify-center hover:bg-indigo-50 transition">
            <i class='bx bx-arrow-back text-indigo-600'></i>
        </a>
        <h1 class="text-2xl font-bold text-gray-800">Input Pembayaran Langsung</h1>
    </div>

    <div class="bg-white rounded-2xl border border-indigo-100 shadow-sm overflow-hidden mb-6">
        <div class="p-6 border-b border-indigo-100 bg-gradient-to-r from-indigo-50 to-purple-50">
            <h2 class="font-semibold text-gray-800 flex items-center gap-2">
                <i class='bx bx-info-circle text-indigo-600'></i>
                Informasi Pemesanan
            </h2>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-sm text-gray-500">Penghuni</p>
                    <p class="font-medium text-gray-800">{{ $pemesanan->penghuni->nama }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Kontak</p>
                    <p class="font-medium">{{ $pemesanan->penghuni->kontak }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Kamar</p>
                    <p class="font-medium">{{ $pemesanan->kamar->kode_kamar }} - {{ $pemesanan->kamar->tipe_kamar->tipe }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Durasi</p>
                    <p class="font-medium">{{ $pemesanan->durasi_bulanan }} bulan</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Tanggal Masuk</p>
                    <p class="font-medium">{{ \Carbon\Carbon::parse($pemesanan->tanggal_masuk)->format('d/m/Y') }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Tanggal Keluar</p>
                    <p class="font-medium">{{ \Carbon\Carbon::parse($pemesanan->tanggal_keluar)->format('d/m/Y') }}</p>
                </div>
                <div class="col-span-2 border-t border-indigo-100 pt-4 mt-2">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Total yang Harus Dibayar</span>
                        <span class="text-2xl font-bold text-indigo-600">Rp{{ number_format($pemesanan->total, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-indigo-100 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-indigo-100 bg-gradient-to-r from-indigo-50 to-purple-50">
            <h2 class="font-semibold text-gray-800 flex items-center gap-2">
                <i class='bx bx-credit-card text-indigo-600'></i>
                Form Pembayaran Tunai
            </h2>
        </div>
        <div class="p-6">
            <form action="{{ route('staf.pemesanan.payment.store', $pemesanan->id) }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Pembayaran</label>
                    <input type="date" name="tanggal_bayar" value="{{ date('Y-m-d') }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-indigo-500"
                            required>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah Pembayaran</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500">Rp</span>
                        <input type="number" name="jumlah" value="{{ $pemesanan->total }}"
                                class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500"
                                required>
                    </div>
                </div>

                <div class="bg-amber-50 border border-amber-200 rounded-lg p-4 mb-6">
                    <div class="flex items-start gap-3">
                        <i class='bx bx-info-circle text-amber-600 text-xl'></i>
                        <div>
                            <p class="text-sm font-medium text-amber-800">Konfirmasi Pembayaran Tunai</p>
                            <p class="text-xs text-amber-700 mt-1">
                                Dengan mengklik tombol Simpan, Anda mengkonfirmasi bahwa pembayaran tunai telah diterima.
                                Status pemesanan akan berubah menjadi "Confirmed" dan kamar akan berstatus "Terisi".
                            </p>
                        </div>
                    </div>
                </div>

                <div class="flex gap-3">
                    <button type="submit" class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white py-3 rounded-lg font-medium transition">
                        <i class='bx bx-check-circle mr-2'></i>
                        Simpan Pembayaran
                    </button>
                    <a href="{{ route('staf.pemesanan.index') }}" class="flex-1 border border-gray-300 hover:bg-gray-50 py-3 rounded-lg font-medium text-center transition">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
