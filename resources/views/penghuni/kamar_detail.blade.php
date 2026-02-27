@extends('layouts.public')
@section('title', 'Detail Kamar - ' . $kamar->kode_kamar . ' | Kosan优雅')

@section('content')
    <div class="relative bg-gray-900">
        <!-- Main Image -->
        <div class="relative h-[50vh] md:h-[60vh] lg:h-[70vh] overflow-hidden">
            <img src="{{ asset('storage/' . $kamar->foto_kamar) }}" alt="{{ $kamar->kode_kamar }}"
                class="w-full h-full object-cover">

            <!-- Overlay Gradient -->
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>

            <!-- Back Button -->
            <a href="{{ url()->previous() }}"
                class="absolute top-6 left-6 w-12 h-12 bg-white/90 backdrop-blur-sm rounded-full flex items-center justify-center shadow-lg hover:bg-white transition-all duration-300 group">
                <i class='bx bx-arrow-back text-2xl text-gray-700 group-hover:text-indigo-600'></i>
            </a>

            <!-- Favorite Button -->
            <button
                class="absolute top-6 right-6 w-12 h-12 bg-white/90 backdrop-blur-sm rounded-full flex items-center justify-center shadow-lg hover:bg-white transition-all duration-300 group">
                <i class='bx bx-heart text-2xl text-gray-700 group-hover:text-rose-500'></i>
            </button>

            <!-- Status Badge -->
            <div class="absolute bottom-6 left-6">
                @if ($kamar->status == 'tersedia')
                    <span
                        class="inline-flex items-center gap-2 bg-green-500 text-white px-4 py-2 rounded-full text-sm font-medium shadow-lg">
                        <span class="w-2 h-2 bg-white rounded-full"></span>
                        Tersedia
                    </span>
                @elseif($kamar->status == 'dipesan')
                    <span
                        class="inline-flex items-center gap-2 bg-amber-500 text-white px-4 py-2 rounded-full text-sm font-medium shadow-lg">
                        <span class="w-2 h-2 bg-white rounded-full"></span>
                        Sedang Dipesan
                    </span>
                @elseif($kamar->status == 'terisi')
                    <span
                        class="inline-flex items-center gap-2 bg-blue-500 text-white px-4 py-2 rounded-full text-sm font-medium shadow-lg">
                        <span class="w-2 h-2 bg-white rounded-full"></span>
                        Sudah Terisi
                    </span>
                @else
                    <span
                        class="inline-flex items-center gap-2 bg-rose-500 text-white px-4 py-2 rounded-full text-sm font-medium shadow-lg">
                        <span class="w-2 h-2 bg-white rounded-full"></span>
                        Dalam Perbaikan
                    </span>
                @endif
            </div>
        </div>
    </div>

    <!-- Content Section -->
    <div class="container mx-auto px-4 py-8 md:py-12 max-w-6xl">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content (Left Column) -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Header Info -->
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div>
                            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-2">
                                {{ $kamar->kode_kamar }}
                            </h1>
                            <div class="flex items-center gap-3 text-gray-500">
                                <span class="flex items-center gap-1">
                                    <i class='bx bx-building-house text-indigo-400'></i>
                                    {{ $kamar->tipe_kamar->tipe }}
                                </span>
                                <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                                <span class="flex items-center gap-1">
                                    <i class='bx bx-map text-indigo-400'></i>
                                    {{ $kamar->lokasi ?? 'Jakarta' }}
                                </span>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-sm text-gray-500 mb-1">Harga per bulan</p>
                            <p class="text-3xl md:text-4xl font-bold text-indigo-600">
                                Rp{{ number_format($kamar->tipe_kamar->harga, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Deskripsi -->
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                        <i class='bx bx-detail text-indigo-600'></i>
                        Deskripsi Kamar
                    </h2>
                    <div class="prose prose-sm max-w-none text-gray-600 leading-relaxed">
                        {{ $kamar->tipe_kamar->deskripsi ?? 'Tidak ada deskripsi untuk kamar ini.' }}
                    </div>
                </div>

                <!-- Fasilitas -->
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                        <i class='bx bx-wifi text-indigo-600'></i>
                        Fasilitas Kamar
                    </h2>

                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                        <!-- Kasur -->
                        <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl">
                            <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center">
                                <i class='bx bx-bed text-xl text-indigo-600'></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">Kasur</p>
                                <p class="text-xs text-gray-500">Queen Size</p>
                            </div>
                        </div>

                        <!-- Lemari -->
                        <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl">
                            <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center">
                                <i class='bx bx-closet text-xl text-indigo-600'></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">Lemari</p>
                                <p class="text-xs text-gray-500">3 Pintu</p>
                            </div>
                        </div>

                        <!-- AC -->
                        <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl">
                            <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center">
                                <i class='bx bx-wind text-xl text-indigo-600'></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">AC</p>
                                <p class="text-xs text-gray-500">1/2 PK</p>
                            </div>
                        </div>

                        <!-- WiFi -->
                        <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl">
                            <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center">
                                <i class='bx bx-wifi text-xl text-indigo-600'></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">WiFi</p>
                                <p class="text-xs text-gray-500">30 Mbps</p>
                            </div>
                        </div>

                        <!-- Kamar Mandi -->
                        <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl">
                            <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center">
                                <i class='bx bx-bath text-xl text-indigo-600'></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">Kamar Mandi</p>
                                <p class="text-xs text-gray-500">Dalam</p>
                            </div>
                        </div>

                        <!-- TV -->
                        <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl">
                            <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center">
                                <i class='bx bx-tv text-xl text-indigo-600'></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">TV</p>
                                <p class="text-xs text-gray-500">32 Inch</p>
                            </div>
                        </div>

                        <!-- Meja -->
                        <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl">
                            <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center">
                                <i class='bx bx-desk text-xl text-indigo-600'></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">Meja</p>
                                <p class="text-xs text-gray-500">Belajar</p>
                            </div>
                        </div>

                        <!-- Parkir -->
                        <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl">
                            <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center">
                                <i class='bx bx-car text-xl text-indigo-600'></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">Parkir</p>
                                <p class="text-xs text-gray-500">Motor</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar (Right Column) -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Card Info Pemilik -->
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 sticky top-24">
                    <h3 class="font-semibold text-gray-800 mb-4 flex items-center gap-2">
                        <i class='bx bx-user-circle text-indigo-600'></i>
                        Informasi Pemilik
                    </h3>

                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-12 h-12 bg-indigo-100 rounded-full flex items-center justify-center">
                            <span class="text-indigo-600 font-bold text-lg">BK</span>
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">Bapak Kos</p>
                            <p class="text-xs text-gray-500">Pemilik Kos</p>
                        </div>
                    </div>

                    <div class="space-y-2 text-sm border-t border-gray-100 pt-4">
                        <div class="flex items-center gap-2">
                            <i class='bx bx-phone text-indigo-400'></i>
                            <span>0812-3456-7890</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class='bx bx-envelope text-indigo-400'></i>
                            <span>bapak.kos@email.com</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class='bx bx-map text-indigo-400'></i>
                            <span>Jakarta Selatan</span>
                        </div>
                    </div>
                </div>

                <!-- Card Info Tambahan -->
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                    <h3 class="font-semibold text-gray-800 mb-4 flex items-center gap-2">
                        <i class='bx bx-info-circle text-indigo-600'></i>
                        Informasi Tambahan
                    </h3>

                    <div class="space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Luas Kamar</span>
                            <span class="font-medium text-gray-800">4 x 5 m²</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Lantai</span>
                            <span class="font-medium text-gray-800">2</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Listrik</span>
                            <span class="font-medium text-gray-800">1300 Watt</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Air</span>
                            <span class="font-medium text-gray-800">PDAM</span>
                        </div>
                    </div>
                </div>

                <!-- Tombol Sewa -->
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                    @if ($kamar->status == 'tersedia')
                        @auth
                            @if (auth()->user()->role == 'penghuni')
                                <a href="{{ route('pemesanan.create', $kamar->id) }}"
                                    class="block w-full bg-indigo-600 hover:bg-indigo-700 text-white py-4 rounded-xl font-semibold shadow-lg transition-all duration-300 text-center text-lg hover:shadow-xl hover:-translate-y-0.5">
                                    <i class='bx bx-calendar-check mr-2'></i>
                                    Sewa Sekarang
                                </a>
                            @endif
                        @else
                            <a href="{{ route('login') }}"
                                class="block w-full bg-indigo-600 hover:bg-indigo-700 text-white py-4 rounded-xl font-semibold shadow-lg transition-all duration-300 text-center text-lg hover:shadow-xl hover:-translate-y-0.5">
                                <i class='bx bx-log-in mr-2'></i>
                                Login untuk Sewa
                            </a>
                        @endauth
                    @else
                        <button disabled
                            class="block w-full bg-gray-400 text-white py-4 rounded-xl font-semibold text-lg text-center cursor-not-allowed">
                            <i class='bx bx-x-circle mr-2'></i>
                            Kamar Tidak Tersedia
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
