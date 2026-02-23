@extends('layouts.public')
@section('title', 'Pembayaran - Kosan优雅')

@section('content')
<!-- Header Section -->
<div class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl md:text-4xl font-bold mb-2">Pembayaran Sewa Kamar</h1>
        <p class="text-indigo-100">Selesaikan pembayaran untuk mengkonfirmasi pemesanan kamar Anda</p>
    </div>
</div>

<!-- Main Content -->
<div class="container mx-auto px-4 py-12">
    <div class="max-w-4xl mx-auto">
        <!-- Progress Steps -->
        <div class="flex items-center justify-center mb-10">
            <div class="flex items-center">
                <div class="w-10 h-10 bg-indigo-600 text-white rounded-full flex items-center justify-center font-bold">1</div>
                <span class="ml-2 text-sm font-medium text-gray-900">Pilih Kamar</span>
            </div>
            <div class="w-16 h-1 bg-indigo-600 mx-2"></div>
            <div class="flex items-center">
                <div class="w-10 h-10 bg-indigo-600 text-white rounded-full flex items-center justify-center font-bold">2</div>
                <span class="ml-2 text-sm font-medium text-gray-900">Data Diri</span>
            </div>
            <div class="w-16 h-1 bg-indigo-600 mx-2"></div>
            <div class="flex items-center">
                <div class="w-10 h-10 bg-indigo-600 text-white rounded-full flex items-center justify-center font-bold">3</div>
                <span class="ml-2 text-sm font-medium text-indigo-600">Pembayaran</span>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Form Pembayaran -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-lg border border-indigo-100 overflow-hidden">
                    <div class="p-6 border-b border-indigo-100 bg-gradient-to-r from-indigo-50 to-purple-50">
                        <h2 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                            <i class='bx bx-credit-card text-indigo-600'></i>
                            Detail Pembayaran
                        </h2>
                    </div>

                    <div class="p-6">
                        <!-- Informasi Pemesanan -->
                        <div class="bg-indigo-50/50 rounded-xl p-5 mb-6 border border-indigo-100">
                            <h3 class="font-semibold text-gray-800 mb-3 flex items-center gap-2">
                                <i class='bx bx-info-circle text-indigo-600'></i>
                                Informasi Pemesanan
                            </h3>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm text-gray-500">Kode Pemesanan</p>
                                    <p class="font-medium text-gray-800">#{{ $pemesanan->id }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Kamar</p>
                                    <p class="font-medium text-gray-800">{{ $pemesanan->kamar->kode_kamar ?? 'N/A' }} - {{ $pemesanan->kamar->tipeKamar->tipe ?? 'Standard' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Tanggal Masuk</p>
                                    <p class="font-medium text-gray-800">{{ \Carbon\Carbon::parse($pemesanan->tanggal_masuk)->format('d/m/Y') }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Tanggal Keluar</p>
                                    <p class="font-medium text-gray-800">{{ \Carbon\Carbon::parse($pemesanan->tanggal_keluar)->format('d/m/Y') }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Durasi</p>
                                    <p class="font-medium text-gray-800">{{ $pemesanan->durasi }} Bulan</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Sistem Bayar</p>
                                    <p class="font-medium text-gray-800 capitalize">{{ $pemesanan->sistem_pembayaran }}</p>
                                </div>
                            </div>
                        </div>

                        <form action="{{ route('pembayaran.store', $pemesanan->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- Metode Pembayaran -->
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 mb-3">Metode Pembayaran</label>
                                <div class="grid grid-cols-2 gap-3">
                                    <label class="relative border rounded-xl p-4 cursor-pointer transition-all hover:border-indigo-400 has-[:checked]:border-indigo-600 has-[:checked]:bg-indigo-50">
                                        <input type="radio" name="metode" value="bca" class="sr-only" checked>
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                                <i class='bx bxl-visa text-2xl text-blue-600'></i>
                                            </div>
                                            <div>
                                                <p class="font-medium">BCA</p>
                                                <p class="text-xs text-gray-500">123 456 7890</p>
                                            </div>
                                        </div>
                                    </label>
                                    <label class="relative border rounded-xl p-4 cursor-pointer transition-all hover:border-indigo-400 has-[:checked]:border-indigo-600 has-[:checked]:bg-indigo-50">
                                        <input type="radio" name="metode" value="mandiri" class="sr-only">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center">
                                                <i class='bx bxl-mastercard text-2xl text-yellow-600'></i>
                                            </div>
                                            <div>
                                                <p class="font-medium">Mandiri</p>
                                                <p class="text-xs text-gray-500">123 456 7890</p>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            <!-- Jumlah Pembayaran -->
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah Pembayaran</label>
                                <div class="relative">
                                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 font-medium">Rp</span>
                                    <input type="text"
                                           name="jumlah"
                                           value="{{ number_format($pemesanan->total, 0, ',', '.') }}"
                                           class="w-full pl-12 pr-4 py-4 border border-gray-300 rounded-xl bg-gray-50 text-gray-700 font-semibold text-lg"
                                           readonly>
                                </div>
                                <p class="text-xs text-gray-500 mt-2">*Nominal sudah termasuk harga sewa {{ $pemesanan->durasi }} bulan</p>
                            </div>

                            <!-- Upload Bukti Transfer -->
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Upload Bukti Transfer</label>
                                <div class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:border-indigo-400 transition cursor-pointer" onclick="document.getElementById('bukti').click()">
                                    <i class='bx bx-cloud-upload text-4xl text-gray-400 mb-2'></i>
                                    <p class="text-sm text-gray-600">Klik untuk upload bukti transfer</p>
                                    <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, PDF (Max. 2MB)</p>
                                    <input type="file" id="bukti" name="bukti_transfer" class="hidden" accept=".jpg,.jpeg,.png,.pdf" required>
                                    <div id="file-name" class="text-sm text-indigo-600 mt-2 hidden"></div>
                                </div>
                            </div>

                            <!-- Informasi Penting -->
                            <div class="bg-amber-50 border border-amber-200 rounded-xl p-4 mb-6">
                                <div class="flex items-start gap-3">
                                    <i class='bx bx-info-circle text-amber-600 text-xl'></i>
                                    <div>
                                        <p class="text-sm font-medium text-amber-800">Informasi Penting</p>
                                        <p class="text-xs text-amber-700 mt-1">
                                            Transfer tepat sesuai nominal ke rekening tujuan.
                                            Pembayaran akan diverifikasi oleh admin maksimal 1x24 jam.
                                            Status pemesanan akan berubah menjadi "Aktif" setelah pembayaran disetujui.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Tombol Aksi -->
                            <div class="flex gap-3">
                                <button type="submit" class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white py-4 rounded-xl font-semibold transition transform hover:scale-[1.02]">
                                    <i class='bx bx-check-circle mr-2'></i>
                                    Konfirmasi Pembayaran
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Ringkasan Pembayaran -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-lg border border-indigo-100 overflow-hidden sticky top-24">
                    <div class="p-6 border-b border-indigo-100 bg-gradient-to-r from-indigo-50 to-purple-50">
                        <h3 class="font-bold text-gray-800 flex items-center gap-2">
                            <i class='bx bx-receipt text-indigo-600'></i>
                            Ringkasan
                        </h3>
                    </div>

                    <div class="p-6">
                        <div class="space-y-3 mb-4">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Harga Sewa/bulan</span>
                                <span class="font-medium">Rp {{ number_format($pemesanan->harga_per_periode, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Durasi</span>
                                <span class="font-medium">{{ $pemesanan->durasi }} bulan</span>
                            </div>
                            <div class="border-t border-dashed border-gray-200 my-3 pt-3">
                                <div class="flex justify-between font-bold">
                                    <span>Total Bayar</span>
                                    <span class="text-indigo-600 text-xl">Rp {{ number_format($pemesanan->total, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Rekening Tujuan -->
                        <div class="bg-gray-50 rounded-xl p-4">
                            <p class="text-sm font-medium text-gray-700 mb-2">Rekening Tujuan</p>
                            <div class="space-y-2">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-600">BCA</span>
                                    <span class="font-mono font-medium">123 456 7890</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-600">Mandiri</span>
                                    <span class="font-mono font-medium">123 456 7890</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-600">a.n.</span>
                                    <span class="font-medium">Kosan优雅</span>
                                </div>
                            </div>
                        </div>

                        <!-- Estimasi Verifikasi -->
                        <div class="flex items-center gap-2 mt-4 text-xs text-gray-500">
                            <i class='bx bx-time'></i>
                            <span>Estimasi verifikasi: 1x24 jam</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Tampilkan nama file yang diupload
    document.getElementById('bukti').addEventListener('change', function(e) {
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
