@extends('layouts.app')
@section('title', 'Detail Pemesanan #' . $pemesanan->id)

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="container mx-auto px-4 max-w-4xl">
        <!-- Header -->
        <div class="flex items-center gap-4 mb-6">
            <a href="{{ route('dashboard.penghuni') }}" class="w-10 h-10 bg-white border border-indigo-200 rounded-full flex items-center justify-center hover:bg-indigo-50 transition">
                <i class='bx bx-arrow-back text-indigo-600'></i>
            </a>
            <h1 class="text-2xl font-bold text-gray-800">Detail Pemesanan #{{ $pemesanan->id }}</h1>
        </div>

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

        <!-- Status Pemesanan -->
        <div class="bg-white rounded-2xl shadow-lg border border-indigo-100 overflow-hidden mb-6">
            <div class="p-6 border-b border-indigo-100 bg-gradient-to-r from-indigo-50 to-purple-50">
                <h2 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                    <i class='bx bx-info-circle text-indigo-600'></i>
                    Status Pemesanan
                </h2>
            </div>
            <div class="p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Status</p>
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
                    <div class="text-right">
                        <p class="text-sm text-gray-500">Total Pembayaran</p>
                        <p class="text-2xl font-bold text-indigo-600">Rp {{ number_format($pemesanan->total, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Informasi Pemesanan -->
        <div class="bg-white rounded-2xl shadow-lg border border-indigo-100 overflow-hidden mb-6">
            <div class="p-6 border-b border-indigo-100 bg-gradient-to-r from-indigo-50 to-purple-50">
                <h2 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                    <i class='bx bx-detail text-indigo-600'></i>
                    Informasi Pemesanan
                </h2>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div>
                        <p class="text-sm text-gray-500">Kamar</p>
                        <p class="font-semibold">{{ $pemesanan->kamar->kode_kamar }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Tipe Kamar</p>
                        <p class="font-semibold">{{ $pemesanan->kamar->tipe_kamar->tipe }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Tanggal Masuk</p>
                        <p class="font-semibold">{{ \Carbon\Carbon::parse($pemesanan->tanggal_masuk)->format('d/m/Y') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Tanggal Keluar</p>
                        <p class="font-semibold">{{ \Carbon\Carbon::parse($pemesanan->tanggal_keluar)->format('d/m/Y') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Durasi</p>
                        <p class="font-semibold">{{ $pemesanan->durasi_bulanan }} bulan</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Harga/bulan</p>
                        <p class="font-semibold">Rp {{ number_format($pemesanan->kamar->tipe_kamar->harga, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Pembayaran (hanya tampil jika status pending) -->
        @if($pemesanan->status === 'pending' && !$pemesanan->pembayaran->count())
        <div class="bg-white rounded-2xl shadow-lg border border-indigo-100 overflow-hidden mb-6">
            <div class="p-6 border-b border-indigo-100 bg-gradient-to-r from-indigo-50 to-purple-50">
                <h2 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                    <i class='bx bx-credit-card text-indigo-600'></i>
                    Form Pembayaran
                </h2>
            </div>
            <div class="p-6">
                <form action="{{ route('pembayaran.store', $pemesanan->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Pilihan Metode Pembayaran -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-3">Pilih Metode Pembayaran</label>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Bayar di Kasir -->
                            <label class="relative border rounded-xl p-4 cursor-pointer transition-all hover:border-indigo-400 has-[:checked]:border-indigo-600 has-[:checked]:bg-indigo-50">
                                <input type="radio" name="metode_pembayaran" value="tunai" class="sr-only" onchange="toggleMetode(this.value)" checked>
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                                        <i class='bx bx-money text-2xl text-green-600'></i>
                                    </div>
                                    <div>
                                        <p class="font-semibold">Bayar di Kasir</p>
                                        <p class="text-xs text-gray-500">Bayar langsung ke petugas</p>
                                    </div>
                                </div>
                            </label>

                            <!-- Transfer Bank -->
                            <label class="relative border rounded-xl p-4 cursor-pointer transition-all hover:border-indigo-400 has-[:checked]:border-indigo-600 has-[:checked]:bg-indigo-50">
                                <input type="radio" name="metode_pembayaran" value="transfer" class="sr-only" onchange="toggleMetode(this.value)">
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                                        <i class='bx bx-transfer text-2xl text-blue-600'></i>
                                    </div>
                                    <div>
                                        <p class="font-semibold">Transfer Bank</p>
                                        <p class="text-xs text-gray-500">Upload bukti transfer</p>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Informasi Rekening (untuk transfer) -->
                    <div id="infoRekening" class="hidden mb-6">
                        <div class="bg-blue-50 border border-blue-200 rounded-xl p-4">
                            <h3 class="font-semibold text-blue-800 mb-3">Informasi Rekening Tujuan</h3>
                            <div class="space-y-2 text-sm">
                                <div class="flex justify-between">
                                    <span class="text-blue-700">Bank BCA</span>
                                    <span class="font-mono font-semibold">123 456 7890</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-blue-700">Bank Mandiri</span>
                                    <span class="font-mono font-semibold">123 456 7890</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-blue-700">a.n.</span>
                                    <span class="font-semibold">Kosan优雅</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Upload Bukti Transfer -->
                    <div id="uploadBukti" class="hidden mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Upload Bukti Transfer</label>
                        <div class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:border-indigo-400 transition cursor-pointer" onclick="document.getElementById('bukti_bayar').click()">
                            <i class='bx bx-cloud-upload text-4xl text-gray-400 mb-2'></i>
                            <p class="text-sm text-gray-600">Klik untuk upload bukti transfer</p>
                            <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG (Max. 2MB)</p>
                            <input type="file" id="bukti_bayar" name="bukti_bayar" class="hidden" accept=".jpg,.jpeg,.png">
                            <div id="file-name" class="text-sm text-indigo-600 mt-2 hidden"></div>
                        </div>
                    </div>

                    <!-- Tombol Submit -->
                    <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-4 rounded-xl font-semibold shadow-lg transition">
                        <i class='bx bx-check-circle mr-2'></i>
                        Konfirmasi Pembayaran
                    </button>
                </form>
            </div>
        </div>
        @endif

        <!-- Riwayat Pembayaran (jika sudah ada) -->
        @if($pemesanan->pembayaran->count())
        <div class="bg-white rounded-2xl shadow-lg border border-indigo-100 overflow-hidden">
            <div class="p-6 border-b border-indigo-100 bg-gradient-to-r from-indigo-50 to-purple-50">
                <h2 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                    <i class='bx bx-history text-indigo-600'></i>
                    Riwayat Pembayaran
                </h2>
            </div>
            <div class="p-6">
                @foreach($pemesanan->pembayaran as $pembayaran)
                <div class="border rounded-xl p-4 {{ $pembayaran->status === 'paid' ? 'bg-green-50 border-green-200' : 'bg-amber-50 border-amber-200' }}">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500">Tanggal Bayar</p>
                            <p class="font-semibold">{{ \Carbon\Carbon::parse($pembayaran->tanggal_bayar)->format('d/m/Y H:i') }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Jumlah</p>
                            <p class="font-semibold text-indigo-600">Rp {{ number_format($pembayaran->jumlah, 0, ',', '.') }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Status</p>
                            @php
                                $statusClass = [
                                    'pending' => 'bg-amber-100 text-amber-700',
                                    'paid' => 'bg-green-100 text-green-700',
                                    'failed' => 'bg-red-100 text-red-700'
                                ][$pembayaran->status] ?? 'bg-gray-100 text-gray-700';
                            @endphp
                            <span class="{{ $statusClass }} px-3 py-1 rounded-full text-xs capitalize">{{ $pembayaran->status }}</span>
                        </div>
                    </div>
                    @if($pembayaran->bukti_bayar)
                    <div class="mt-3">
                        <a href="{{ asset('storage/'.$pembayaran->bukti_bayar) }}" target="_blank" class="text-indigo-600 hover:text-indigo-800 text-sm flex items-center gap-1">
                            <i class='bx bx-image'></i> Lihat Bukti Transfer
                        </a>
                    </div>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>

<script>
function toggleMetode(metode) {
    const infoRekening = document.getElementById('infoRekening');
    const uploadBukti = document.getElementById('uploadBukti');
    const buktiInput = document.getElementById('bukti_bayar');

    if (metode === 'transfer') {
        infoRekening.classList.remove('hidden');
        uploadBukti.classList.remove('hidden');
        buktiInput.required = true;
    } else {
        infoRekening.classList.add('hidden');
        uploadBukti.classList.add('hidden');
        buktiInput.required = false;
    }
}

// Tampilkan nama file yang diupload
document.getElementById('bukti_bayar')?.addEventListener('change', function(e) {
    let fileName = e.target.files[0]?.name;
    let fileNameElement = document.getElementById('file-name');

    if (fileName) {
        fileNameElement.textContent = '📎 ' + fileName;
        fileNameElement.classList.remove('hidden');
    } else {
        fileNameElement.classList.add('hidden');
    }
});
</script>
@endsection
