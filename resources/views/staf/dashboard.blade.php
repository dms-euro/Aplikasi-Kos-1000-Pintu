@extends('layouts.app')
@section('title', 'Dashboard Staf | Bapak Kos')
@section('content')

<div class="p-6 space-y-6">
    <!-- Header Selamat Datang -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Halo, {{ Auth::user()->nama }}! 👋</h1>
            <p class="text-gray-500 mt-1">Selamat datang di dashboard staf Bapak Kos</p>
        </div>
        <div class="mt-3 md:mt-0 flex items-center gap-2 bg-indigo-50 px-4 py-2 rounded-lg">
            <i class='bx bx-calendar text-indigo-600'></i>
            <span class="text-sm text-gray-700">{{ now()->format('l, d F Y') }}</span>
        </div>
    </div>

    <!-- Statistik Utama untuk Staf -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        <!-- Total Penghuni Aktif -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-5 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 font-medium">Penghuni Aktif</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $penghuniAktif }}</p>
                    <p class="text-xs text-green-600 mt-1 flex items-center gap-1">
                        <i class='bx bx-user-check'></i>
                        {{ $penghuniBaru }} baru bulan ini
                    </p>
                </div>
                <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center">
                    <i class='bx bx-user-check text-2xl text-green-600'></i>
                </div>
            </div>
        </div>

        <!-- Kamar Terisi -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-5 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 font-medium">Kamar Terisi</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $kamarTerisi }}</p>
                    <p class="text-xs text-blue-600 mt-1 flex items-center gap-1">
                        <i class='bx bx-bed'></i>
                        {{ $kamarTersedia }} tersedia
                    </p>
                </div>
                <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center">
                    <i class='bx bx-bed text-2xl text-blue-600'></i>
                </div>
            </div>
        </div>

        <!-- Pending Verifikasi -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-5 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 font-medium">Pending Verifikasi</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $pendingVerifikasi }}</p>
                    <p class="text-xs text-amber-600 mt-1 flex items-center gap-1">
                        <i class='bx bx-time'></i>
                        {{ $pemesananPending }} pemesanan
                    </p>
                </div>
                <div class="w-12 h-12 rounded-full bg-amber-100 flex items-center justify-center">
                    <i class='bx bx-hourglass text-2xl text-amber-600'></i>
                </div>
            </div>
        </div>

        <!-- Pemasukan Hari Ini -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-5 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 font-medium">Pemasukan Hari Ini</p>
                    <p class="text-2xl font-bold text-gray-800">Rp{{ number_format($pemasukanHariIni, 0, ',', '.') }}</p>
                    <p class="text-xs text-indigo-600 mt-1 flex items-center gap-1">
                        <i class='bx bx-trending-up'></i>
                        {{ $transaksiHariIni }} transaksi
                    </p>
                </div>
                <div class="w-12 h-12 rounded-full bg-indigo-100 flex items-center justify-center">
                    <i class='bx bx-money text-2xl text-indigo-600'></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Tugas Utama Staf (Quick Actions) -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
        <div class="bg-indigo-600 rounded-2xl p-5 text-white shadow-lg">
            <div class="flex items-start justify-between mb-4">
                <div>
                    <h3 class="text-lg font-semibold">Verifikasi Pembayaran</h3>
                    <p class="text-indigo-100 text-sm mt-1">{{ $pendingVerifikasi }} pembayaran menunggu</p>
                </div>
                <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center">
                    <i class='bx bx-check-shield text-2xl'></i>
                </div>
            </div>
                <a href="" class="inline-flex items-center gap-1 bg-white/20 hover:bg-white/30 px-4 py-2 rounded-lg text-sm transition">
                    Verifikasi Sekarang <i class='bx bx-right-arrow-alt'></i>
                </a>
        </div>

        <div class="bg-green-600 rounded-2xl p-5 text-white shadow-lg">
            <div class="flex items-start justify-between mb-4">
                <div>
                    <h3 class="text-lg font-semibold">Konfirmasi Pemesanan</h3>
                    <p class="text-green-100 text-sm mt-1">{{ $pemesananPending }} pemesanan baru</p>
                </div>
                <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center">
                    <i class='bx bx-calendar-check text-2xl'></i>
                </div>
            </div>
            <a href="" class="inline-flex items-center gap-1 bg-white/20 hover:bg-white/30 px-4 py-2 rounded-lg text-sm transition">
                Konfirmasi <i class='bx bx-right-arrow-alt'></i>
            </a>
        </div>

        <div class="bg-amber-600 rounded-2xl p-5 text-white shadow-lg">
            <div class="flex items-start justify-between mb-4">
                <div>
                    <h3 class="text-lg font-semibold">Input Penghuni</h3>
                    <p class="text-amber-100 text-sm mt-1">Tambah penghuni baru</p>
                </div>
                <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center">
                    <i class='bx bx-user-plus text-2xl'></i>
                </div>
            </div>
            <a href="" class="inline-flex items-center gap-1 bg-white/20 hover:bg-white/30 px-4 py-2 rounded-lg text-sm transition">
                Input Penghuni <i class='bx bx-right-arrow-alt'></i>
            </a>
        </div>
    </div>

    <!-- Dua Kolom: Pending Verifikasi & Pemesanan Terbaru -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Daftar Pembayaran Menunggu Verifikasi -->
        <div class="bg-white rounded-2xl border border-gray-200 p-5 shadow-sm">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-semibold text-gray-800 flex items-center gap-2">
                    <i class='bx bx-hourglass text-amber-500 text-xl'></i>
                    Pembayaran Menunggu Verifikasi
                </h3>
                <span class="text-xs bg-amber-100 text-amber-700 px-3 py-1 rounded-full">
                    {{ $pendingVerifikasi }} menunggu
                </span>
            </div>
            <div class="space-y-3">
                @forelse($pembayaranPending as $item)
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-700 text-sm font-bold">
                            {{ substr($item->pemesanan->penghuni->nama ?? '?', 0, 1) }}
                        </div>
                        <div>
                            <p class="font-medium text-sm">{{ $item->pemesanan->penghuni->nama ?? '-' }}</p>
                            <p class="text-xs text-gray-500">Kamar {{ $item->pemesanan->kamar->kode_kamar ?? '-' }} • Rp{{ number_format($item->jumlah, 0, ',', '.') }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-xs text-gray-500">{{ $item->created_at->diffForHumans() }}</span>
                        {{-- <a href="{{ route('staf.verifikasi.show', $item->id) }}" class="text-indigo-600 hover:text-indigo-800">
                            <i class='bx bx-show text-lg'></i>
                        </a> --}}
                    </div>
                </div>
                @empty
                <div class="text-center py-6 text-gray-500">
                    <i class='bx bx-check-circle text-4xl text-green-300 mb-2'></i>
                    <p class="text-sm">Tidak ada pembayaran yang perlu diverifikasi</p>
                </div>
                @endforelse
            </div>
            @if($pendingVerifikasi > 0)
            {{-- <a href="{{ route('staf.verifikasi.index') }}" class="block w-full mt-4 text-sm text-indigo-600 bg-indigo-50 hover:bg-indigo-100 py-2 rounded-xl text-center transition">
                Lihat Semua
            </a> --}}
            @endif
        </div>

        <!-- Pemesanan Terbaru -->
        <div class="bg-white rounded-2xl border border-gray-200 p-5 shadow-sm">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-semibold text-gray-800 flex items-center gap-2">
                    <i class='bx bx-calendar-check text-indigo-500 text-xl'></i>
                    Pemesanan Terbaru
                </h3>
                <span class="text-xs bg-indigo-100 text-indigo-700 px-3 py-1 rounded-full">
                    {{ $pemesananTerbaru->count() }} baru
                </span>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-gray-200">
                            <th class="py-2 text-left font-medium text-gray-600">Penghuni</th>
                            <th class="py-2 text-left font-medium text-gray-600">Kamar</th>
                            <th class="py-2 text-left font-medium text-gray-600">Tanggal Masuk</th>
                            <th class="py-2 text-left font-medium text-gray-600">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($pemesananTerbaru as $item)
                        <tr class="hover:bg-gray-50">
                            <td class="py-3">
                                <div class="flex items-center gap-2">
                                    <div class="w-7 h-7 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-700 text-xs font-bold">
                                        {{ substr($item->penghuni->nama ?? '?', 0, 1) }}
                                    </div>
                                    <span>{{ $item->penghuni->nama ?? '-' }}</span>
                                </div>
                            </td>
                            <td class="py-3">{{ $item->kamar->kode_kamar ?? '-' }}</td>
                            <td class="py-3">{{ \Carbon\Carbon::parse($item->tanggal_masuk)->format('d/m/Y') }}</td>
                            <td class="py-3">
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
                            <td colspan="4" class="py-4 text-center text-gray-500">
                                Belum ada pemesanan
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{-- <a href="{{ route('staf.pemesanan.index') }}" class="block w-full mt-4 text-sm text-indigo-600 bg-indigo-50 hover:bg-indigo-100 py-2 rounded-xl text-center transition">
                Lihat Semua Pemesanan
            </a> --}}
        </div>
    </div>

    <!-- Status Kamar Hari Ini -->
    <div class="bg-white rounded-2xl border border-gray-200 p-5 shadow-sm">
        <h3 class="font-semibold text-gray-800 flex items-center gap-2 mb-4">
            <i class='bx bx-door-open text-indigo-500 text-xl'></i>
            Status Kamar Hari Ini
        </h3>
        <div class="grid grid-cols-5 md:grid-cols-5 gap-4">
            <div class="bg-green-50 p-4 rounded-xl text-center border border-green-100">
                <p class="text-xs text-gray-500">Terisi</p>
                <p class="text-2xl font-bold text-green-600">{{ $kamarTerisi }}</p>
                <p class="text-xs text-green-600 mt-1">{{ $persenTerisi }}%</p>
            </div>
            <div class="bg-blue-50 p-4 rounded-xl text-center border border-blue-100">
                <p class="text-xs text-gray-500">Tersedia</p>
                <p class="text-2xl font-bold text-blue-600">{{ $kamarTersedia }}</p>
                <p class="text-xs text-blue-600 mt-1">{{ $persenTersedia }}%</p>
            </div>
            <div class="bg-amber-50 p-4 rounded-xl text-center border border-amber-100">
                <p class="text-xs text-gray-500">Dipesan</p>
                <p class="text-2xl font-bold text-amber-600">{{ $kamarDipesan }}</p>
                <p class="text-xs text-amber-600 mt-1">{{ $persenDipesan }}%</p>
            </div>
            <div class="bg-rose-50 p-4 rounded-xl text-center border border-rose-100">
                <p class="text-xs text-gray-500">Perbaikan</p>
                <p class="text-2xl font-bold text-rose-600">{{ $kamarPerbaikan }}</p>
                <p class="text-xs text-rose-600 mt-1">{{ $persenPerbaikan }}%</p>
            </div>
            <div class="bg-purple-50 p-4 rounded-xl text-center border border-purple-100">
                <p class="text-xs text-gray-500">Total Kamar</p>
                <p class="text-2xl font-bold text-purple-600">{{ $totalKamar }}</p>
                <p class="text-xs text-purple-600 mt-1">100%</p>
            </div>
        </div>
    </div>

    <!-- Aktivitas Terkini -->
    <div class="bg-white rounded-2xl border border-gray-200 p-5 shadow-sm">
        <h3 class="font-semibold text-gray-800 flex items-center gap-2 mb-4">
            <i class='bx bx-bell-ring text-amber-500 text-xl'></i>
            Aktivitas Terkini
        </h3>
        <div class="space-y-4">
            @forelse($aktivitas as $item)
            <div class="flex items-start gap-3 border-b border-gray-100 pb-3 last:border-0 last:pb-0">
                <div class="w-2 h-2 mt-2 rounded-full
                    @if($item->tipe == 'pembayaran') bg-green-500
                    @elseif($item->tipe == 'pemesanan') bg-blue-500
                    @elseif($item->tipe == 'penghuni') bg-indigo-500
                    @else bg-gray-500 @endif">
                </div>
                <div class="flex-1">
                    <p class="text-sm text-gray-700">{{ $item->deskripsi }}</p>
                    <p class="text-xs text-gray-400 mt-1">{{ $item->waktu }}</p>
                </div>
                {{-- @if($item->link)
                <a href="{{ $item->link }}" class="text-indigo-600 hover:text-indigo-800 text-sm">
                    <i class='bx bx-show'></i>
                </a>
                @endif --}}
            </div>
            @empty
            <p class="text-sm text-gray-500 text-center py-4">Belum ada aktivitas</p>
            @endforelse
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Auto-refresh untuk data pending (opsional)
    // setTimeout(function() {
    //     location.reload();
    // }, 300000); // Refresh setiap 5 menit
</script>
@endpush
@endsection
