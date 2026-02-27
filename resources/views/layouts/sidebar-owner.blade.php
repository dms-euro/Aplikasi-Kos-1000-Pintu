<aside class="w-64 bg-white shadow-lg flex flex-col justify-between border-r border-indigo-100">
    <div class="py-6 px-4">
        <div class="flex items-center gap-2 mb-8 px-2">
            <div class="w-20 h-auto rounded-lg flex items-center justify-center shadow-sm">
                <img src="{{ asset('icon/Bapak_Kos-removebg.png') }}" alt="Bapak Kos" class="w-auto h-auto object-contain">
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
            <a href="{{ route('admin.dashboard.admin') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl transition group
                {{ request()->routeIs('admin.dashboard.*')
                    ? 'text-indigo-700 bg-indigo-50 border-l-4 border-indigo-600 font-medium'
                    : 'text-gray-600 hover:bg-indigo-50/50' }}">
                <i class='bx bxs-dashboard text-xl'></i>
                <span>Dashboard</span>
            </a>

            {{-- Account (Owner & Staf) --}}
            <a href="{{ route('admin.account.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl transition group
                {{ request()->routeIs('admin.account.index')
                    ? 'text-indigo-700 bg-indigo-50 border-l-4 border-indigo-600 font-medium'
                    : 'text-gray-600 hover:bg-indigo-50/50' }}">
                <i class='bx bx-group text-xl'></i>
                <span>Account</span>
            </a>

            {{-- Penghuni --}}
            <a href="{{ route('admin.account.penghuni') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl transition group
                {{ request()->routeIs('admin.account.penghuni')
                    ? 'text-indigo-700 bg-indigo-50 border-l-4 border-indigo-600 font-medium'
                    : 'text-gray-600 hover:bg-indigo-50/50' }}">
                <i class='bx bx-id-card text-xl'></i>
                <span>Penghuni</span>
            </a>

            {{-- Kategori --}}
            <a href="{{ route('admin.kategori.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl transition group
                {{ request()->routeIs('admin.kategori.*')
                    ? 'text-indigo-700 bg-indigo-50 border-l-4 border-indigo-600 font-medium'
                    : 'text-gray-600 hover:bg-indigo-50/50' }}">
                <i class='bx bx-door-open text-xl'></i>
                <span>Kategori Kamar</span>
            </a>

            {{-- Kamar --}}
            <a href="{{ route('admin.kamar.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl transition group
                {{ request()->routeIs('admin.kamar.*')
                    ? 'text-indigo-700 bg-indigo-50 border-l-4 border-indigo-600 font-medium'
                    : 'text-gray-600 hover:bg-indigo-50/50' }}">
                <i class='bx bx-bed text-xl'></i>
                <span>Manajemen Kamar</span>
            </a>

            {{-- Laporan --}}
            <a href="{{ route('admin.laporan.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl transition group
                {{ request()->routeIs('admin.laporan.*')
                    ? 'text-indigo-700 bg-indigo-50 border-l-4 border-indigo-600 font-medium'
                    : 'text-gray-600 hover:bg-indigo-50/50' }}">
                <i class='bx bx-bar-chart-alt-2 text-xl'></i>
                <span>Laporan</span>
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
            class="w-10 h-10 rounded-full bg-indigo-400 flex items-center justify-center text-white font-bold shadow-sm">
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
