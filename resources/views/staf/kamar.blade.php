@extends('layouts.app')
@section('title', 'Data Kamar - Staf')

@section('content')
<div class="p-6">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Data Kamar</h1>
    </div>

    <!-- Statistik Cards -->
    <div class="grid grid-cols-5 md:grid-cols-5 gap-4 mb-8">
        <div class="bg-white rounded-xl border border-gray-200 p-4 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-gray-500">Total</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $totalKamar }}</p>
                </div>
                <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-600">
                    <i class='bx bx-building-house text-xl'></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-green-200 p-4 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-green-600">Tersedia</p>
                    <p class="text-2xl font-bold text-green-600">{{ $tersedia }}</p>
                </div>
                <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center text-green-600">
                    <i class='bx bx-check-circle text-xl'></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-amber-200 p-4 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-amber-600">Dipesan</p>
                    <p class="text-2xl font-bold text-amber-600">{{ $dipesan }}</p>
                </div>
                <div class="w-10 h-10 rounded-full bg-amber-100 flex items-center justify-center text-amber-600">
                    <i class='bx bx-time-five text-xl'></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-blue-200 p-4 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-blue-600">Terisi</p>
                    <p class="text-2xl font-bold text-blue-600">{{ $terisi }}</p>
                </div>
                <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">
                    <i class='bx bx-user-check text-xl'></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-rose-200 p-4 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-rose-600">Perbaikan</p>
                    <p class="text-2xl font-bold text-rose-600">{{ $perbaikan }}</p>
                </div>
                <div class="w-10 h-10 rounded-full bg-rose-100 flex items-center justify-center text-rose-600">
                    <i class='bx bx-wrench text-xl'></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter -->
    <div class="bg-white rounded-xl border border-gray-200 p-4 mb-6">
        <div class="flex flex-wrap items-center gap-4">
            <div class="flex items-center gap-2">
                <span class="text-sm font-medium text-gray-700">Filter Tipe:</span>
                <select name="tipe" id="filterTipe" class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500">
                    <option value="">Semua Tipe</option>
                    @foreach($tipe_kamar as $tipe)
                        <option value="{{ $tipe->id }}" {{ request('tipe') == $tipe->id ? 'selected' : '' }}>
                            {{ $tipe->tipe }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex items-center gap-2">
                <span class="text-sm font-medium text-gray-700">Filter Status:</span>
                <select name="status" id="filterStatus" class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500">
                    <option value="">Semua Status</option>
                    <option value="tersedia" {{ request('status') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                    <option value="dipesan" {{ request('status') == 'dipesan' ? 'selected' : '' }}>Dipesan</option>
                    <option value="terisi" {{ request('status') == 'terisi' ? 'selected' : '' }}>Terisi</option>
                    <option value="perbaikan" {{ request('status') == 'perbaikan' ? 'selected' : '' }}>Perbaikan</option>
                </select>
            </div>

            <button onclick="applyFilter()" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm transition">
                Terapkan Filter
            </button>

            <a href="{{ route('staf.kamar.index') }}" class="text-gray-600 hover:text-gray-800 text-sm flex items-center gap-1">
                <i class='bx bx-reset'></i> Reset
            </a>
        </div>
    </div>

    <!-- Grid Kamar -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @forelse($kamar as $item)
        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm hover:shadow-md transition">
            <!-- Gambar Kamar -->
            <div class="relative h-40 bg-gray-100">
                @if($item->foto_kamar)
                    <img src="{{ asset('storage/' . $item->foto_kamar) }}"
                         alt="{{ $item->kode_kamar }}"
                         class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center text-gray-400">
                        <i class='bx bx-bed text-5xl'></i>
                    </div>
                @endif

                <!-- Status Badge -->
                <div class="absolute top-3 right-3">
                    @if($item->status == 'tersedia')
                        <span class="bg-green-500 text-white px-3 py-1 rounded-full text-xs font-medium shadow-sm">
                            Tersedia
                        </span>
                    @elseif($item->status == 'dipesan')
                        <span class="bg-amber-500 text-white px-3 py-1 rounded-full text-xs font-medium shadow-sm">
                            Dipesan
                        </span>
                    @elseif($item->status == 'terisi')
                        <span class="bg-blue-500 text-white px-3 py-1 rounded-full text-xs font-medium shadow-sm">
                            Terisi
                        </span>
                    @else
                        <span class="bg-rose-500 text-white px-3 py-1 rounded-full text-xs font-medium shadow-sm">
                            Perbaikan
                        </span>
                    @endif
                </div>
            </div>

            <!-- Konten Kamar -->
            <div class="p-4">
                <div class="flex justify-between items-start mb-2">
                    <h3 class="font-bold text-gray-800 text-lg">{{ $item->kode_kamar }}</h3>
                    <span class="bg-indigo-100 text-indigo-700 px-2 py-1 rounded-full text-xs">
                        {{ $item->tipe_kamar->tipe }}
                    </span>
                </div>

                <div class="space-y-2 text-sm">
                    <div class="flex items-center gap-2 text-gray-600">
                        <i class='bx bx-money text-indigo-400'></i>
                        <span>Rp{{ number_format($item->tipe_kamar->harga, 0, ',', '.') }}/bulan</span>
                    </div>

                    @if($item->status == 'terisi' || $item->status == 'dipesan')
                        @php
                            $pemesanan = $item->pemesanan()
                                ->whereIn('status', ['pending', 'confirmed'])
                                ->latest()
                                ->first();
                        @endphp
                        @if($pemesanan && $pemesanan->penghuni)
                            <div class="flex items-center gap-2 text-gray-600 border-t pt-2 mt-2">
                                <i class='bx bx-user-circle text-indigo-400'></i>
                                <span class="truncate">{{ $pemesanan->penghuni->nama }}</span>
                            </div>
                            <div class="flex items-center gap-2 text-xs text-gray-500">
                                <i class='bx bx-calendar'></i>
                                <span>Masuk: {{ \Carbon\Carbon::parse($pemesanan->tanggal_masuk)->format('d/m/Y') }}</span>
                            </div>
                        @endif
                    @endif
                </div>

                <!-- Informasi Tambahan -->
                <div class="mt-3 pt-3 border-t border-gray-100 text-xs text-gray-500">
                    <div class="flex justify-between">
                        <span>Luas: 4x5 m²</span>
                        <span>Lantai 2</span>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-12">
            <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class='bx bx-bed text-4xl text-gray-400'></i>
            </div>
            <h3 class="text-lg font-medium text-gray-700 mb-2">Tidak Ada Kamar</h3>
            <p class="text-gray-500">Tidak ada kamar yang sesuai dengan filter yang dipilih.</p>
        </div>
        @endforelse
    </div>
</div>

<script>
    function applyFilter() {
        let tipe = document.getElementById('filterTipe').value;
        let status = document.getElementById('filterStatus').value;
        let search = new URLSearchParams(window.location.search).get('search') || '';

        let url = "{{ route('staf.kamar.index') }}?";
        if (tipe) url += 'tipe=' + tipe + '&';
        if (status) url += 'status=' + status + '&';
        if (search) url += 'search=' + search;

        window.location.href = url;
    }

    // Auto submit filter saat memilih (opsional)
    document.getElementById('filterTipe').addEventListener('change', applyFilter);
    document.getElementById('filterStatus').addEventListener('change', applyFilter);
</script>
@endsection
