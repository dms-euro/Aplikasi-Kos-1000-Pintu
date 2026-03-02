@extends('layouts.public')
@section('title', 'Beranda - Kosan优雅')

@section('content')
    <!-- Hero Section -->
    <section class="bg-purple-500 text-white py-12 md:py-20 px-4 md:px-0">
        <div class="container mx-auto">
            <div class="grid md:grid-cols-2 gap-8 items-center">
                <div>
                    @auth
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit">
                                Logout
                            </button>
                        </form>
                    @endauth
                    <h1 class="text-3xl md:text-5xl lg:text-6xl font-bold mb-4 leading-tight">
                        Temukan Kos <span class="text-yellow-300">Idaman</span> dengan Mudah
                    </h1>
                    <p class="text-base md:text-lg mb-6 text-indigo-100">
                        10.000+ kamar kos tersedia di 50+ kota. Filter sesuai budget dan preferensimu, booking langsung
                        tanpa perantara!
                    </p>

                    <!-- Search Box -->
                    <div class="bg-white rounded-2xl p-3 shadow-2xl">
                        <div class="flex flex-col md:flex-row gap-3">
                            <div class="relative flex-1">
                                <i class='bx bx-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400'></i>
                                <input type="text" placeholder="Nama kos atau lokasi..."
                                    class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent text-gray-800 text-sm">
                            </div>
                            <div class="relative md:w-48">
                                <i class='bx bx-home absolute left-3 top-1/2 -translate-y-1/2 text-gray-400'></i>
                                <select
                                    class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent appearance-none text-gray-800 text-sm">
                                    <option>Semua Tipe</option>
                                    <option>Standar</option>
                                    <option>Premium</option>
                                    <option>VIP</option>
                                    <option>Deluxe</option>
                                </select>
                            </div>
                            <button
                                class="bg-indigo-600 hover:bg-indigo-700 text-white py-3 px-6 rounded-xl font-semibold transition w-full md:w-auto">
                                Cari
                            </button>
                        </div>
                    </div>

                    <!-- Stats -->
                    <div class="flex gap-6 mt-6">
                        <div>
                            <p class="text-xl md:text-2xl font-bold">500+</p>
                            <p class="text-indigo-200 text-xs">Kamar Tersedia</p>
                        </div>
                        <div>
                            <p class="text-xl md:text-2xl font-bold">300+</p>
                            <p class="text-indigo-200 text-xs">Penghuni Aktif</p>
                        </div>
                        <div>
                            <p class="text-xl md:text-2xl font-bold">50+</p>
                            <p class="text-indigo-200 text-xs">Lokasi Strategis</p>
                        </div>
                    </div>
                </div>
                <div class="hidden md:block">
                    <img src="{{ asset('icon/Bapak_Kos-removebg.png') }}" alt="Hero Image"
                        class="rounded-2xl shadow-2xl">
                </div>
            </div>
        </div>
    </section>

    <!-- Kategori Cepat -->
    <section class="py-8 px-4">
        <div class="container mx-auto">
            <h2 class="text-xl md:text-2xl font-bold text-gray-800 mb-4">Kategori Populer</h2>
            <div class="flex gap-3 overflow-x-auto pb-2">
                <span class="bg-indigo-600 text-white px-5 py-2.5 rounded-full text-sm whitespace-nowrap">Semua</span>
                <span
                    class="bg-white border border-gray-300 text-gray-700 px-5 py-2.5 rounded-full text-sm whitespace-nowrap">Kos
                    Putra</span>
                <span
                    class="bg-white border border-gray-300 text-gray-700 px-5 py-2.5 rounded-full text-sm whitespace-nowrap">Kos
                    Putri</span>
                <span
                    class="bg-white border border-gray-300 text-gray-700 px-5 py-2.5 rounded-full text-sm whitespace-nowrap">Campuran</span>
                <span
                    class="bg-white border border-gray-300 text-gray-700 px-5 py-2.5 rounded-full text-sm whitespace-nowrap">Dekat
                    Kampus</span>
                <span
                    class="bg-white border border-gray-300 text-gray-700 px-5 py-2.5 rounded-full text-sm whitespace-nowrap">AC</span>
                <span
                    class="bg-white border border-gray-300 text-gray-700 px-5 py-2.5 rounded-full text-sm whitespace-nowrap">WiFi</span>
            </div>
        </div>
    </section>

    <!-- Rekomendasi Kamar -->
    <section class="py-4 px-4">
        <div class="container mx-auto">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl md:text-2xl font-bold text-gray-800">Rekomendasi</h2>
                <a href="/kamar" class="text-indigo-600 text-sm font-medium">Lihat semua</a>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4 gap-4">
                @forelse ($kamar as $item)
                    <a href="{{ route('penghuni.detail.kamar', $item->id) }}"
                        class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden transition-all duration-300 hover:-translate-y-2 hover:shadow-xl">

                        <img src="{{ asset('storage/' . $item->foto_kamar) }}" class="w-full h-40 object-cover">

                        <div class="p-4">
                            <h3 class="font-semibold text-gray-800">
                                {{ $item->tipe_kamar->tipe }}
                            </h3>

                            <p class="text-xs text-gray-500 mt-1">
                                Kode: {{ $item->kode_kamar }}
                            </p>

                            <div class="flex justify-between items-center mt-3">
                                <span class="text-indigo-600 font-bold">
                                    Rp{{ number_format($item->tipe_kamar->harga) }}
                                </span>

                                @if ($item->status == 'tersedia')
                                    <span class="bg-green-100 text-green-700 text-xs px-2 py-1 rounded-full">
                                        Tersedia
                                    </span>
                                @else
                                    <span class="bg-amber-100 text-amber-700 text-xs px-2 py-1 rounded-full">
                                        Terisi
                                    </span>
                                @endif
                            </div>
                        </div>
                    </a>
                @empty
                    <p class="col-span-4 text-center text-gray-500">
                        Belum ada kamar tersedia
                    </p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Tips Section -->
    <section class="py-8 px-4 bg-gray-50 mt-4">
        <div class="container mx-auto">
            <h2 class="text-xl md:text-2xl font-bold text-gray-800 mb-4">Tips Ngekos</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white p-5 rounded-2xl shadow-sm flex items-start gap-3">
                    <div class="w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center flex-shrink-0"><i
                            class='bx bx-map text-indigo-600 text-xl'></i></div>
                    <div>
                        <h3 class="font-medium">Lokasi Strategis</h3>
                        <p class="text-sm text-gray-600 mt-1">Dekat kampus, kantor, dan transportasi umum</p>
                    </div>
                </div>
                <div class="bg-white p-5 rounded-2xl shadow-sm flex items-start gap-3">
                    <div class="w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center flex-shrink-0"><i
                            class='bx bx-wallet text-indigo-600 text-xl'></i></div>
                    <div>
                        <h3 class="font-medium">Sesuaikan Budget</h3>
                        <p class="text-sm text-gray-600 mt-1">Pilih kos sesuai kemampuan finansial</p>
                    </div>
                </div>
                <div class="bg-white p-5 rounded-2xl shadow-sm flex items-start gap-3">
                    <div class="w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center flex-shrink-0"><i
                            class='bx bx-shield-quarter text-indigo-600 text-xl'></i></div>
                    <div>
                        <h3 class="font-medium">Prioritas Keamanan</h3>
                        <p class="text-sm text-gray-600 mt-1">CCTV dan security 24 jam</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
