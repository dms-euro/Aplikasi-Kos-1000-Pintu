   <!-- ========== NAVBAR ========== -->
    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-indigo-500 to-emerald-500 flex items-center justify-center shadow-sm">
                        <i class='bx bx-home-alt-2 text-white text-lg'></i>
                    </div>
                    <span class="text-xl font-semibold text-gray-800">Kos<span class="text-indigo-600">an</span></span>
                    <span class="hidden md:inline-block ml-2 text-xs bg-indigo-100 text-indigo-700 px-2 py-1 rounded-full">#NyamanSepertiRumah</span>
                </div>

                <!-- Search Bar Desktop -->
                <div class="hidden lg:flex items-center bg-gray-100 rounded-full px-4 py-2 w-96">
                    <i class='bx bx-search text-gray-400 mr-2'></i>
                    <input type="text" placeholder="Cari lokasi, nama kos, atau tipe kamar..." class="bg-transparent border-none focus:outline-none w-full text-sm">
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-6">
                    <a href="#beranda" class="text-gray-700 hover:text-indigo-600 transition text-sm font-medium">Beranda</a>
                    <a href="#kamar" class="text-gray-700 hover:text-indigo-600 transition text-sm font-medium">Cari Kos</a>
                    <a href="#tips" class="text-gray-700 hover:text-indigo-600 transition text-sm font-medium">Tips Ngekos</a>
                    <a href="#kontak" class="text-gray-700 hover:text-indigo-600 transition text-sm font-medium">Kontak</a>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center gap-2">
                    <a href="login.html" class="text-indigo-600 hover:text-indigo-700 font-medium px-4 py-2 rounded-lg hover:bg-indigo-50 transition text-sm">Masuk</a>
                    <a href="register.html" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg font-medium transition shadow-md text-sm hidden md:block">Daftar</a>

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
                    <input type="text" placeholder="Cari kos..." class="bg-transparent border-none focus:outline-none w-full text-sm">
                </div>
                <a href="#beranda" class="text-gray-700 hover:text-indigo-600 py-2">Beranda</a>
                <a href="#kamar" class="text-gray-700 hover:text-indigo-600 py-2">Cari Kos</a>
                <a href="#tips" class="text-gray-700 hover:text-indigo-600 py-2">Tips Ngekos</a>
                <a href="#kontak" class="text-gray-700 hover:text-indigo-600 py-2">Kontak</a>
                <a href="register.html" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg font-medium text-center">Daftar</a>
            </div>
        </div>
    </nav>
