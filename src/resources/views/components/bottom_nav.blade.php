{{-- ─── BOTTOM NAVIGATION DOCK (MATERNITY.ID) ───────────────────────────
    Floating pill bottom navigation yang elegan, responsif, dan memudahkan akses
    ke Home, Events, Library, Artikel, dan Product tanpa membebani Header.
────────────────────────────────────────────────────────────────────── --}}
<div class="fixed bottom-5 left-1/2 -translate-x-1/2 z-40 w-[92%] max-w-md sm:max-w-lg transition-all duration-300">
    <nav class="bg-[#FAF0EE]/80 backdrop-blur-2xl border border-white/90 shadow-[0_15px_35px_rgba(120,40,25,0.18),inset_0_1px_1px_rgba(255,255,255,0.8)] rounded-full px-3 sm:px-5 py-2 flex items-center justify-between gap-1 sm:gap-2 ring-1 ring-black/5">
        
        <!-- 1. Home -->
        <a href="{{ route('home') }}"
           class="group relative flex flex-col sm:flex-row items-center justify-center gap-1 sm:gap-2 py-2 px-2.5 sm:px-3.5 rounded-full transition-all duration-300 ease-[cubic-bezier(0.34,1.56,0.64,1)] transform hover:-translate-y-2 hover:scale-115 active:scale-95 active:translate-y-0 {{ request()->routeIs('home') ? 'bg-white/80 backdrop-blur-xl border border-white text-[#782819] font-bold shadow-[inset_0_1px_2px_rgba(255,255,255,1),0_4px_14px_rgba(140,67,60,0.18)] ring-1 ring-white/60' : 'bg-white/40 hover:bg-white/70 backdrop-blur-md border border-white/60 hover:border-white text-[#5C4542] hover:text-[#782819] shadow-[inset_0_1px_1px_rgba(255,255,255,0.7),0_2px_8px_rgba(0,0,0,0.03)] hover:shadow-[inset_0_1px_2px_rgba(255,255,255,1),0_12px_24px_rgba(140,67,60,0.22)]' }}">
            <i class="fa-solid fa-house text-sm sm:text-base transition-transform duration-300 group-hover:scale-120 {{ request()->routeIs('home') ? 'text-[#8C433C]' : '' }}"></i>
            <span class="text-[10px] sm:text-xs font-semibold">Home</span>
            @if(request()->routeIs('home'))
                <span class="absolute -top-1 left-1/2 -translate-x-1/2 w-1.5 h-1.5 bg-[#8C433C] rounded-full hidden sm:block"></span>
            @endif
        </a>

        <!-- 2. Events -->
        <a href="{{ route('events') }}"
           class="group relative flex flex-col sm:flex-row items-center justify-center gap-1 sm:gap-2 py-2 px-2.5 sm:px-3.5 rounded-full transition-all duration-300 ease-[cubic-bezier(0.34,1.56,0.64,1)] transform hover:-translate-y-2 hover:scale-115 active:scale-95 active:translate-y-0 {{ request()->routeIs('events*') ? 'bg-white/80 backdrop-blur-xl border border-white text-[#782819] font-bold shadow-[inset_0_1px_2px_rgba(255,255,255,1),0_4px_14px_rgba(140,67,60,0.18)] ring-1 ring-white/60' : 'bg-white/40 hover:bg-white/70 backdrop-blur-md border border-white/60 hover:border-white text-[#5C4542] hover:text-[#782819] shadow-[inset_0_1px_1px_rgba(255,255,255,0.7),0_2px_8px_rgba(0,0,0,0.03)] hover:shadow-[inset_0_1px_2px_rgba(255,255,255,1),0_12px_24px_rgba(140,67,60,0.22)]' }}">
            <i class="fa-regular fa-calendar text-sm sm:text-base transition-transform duration-300 group-hover:scale-120 {{ request()->routeIs('events*') ? 'text-[#8C433C]' : '' }}"></i>
            <span class="text-[10px] sm:text-xs font-semibold">Event</span>
            @if(request()->routeIs('events*'))
                <span class="absolute -top-1 left-1/2 -translate-x-1/2 w-1.5 h-1.5 bg-[#8C433C] rounded-full hidden sm:block"></span>
            @endif
        </a>

        <!-- 3. Library -->
        <a href="{{ route('library') }}"
           class="group relative flex flex-col sm:flex-row items-center justify-center gap-1 sm:gap-2 py-2 px-2.5 sm:px-3.5 rounded-full transition-all duration-300 ease-[cubic-bezier(0.34,1.56,0.64,1)] transform hover:-translate-y-2 hover:scale-115 active:scale-95 active:translate-y-0 {{ request()->routeIs('library*') ? 'bg-white/80 backdrop-blur-xl border border-white text-[#782819] font-bold shadow-[inset_0_1px_2px_rgba(255,255,255,1),0_4px_14px_rgba(140,67,60,0.18)] ring-1 ring-white/60' : 'bg-white/40 hover:bg-white/70 backdrop-blur-md border border-white/60 hover:border-white text-[#5C4542] hover:text-[#782819] shadow-[inset_0_1px_1px_rgba(255,255,255,0.7),0_2px_8px_rgba(0,0,0,0.03)] hover:shadow-[inset_0_1px_2px_rgba(255,255,255,1),0_12px_24px_rgba(140,67,60,0.22)]' }}">
            <svg class="w-4 h-4 sm:w-5 sm:h-5 transition-transform duration-300 group-hover:scale-120 {{ request()->routeIs('library*') ? 'text-[#8C433C]' : 'text-current' }}" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M5.5 3C5.89782 3 6.27936 3.15804 6.56066 3.43934C6.84196 3.72064 7 4.10218 7 4.5V19.5C7 19.8978 6.84196 20.2794 6.56066 20.5607C6.27936 20.842 5.89782 21 5.5 21H3.5C3.10218 21 2.72064 20.842 2.43934 20.5607C2.15804 20.2794 2 19.8978 2 19.5V4.5C2 4.10218 2.15804 3.72064 2.43934 3.43934C2.72064 3.15804 3.10218 3 3.5 3H5.5ZM11.5 3C11.8978 3 12.2794 3.15804 12.5607 3.43934C12.842 3.72064 13 4.10218 13 4.5V19.5C13 19.8978 12.842 20.2794 12.5607 20.5607C12.2794 20.842 11.8978 21 11.5 21H9.5C9.10218 21 8.72064 20.842 8.43934 20.5607C8.15804 20.2794 8 19.8978 8 19.5V4.5C8 4.10218 8.15804 3.72064 8.43934 3.43934C8.72064 3.15804 9.10218 3 9.5 3H11.5ZM18.781 6.124L21.995 18.643C22.044 18.8338 22.0549 19.0324 22.0272 19.2274C21.9994 19.4225 21.9335 19.6101 21.8332 19.7797C21.7329 19.9493 21.6002 20.0974 21.4427 20.2157C21.2851 20.334 21.1058 20.42 20.915 20.469L19.039 20.949C18.8482 20.998 18.6496 21.0089 18.4546 20.9812C18.2595 20.9534 18.0719 20.8875 17.9023 20.7872C17.7327 20.6869 17.5846 20.5542 17.4663 20.3967C17.348 20.2391 17.262 20.0598 17.213 19.869L13.999 7.354C13.95 7.16319 13.9391 6.96459 13.9668 6.76956C13.9946 6.57452 14.0605 6.38686 14.1608 6.2173C14.2611 6.04774 14.3938 5.89959 14.5513 5.78132C14.7089 5.66305 14.8882 5.57697 15.079 5.528L16.955 5.045C17.1458 4.996 17.3444 4.98507 17.5394 5.01283C17.7345 5.04059 17.9221 5.10649 18.0917 5.20678C18.2613 5.30707 18.4094 5.43978 18.5277 5.59733C18.646 5.75488 18.732 5.93318 18.781 6.124Z" fill="currentColor"/>
            </svg>
            <span class="text-[10px] sm:text-xs font-semibold">Library</span>
            @if(request()->routeIs('library*'))
                <span class="absolute -top-1 left-1/2 -translate-x-1/2 w-1.5 h-1.5 bg-[#8C433C] rounded-full hidden sm:block"></span>
            @endif
        </a>

        <!-- 4. Artikel (Pusat Edukasi & SEO) -->
        <a href="{{ route('articles.index') }}"
           class="group relative flex flex-col sm:flex-row items-center justify-center gap-1 sm:gap-2 py-2 px-2.5 sm:px-3.5 rounded-full transition-all duration-300 ease-[cubic-bezier(0.34,1.56,0.64,1)] transform hover:-translate-y-2 hover:scale-115 active:scale-95 active:translate-y-0 {{ request()->routeIs('articles*') ? 'bg-white/80 backdrop-blur-xl border border-white text-[#782819] font-bold shadow-[inset_0_1px_2px_rgba(255,255,255,1),0_4px_14px_rgba(140,67,60,0.18)] ring-1 ring-white/60' : 'bg-white/40 hover:bg-white/70 backdrop-blur-md border border-white/60 hover:border-white text-[#5C4542] hover:text-[#782819] shadow-[inset_0_1px_1px_rgba(255,255,255,0.7),0_2px_8px_rgba(0,0,0,0.03)] hover:shadow-[inset_0_1px_2px_rgba(255,255,255,1),0_12px_24px_rgba(140,67,60,0.22)]' }}">
            <i class="fa-regular fa-newspaper text-sm sm:text-base transition-transform duration-300 group-hover:scale-120 {{ request()->routeIs('articles*') ? 'text-[#8C433C]' : '' }}"></i>
            <span class="text-[10px] sm:text-xs font-semibold">Artikel</span>
            @if(request()->routeIs('articles*'))
                <span class="absolute -top-1 left-1/2 -translate-x-1/2 w-1.5 h-1.5 bg-[#8C433C] rounded-full hidden sm:block"></span>
            @endif
        </a>

        <!-- 5. Product -->
        <a href="{{ route('product') }}"
           class="group relative flex flex-col sm:flex-row items-center justify-center gap-1 sm:gap-2 py-2 px-2.5 sm:px-3.5 rounded-full transition-all duration-300 ease-[cubic-bezier(0.34,1.56,0.64,1)] transform hover:-translate-y-2 hover:scale-115 active:scale-95 active:translate-y-0 {{ request()->routeIs('product*') ? 'bg-white/80 backdrop-blur-xl border border-white text-[#782819] font-bold shadow-[inset_0_1px_2px_rgba(255,255,255,1),0_4px_14px_rgba(140,67,60,0.18)] ring-1 ring-white/60' : 'bg-white/40 hover:bg-white/70 backdrop-blur-md border border-white/60 hover:border-white text-[#5C4542] hover:text-[#782819] shadow-[inset_0_1px_1px_rgba(255,255,255,0.7),0_2px_8px_rgba(0,0,0,0.03)] hover:shadow-[inset_0_1px_2px_rgba(255,255,255,1),0_12px_24px_rgba(140,67,60,0.22)]' }}">
            <i class="fa-solid fa-box-open text-sm sm:text-base transition-transform duration-300 group-hover:scale-120 {{ request()->routeIs('product*') ? 'text-[#8C433C]' : '' }}"></i>
            <span class="text-[10px] sm:text-xs font-semibold">Produk</span>
            @if(request()->routeIs('product*'))
                <span class="absolute -top-1 left-1/2 -translate-x-1/2 w-1.5 h-1.5 bg-[#8C433C] rounded-full hidden sm:block"></span>
            @endif
        </a>

    </nav>
</div>
