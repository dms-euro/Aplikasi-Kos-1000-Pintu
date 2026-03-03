@extends('layouts.public')
@section('title', 'Detail Pemesanan - Kosan优雅')

@section('content')
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="container mx-auto px-4 max-w-4xl">
            <!-- Header -->
            <div class="flex items-center gap-4 mb-6">
                <a href="{{ route('penghuni.kamar.saya') }}"
                    class="w-10 h-10 bg-white border border-gray-200 rounded-full flex items-center justify-center hover:bg-gray-50 transition">
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
                            <div mt->
                                <p class="text-sm mb-2 text-gray-500">Status Pemesanan</p>
                                @php
                                    $statusClass =
                                        [
                                            'pending' => 'bg-amber-100 text-amber-700',
                                            'confirmed' => 'bg-green-100 text-green-700',
                                            'cancelled' => 'bg-red-100 text-red-700',
                                        ][$pemesanan->status] ?? 'bg-gray-100 text-gray-700';
                                @endphp
                                <span class="{{ $statusClass }} px-4 py-2 rounded-full text-sm font-medium capitalize">
                                    {{ $pemesanan->status }}
                                </span>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-sm text-gray-500">Total Pembayaran</p>
                            <p class="text-2xl font-bold text-indigo-600">
                                Rp{{ number_format($pemesanan->total, 0, ',', '.') }}</p>
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
                                    <p class="font-medium">
                                        {{ \Carbon\Carbon::parse($pemesanan->tanggal_masuk)->format('d/m/Y') }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Tanggal Keluar</p>
                                    <p class="font-medium">
                                        {{ \Carbon\Carbon::parse($pemesanan->tanggal_keluar)->format('d/m/Y') }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Durasi</p>
                                    <p class="font-medium">{{ $pemesanan->durasi_bulanan }} bulan</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Harga per Bulan</p>
                                    <p class="font-medium">
                                        Rp{{ number_format($pemesanan->kamar->tipe_kamar->harga, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Form Pembayaran (hanya tampil jika status pending dan belum ada pembayaran) -->
            @if ($pemesanan->status == 'pending' && $pemesanan->pembayaran->count() == 0)
                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-gray-100 bg-gradient-to-r from-indigo-50 to-purple-50">
                        <h2 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                            <i class='bx bx-wallet text-indigo-600'></i>
                            Form Pembayaran
                        </h2>
                    </div>
                    <div class="p-6">
                        <!-- Pilihan Metode Pembayaran -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-3">Pilih Metode Pembayaran</label>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Cash Option -->
                                <div class="relative">
                                    <input type="radio" name="metode" id="metode_cash" value="cash" class="hidden peer"
                                        checked onchange="toggleMetode('cash')">
                                    <label for="metode_cash"
                                        class="block border-2 border-gray-200 peer-checked:border-green-500 peer-checked:bg-green-50 rounded-xl p-4 cursor-pointer transition-all hover:border-green-300">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                                                <i class='bx bx-money text-2xl text-green-600'></i>
                                            </div>
                                            <div>
                                                <p class="font-semibold text-gray-800">Bayar Cash</p>
                                                <p class="text-xs text-gray-500">Bayar langsung ke kasir</p>
                                            </div>
                                        </div>
                                    </label>
                                </div>

                                <!-- QRIS Option -->
                                <div class="relative">
                                    <input type="radio" name="metode" id="metode_qris" value="qris" class="hidden peer"
                                        onchange="toggleMetode('qris')">
                                    <label for="metode_qris"
                                        class="block border-2 border-gray-200 peer-checked:border-indigo-500 peer-checked:bg-indigo-50 rounded-xl p-4 cursor-pointer transition-all hover:border-indigo-300">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-12 h-12 bg-indigo-100 rounded-full flex items-center justify-center">
                                                <i class='bx bx-qr text-2xl text-indigo-600'></i>
                                            </div>
                                            <div>
                                                <p class="font-semibold text-gray-800">QRIS</p>
                                                <p class="text-xs text-gray-500">Scan QR code untuk bayar</p>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Form untuk Cash -->
                        <div id="form_cash" class="space-y-4">
                            <form action="{{ route('penghuni.pembayaran.cash', $pemesanan->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="metode" value="cash">

                                <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 mb-4">
                                    <div class="flex items-start gap-3">
                                        <i class='bx bx-info-circle text-blue-600 text-xl'></i>
                                        <div>
                                            <p class="text-sm font-medium text-blue-800">Informasi Pembayaran Cash</p>
                                            <p class="text-xs text-blue-700 mt-1">
                                                Silakan datang ke kasir untuk melakukan pembayaran tunai sebesar
                                                <span
                                                    class="font-bold">Rp{{ number_format($pemesanan->total, 0, ',', '.') }}</span>.
                                                Status akan segera dikonfirmasi setelah pembayaran diterima.
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit"
                                    class="w-full bg-green-600 hover:bg-green-700 text-white py-4 rounded-xl font-semibold transition-all shadow-lg hover:shadow-xl">
                                    <i class='bx bx-check-circle mr-2'></i>
                                    Konfirmasi Pembayaran Cash
                                </button>
                            </form>
                        </div>

                        <!-- Form untuk QRIS (hidden by default) -->
                        <div id="form_qris" class="hidden space-y-4">
                            <!-- QR Code Display -->
                            <div
                                class="bg-gradient-to-br from-indigo-50 to-purple-50 border border-indigo-100 rounded-2xl p-8 text-center shadow-sm">

                                <!-- QR Container -->
                                <div class="bg-white p-6 rounded-2xl shadow-md inline-block">
                                    <img src="{{ asset('icon/Kode QRIS Uroo.dev, Elektronik.png') }}" alt="QRIS Code"
                                        class="w-72 h-72 object-contain mx-auto">
                                </div>

                                <!-- Info -->
                                <div class="mt-6 space-y-2">
                                    <p class="text-base font-semibold text-gray-800">
                                        Scan QRIS untuk Pembayaran
                                    </p>
                                    <p class="text-sm text-gray-500">
                                        Gunakan e-wallet atau mobile banking favoritmu
                                    </p>
                                </div>

                                <!-- Nominal -->
                                <div class="mt-6 bg-white rounded-xl p-4 shadow-sm border border-gray-100">
                                    <p class="text-sm text-gray-500">Nominal Pembayaran</p>
                                    <p class="text-2xl font-bold text-indigo-600 tracking-wide">
                                        Rp{{ number_format($pemesanan->total, 0, ',', '.') }}
                                    </p>
                                </div>

                                <!-- Rekening -->
                                <div class="mt-6">
                                    <p class="text-xs text-gray-500">Nomor Rekening</p>
                                    <p class="font-mono text-lg font-bold text-gray-800 tracking-wider">
                                        0882006533693
                                    </p>

                                    <button onclick="copyToClipboard('0882006533693', this)"
                                        class="mt-3 inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white text-sm rounded-lg hover:bg-indigo-700 transition shadow-md hover:shadow-lg">
                                        <i class='bx bx-copy'></i>
                                        Salin Nomor
                                    </button>
                                </div>

                            </div>
                            <!-- Upload Bukti Transfer -->
                            <form action="{{ route('penghuni.pembayaran.qris', $pemesanan->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="metode" value="qris">

                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Upload Bukti
                                        Pembayaran</label>
                                    <div class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:border-indigo-400 transition cursor-pointer"
                                        onclick="document.getElementById('bukti').click()">
                                        <i class='bx bx-cloud-upload text-4xl text-gray-400 mb-2'></i>
                                        <p class="text-sm text-gray-600">Klik untuk upload bukti transfer</p>
                                        <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, PDF (Max. 2MB)</p>
                                        <input type="file" id="bukti" name="bukti_bayar" class="hidden"
                                            accept=".jpg,.jpeg,.png,.pdf" required onchange="updateFileName(this)">
                                        <div id="file-name" class="text-sm text-indigo-600 mt-2 hidden"></div>
                                    </div>
                                </div>

                                <div class="bg-amber-50 border border-amber-200 rounded-xl p-4 mb-4">
                                    <div class="flex items-start gap-3">
                                        <i class='bx bx-time-five text-amber-600 text-xl'></i>
                                        <div>
                                            <p class="text-sm font-medium text-amber-800">Informasi Penting</p>
                                            <p class="text-xs text-amber-700 mt-1">
                                                Upload bukti pembayaran setelah melakukan transfer.
                                                Pembayaran akan diverifikasi oleh petugas maksimal 1x24 jam.
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit"
                                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-4 rounded-xl font-semibold transition-all shadow-lg hover:shadow-xl">
                                    <i class='bx bx-upload mr-2'></i>
                                    Upload Bukti Pembayaran
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Riwayat Pembayaran -->
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden mb-6">
                <div class="p-6 border-b border-gray-100">
                    <h2 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                        <i class='bx bx-credit-card text-indigo-600'></i>
                        Riwayat Pembayaran
                    </h2>
                </div>
                <div class="p-6">
                    @if ($pemesanan->pembayaran->count() > 0)
                        @foreach ($pemesanan->pembayaran as $pembayaran)
                            <div
                                class="border rounded-xl p-4 {{ $pembayaran->status == 'paid' ? 'bg-green-50 border-green-200' : ($pembayaran->status == 'pending' ? 'bg-amber-50 border-amber-200' : 'bg-red-50 border-red-200') }} mb-3 last:mb-0">
                                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">
                                    <div>
                                        <p class="text-xs text-gray-500">Tanggal Bayar</p>
                                        <p class="font-medium">
                                            {{ \Carbon\Carbon::parse($pembayaran->tanggal_bayar)->format('d/m/Y H:i') }}
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500">Jumlah</p>
                                        <p class="font-semibold text-indigo-600">
                                            Rp{{ number_format($pembayaran->jumlah, 0, ',', '.') }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500">Status</p>
                                        @php
                                            $payStatusClass =
                                                [
                                                    'pending' => 'bg-amber-100 text-amber-700',
                                                    'paid' => 'bg-green-100 text-green-700',
                                                    'failed' => 'bg-red-100 text-red-700',
                                                ][$pembayaran->status] ?? 'bg-gray-100 text-gray-700';
                                        @endphp
                                        <span class="{{ $payStatusClass }} px-3 py-1 rounded-full text-xs capitalize">
                                            {{ $pembayaran->status }}
                                        </span>
                                    </div>
                                </div>
                                @if ($pembayaran->bukti_bayar)
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
        </div>
    </div>

    <style>
        /* Hide radio button but keep functionality */
        input[type="radio"]:checked+label {
            border-color: #10b981;
            background-color: #f0fdf4;
        }
    </style>
@endsection
@push('scripts')
    <script>
        function toggleMetode(metode) {
            const formCash = document.getElementById('form_cash');
            const formQris = document.getElementById('form_qris');

            if (metode === 'cash') {
                formCash.classList.remove('hidden');
                formQris.classList.add('hidden');
            } else {
                formCash.classList.add('hidden');
                formQris.classList.remove('hidden');
            }
        }

        function updateFileName(input) {
            const fileName = input.files[0]?.name;
            const fileNameElement = document.getElementById('file-name');

            if (fileName) {
                fileNameElement.textContent = '📎 ' + fileName;
                fileNameElement.classList.remove('hidden');
            } else {
                fileNameElement.classList.add('hidden');
            }
        }

        // ✅ Tambahkan ini
        function copyToClipboard(text, button) {
            navigator.clipboard.writeText(text).then(() => {
                const originalText = button.innerHTML;

                button.innerHTML = "<i class='bx bx-check'></i> Tersalin!";
                button.classList.remove('bg-indigo-600');
                button.classList.add('bg-green-600');

                setTimeout(() => {
                    button.innerHTML = "<i class='bx bx-copy'></i> Salin Nomor";
                    button.classList.remove('bg-green-600');
                    button.classList.add('bg-indigo-600');
                }, 2000);
            }).catch(err => {
                alert("Gagal menyalin teks");
            });
        }
    </script>
    <script>
        function toggleMetode(metode) {
            const formCash = document.getElementById('form_cash');
            const formQris = document.getElementById('form_qris');

            if (metode === 'cash') {
                formCash.classList.remove('hidden');
                formQris.classList.add('hidden');
            } else {
                formCash.classList.add('hidden');
                formQris.classList.remove('hidden');
            }
        }

        function updateFileName(input) {
            const fileName = input.files[0]?.name;
            const fileNameElement = document.getElementById('file-name');

            if (fileName) {
                fileNameElement.textContent = '📎 ' + fileName;
                fileNameElement.classList.remove('hidden');
            } else {
                fileNameElement.classList.add('hidden');
            }
        }
    </script>
@endpush
