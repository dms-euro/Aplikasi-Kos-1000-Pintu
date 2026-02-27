@extends('layouts.app')
@section('title', 'Dashboard Admin | Bapak Kos')
@section('content')

    <div class="p-6 space-y-6">
        <!-- Header Selamat Datang -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Halo, {{ Auth::user()->nama }}! 👋</h1>
                <p class="text-gray-500 mt-1">Selamat datang di dashboard admin Bapak Kos</p>
            </div>
            <div class="mt-3 md:mt-0 flex items-center gap-2 bg-indigo-50 px-4 py-2 rounded-lg">
                <i class='bx bx-calendar text-indigo-600'></i>
                <span class="text-sm text-gray-700">{{ now()->format('l, d F Y') }}</span>
            </div>
        </div>

        <!-- Statistik Utama -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            <!-- Total Penghuni -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-5 hover:shadow-md transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Total Penghuni</p>
                        <p class="text-3xl font-bold text-gray-800">{{ $totalPenghuni }}</p>
                        <p class="text-xs text-green-600 mt-1 flex items-center gap-1">
                            <i class='bx bx-user-plus'></i>
                            +{{ $penghuniBaru }} bulan ini
                        </p>
                    </div>
                    <div class="w-12 h-12 rounded-full bg-indigo-100 flex items-center justify-center">
                        <i class='bx bx-group text-2xl text-indigo-600'></i>
                    </div>
                </div>
            </div>

            <!-- Total Kamar -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-5 hover:shadow-md transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Total Kamar</p>
                        <p class="text-3xl font-bold text-gray-800">{{ $totalKamar }}</p>
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

            <!-- Pemesanan Aktif -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-5 hover:shadow-md transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Pemesanan Aktif</p>
                        <p class="text-3xl font-bold text-gray-800">{{ $pemesananAktif }}</p>
                        <p class="text-xs text-green-600 mt-1 flex items-center gap-1">
                            <i class='bx bx-check-circle'></i>
                            {{ $pemesananPending }} menunggu
                        </p>
                    </div>
                    <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center">
                        <i class='bx bx-calendar-check text-2xl text-green-600'></i>
                    </div>
                </div>
            </div>

            <!-- Total Pemasukan Bulan Ini -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-5 hover:shadow-md transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Pemasukan Bulan Ini</p>
                        <p class="text-2xl font-bold text-gray-800">Rp{{ number_format($pemasukanBulanIni, 0, ',', '.') }}
                        </p>
                        <p class="text-xs text-indigo-600 mt-1 flex items-center gap-1">
                            <i class='bx bx-trending-up'></i>
                            {{ $totalTransaksi }} transaksi
                        </p>
                    </div>
                    <div class="w-12 h-12 rounded-full bg-amber-100 flex items-center justify-center">
                        <i class='bx bx-money text-2xl text-amber-600'></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Grafik dan Status Kamar -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Grafik Pemasukan 7 Hari Terakhir -->
            <div class="lg:col-span-2 bg-white rounded-2xl border border-gray-200 p-5 shadow-sm">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="font-semibold text-gray-800 flex items-center gap-2">
                        <i class='bx bx-line-chart text-indigo-500 text-xl'></i>
                        Pemasukan 7 Hari Terakhir
                    </h3>
                    <span class="text-xs bg-indigo-100 text-indigo-700 px-3 py-1 rounded-full">
                        Total: Rp{{ number_format($totalPemasukan7Hari, 0, ',', '.') }}
                    </span>
                </div>
                <div class="h-64">
                    <canvas id="chartPemasukan"></canvas>
                </div>
            </div>

            <!-- Status Kamar -->
            <div class="bg-white rounded-2xl border border-gray-200 p-5 shadow-sm">
                <h3 class="font-semibold text-gray-800 flex items-center gap-2 mb-4">
                    <i class='bx bx-door-open text-indigo-500 text-xl'></i>
                    Status Kamar
                </h3>
                <div class="space-y-4">
                    <!-- Progress Bar Terisi -->
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="text-gray-600">Terisi</span>
                            <span class="font-medium text-gray-800">{{ $kamarTerisi }} kamar</span>
                        </div>
                        <div class="w-full bg-gray-200 h-2 rounded-full">
                            <div class="bg-green-500 h-2 rounded-full" style="width: {{ $persenTerisi }}%"></div>
                        </div>
                    </div>
                    <!-- Progress Bar Tersedia -->
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="text-gray-600">Tersedia</span>
                            <span class="font-medium text-gray-800">{{ $kamarTersedia }} kamar</span>
                        </div>
                        <div class="w-full bg-gray-200 h-2 rounded-full">
                            <div class="bg-blue-500 h-2 rounded-full" style="width: {{ $persenTersedia }}%"></div>
                        </div>
                    </div>
                    <!-- Progress Bar Dipesan -->
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="text-gray-600">Dipesan</span>
                            <span class="font-medium text-gray-800">{{ $kamarDipesan }} kamar</span>
                        </div>
                        <div class="w-full bg-gray-200 h-2 rounded-full">
                            <div class="bg-amber-500 h-2 rounded-full" style="width: {{ $persenDipesan }}%"></div>
                        </div>
                    </div>
                    <!-- Progress Bar Perbaikan -->
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="text-gray-600">Perbaikan</span>
                            <span class="font-medium text-gray-800">{{ $kamarPerbaikan }} kamar</span>
                        </div>
                        <div class="w-full bg-gray-200 h-2 rounded-full">
                            <div class="bg-rose-500 h-2 rounded-full" style="width: {{ $persenPerbaikan }}%"></div>
                        </div>
                    </div>
                </div>

                <!-- Ringkasan Kamar -->
                <div class="mt-6 grid grid-cols-2 gap-3">
                    <div class="bg-indigo-50 p-3 rounded-lg text-center">
                        <p class="text-xs text-gray-500">Total Kamar</p>
                        <p class="text-xl font-bold text-indigo-600">{{ $totalKamar }}</p>
                    </div>
                    <div class="bg-green-50 p-3 rounded-lg text-center">
                        <p class="text-xs text-gray-500">Okupansi</p>
                        <p class="text-xl font-bold text-green-600">{{ $persenTerisi }}%</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Aktivitas Terkini dan Pemesanan Terbaru -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Aktivitas Terkini -->
            <div class="lg:col-span-1 bg-white rounded-2xl border border-gray-200 p-5 shadow-sm">
                <h3 class="font-semibold text-gray-800 flex items-center gap-2 mb-4">
                    <i class='bx bx-bell-ring text-amber-500 text-xl'></i>
                    Aktivitas Terkini
                </h3>
                <div class="space-y-4">
                    @forelse($aktivitas as $item)
                        <div class="flex items-start gap-3">
                            <div
                                class="w-2 h-2 mt-2 rounded-full
                        @if ($item->status == 'pembayaran') bg-green-500
                        @elseif($item->status == 'pemesanan') bg-blue-500
                        @elseif($item->status == 'penghuni') bg-indigo-500
                        @else bg-gray-500 @endif">
                            </div>
                            <div class="flex-1">
                                <p class="text-sm text-gray-700">{{ $item->deskripsi }}</p>
                                <p class="text-xs text-gray-400 mt-1">{{ $item->waktu }}</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500 text-center py-4">Belum ada aktivitas</p>
                    @endforelse
                </div>
            </div>

            <!-- Pemesanan Terbaru -->
            <div class="lg:col-span-2 bg-white rounded-2xl border border-gray-200 p-5 shadow-sm">
                <h3 class="font-semibold text-gray-800 flex items-center gap-2 mb-4">
                    <i class='bx bx-calendar-check text-indigo-500 text-xl'></i>
                    Pemesanan Terbaru
                </h3>
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
                                            <div
                                                class="w-7 h-7 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-700 text-xs font-bold">
                                                {{ substr($item->penghuni->nama ?? '?', 0, 1) }}
                                            </div>
                                            <span>{{ $item->penghuni->nama ?? '-' }}</span>
                                        </div>
                                    </td>
                                    <td class="py-3">{{ $item->kamar->kode_kamar ?? '-' }}</td>
                                    <td class="py-3">{{ Carbon\Carbon::parse($item->tanggal_masuk)->format('d/m/Y') }}
                                    </td>
                                    <td class="py-3">
                                        @php
                                            $statusClass =
                                                [
                                                    'pending' => 'bg-amber-100 text-amber-700',
                                                    'confirmed' => 'bg-green-100 text-green-700',
                                                    'cancelled' => 'bg-red-100 text-red-700',
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
            </div>
        </div>

        <!-- 5 Pemasukan Terbesar Bulan Ini -->
        <div class="bg-white rounded-2xl border border-gray-200 p-5 shadow-sm">
            <h3 class="font-semibold text-gray-800 flex items-center gap-2 mb-4">
                <i class='bx bx-trophy text-amber-500 text-xl'></i>
                5 Pemasukan Terbesar Bulan Ini
            </h3>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-gray-200">
                            <th class="py-2 text-left font-medium text-gray-600">No</th>
                            <th class="py-2 text-left font-medium text-gray-600">Penghuni</th>
                            <th class="py-2 text-left font-medium text-gray-600">Kamar</th>
                            <th class="py-2 text-left font-medium text-gray-600">Tanggal Bayar</th>
                            <th class="py-2 text-left font-medium text-gray-600">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($pemasukanTerbesar as $index => $item)
                            <tr class="hover:bg-gray-50">
                                <td class="py-3">
                                    <span
                                        class="inline-flex items-center justify-center w-6 h-6 rounded-full
                                @if ($index == 0) bg-yellow-100 text-yellow-700
                                @elseif($index == 1) bg-gray-100 text-gray-700
                                @elseif($index == 2) bg-amber-100 text-amber-700
                                @else bg-indigo-100 text-indigo-700 @endif
                                text-xs font-bold">
                                        {{ $index + 1 }}
                                    </span>
                                </td>
                                <td class="py-3">{{ $item->pemesanan->penghuni->nama ?? '-' }}</td>
                                <td class="py-3">{{ $item->pemesanan->kamar->kode_kamar ?? '-' }}</td>
                                <td class="py-3">{{ Carbon\Carbon::parse($item->tanggal_bayar)->format('d/m/Y') }}</td>
                                <td class="py-3 font-semibold text-indigo-600">
                                    Rp{{ number_format($item->jumlah, 0, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-4 text-center text-gray-500">
                                    Belum ada data pemasukan
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
        <script>
            // Grafik Pemasukan 7 Hari Terakhir
            const ctx = document.getElementById('chartPemasukan').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: @json($grafikLabel),
                    datasets: [{
                        label: 'Pemasukan',
                        data: @json($grafikData),
                        borderColor: '#4f46e5',
                        backgroundColor: 'rgba(79, 70, 229, 0.1)',
                        borderWidth: 3,
                        pointBackgroundColor: '#4f46e5',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        tension: 0.3,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return 'Rp ' + context.parsed.y.toLocaleString('id-ID');
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return 'Rp ' + value.toLocaleString('id-ID');
                                }
                            }
                        }
                    }
                }
            });
        </script>
    @endpush
@endsection
