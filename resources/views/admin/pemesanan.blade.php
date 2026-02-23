@extends('layouts.app')
@section('title', 'Manajemen Penyewaan | Bapak Kos')
@section('content')

<div class="p-6 space-y-6">
    <!-- Header dengan Statistik -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-5">
        <!-- Total Penyewaan -->
        <div class="bg-white rounded-2xl border border-indigo-100 p-5 flex items-center justify-between hover:shadow-md transition">
            <div>
                <p class="text-sm text-indigo-500 font-medium flex items-center gap-1"><i class='bx bx-calendar-check text-indigo-400'></i> Total Penyewaan</p>
                <p class="text-2xl font-bold text-gray-800">{{ $totalPenyewaan }}</p>
                <p class="text-xs text-gray-400 mt-1">Semua status</p>
            </div>
            <div class="w-12 h-12 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 text-2xl">
                <i class='bx bx-receipt'></i>
            </div>
        </div>

        <!-- Aktif -->
        <div class="bg-white rounded-2xl border border-green-100 p-5 flex items-center justify-between hover:shadow-md transition">
            <div>
                <p class="text-sm text-green-500 font-medium flex items-center gap-1"><i class='bx bx-check-circle text-green-400'></i> Aktif</p>
                <p class="text-2xl font-bold text-gray-800">{{ $aktif }}</p>
                <p class="text-xs text-green-600 mt-1">{{ $aktifPersen }}% dari total</p>
            </div>
            <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center text-green-600 text-2xl">
                <i class='bx bx-user-check'></i>
            </div>
        </div>

        <!-- Pending -->
        <div class="bg-white rounded-2xl border border-amber-100 p-5 flex items-center justify-between hover:shadow-md transition">
            <div>
                <p class="text-sm text-amber-500 font-medium flex items-center gap-1"><i class='bx bx-time-five text-amber-400'></i> Pending</p>
                <p class="text-2xl font-bold text-gray-800">{{ $pending }}</p>
                <p class="text-xs text-amber-600 mt-1">Menunggu konfirmasi</p>
            </div>
            <div class="w-12 h-12 rounded-full bg-amber-100 flex items-center justify-center text-amber-600 text-2xl">
                <i class='bx bx-hourglass'></i>
            </div>
        </div>

        <!-- Selesai -->
        <div class="bg-white rounded-2xl border border-emerald-100 p-5 flex items-center justify-between hover:shadow-md transition">
            <div>
                <p class="text-sm text-emerald-500 font-medium flex items-center gap-1"><i class='bx bx-check-double text-emerald-400'></i> Selesai</p>
                <p class="text-2xl font-bold text-gray-800">{{ $selesai }}</p>
                <p class="text-xs text-emerald-600 mt-1">Kontrak berakhir</p>
            </div>
            <div class="w-12 h-12 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600 text-2xl">
                <i class='bx bx-check-shield'></i>
            </div>
        </div>
    </div>

    <!-- Filter dan Pencarian -->
    <div class="bg-white rounded-2xl border border-indigo-100 p-5 shadow-sm">
        <div class="flex flex-col md:flex-row gap-4 items-start md:items-center justify-between">
            <div class="flex items-center gap-3">
                <h3 class="font-semibold text-gray-800">Filter Penyewaan</h3>
                <select id="filterStatus" class="border border-indigo-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500">
                    <option value="">Semua Status</option>
                    <option value="pending">Pending</option>
                    <option value="aktif">Aktif</option>
                    <option value="selesai">Selesai</option>
                    <option value="batal">Batal</option>
                </select>
                <select id="filterSistem" class="border border-indigo-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500">
                    <option value="">Semua Sistem</option>
                    <option value="mingguan">Mingguan</option>
                    <option value="bulanan">Bulanan</option>
                </select>
            </div>
            <div class="relative w-full md:w-64">
                <i class='bx bx-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400'></i>
                <input type="text" id="searchInput" placeholder="Cari penghuni atau kamar..." class="w-full pl-10 pr-4 py-2 border border-indigo-200 rounded-xl focus:ring-2 focus:ring-indigo-500">
            </div>
        </div>
    </div>

    <!-- Tabel Penyewaan -->
    <div class="bg-white rounded-2xl border border-indigo-100 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-indigo-100 flex justify-between items-center">
            <h3 class="font-semibold text-gray-800 flex items-center gap-2"><i class='bx bx-calendar-check text-indigo-500'></i> Daftar Penyewaan</h3>
            <button onclick="openCreateModal()" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-xl text-sm font-medium flex items-center gap-2 transition">
                <i class='bx bx-plus-circle'></i> Tambah Penyewaan
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-indigo-50/70 text-indigo-800">
                    <tr>
                        <th class="px-4 py-3 text-left">ID</th>
                        <th class="px-4 py-3 text-left">Penghuni</th>
                        <th class="px-4 py-3 text-left">Kamar</th>
                        <th class="px-4 py-3 text-left">Tgl Masuk</th>
                        <th class="px-4 py-3 text-left">Tgl Keluar</th>
                        <th class="px-4 py-3 text-left">Sistem</th>
                        <th class="px-4 py-3 text-left">Durasi</th>
                        <th class="px-4 py-3 text-left">Total</th>
                        <th class="px-4 py-3 text-left">Status</th>
                        <th class="px-4 py-3 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-indigo-100" id="penyewaanTable">
                    @forelse($penyewaan as $item)
                    <tr class="hover:bg-indigo-50/40 transition">
                        <td class="px-4 py-3 font-mono text-xs">{{ $item->id }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2">
                                <div class="w-7 h-7 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-700 text-xs font-bold">
                                    {{ substr($item->penghuni->nama ?? '?', 0, 1) }}
                                </div>
                                <span>{{ $item->penghuni->nama ?? 'Unknown' }}</span>
                            </div>
                        </td>
                        <td class="px-4 py-3">{{ $item->kamar->kode_kamar ?? 'Unknown' }}</td>
                        <td class="px-4 py-3">{{ \Carbon\Carbon::parse($item->tanggal_masuk)->format('d/m/Y') }}</td>
                        <td class="px-4 py-3">{{ \Carbon\Carbon::parse($item->tanggal_keluar)->format('d/m/Y') }}</td>
                        <td class="px-4 py-3">
                            <span class="capitalize">{{ $item->sistem_pembayaran }}</span>
                        </td>
                        <td class="px-4 py-3">{{ $item->durasi }} bulan</td>
                        <td class="px-4 py-3 font-semibold text-indigo-600">Rp {{ number_format($item->total, 0, ',', '.') }}</td>
                        <td class="px-4 py-3">
                            @php
                                $statusClass = [
                                    'pending' => 'bg-amber-100 text-amber-700',
                                    'aktif' => 'bg-green-100 text-green-700',
                                    'selesai' => 'bg-blue-100 text-blue-700',
                                    'batal' => 'bg-red-100 text-red-700'
                                ][$item->status] ?? 'bg-gray-100 text-gray-700';
                            @endphp
                            <span class="{{ $statusClass }} px-2 py-1 rounded-full text-xs font-medium capitalize">
                                {{ $item->status }}
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex gap-2">
                                <button onclick="openEditModal({{ $item->id }})" class="text-amber-500 hover:text-amber-700 bg-amber-50 hover:bg-amber-100 p-1.5 rounded-lg transition" title="Edit">
                                    <i class='bx bx-edit-alt text-lg'></i>
                                </button>
                                <button onclick="confirmDelete({{ $item->id }})" class="text-rose-500 hover:text-rose-700 bg-rose-50 hover:bg-rose-100 p-1.5 rounded-lg transition" title="Hapus">
                                    <i class='bx bx-trash text-lg'></i>
                                </button>
                                {{-- <a href="{{ route('penyewaan.invoice', $item->id) }}" class="text-indigo-500 hover:text-indigo-700 bg-indigo-50 hover:bg-indigo-100 p-1.5 rounded-lg transition" title="Invoice" target="_blank">
                                    <i class='bx bx-receipt text-lg'></i>
                                </a> --}}
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="10" class="text-center py-8 text-gray-500">
                            <i class='bx bx-folder-open text-4xl text-indigo-300 mb-2'></i>
                            <br>Belum ada data penyewaan
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-3 border-t border-indigo-100 flex justify-between items-center">
            <span class="text-xs text-indigo-400">Menampilkan {{ $penyewaan->firstItem() ?? 0 }} - {{ $penyewaan->lastItem() ?? 0 }} dari {{ $penyewaan->total() }} data</span>
            {{ $penyewaan->links() }}
        </div>
    </div>

    <!-- Ringkasan Keuangan -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <div class="bg-gradient-to-br from-white to-indigo-50/50 rounded-2xl border border-indigo-200 p-5">
            <h3 class="font-semibold text-gray-800 flex items-center gap-2 mb-3"><i class='bx bx-line-chart text-indigo-500'></i> Total Pendapatan</h3>
            <div class="space-y-3">
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">Total Keseluruhan</span>
                    <span class="text-xl font-bold text-indigo-600">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">Bulan Ini</span>
                    <span class="text-lg font-semibold text-emerald-600">Rp {{ number_format($pendapatanBulanIni, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">Tahun Ini</span>
                    <span class="text-lg font-semibold text-amber-600">Rp {{ number_format($pendapatanTahunIni, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-indigo-100 p-5">
            <h3 class="font-semibold text-gray-800 flex items-center gap-2 mb-3"><i class='bx bx-pie-chart-alt-2 text-indigo-500'></i> Statistik Status</h3>
            <div class="space-y-3">
                <div>
                    <div class="flex justify-between text-sm mb-1">
                        <span>Aktif</span>
                        <span class="font-medium">{{ $aktif }} ({{ $aktifPersen }}%)</span>
                    </div>
                    <div class="w-full bg-indigo-100 h-2 rounded-full">
                        <div class="bg-green-500 h-2 rounded-full" style="width: {{ $aktifPersen }}%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between text-sm mb-1">
                        <span>Pending</span>
                        <span class="font-medium">{{ $pending }} ({{ $pendingPersen }}%)</span>
                    </div>
                    <div class="w-full bg-indigo-100 h-2 rounded-full">
                        <div class="bg-amber-500 h-2 rounded-full" style="width: {{ $pendingPersen }}%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between text-sm mb-1">
                        <span>Selesai</span>
                        <span class="font-medium">{{ $selesai }} ({{ $selesaiPersen }}%)</span>
                    </div>
                    <div class="w-full bg-indigo-100 h-2 rounded-full">
                        <div class="bg-blue-500 h-2 rounded-full" style="width: {{ $selesaiPersen }}%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between text-sm mb-1">
                        <span>Batal</span>
                        <span class="font-medium">{{ $batal }} ({{ $batalPersen }}%)</span>
                    </div>
                    <div class="w-full bg-indigo-100 h-2 rounded-full">
                        <div class="bg-red-500 h-2 rounded-full" style="width: {{ $batalPersen }}%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah / Edit Penyewaan -->
<div id="penyewaanModal" tabindex="-1" class="hidden fixed top-0 right-0 left-0 z-50 flex justify-center items-center w-full h-full bg-black/40">
    <div class="relative p-4 w-full max-w-2xl max-h-full overflow-y-auto">
        <div class="bg-white rounded-2xl shadow-lg border border-indigo-100">
            <!-- Header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b border-indigo-100">
                <h3 class="text-lg font-semibold text-gray-900" id="modalTitle">Tambah Penyewaan</h3>
                <button data-modal-hide="penyewaanModal" class="text-gray-400 hover:text-gray-600">
                    <i class='bx bx-x text-2xl'></i>
                </button>
            </div>
        </div>
    </div>
</div>
{{--
<!-- Form Delete (hidden) -->
@foreach($penyewaan as $item)
    <form id="delete-form-{{ $item->id }}" action="{{ route('penyewaan.destroy', $item->id) }}" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>
@endforeach --}}

@endsection

@push('scripts')
<script>
    // Hitung total otomatis
    document.getElementById('kamar_id')?.addEventListener('change', function() {
        let selected = this.options[this.selectedIndex];
        let harga = selected.getAttribute('data-harga') || 0;
        document.getElementById('harga_per_periode').value = harga;
        hitungTotal();
    });

    document.getElementById('durasi')?.addEventListener('input', hitungTotal);
    document.getElementById('harga_per_periode')?.addEventListener('input', hitungTotal);

    function hitungTotal() {
        let harga = parseFloat(document.getElementById('harga_per_periode').value) || 0;
        let durasi = parseFloat(document.getElementById('durasi').value) || 0;
        let total = harga * durasi;
        document.getElementById('total').value = total;
    }

    // Open modal create
    function openCreateModal() {
        document.getElementById('modalTitle').innerText = 'Tambah Penyewaan';
        document.getElementById('penyewaanForm').reset();
        document.getElementById('penyewaanId').value = '';
        document.getElementById('penyewaanModal').classList.remove('hidden');
    }

    // Open modal edit
    function openEditModal(id) {
        // Fetch data via AJAX atau gunakan data dari server
        // Untuk demo, kita redirect ke halaman edit
        window.location.href = "{{ url('penyewaan') }}/" + id + "/edit";
    }

    // Confirm delete
    function confirmDelete(id) {
        Swal.fire({
            title: 'Yakin hapus?',
            text: "Data penyewaan akan dihapus permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc2626',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }

    // Filter dan search (client-side sederhana)
    document.getElementById('filterStatus')?.addEventListener('change', filterTable);
    document.getElementById('filterSistem')?.addEventListener('change', filterTable);
    document.getElementById('searchInput')?.addEventListener('keyup', filterTable);

    function filterTable() {
        let status = document.getElementById('filterStatus').value.toLowerCase();
        let sistem = document.getElementById('filterSistem').value.toLowerCase();
        let search = document.getElementById('searchInput').value.toLowerCase();
        let rows = document.querySelectorAll('#penyewaanTable tr');

        rows.forEach(row => {
            let statusCell = row.querySelector('td:nth-child(9) span')?.innerText.toLowerCase() || '';
            let sistemCell = row.querySelector('td:nth-child(6) span')?.innerText.toLowerCase() || '';
            let text = row.innerText.toLowerCase();

            let matchStatus = !status || statusCell.includes(status);
            let matchSistem = !sistem || sistemCell.includes(sistem);
            let matchSearch = !search || text.includes(search);

            if (matchStatus && matchSistem && matchSearch) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    // Close modal when clicking outside
    window.onclick = function(event) {
        let modal = document.getElementById('penyewaanModal');
        if (event.target === modal) {
            modal.classList.add('hidden');
        }
    }

    // Hide modal with button
    document.querySelectorAll('[data-modal-hide="penyewaanModal"]').forEach(btn => {
        btn.addEventListener('click', () => {
            document.getElementById('penyewaanModal').classList.add('hidden');
        });
    });
</script>
@endpush
