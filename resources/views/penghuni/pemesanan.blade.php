@extends('layouts.app')
@section('title', 'Sewa Kamar - ' . $kamar->kode_kamar)

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="container mx-auto px-4 max-w-4xl">
        <!-- Header dengan Progress Bar -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Sewa Kamar</h1>
            <p class="text-gray-600">Lengkapi data pemesanan dan pembayaran kamar pilihan Anda</p>
        </div>

        <!-- Informasi Kamar -->
        <div class="bg-white rounded-2xl shadow-lg border border-indigo-100 overflow-hidden mb-6">
            <div class="p-6 border-b border-indigo-100 bg-gradient-to-r from-indigo-50 to-purple-50">
                <h2 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                    <i class='bx bx-bed text-indigo-600'></i>
                    Informasi Kamar
                </h2>
            </div>
            <div class="p-6">
                <div class="flex flex-col md:flex-row gap-6">
                    <!-- Foto Kamar -->
                    <div class="md:w-1/3">
                        <img src="{{ $kamar->foto_kamar ? asset('storage/'.$kamar->foto_kamar) : 'https://placehold.co/400x300/4f46e5/white?text=Kamar' }}"
                             alt="{{ $kamar->kode_kamar }}"
                             class="w-full h-48 object-cover rounded-xl shadow-md">
                    </div>

                    <!-- Detail Kamar -->
                    <div class="md:w-2/3">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-500">Kode Kamar</p>
                                <p class="font-semibold text-lg">{{ $kamar->kode_kamar }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Tipe Kamar</p>
                                <p class="font-semibold">{{ $kamar->tipe_kamar->tipe }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Harga per Bulan</p>
                                <p class="text-xl font-bold text-indigo-600">Rp {{ number_format($kamar->tipe_kamar->harga, 0, ',', '.') }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Status</p>
                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">Tersedia</span>
                            </div>
                        </div>
                        <div class="mt-4">
                            <p class="text-sm text-gray-500">Deskripsi</p>
                            <p class="text-gray-700">{{ $kamar->tipe_kamar->deskripsi }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Pemesanan -->
        <div class="bg-white rounded-2xl shadow-lg border border-indigo-100 overflow-hidden mb-6">
            <div class="p-6 border-b border-indigo-100 bg-gradient-to-r from-indigo-50 to-purple-50">
                <h2 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                    <i class='bx bx-calendar-check text-indigo-600'></i>
                    Form Pemesanan
                </h2>
            </div>
            <div class="p-6">
                <form action="{{ route('pemesanan.store') }}" method="POST" id="formPemesanan">
                    @csrf
                    <input type="hidden" name="kamar_id" value="{{ $kamar->id }}">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Tanggal Masuk -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <i class='bx bx-calendar text-indigo-500 mr-1'></i>
                                Tanggal Masuk
                            </label>
                            <input type="date"
                                   name="tanggal_masuk"
                                   id="tanggal_masuk"
                                   class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                   min="{{ date('Y-m-d') }}"
                                   required>
                        </div>

                        <!-- Durasi Bulanan -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <i class='bx bx-time text-indigo-500 mr-1'></i>
                                Durasi Sewa (bulan)
                            </label>
                            <select name="durasi_bulanan"
                                    id="durasi_bulanan"
                                    class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                    required>
                                <option value="">Pilih Durasi</option>
                                <option value="1">1 Bulan</option>
                                <option value="3">3 Bulan</option>
                                <option value="6">6 Bulan</option>
                                <option value="12">12 Bulan</option>
                            </select>
                        </div>

                        <!-- Tanggal Keluar (Otomatis) -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <i class='bx bx-calendar-x text-indigo-500 mr-1'></i>
                                Tanggal Keluar
                            </label>
                            <input type="date"
                                   name="tanggal_keluar"
                                   id="tanggal_keluar"
                                   class="w-full border border-gray-300 rounded-xl px-4 py-3 bg-gray-100"
                                   readonly>
                        </div>

                        <!-- Total Harga (Otomatis) -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <i class='bx bx-money text-indigo-500 mr-1'></i>
                                Total Harga
                            </label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500">Rp</span>
                                <input type="text"
                                       id="total_harga"
                                       class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-xl bg-gray-100 font-semibold text-indigo-600"
                                       readonly>
                            </div>
                        </div>
                    </div>

                    <!-- Informasi Penting -->
                    <div class="mt-6 bg-blue-50 border border-blue-200 rounded-xl p-4">
                        <div class="flex items-start gap-3">
                            <i class='bx bx-info-circle text-blue-600 text-xl'></i>
                            <div>
                                <p class="text-sm font-medium text-blue-800">Informasi Penting</p>
                                <p class="text-xs text-blue-700 mt-1">
                                    - Setelah melakukan pemesanan, status kamar akan berubah menjadi "Dipesan"<br>
                                    - Anda akan diarahkan ke halaman pembayaran untuk menyelesaikan transaksi<br>
                                    - Pemesanan akan dikonfirmasi setelah pembayaran diverifikasi oleh petugas
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Submit -->
                    <button type="submit"
                            class="w-full mt-6 bg-indigo-600 hover:bg-indigo-700 text-white py-4 rounded-xl font-semibold shadow-lg transition transform hover:scale-[1.02]">
                        <i class='bx bx-check-circle mr-2'></i>
                        Buat Pemesanan
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const tanggalMasuk = document.getElementById('tanggal_masuk');
    const durasiBulanan = document.getElementById('durasi_bulanan');
    const tanggalKeluar = document.getElementById('tanggal_keluar');
    const totalHarga = document.getElementById('total_harga');
    const hargaPerBulan = {{ $kamar->tipe_kamar->harga }};

    function hitungTanggalKeluar() {
        if (tanggalMasuk.value && durasiBulanan.value) {
            let tgl = new Date(tanggalMasuk.value);
            let durasi = parseInt(durasiBulanan.value);

            tgl.setMonth(tgl.getMonth() + durasi);

            let tahun = tgl.getFullYear();
            let bulan = String(tgl.getMonth() + 1).padStart(2, '0');
            let hari = String(tgl.getDate()).padStart(2, '0');

            tanggalKeluar.value = `${tahun}-${bulan}-${hari}`;

            // Hitung total harga
            let total = hargaPerBulan * durasi;
            totalHarga.value = total.toLocaleString('id-ID');
        }
    }

    tanggalMasuk.addEventListener('change', hitungTanggalKeluar);
    durasiBulanan.addEventListener('change', hitungTanggalKeluar);
});
</script>
@endsection
