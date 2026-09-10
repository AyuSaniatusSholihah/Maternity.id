<div x-data="{ showMobileSearch: false, openMobileMenu: false }" class="w-full relative">
    <nav class="bg-[#DEA69E] rounded-2xl px-4 sm:px-6 py-3 sm:py-3.5 shadow-sm border border-transparent flex items-center justify-between">
        
        <!-- Logo & Brand Name -->
        <a href="{{ url('/') }}" class="flex items-center space-x-2 shrink-0">
            <x-logo_pink class="w-7 h-7 sm:w-8 sm:h-8" />
            <span class="text-xl md:text-2xl" style="font-family: 'DM Serif Display', serif; background: linear-gradient(to right, rgba(61, 43, 43, 0.8), #2A1614); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Maternity</span>
        </a>

        <!-- ── DESKTOP NAVIGATION LINKS (hidden md:flex) ── -->
        <div class="hidden md:flex items-center justify-center flex-1 mx-2 lg:mx-6">
            <div class="flex items-center gap-1 lg:gap-1.5 bg-white/35 backdrop-blur-md p-1 rounded-full border border-white/50 shadow-[inset_0_1px_1px_rgba(255,255,255,0.7)]">
                <!-- 1. Home -->
                <a href="{{ route('home') }}" 
                   class="flex items-center gap-1.5 px-3 lg:px-3.5 py-1.5 rounded-full text-xs font-semibold transition-colors duration-200 {{ request()->routeIs('home') ? 'bg-white text-[#782819] shadow-xs' : 'text-[#2D1E1E] hover:bg-white/60 hover:text-[#782819]' }}">
                    <i class="fa-solid fa-house text-xs {{ request()->routeIs('home') ? 'text-[#8C433C]' : '' }}"></i>
                    <span>Home</span>
                </a>

                <!-- 2. Event -->
                <a href="{{ route('events') }}" 
                   class="flex items-center gap-1.5 px-3 lg:px-3.5 py-1.5 rounded-full text-xs font-semibold transition-colors duration-200 {{ request()->routeIs('events*') ? 'bg-white text-[#782819] shadow-xs' : 'text-[#2D1E1E] hover:bg-white/60 hover:text-[#782819]' }}">
                    <i class="fa-regular fa-calendar text-xs {{ request()->routeIs('events*') ? 'text-[#8C433C]' : '' }}"></i>
                    <span>Event</span>
                </a>

                <!-- 3. Ebook -->
                <a href="{{ route('library') }}" 
                   class="flex items-center gap-1.5 px-3 lg:px-3.5 py-1.5 rounded-full text-xs font-semibold transition-colors duration-200 {{ request()->routeIs('library*') ? 'bg-white text-[#782819] shadow-xs' : 'text-[#2D1E1E] hover:bg-white/60 hover:text-[#782819]' }}">
                    <svg class="w-3.5 h-3.5 {{ request()->routeIs('library*') ? 'text-[#8C433C]' : 'text-current' }}" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5.5 3C5.89782 3 6.27936 3.15804 6.56066 3.43934C6.84196 3.72064 7 4.10218 7 4.5V19.5C7 19.8978 6.84196 20.2794 6.56066 20.5607C6.27936 20.842 5.89782 21 5.5 21H3.5C3.10218 21 2.72064 20.842 2.43934 20.5607C2.15804 20.2794 2 19.8978 2 19.5V4.5C2 4.10218 2.15804 3.72064 2.43934 3.43934C2.72064 3.15804 3.10218 3 3.5 3H5.5ZM11.5 3C11.8978 3 12.2794 3.15804 12.5607 3.43934C12.842 3.72064 13 4.10218 13 4.5V19.5C13 19.8978 12.842 20.2794 12.5607 20.5607C12.2794 20.842 11.8978 21 11.5 21H9.5C9.10218 21 8.72064 20.842 8.43934 20.5607C8.15804 20.2794 8 19.8978 8 19.5V4.5C8 4.10218 8.15804 3.72064 8.43934 3.43934C8.72064 3.15804 9.10218 3 9.5 3H11.5ZM18.781 6.124L21.995 18.643C22.044 18.8338 22.0549 19.0324 22.0272 19.2274C21.9994 19.4225 21.9335 19.6101 21.8332 19.7797C21.7329 19.9493 21.6002 20.0974 21.4427 20.2157C21.2851 20.334 21.1058 20.42 20.915 20.469L19.039 20.949C18.8482 20.998 18.6496 21.0089 18.4546 20.9812C18.2595 20.9534 18.0719 20.8875 17.9023 20.7872C17.7327 20.6869 17.5846 20.5542 17.4663 20.3967C17.348 20.2391 17.262 20.0598 17.213 19.869L13.999 7.354C13.95 7.16319 13.9391 6.96459 13.9668 6.76956C13.9946 6.57452 14.0605 6.38686 14.1608 6.2173C14.2611 6.04774 14.3938 5.89959 14.5513 5.78132C14.7089 5.66305 14.8882 5.57697 15.079 5.528L16.955 5.045C17.1458 4.996 17.3444 4.98507 17.5394 5.01283C17.7345 5.04059 17.9221 5.10649 18.0917 5.20678C18.2613 5.30707 18.4094 5.43978 18.5277 5.59733C18.646 5.75488 18.732 5.93318 18.781 6.124Z" fill="currentColor"/>
                    </svg>
                    <span>Ebook</span>
                </a>

                <!-- 4. Artikel -->
                <a href="{{ route('articles.index') }}" 
                   class="flex items-center gap-1.5 px-3 lg:px-3.5 py-1.5 rounded-full text-xs font-semibold transition-colors duration-200 {{ request()->routeIs('articles*') ? 'bg-white text-[#782819] shadow-xs' : 'text-[#2D1E1E] hover:bg-white/60 hover:text-[#782819]' }}">
                    <i class="fa-regular fa-newspaper text-xs {{ request()->routeIs('articles*') ? 'text-[#8C433C]' : '' }}"></i>
                    <span>Artikel</span>
                </a>

                <!-- 5. Produk -->
                <a href="{{ route('product') }}" 
                   class="flex items-center gap-1.5 px-3 lg:px-3.5 py-1.5 rounded-full text-xs font-semibold transition-colors duration-200 {{ request()->routeIs('product*') ? 'bg-white text-[#782819] shadow-xs' : 'text-[#2D1E1E] hover:bg-white/60 hover:text-[#782819]' }}">
                    <i class="fa-solid fa-box-open text-xs {{ request()->routeIs('product*') ? 'text-[#8C433C]' : '' }}"></i>
                    <span>Produk</span>
                </a>
            </div>
        </div>

        <!-- ── DESKTOP RIGHT ACTIONS (hidden md:flex) ── -->
        <div class="hidden md:flex items-center space-x-2.5 lg:space-x-3 shrink-0">
            <!-- Search Symbol Icon (Pojok Kanan) with Dropdown Input -->
            <div class="relative" x-data="{ openSearch: false }">
                <button @click="openSearch = !openSearch; if(openSearch) $nextTick(() => $refs.desktopSearchInput?.focus())" 
                        type="button" 
                        class="w-9 h-9 flex items-center justify-center rounded-full bg-white/40 hover:bg-white text-[#2D1E1E] hover:text-[#782819] transition-colors duration-200 shadow-xs"
                        aria-label="Cari">
                    <i class="fa-solid fa-magnifying-glass text-sm" :class="openSearch ? 'text-[#8C433C]' : ''"></i>
                </button>

                <!-- Floating Search Dropdown for Desktop -->
                <div x-show="openSearch" 
                     @click.away="openSearch = false" 
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 -translate-y-2 scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                     x-transition:leave-end="opacity-0 -translate-y-2 scale-95"
                     class="absolute right-0 mt-2 w-80 bg-white rounded-2xl shadow-xl p-2.5 border border-pink-100 z-50"
                     style="display: none;">
                    <form action="{{ route('articles.index') }}" method="GET" class="relative flex items-center">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-[#8C433C]">
                            <i class="fa-solid fa-magnifying-glass text-xs"></i>
                        </span>
                        <input type="text" 
                               name="q" 
                               x-ref="desktopSearchInput"
                               placeholder="Cari artikel, event, panduan..." 
                               class="w-full pl-8 pr-14 py-2 bg-[#FAF0EE] text-xs text-[#2D1E1E] placeholder-[#2D1E1E]/50 rounded-xl border border-transparent focus:border-[#8C433C] focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#8C433C] transition-all" />
                        <button type="submit" class="absolute right-1 top-1/2 -translate-y-1/2 px-2.5 py-1 bg-[#8C433C] text-white text-[11px] font-bold rounded-lg hover:bg-[#782819] transition-colors shadow-xs">
                            Cari
                        </button>
                    </form>
                </div>
            </div>

            @guest
                <!-- Guest Desktop -->
                <a href="{{ route('login') }}" class="font-semibold text-[#2D1E1E] hover:underline px-2 text-sm">
                    Login
                </a>
                <a href="{{ route('events') }}" class="bg-[#7A9E7E] hover:bg-[#5a7a66] text-white font-medium px-4 py-2 rounded-full text-sm transition shadow-sm">
                    Ajukan Event
                </a>
            @endguest

            @auth
                <!-- Authenticated Desktop -->
                <a href="{{ route('events') }}" class="bg-[#7A9E7E] hover:bg-[#5a7a66] text-white font-medium px-4 py-2 rounded-full text-sm transition shadow-sm">
                    Ajukan Event
                </a>

                <!-- Notification Icon dengan Badge Unread -->
                <div class="relative" x-data="{
                    openNavNotif: false,
                    activeTab: 'all',
                    notifications: [
                        {
                            id: 1,
                            type: 'payment',
                            status: 'pending',
                            title: 'Pembayaran Diverifikasi',
                            message: 'Bukti transfer Prenatal Yoga for Calm & Strength sedang diverifikasi admin.',
                            time: '5 menit lalu',
                            read: false,
                            url: '/events/prenatal-yoga-for-calm-and-strength/checkout?status=verifying',
                            icon: 'fa-clock',
                            iconBg: 'bg-amber-100',
                            iconColor: 'text-amber-500',
                            badge: 'Menunggu',
                            badgeBg: 'bg-amber-100 text-amber-700',
                        },
                        {
                            id: 2,
                            type: 'payment',
                            status: 'approved',
                            title: 'Pembayaran Diterima! 🎉',
                            message: 'Pendaftaran Holistic Hormone Health Anda telah disetujui. Cek email untuk detail.',
                            time: '2 jam lalu',
                            read: false,
                            url: '/events/holistic-hormone-health/approved',
                            icon: 'fa-circle-check',
                            iconBg: 'bg-green-100',
                            iconColor: 'text-green-600',
                            badge: 'Disetujui',
                            badgeBg: 'bg-green-100 text-green-700',
                        },
                        {
                            id: 3,
                            type: 'event',
                            status: 'info',
                            title: 'Seminar Dimulai 15 Menit Lagi',
                            message: 'Sesi webinar Mindful Motherhood Anda akan segera dimulai.',
                            time: 'Kemarin',
                            read: true,
                            url: '/events/mindful-motherhood',
                            icon: 'fa-bell',
                            iconBg: 'bg-[#FAF0EE]',
                            iconColor: 'text-[#8C433C]',
                            badge: null,
                            badgeBg: '',
                        },
                        {
                            id: 4,
                            type: 'payment',
                            status: 'rejected',
                            title: 'Pembayaran Ditolak',
                            message: 'Bukti transfer Newborn Care tidak valid. Harap upload ulang.',
                            time: '3 hari lalu',
                            read: true,
                            url: '/events/newborn-gentle-care-and-massage/checkout',
                            icon: 'fa-circle-xmark',
                            iconBg: 'bg-red-100',
                            iconColor: 'text-red-500',
                            badge: 'Ditolak',
                            badgeBg: 'bg-red-100 text-red-600',
                        },
                    ],
                    get filtered() {
                        if (this.activeTab === 'all') return this.notifications;
                        if (this.activeTab === 'payment') return this.notifications.filter(n => n.type === 'payment');
                        if (this.activeTab === 'event') return this.notifications.filter(n => n.type === 'event');
                        return this.notifications;
                    },
                    get unreadCount() {
                        return this.notifications.filter(n => !n.read).length;
                    },
                    markAllRead() {
                        this.notifications.forEach(n => n.read = true);
                    }
                }">
                    <button @click="openNavNotif = !openNavNotif" class="text-[#2D1E1E] p-2 hover:bg-black/5 rounded-full transition relative flex items-center justify-center">
                        <i class="fa-regular fa-bell text-xl"></i>
                        <span x-show="unreadCount > 0"
                              class="absolute top-1.5 right-1.5 w-2.5 h-2.5 bg-red-500 rounded-full ring-2 ring-[#DEA69E] flex items-center justify-center"
                              style="display: none;"></span>
                    </button>

                    <!-- Dropdown Notification -->
                    <div x-show="openNavNotif"
                         @click.away="openNavNotif = false"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 translate-y-1 scale-97"
                         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                         x-transition:leave-end="opacity-0 translate-y-1 scale-97"
                         class="absolute right-0 mt-2 w-80 bg-white rounded-2xl shadow-2xl border border-gray-100 z-50 overflow-hidden"
                         style="display: none;">

                        <!-- Header -->
                        <div class="px-4 py-3 border-b border-gray-100 flex items-center justify-between bg-white sticky top-0">
                            <div class="flex items-center gap-2">
                                <span class="font-bold text-gray-800 text-sm">Notifikasi</span>
                                <span x-show="unreadCount > 0"
                                      class="inline-flex items-center justify-center w-5 h-5 bg-red-500 text-white text-[10px] font-bold rounded-full"
                                      x-text="unreadCount"
                                      style="display: none;"></span>
                            </div>
                            <button @click="markAllRead()"
                                    class="text-xs text-[#5F8C72] font-semibold hover:text-[#3a5e44] transition cursor-pointer">
                                Tandai semua dibaca
                            </button>
                        </div>

                        <!-- Tab Filter -->
                        <div class="flex items-center gap-1 px-3 py-2 border-b border-gray-50 bg-gray-50/50">
                            <button @click="activeTab = 'all'"
                                    :class="activeTab === 'all' ? 'bg-white text-[#8C433C] shadow-xs border border-[#DEA69E]/40 font-bold' : 'text-neutral-500 hover:text-neutral-800'"
                                    class="flex-1 py-1 rounded-lg text-[11px] font-medium transition cursor-pointer">
                                Semua
                            </button>
                            <button @click="activeTab = 'payment'"
                                    :class="activeTab === 'payment' ? 'bg-white text-[#8C433C] shadow-xs border border-[#DEA69E]/40 font-bold' : 'text-neutral-500 hover:text-neutral-800'"
                                    class="flex-1 py-1 rounded-lg text-[11px] font-medium transition cursor-pointer">
                                Pembayaran
                            </button>
                            <button @click="activeTab = 'event'"
                                    :class="activeTab === 'event' ? 'bg-white text-[#8C433C] shadow-xs border border-[#DEA69E]/40 font-bold' : 'text-neutral-500 hover:text-neutral-800'"
                                    class="flex-1 py-1 rounded-lg text-[11px] font-medium transition cursor-pointer">
                                Event
                            </button>
                        </div>

                        <!-- Notification List -->
                        <div class="max-h-72 overflow-y-auto divide-y divide-gray-50">
                            <template x-for="notif in filtered" :key="notif.id">
                                <a :href="notif.url"
                                   @click="notif.read = true; openNavNotif = false"
                                   :class="notif.read ? 'bg-white hover:bg-gray-50' : 'bg-[#FDF5F3] hover:bg-[#FAF0EE]'"
                                   class="flex items-start gap-3 px-4 py-3 transition">

                                    <!-- Icon -->
                                    <div :class="notif.iconBg" class="w-9 h-9 shrink-0 rounded-xl flex items-center justify-center mt-0.5">
                                        <i :class="[notif.iconColor, 'fa-solid', notif.icon]" class="text-sm"></i>
                                    </div>

                                    <!-- Content -->
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-start justify-between gap-1 mb-0.5">
                                            <p class="text-xs font-bold text-gray-800 leading-snug" x-text="notif.title"></p>
                                            <span x-show="!notif.read"
                                                  class="w-2 h-2 bg-red-500 rounded-full shrink-0 mt-1"
                                                  style="display: none;"></span>
                                        </div>
                                        <p class="text-[11px] text-gray-500 leading-snug line-clamp-2" x-text="notif.message"></p>
                                        <div class="flex items-center gap-2 mt-1.5">
                                            <span class="text-[10px] text-gray-400" x-text="notif.time"></span>
                                            <span x-show="notif.badge"
                                                  :class="notif.badgeBg"
                                                  class="px-2 py-0.5 rounded-full text-[10px] font-bold"
                                                  x-text="notif.badge"
                                                  style="display: none;"></span>
                                        </div>
                                    </div>
                                </a>
                            </template>

                            <!-- Empty state -->
                            <div x-show="filtered.length === 0" class="py-8 text-center text-neutral-400">
                                <i class="fa-regular fa-bell-slash text-2xl mb-2 block"></i>
                                <p class="text-xs">Tidak ada notifikasi</p>
                            </div>
                        </div>

                        <!-- Footer -->
                        <div class="px-4 py-2.5 border-t border-gray-100 bg-gray-50/50">
                            <a href="{{ route('events') }}"
                               class="block text-center text-xs text-[#5F8C72] font-semibold hover:text-[#3a5e44] transition">
                                Lihat Semua Aktivitas →
                            </a>
                        </div>
                    </div>
                </div>


                <!-- Profile Dropdown Desktop -->
                <div class="relative" x-data="{ openProfile: false }">
                    <button @click="openProfile = !openProfile" class="flex items-center space-x-2 focus:outline-none group">
                        <div class="w-10 h-10 rounded-full overflow-hidden border-2 border-white/80 shadow-sm group-hover:border-[#6B8E78] transition">
                            <img src="{{ Auth::user()->profile_img ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=6B8E78&color=fff' }}" 
                                 alt="{{ Auth::user()->name }}" 
                                 class="w-full h-full object-cover">
                        </div>
                        <i class="fa-solid fa-chevron-down text-xs text-[#2D1E1E] opacity-70 group-hover:opacity-100 transition"></i>
                    </button>

                    <!-- Dropdown Menu Profile -->
                    <div x-show="openProfile" 
                         @click.away="openProfile = false" 
                         x-transition
                         class="absolute right-0 mt-2 w-48 bg-white rounded-2xl shadow-xl py-2 border border-gray-100 z-50 text-sm"
                         style="display: none;">
                        <div class="px-4 py-2 border-b border-gray-100">
                            <p class="font-bold text-gray-800 truncate">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                        </div>

                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-700 hover:bg-pink-50 transition font-medium">
                            <i class="fa-regular fa-user mr-2 text-gray-400"></i> Profile Saya
                        </a>
                        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-pink-50 transition font-medium">
                            <i class="fa-solid fa-gem mr-2 text-amber-500"></i> Membership Info
                        </a>

                        <div class="border-t border-gray-100 my-1"></div>

                        <!-- Logout Action -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-red-600 hover:bg-red-50 transition font-medium flex items-center">
                                <i class="fa-solid fa-arrow-right-from-bracket mr-2"></i> Keluar
                            </button>
                        </form>
                    </div>
                </div>
            @endauth
        </div>

        <!-- ── MOBILE RIGHT ACTIONS: SEARCH & HAMBURGER BUTTON (md:hidden) ── -->
        <div class="md:hidden flex items-center space-x-2">
            <!-- 1. Tombol Search Toggle -->
            <button type="button" 
                    @click.stop="showMobileSearch = !showMobileSearch; if(showMobileSearch) openMobileMenu = false;" 
                    class="w-9 h-9 flex items-center justify-center rounded-full bg-white/40 hover:bg-white/80 text-[#2D1E1E] transition-all shadow-xs"
                    aria-label="Cari">
                <i class="fa-solid fa-magnifying-glass text-sm" :class="showMobileSearch ? 'text-[#8C433C]' : ''"></i>
            </button>

            <!-- 2. Tombol Hamburger Menu -->
            <button type="button" 
                    @click.stop="openMobileMenu = !openMobileMenu; if(openMobileMenu) showMobileSearch = false;" 
                    class="w-9 h-9 flex items-center justify-center rounded-full bg-white/40 hover:bg-white/80 text-[#2D1E1E] transition-all shadow-xs relative"
                    aria-label="Menu">
                <i class="fa-solid text-base transition-transform duration-300" :class="openMobileMenu ? 'fa-xmark rotate-90 text-[#8C433C]' : 'fa-bars'"></i>
                @auth
                    <!-- Unread notification indicator dot -->
                    <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-red-500 rounded-full ring-2 ring-[#DEA69E]"></span>
                @endauth
            </button>
        </div>

    </nav>

    <!-- ── MOBILE SEARCH DRAWER (Muncul floating di atas Hero saat Search Icon diklik di Mobile) ── -->
    <div x-show="showMobileSearch"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2 scale-98"
         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
         x-transition:leave-end="opacity-0 -translate-y-2 scale-98"
         @click.away="showMobileSearch = false"
         class="md:hidden absolute top-full left-0 right-0 mt-2 px-1 z-50"
         style="display: none;">
        <form action="{{ route('articles.index') }}" method="GET" class="w-full relative group shadow-xl rounded-full">
            <div class="relative flex items-center">
                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-[#8C433C]">
                    <i class="fa-solid fa-magnifying-glass text-xs"></i>
                </span>
                <input type="text" 
                       name="q" 
                       placeholder="Cari artikel, event, panduan..." 
                       class="w-full pl-9 pr-16 py-2.5 bg-white text-xs text-[#2D1E1E] placeholder-[#2D1E1E]/50 rounded-full border border-[#DEA69E]/80 focus:border-[#8C433C] focus:outline-none focus:ring-2 focus:ring-[#8C433C]/20 shadow-md" />
                <button type="submit" class="absolute right-1.5 top-1/2 -translate-y-1/2 px-3.5 py-1.5 bg-[#8C433C] hover:bg-[#782819] text-white text-[11px] font-bold rounded-full transition-all duration-200 shadow-xs">
                    Cari
                </button>
            </div>
        </form>
    </div>

    <!-- ── MOBILE HAMBURGER MENU DRAWER (Floating overlay di atas Hero Section) ── -->
    <div x-show="openMobileMenu"
         x-transition:enter="transition ease-out duration-250"
         x-transition:enter-start="opacity-0 -translate-y-3 scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
         x-transition:leave-end="opacity-0 -translate-y-3 scale-95"
         @click.away="openMobileMenu = false"
         class="md:hidden absolute top-full left-0 right-0 mt-2 bg-white/95 backdrop-blur-xl border border-[#DEA69E]/50 rounded-3xl p-4 shadow-2xl z-50 space-y-3"
         style="display: none;">

        @auth
            <!-- Profil Singkat User -->
            <div class="flex items-center space-x-3 p-2 bg-[#FAF0EE] rounded-2xl border border-[#DEA69E]/40">
                <div class="w-12 h-12 rounded-full overflow-hidden border-2 border-white shadow-sm shrink-0">
                    <img src="{{ Auth::user()->profile_img ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=6B8E78&color=fff' }}" 
                         alt="{{ Auth::user()->name }}" 
                         class="w-full h-full object-cover">
                </div>
                <div class="overflow-hidden">
                    <p class="font-bold text-[#3D2B2B] text-sm truncate">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-neutral-500 truncate">{{ Auth::user()->email }}</p>
                </div>
            </div>

            <!-- Ajukan Event Action -->
            <a href="{{ route('events') }}" 
               class="w-full flex items-center justify-center gap-2 py-2.5 bg-[#7A9E7E] hover:bg-[#5a7a66] text-white font-medium text-xs rounded-2xl transition shadow-sm">
                <i class="fa-solid fa-calendar-plus"></i> Ajukan Event
            </a>

            <!-- Menu Navigasi Akun -->
            <div class="space-y-1 pt-1 border-t border-gray-100">
                <a href="{{ route('profile.edit') }}" 
                    class="flex items-center justify-between p-2.5 rounded-xl text-neutral-700 hover:bg-[#FAF0EE] hover:text-[#8C433C] text-sm font-semibold transition">
                    <span class="flex items-center gap-2.5">
                        <i class="fa-regular fa-user text-[#8C433C]"></i> Profil Saya
                    </span>
                    <i class="fa-solid fa-chevron-right text-xs text-gray-400"></i>
                </a>

                <a href="#" 
                    class="flex items-center justify-between p-2.5 rounded-xl text-neutral-700 hover:bg-[#FAF0EE] hover:text-[#8C433C] text-sm font-semibold transition">
                    <span class="flex items-center gap-2.5">
                        <i class="fa-solid fa-gem text-amber-500"></i> Membership Info
                    </span>
                    <i class="fa-solid fa-chevron-right text-xs text-gray-400"></i>
                </a>

                <a href="#" 
                    class="flex items-center justify-between p-2.5 rounded-xl text-neutral-700 hover:bg-[#FAF0EE] hover:text-[#8C433C] text-sm font-semibold transition">
                    <span class="flex items-center gap-2.5">
                        <i class="fa-regular fa-bell text-[#8C433C]"></i> Notifikasi
                    </span>
                    <span class="bg-red-500 text-white text-[10px] font-bold px-2 py-0.5 rounded-full">1 Baru</span>
                </a>
            </div>

            <!-- Tombol Logout -->
            <div class="pt-2 border-t border-gray-100">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" 
                            class="w-full flex items-center justify-center gap-2 py-2.5 text-red-600 bg-red-50 hover:bg-red-100 font-bold text-xs rounded-2xl transition">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i> Keluar dari Akun
                    </button>
                </form>
            </div>

        @else
            <!-- Menu Guest di Drawer -->
            <div class="space-y-2">
                <a href="{{ route('events') }}" 
                    class="w-full block text-center bg-[#7A9E7E] hover:bg-[#5a7a66] text-white font-medium py-2.5 rounded-2xl text-sm transition shadow-sm">
                    Ajukan Event
                </a>
                <a href="{{ route('login') }}" 
                    class="w-full block text-center bg-[#FAF0EE] hover:bg-[#DEA69E]/50 text-[#782819] font-bold py-2.5 rounded-2xl text-sm transition border border-[#DEA69E]/50">
                    Masuk ke Akun
                </a>
            </div>
        @endauth

    </div>
</div>