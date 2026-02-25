@extends('layouts.app')
@section('title', 'Riwayat Konfirmasi - Petugas')

@section('content')
    <div class="p-6">
        <!-- Header -->
        <div class="flex items-center gap-4 mb-6">
            <a href="{{ route('pemesanan.confirm', $pemesanan->id) }}
                class="w-10 h-10 bg-white border
                border-indigo-200 rounded-full flex items-center justify-center hover:bg-indigo-50 transition">
                <i class='bx bx-arrow-back text-indigo-600'></i>
            </a>
            <h1 class="text-2xl font-bold text-gray-800">Riwayat Konfirmasi</h1>
        </div>

        <!-- Statistik Riwayat -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-6">
            <div class="bg-white rounded-2xl border border-indigo-100 p-5 flex items-center justify-between">
                <div>
                    <p class="text-sm text-indigo-500 font-medium">Total Diproses</p>
                    <p class="text-2xl font-bold text-gray-800">10</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600">
                    <i class='bx bx-history text-2xl'></i>
                </div>
            </div>
            <div class="bg-white rounded-2xl border border-green-100 p-5 flex items-center justify-between">
                <div>
                    <p class="text-sm text-green-500 font-medium">Dikonfirmasi</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $pemesanan->where('status', 'confirmed')->count() }}</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center text-green-600">
                    <i class='bx bx-check-circle text-2xl'></i>
                </div>
            </div>
            <div class="bg-white rounded-2xl border border-rose-100 p-5 flex items-center justify-between">
                <div>
                    <p class="text-sm text-rose-500 font-medium">Dibatalkan</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $pemesanan->where('status', 'cancelled')->count() }}</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-rose-100 flex items-center justify-center text-rose-600">
                    <i class='bx bx-x-circle text-2xl'></i>
                </div>
            </div>
        </div>

        <!-- Tabel Riwayat -->
        <div class="bg-white rounded-2xl border border-indigo-100 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-indigo-50/70 text-indigo-800">
                        <tr>
                            <th class="px-4 py-3 text-left">ID</th>
                            <th class="px-4 py-3 text-left">Penghuni</th>
                            <th class="px-4 py-3 text-left">Kamar</th>
                            <th class="px-4 py-3 text-left">Tanggal</th>
                            <th class="px-4 py-3 text-left">Total</th>
                            <th class="px-4 py-3 text-left">Status</th>
                            <th class="px-4 py-3 text-left">Diverifikasi</th>
                            <th class="px-4 py-3 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-indigo-100">
                        <tr class="hover:bg-indigo-50/40 transition">
                            <td class="px-4 py-3 font-mono text-xs">#{{ $pemesanan->id }}</td>

                            <td class="px-4 py-3">
                                <div class="flex items-center gap-2">
                                    <div
                                        class="w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-700 text-xs font-bold">
                                        {{ substr($pemesanan->penghuni->nama ?? '?', 0, 1) }}
                                    </div>
                                    <span>{{ $pemesanan->penghuni->nama ?? 'Unknown' }}</span>
                                </div>
                            </td>

                            <td class="px-4 py-3">
                                {{ $pemesanan->kamar->kode_kamar ?? 'Unknown' }}
                            </td>

                            <td class="px-4 py-3">
                                {{ \Carbon\Carbon::parse($pemesanan->tanggal_masuk)->format('d/m/Y') }}
                            </td>

                            <td class="px-4 py-3 font-semibold">
                                Rp {{ number_format($pemesanan->total, 0, ',', '.') }}
                            </td>

                            <td class="px-4 py-3">
                                @php
                                    $statusClass =
                                        [
                                            'confirmed' => 'bg-green-100 text-green-700',
                                            'cancelled' => 'bg-rose-100 text-rose-700',
                                        ][$pemesanan->status] ?? 'bg-gray-100 text-gray-700';
                                @endphp

                                <span class="{{ $statusClass }} px-2 py-1 rounded-full text-xs capitalize">
                                    {{ $pemesanan->status }}
                                </span>
                            </td>

                            <td class="px-4 py-3">
                                @php
                                    $pembayaran = $pemesanan->pembayaran->first();
                                @endphp

                                @if ($pembayaran && $pembayaran->petugas)
                                    {{ $pembayaran->petugas->name }}
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>

                            {{-- <td class="px-4 py-3">
                                <a href="{{ route('petugas.konfirmasi.show', $pemesanan->id) }}"
                                    class="text-indigo-600 hover:text-indigo-800 bg-indigo-50 hover:bg-indigo-100 p-2 rounded-lg transition">
                                    <i class='bx bx-show text-lg'></i>
                                </a>
                            </td> --}}
                        </tr>
                    </tbody>
                </table>
            </div>
{{--
            <!-- Pagination -->
            <div class="px-6 py-3 border-t border-indigo-100">
                {{ $pemesanan->links() }}
            </div> --}}
        </div>
    </div>
@endsection
