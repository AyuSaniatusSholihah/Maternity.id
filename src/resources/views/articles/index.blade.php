<x-layout title="Artikel & Informasi — Maternity.id" metaDescription="Temukan informasi dan panduan yang membantu menemani perjalanan kehamilan dan perawatan bayi Anda.">
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
        
        <!-- ── 1. COMPACT & SLEEK HERO BANNER (ARTIKEL & INFORMASI) ── -->
        <div class="relative bg-gradient-to-r from-[#FCEBE7] via-[#FDF3F0] to-[#FAF0EE] rounded-3xl px-6 py-4 sm:px-8 sm:py-5 border border-[#DEA69E]/30 overflow-hidden shadow-xs">
            <!-- Decorative Leaves on Left -->
            <div class="absolute -left-2 -bottom-2 opacity-35 pointer-events-none select-none">
                <svg width="75" height="75" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M20 90C20 90 25 40 70 30C70 30 50 65 20 90Z" fill="#A8C4A0" />
                    <path d="M10 65C10 65 30 35 60 40C60 40 40 60 10 65Z" fill="#8BB582" opacity="0.6"/>
                </svg>
            </div>

            <!-- Decorative Doodle Heart on Left Top -->
            <div class="absolute top-3 left-8 text-[#DEA69E] opacity-50 pointer-events-none">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                </svg>
            </div>

            <!-- Decorative Doodle Heart on Right -->
            <div class="absolute top-4 right-12 text-[#DEA69E] opacity-60 pointer-events-none hidden sm:block">
                <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                </svg>
            </div>

            <!-- Content Area: Text on Left + Mother & Baby Image on Right -->
            <div class="relative z-10 flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="space-y-1 text-center sm:text-left max-w-lg">
                    <h1 class="text-2xl sm:text-3xl font-extrabold text-[#8C433C] tracking-tight leading-snug" style="font-family: 'DM Serif Display', serif;">
                        Artikel & Informasi
                    </h1>
                    <p class="text-xs sm:text-sm text-[#5C4542] leading-relaxed">
                        Temukan informasi yang membantu menemani perjalananmu.
                    </p>
                </div>

                <div class="shrink-0">
                    <div class="w-40 sm:w-52 md:w-60 h-28 sm:h-32 md:h-36 overflow-hidden rounded-2xl shadow-xs border border-white/80">
                        <img src="https://images.unsplash.com/photo-1555252333-9f8e92e65df9?auto=format&fit=crop&q=80&w=600" 
                             alt="Ibu dan Bayi" 
                             class="w-full h-full object-cover">
                    </div>
                </div>
            </div>
        </div>

        <!-- ── 2. BREADCRUMB ── -->
        <nav class="flex items-center space-x-2 text-xs sm:text-sm font-medium text-slate-500">
            <a href="{{ route('home') }}" class="hover:text-[#8C433C] transition flex items-center gap-1.5 text-[#8C433C]">
                <i class="fa-solid fa-house text-xs"></i> Home
            </a>
            <span class="text-slate-300">/</span>
            <span class="text-[#2A1614] font-semibold">Artikel</span>
        </nav>

        <!-- ── 3. CATEGORY FILTER TABS (PILLS) ── -->
        <div class="flex items-center gap-2 overflow-x-auto pb-1 no-scrollbar">
            @foreach ($categories as $cat)
                @php
                    $isActive = ($currentCategory === $cat['slug']);
                @endphp
                <a href="{{ route('articles.index', ['category' => $cat['slug'], 'q' => $searchQuery]) }}"
                   class="shrink-0 px-4 py-1.5 rounded-full text-xs font-semibold transition-all duration-200 {{ $isActive ? 'bg-[#8C433C] text-white shadow-xs' : 'bg-transparent border border-[#DEA69E]/80 text-[#8C433C] hover:bg-[#FAF0EE]' }}">
                    {{ $cat['name'] }}
                </a>
            @endforeach
        </div>

        <!-- ── 4. MAIN CONTENT GRID (LEFT ARTICLES + RIGHT SIDEBAR) ── -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
            
            <!-- ════════════════════ LEFT COLUMN (8 COLS) ════════════════════ -->
            <div class="lg:col-span-8 space-y-6">
                
                <!-- ── FEATURED SPOTLIGHT ARTICLE CARD ── -->
                @if($featuredArticle)
                    <div class="bg-white rounded-3xl p-4 sm:p-6 border border-[#DEA69E]/30 shadow-xs grid grid-cols-1 md:grid-cols-12 gap-5 items-center card-spring">
                        <!-- Image Side -->
                        <div class="md:col-span-6 h-48 sm:h-56 rounded-2xl overflow-hidden bg-neutral-100">
                            <img src="{{ $featuredArticle['thumbnail_image'] }}" 
                                 alt="{{ $featuredArticle['title'] }}" 
                                 class="w-full h-full object-cover">
                        </div>

                        <!-- Content Side -->
                        <div class="md:col-span-6 space-y-2.5">
                            <span class="inline-block px-3 py-0.5 bg-[#FAF0EE] text-[#8C433C] text-[11px] font-bold rounded-full border border-[#DEA69E]/40">
                                {{ $featuredArticle['category'] }}
                            </span>

                            <h2 class="text-lg sm:text-xl font-extrabold text-[#2A1614] leading-snug" style="font-family: 'DM Serif Display', serif;">
                                <a href="{{ route('articles.show', $featuredArticle['slug']) }}" class="hover:text-[#8C433C] transition">
                                    {{ $featuredArticle['title'] }}
                                </a>
                            </h2>

                            <p class="text-xs text-neutral-600 leading-relaxed line-clamp-3">
                                {{ $featuredArticle['excerpt'] }}
                            </p>

                            <div class="flex items-center gap-3.5 text-[11px] text-neutral-500 pt-0.5">
                                <span class="flex items-center gap-1.5">
                                    <i class="fa-regular fa-clock text-slate-400 text-[10px]"></i>
                                    <span>{{ $featuredArticle['read_time'] }}</span>
                                </span>
                                <span class="flex items-center gap-1.5">
                                    <i class="fa-regular fa-calendar text-slate-400 text-[10px]"></i>
                                    <span>{{ $featuredArticle['published_at'] }}</span>
                                </span>
                            </div>

                            <div class="pt-1.5">
                                <a href="{{ route('articles.show', $featuredArticle['slug']) }}" 
                                   class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full bg-[#8C433C] hover:bg-[#782819] text-white text-xs font-bold transition shadow-xs">
                                    <span>Baca Selengkapnya</span>
                                    <i class="fa-solid fa-arrow-right text-[10px]"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- ── ARTIKEL TERBARU SECTION ── -->
                <div class="space-y-4">
                    <!-- Section Header -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <span class="text-[#8C433C] text-base">🍃</span>
                            <h2 class="text-lg sm:text-xl font-extrabold text-[#2A1614]" style="font-family: 'DM Serif Display', serif;">
                                Artikel Terbaru
                            </h2>
                        </div>
                        <a href="{{ route('articles.index') }}" class="text-xs font-bold text-[#8C433C] hover:underline flex items-center gap-1">
                            <span>Lihat Semua</span>
                            <i class="fa-solid fa-arrow-right text-[10px]"></i>
                        </a>
                    </div>

                    <!-- 3-Column Article Card Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 sm:gap-5">
                        @foreach ($articles as $article)
                            <article class="bg-white rounded-3xl border border-[#DEA69E]/30 p-3 sm:p-4 shadow-xs flex flex-col justify-between space-y-3 card-spring">
                                <!-- Card Image -->
                                <div class="w-full h-36 sm:h-40 rounded-2xl overflow-hidden bg-neutral-100">
                                    <img src="{{ $article['thumbnail_image'] }}" 
                                         alt="{{ $article['title'] }}" 
                                         class="w-full h-full object-cover">
                                </div>

                                <!-- Card Content -->
                                <div class="space-y-2 flex-1 flex flex-col justify-between">
                                    <div class="space-y-1.5">
                                        <span class="inline-block px-2.5 py-0.5 bg-[#FAF0EE] text-[#8C433C] text-[10px] font-bold rounded-full">
                                            {{ $article['category'] }}
                                        </span>

                                        <h3 class="text-xs sm:text-sm font-bold text-[#2A1614] leading-snug line-clamp-2" style="font-family: 'DM Serif Display', serif;">
                                            <a href="{{ route('articles.show', $article['slug']) }}" class="hover:text-[#8C433C] transition">
                                                {{ $article['title'] }}
                                            </a>
                                        </h3>

                                        <p class="text-[11px] text-neutral-500 line-clamp-2 leading-relaxed">
                                            {{ $article['excerpt'] }}
                                        </p>
                                    </div>

                                    <!-- Read Time Footer -->
                                    <div class="pt-2 border-t border-slate-50 flex items-center gap-1.5 text-[10px] text-slate-400">
                                        <i class="fa-regular fa-clock text-slate-400 text-[10px]"></i>
                                        <span>{{ $article['read_time'] }}</span>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>

            </div>

            <!-- ════════════════════ RIGHT COLUMN (SIDEBAR 4 COLS) ════════════════════ -->
            <aside class="lg:col-span-4 space-y-5">
                
                <!-- ── KARTU 1: ARTIKEL POPULER ── -->
                <div class="bg-white rounded-3xl p-4 sm:p-5 shadow-xs border border-[#DEA69E]/30 space-y-4">
                    <div class="flex items-center gap-2">
                        <span class="text-[#8C433C] text-sm">🔥</span>
                        <h2 class="text-sm sm:text-base font-bold text-[#2A1614]" style="font-family: 'DM Serif Display', serif;">
                            Artikel Populer
                        </h2>
                    </div>

                    <div class="space-y-3.5">
                        @foreach ($popularArticles as $pop)
                            <a href="{{ route('articles.show', $pop['slug']) }}" class="flex items-center gap-3 group p-1 -mx-1 rounded-2xl hover:bg-[#FAF0EE]/60 transition">
                                <div class="w-18 h-14 sm:w-20 sm:h-15 flex-shrink-0 rounded-2xl overflow-hidden bg-slate-100">
                                    <img src="{{ $pop['thumbnail_image'] }}" 
                                         alt="{{ $pop['title'] }}" 
                                         class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-xs font-bold text-[#2A1614] group-hover:text-[#8C433C] transition line-clamp-2 leading-snug">
                                        {{ $pop['title'] }}
                                    </h3>
                                    <div class="flex items-center gap-1 text-[10px] text-slate-400 mt-1">
                                        <i class="fa-regular fa-clock text-slate-400 text-[10px]"></i>
                                        <span>{{ $pop['read_time'] }}</span>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- ── KARTU 2: KATEGORI LIST WITH BADGES ── -->
                <div class="bg-white rounded-3xl p-4 sm:p-5 shadow-xs border border-[#DEA69E]/30 space-y-3.5">
                    <div class="flex items-center gap-2">
                        <span class="text-[#8C433C] text-sm"><i class="fa-solid fa-shapes"></i></span>
                        <h2 class="text-sm sm:text-base font-bold text-[#2A1614]" style="font-family: 'DM Serif Display', serif;">
                            Kategori
                        </h2>
                    </div>

                    <div class="space-y-1.5">
                        @php
                            $sidebarCategories = [
                                ['name' => 'Nutrisi Ibu', 'slug' => 'nutrisi-ibu', 'count' => 12, 'icon' => 'fa-solid fa-seedling'],
                                ['name' => 'Persalinan', 'slug' => 'persalinan', 'count' => 8, 'icon' => 'fa-solid fa-person-pregnant'],
                                ['name' => 'Perawatan Bayi', 'slug' => 'perawatan-bayi', 'count' => 14, 'icon' => 'fa-solid fa-baby'],
                                ['name' => 'Kesehatan Wanita', 'slug' => 'kesehatan-wanita', 'count' => 10, 'icon' => 'fa-solid fa-heart-pulse'],
                                ['name' => 'Keluarga', 'slug' => 'keluarga', 'count' => 7, 'icon' => 'fa-solid fa-house-chimney-user'],
                            ];
                        @endphp

                        @foreach ($sidebarCategories as $scat)
                            <a href="{{ route('articles.index', ['category' => $scat['slug']]) }}" 
                               class="flex items-center justify-between p-2 rounded-2xl text-xs font-semibold text-neutral-700 hover:bg-[#FAF0EE] hover:text-[#8C433C] transition">
                                <div class="flex items-center gap-2.5">
                                    <span class="w-6 h-6 rounded-full bg-[#FAF0EE] text-[#8C433C] flex items-center justify-center text-[11px]">
                                        <i class="{{ $scat['icon'] }}"></i>
                                    </span>
                                    <span>{{ $scat['name'] }}</span>
                                </div>
                                <span class="px-2 py-0.5 rounded-full text-[11px] font-bold {{ $currentCategory === $scat['slug'] ? 'bg-[#8C433C] text-white' : 'bg-[#FAF0EE] text-[#8C433C]' }}">
                                    {{ $scat['count'] }}
                                </span>
                            </a>
                        @endforeach
                    </div>
                </div>

            </aside>

        </div>

    </div>
</x-layout>
