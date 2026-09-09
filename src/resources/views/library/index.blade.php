<x-layout title="Ebook & Panduan Digital — Maternity.id" metaDescription="Download ebook dan panduan praktis seputar kehamilan, persalinan, nutrisi, hingga perawatan bayi baru lahir secara gratis.">
    <x-slot name="head">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <style>
            .card-spring {
                transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1),
                            box-shadow 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            }
            .card-spring:hover {
                transform: translateY(-5px);
            }
            .no-scrollbar::-webkit-scrollbar {
                display: none;
            }
            .no-scrollbar {
                -ms-overflow-style: none;
                scrollbar-width: none;
            }
        </style>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full py-2 sm:py-4 space-y-5 sm:space-y-6">
        
        <!-- ── 1. HERO BANNER (EBOOK UNTUK PERJALANANMU) ── -->
        <div class="relative bg-gradient-to-r from-[#FCEBE7] via-[#FDF3F0] to-[#FAF0EE] rounded-2xl sm:rounded-3xl px-5 py-4 sm:px-8 sm:py-5 border border-[#DEA69E]/40 overflow-hidden shadow-xs">
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

            <!-- Content Area: Text on Left + Woman Reading & Book Doodle on Right -->
            <div class="relative z-10 flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="space-y-1 text-center sm:text-left max-w-lg">
                    <span class="inline-block px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-[#FAF0EE] text-[#8C433C] border border-[#DEA69E]/50 mb-1">
                        📚 E-Library Digital
                    </span>
                    <h1 class="text-2xl sm:text-3xl font-extrabold text-[#8C433C] tracking-tight leading-snug" style="font-family: 'DM Serif Display', serif;">
                        Ebook untuk Perjalananmu
                    </h1>
                    <p class="text-xs sm:text-sm text-[#5C4542] leading-relaxed">
                        Panduan praktis dan inspiratif seputar kehamilan, persalinan, hingga perawatan bayi.
                    </p>
                </div>

                <div class="flex items-center gap-4 shrink-0">
                    <!-- Woman with Tablet Image -->
                    <div class="w-36 sm:w-44 md:w-52 h-28 sm:h-32 md:h-36 overflow-hidden rounded-2xl shadow-xs border border-white/80">
                        <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&q=80&w=600" 
                             alt="Ibu Membaca Tablet" 
                             class="w-full h-full object-cover">
                    </div>

                    <!-- Book Doodle Container -->
                    <div class="w-24 sm:w-28 h-28 sm:h-32 bg-white/70 backdrop-blur-sm rounded-2xl border border-[#DEA69E]/50 flex flex-col items-center justify-center p-2 shadow-2xs hidden min-[480px]:flex text-[#8C433C]">
                        <div class="w-10 h-10 rounded-full bg-[#FAF0EE] flex items-center justify-center mb-1 text-base">
                            <i class="fa-solid fa-book-open"></i>
                        </div>
                        <span class="text-[10px] font-bold text-[#8C433C] text-center leading-tight">E-Library PDF</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- ── 2. CATEGORY FILTER TABS (PILLS) ── -->
        <div class="flex items-center gap-2 overflow-x-auto pb-1 no-scrollbar">
            @foreach ($categories as $cat)
                @php
                    $isActive = ($currentCategory === $cat['slug']);
                @endphp
                <a href="{{ route('library', ['category' => $cat['slug'], 'sort' => $currentSort]) }}"
                   class="shrink-0 flex items-center gap-2 px-4 py-2 rounded-full text-xs font-semibold transition-all duration-200 {{ $isActive ? 'bg-[#8C433C] text-white shadow-xs' : 'bg-white hover:bg-[#FAF0EE] border border-[#DEA69E]/50 text-neutral-700 hover:text-[#8C433C] shadow-2xs' }}">
                    <i class="{{ $cat['icon'] }} text-xs {{ $isActive ? 'text-white' : 'text-[#8C433C]' }}"></i>
                    <span>{{ $cat['name'] }}</span>
                </a>
            @endforeach
        </div>

        <!-- ── 3. SECTION HEADER & SORT / DATE CONTROLS ── -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pt-2">
            <div>
                <h2 class="text-xl sm:text-2xl font-extrabold text-[#2A1614]" style="font-family: 'DM Serif Display', serif;">
                    Semua Ebook
                </h2>
                <p class="text-xs sm:text-sm text-neutral-500 mt-0.5">
                    Temukan berbagai ebook pilihan terbaik untuk mendukungmu.
                </p>
            </div>

            <!-- Sort Dropdown & Date Button -->
            <div class="flex items-center gap-2.5 self-start sm:self-auto">
                <!-- Sort Dropdown -->
                <div class="relative" x-data="{ openSort: false }">
                    <button @click="openSort = !openSort" 
                            class="flex items-center gap-2 px-3.5 py-1.5 bg-white rounded-xl border border-[#DEA69E]/40 text-xs font-semibold text-[#2A1614] shadow-2xs hover:border-[#8C433C] transition">
                        <span>Urutkan: {{ $currentSort === 'popular' ? 'Terpopuler' : 'Terbaru' }}</span>
                        <i class="fa-solid fa-chevron-down text-[10px] text-neutral-400"></i>
                    </button>

                    <div x-show="openSort" 
                         @click.away="openSort = false"
                         x-transition
                         class="absolute right-0 mt-2 w-36 bg-white rounded-xl shadow-lg border border-gray-100 py-1 z-30 text-xs"
                         style="display: none;">
                        <a href="{{ route('library', ['sort' => 'latest', 'category' => $currentCategory]) }}" class="block px-3 py-1.5 hover:bg-[#FAF0EE] hover:text-[#8C433C] font-medium">Terbaru</a>
                        <a href="{{ route('library', ['sort' => 'popular', 'category' => $currentCategory]) }}" class="block px-3 py-1.5 hover:bg-[#FAF0EE] hover:text-[#8C433C] font-medium">Terpopuler</a>
                    </div>
                </div>

                <!-- Date Filter Button -->
                <button type="button" 
                        class="flex items-center gap-1.5 px-3.5 py-1.5 bg-white rounded-xl border border-[#DEA69E]/40 text-xs font-semibold text-[#2A1614] shadow-2xs hover:border-[#8C433C] transition">
                    <i class="fa-regular fa-calendar text-[#8C433C]"></i>
                    <span>Semua Waktu</span>
                </button>
            </div>
        </div>

        <!-- ── 4. EBOOK CARDS GRID (IDENTICAL TO LANDING DESIGN) ── -->
        @if(count($ebooks) > 0)
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-3.5 sm:gap-6">
                @foreach ($ebooks as $product)
                    <x-ebook_card :ebook="$product" />
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            <div class="bg-white rounded-3xl p-10 text-center border border-[#DEA69E]/30 max-w-md mx-auto space-y-3">
                <div class="w-14 h-14 bg-[#FAF0EE] rounded-full flex items-center justify-center mx-auto text-[#8C433C] text-xl">
                    <i class="fa-solid fa-book-open"></i>
                </div>
                <h3 class="text-base font-bold text-[#2A1614]">Belum Ada Ebook di Kategori Ini</h3>
                <p class="text-xs text-neutral-500">
                    Silakan pilih kategori lain atau lihat semua ebook panduan yang tersedia.
                </p>
                <a href="{{ route('library', ['category' => 'all']) }}" class="inline-block px-4 py-2 bg-[#8C433C] text-white text-xs font-bold rounded-full hover:bg-[#782819] transition">
                    Lihat Semua Ebook
                </a>
            </div>
        @endif

        <!-- ── 5. GRID HERO ARCHITECTURAL BANNER (E-LIBRARY & WRITERS) ── -->
        <div class="pt-6 pb-2">
            <x-grid_hero_banner 
                badge="Koleksi E-Book & Modul Medis"
                title="Punya Naskah atau Modul Edukasi Kehamilan?"
                subtitle="Maternity.id membuka kesempatan bagi dokter spesialis, bidan, konselor laktasi, dan penulis kesehatan untuk mempublikasikan e-book edukasi kepada ribuan ibu di Indonesia."
                primaryText="Kirim Naskah E-Book"
                primaryUrl="https://wa.me/6281234567890?text=Halo%20Maternity.id,%20saya%20ingin%20mengajukan%20naskah%20ebook%20kesehatan"
                primaryIcon="book-open"
                secondaryText="Konsultasi Kurasi"
                secondaryUrl="https://wa.me/6281234567890?text=Halo%20Maternity.id,%20tanya%20info%20kurasi%20modul"
                avatarUrl="https://images.unsplash.com/photo-1576765608535-5f04d1e3f289?auto=format&fit=crop&q=80&w=600"
                avatarAlt="E-Book Maternity.id"
                caption="Koleksi E-Book & Riset Medis Terbuka"
            />
        </div>

    </div>
</x-layout>
