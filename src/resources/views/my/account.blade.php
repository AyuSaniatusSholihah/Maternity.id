<x-layout title="Akun Saya — Maternity.id">
    <x-slot name="head">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <style>
            .card-spring {
                transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1),
                            box-shadow 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            }
            .card-spring:hover {
                transform: translateY(-3px);
            }
        </style>
    </x-slot>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 w-full py-4 sm:py-6 space-y-5 sm:space-y-6">

        {{-- ── 1. Greeting Architectural Banner ── --}}
        <div class="relative bg-gradient-to-r from-[#FCEBE7] via-[#FDF3F0] to-[#FAF0EE] rounded-2xl sm:rounded-3xl p-5 sm:p-7 border border-[#DEA69E]/40 overflow-hidden shadow-xs">
            
            <!-- Subtle Architectural Grid Pattern Background -->
            <div class="absolute inset-0 -z-10 pointer-events-none opacity-30"
                 style="background-size: 20px 20px;
                        background-image: 
                            linear-gradient(to right, rgba(222, 170, 161, 0.3) 1px, transparent 1px),
                            linear-gradient(to bottom, rgba(222, 170, 161, 0.3) 1px, transparent 1px);">
            </div>

            <!-- Corner Plus Markers -->
            <div class="absolute top-2 left-2 text-[#8C433C]/30 select-none pointer-events-none">
                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m7-7H5"/></svg>
            </div>
            <div class="absolute top-2 right-2 text-[#8C433C]/30 select-none pointer-events-none">
                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m7-7H5"/></svg>
            </div>
            <div class="absolute bottom-2 left-2 text-[#8C433C]/30 select-none pointer-events-none">
                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m7-7H5"/></svg>
            </div>
            <div class="absolute bottom-2 right-2 text-[#8C433C]/30 select-none pointer-events-none">
                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m7-7H5"/></svg>
            </div>

            <div class="relative z-10 flex flex-col sm:flex-row items-center sm:items-start gap-4 sm:gap-6">
                {{-- Avatar --}}
                <div class="relative flex-shrink-0">
                    <img src="{{ Auth::user()->profile_img ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=5F8C72&color=fff&size=128' }}"
                         alt="{{ Auth::user()->name }}"
                         class="w-20 h-20 sm:w-24 sm:h-24 rounded-full object-cover border-4 border-white shadow-md">
                    <span class="absolute bottom-1 right-1 w-4 h-4 bg-emerald-500 border-2 border-white rounded-full"></span>
                </div>

                {{-- Info --}}
                <div class="flex-1 text-center sm:text-left">
                    <div class="inline-flex items-center gap-1.5 px-3 py-0.5 rounded-full text-[11px] font-bold bg-[#EBF5EE] text-[#4D7C59] border border-[#BDE0C6] mb-1.5">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#4D7C59] animate-pulse"></span>
                        <span>Member Maternity.id</span>
                    </div>
                    <h1 class="text-2xl sm:text-3xl font-extrabold text-[#2A1614] mb-0.5 leading-snug" style="font-family: 'DM Serif Display', serif;">
                        {{ Auth::user()->name }}
                    </h1>
                    <p class="text-xs sm:text-sm text-neutral-500 mb-3.5">{{ Auth::user()->email }}</p>

                    <div class="flex flex-wrap justify-center sm:justify-start gap-2.5">
                        <a href="{{ route('profile.edit') }}"
                           class="inline-flex items-center gap-1.5 bg-[#8C433C] hover:bg-[#782819] text-white text-xs sm:text-sm font-bold px-4 sm:px-5 py-2 rounded-full transition shadow-2xs hover:shadow-xs">
                            <i class="fa-regular fa-pen-to-square text-xs"></i>
                            <span>Edit Profil</span>
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit"
                                    class="inline-flex items-center gap-1.5 bg-white hover:bg-red-50 text-red-600 border border-red-200 text-xs sm:text-sm font-bold px-4 sm:px-5 py-2 rounded-full transition shadow-2xs">
                                <i class="fa-solid fa-arrow-right-from-bracket text-xs"></i>
                                <span>Keluar</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- ── 2. Stats Row ── --}}
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 sm:gap-4">
            <div class="bg-white rounded-2xl p-3.5 sm:p-4 text-center border border-[#DEA69E]/40 shadow-xs card-spring">
                <p class="text-2xl sm:text-3xl font-extrabold text-[#8C433C]" style="font-family: 'DM Serif Display', serif;">0</p>
                <p class="text-[11px] sm:text-xs text-neutral-500 font-medium mt-0.5">Event Diikuti</p>
            </div>
            <div class="bg-white rounded-2xl p-3.5 sm:p-4 text-center border border-[#DEA69E]/40 shadow-xs card-spring">
                <p class="text-2xl sm:text-3xl font-extrabold text-[#5F8C72]" style="font-family: 'DM Serif Display', serif;">0</p>
                <p class="text-[11px] sm:text-xs text-neutral-500 font-medium mt-0.5">Ebook Diakses</p>
            </div>
            <div class="bg-white rounded-2xl p-3.5 sm:p-4 text-center border border-[#DEA69E]/40 shadow-xs card-spring">
                <p class="text-2xl sm:text-3xl font-extrabold text-[#8C433C]" style="font-family: 'DM Serif Display', serif;">0</p>
                <p class="text-[11px] sm:text-xs text-neutral-500 font-medium mt-0.5">Artikel Favorit</p>
            </div>
            <div class="bg-white rounded-2xl p-3.5 sm:p-4 text-center border border-[#DEA69E]/40 shadow-xs card-spring">
                <p class="text-2xl sm:text-3xl font-extrabold text-[#5F8C72]" style="font-family: 'DM Serif Display', serif;">Aktif</p>
                <p class="text-[11px] sm:text-xs text-neutral-500 font-medium mt-0.5">Status Akun</p>
            </div>
        </div>

        {{-- ── 3. Quick Menu ── --}}
        <div class="space-y-3">
            <div class="flex items-center gap-1.5 px-1">
                <span class="text-[#8C433C] text-sm">✨</span>
                <h2 class="text-base sm:text-lg font-bold text-[#2A1614]" style="font-family: 'DM Serif Display', serif;">
                    Menu Layanan
                </h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-4">

                <a href="{{ route('events') }}"
                   class="bg-white rounded-2xl p-4 flex items-center gap-3.5 border border-[#DEA69E]/40 hover:border-[#8C433C] shadow-xs hover:shadow-md transition card-spring group">
                    <div class="w-11 h-11 rounded-xl bg-[#FAF0EE] flex items-center justify-center text-[#8C433C] group-hover:bg-[#8C433C] group-hover:text-white transition">
                        <i class="fa-solid fa-chalkboard-user text-base"></i>
                    </div>
                    <div>
                        <p class="font-bold text-[#2A1614] text-xs sm:text-sm group-hover:text-[#8C433C] transition">Event & Kelas</p>
                        <p class="text-[11px] text-neutral-400">Jadwal webinar & workshop</p>
                    </div>
                </a>

                <a href="{{ route('library') }}"
                   class="bg-white rounded-2xl p-4 flex items-center gap-3.5 border border-[#DEA69E]/40 hover:border-[#5F8C72] shadow-xs hover:shadow-md transition card-spring group">
                    <div class="w-11 h-11 rounded-xl bg-[#FAF0EE] flex items-center justify-center text-[#5F8C72] group-hover:bg-[#5F8C72] group-hover:text-white transition">
                        <i class="fa-solid fa-book-open text-base"></i>
                    </div>
                    <div>
                        <p class="font-bold text-[#2A1614] text-xs sm:text-sm group-hover:text-[#5F8C72] transition">Ebook & Panduan</p>
                        <p class="text-[11px] text-neutral-400">Akses modul materi digital</p>
                    </div>
                </a>

                <a href="{{ route('product') }}"
                   class="bg-white rounded-2xl p-4 flex items-center gap-3.5 border border-[#DEA69E]/40 hover:border-[#8C433C] shadow-xs hover:shadow-md transition card-spring group">
                    <div class="w-11 h-11 rounded-xl bg-[#FAF0EE] flex items-center justify-center text-[#8C433C] group-hover:bg-[#8C433C] group-hover:text-white transition">
                        <i class="fa-solid fa-bag-shopping text-base"></i>
                    </div>
                    <div>
                        <p class="font-bold text-[#2A1614] text-xs sm:text-sm group-hover:text-[#8C433C] transition">Katalog Produk</p>
                        <p class="text-[11px] text-neutral-400">Belanja produk ibu & anak</p>
                    </div>
                </a>

                <a href="{{ route('articles.index') }}"
                   class="bg-white rounded-2xl p-4 flex items-center gap-3.5 border border-[#DEA69E]/40 hover:border-[#5F8C72] shadow-xs hover:shadow-md transition card-spring group">
                    <div class="w-11 h-11 rounded-xl bg-[#FAF0EE] flex items-center justify-center text-[#5F8C72] group-hover:bg-[#5F8C72] group-hover:text-white transition">
                        <i class="fa-regular fa-newspaper text-base"></i>
                    </div>
                    <div>
                        <p class="font-bold text-[#2A1614] text-xs sm:text-sm group-hover:text-[#5F8C72] transition">Artikel Kesehatan</p>
                        <p class="text-[11px] text-neutral-400">Baca info medis terpercaya</p>
                    </div>
                </a>

                <a href="https://wa.me/6281234567890?text=Halo%20Admin%20Maternity.id,%20saya%20ingin%20konsultasi" target="_blank"
                   class="bg-white rounded-2xl p-4 flex items-center gap-3.5 border border-[#DEA69E]/40 hover:border-emerald-500 shadow-xs hover:shadow-md transition card-spring group">
                    <div class="w-11 h-11 rounded-xl bg-[#FAF0EE] flex items-center justify-center text-emerald-600 group-hover:bg-emerald-600 group-hover:text-white transition">
                        <i class="fa-brands fa-whatsapp text-base"></i>
                    </div>
                    <div>
                        <p class="font-bold text-[#2A1614] text-xs sm:text-sm group-hover:text-emerald-700 transition">Konsultasi Nakes</p>
                        <p class="text-[11px] text-neutral-400">Tanya langsung via WhatsApp</p>
                    </div>
                </a>

                <a href="{{ route('profile.edit') }}"
                   class="bg-white rounded-2xl p-4 flex items-center gap-3.5 border border-[#DEA69E]/40 hover:border-[#2A1614] shadow-xs hover:shadow-md transition card-spring group">
                    <div class="w-11 h-11 rounded-xl bg-[#FAF0EE] flex items-center justify-center text-[#2A1614] group-hover:bg-[#2A1614] group-hover:text-white transition">
                        <i class="fa-regular fa-user text-base"></i>
                    </div>
                    <div>
                        <p class="font-bold text-[#2A1614] text-xs sm:text-sm group-hover:text-[#8C433C] transition">Pengaturan Akun</p>
                        <p class="text-[11px] text-neutral-400">Kelola profil dan kata sandi</p>
                    </div>
                </a>

            </div>
        </div>

    </div>
</x-layout>
