@extends('layouts.public')
@section('title', 'Telusuri Kamar - BapakKos')

@section('content')
    <!-- Hero Section dengan Background Gradient dan Pattern -->
    <div class="relative bg-indigo-700 text-white overflow-hidden">
        <!-- Pattern Decoration -->
        <div class="absolute inset-0 opacity-10">
            <svg class="absolute left-0 top-0 h-full w-48 text-white" fill="currentColor" viewBox="0 0 100 100"
                preserveAspectRatio="none">
                <polygon points="0,0 100,0 0,100" />
            </svg>
            <svg class="absolute right-0 bottom-0 h-64 w-64 text-white" fill="currentColor" viewBox="0 0 100 100"
                preserveAspectRatio="none">
                <circle cx="50" cy="50" r="40" />
            </svg>
        </div>

        <div class="container mx-auto px-4 py-16 md:py-20 relative z-10">
            <div class="max-w-3xl">
                <h1 class="text-4xl md:text-5xl font-bold mb-4 leading-tight">
                    Telusuri <span class="text-yellow-300">Kamar Kos</span>
                </h1>
                <p class="text-xl text-indigo-100 mb-6">Temukan kamar kos impian Anda dengan berbagai pilihan tipe dan harga
                    terjangkau</p>

                <!-- Statistik Cepat -->
                <div class="flex flex-wrap gap-6 mt-8">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-sm">
                            <i class='bx bx-bed text-2xl'></i>
                        </div>
                        <div>
                            <p class="text-2xl font-bold">{{ $totalKamar ?? $Kamar->total() }}</p>
                            <p class="text-sm text-indigo-200">Total Kamar</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-sm">
                            <i class='bx bx-check-circle text-2xl'></i>
                        </div>
                        <div>
                            <p class="text-2xl font-bold">
                                {{ $kamarTersedia ?? $Kamar->where('status', 'tersedia')->count() }}</p>
                            <p class="text-sm text-indigo-200">Tersedia</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-sm">
                            <i class='bx bx-purchase-tag-alt text-2xl'></i>
                        </div>
                        <div>
                            <p class="text-2xl font-bold">{{ $TipeKamar->count() }}</p>
                            <p class="text-sm text-indigo-200">Tipe Kamar</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Wave Decoration -->
        <div class="absolute bottom-0 left-0 right-0">
            <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M0 120L60 105C120 90 240 60 360 45C480 30 600 30 720 37.5C840 45 960 60 1080 67.5C1200 75 1320 75 1380 75L1440 75V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0Z"
                    fill="white" />
            </svg>
        </div>
    </div>

    <!-- Search Bar dengan Desain Modern -->
    <div class="sticky top-0 z-30 bg-white/80 backdrop-blur-md border-b border-indigo-100 shadow-lg">
        <div class="container mx-auto px-4 py-4">
            <form method="GET" action="{{ route('penghuni.kamar.index') }}" class="flex flex-col lg:flex-row gap-3">
                <div class="relative flex-1 group">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                        <i
                            class='bx bx-search text-gray-400 group-focus-within:text-indigo-500 text-lg transition-colors'></i>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}"
                        class="w-full pl-11 pr-4 py-3.5 border-2 border-gray-100 rounded-xl bg-gray-50 focus:bg-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all"
                        placeholder="Cari kode kamar atau tipe kamar...">
                </div>

                <div class="flex gap-2">
                    <button type="submit"
                        class="px-8 py-3.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl font-medium transition-all hover:shadow-lg flex items-center justify-center gap-2 flex-1 lg:flex-none">
                        <i class='bx bx-search-alt-2'></i>
                        <span class="lg:hidden">Cari</span>
                    </button>

                    @if (request('search') || request('tipe'))
                        <a href="{{ route('penghuni.kamar.index') }}"
                            class="px-6 py-3.5 border-2 border-gray-200 rounded-xl text-gray-600 hover:bg-gray-50 hover:border-gray-300 transition-all flex items-center justify-center gap-2">
                            <i class='bx bx-reset'></i>
                            <span class="hidden sm:inline">Reset</span>
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <!-- Filter Kategori dengan Scroll Halus -->
    <div class="container mx-auto px-4 py-8">
        <div class="flex items-center gap-4 mb-4">
            <h2 class="font-semibold text-gray-800">Filter Tipe</h2>
            <div class="h-px flex-1 bg-gradient-to-r from-indigo-200 to-transparent"></div>
        </div>

        <div class="flex gap-2 overflow-x-auto pb-2 scrollbar-hide">
            <a href="{{ route('penghuni.kamar.index') }}"
                class="px-5 py-2.5 text-sm rounded-full whitespace-nowrap transition-all font-medium
                  {{ request('tipe') ? 'bg-gray-100 text-gray-600 hover:bg-gray-200' : 'bg-indigo-600 text-white shadow-md shadow-indigo-200' }}">
                <i class='bx bx-grid-alt mr-1'></i>
                Semua Kamar
            </a>

            @foreach ($TipeKamar as $tipe)
                <a href="{{ route('penghuni.kamar.index', array_merge(request()->all(), ['tipe' => $tipe->id])) }}"
                    class="px-5 py-2.5 text-sm rounded-full whitespace-nowrap transition-all font-medium
                        {{ request('tipe') == $tipe->id ? 'bg-indigo-600 text-white shadow-md shadow-indigo-200' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                    {{ $tipe->tipe }}
                </a>
            @endforeach
        </div>
    </div>

    <div class="container mx-auto px-4 pb-16">
        @if ($Kamar->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach ($Kamar as $item)
                    <a href="{{ route('penghuni.detail.kamar', $item->id) }}"
                        class="bg-white rounded-xl shadow-sm hover:shadow-md transition overflow-hidden border border-gray-100">

                        <!-- Image -->
                        <div class="relative h-40 overflow-hidden bg-gray-100">
                            <img src="{{ asset('storage/' . $item->foto_kamar) }}" class="w-full h-full object-cover">

                            <!-- Status Badge -->
                            <div class="absolute top-2 right-2">
                                @if ($item->status == 'tersedia')
                                    <span class="bg-green-500 text-white text-xs px-2 py-1 rounded shadow-sm">
                                        Tersedia
                                    </span>
                                @else
                                    <span class="bg-amber-500 text-white text-xs px-2 py-1 rounded shadow-sm">
                                        Terisi
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="p-3">
                            <h3 class="font-semibold text-gray-800">{{ $item->tipe_kamar->tipe }}</h3>

                            <p class="text-xs text-gray-500 mt-1">
                                Kode: {{ $item->kode_kamar }}
                            </p>

                            <!-- Facilities Preview -->
                            <div class="flex items-center gap-2 mt-2 text-gray-500">
                                <i class='bx bx-wifi text-sm'></i>
                                <i class='bx bx-wind text-sm'></i>
                                <i class='bx bx-bath text-sm'></i>
                                <span class="text-xs text-gray-400 ml-1">+2</span>
                            </div>

                            <!-- Price -->
                            <div class="flex items-center justify-between mt-2 pt-2 border-t border-gray-100">
                                <span class="text-sm font-bold text-indigo-600">
                                    Rp{{ number_format($item->tipe_kamar->harga, 0, ',', '.') }}
                                </span>
                                <span class="text-indigo-600 text-sm">Detail →</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-10">
                {{ $Kamar->appends(request()->query())->links() }}
            </div>
        @else
            <!-- Empty State Sederhana -->
            <div class="text-center py-16">
                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class='bx bx-bed text-3xl text-gray-400'></i>
                </div>
                <h3 class="text-lg font-medium text-gray-800 mb-2">Tidak Ada Kamar</h3>
                <p class="text-gray-500 mb-6">Belum ada kamar yang tersedia saat ini.</p>
                <a href="{{ route('penghuni.kamar.index') }}"
                    class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg font-medium transition">
                    <i class='bx bx-refresh'></i>
                    Refresh
                </a>
            </div>
        @endif
    </div>
@endsection
