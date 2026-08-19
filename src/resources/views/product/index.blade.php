<x-layout title="Produk Pilihan — Maternity.id" metaDescription="Temukan berbagai produk kesehatan, perlengkapan nakes, dan kebutuhan ibu & bayi berkualitas di Maternity.id.">
    <x-slot name="head">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <style>
            .card-spring {
                transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1),
                            box-shadow 0.3s cubic-bezier(0.16, 1, 0.3, 1),
                            border-color 0.3s ease;
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
        
        <!-- ── 1. COMPACT HERO BANNER (PRODUCT) ── -->
        <div class="relative bg-gradient-to-r from-[#FCEBE7] via-[#FDF3F0] to-[#FAF0EE] rounded-3xl px-6 py-4 sm:px-8 sm:py-5 border border-[#DEA69E]/30 overflow-hidden shadow-xs">
            <!-- Decorative Leaves on Right -->
            <div class="absolute right-64 bottom-0 opacity-25 pointer-events-none select-none hidden lg:block">
                <svg width="70" height="70" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M20 90C20 90 25 40 70 30C70 30 50 65 20 90Z" fill="#A8C4A0" />
                    <path d="M10 65C10 65 30 35 60 40C60 40 40 60 10 65Z" fill="#8BB582" opacity="0.6"/>
                </svg>
            </div>

            <!-- Content Area: Text on Left + Shopping / Product Photo on Right -->
            <div class="relative z-10 flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="space-y-1 text-center sm:text-left max-w-lg">
                    <h1 class="text-2xl sm:text-3xl font-extrabold text-[#8C433C] tracking-tight leading-snug" style="font-family: 'DM Serif Display', serif;">
                        Product & Merchandise
                    </h1>
                    <p class="text-xs sm:text-sm text-[#5C4542] leading-relaxed">
                        Temukan berbagai barang pilihan yang siap mendukung aktivitasmu dan kesehatan ibu & buah hati.
                    </p>
                </div>

                <div class="shrink-0">
                    <div class="w-40 sm:w-52 md:w-60 h-28 sm:h-32 md:h-36 overflow-hidden rounded-2xl shadow-xs border border-white/80">
                        <img src="https://images.unsplash.com/photo-1584515979956-d9f6e5d09982?auto=format&fit=crop&q=80&w=600" 
                             alt="Produk Maternity" 
                             class="w-full h-full object-cover">
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
                <a href="{{ route('product', ['category' => $cat['slug'], 'q' => $searchQuery]) }}"
                   class="shrink-0 flex items-center gap-2 px-5 py-2 rounded-full text-xs sm:text-sm font-semibold transition-all duration-200 {{ $isActive ? 'bg-[#F2C4BA] text-[#782819] font-bold border border-[#C27A6F] shadow-xs' : 'bg-transparent text-[#782819] hover:bg-[#F2C4BA]/50 border border-[#C27A6F]/60' }}">
                    <i class="{{ $cat['icon'] }} text-xs"></i>
                    <span>{{ $cat['name'] }}</span>
                </a>
            @endforeach
        </div>

        <!-- ── 3. SECTION HEADER & SEARCH FILTER ── -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pt-2">
            <div>
                <h2 class="text-xl sm:text-2xl font-extrabold text-[#3D2B2B]" style="font-family: 'DM Serif Display', serif;">
                    Daftar Produk
                </h2>
                <p class="text-xs sm:text-sm text-neutral-600">
                    Menampilkan {{ count($products) }} barang pilihan berkualitas
                </p>
            </div>

            <!-- Search Form -->
            <form action="{{ route('product') }}" method="GET" class="relative max-w-xs w-full">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-[#8C433C]">
                    <i class="fa-solid fa-magnifying-glass text-xs"></i>
                </span>
                <input 
                    type="text" 
                    name="q" 
                    value="{{ $searchQuery }}"
                    placeholder="Cari produk..." 
                    class="w-full pl-9 pr-4 py-2 text-xs sm:text-sm bg-white border border-[#DEA69E]/50 rounded-full placeholder-neutral-400 focus:outline-none focus:ring-2 focus:ring-[#8C433C]/20 transition shadow-2xs"
                >
            </form>
        </div>

        <!-- ── 4. PRODUCT CARDS GRID (IDENTICAL TO LANDING DESIGN) ── -->
        @if(count($products) > 0)
            <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-3 sm:gap-4 lg:gap-5">
                @foreach ($products as $product)
                    <div class="group flex flex-col justify-between bg-white rounded-3xl p-3 shadow-sm card-spring border border-[#DEA69E]/40 hover:border-[#DEA69E]">
                        
                        {{-- Top Area: Image + Details --}}
                        <div>
                            {{-- Image Thumbnail with Overlay Badge --}}
                            <div class="relative w-full aspect-[4/3] rounded-2xl overflow-hidden bg-neutral-100">
                                <img 
                                    src="{{ $product['image'] }}" 
                                    alt="{{ $product['title'] }}" 
                                    class="w-full h-full object-cover group-hover:scale-108 transition-transform duration-700 ease-out"
                                    loading="lazy"
                                />
                                
                                {{-- Floating Tag --}}
                                @if (!empty($product['tag']))
                                    <span class="absolute top-2 left-2 px-2.5 py-0.5 rounded-full bg-[#F2C4BA]/95 backdrop-blur-sm text-[10px] font-bold text-[#782819] shadow-xs group-hover:bg-[#DEA69E] transition-colors">
                                        {{ $product['tag'] }}
                                    </span>
                                @endif
                            </div>

                            {{-- Card Info --}}
                            <div class="pt-3.5 pb-2 px-1 space-y-1.5">
                                <h3 class="font-bold text-sm text-[#2D1E1E] line-clamp-1 group-hover:text-[#8C433C] transition-colors">
                                    {{ $product['title'] }}
                                </h3>

                                {{-- Location --}}
                                <div class="flex items-center gap-1 text-[#8C433C] text-xs font-medium">
                                    <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <span class="text-neutral-500 text-[11px]">{{ $product['location'] }}</span>
                                </div>

                                {{-- Price --}}
                                <div class="pt-1 flex items-center justify-between">
                                    <span class="text-base font-extrabold text-[#3D2B2B] tracking-tight">
                                        {{ $product['price'] }}
                                    </span>
                                    @if(!empty($product['sold']))
                                        <span class="text-[10px] text-neutral-400 font-medium">
                                            Terjual {{ $product['sold'] }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Bottom Action: TikTok Button --}}
                        <div class="pt-2">
                            <a 
                                href="{{ $product['tiktok_url'] }}" 
                                onclick="alert('Membuka produk {{ $product['title'] }} di etalase TikTok Shop...')"
                                class="w-full bg-[#FAF0EE] hover:bg-[#8C433C] text-[#782819] hover:text-white rounded-xl font-bold py-2.5 px-3 text-xs tracking-wide transition-all duration-300 flex items-center justify-between shadow-xs border border-[#DEA69E]/50 hover:border-[#8C433C] group/btn">
                                <div class="flex items-center gap-1.5 mx-auto">
                                    {{-- TikTok Icon --}}
                                    <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24">
                                        <path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64c.29 0 .58.04.85.11V9.4a6.33 6.33 0 0 0-.85-.05A6.34 6.34 0 0 0 3 15.69a6.34 6.34 0 0 0 10.82 4.47 6.3 6.3 0 0 0 1.86-4.49v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-.86-.1z"/>
                                    </svg>
                                    <span>Lihat di TikTok</span>
                                </div>
                                <svg class="w-3.5 h-3.5 flex-shrink-0 transition-transform duration-300 group-hover/btn:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </a>
                        </div>

                    </div>
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            <div class="bg-white rounded-3xl p-10 text-center border border-[#DEA69E]/30 max-w-md mx-auto space-y-3">
                <div class="w-14 h-14 bg-[#FAF0EE] rounded-full flex items-center justify-center mx-auto text-[#8C433C] text-xl">
                    <i class="fa-solid fa-box-open"></i>
                </div>
                <h3 class="text-base font-bold text-[#2A1614]">Produk Tidak Ditemukan</h3>
                <p class="text-xs text-neutral-500">
                    Maaf, tidak ada produk yang cocok dengan pencarian Anda. Silakan coba kategori atau kata kunci lain.
                </p>
                <a href="{{ route('product') }}" class="inline-block px-4 py-2 bg-[#8C433C] text-white text-xs font-bold rounded-full hover:bg-[#782819] transition">
                    Lihat Semua Produk
                </a>
            </div>
        @endif

    </div>
</x-layout>
