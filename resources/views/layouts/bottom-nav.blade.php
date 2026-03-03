<div
    class="fixed bottom-0 left-0 right-0 bg-white shadow-[0_-4px_10px_rgba(0,0,0,0.05)] rounded-t-2xl z-50 py-2 px-2 md:hidden">
    <div class="flex justify-around items-center">
        <a href="{{ route('dashboard.penghuni') }}"
            class="nav-item flex flex-col items-center justify-center gap-0.5 text-[10px] text-gray-500 transition-all flex-1 active:text-indigo-600"
            id="mnav-beranda">
            <i class='bx bx-home-alt text-xl'></i>
            <span>Beranda</span>
        </a>
        <a href="{{ route('penghuni.kamar.index') }}"
            class="nav-item flex flex-col items-center justify-center gap-0.5 text-[10px] text-gray-500 transition-all flex-1"
            id="mnav-kamar">
            <i class='bx bx-grid-alt text-xl'></i>
            <span>Kamar</span>
        </a>
        <a href="{{ route('penghuni.kamar.saya') }}"
            class="nav-item flex flex-col items-center justify-center gap-0.5 text-[10px] text-gray-500 transition-all flex-1"
            id="mnav-kamar-saya">
            <i class='bx bx-bed text-xl'></i>
            <span>Kamar Saya</span>
        </a>
        {{-- <a href="#"
            class="nav-item flex flex-col items-center justify-center gap-0.5 text-[10px] text-gray-500 transition-all flex-1"
            id="mnav-chat">
            <i class='bx bx-chat text-xl'></i>
            <span>Chat</span>
        </a> --}}
        <a href="{{ route('penghuni.me') }}"
            class="nav-item flex flex-col items-center justify-center gap-0.5 text-[10px] text-gray-500 transition-all flex-1"
            id="mnav-profile">
            <i class='bx bx-user text-xl'></i>
            <span>Profile</span>
        </a>
    </div>
</div>
