<div x-show="mobileSidebar" x-transition class="fixed inset-0 z-40 bg-neutral-900/50 md:hidden" @click="mobileSidebar = false"></div>
<aside :class="mobileSidebar ? 'translate-x-0' : '-translate-x-full md:translate-x-0'"
    class="fixed inset-y-0 left-0 z-50 flex w-64 shrink-0 flex-col justify-between border-r border-[#EFE8E3] bg-white p-5 transition-transform duration-300 md:static">
    <div>
        <div class="mb-5 flex items-center justify-between border-b border-neutral-100 pb-5">
            <div class="flex items-center gap-2.5">
                <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-[#5F8C72] text-sm font-extrabold text-white">M</span>
                <div>
                    <span class="text-base font-extrabold tracking-tight text-[#8C433C]">Maternity<span class="text-[#5F8C72]">.id</span></span>
                    <span class="mt-1 block text-[10px] font-semibold uppercase tracking-wider text-neutral-400">Admin Portal</span>
                </div>
            </div>
            <button @click="mobileSidebar = false" class="text-neutral-400 md:hidden"><i class="fa-solid fa-xmark"></i></button>
        </div>

        <div class="mb-6 flex items-center gap-3 rounded-2xl border border-[#EFE8E3] bg-[#FAF5F2] p-3.5">
            <img src="{{ auth()->user()->admin?->profile_img ?? asset('logologin.png') }}" alt="Admin Profile" class="h-10 w-10 shrink-0 rounded-full object-cover">
            <div class="min-w-0">
                <h4 class="truncate text-xs font-bold text-neutral-900">{{ auth()->user()->name }}</h4>
                <p class="truncate text-[10px] text-neutral-500">{{ ucfirst(auth()->user()->role) }}</p>
            </div>
        </div>

        <p class="mb-2 px-3 text-[10px] font-bold uppercase tracking-wider text-neutral-400">Manajemen Konten & User</p>
        <nav class="space-y-1">
            @php
                $menus = [
                    ['key' => 'approvals', 'label' => 'Verifikasi Pembayaran', 'icon' => 'fa-user-check', 'route' => 'admin.approval'],
                    ['key' => 'users', 'label' => 'Manage Users', 'icon' => 'fa-users-gear', 'route' => 'admin.users'],
                    ['key' => 'articles', 'label' => 'Upload & Tulis Artikel', 'icon' => 'fa-newspaper', 'route' => 'admin.article'],
                    ['key' => 'events', 'label' => 'Event & Pelatihan', 'icon' => 'fa-calendar-check', 'route' => 'admin.event'],
                    ['key' => 'library', 'label' => 'E-Book & Modul PDF', 'icon' => 'fa-book-open', 'route' => 'admin.ebook'],
                    ['key' => 'products', 'label' => 'Produk Afiliasi', 'icon' => 'fa-box-open', 'route' => 'admin.product'],
                    ['key' => 'vouchers', 'label' => 'Voucher', 'icon' => 'fa-ticket', 'route' => 'admin.voucher'],
                ];
            @endphp
            @foreach ($menus as $menu)
                <a href="{{ route($menu['route']) }}" @click="mobileSidebar = false"
                    class="{{ $activeMenu === $menu['key'] ? 'bg-[#B8E6B8] text-neutral-900 font-bold shadow-xs' : 'text-neutral-600 hover:bg-[#FAF5F2] hover:text-neutral-900 font-medium' }} flex items-center gap-3 rounded-xl px-3.5 py-2.5 text-xs transition">
                    <i class="fa-solid {{ $menu['icon'] }} w-4 text-center text-xs text-emerald-800"></i>
                    <span>{{ $menu['label'] }}</span>
                </a>
            @endforeach
        </nav>
    </div>
    <div class="space-y-2 border-t border-neutral-100 pt-4">
        <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-2 rounded-xl px-3.5 py-2 text-xs font-medium text-neutral-500 hover:bg-[#FAF5F2]">
            <i class="fa-solid fa-arrow-up-right-from-square text-[11px]"></i>Lihat Website User
        </a>
        <a href="{{ route('logout') }}" class="flex items-center gap-2 rounded-xl px-3.5 py-2 text-xs font-medium text-neutral-500 hover:bg-red-50 hover:text-red-600">
            <i class="fa-solid fa-right-from-bracket text-[11px]"></i>Keluar
        </a>
    </div>
</aside>
