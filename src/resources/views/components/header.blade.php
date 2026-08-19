<nav :class="isScrolled 
        ? 'bg-[#DEA69E] rounded-full px-4 sm:px-5 py-2 shadow-[0_10px_25px_rgba(61,43,43,0.18)] border border-transparent' 
        : 'bg-[#DEA69E] rounded-2xl px-5 sm:px-6 py-3.5 shadow-sm border border-transparent'"
     class="flex items-center justify-between transition-all duration-500 ease-out">
    <!-- Logo & Brand Name -->
    <a href="{{ url('/') }}" class="flex items-center space-x-2 shrink-0 transition-transform duration-300 transform" :class="isScrolled ? 'scale-95' : 'scale-100'">
        <x-logo_pink class="w-7 h-7 sm:w-8 sm:h-8 transition-transform duration-300" />
        <span class="text-xl md:text-2xl transition-all duration-300" style="font-family: 'DM Serif Display', serif; background: linear-gradient(to right, rgba(61, 43, 43, 0.8), #2A1614); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Maternity</span>
    </a>

    <!-- Search Bar Interaktif (Solid clean) -->
    <div class="hidden md:flex items-center flex-1 mx-3 lg:mx-6 transition-all duration-500 ease-out" 
         :class="isScrolled ? 'max-w-xs lg:max-w-sm' : 'max-w-md'">
        <form action="{{ route('articles.index') }}" method="GET" class="w-full relative group">
            <div class="relative flex items-center">
                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-[#8C433C] group-focus-within:text-[#782819] transition-colors">
                    <i class="fa-solid fa-magnifying-glass text-xs sm:text-sm"></i>
                </span>
                <input type="text" 
                       name="q" 
                       placeholder="Cari artikel, event, panduan..." 
                       class="w-full pl-9 pr-14 py-1.5 sm:py-2 bg-white hover:bg-white focus:bg-white text-xs sm:text-sm text-[#2D1E1E] placeholder-[#2D1E1E]/50 rounded-full border border-white/80 focus:border-[#8C433C]/60 focus:outline-none focus:ring-2 focus:ring-[#8C433C]/20 shadow-xs transition-all duration-200" />
                <button type="submit" class="absolute right-1 top-1/2 -translate-y-1/2 px-2.5 sm:px-3 py-1 bg-[#FAF0EE] hover:bg-[#8C433C] text-[#782819] hover:text-white text-[11px] font-bold rounded-full transition-all duration-200 border border-[#DEA69E]/50">
                    Cari
                </button>
            </div>
        </form>
    </div>

    <!-- Right Side: Conditional Auth State & Ajukan Event -->
    <div class="flex items-center space-x-3 md:space-x-4">
        
        @guest
            <!-- TAMPILAN SEBELUM LOGIN (GUEST) -->
            <a href="{{ route('login') }}" class="font-semibold text-[#2D1E1E] hover:underline px-2 text-sm">
                Login
            </a>
            <a href="{{ route('register') }}" class="bg-[#7A9E7E] hover:bg-[#5a7a66] text-white font-medium px-4 py-2 rounded-full text-sm transition shadow-sm">
                Ajukan Event
            </a>
        @endguest

        @auth
            <!-- TAMPILAN SETELAH LOGIN (USER AUTHENTICATED) -->
            <a href="{{ route('events') }}" class="bg-[#7A9E7E] hover:bg-[#5a7a66] text-white font-medium px-4 py-2 rounded-full text-sm transition shadow-sm">
                Ajukan Event
            </a>

            <!-- Notification Icon dengan Badge Unread -->
            <div class="relative" x-data="{ openNavNotif: false }">
                <button @click="openNavNotif = !openNavNotif" class="text-[#2D1E1E] p-2 hover:bg-black/5 rounded-full transition relative flex items-center justify-center">
                    <i class="fa-regular fa-bell text-xl"></i>
                    <!-- Red Indicator Dot -->
                    <span class="absolute top-1.5 right-1.5 w-2.5 h-2.5 bg-red-500 rounded-full ring-2 ring-[#DEA69E]"></span>
                </button>

                <!-- Dropdown Notification (Opsional) -->
                <div x-show="openNavNotif" 
                     @click.away="openNavNotif = false"
                     x-transition
                     class="absolute right-0 mt-2 w-72 bg-white rounded-2xl shadow-xl py-3 border border-gray-100 z-50 text-sm"
                     style="display: none;">
                    <div class="px-4 py-2 border-b border-gray-100 font-bold text-gray-700 flex justify-between items-center">
                        <span>Notifikasi</span>
                        <span class="text-xs text-[#5F8A6E] font-normal">Tandai dibaca</span>
                    </div>
                    <div class="max-h-60 overflow-y-auto">
                        <a href="#" class="block px-4 py-3 hover:bg-pink-50/50 transition border-b border-gray-50">
                            <p class="text-xs font-semibold text-gray-800">Seminar Kehamilan Dimulai!</p>
                            <p class="text-[11px] text-gray-500 mt-0.5">Sesi webinar Anda akan dimulai 15 menit lagi.</p>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Profile Dropdown -->
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
</nav>