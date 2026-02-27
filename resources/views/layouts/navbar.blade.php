<nav class="bg-indigo-600/90 shadow-sm sticky top-0 z-50 hidden md:block">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex items-center gap-2">
                <div
                    class="w-8 h-8 rounded-lg bg-gradient-to-br from-indigo-500 to-emerald-500 flex items-center justify-center shadow-sm">
                    <i class='bx bx-home-alt-2 text-white text-lg'></i>
                </div>
                <span class="text-xl font-semibold text-gray-800">Kos<span class="text-indigo-900">an</span></span>
                <span
                    class="hidden lg:inline-block ml-2 text-xs bg-indigo-100 text-indigo-700 px-2 py-1 rounded-full">#NyamanSepertiRumah</span>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('dashboard.penghuni') }}"> <span class="text-white hover:text-gray-900 transition font-medium">
                        Beranda
                    </span></a>
                <a href="{{ route('penghuni.kamar.index') }}"> <span
                        class="text-white hover:text-gray-900 transition font-medium">
                        Kamar
                    </span></a>
                <a href="{{ route('penghuni.kamar.saya') }}"> <span class="text-white hover:text-gray-900 transition font-medium">
                        Kamar Saya
                    </span> </a>
                <a href="#"> <span class="text-white hover:text-gray-900 transition font-medium">
                        Chat
                    </span></a>
                <a href="#"> <span class="text-white hover:text-gray-900 transition font-medium">
                        Profil
                    </span></a>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center gap-3">
                <button class="relative p-2 text-indigo-400 hover:bg-indigo-50 rounded-full">
                    <i class='bx bx-bell text-xl'></i>
                    <span class="absolute top-0 right-0 w-2 h-2 bg-rose-500 rounded-full"></span>
                </button>
                <div
                    class="w-8 h-8 rounded-full bg-gradient-to-tr from-indigo-200 to-emerald-200 flex items-center justify-center text-indigo-700 font-medium border-2 border-white shadow-sm">
                    <span class="text-sm">AF</span>
                </div>
            </div>
        </div>
    </div>
</nav>
