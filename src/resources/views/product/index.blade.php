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

    <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8 w-full py-2 sm:py-4 space-y-4 sm:space-y-6">
        
        <!-- ── 1. COMPACT HERO BANNER (PRODUCT) ── -->
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

            <!-- Content Area: Text on Left + Shopping / Product Photo on Right -->
            <div class="relative z-10 flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="space-y-1 text-center sm:text-left max-w-lg">
                    <span class="inline-block px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-[#FAF0EE] text-[#8C433C] border border-[#DEA69E]/50 mb-1">
                        🛍 Produk & Perlengkapan
                    </span>
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
            <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-2.5 sm:gap-4 lg:gap-5">
                @foreach ($products as $product)
                    <x-product_card :product="$product" />
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

        <!-- ── 5. GRID HERO ARCHITECTURAL BANNER (MERCHANT / PARTNERSHIP) ── -->
        <div class="pt-6 pb-2">
            <x-grid_hero_banner 
                badge="Kemitraan Merchant & Brand"
                title="Pasarkan Produk Kesehatan Ibu & Anak Bersama Kami"
                subtitle="Jangkau puluhan ribu bidan, perawat maternitas, dan ibu hamil di seluruh pelosok Indonesia melalui etalase kurasi terpercaya Maternity.id."
                primaryText="Daftar Menjadi Mitra"
                primaryUrl="https://wa.me/6281234567890?text=Halo%20Maternity.id,%20saya%20ingin%20bermitra%20produk%20kesehatan"
                primaryIcon="store"
                secondaryText="Konsultasi Kurasi"
                secondaryUrl="https://wa.me/6281234567890?text=Halo%20Maternity.id,%20info%20katalog%20produk"
                avatarUrl="https://images.unsplash.com/photo-1584515979956-d9f6e5d09982?auto=format&fit=crop&q=80&w=600"
                avatarAlt="Produk Maternity.id"
                caption="Katalog Produk Pilihan & Teruji Klinis"
            />
        </div>

    </div>

    {{-- Floating Social Media (Kanan Bawah) --}}
    <x-floating_social />

</x-layout>
