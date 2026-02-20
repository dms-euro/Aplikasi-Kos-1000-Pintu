@extends('layouts.app')
@section('title', 'Dashboard Admin | Bapak Kos')
@section('content')
    <div id="dashboardSection">
        <!-- ========== NAVBAR ========== -->
        <nav class="bg-white shadow-sm sticky top-0 z-50">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <!-- Logo -->
                    <div class="flex items-center gap-2">
                        <div
                            class="w-8 h-8 rounded-lg bg-gradient-to-br from-indigo-500 to-emerald-500 flex items-center justify-center shadow-sm">
                            <i class='bx bx-home-alt-2 text-white text-lg'></i>
                        </div>
                        <span class="text-xl font-semibold text-gray-800">Kos<span class="text-indigo-600">an</span></span>
                        <span
                            class="hidden md:inline-block ml-2 text-xs bg-indigo-100 text-indigo-700 px-2 py-1 rounded-full">#NyamanSepertiRumah</span>
                    </div>

                    <!-- Search Bar Desktop -->
                    <div class="hidden lg:flex items-center bg-gray-100 rounded-full px-4 py-2 w-96">
                        <i class='bx bx-search text-gray-400 mr-2'></i>
                        <input type="text" placeholder="Cari lokasi, nama kos, atau tipe kamar..."
                            class="bg-transparent border-none focus:outline-none w-full text-sm">
                    </div>

                    <!-- Desktop Menu -->
                    <div class="hidden md:flex items-center space-x-6">
                        <a href="#beranda"
                            class="text-gray-700 hover:text-indigo-600 transition text-sm font-medium">Beranda</a>
                        <a href="#kamar" class="text-gray-700 hover:text-indigo-600 transition text-sm font-medium">Cari
                            Kos</a>
                        <a href="#tips" class="text-gray-700 hover:text-indigo-600 transition text-sm font-medium">Tips
                            Ngekos</a>
                        <a href="#kontak"
                            class="text-gray-700 hover:text-indigo-600 transition text-sm font-medium">Kontak</a>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center gap-2">
                        <a href="login.html"
                            class="text-indigo-600 hover:text-indigo-700 font-medium px-4 py-2 rounded-lg hover:bg-indigo-50 transition text-sm">Masuk</a>
                        <a href="register.html"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg font-medium transition shadow-md text-sm hidden md:block">Daftar</a>

                        <!-- Mobile Menu Button -->
                        <button id="mobileMenuBtn" class="md:hidden text-gray-700 hover:text-indigo-600 p-2">
                            <i class='bx bx-menu text-2xl'></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div id="mobileMenu" class="hidden md:hidden bg-white border-t border-gray-200 py-4 px-4">
                <div class="flex flex-col space-y-3">
                    <div class="bg-gray-100 rounded-full px-4 py-2 flex items-center mb-2">
                        <i class='bx bx-search text-gray-400 mr-2'></i>
                        <input type="text" placeholder="Cari kos..."
                            class="bg-transparent border-none focus:outline-none w-full text-sm">
                    </div>
                    <a href="#beranda" class="text-gray-700 hover:text-indigo-600 py-2">Beranda</a>
                    <a href="#kamar" class="text-gray-700 hover:text-indigo-600 py-2">Cari Kos</a>
                    <a href="#tips" class="text-gray-700 hover:text-indigo-600 py-2">Tips Ngekos</a>
                    <a href="#kontak" class="text-gray-700 hover:text-indigo-600 py-2">Kontak</a>
                    <a href="register.html"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg font-medium text-center">Daftar</a>
                </div>
            </div>
        </nav>

        <!-- ========== HERO SECTION ========== -->
        <section class="hero-gradient text-white py-16 md:py-24">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid md:grid-cols-2 gap-12 items-center">
                    <div data-aos="fade-right">
                        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 leading-tight">
                            Temukan Kos <span class="text-yellow-300">Idaman</span> dengan Mudah
                        </h1>
                        <p class="text-lg md:text-xl mb-8 text-indigo-100">
                            10.000+ kamar kos tersedia di 50+ kota. Filter sesuai budget dan preferensimu, booking langsung
                            tanpa perantara!
                        </p>

                        <!-- Search Box Hero -->
                        <div class="bg-white rounded-2xl p-4 shadow-2xl">
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-3">
                                <div class="relative md:col-span-2">
                                    <i class='bx bx-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400'></i>
                                    <input type="text" id="searchHero"
                                        placeholder="Nama kos atau lokasi (Jakarta, Bandung, dll)"
                                        class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent text-gray-800">
                                </div>
                                <div class="relative">
                                    <i class='bx bx-calendar absolute left-3 top-1/2 -translate-y-1/2 text-gray-400'></i>
                                    <select id="tipeHero"
                                        class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent appearance-none text-gray-800">
                                        <option value="">Semua Tipe</option>
                                        <option value="Standar">Standar</option>
                                        <option value="Premium">Premium</option>
                                        <option value="VIP">VIP</option>
                                        <option value="Deluxe">Deluxe</option>
                                        <option value="Ekonomi">Ekonomi</option>
                                    </select>
                                </div>
                                <button onclick="searchFromHero()"
                                    class="bg-indigo-600 hover:bg-indigo-700 text-white py-3 px-6 rounded-xl font-semibold transition transform hover:scale-105">
                                    Cari
                                </button>
                            </div>
                        </div>

                        <!-- Popular Search -->
                        <div class="flex flex-wrap gap-2 mt-6">
                            <span class="text-indigo-200 text-sm">Populer:</span>
                            <a href="#"
                                class="text-xs bg-white/20 hover:bg-white/30 px-3 py-1 rounded-full transition">Jakarta
                                Pusat</a>
                            <a href="#"
                                class="text-xs bg-white/20 hover:bg-white/30 px-3 py-1 rounded-full transition">Bandung</a>
                            <a href="#"
                                class="text-xs bg-white/20 hover:bg-white/30 px-3 py-1 rounded-full transition">Surabaya</a>
                            <a href="#"
                                class="text-xs bg-white/20 hover:bg-white/30 px-3 py-1 rounded-full transition">Kos
                                Putra</a>
                            <a href="#"
                                class="text-xs bg-white/20 hover:bg-white/30 px-3 py-1 rounded-full transition">Kos
                                Putri</a>
                            <a href="#"
                                class="text-xs bg-white/20 hover:bg-white/30 px-3 py-1 rounded-full transition">Under 1
                                Juta</a>
                        </div>
                    </div>
                    <div data-aos="fade-left" class="hidden md:block">
                        <img src="https://placehold.co/600x500/4f46e5/ffffff?text=Kosan+Elegant" alt="Hero Image"
                            class="rounded-2xl shadow-2xl">
                    </div>
                </div>
            </div>
        </section>

        <!-- ========== STATS SECTION ========== -->
        <section class="py-12 bg-white">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="text-center p-4">
                        <p class="text-3xl md:text-4xl font-bold text-indigo-600">50+</p>
                        <p class="text-gray-600 text-sm">Kota Tersedia</p>
                    </div>
                    <div class="text-center p-4">
                        <p class="text-3xl md:text-4xl font-bold text-indigo-600">10rb+</p>
                        <p class="text-gray-600 text-sm">Kamar Kos</p>
                    </div>
                    <div class="text-center p-4">
                        <p class="text-3xl md:text-4xl font-bold text-indigo-600">25rb+</p>
                        <p class="text-gray-600 text-sm">Penghuni Aktif</p>
                    </div>
                    <div class="text-center p-4">
                        <p class="text-3xl md:text-4xl font-bold text-indigo-600">⭐ 4.8</p>
                        <p class="text-gray-600 text-sm">Rating Aplikasi</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- ========== FILTER CEPAT ========== -->
        <section class="py-6 bg-gray-50">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="filter-scroll flex gap-2 pb-2">
                    <button
                        class="filter-chip active px-4 py-2 bg-indigo-600 text-white rounded-full text-sm whitespace-nowrap">Semua</button>
                    <button
                        class="filter-chip px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-full text-sm whitespace-nowrap hover:bg-indigo-50">Kos
                        Putra</button>
                    <button
                        class="filter-chip px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-full text-sm whitespace-nowrap hover:bg-indigo-50">Kos
                        Putri</button>
                    <button
                        class="filter-chip px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-full text-sm whitespace-nowrap hover:bg-indigo-50">Campuran</button>
                    <button
                        class="filter-chip px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-full text-sm whitespace-nowrap hover:bg-indigo-50">Dekat
                        Kampus</button>
                    <button
                        class="filter-chip px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-full text-sm whitespace-nowrap hover:bg-indigo-50">Dekat
                        Kantor</button>
                    <button
                        class="filter-chip px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-full text-sm whitespace-nowrap hover:bg-indigo-50">AC</button>
                    <button
                        class="filter-chip px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-full text-sm whitespace-nowrap hover:bg-indigo-50">Kamar
                        Mandi Dalam</button>
                    <button
                        class="filter-chip px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-full text-sm whitespace-nowrap hover:bg-indigo-50">WiFi</button>
                    <button
                        class="filter-chip px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-full text-sm whitespace-nowrap hover:bg-indigo-50">Harga
                        < 1jt</button>
                </div>
            </div>
        </section>

        <!-- ========== REKOMENDASI KAMAR ========== -->
        <section id="kamar" class="py-12 bg-white">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-800">Rekomendasi <span
                            class="text-indigo-600">Kamar Kos</span></h2>
                    <a href="#"
                        class="text-indigo-600 hover:text-indigo-700 text-sm font-medium flex items-center gap-1">
                        Lihat Semua <i class='bx bx-right-arrow-alt'></i>
                    </a>
                </div>

                <!-- Filter Bar -->
                <div class="bg-gray-50 rounded-xl p-4 mb-8 flex flex-wrap gap-3 items-center">
                    <span class="text-sm font-medium text-gray-700">Filter:</span>
                    <select id="filterLokasi"
                        class="bg-white border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500">
                        <option value="">Semua Lokasi</option>
                        <option value="Jakarta">Jakarta</option>
                        <option value="Bandung">Bandung</option>
                        <option value="Surabaya">Surabaya</option>
                        <option value="Yogyakarta">Yogyakarta</option>
                    </select>
                    <select id="filterTipe"
                        class="bg-white border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500">
                        <option value="">Semua Tipe</option>
                        <option value="Standar">Standar</option>
                        <option value="Premium">Premium</option>
                        <option value="VIP">VIP</option>
                        <option value="Deluxe">Deluxe</option>
                        <option value="Ekonomi">Ekonomi</option>
                    </select>
                    <select id="filterHarga"
                        class="bg-white border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500">
                        <option value="">Semua Harga</option>
                        <option value="1000000">
                            < Rp 1 Juta</option>
                        <option value="1500000">
                            < Rp 1.5 Juta</option>
                        <option value="2000000">
                            < Rp 2 Juta</option>
                    </select>
                    <select id="filterStatus"
                        class="bg-white border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500">
                        <option value="">Semua Status</option>
                        <option value="tersedia">Tersedia</option>
                        <option value="terisi">Terisi</option>
                    </select>
                    <button onclick="applyFilter()"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-medium ml-auto">
                        <i class='bx bx-filter-alt mr-1'></i> Terapkan
                    </button>
                </div>

                <!-- Kamar Grid -->
                <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6" id="kamarGrid">
                    <!-- Akan diisi via JavaScript -->
                </div>

                <!-- Load More -->
                <div class="text-center mt-12">
                    <button
                        class="border border-indigo-600 text-indigo-600 hover:bg-indigo-50 px-8 py-3 rounded-xl font-medium transition inline-flex items-center gap-2">
                        Muat Lebih Banyak <i class='bx bx-loader-alt bx-spin'></i>
                    </button>
                </div>
            </div>
        </section>

        <!-- ========== TIPS NGEKOS ========== -->
        <section id="tips" class="py-12 bg-gray-50">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-8 text-center">Tips <span
                        class="text-indigo-600">Ngekos</span></h2>

                <div class="grid md:grid-cols-3 gap-6">
                    <div class="bg-white rounded-2xl shadow-sm p-5 card-hover">
                        <div class="w-12 h-12 bg-indigo-100 rounded-xl flex items-center justify-center mb-4">
                            <i class='bx bx-search-alt-2 text-2xl text-indigo-600'></i>
                        </div>
                        <h3 class="text-lg font-semibold mb-2">Cek Lokasi Strategis</h3>
                        <p class="text-gray-600 text-sm">Pastikan kos dekat dengan kampus, kantor, atau akses transportasi
                            umum agar mobilitas lebih mudah.</p>
                    </div>
                    <div class="bg-white rounded-2xl shadow-sm p-5 card-hover">
                        <div class="w-12 h-12 bg-indigo-100 rounded-xl flex items-center justify-center mb-4">
                            <i class='bx bx-wallet text-2xl text-indigo-600'></i>
                        </div>
                        <h3 class="text-lg font-semibold mb-2">Sesuaikan Budget</h3>
                        <p class="text-gray-600 text-sm">Hitung pengeluaran bulanan, pastikan harga kos tidak lebih dari
                            30% pendapatan bulananmu.</p>
                    </div>
                    <div class="bg-white rounded-2xl shadow-sm p-5 card-hover">
                        <div class="w-12 h-12 bg-indigo-100 rounded-xl flex items-center justify-center mb-4">
                            <i class='bx bx-shield-quarter text-2xl text-indigo-600'></i>
                        </div>
                        <h3 class="text-lg font-semibold mb-2">Prioritaskan Keamanan</h3>
                        <p class="text-gray-600 text-sm">Pastikan ada CCTV, security, dan sistem keamanan yang baik untuk
                            kenyamanan tinggal.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- ========== PROMO BANNER ========== -->
        <section class="py-12 bg-gradient-to-r from-indigo-600 to-purple-600 text-white">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row items-center justify-between">
                    <div class="mb-4 md:mb-0">
                        <h3 class="text-2xl md:text-3xl font-bold mb-2">Dapatkan Promo Spesial!</h3>
                        <p class="text-indigo-100">Booking sekarang dan dapatkan diskon 10% untuk bulan pertama.</p>
                    </div>
                    <button
                        class="bg-white text-indigo-600 hover:bg-gray-100 px-6 py-3 rounded-xl font-semibold transition shadow-lg">
                        <i class='bx bx-gift mr-2'></i>Klaim Promo
                    </button>
                </div>
            </div>
        </section>

        <!-- ========== TESTIMONIAL ========== -->
        <section class="py-12 bg-white">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-8 text-center">Apa Kata <span
                        class="text-indigo-600">Mereka</span></h2>

                <div class="swiper mySwiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="bg-gray-50 p-6 rounded-2xl">
                                <div class="flex items-center gap-2 mb-3">
                                    <i class='bx bxs-star text-yellow-400'></i>
                                    <i class='bx bxs-star text-yellow-400'></i>
                                    <i class='bx bxs-star text-yellow-400'></i>
                                    <i class='bx bxs-star text-yellow-400'></i>
                                    <i class='bx bxs-star text-yellow-400'></i>
                                </div>
                                <p class="text-gray-700 mb-4">"Kosnya nyaman, bersih, dan lokasi strategis. Proses booking
                                    mudah dan cepat. Recommended!"</p>
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-10 h-10 rounded-full bg-indigo-200 flex items-center justify-center font-bold">
                                        A</div>
                                    <div>
                                        <p class="font-semibold">Ahmad Fauzi</p>
                                        <p class="text-xs text-gray-500">Penghuni VIP-01</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="bg-gray-50 p-6 rounded-2xl">
                                <div class="flex items-center gap-2 mb-3">
                                    <i class='bx bxs-star text-yellow-400'></i>
                                    <i class='bx bxs-star text-yellow-400'></i>
                                    <i class='bx bxs-star text-yellow-400'></i>
                                    <i class='bx bxs-star text-yellow-400'></i>
                                    <i class='bx bxs-star-half text-yellow-400'></i>
                                </div>
                                <p class="text-gray-700 mb-4">"Harga terjangkau dengan fasilitas lengkap. AC dingin, WiFi
                                    kencang. Bakal perpanjang kontrak."</p>
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-10 h-10 rounded-full bg-emerald-200 flex items-center justify-center font-bold">
                                        S</div>
                                    <div>
                                        <p class="font-semibold">Siti Aminah</p>
                                        <p class="text-xs text-gray-500">Penghuni PRM-01</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="bg-gray-50 p-6 rounded-2xl">
                                <div class="flex items-center gap-2 mb-3">
                                    <i class='bx bxs-star text-yellow-400'></i>
                                    <i class='bx bxs-star text-yellow-400'></i>
                                    <i class='bx bxs-star text-yellow-400'></i>
                                    <i class='bx bxs-star text-yellow-400'></i>
                                    <i class='bx bxs-star text-yellow-400'></i>
                                </div>
                                <p class="text-gray-700 mb-4">"Pelayanan cepat, petugas ramah. Kalau ada masalah cepat
                                    ditangani. Worth it banget!"</p>
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-10 h-10 rounded-full bg-amber-200 flex items-center justify-center font-bold">
                                        R</div>
                                    <div>
                                        <p class="font-semibold">Rizki Pratama</p>
                                        <p class="text-xs text-gray-500">Penghuni EKO-02</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('scripts')
@endpush
