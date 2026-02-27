@extends('layouts.app')
@section('title', 'Laporan Kamar & Keuangan | Bapak Kos')
@section('content')

<div class="p-6 space-y-6">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                <i class='bx bx-bar-chart-alt-2 text-indigo-600'></i>
                Laporan Kamar & Keuangan
            </h2>
            <p class="text-sm text-gray-500 mt-1">Ringkasan kamar yang digunakan dan pemasukan dari pembayaran</p>
        </div>

        <!-- Filter Bulan -->
        <div class="flex items-center gap-2">
            <form method="GET" action="{{ route('admin.laporan.index') }}" class="flex items-center gap-2">
                <select name="bulan"
                    class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500">
                    @for ($i = 1; $i <= 12; $i++)
                        <option value="{{ $i }}" {{ $bulan == $i ? 'selected' : '' }}>
                            {{ Carbon\Carbon::create()->month($i)->format('F') }}
                        </option>
                    @endfor
                </select>
                <select name="tahun"
                    class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500">
                    @for ($i = now()->year; $i >= now()->year - 2; $i--)
                        <option value="{{ $i }}" {{ $tahun == $i ? 'selected' : '' }}>{{ $i }}
                        </option>
                    @endfor
                </select>
                <button type="submit"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
                    <i class='bx bx-filter-alt mr-1'></i> Filter
                </button>
            </form>

            <div class="dropdown relative">
                <button
                    class="border border-gray-300 hover:bg-gray-50 px-4 py-2 rounded-lg text-sm font-medium transition flex items-center gap-1"
                    id="exportDropdown" onclick="toggleExportMenu()">
                    <i class='bx bx-export'></i>
                    Export
                </button>
                <div id="exportMenu"
                    class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 z-10">
                    <button onclick="exportToExcel()" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg flex items-center gap-2">
                        <i class='bx bx-file text-green-500'></i> Export Excel
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistik Kamar -->
    <div class="grid grid-cols-5 lg:grid-cols-5 gap-4">
        <div class="bg-white rounded-xl border border-gray-200 p-4 shadow-sm">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center">
                    <i class='bx bx-bed text-xl text-indigo-600'></i>
                </div>
                <div>
                    <p class="text-xs text-gray-500">Total Kamar</p>
                    <p class="text-xl font-bold text-gray-800">{{ $totalKamar }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl border border-green-200 p-4 shadow-sm">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                    <i class='bx bx-check-circle text-xl text-green-600'></i>
                </div>
                <div>
                    <p class="text-xs text-gray-500">Terisi</p>
                    <p class="text-xl font-bold text-green-600">{{ $kamarTerisi }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl border border-blue-200 p-4 shadow-sm">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                    <i class='bx bx-door-open text-xl text-blue-600'></i>
                </div>
                <div>
                    <p class="text-xs text-gray-500">Tersedia</p>
                    <p class="text-xl font-bold text-blue-600">{{ $kamarTersedia }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl border border-amber-200 p-4 shadow-sm">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-amber-100 rounded-lg flex items-center justify-center">
                    <i class='bx bx-time-five text-xl text-amber-600'></i>
                </div>
                <div>
                    <p class="text-xs text-gray-500">Dipesan</p>
                    <p class="text-xl font-bold text-amber-600">{{ $kamarDipesan }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl border border-rose-200 p-4 shadow-sm">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-rose-100 rounded-lg flex items-center justify-center">
                    <i class='bx bx-wrench text-xl text-rose-600'></i>
                </div>
                <div>
                    <p class="text-xs text-gray-500">Perbaikan</p>
                    <p class="text-xl font-bold text-rose-600">{{ $kamarPerbaikan }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Ringkasan Pemasukan -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-indigo-600 text-white rounded-xl p-5 shadow-lg">
            <p class="text-sm opacity-90">Total Pemasukan Bulan Ini</p>
            <p class="text-2xl font-bold mt-1">Rp{{ number_format($totalPemasukan, 0, ',', '.') }}</p>
            <p class="text-xs opacity-75 mt-2">{{ Carbon\Carbon::create()->month($bulan)->format('F') }} {{ $tahun }}</p>
        </div>
        <div class="bg-green-600 text-white rounded-xl p-5 shadow-lg">
            <p class="text-sm opacity-90">Rata-rata per Hari</p>
            <p class="text-2xl font-bold mt-1">Rp{{ number_format($totalPemasukan / 30, 0, ',', '.') }}</p>
            <p class="text-xs opacity-75 mt-2">Estimasi 30 hari</p>
        </div>
        <div class="bg-purple-600 text-white rounded-xl p-5 shadow-lg">
            <p class="text-sm opacity-90">Total Transaksi</p>
            <p class="text-2xl font-bold mt-1">{{ $pemasukan->count() }}</p>
            <p class="text-xs opacity-75 mt-2">Kali pembayaran</p>
        </div>
        <div class="bg-amber-600 text-white rounded-xl p-5 shadow-lg">
            <p class="text-sm opacity-90">Kamar Terisi</p>
            <p class="text-2xl font-bold mt-1">{{ $kamarTerisi }}</p>
            <p class="text-xs opacity-75 mt-2">dari {{ $totalKamar }} kamar</p>
        </div>
    </div>

    <!-- Grafik Pemasukan -->
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-indigo-50 to-indigo-100/50">
            <h3 class="font-semibold text-gray-800 flex items-center gap-2">
                <i class='bx bx-line-chart text-indigo-600'></i>
                Grafik Pemasukan 6 Bulan Terakhir
            </h3>
        </div>
        <div class="p-6">
            <canvas id="chartPemasukan" width="400" height="200"></canvas>
        </div>
    </div>

    <!-- Ringkasan Keuangan Bulan Ini -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-indigo-50 to-indigo-100/50">
                <h3 class="font-semibold text-gray-800 flex items-center gap-2">
                    <i class='bx bx-money-withdraw text-indigo-600'></i>
                    Detail Pemasukan {{ Carbon\Carbon::create()->month($bulan)->format('F') }} {{ $tahun }}
                </h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm" id="pemasukanTable">
                    <thead class="bg-gray-50 text-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left">Tanggal</th>
                            <th class="px-6 py-3 text-left">Penghuni</th>
                            <th class="px-6 py-3 text-left">Kamar</th>
                            <th class="px-6 py-3 text-left">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($pemasukan as $item)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4">{{ Carbon\Carbon::parse($item->tanggal_bayar)->format('d/m/Y') }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <div
                                            class="w-7 h-7 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-700 text-xs font-bold">
                                            {{ substr($item->pemesanan->penghuni->nama ?? '?', 0, 1) }}
                                        </div>
                                        <span>{{ $item->pemesanan->penghuni->nama ?? '-' }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">{{ $item->pemesanan->kamar->kode_kamar ?? '-' }}</td>
                                <td class="px-6 py-4 font-semibold text-indigo-600">
                                    Rp{{ number_format($item->jumlah, 0, ',', '.') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                                    <i class='bx bx-receipt text-4xl text-gray-300 mb-2'></i>
                                    <p>Tidak ada data pembayaran bulan ini</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot class="bg-gray-50 font-semibold">
                        <tr>
                            <td colspan="3" class="px-6 py-3 text-right">Total Pemasukan</td>
                            <td class="px-6 py-3 text-indigo-600">Rp{{ number_format($totalPemasukan, 0, ',', '.') }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <!-- Top Penyewa Berdasarkan Pembayaran -->
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-indigo-50 to-indigo-100/50">
                <h3 class="font-semibold text-gray-800 flex items-center gap-2">
                    <i class='bx bx-trophy text-indigo-600'></i>
                    Top Pembayaran Bulan Ini
                </h3>
            </div>
            <div class="p-4">
                @forelse($penyewaTop as $index => $item)
                    <div
                        class="flex items-center gap-3 p-3 hover:bg-gray-50 rounded-lg transition {{ $index < count($penyewaTop) - 1 ? 'border-b border-gray-100' : '' }}">
                        <div
                            class="w-8 h-8 rounded-full
                            @if ($index == 0) bg-yellow-100 text-yellow-600
                            @elseif($index == 1) bg-gray-100 text-gray-600
                            @elseif($index == 2) bg-amber-100 text-amber-600
                            @else bg-indigo-100 text-indigo-600 @endif
                            flex items-center justify-center font-bold text-sm">
                            {{ $index + 1 }}
                        </div>
                        <div class="flex-1">
                            <p class="font-medium text-gray-800">{{ $item->penghuni->nama ?? '-' }}</p>
                            <p class="text-xs text-gray-500">Total Bayar:
                                Rp{{ number_format($item->total_bayar, 0, ',', '.') }}</p>
                        </div>
                        @if ($index == 0)
                            <i class='bx bx-crown text-yellow-500 text-xl'></i>
                        @endif
                    </div>
                @empty
                    <div class="text-center py-6 text-gray-500">
                        <i class='bx bx-user-x text-4xl text-gray-300 mb-2'></i>
                        <p class="text-sm">Belum ada data pembayaran</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Laporan Kamar yang Digunakan -->
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        <div
            class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-indigo-50 to-indigo-100/50 flex justify-between items-center">
            <h3 class="font-semibold text-gray-800 flex items-center gap-2">
                <i class='bx bx-bed text-indigo-600'></i>
                Kamar yang Sedang Digunakan ({{ $kamarDigunakan->count() }})
            </h3>
            <span class="text-xs text-gray-500">Update: {{ now()->format('d M Y H:i') }}</span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm" id="kamarDigunakanTable">
                <thead class="bg-gray-50 text-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left">No</th>
                        <th class="px-6 py-3 text-left">Kode Kamar</th>
                        <th class="px-6 py-3 text-left">Tipe Kamar</th>
                        <th class="px-6 py-3 text-left">Penghuni</th>
                        <th class="px-6 py-3 text-left">Kontak</th>
                        <th class="px-6 py-3 text-left">Tanggal Masuk</th>
                        <th class="px-6 py-3 text-left">Tanggal Keluar</th>
                        <th class="px-6 py-3 text-left">Durasi</th>
                        <th class="px-6 py-3 text-left">Total Sewa</th>
                        <th class="px-6 py-3 text-left">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($kamarDigunakan as $index => $item)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 font-medium">{{ $item->kamar->kode_kamar }}</td>
                            <td class="px-6 py-4">{{ $item->kamar->tipe_kamar->tipe ?? '-' }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <div
                                        class="w-7 h-7 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-700 text-xs font-bold">
                                        {{ substr($item->penghuni->nama ?? '?', 0, 1) }}
                                    </div>
                                    <span>{{ $item->penghuni->nama ?? '-' }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">{{ $item->penghuni->kontak ?? '-' }}</td>
                            <td class="px-6 py-4">{{ Carbon\Carbon::parse($item->tanggal_masuk)->format('d/m/Y') }}
                            </td>
                            <td class="px-6 py-4">{{ Carbon\Carbon::parse($item->tanggal_keluar)->format('d/m/Y') }}
                            </td>
                            <td class="px-6 py-4">{{ $item->durasi_bulanan }} bulan</td>
                            <td class="px-6 py-4 font-semibold text-indigo-600">
                                Rp{{ number_format($item->total, 0, ',', '.') }}</td>
                            <td class="px-6 py-4">
                                <span
                                    class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700 border border-green-200">
                                    <span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1.5"></span>
                                    Aktif
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="px-6 py-12 text-center text-gray-500">
                                <i class='bx bx-bed text-4xl text-gray-300 mb-2'></i>
                                <p>Tidak ada kamar yang sedang digunakan</p>
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
    <script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>
    <script>
        // Fungsi untuk toggle dropdown export
        function toggleExportMenu() {
            const menu = document.getElementById('exportMenu');
            menu.classList.toggle('hidden');
        }

        // Tutup dropdown ketika klik di luar
        document.addEventListener('click', function(e) {
            const exportBtn = document.getElementById('exportDropdown');
            const exportMenu = document.getElementById('exportMenu');

            if (!exportBtn.contains(e.target) && !exportMenu.contains(e.target)) {
                exportMenu.classList.add('hidden');
            }
        });

        // Fungsi untuk export ke Excel
        function exportToExcel() {
            try {
                // Ambil data dari tabel pemasukan
                const pemasukanTable = document.getElementById('pemasukanTable');
                const kamarTable = document.getElementById('kamarDigunakanTable');

                if (!pemasukanTable || !kamarTable) {
                    alert('Tabel tidak ditemukan!');
                    return;
                }

                // Buat workbook baru
                const wb = XLSX.utils.book_new();

                // Export tabel pemasukan
                const pemasukanData = [];

                // Header pemasukan
                const pemasukanHeaders = ['Tanggal', 'Penghuni', 'Kamar', 'Jumlah'];
                pemasukanData.push(pemasukanHeaders);

                // Data pemasukan
                const pemasukanRows = pemasukanTable.querySelectorAll('tbody tr');
                if (pemasukanRows.length > 0) {
                    pemasukanRows.forEach(row => {
                        const cells = row.querySelectorAll('td');
                        if (cells.length >= 4) {
                            const rowData = [
                                cells[0]?.innerText.trim() || '',
                                cells[1]?.innerText.trim().replace(/[A-Z]/g, '') || '', // Hapus inisial
                                cells[2]?.innerText.trim() || '',
                                cells[3]?.innerText.trim() || ''
                            ];
                            pemasukanData.push(rowData);
                        }
                    });
                } else {
                    pemasukanData.push(['Tidak ada data pembayaran bulan ini']);
                }

                // Tambahkan total
                const totalPemasukan = pemasukanTable.querySelector('tfoot td:last-child')?.innerText || 'Rp0';
                pemasukanData.push(['', '', 'Total Pemasukan', totalPemasukan]);

                // Buat sheet pemasukan
                const pemasukanSheet = XLSX.utils.aoa_to_sheet(pemasukanData);
                XLSX.utils.book_append_sheet(wb, pemasukanSheet, 'Pemasukan');

                // Export tabel kamar digunakan
                const kamarData = [];

                // Header kamar
                const kamarHeaders = ['No', 'Kode Kamar', 'Tipe Kamar', 'Penghuni', 'Kontak', 'Tanggal Masuk', 'Tanggal Keluar', 'Durasi', 'Total Sewa', 'Status'];
                kamarData.push(kamarHeaders);

                // Data kamar
                const kamarRows = kamarTable.querySelectorAll('tbody tr');
                if (kamarRows.length > 0) {
                    kamarRows.forEach(row => {
                        const cells = row.querySelectorAll('td');
                        if (cells.length >= 10) {
                            const rowData = [
                                cells[0]?.innerText.trim() || '',
                                cells[1]?.innerText.trim() || '',
                                cells[2]?.innerText.trim() || '',
                                cells[3]?.innerText.trim().replace(/[A-Z]/g, '') || '', // Hapus inisial
                                cells[4]?.innerText.trim() || '',
                                cells[5]?.innerText.trim() || '',
                                cells[6]?.innerText.trim() || '',
                                cells[7]?.innerText.trim() || '',
                                cells[8]?.innerText.trim() || '',
                                cells[9]?.innerText.trim() || ''
                            ];
                            kamarData.push(rowData);
                        }
                    });
                } else {
                    kamarData.push(['Tidak ada kamar yang sedang digunakan']);
                }

                // Buat sheet kamar
                const kamarSheet = XLSX.utils.aoa_to_sheet(kamarData);
                XLSX.utils.book_append_sheet(wb, kamarSheet, 'Kamar Digunakan');

                // Buat sheet statistik
                const statistikData = [
                    ['Statistik Kamar & Keuangan', ''],
                    ['Periode', '{{ Carbon\Carbon::create()->month($bulan)->format('F') }} {{ $tahun }}'],
                    ['', ''],
                    ['Total Kamar', '{{ $totalKamar }}'],
                    ['Kamar Terisi', '{{ $kamarTerisi }}'],
                    ['Kamar Tersedia', '{{ $kamarTersedia }}'],
                    ['Kamar Dipesan', '{{ $kamarDipesan }}'],
                    ['Kamar Perbaikan', '{{ $kamarPerbaikan }}'],
                    ['', ''],
                    ['Total Pemasukan', 'Rp{{ number_format($totalPemasukan, 0, ',', '.') }}'],
                    ['Total Transaksi', '{{ $pemasukan->count() }}'],
                    ['Rata-rata per Hari', 'Rp{{ number_format($totalPemasukan / 30, 0, ',', '.') }}']
                ];

                const statistikSheet = XLSX.utils.aoa_to_sheet(statistikData);
                XLSX.utils.book_append_sheet(wb, statistikSheet, 'Statistik');

                // Simpan file Excel
                const fileName = `laporan_kamar_keuangan_{{ Carbon\Carbon::create()->month($bulan)->format('F') }}_{{ $tahun }}.xlsx`;
                XLSX.writeFile(wb, fileName);

            } catch (error) {
                console.error('Error saat export Excel:', error);
                alert('Terjadi kesalahan saat export Excel. Silakan coba lagi.');
            }
        }

        // Inisialisasi chart
        const ctx = document.getElementById('chartPemasukan').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($grafikBulan),
                datasets: [{
                    label: 'Pemasukan (Rp)',
                    data: @json($grafikNominal),
                    borderColor: '#4f46e5',
                    backgroundColor: 'rgba(79, 70, 229, 0.1)',
                    borderWidth: 3,
                    pointBackgroundColor: '#4f46e5',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                    pointHoverRadius: 7,
                    tension: 0.3,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                let value = context.parsed.y;
                                return label + ': Rp ' + value.toLocaleString('id-ID');
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
