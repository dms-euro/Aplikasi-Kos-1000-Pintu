@extends('layouts.app')
@section('title', 'Manajemen Pemesanan - Staf')

@section('content')
<div class="p-6">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-5 mb-6">
        <div class="bg-white rounded-2xl border border-indigo-100 p-5 flex items-center justify-between hover:shadow-md transition">
            <div>
                <p class="text-sm text-indigo-500 font-medium flex items-center gap-1">
                    <i class='bx bx-calendar-check text-indigo-400'></i> Total Pemesanan
                </p>
                <p class="text-2xl font-bold text-gray-800">{{ $totalPending + $totalConfirmed + $totalCancelled }}</p>
            </div>
            <div class="w-12 h-12 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 text-2xl">
                <i class='bx bx-receipt'></i>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-amber-100 p-5 flex items-center justify-between hover:shadow-md transition">
            <div>
                <p class="text-sm text-amber-500 font-medium flex items-center gap-1">
                    <i class='bx bx-time-five text-amber-400'></i> Menunggu
                </p>
                <p class="text-2xl font-bold text-gray-800">{{ $totalPending }}</p>
                <p class="text-xs text-amber-600 mt-1">Perlu diproses</p>
            </div>
            <div class="w-12 h-12 rounded-full bg-amber-100 flex items-center justify-center text-amber-600 text-2xl">
                <i class='bx bx-hourglass'></i>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-green-100 p-5 flex items-center justify-between hover:shadow-md transition">
            <div>
                <p class="text-sm text-green-500 font-medium flex items-center gap-1">
                    <i class='bx bx-check-circle text-green-400'></i> Dikonfirmasi
                </p>
                <p class="text-2xl font-bold text-gray-800">{{ $totalConfirmed }}</p>
            </div>
            <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center text-green-600 text-2xl">
                <i class='bx bx-check-shield'></i>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-rose-100 p-5 flex items-center justify-between hover:shadow-md transition">
            <div>
                <p class="text-sm text-rose-500 font-medium flex items-center gap-1">
                    <i class='bx bx-credit-card-front text-rose-400'></i> Pembayaran Pending
                </p>
                <p class="text-2xl font-bold text-gray-800">{{ $pendingPayments }}</p>
                <p class="text-xs text-rose-600 mt-1">Perlu diverifikasi</p>
            </div>
            <div class="w-12 h-12 rounded-full bg-rose-100 flex items-center justify-center text-rose-600 text-2xl">
                <i class='bx bx-wallet'></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-indigo-100 p-5 shadow-sm mb-6">
        <form method="GET" action="{{ route('staf.pemesanan.index') }}" class="flex flex-col md:flex-row gap-4 items-end">
            <div class="flex-1">
                <label class="block text-sm font-medium text-gray-700 mb-2">Cari Penghuni / Kamar</label>
                <div class="relative">
                    <i class='bx bx-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400'></i>
                    <input type="text" name="search" value="{{ request('search') }}"
                           class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500"
                           placeholder="Nama penghuni atau kode kamar...">
                </div>
            </div>
            <div class="w-full md:w-48">
                <label class="block text-sm font-medium text-gray-700 mb-2">Status Pemesanan</label>
                <select name="status" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>
            <div class="w-full md:w-48">
                <label class="block text-sm font-medium text-gray-700 mb-2">Status Pembayaran</label>
                <select name="payment_status" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500">
                    <option value="">Semua</option>
                    <option value="belum" {{ request('payment_status') == 'belum' ? 'selected' : '' }}>Belum Bayar</option>
                    <option value="menunggu" {{ request('payment_status') == 'menunggu' ? 'selected' : '' }}>Menunggu Verifikasi</option>
                    <option value="sudah" {{ request('payment_status') == 'sudah' ? 'selected' : '' }}>Sudah Bayar</option>
                </select>
            </div>
            <div class="flex gap-2">
                <button type="submit" class="px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-medium transition">
                    <i class='bx bx-filter-alt mr-2'></i>Filter
                </button>
                <a href="{{ route('staf.pemesanan.index') }}" class="px-6 py-2 border border-gray-300 hover:bg-gray-50 rounded-lg font-medium transition">
                    <i class='bx bx-reset'></i>
                </a>
            </div>
        </form>
    </div>

    <div class="bg-white rounded-2xl border border-indigo-100 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-indigo-100 flex justify-between items-center">
            <h3 class="font-semibold text-gray-800 flex items-center gap-2">
                <i class='bx bx-calendar-check text-indigo-500'></i>
                Daftar Pemesanan
            </h3>
            <a href="{{ route('staf.pemesanan.pending') }}" class="bg-amber-500 hover:bg-amber-600 text-white px-4 py-2 rounded-lg text-sm font-medium flex items-center gap-2">
                <i class='bx bx-time'></i>
                Lihat Pengajuan ({{ $pendingPayments }})
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-indigo-50/70 text-indigo-800">
                    <tr>
                        <th class="px-4 py-3 text-left">ID</th>
                        <th class="px-4 py-3 text-left">Penghuni</th>
                        <th class="px-4 py-3 text-left">Kamar</th>
                        <th class="px-4 py-3 text-left">Tanggal Masuk</th>
                        <th class="px-4 py-3 text-left">Tanggal Keluar</th>
                        <th class="px-4 py-3 text-left">Durasi</th>
                        <th class="px-4 py-3 text-left">Total</th>
                        <th class="px-4 py-3 text-left">Status</th>
                        <th class="px-4 py-3 text-left">Pembayaran</th>
                        <th class="px-4 py-3 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-indigo-100">
                    @forelse($pemesanan as $item)
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
                        <td class="px-4 py-3">{{ \Carbon\Carbon::parse($item->tanggal_masuk)->format('d/m/Y') }}</td>
                        <td class="px-4 py-3">{{ \Carbon\Carbon::parse($item->tanggal_keluar)->format('d/m/Y') }}</td>
                        <td class="px-4 py-3">{{ $item->durasi_bulanan }} bln</td>
                        <td class="px-4 py-3 font-semibold">Rp{{ number_format($item->total, 0, ',', '.') }}</td>
                        <td class="px-4 py-3">
                            @php
                                $statusClass = [
                                    'pending' => 'bg-amber-100 text-amber-700',
                                    'confirmed' => 'bg-green-100 text-green-700',
                                    'cancelled' => 'bg-red-100 text-red-700'
                                ][$item->status] ?? 'bg-gray-100 text-gray-700';
                            @endphp
                            <span class="{{ $statusClass }} px-2 py-1 rounded-full text-xs capitalize">{{ $item->status }}</span>
                        </td>
                        <td class="px-4 py-3">
                            @php
                                $pembayaran = $item->pembayaran->first();
                                $paymentStatus = $pembayaran ? $pembayaran->status : 'belum';
                                $paymentClass = [
                                    'paid' => 'bg-green-100 text-green-700',
                                    'pending' => 'bg-amber-100 text-amber-700',
                                    'failed' => 'bg-red-100 text-red-700',
                                    'belum' => 'bg-gray-100 text-gray-700'
                                ][$paymentStatus] ?? 'bg-gray-100 text-gray-700';
                                $paymentText = [
                                    'paid' => 'Lunas',
                                    'pending' => 'Menunggu',
                                    'failed' => 'Gagal',
                                    'belum' => 'Belum Bayar'
                                ][$paymentStatus] ?? '-';
                            @endphp
                            <span class="{{ $paymentClass }} px-2 py-1 rounded-full text-xs">{{ $paymentText }}</span>
                        </td>
                        <td class="px-4 py-3">
                            <a href="{{ route('staf.pemesanan.show', $item->id) }}"
                                class="text-indigo-600 hover:text-indigo-800 bg-indigo-50 hover:bg-indigo-100 p-2 rounded-lg transition"
                                title="Detail">
                                <i class='bx bx-show text-lg'></i>
                            </a>

                            @if($item->status == 'pending' && (!$pembayaran || $pembayaran->status != 'paid'))
                                <a href="{{ route('staf.pemesanan.payment.create', $item->id) }}"
                                    class="text-green-600 hover:text-green-800 bg-green-50 hover:bg-green-100 p-2 rounded-lg transition ml-1"
                                    title="Input Pembayaran Langsung">
                                    <i class='bx bx-wallet text-lg'></i>
                                </a>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="10" class="text-center py-8 text-gray-500">
                            <i class='bx bx-folder-open text-4xl text-indigo-300 mb-2'></i>
                            <br>Tidak ada data pemesanan
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-3 border-t border-indigo-100">
            {{ $pemesanan->appends(request()->query())->links() }}
        </div>
    </div>
</div>
@endsection
