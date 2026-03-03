<nav class="bg-indigo-500 shadow-sm sticky top-0 z-50 hidden md:block border-b border-indigo-300">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <div class="flex items-center gap-3">
                <div class="w-16 h-16 rounded-lg flex items-center justify-center">
                    <img src="{{ asset('icon/Bapak_Kos-removebg.png') }}" alt="Logo"
                        class="h-full w-auto object-contain">
                </div>
                <span class="text-xl font-semibold text-white">Bapak<span class="text-indigo-100">Kos</span></span>
            </div>

            <div class="hidden md:flex items-center space-x-1">
                <a href="{{ route('dashboard.penghuni') }}"
                    class="px-4 py-2 text-white hover:text-indigo-700 hover:bg-indigo-900 hover:text-white  rounded-full transition font-medium text-sm">
                    Beranda
                </a>
                <a href="{{ route('penghuni.kamar.index') }}"
                    class="px-4 py-2 text-white hover:text-indigo-700 hover:bg-indigo-900 hover:text-white rounded-full transition font-medium text-sm">
                    Kamar
                </a>
                <a href="{{ route('penghuni.kamar.saya') }}"
                    class="px-4 py-2 text-white hover:text-indigo-700 hover:bg-indigo-900 hover:text-white rounded-full transition font-medium text-sm">
                    Kamar Saya
                </a>
                {{-- <a href="#"
                    class="px-4 py-2 text-white hover:text-indigo-700 hover:bg-indigo-900 hover:text-white rounded-full transition font-medium text-sm">
                    Chat
                </a> --}}
                <a href="{{ route('penghuni.me') }}"
                    class="px-4 py-2 text-white hover:text-indigo-700 hover:bg-indigo-900 hover:text-white rounded-full transition font-medium text-sm">
                    Profil
                </a>
            </div>

            <div class="flex items-center gap-2">
                @guest
                    <a href="{{ route('login') }}"
                        class="px-5 py-2 bg-indigo-600 text-white rounded-full text-sm font-semibold hover:bg-indigo-900 transition shadow-sm">
                        Login
                    </a>
                    <a href="{{ route('register') }}"
                        class="px-5 py-2 bg-white text-indigo-600 rounded-full text-sm font-semibold hover:bg-indigo-50 transition shadow-sm border border-indigo-200">
                        Daftar
                    </a>
                @endguest

                @auth
                    <div class="flex items-center gap-3">
                        <div
                            class="w-10 h-10 rounded-full bg-indigo-200 flex items-center justify-center text-indigo-700 font-semibold text-sm border-2 border-white">
                            <span>{{ strtoupper(substr(Auth::user()->nama, 0, 2)) }}</span>
                        </div>
                        <span class="text-sm font-medium text-white hidden lg:inline-block">
                            {{ Auth::user()->nama }}
                        </span>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit"
                                class="group flex items-center gap-2 px-4 py-2
                                bg-indigo-400 text-white text-sm font-medium rounded-xl shadow-sm
                                    hover:bg-red-600 transition">
                                <i class='bx bx-log-out text-lg group-hover:rotate-12 transition-transform duration-200'></i>
                                <span class="sm:inline">Logout</span>
                            </button>
                        </form>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</nav>
