<x-layout title="Artikel & Informasi — Maternity.id" metaDescription="Temukan informasi dan artikel kesehatan kehamilan, persalinan, nutrisi, hingga perawatan bayi terpercaya dari para ahli.">
    <x-slot name="head">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <style>
            .card-spring {
                transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1),
                            box-shadow 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            }
            .card-spring:hover {
                transform: translateY(-4px);
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

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full py-2 sm:py-4 space-y-4 sm:space-y-6">
        
        <!-- ── 1. COMPACT HERO BANNER (ARTIKEL & INFORMASI) ── -->
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

            <!-- Content Area: Text on Left + Compact Image on Right -->
            <div class="relative z-10 flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="space-y-1 text-center sm:text-left max-w-lg">
                    <span class="inline-block px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-[#EBF5EE] text-[#4D7C59] border border-[#BDE0C6] mb-1">
                        ✍️ Edukasi Terpercaya
                    </span>
                    <h1 class="text-2xl sm:text-3xl font-extrabold text-[#8C433C] tracking-tight leading-snug" style="font-family: 'DM Serif Display', serif;">
                        Artikel & Informasi
                    </h1>
                    <p class="text-xs sm:text-sm text-[#5C4542] leading-relaxed">
                        Temukan informasi dan artikel kesehatan kehamilan dan tumbuh kembang anak terpercaya dari para ahli.
                    </p>
                </div>

                <div class="shrink-0">
                    <div class="w-36 sm:w-52 md:w-60 h-24 sm:h-32 md:h-36 overflow-hidden rounded-2xl shadow-xs border border-white/80">
                        <img src="https://images.unsplash.com/photo-1555252333-9f8e92e65df9?auto=format&fit=crop&q=80&w=600" 
                             alt="Ibu dan Bayi" 
                             class="w-full h-full object-cover">
                    </div>
                </div>
            </div>
        </div>

        <!-- ── 2. CATEGORY PILL FILTER TABS (HIDDEN) ── -->
        <div class="hidden flex items-center gap-2.5 overflow-x-auto pb-1 no-scrollbar">
            @foreach ($categories as $cat)
                @php
                    $isActive = ($currentCategory === $cat['slug']);
                @endphp
                <a href="{{ route('articles.index', ['category' => $cat['slug'], 'q' => $searchQuery]) }}"
                   class="shrink-0 px-4 sm:px-5 py-2 rounded-full text-xs font-semibold transition-all duration-200 {{ $isActive ? 'bg-[#5F8C72] text-white shadow-xs' : 'bg-white border border-[#EADBDB] text-neutral-800 hover:bg-[#FAF0EE]' }}">
                    {{ $cat['name'] }}
                </a>
            @endforeach
        </div>

        <!-- ── 3. MAIN CONTENT GRID (LEFT ARTICLES + RIGHT SIDEBAR) ── -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-5 sm:gap-6 items-start">
            
            <!-- ════════════════════ LEFT COLUMN (8 COLS) ════════════════════ -->
            <div class="lg:col-span-8 space-y-5 sm:space-y-6">
                
                <!-- ── FEATURED SPOTLIGHT ARTICLE CARD ── -->
                @if($featuredArticle)
                    <div class="bg-white rounded-3xl p-3.5 sm:p-5 border border-[#DEA69E]/30 shadow-xs grid grid-cols-1 md:grid-cols-12 gap-4 sm:gap-5 items-center card-spring">
                        <!-- Image Side -->
                        <div class="md:col-span-6 h-44 sm:h-56 rounded-2xl overflow-hidden bg-neutral-100">
                            <img src="{{ $featuredArticle['thumbnail_image'] ?? 'https://images.unsplash.com/photo-1555252333-9f8e92e65df9?auto=format&fit=crop&q=80&w=600' }}" 
                                 alt="{{ $featuredArticle['title'] }}" 
                                 class="w-full h-full object-cover">
                        </div>

                        <!-- Content Side -->
                        <div class="md:col-span-6 space-y-2 sm:space-y-2.5">
                            <span class="inline-block px-2.5 sm:px-3 py-0.5 bg-[#FAF0EE] text-[#8C433C] text-[10px] sm:text-[11px] font-bold rounded-full border border-[#DEA69E]/40">
                                {{ $featuredArticle['category'] }}
                            </span>

                            <h2 class="text-base sm:text-xl font-extrabold text-[#2A1614] leading-snug" style="font-family: 'DM Serif Display', serif;">
                                <a href="{{ route('articles.show', $featuredArticle['slug']) }}" class="hover:text-[#8C433C] transition">
                                    {{ $featuredArticle['title'] }}
                                </a>
                            </h2>

                            <p class="text-xs text-neutral-600 leading-relaxed line-clamp-2 sm:line-clamp-3">
                                {{ $featuredArticle['excerpt'] }}
                            </p>

                            <div class="flex items-center gap-3 text-[10px] sm:text-[11px] text-neutral-500 pt-0.5">
                                <span class="flex items-center gap-1">
                                    <i class="fa-regular fa-user text-slate-400 text-[10px]"></i>
                                    <span>{{ $featuredArticle['author'] }}</span>
                                </span>
                                <span class="flex items-center gap-1">
                                    <i class="fa-regular fa-calendar text-slate-400 text-[10px]"></i>
                                    <span>{{ $featuredArticle['published_at'] }}</span>
                                </span>
                            </div>

                            <div class="pt-1">
                                <a href="{{ route('articles.show', $featuredArticle['slug']) }}" 
                                   class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full bg-[#8C433C] hover:bg-[#782819] text-white text-xs font-bold transition shadow-xs">
                                    <span>Baca Selengkapnya</span>
                                    <i class="fa-solid fa-arrow-right text-[10px]"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- ── ARTIKEL TERBARU SECTION (RESPONSIF 2 KOLOM DI MOBILE, 3 DI DESKTOP) ── -->
                <div class="space-y-3 sm:space-y-4">
                    <!-- Section Header -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-1.5">
                            <span class="text-[#8C433C] text-sm">🍃</span>
                            <h2 class="text-base sm:text-xl font-extrabold text-[#2A1614]" style="font-family: 'DM Serif Display', serif;">
                                Artikel Terbaru
                            </h2>
                        </div>
                        <a href="{{ route('articles.index') }}" class="text-xs font-bold text-[#8C433C] hover:underline flex items-center gap-1">
                            <span>Lihat Semua</span>
                            <i class="fa-solid fa-arrow-right text-[10px]"></i>
                        </a>
                    </div>

                    <!-- 2-Column Article Card Grid on Mobile, 3-Column on Desktop -->
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3 sm:gap-4 lg:gap-5">
                        @foreach ($articles as $article)
                            <x-article_card :article="$article" />
                        @endforeach
                    </div>
                </div>

            </div>

            <!-- ════════════════════ RIGHT COLUMN (SIDEBAR 4 COLS) ════════════════════ -->
            <aside class="lg:col-span-4 space-y-4 sm:space-y-5">
                
                <!-- ── KARTU 1: ARTIKEL POPULER ── -->
                <div class="bg-white rounded-3xl p-4 sm:p-5 shadow-xs border border-[#DEA69E]/30 space-y-3.5 sm:space-y-4">
                    <div class="flex items-center gap-2">
                        <span class="text-[#8C433C] text-sm">🔥</span>
                        <h2 class="text-sm sm:text-base font-bold text-[#2A1614]" style="font-family: 'DM Serif Display', serif;">
                            Artikel Populer
                        </h2>
                    </div>

                    <div class="space-y-3">
                        @foreach ($popularArticles as $pop)
                            <a href="{{ route('articles.show', $pop['slug']) }}" class="flex items-center gap-3 group p-1 -mx-1 rounded-2xl hover:bg-[#FAF0EE]/60 transition">
                                <div class="w-16 h-13 sm:w-20 sm:h-15 flex-shrink-0 rounded-xl sm:rounded-2xl overflow-hidden bg-slate-100">
                                    <img src="{{ $pop['thumbnail_image'] ?? 'https://images.unsplash.com/photo-1555252333-9f8e92e65df9?auto=format&fit=crop&q=80&w=600' }}" 
                                         alt="{{ $pop['title'] }}" 
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                </div>
                                <div class="min-w-0 space-y-0.5 sm:space-y-1">
                                    <h3 class="text-xs sm:text-sm font-bold text-[#2A1614] group-hover:text-[#8C433C] transition line-clamp-2 leading-snug">
                                        {{ $pop['title'] }}
                                    </h3>
                                    <div class="flex items-center gap-1.5 text-[10px] text-slate-400">
                                        <i class="fa-regular fa-user text-[9px]"></i>
                                        <span>{{ $pop['read_time'] }}</span>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- ── KARTU 2: KATEGORI LIST ── -->
                <div class="bg-white rounded-3xl p-4 sm:p-5 shadow-xs border border-[#DEA69E]/30 space-y-3.5 sm:space-y-4">
                    <div class="flex items-center gap-2">
                        <span class="text-[#8C433C] text-sm">⏹</span>
                        <h2 class="text-sm sm:text-base font-bold text-[#2A1614]" style="font-family: 'DM Serif Display', serif;">
                            Kategori
                        </h2>
                    </div>

                    <div class="space-y-1.5">
                        @foreach ($categories as $cat)
                            <a href="{{ route('articles.index', ['category' => $cat['slug']]) }}" 
                               class="flex items-center justify-between px-3 py-2 rounded-xl text-xs font-medium transition {{ $currentCategory === $cat['slug'] ? 'bg-[#FAF0EE] text-[#8C433C] font-bold' : 'text-neutral-700 hover:bg-[#FAF0EE]/50 hover:text-[#8C433C]' }}">
                                <div class="flex items-center gap-2">
                                    <i class="{{ $cat['icon'] }} text-[#8C433C] text-xs"></i>
                                    <span>{{ $cat['name'] }}</span>
                                </div>
                                <span class="px-2 py-0.5 bg-slate-100 rounded-full text-[10px] text-neutral-500 font-semibold">
                                    {{ $cat['count'] ?? 0 }}
                                </span>
                            </a>
                        @endforeach
                    </div>
                </div>

            </aside>

        </div>

        <!-- ── NEWSLETTER & KONSULTASI GRID BANNER ── -->
        <x-grid_hero_banner 
            badge="Informasi & Edukasi Medis"
            title="Dapatkan Update Panduan Kesehatan Terbaru"
            subtitle="Konsultasikan keraguan Anda seputar kehamilan dan nutrisi si kecil langsung bersama bidan berpengalaman dari Maternity.id."
            primaryText="Lihat Topik Lainnya"
            :primaryUrl="route('articles.index')"
            secondaryText="Tanya Bidan via WhatsApp"
            secondaryUrl="https://wa.me/"
        />

    </div>

    {{-- Floating Social Media (Kanan Bawah) --}}
    <x-floating_social />

</x-layout>
