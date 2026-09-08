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
        <div class="relative bg-gradient-to-r from-[#FCEBE7] via-[#FDF3F0] to-[#FAF0EE] rounded-3xl px-5 py-4 sm:px-8 sm:py-5 border border-[#DEA69E]/30 overflow-hidden shadow-xs">
            <!-- Decorative Leaves on Right -->
            <div class="absolute right-64 bottom-0 opacity-30 pointer-events-none select-none hidden lg:block">
                <svg width="70" height="70" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M20 90C20 90 25 40 70 30C70 30 50 65 20 90Z" fill="#DEA69E" />
                    <path d="M10 65C10 65 30 35 60 40C60 40 40 60 10 65Z" fill="#8C433C" opacity="0.6"/>
                </svg>
            </div>

            <!-- Content Area: Text on Left + Compact Image on Right -->
            <div class="relative z-10 flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="space-y-1 text-center sm:text-left max-w-lg">
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

        <!-- ── 2. CATEGORY PILL FILTER TABS ── -->
        <div class="flex items-center gap-2 overflow-x-auto pb-1 no-scrollbar">
            @foreach ($categories as $cat)
                @php
                    $isActive = ($currentCategory === $cat['slug']);
                @endphp
                <a href="{{ route('articles.index', ['category' => $cat['slug'], 'q' => $searchQuery]) }}"
                   class="shrink-0 px-3.5 sm:px-4 py-1.5 rounded-full text-xs font-semibold transition-all duration-200 {{ $isActive ? 'bg-[#8C433C] text-white shadow-xs' : 'bg-transparent border border-[#DEA69E]/80 text-[#8C433C] hover:bg-[#FAF0EE]' }}">
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
                            <img src="{{ $featuredArticle['thumbnail_image'] }}" 
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
                                    <i class="fa-regular fa-clock text-slate-400 text-[10px]"></i>
                                    <span>{{ $featuredArticle['read_time'] }}</span>
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
                            <article class="bg-white rounded-2xl sm:rounded-3xl border border-[#DEA69E]/30 p-2.5 sm:p-4 shadow-xs flex flex-col justify-between space-y-2 sm:space-y-3 card-spring">
                                <!-- Card Image -->
                                <div class="w-full h-28 min-[450px]:h-36 sm:h-40 rounded-xl sm:rounded-2xl overflow-hidden bg-neutral-100">
                                    <img src="{{ $article['thumbnail_image'] }}" 
                                         alt="{{ $article['title'] }}" 
                                         class="w-full h-full object-cover">
                                </div>

                                <!-- Card Content -->
                                <div class="space-y-1.5 sm:space-y-2 flex-1 flex flex-col justify-between">
                                    <div class="space-y-1 sm:space-y-1.5">
                                        <span class="inline-block px-2 sm:px-2.5 py-0.5 bg-[#FAF0EE] text-[#8C433C] text-[9px] min-[400px]:text-[10px] font-bold rounded-full">
                                            {{ $article['category'] }}
                                        </span>

                                        <h3 class="text-xs min-[400px]:text-sm sm:text-sm font-bold text-[#2A1614] leading-snug line-clamp-2" style="font-family: 'DM Serif Display', serif;">
                                            <a href="{{ route('articles.show', $article['slug']) }}" class="hover:text-[#8C433C] transition">
                                                {{ $article['title'] }}
                                            </a>
                                        </h3>

                                        <p class="hidden min-[480px]:block text-[11px] text-neutral-500 line-clamp-2 leading-relaxed">
                                            {{ $article['excerpt'] }}
                                        </p>
                                    </div>

                                    <!-- Read Time Footer -->
                                    <div class="pt-1.5 sm:pt-2 border-t border-slate-50 flex items-center gap-1 text-[9px] min-[400px]:text-[10px] text-slate-400">
                                        <i class="fa-regular fa-clock text-slate-400 text-[9px]"></i>
                                        <span>{{ $article['read_time'] }}</span>
                                    </div>
                                </div>
                            </article>
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
                                    <img src="{{ $pop['thumbnail_image'] }}" 
                                         alt="{{ $pop['title'] }}" 
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                </div>
                                <div class="min-w-0 space-y-0.5 sm:space-y-1">
                                    <h3 class="text-xs sm:text-sm font-bold text-[#2A1614] group-hover:text-[#8C433C] transition line-clamp-2 leading-snug">
                                        {{ $pop['title'] }}
                                    </h3>
                                    <div class="flex items-center gap-1.5 text-[10px] text-slate-400">
                                        <i class="fa-regular fa-clock text-[9px]"></i>
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

    </div>
</x-layout>
