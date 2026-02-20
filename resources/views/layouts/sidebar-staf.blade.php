{{-- sidebar-staf.blade.php --}}
<aside class="w-64 bg-white shadow-lg flex flex-col justify-between border-r border-indigo-100">

    <div class="py-6 px-4">
        <div class="flex items-center gap-2 mb-8 px-2">
            <span class="text-xl font-semibold">Kosan</span>
            <span class="text-xs bg-emerald-100 text-emerald-700 px-2 py-0.5 rounded-full">
                staff
            </span>
        </div>

        <nav class="space-y-1">

            <a href="{{ route('dashboard.staf') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl
                {{ request()->routeIs('dashboard.staf')
                    ? 'bg-indigo-50 border-l-4 border-indigo-600 text-indigo-700 font-medium'
                    : 'text-gray-600 hover:bg-indigo-50/50' }}">
                Dashboard
            </a>

            {{-- {{ route('penghuni.index') }} --}}
            <a href=""
                class="flex items-center gap-3 px-4 py-3 rounded-xl
                {{ request()->routeIs('penghuni.*')
                    ? 'bg-indigo-50 border-l-4 border-indigo-600 text-indigo-700 font-medium'
                    : 'text-gray-600 hover:bg-indigo-50/50' }}">
                Input Penghuni
            </a>

            {{-- {{ route('pembayaran.index') }} --}}
            <a href=""
                class="flex items-center gap-3 px-4 py-3 rounded-xl
                {{ request()->routeIs('pembayaran.*')
                    ? 'bg-indigo-50 border-l-4 border-indigo-600 text-indigo-700 font-medium'
                    : 'text-gray-600 hover:bg-indigo-50/50' }}">
                Input Pembayaran
            </a>

            {{-- {{ route('kamar.index') }} --}}
            <a href=""
                class="flex items-center gap-3 px-4 py-3 rounded-xl
                {{ request()->routeIs('kamar.*')
                    ? 'bg-indigo-50 border-l-4 border-indigo-600 text-indigo-700 font-medium'
                    : 'text-gray-600 hover:bg-indigo-50/50' }}">
                Data Kamar
            </a>

            <div class="pt-4 mt-2 border-t"></div>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full text-left px-4 py-3 text-red-600 hover:bg-red-50 rounded-xl">
                    Logout
                </button>
            </form>

        </nav>
    </div>
</aside>
