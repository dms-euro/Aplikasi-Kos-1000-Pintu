@extends('layouts.app')
@section('title', 'Manajemen Pemesanan - Staf')

@section('content')
    <div class="p-6">
        <!-- Statistik Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">
            <div class="bg-white rounded-xl border border-indigo-100 p-5 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-indigo-500 font-medium">Menunggu Konfirmasi</p>
                        <p class="text-3xl font-bold text-gray-800">{{ $totalPending }}</p>
                    </div>
                    <div class="w-12 h-12 rounded-full bg-amber-100 flex items-center justify-center text-amber-600">
                        <i class='bx bx-time-five text-2xl'></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl border border-green-100 p-5 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-green-500 font-medium">Terkonfirmasi</p>
                        <p class="text-3xl font-bold text-gray-800">{{ $totalConfirmed }}</p>
                    </div>
                    <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center text-green-600">
                        <i class='bx bx-check-circle text-2xl'></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl border border-rose-100 p-5 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-rose-500 font-medium">Dibatalkan</p>
                        <p class="text-3xl font-bold text-gray-800">{{ $totalCancelled }}</p>
                    </div>
                    <div class="w-12 h-12 rounded-full bg-rose-100 flex items-center justify-center text-rose-600">
                        <i class='bx bx-x-circle text-2xl'></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Pemesanan Perlu Konfirmasi -->
        <div class="bg-white rounded-xl border border-amber-200 shadow-sm overflow-hidden mb-8">
            <div class="px-6 py-4 bg-amber-50 border-b border-amber-200">
                <h2 class="font-semibold text-amber-800 flex items-center gap-2">
                    <i class='bx bx-bell'></i>
                    Pemesanan Perlu Konfirmasi ({{ $pendingPemesanan->count() }})
                </h2>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 text-gray-700">
                        <tr>
                            <th class="px-4 py-3 text-left">ID</th>
                            <th class="px-4 py-3 text-left">Penghuni</th>
                            <th class="px-4 py-3 text-left">Kamar</th>
                            <th class="px-4 py-3 text-left">Tipe</th>
                            <th class="px-4 py-3 text-left">Tgl Masuk</th>
                            <th class="px-4 py-3 text-left">Tgl Keluar</th>
                            <th class="px-4 py-3 text-left">Durasi</th>
                            <th class="px-4 py-3 text-left">Total</th>
                            <th class="px-4 py-3 text-left">Bukti</th>
                            <th class="px-4 py-3 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($pendingPemesanan as $item)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 font-mono text-xs">#{{ $item->id }}</td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center gap-2">
                                        <div
                                            class="w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-700 text-xs font-bold">
                                            {{ substr($item->penghuni->nama ?? '?', 0, 1) }}
                                        </div>
                                        <span>{{ $item->penghuni->nama ?? '-' }}</span>
                                    </div>
                                </td>
                                <td class="px-4 py-3 font-medium">{{ $item->kamar->kode_kamar ?? '-' }}</td>
                                <td class="px-4 py-3">{{ $item->kamar->tipe_kamar->tipe ?? '-' }}</td>
                                <td class="px-4 py-3">{{ \Carbon\Carbon::parse($item->tanggal_masuk)->format('d/m/Y') }}
                                </td>
                                <td class="px-4 py-3">{{ \Carbon\Carbon::parse($item->tanggal_keluar)->format('d/m/Y') }}
                                </td>
                                <td class="px-4 py-3">{{ $item->durasi_bulanan }} bln</td>
                                <td class="px-4 py-3 font-semibold text-indigo-600">
                                    Rp{{ number_format($item->total, 0, ',', '.') }}</td>
                                <td class="px-4 py-3">
                                    @php $pembayaran = $item->pembayaran->first(); @endphp
                                    @if ($pembayaran && $pembayaran->bukti_bayar)
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
                                        <form action="{{ route('staf.pemesanan.confirm', $item->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            <button type="submit"
                                                class="bg-green-500 hover:bg-green-600 text-white px-3 py-1.5 rounded-lg text-xs font-medium transition"
                                                onclick="return confirm('Konfirmasi pemesanan ini?')">
                                                <i class='bx bx-check'></i> Confirm
                                            </button>
                                        </form>

                                        <form action="{{ route('staf.pemesanan.cancel', $item->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            <button type="submit"
                                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1.5 rounded-lg text-xs font-medium transition"
                                                onclick="return confirm('Tolak pemesanan ini?')">
                                                <i class='bx bx-x'></i> Tolak
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center py-8 text-gray-500">
                                    <i class='bx bx-check-circle text-4xl text-green-300 mb-2'></i>
                                    <br>Tidak ada pemesanan yang perlu dikonfirmasi
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Tabel Riwayat Pemesanan -->
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                <h2 class="font-semibold text-gray-700 flex items-center gap-2">
                    <i class='bx bx-history'></i>
                    Riwayat Pemesanan
                </h2>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 text-gray-700">
                        <tr>
                            <th class="px-4 py-3 text-left">ID</th>
                            <th class="px-4 py-3 text-left">Penghuni</th>
                            <th class="px-4 py-3 text-left">Kamar</th>
                            <th class="px-4 py-3 text-left">Tipe</th>
                            <th class="px-4 py-3 text-left">Tgl Masuk</th>
                            <th class="px-4 py-3 text-left">Tgl Keluar</th>
                            <th class="px-4 py-3 text-left">Durasi</th>
                            <th class="px-4 py-3 text-left">Total</th>
                            <th class="px-4 py-3 text-left">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($confirmedPemesanan as $item)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 font-mono text-xs">#{{ $item->id }}</td>
                                <td class="px-4 py-3">{{ $item->penghuni->nama ?? '-' }}</td>
                                <td class="px-4 py-3 font-medium">{{ $item->kamar->kode_kamar ?? '-' }}</td>
                                <td class="px-4 py-3">{{ $item->kamar->tipe_kamar->tipe ?? '-' }}</td>
                                <td class="px-4 py-3">{{ \Carbon\Carbon::parse($item->tanggal_masuk)->format('d/m/Y') }}
                                </td>
                                <td class="px-4 py-3">{{ \Carbon\Carbon::parse($item->tanggal_keluar)->format('d/m/Y') }}
                                </td>
                                <td class="px-4 py-3">{{ $item->durasi_bulanan }} bln</td>
                                <td class="px-4 py-3 font-semibold text-indigo-600">
                                    Rp{{ number_format($item->total, 0, ',', '.') }}</td>
                                <td class="px-4 py-3">
                                    @php
                                        $statusClass =
                                            $item->status == 'confirmed'
                                                ? 'bg-green-100 text-green-700'
                                                : 'bg-rose-100 text-rose-700';
                                    @endphp
                                    <span class="{{ $statusClass }} px-2 py-1 rounded-full text-xs capitalize">
                                        {{ $item->status }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-8 text-gray-500">
                                    <i class='bx bx-folder-open text-4xl text-gray-300 mb-2'></i>
                                    <br>Belum ada riwayat pemesanan
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
