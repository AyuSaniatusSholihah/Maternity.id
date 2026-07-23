{{-- ─── NAVBAR MATERNITY.ID ───────────────────────────────────────────
    Dipakai via <x-navbar /> di dalam x-layout
    - Guest: tampilkan tombol Login
    - Auth: tampilkan avatar + dropdown profil
    - Mobile: hamburger menu dengan Alpine.js
──────────────────────────────────────────────────────────────────── --}}

<header
    x-data="{ open: false, scrolled: false }"
    x-init="window.addEventListener('scroll', () => scrolled = window.scrollY > 10)"
    :class="scrolled ? 'bg-[#FAF0EE]/95 backdrop-blur shadow-sm' : 'bg-transparent'"
    class="fixed top-0 left-0 right-0 z-50 transition-all duration-300"
>
    <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">

        {{-- ── Logo ── --}}
        <a href="{{ url('/') }}" class="flex items-center gap-2.5 group">
            <x-logo class="w-8 h-8" />
            <span class="text-xl md:text-2xl text-[#2A1614] group-hover:opacity-80 transition-opacity" style="font-family: 'DM Serif Display', serif;">
                Maternity<span class="text-[#4D6A56] font-sans font-bold text-base">.id</span>
            </span>
        </a>

        {{-- ── Nav Links (Desktop) ── --}}
        <ul class="hidden md:flex items-center gap-1">
            <li>
                <a href="{{ url('/seminars') }}"
                   class="px-4 py-2 rounded-lg text-sm font-medium text-[#3D2B2B] hover:bg-[#EEE0DC] transition-colors {{ request()->is('seminars*') ? 'bg-[#EEE0DC] font-semibold' : '' }}">
                    Info Seminar
                </a>
            </li>
            <li>
                <a href="{{ url('/library') }}"
                   class="px-4 py-2 rounded-lg text-sm font-medium text-[#3D2B2B] hover:bg-[#EEE0DC] transition-colors {{ request()->is('library*') ? 'bg-[#EEE0DC] font-semibold' : '' }}">
                    Ebook & Library
                </a>
            </li>
            <li>
                <a href="{{ url('/articles') }}"
                   class="px-4 py-2 rounded-lg text-sm font-medium text-[#3D2B2B] hover:bg-[#EEE0DC] transition-colors {{ request()->is('articles*') ? 'bg-[#EEE0DC] font-semibold' : '' }}">
                    Artikel
                </a>
            </li>
            <li>
                <a href="{{ url('/mitra') }}"
                   class="px-4 py-2 rounded-lg text-sm font-medium text-[#3D2B2B] hover:bg-[#EEE0DC] transition-colors {{ request()->is('mitra*') ? 'bg-[#EEE0DC] font-semibold' : '' }}">
                    Kemitraan
                </a>
            </li>
        </ul>

        {{-- ── Auth Area (Desktop) ── --}}
        <div class="hidden md:flex items-center gap-3">
            @auth
                {{-- Dropdown Profil --}}
                <div class="relative" x-data="{ dropOpen: false }" @click.outside="dropOpen = false">
                    <button @click="dropOpen = !dropOpen"
                            class="flex items-center gap-2 px-3 py-1.5 rounded-full hover:bg-[#EEE0DC] transition-colors">
                        <img src="{{ auth()->user()->profile_img ?? 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&background=4D6A56&color=fff' }}"
                             alt="{{ auth()->user()->name }}"
                             class="w-8 h-8 rounded-full object-cover border-2 border-[#4D6A56]/30">
                        <span class="text-sm font-semibold text-[#2A1614] max-w-[120px] truncate">
                            {{ auth()->user()->name }}
                        </span>
                        <svg class="w-4 h-4 text-gray-500 transition-transform" :class="dropOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    {{-- Dropdown Menu --}}
                    <div x-show="dropOpen"
                         x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 scale-95 -translate-y-1"
                         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         class="absolute right-0 mt-2 w-52 bg-white rounded-2xl shadow-lg border border-gray-100 py-2 origin-top-right"
                         style="display: none;">
                        <a href="{{ url('/profile') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-[#2A1614] hover:bg-[#FAF0EE] transition-colors">
                            <svg class="w-4 h-4 text-[#4D6A56]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            Profil Saya
                        </a>
                        <a href="{{ url('/my-subscriptions') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-[#2A1614] hover:bg-[#FAF0EE] transition-colors">
                            <svg class="w-4 h-4 text-[#4D6A56]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                            </svg>
                            Status Langganan
                        </a>
                        <a href="{{ url('/bookmarks') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-[#2A1614] hover:bg-[#FAF0EE] transition-colors">
                            <svg class="w-4 h-4 text-[#4D6A56]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
                            </svg>
                            Bookmark
                        </a>
                        <hr class="my-1 border-gray-100">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 text-sm text-red-500 hover:bg-red-50 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                </svg>
                                Keluar
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}"
                   class="px-5 py-2 rounded-full bg-[#2A1614] text-white text-sm font-semibold hover:bg-[#3D2B2B] transition-colors shadow-sm">
                    Masuk
                </a>
            @endauth
        </div>

        {{-- ── Hamburger (Mobile) ── --}}
        <button @click="open = !open"
                class="md:hidden p-2 rounded-lg hover:bg-[#EEE0DC] transition-colors"
                aria-label="Toggle menu">
            <svg x-show="!open" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
            <svg x-show="open" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="display:none">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>

    </nav>

    {{-- ── Mobile Menu ── --}}
    <div x-show="open"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-end="opacity-0 -translate-y-2"
         class="md:hidden bg-[#FAF0EE]/98 backdrop-blur border-t border-[#EEE0DC] px-4 py-4 space-y-1"
         style="display: none;">

        <a href="{{ url('/seminars') }}" class="block px-4 py-3 rounded-xl text-sm font-medium text-[#2A1614] hover:bg-[#EEE0DC] transition-colors">Info Seminar</a>
        <a href="{{ url('/library') }}" class="block px-4 py-3 rounded-xl text-sm font-medium text-[#2A1614] hover:bg-[#EEE0DC] transition-colors">Ebook & Library</a>
        <a href="{{ url('/articles') }}" class="block px-4 py-3 rounded-xl text-sm font-medium text-[#2A1614] hover:bg-[#EEE0DC] transition-colors">Artikel</a>
        <a href="{{ url('/mitra') }}" class="block px-4 py-3 rounded-xl text-sm font-medium text-[#2A1614] hover:bg-[#EEE0DC] transition-colors">Kemitraan</a>

        <div class="pt-3 border-t border-[#EEE0DC]">
            @auth
                <div class="flex items-center gap-3 px-4 py-3">
                    <img src="{{ auth()->user()->profile_img ?? 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&background=4D6A56&color=fff' }}"
                         alt="{{ auth()->user()->name }}"
                         class="w-9 h-9 rounded-full object-cover">
                    <div>
                        <p class="text-sm font-semibold text-[#2A1614]">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-gray-500">{{ auth()->user()->email }}</p>
                    </div>
                </div>
                <a href="{{ url('/profile') }}" class="block px-4 py-2.5 text-sm text-[#2A1614] hover:bg-[#EEE0DC] rounded-xl transition-colors">Profil Saya</a>
                <a href="{{ url('/my-subscriptions') }}" class="block px-4 py-2.5 text-sm text-[#2A1614] hover:bg-[#EEE0DC] rounded-xl transition-colors">Status Langganan</a>
                <a href="{{ url('/bookmarks') }}" class="block px-4 py-2.5 text-sm text-[#2A1614] hover:bg-[#EEE0DC] rounded-xl transition-colors">Bookmark</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2.5 text-sm text-red-500 hover:bg-red-50 rounded-xl transition-colors">Keluar</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="block w-full text-center px-5 py-3 rounded-xl bg-[#2A1614] text-white text-sm font-semibold hover:bg-[#3D2B2B] transition-colors">
                    Masuk dengan Google
                </a>
            @endauth
        </div>
    </div>
</header>

{{-- Spacer agar konten tidak tertutup fixed navbar --}}
<div class="h-16"></div>
