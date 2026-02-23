<aside class="w-64 bg-white shadow-lg flex flex-col justify-between border-r border-indigo-100">
    <div class="py-6 px-4">
        <div class="flex items-center gap-2 mb-8 px-2">
            <div
                class="w-8 h-8 rounded-lg bg-gradient-to-br from-indigo-500 to-emerald-500 flex items-center justify-center shadow-sm">
                <i class='bx bx-home-alt-2 text-white text-lg'></i>
            </div>
            <span class="text-xl font-semibold text-gray-800">
                Bapak<span class="text-indigo-600">Kos</span>
            </span>
            <span class="text-xs bg-amber-100 text-amber-700 px-2 py-0.5 rounded-full ml-1">
                {{ auth()->user()->role }}
            </span>
        </div>

        <nav class="space-y-1">

            {{-- Dashboard --}}
            <a href="{{ route('dashboard.admin') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl transition group
                {{ request()->routeIs('dashboard.admin')
                    ? 'text-indigo-700 bg-indigo-50 border-l-4 border-indigo-600 font-medium'
                    : 'text-gray-600 hover:bg-indigo-50/50' }}">
                <i class='bx bxs-dashboard text-xl'></i>
                <span>Dashboard</span>
            </a>

            {{-- Account --}}
            <a href="{{ route('account.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl transition group
                {{ request()->routeIs('account.*')
                    ? 'text-indigo-700 bg-indigo-50 border-l-4 border-indigo-600 font-medium'
                    : 'text-gray-600 hover:bg-indigo-50/50' }}">
                <i class='bx bx-group text-xl'></i>
                <span>Management Account</span>
            </a>

            {{-- Kategori --}}
            <a href="{{ route('kategori.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl transition group
                {{ request()->routeIs('kategori.*')
                    ? 'text-indigo-700 bg-indigo-50 border-l-4 border-indigo-600 font-medium'
                    : 'text-gray-600 hover:bg-indigo-50/50' }}">
                <i class='bx bx-purchase-tag-alt text-xl'></i>
                <span>Kategori & Harga</span>
            </a>

            {{-- Kategori --}}
            <a href="{{ route('pemesanan.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl transition group
                {{ request()->routeIs('pemesanan.*')
                    ? 'text-indigo-700 bg-indigo-50 border-l-4 border-indigo-600 font-medium'
                    : 'text-gray-600 hover:bg-indigo-50/50' }}">
                <i class='bx bx-purchase-tag-alt text-xl'></i>
                <span>Pemesanan</span>
            </a>

            {{-- Kamar --}}
            <a href="{{ route('kamar.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl transition group
                {{ request()->routeIs('kamar.*')
                    ? 'text-indigo-700 bg-indigo-50 border-l-4 border-indigo-600 font-medium'
                    : 'text-gray-600 hover:bg-indigo-50/50' }}">
                <i class='bx bx-bed text-xl'></i>
                <span>Manajemen Kamar</span>
            </a>

            <div class="pt-4 mt-2 border-t border-indigo-100"></div>

            {{-- Logout --}}
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                    class="w-full flex items-center gap-3 px-4 py-3 text-red-600 hover:bg-red-50 rounded-xl transition">
                    <i class='bx bx-log-out text-xl'></i>
                    <span>Logout</span>
                </button>
            </form>

        </nav>
    </div>

    {{-- User Info --}}
    <div class="border-t border-indigo-100 p-4 flex items-center gap-3">
        <div
            class="w-10 h-10 rounded-full bg-gradient-to-r from-indigo-400 to-emerald-400 flex items-center justify-center text-white font-bold shadow-sm">
            <i class='bx bx-user-circle text-2xl'></i>
        </div>
        <div>
            <p class="text-sm font-medium text-gray-800">
                {{ auth()->user()->nama }}
            </p>
            <p class="text-xs text-indigo-500 flex items-center gap-1">
                <i class='bx bx-crown text-xs'></i>
                {{ auth()->user()->role }}
            </p>
        </div>
    </div>
</aside>
