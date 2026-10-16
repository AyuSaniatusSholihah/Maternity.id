{{--
    Floating Social Media FAB (Kanan Bawah)
    Expandable: klik tombol utama → tampil IG + WA
    Dipakai di: events/index, library/index, product/index
--}}
<div x-data="{ openFab: false }"
     @click.away="openFab = false"
     class="fixed bottom-16 right-3 sm:bottom-8 sm:right-8 z-50 flex flex-col items-end gap-2.5 select-none">

    {{-- Sub-menu items --}}
    <div x-show="openFab"
         x-transition:enter="transition ease-out duration-300 transform"
         x-transition:enter-start="opacity-0 translate-y-4 scale-90"
         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
         x-transition:leave="transition ease-in duration-200 transform"
         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
         x-transition:leave-end="opacity-0 translate-y-4 scale-90"
         class="flex flex-col items-end gap-2"
         style="display: none;">

        {{-- Instagram --}}
        <a href="https://instagram.com/maternity.id" target="_blank"
           class="flex items-center gap-2 bg-gradient-to-r from-[#f9ce34] via-[#ee2a7b] to-[#6228d7] text-white px-3.5 py-2 rounded-full shadow-[0_8px_20px_rgba(238,42,123,0.35)] border border-white transition-all transform hover:scale-105 active:scale-95 text-[11px] font-bold group">
            <span class="hidden sm:inline">Instagram</span>
            <span class="w-6 h-6 rounded-full bg-white/20 flex items-center justify-center">
                <i class="fa-brands fa-instagram text-xs"></i>
            </span>
        </a>

        {{-- WhatsApp --}}
        <a href="https://wa.me/" target="_blank"
           class="flex items-center gap-2 bg-[#25D366] hover:bg-[#20ba5a] text-white px-3.5 py-2 rounded-full shadow-[0_8px_20px_rgba(37,211,102,0.35)] border border-white transition-all transform hover:scale-105 active:scale-95 text-[11px] font-bold group">
            <span class="hidden sm:inline">WhatsApp Kami</span>
            <span class="w-6 h-6 rounded-full bg-white/20 flex items-center justify-center">
                <i class="fa-brands fa-whatsapp text-sm"></i>
            </span>
        </a>
    </div>

    {{-- Main Trigger Button --}}
    <button type="button"
            @click="openFab = !openFab"
            class="w-11 h-11 sm:w-14 sm:h-14 bg-gradient-to-tr from-[#C27A6F] to-[#8C433C] hover:from-[#8C433C] hover:to-[#782819] text-white rounded-full flex items-center justify-center shadow-[0_12px_28px_rgba(140,67,60,0.4)] border-2 border-white transition-all transform hover:scale-110 active:scale-95 focus:outline-none relative group"
            aria-label="Hubungi & Menu Cepat"
            title="Bantuan & Layanan">
        <i class="fa-solid text-base sm:text-2xl transition-transform duration-300"
           :class="openFab ? 'fa-xmark rotate-90 text-white' : 'fa-comment-dots group-hover:scale-110'"></i>
    </button>

</div>
