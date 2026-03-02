@extends('layouts.app')
@section('title', 'Detail Pemesanan - Staf')

@section('content')
<div class="p-6 max-w-6xl mx-auto">
    <!-- Header -->
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('staf.pemesanan.index') }}" class="w-10 h-10 bg-white border border-indigo-200 rounded-full flex items-center justify-center hover:bg-indigo-50 transition">
            <i class='bx bx-arrow-back text-indigo-600'></i>
        </a>
        <h1 class="text-2xl font-bold text-gray-800">Detail Pemesanan #{{ $pemesanan->id }}</h1>
    </div>

    <!-- Status Card -->
    <div class="bg-white rounded-2xl border border-indigo-100 shadow-sm overflow-hidden mb-6">
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

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Informasi Penghuni -->
        <div class="bg-white rounded-2xl border border-indigo-100 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-indigo-100 bg-gradient-to-r from-indigo-50 to-purple-50">
                <h2 class="font-semibold text-gray-800 flex items-center gap-2">
                    <i class='bx bx-user-circle text-indigo-600'></i>
                    Data Penghuni
                </h2>
            </div>
            <div class="p-6">
                <div class="space-y-3">
                    <div>
                        <p class="text-xs text-gray-500">Nama Lengkap</p>
                        <p class="font-medium">{{ $pemesanan->penghuni->nama }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Kontak</p>
                        <p class="font-medium">{{ $pemesanan->penghuni->kontak }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Kontak Darurat</p>
                        <p class="font-medium">{{ $pemesanan->penghuni->kontak_darurat ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Pekerjaan</p>
                        <p class="font-medium">{{ $pemesanan->penghuni->pekerjaan ?? '-' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Informasi Kamar -->
        <div class="bg-white rounded-2xl border border-indigo-100 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-indigo-100 bg-gradient-to-r from-indigo-50 to-purple-50">
                <h2 class="font-semibold text-gray-800 flex items-center gap-2">
                    <i class='bx bx-bed text-indigo-600'></i>
                    Data Kamar
                </h2>
            </div>
            <div class="p-6">
                <div class="space-y-3">
                    <div>
                        <p class="text-xs text-gray-500">Kode Kamar</p>
                        <p class="font-medium">{{ $pemesanan->kamar->kode_kamar }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Tipe Kamar</p>
                        <p class="font-medium">{{ $pemesanan->kamar->tipe_kamar->tipe }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Harga per Bulan</p>
                        <p class="font-medium">Rp{{ number_format($pemesanan->kamar->tipe_kamar->harga, 0, ',', '.') }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Status Kamar</p>
                        @php
                            $kamarStatusClass = [
                                'tersedia' => 'bg-green-100 text-green-700',
                                'dipesan' => 'bg-amber-100 text-amber-700',
                                'terisi' => 'bg-blue-100 text-blue-700',
                                'perbaikan' => 'bg-rose-100 text-rose-700'
                            ][$pemesanan->kamar->status] ?? 'bg-gray-100 text-gray-700';
                        @endphp
                        <span class="{{ $kamarStatusClass }} px-2 py-1 rounded-full text-xs capitalize">
                            {{ $pemesanan->kamar->status }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Informasi Pemesanan -->
        <div class="bg-white rounded-2xl border border-indigo-100 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-indigo-100 bg-gradient-to-r from-indigo-50 to-purple-50">
                <h2 class="font-semibold text-gray-800 flex items-center gap-2">
                    <i class='bx bx-calendar-check text-indigo-600'></i>
                    Detail Sewa
                </h2>
            </div>
            <div class="p-6">
                <div class="space-y-3">
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
                </div>
            </div>
        </div>
    </div>

    <!-- Riwayat Pembayaran -->
    <div class="bg-white rounded-2xl border border-indigo-100 shadow-sm overflow-hidden mt-6">
        <div class="p-6 border-b border-indigo-100 bg-gradient-to-r from-indigo-50 to-purple-50">
            <h2 class="font-semibold text-gray-800 flex items-center gap-2">
                <i class='bx bx-credit-card text-indigo-600'></i>
                Riwayat Pembayaran
            </h2>
        </div>
        <div class="p-6">
            @if($pemesanan->pembayaran->count() > 0)
                @foreach($pemesanan->pembayaran as $pembayaran)
                <div class="border rounded-xl p-4 {{ $pembayaran->status == 'paid' ? 'bg-green-50 border-green-200' : ($pembayaran->status == 'pending' ? 'bg-amber-50 border-amber-200' : 'bg-red-50 border-red-200') }} mb-3 last:mb-0">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
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
                        <div>
                            <p class="text-sm text-gray-500">Petugas</p>
                            <p class="font-medium">{{ $pembayaran->petugas->name ?? '-' }}</p>
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
                </div>
            @endif
        </div>
    </div>

    <!-- Tombol Aksi -->
    @if($pemesanan->status == 'pending')
    <div class="flex gap-3 mt-6">
        <a href="{{ route('staf.pemesanan.payment.create', $pemesanan->id) }}"
           class="flex-1 bg-green-600 hover:bg-green-700 text-white py-3 rounded-xl font-medium transition text-center">
            <i class='bx bx-wallet mr-2'></i>
            Input Pembayaran Tunai
        </a>

        <button onclick="openCancelModal({{ $pemesanan->id }})"
                class="flex-1 bg-rose-600 hover:bg-rose-700 text-white py-3 rounded-xl font-medium transition">
            <i class='bx bx-x-circle mr-2'></i>
            Batalkan Pemesanan
        </button>
    </div>
    @endif
</div>

<!-- Modal Batalkan -->
<div id="cancelModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-2xl max-w-md w-full p-6">
        <h3 class="text-lg font-bold text-gray-800 mb-4">Batalkan Pemesanan</h3>
        <form id="cancelForm" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Alasan Pembatalan</label>
                <textarea name="alasan" rows="3" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-indigo-500" required></textarea>
            </div>
            <div class="flex gap-3">
                <button type="submit" class="flex-1 bg-rose-600 hover:bg-rose-700 text-white py-2.5 rounded-lg font-medium">
                    Batalkan
                </button>
                <button type="button" onclick="closeCancelModal()" class="flex-1 border border-gray-300 hover:bg-gray-50 py-2.5 rounded-lg font-medium">
                    Batal
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openCancelModal(id) {
        document.getElementById('cancelForm').action = '/staf/pemesanan/' + id + '/cancel';
        document.getElementById('cancelModal').classList.remove('hidden');
    }

    function closeCancelModal() {
        document.getElementById('cancelModal').classList.add('hidden');
    }

    window.onclick = function(event) {
        let modal = document.getElementById('cancelModal');
        if (event.target === modal) {
            modal.classList.add('hidden');
        }
    }
</script>
@endsection
