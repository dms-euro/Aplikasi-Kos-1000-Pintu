@extends('layouts.app')
@section('title', 'Konfirmasi Pemesanan - Petugas')

@section('content')
    <div class="p-6">
        <!-- Header dengan Statistik -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-5 mb-6">
            <!-- Total Pemesanan Pending -->
            <div
                class="bg-white rounded-2xl border border-indigo-100 p-5 flex items-center justify-between hover:shadow-md transition">
                <div>
                    <p class="text-sm text-indigo-500 font-medium flex items-center gap-1">
                        <i class='bx bx-time-five text-indigo-400'></i> Menunggu Konfirmasi
                    </p>
                    <p class="text-3xl font-bold text-gray-800">{{ $pemesanan->total() }}</p>
                    <p class="text-xs text-gray-400 mt-1">Perlu dicek</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 text-2xl">
                    <i class='bx bx-hourglass'></i>
                </div>
            </div>

            <!-- Total Sudah Dibayar (dari data) -->
            <div
                class="bg-white rounded-2xl border border-green-100 p-5 flex items-center justify-between hover:shadow-md transition">
                <div>
                    <p class="text-sm text-green-500 font-medium flex items-center gap-1">
                        <i class='bx bx-check-circle text-green-400'></i> Sudah Dibayar
                    </p>
                    <p class="text-3xl font-bold text-gray-800">
                        {{ $pemesanan->filter(function ($p) {return $p->pembayaran->isNotEmpty();})->count() }}</p>
                    <p class="text-xs text-green-600 mt-1">Siap dikonfirmasi</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center text-green-600 text-2xl">
                    <i class='bx bx-wallet'></i>
                </div>
            </div>

            <!-- Total Belum Bayar -->
            <div
                class="bg-white rounded-2xl border border-amber-100 p-5 flex items-center justify-between hover:shadow-md transition">
                <div>
                    <p class="text-sm text-amber-500 font-medium flex items-center gap-1">
                        <i class='bx bx-x-circle text-amber-400'></i> Belum Bayar
                    </p>
                    <p class="text-3xl font-bold text-gray-800">
                        {{ $pemesanan->filter(function ($p) {return $p->pembayaran->isEmpty();})->count() }}</p>
                    <p class="text-xs text-amber-600 mt-1">Menunggu pembayaran</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-amber-100 flex items-center justify-center text-amber-600 text-2xl">
                    <i class='bx bx-credit-card'></i>
                </div>
            </div>

            <!-- Link ke Riwayat -->
            <a href="{{ route('pemesanan.history') }}"
                class="bg-white rounded-2xl border border-purple-100 p-5 flex items-center justify-between hover:shadow-md transition group">
                <div>
                    <p class="text-sm text-purple-500 font-medium flex items-center gap-1">
                        <i class='bx bx-history text-purple-400'></i> Riwayat
                    </p>
                    <p class="text-3xl font-bold text-gray-800 group-hover:text-purple-600 transition">Lihat</p>
                    <p class="text-xs text-gray-400 mt-1">Pesanan selesai</p>
                </div>
                <div
                    class="w-12 h-12 rounded-full bg-purple-100 flex items-center justify-center text-purple-600 text-2xl group-hover:bg-purple-200 transition">
                    <i class='bx bx-right-arrow-alt'></i>
                </div>
            </a>
        </div>

        <!-- Filter dan Pencarian -->
        <div class="bg-white rounded-2xl border border-indigo-100 p-5 shadow-sm mb-6">
            <div class="flex flex-col md:flex-row gap-4 items-start md:items-center justify-between">
                <div class="flex items-center gap-3">
                    <h3 class="font-semibold text-gray-800">Filter</h3>
                    <select id="filterStatus"
                        class="border border-indigo-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500">
                        <option value="">Semua Status</option>
                        <option value="sudah">Sudah Bayar</option>
                        <option value="belum">Belum Bayar</option>
                    </select>
                </div>
                <div class="relative w-full md:w-64">
                    <i class='bx bx-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400'></i>
                    <input type="text" id="searchInput" placeholder="Cari penghuni atau kamar..."
                        class="w-full pl-10 pr-4 py-2 border border-indigo-200 rounded-xl focus:ring-2 focus:ring-indigo-500">
                </div>
            </div>
        </div>

        <!-- Tabel Pemesanan -->
        <div class="bg-white rounded-2xl border border-indigo-100 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-indigo-100">
                <h3 class="font-semibold text-gray-800 flex items-center gap-2">
                    <i class='bx bx-calendar-check text-indigo-500'></i>
                    Daftar Pemesanan Menunggu Konfirmasi
                </h3>
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
                            <th class="px-4 py-3 text-left">Durasi</th>
                            <th class="px-4 py-3 text-left">Total</th>
                            <th class="px-4 py-3 text-left">Status Bayar</th>
                            <th class="px-4 py-3 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-indigo-100">
                        @forelse($pemesanan as $item)
                            <tr class="hover:bg-indigo-50/40 transition">
                                <td class="px-4 py-3 font-mono text-xs">#{{ $item->id }}</td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center gap-2">
                                        <div
                                            class="w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-700 text-xs font-bold">
                                            {{ substr($item->penghuni->nama ?? '?', 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="font-medium">{{ $item->penghuni->nama ?? 'Unknown' }}</p>
                                            <p class="text-xs text-gray-500">{{ $item->penghuni->kontak ?? '-' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3">
                                    <p class="font-medium">{{ $item->kamar->kode_kamar ?? 'Unknown' }}</p>
                                    <p class="text-xs text-gray-500">{{ $item->kamar->tipeKamar->tipe ?? '-' }}</p>
                                </td>
                                <td class="px-4 py-3">{{ \Carbon\Carbon::parse($item->tanggal_masuk)->format('d/m/Y') }}
                                </td>
                                <td class="px-4 py-3">{{ \Carbon\Carbon::parse($item->tanggal_keluar)->format('d/m/Y') }}
                                </td>
                                <td class="px-4 py-3">{{ $item->durasi_bulanan }} bulan</td>
                                <td class="px-4 py-3 font-semibold text-indigo-600">Rp
                                    {{ number_format($item->total, 0, ',', '.') }}</td>
                                <td class="px-4 py-3">
                                    @php
                                        $pembayaran = $item->pembayaran->first();
                                    @endphp
                                    @if ($pembayaran)
                                        <span
                                            class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs flex items-center gap-1 w-fit">
                                            <i class='bx bx-check-circle'></i> Sudah Bayar
                                        </span>
                                    @else
                                        <span
                                            class="bg-amber-100 text-amber-700 px-2 py-1 rounded-full text-xs flex items-center gap-1 w-fit">
                                            <i class='bx bx-time'></i> Belum Bayar
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex gap-2">
                                        <a href="{{ route('pemesanan.show', $item->id) }}"
                                            class="text-indigo-600 hover:text-indigo-800 bg-indigo-50 hover:bg-indigo-100 p-2 rounded-lg transition"
                                            title="Detail">
                                            <i class='bx bx-show text-lg'></i>
                                        </a>
                                        @if ($item->status === 'pending')
                                            <a href="{{ route('pemesanan.confirm', $item->id) }}"
                                            class="text-indigo-600 hover:text-indigo-800 bg-indigo-50 hover:bg-indigo-100 p-2 rounded-lg transition"
                                            title="Konfirmasi">
                                            <i class='bx bx-check-circle text-lg'></i>
                                        </a>
                                            <button onclick="openCancelModal({{ $item->id }})"
                                                class="text-rose-600 hover:text-rose-800 bg-rose-50 hover:bg-rose-100 p-2 rounded-lg transition"
                                                title="Batalkan">
                                                <i class='bx bx-x-circle text-lg'></i>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-12 text-gray-500">
                                    <i class='bx bx-folder-open text-5xl text-indigo-300 mb-3'></i>
                                    <p class="text-lg font-medium">Belum ada pemesanan</p>
                                    <p class="text-sm">Semua pemesanan sudah dikonfirmasi</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="px-6 py-3 border-t border-indigo-100">
                {{ $pemesanan->links() }}
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi -->
    <div id="confirmModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
        <div class="bg-white rounded-2xl max-w-md w-full p-6">
            <div class="text-center mb-4">
                <div class="w-16 h-16 rounded-full bg-green-100 flex items-center justify-center mx-auto mb-3">
                    <i class='bx bx-check-circle text-4xl text-green-600'></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800">Konfirmasi Pemesanan</h3>
                <p class="text-sm text-gray-600 mt-2">
                    Apakah Anda yakin ingin mengkonfirmasi pemesanan ini?<br>
                    Kamar akan berstatus <span class="font-semibold text-green-600">Terisi</span>
                </p>
            </div>

            <form id="confirmForm" method="POST">
                @csrf
                <button type="submit"
                    class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-xl font-medium transition mb-2">
                    Ya, Konfirmasi
                </button>
                <button type="button" onclick="closeConfirmModal()"
                    class="w-full border border-gray-300 hover:bg-gray-50 py-3 rounded-xl font-medium transition">
                    Batal
                </button>
            </form>
        </div>
    </div>

    <!-- Modal Pembatalan -->
    <div id="cancelModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
        <div class="bg-white rounded-2xl max-w-md w-full p-6">
            <div class="text-center mb-4">
                <div class="w-16 h-16 rounded-full bg-rose-100 flex items-center justify-center mx-auto mb-3">
                    <i class='bx bx-x-circle text-4xl text-rose-600'></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800">Batalkan Pemesanan</h3>
                <p class="text-sm text-gray-600 mt-2">
                    Pemesanan akan dibatalkan dan kamar kembali <span class="font-semibold text-green-600">Tersedia</span>
                </p>
            </div>

            <form id="cancelForm" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Alasan Pembatalan</label>
                    <textarea name="alasan" rows="3"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-indigo-500"
                        placeholder="Contoh: Belum melakukan pembayaran, data tidak valid, dll." required></textarea>
                </div>
                <button type="submit"
                    class="w-full bg-rose-600 hover:bg-rose-700 text-white py-3 rounded-xl font-medium transition mb-2">
                    Ya, Batalkan
                </button>
                <button type="button" onclick="closeCancelModal()"
                    class="w-full border border-gray-300 hover:bg-gray-50 py-3 rounded-xl font-medium transition">
                    Batal
                </button>
            </form>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        let currentPemesananId = null;

        function openConfirmModal(id) {
            currentPemesananId = id;
            document.getElementById('confirmForm').action = "{{ url('petugas/konfirmasi') }}/" + id + "/confirm";
            document.getElementById('confirmModal').classList.remove('hidden');
        }

        function closeConfirmModal() {
            document.getElementById('confirmModal').classList.add('hidden');
        }

        function openCancelModal(id) {
            currentPemesananId = id;
            document.getElementById('cancelForm').action = "{{ url('petugas/konfirmasi') }}/" + id + "/cancel";
            document.getElementById('cancelModal').classList.remove('hidden');
        }

        function closeCancelModal() {
            document.getElementById('cancelModal').classList.add('hidden');
        }

        // Filter dan pencarian
        document.getElementById('filterStatus')?.addEventListener('change', filterTable);
        document.getElementById('searchInput')?.addEventListener('keyup', filterTable);

        function filterTable() {
            let filter = document.getElementById('filterStatus').value;
            let search = document.getElementById('searchInput').value.toLowerCase();
            let rows = document.querySelectorAll('tbody tr');

            rows.forEach(row => {
                let statusBayar = row.querySelector('td:nth-child(8) span')?.innerText.toLowerCase() || '';
                let text = row.innerText.toLowerCase();

                let matchFilter = !filter ||
                    (filter === 'sudah' && statusBayar.includes('sudah')) ||
                    (filter === 'belum' && statusBayar.includes('belum'));
                let matchSearch = !search || text.includes(search);

                if (matchFilter && matchSearch) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            let confirmModal = document.getElementById('confirmModal');
            let cancelModal = document.getElementById('cancelModal');

            if (event.target === confirmModal) {
                closeConfirmModal();
            }
            if (event.target === cancelModal) {
                closeCancelModal();
            }
        }
    </script>
@endpush
