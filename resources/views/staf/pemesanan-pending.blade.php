@extends('layouts.app')
@section('title', 'Pengajuan Pembayaran - Staf')

@section('content')
<div class="p-6">
    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center gap-3">
            <a href="{{ route('staf.pemesanan.index') }}" class="w-10 h-10 bg-white border border-indigo-200 rounded-full flex items-center justify-center hover:bg-indigo-50 transition">
                <i class='bx bx-arrow-back text-indigo-600'></i>
            </a>
            <h1 class="text-2xl font-bold text-gray-800">Pengajuan Pembayaran</h1>
        </div>
        <span class="bg-amber-100 text-amber-700 px-4 py-2 rounded-full text-sm font-medium">
            {{ $pemesanan->total() }} Pengajuan
        </span>
    </div>

    <!-- Tabel Pengajuan -->
    <div class="bg-white rounded-2xl border border-indigo-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-indigo-50/70 text-indigo-800">
                    <tr>
                        <th class="px-4 py-3 text-left">ID</th>
                        <th class="px-4 py-3 text-left">Penghuni</th>
                        <th class="px-4 py-3 text-left">Kamar</th>
                        <th class="px-4 py-3 text-left">Tanggal Bayar</th>
                        <th class="px-4 py-3 text-left">Jumlah</th>
                        <th class="px-4 py-3 text-left">Bukti</th>
                        <th class="px-4 py-3 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-indigo-100">
                    @forelse($pemesanan as $item)
                        @foreach($item->pembayaran->where('status', 'pending') as $pembayaran)
                        <tr class="hover:bg-indigo-50/40 transition">
                            <td class="px-4 py-3 font-mono text-xs">#{{ $item->id }}</td>
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-700 text-xs font-bold">
                                        {{ substr($item->penghuni->nama ?? '?', 0, 1) }}
                                    </div>
                                    <span>{{ $item->penghuni->nama ?? 'Unknown' }}</span>
                                </div>
                            </td>
                            <td class="px-4 py-3">{{ $item->kamar->kode_kamar ?? '-' }}</td>
                            <td class="px-4 py-3">{{ \Carbon\Carbon::parse($pembayaran->tanggal_bayar)->format('d/m/Y H:i') }}</td>
                            <td class="px-4 py-3 font-semibold text-indigo-600">Rp{{ number_format($pembayaran->jumlah, 0, ',', '.') }}</td>
                            <td class="px-4 py-3">
                                @if($pembayaran->bukti_bayar)
                                    <a href="{{ asset('storage/' . $pembayaran->bukti_bayar) }}" target="_blank"
                                       class="text-indigo-600 hover:text-indigo-800 flex items-center gap-1">
                                        <i class='bx bx-image'></i> Lihat
                                    </a>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex gap-2">
                                    <form action="{{ route('staf.pembayaran.approve', $pembayaran->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit"
                                                class="bg-green-500 hover:bg-green-600 text-white px-3 py-1.5 rounded-lg text-xs font-medium transition"
                                                onclick="return confirm('Setujui pembayaran ini?')">
                                            <i class='bx bx-check'></i> Setujui
                                        </button>
                                    </form>

                                    <button onclick="openRejectModal({{ $pembayaran->id }})"
                                            class="bg-rose-500 hover:bg-rose-600 text-white px-3 py-1.5 rounded-lg text-xs font-medium transition">
                                        <i class='bx bx-x'></i> Tolak
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-8 text-gray-500">
                            <i class='bx bx-check-circle text-4xl text-green-300 mb-2'></i>
                            <br>Tidak ada pengajuan pembayaran
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

<!-- Modal Tolak -->
<div id="rejectModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-2xl max-w-md w-full p-6">
        <h3 class="text-lg font-bold text-gray-800 mb-4">Tolak Pembayaran</h3>
        <form id="rejectForm" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Alasan Penolakan</label>
                <textarea name="alasan" rows="3" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-indigo-500" required></textarea>
            </div>
            <div class="flex gap-3">
                <button type="submit" class="flex-1 bg-rose-600 hover:bg-rose-700 text-white py-2.5 rounded-lg font-medium">
                    Tolak
                </button>
                <button type="button" onclick="closeRejectModal()" class="flex-1 border border-gray-300 hover:bg-gray-50 py-2.5 rounded-lg font-medium">
                    Batal
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openRejectModal(pembayaranId) {
        document.getElementById('rejectForm').action = '/staf/pembayaran/' + pembayaranId + '/reject';
        document.getElementById('rejectModal').classList.remove('hidden');
    }

    function closeRejectModal() {
        document.getElementById('rejectModal').classList.add('hidden');
    }

    window.onclick = function(event) {
        let modal = document.getElementById('rejectModal');
        if (event.target === modal) {
            modal.classList.add('hidden');
        }
    }
</script>
@endsection
