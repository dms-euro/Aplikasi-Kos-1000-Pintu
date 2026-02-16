<aside class="w-64 bg-white shadow-lg flex flex-col justify-between border-r border-indigo-100">
    <div class="py-6 px-4">
        <div class="flex items-center gap-2 mb-8 px-2">
            <div
                class="w-8 h-8 rounded-lg bg-gradient-to-br from-indigo-500 to-emerald-500 flex items-center justify-center shadow-sm">
                <i class='bx bx-home-alt-2 text-white text-lg'></i>
            </div>
            <span class="text-xl font-semibold text-gray-800">Kos<span class="text-indigo-600">an</span></span>
            <span class="text-xs bg-amber-100 text-amber-700 px-2 py-0.5 rounded-full ml-1">owner</span>
        </div>
        <nav class="space-y-1">
            <a href="{{ route('dashboard.admin') }}"
                class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-indigo-50/50 rounded-xl transition group">
                <i class='bx bxs-dashboard text-xl text-indigo-400 group-hover:text-indigo-500'></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('account.index') }}"
                class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-indigo-50/50 rounded-xl transition group">
                <i class='bx bx-group text-xl text-indigo-400 group-hover:text-indigo-500'></i>
                <span>Management Account</span>
            </a>
            <a href="{{ route('kategori.index') }}"
                class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-indigo-50/50 rounded-xl transition group">
                <i class='bx bx-purchase-tag-alt text-xl text-indigo-400 group-hover:text-indigo-500'></i>
                <span>Kategori & Harga</span>
            </a>
            <a href="{{ route('kamar.index') }}"
                class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-indigo-50/50 rounded-xl transition group">
                <i class='bx bx-bed text-xl text-indigo-400 group-hover:text-indigo-500'></i>
                <span>Manajemen Kamar</span>
            </a>
            <a href="#"
                class="flex items-center gap-3 px-4 py-3 text-indigo-700 bg-indigo-50 rounded-xl border-l-4 border-indigo-600 font-medium">
                <i class='bx bx-line-chart text-xl text-indigo-600'></i>
                <span>Laporan Keuangan</span>
            </a>
            <a href="#"
                class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-indigo-50/50 rounded-xl transition group">
                <i class='bx bx-receipt text-xl text-amber-400 group-hover:text-amber-500'></i>
                <span>Tagihan</span>
            </a>
            <div class="pt-4 mt-2 border-t border-indigo-100"></div>
            <a href="#"
                class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-indigo-50/50 rounded-xl transition group">
                <i class='bx bx-cog text-xl text-violet-400 group-hover:text-violet-500'></i>
                <span>Pengaturan</span>
            </a>
        </nav>
    </div>
    <div class="border-t border-indigo-100 p-4 flex items-center gap-3">
        <div
            class="w-10 h-10 rounded-full bg-gradient-to-r from-indigo-400 to-emerald-400 flex items-center justify-center text-white font-bold shadow-sm">
            <i class='bx bx-user-circle text-2xl'></i>
        </div>
        <div>
            <p class="text-sm font-medium text-gray-800">Rahma W.</p>
            <p class="text-xs text-indigo-500 flex items-center gap-1"><i class='bx bx-crown text-xs'></i> owner</p>
        </div>
    </div>
</aside>
