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
        <div class="relative bg-gradient-to-r from-[#FCEBE7] via-[#FDF3F0] to-[#FAF0EE] rounded-3xl px-6 py-4 sm:px-8 sm:py-5 border border-[#DEA69E]/30 overflow-hidden shadow-xs">
            <!-- Decorative Leaves on Left -->
            <div class="absolute left-64 bottom-0 opacity-25 pointer-events-none select-none hidden lg:block">
                <svg width="70" height="70" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M20 90C20 90 25 40 70 30C70 30 50 65 20 90Z" fill="#A8C4A0" />
                    <path d="M10 65C10 65 30 35 60 40C60 40 40 60 10 65Z" fill="#8BB582" opacity="0.6"/>
                </svg>
            </div>

            <!-- Content Area: Text on Left + Woman Reading & Book Doodle on Right -->
            <div class="relative z-10 flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="space-y-1 text-center sm:text-left max-w-lg">
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
                    <div class="group flex flex-col bg-white rounded-2xl sm:rounded-3xl overflow-hidden shadow-sm card-spring border border-[#DEA69E]/50 hover:border-[#DEA69E]">
                        
                        {{-- Top Header (Background transparan menyatu dengan card putih) --}}
                        <div class="pt-4 sm:pt-7 pb-2.5 sm:pb-4 px-2 sm:px-4 text-center bg-transparent">
                            <h2 class="font-serif italic font-extrabold text-sm min-[400px]:text-base sm:text-2xl text-[#8C433C] group-hover:text-[#782819] leading-tight group-hover:scale-105 transition-all duration-300" style="font-family: 'DM Serif Display', serif;">
                                {!! nl2br(e($product['title'])) !!}
                            </h2>
                        </div>

                        {{-- Arched Terracotta/Rose Body Section (Identik dengan Landing) --}}
                        <div class="flex-1 bg-[#C27A6F] rounded-t-[45px] sm:rounded-t-[80px] pt-4 sm:pt-7 pb-4 sm:pb-6 px-2 sm:px-4 flex flex-col items-center justify-between text-center shadow-inner">
                            
                            {{-- Realistic Tablet Mockup --}}
                            <div class="w-20 min-[400px]:w-24 sm:w-32 aspect-[3/4] bg-neutral-900 rounded-lg sm:rounded-xl p-1 sm:p-1.5 shadow-2xl border border-neutral-800 relative group-hover:scale-110 group-hover:-rotate-1.5 transition-all duration-500">
                                {{-- Camera indicator --}}
                                <div class="w-1 h-1 sm:w-1.5 sm:h-1.5 bg-neutral-700 rounded-full mx-auto mb-0.5 sm:mb-1"></div>
                                
                                {{-- Screen Display --}}
                                <div class="w-full h-[calc(100%-8px)] sm:h-[calc(100%-10px)] bg-white rounded-md sm:rounded-lg p-1.5 sm:p-2 flex flex-col items-center justify-between overflow-hidden shadow-inner text-left">
                                    <img 
                                        src="{{ $product['cover'] }}" 
                                        alt="Cover" 
                                        class="w-full h-10 min-[400px]:h-12 sm:h-16 object-cover rounded"
                                    />
                                    <div class="w-full mt-0.5 sm:mt-1">
                                        <p class="text-[5px] min-[400px]:text-[5.5px] sm:text-[6.5px] font-bold text-neutral-800 leading-tight line-clamp-2 sm:line-clamp-3">
                                            {{ $product['book_title'] }}
                                        </p>
                                        <p class="text-[4px] min-[400px]:text-[4.5px] sm:text-[5.5px] text-neutral-500 mt-0.5 truncate">
                                            written by {{ $product['author'] }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            {{-- Metadata & Price --}}
                            <div class="mt-2.5 sm:mt-4 space-y-0.5 text-white">
                                <p class="text-[10px] sm:text-xs font-bold tracking-tight">
                                    Available for {{ $product['price'] }}
                                </p>
                                <p class="text-[8.5px] sm:text-[11px] font-medium text-pink-100/90 lowercase tracking-wide">
                                    {{ $product['link_text'] }}
                                </p>

                                @if (!empty($product['handle']))
                                    <div class="pt-1 sm:pt-2">
                                        <span class="inline-block px-2 sm:px-3 py-0.5 rounded-full border border-white/40 bg-white/15 backdrop-blur-sm text-[7.5px] sm:text-[9px] text-white/95 font-mono group-hover:bg-white/25 transition-colors truncate max-w-full">
                                            {{ $product['handle'] }}
                                        </span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        {{-- Bottom Action Button --}}
                        <a 
                            href="{{ $product['url'] }}" 
                            onclick="alert('Membuka e-book {{ $product['book_title'] }}...')"
                            class="w-full bg-[#FAF0EE] hover:bg-[#8C433C] text-[#782819] hover:text-white text-center font-bold py-2 sm:py-3.5 text-xs sm:text-sm transition-all duration-300 block border-t border-[#DEA69E]/40 shadow-xs">
                            {{ $product['btn_text'] }}
                        </a>
                    </div>
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

    </div>
</x-layout>
