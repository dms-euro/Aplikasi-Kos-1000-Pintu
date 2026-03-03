@extends('layouts.public')
@section('title', 'Beranda - BapakKos')

@section('content')
    <!-- Hero Section - Clean & Professional -->
    <section class="bg-indigo-600 text-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-16">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <!-- Left Content -->
                <div class="space-y-6">
                    <!-- Badge -->
                    <div class="inline-flex items-center bg-indigo-500 rounded-full px-4 py-1.5 text-sm">
                        <i class='bx bx-home-smile mr-2'></i>
                        <span>100+ Kamar Tersedia</span>
                    </div>

                    <!-- Main Heading -->
                    <h1 class="text-4xl md:text-5xl font-bold leading-tight">
                        Temukan Kamar
                        <span class="text-yellow-300">Ternyamanmu</span>
                        <br>dengan Mudah
                    </h1>

                    <p class="text-lg text-indigo-100 max-w-xl">
                        100+ kamar kos tersedia. Filter sesuai budget dan preferensimu, booking langsung!
                    </p>

                    <!-- Stats -->
                    <div class="flex gap-8 pt-2">
                        <div>
                            <p class="text-2xl font-bold">100+</p>
                            <p class="text-indigo-200 text-sm">Kamar</p>
                        </div>
                        <div>
                            <p class="text-2xl font-bold">70+</p>
                            <p class="text-indigo-200 text-sm">Penghuni</p>
                        </div>
                    </div>
                </div>

                <!-- Right Content -->
                <div class="hidden lg:block">
                    <div class="bg-indigo-500 rounded-2xl p-6">
                        <img src="{{ asset('icon/Bapak_Kos-removebg.png') }}" alt="Hero Image"
                            class="w-full max-w-md mx-auto">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Quick Categories -->
    <section class="py-8 bg-white border-b border-gray-100">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold text-gray-800">Kategori Populer</h2>
                <a href="{{ route('penghuni.kamar.index') }}" class="text-indigo-600 text-sm hover:text-indigo-700">Lihat
                    semua →</a>
            </div>
            <div class="flex flex-wrap gap-2">

                <!-- Semua -->
                <a href="{{ route('dashboard.penghuni') }}"
                    class="px-5 py-2 rounded-full text-sm transition
                    {{ request('kategori') == null
                        ? 'bg-indigo-600 text-white shadow-md'
                        : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    Semua
                </a>

                @foreach ($kategori as $item)
                    <a href="{{ route('dashboard.penghuni', ['kategori' => $item->tipe]) }}"
                        class="px-5 py-2 rounded-full text-sm transition
                        {{ request('kategori') == $item->tipe
                            ? 'bg-indigo-600 text-white shadow-md'
                            : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        {{ $item->tipe }}
                    </a>
                @endforeach

            </div>
        </div>
    </section>

    <!-- Recommended Rooms -->
    <section class="py-10 bg-gray-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h2 class="text-xl font-bold text-gray-800">Rekomendasi Kamar</h2>
                    <p class="text-sm text-gray-500 mt-1">Pilihan terbaik untuk hunian nyaman</p>
                </div>
                <a href="{{ route('penghuni.kamar.index') }}" class="text-indigo-600 text-sm font-medium hover:text-indigo-700">Lihat semua</a>
            </div>

            <!-- Room Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                @forelse ($kamar as $item)
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
                @empty
                    <div class="col-span-4 text-center py-8">
                        <p class="text-gray-500">Belum ada kamar tersedia</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Tips Section -->
    <section class="py-10 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-6">
                <h2 class="text-xl font-bold text-gray-800">Tips Memilih Kos</h2>
                <p class="text-sm text-gray-500 mt-1">Panduan untuk mendapatkan kos impian</p>
            </div>

            <div class="grid md:grid-cols-3 gap-5">
                <div class="bg-indigo-50 rounded-xl p-5">
                    <div class="w-10 h-10 bg-indigo-600 rounded-lg flex items-center justify-center mb-3">
                        <i class='bx bx-map text-white text-lg'></i>
                    </div>
                    <h3 class="font-semibold text-gray-800 mb-1">Lokasi Strategis</h3>
                    <p class="text-sm text-gray-600">Dekat kampus, kantor, dan transportasi umum</p>
                </div>

                <div class="bg-indigo-50 rounded-xl p-5">
                    <div class="w-10 h-10 bg-indigo-600 rounded-lg flex items-center justify-center mb-3">
                        <i class='bx bx-wallet text-white text-lg'></i>
                    </div>
                    <h3 class="font-semibold text-gray-800 mb-1">Sesuaikan Budget</h3>
                    <p class="text-sm text-gray-600">Pilih kos sesuai kemampuan finansial</p>
                </div>

                <div class="bg-indigo-50 rounded-xl p-5">
                    <div class="w-10 h-10 bg-indigo-600 rounded-lg flex items-center justify-center mb-3">
                        <i class='bx bx-shield-quarter text-white text-lg'></i>
                    </div>
                    <h3 class="font-semibold text-gray-800 mb-1">Keamanan Terjamin</h3>
                    <p class="text-sm text-gray-600">CCTV dan security 24 jam</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="bg-indigo-600 py-10">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-xl font-bold text-white mb-2">Siap Cari Kos Idaman?</h2>
            <p class="text-indigo-100 text-sm mb-4 max-w-md mx-auto">Daftar sekarang dan temukan kos terbaik untukmu</p>
            <div class="flex gap-3 justify-center">
                <a href="{{ route('register') }}"
                    class="bg-white text-indigo-600 px-6 py-2 rounded-lg font-semibold hover:bg-indigo-50 transition text-sm">
                    Daftar
                </a>
                <a href="{{ route('penghuni.kamar.index') }}"
                    class="bg-indigo-500 text-white px-6 py-2 rounded-lg font-semibold hover:bg-indigo-400 transition text-sm border border-indigo-400">
                    Lihat Kos
                </a>
            </div>
        </div>
    </section>
@endsection
