<x-layout title="Empowering Women's Health">
    <x-slot name="head">
        <!-- Google Fonts & FontAwesome -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link
            href="https://fonts.googleapis.com/css2?family=Caveat:wght@500;600;700&family=DM+Serif+Display:ital@0;1&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
            rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <style>
            .font-handwriting {
                font-family: 'Caveat', cursive;
            }

            /* Custom Clip Path untuk efek gambar miring */
            .clip-slant-left-top {
                clip-path: polygon(0 0, 100% 0, 80% 100%, 0 100%);
            }

            .clip-slant-left-bottom {
                clip-path: polygon(0 0, 80% 0, 100% 100%, 0 100%);
            }

            .clip-slant-right-top {
                clip-path: polygon(20% 0, 100% 0, 100% 100%, 0 100%);
            }

            .clip-slant-right-bottom {
                clip-path: polygon(0 0, 100% 0, 100% 100%, 20% 100%);
            }

            /* ── Scroll Reveal Animation System ── */
            .reveal-on-scroll {
                opacity: 0;
                transform: translateY(32px);
                filter: blur(4px);
                transition: opacity 0.75s cubic-bezier(0.16, 1, 0.3, 1),
                            transform 0.75s cubic-bezier(0.16, 1, 0.3, 1),
                            filter 0.75s cubic-bezier(0.16, 1, 0.3, 1);
                will-change: opacity, transform, filter;
            }

            .reveal-on-scroll.is-revealed {
                opacity: 1;
                transform: translateY(0);
                filter: blur(0);
            }

            /* Staggered Delay for Grid Children */
            .stagger-1 { transition-delay: 60ms; }
            .stagger-2 { transition-delay: 140ms; }
            .stagger-3 { transition-delay: 220ms; }
            .stagger-4 { transition-delay: 300ms; }
            .stagger-5 { transition-delay: 380ms; }
            .stagger-6 { transition-delay: 460ms; }

            /* ── Interactive Grid Card Spring Physics (Terisolasi per kotak) ── */
            .card-spring {
                transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1),
                            box-shadow 0.4s cubic-bezier(0.16, 1, 0.3, 1),
                            border-color 0.3s ease;
                isolation: isolate;
                will-change: transform, box-shadow;
            }
            .card-spring:hover {
                transform: translateY(-8px);
            }

            /* ── Dynamic Floating & Organic Shapes for Hero ── */
            @keyframes heroFloat1 {
                0%, 100% { transform: translateY(0px) rotate(0deg) scale(1); }
                50% { transform: translateY(-7px) rotate(1.2deg) scale(1.01); }
            }
            @keyframes heroFloat2 {
                0%, 100% { transform: translateY(0px) rotate(0deg) scale(1); }
                50% { transform: translateY(-9px) rotate(-1.5deg) scale(1.015); }
            }
            @keyframes heroFloat3 {
                0%, 100% { transform: translateY(0px) rotate(0deg) scale(1); }
                50% { transform: translateY(-6px) rotate(1deg) scale(1.01); }
            }
            @keyframes heroFloat4 {
                0%, 100% { transform: translateY(0px) rotate(0deg) scale(1); }
                50% { transform: translateY(-8px) rotate(-1.2deg) scale(1.02); }
            }
            @keyframes mobileFloatCenter {
                0%, 100% { transform: translateY(0px) scale(1); }
                50% { transform: translateY(-6px) scale(1.025); }
            }
            @keyframes mobileFloatLeft {
                0%, 100% { transform: translateY(0px) rotate(-2deg); }
                50% { transform: translateY(-5px) rotate(0.5deg); }
            }
            @keyframes mobileFloatRight {
                0%, 100% { transform: translateY(0px) rotate(2deg); }
                50% { transform: translateY(-5px) rotate(-0.5deg); }
            }

            .hero-mobile-1 {
                border-radius: 28px 14px 24px 18px;
                animation: mobileFloatLeft 4.2s ease-in-out infinite;
                will-change: transform;
            }
            .hero-mobile-2 {
                border-radius: 20px 20px 28px 28px;
                animation: mobileFloatCenter 4.8s ease-in-out infinite 0.4s;
                will-change: transform;
            }
            .hero-mobile-3 {
                border-radius: 14px 28px 18px 24px;
                animation: mobileFloatRight 4.4s ease-in-out infinite 0.8s;
                will-change: transform;
            }

            .hero-desktop-float-1 {
                animation: heroFloat1 6s ease-in-out infinite;
                will-change: transform;
            }
            .hero-desktop-float-2 {
                animation: heroFloat2 7s ease-in-out infinite 0.9s;
                will-change: transform;
            }
            .hero-desktop-float-3 {
                animation: heroFloat3 6.5s ease-in-out infinite 1.4s;
                will-change: transform;
            }
            .hero-desktop-float-4 {
                animation: heroFloat4 7.5s ease-in-out infinite 2s;
                will-change: transform;
            }

            /* ── Decorative Background Accessories ── */
            @keyframes spinSlow {
                from { transform: rotate(0deg); }
                to { transform: rotate(360deg); }
            }
            @keyframes blobMorph {
                0%, 100% { border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%; transform: translate(0, 0) scale(1); }
                33% { border-radius: 30% 60% 70% 40% / 50% 60% 30% 60%; transform: translate(6px, -8px) scale(1.04); }
                66% { border-radius: 50% 60% 30% 60% / 30% 40% 70% 60%; transform: translate(-8px, 6px) scale(0.96); }
            }
            .animate-spin-slow {
                animation: spinSlow 35s linear infinite;
            }
            .animate-blob-morph-1 {
                animation: blobMorph 10s ease-in-out infinite;
                will-change: transform, border-radius;
            }
            .animate-blob-morph-2 {
                animation: blobMorph 12s ease-in-out infinite 2s;
                will-change: transform, border-radius;
            }
            .bg-diagonal-lines {
                background-image: repeating-linear-gradient(45deg, rgba(222, 166, 158, 0.08) 0, rgba(222, 166, 158, 0.08) 1px, transparent 0, transparent 18px);
            }
        </style>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
        <!-- HERO SECTION -->
        <div
            class="relative flex items-center justify-center min-h-[320px] sm:min-h-[480px] lg:min-h-[540px] pt-1 sm:pt-10 pb-4 sm:pb-12 overflow-hidden">

            <!-- ── HERO ACCESSORIES: LINGKARAN DASHED DI SUDUT KANAN ATAS ── -->
            <div class="absolute -top-10 -right-10 sm:top-2 sm:right-6 w-32 h-32 sm:w-48 sm:h-48 rounded-full border-2 border-dashed border-[#DEAAA1]/55 animate-spin-slow pointer-events-none z-0"></div>

            <!-- ── HERO ACCESSORIES: SQUARE GRID PATTERN DI KIRI BAWAH ── -->
            <div class="absolute bottom-2 left-2 sm:bottom-6 sm:left-6 w-16 sm:w-24 h-16 sm:h-24 opacity-40 pointer-events-none z-0">
                <svg width="80" height="80" fill="none" viewBox="0 0 80 80">
                    <rect x="4" y="4" width="18" height="18" rx="4" stroke="#5F8C72" stroke-width="2" fill="#5F8C72" fill-opacity="0.15"/>
                    <rect x="30" y="4" width="18" height="18" rx="4" stroke="#5F8C72" stroke-width="2" stroke-dasharray="3 3"/>
                    <rect x="56" y="4" width="18" height="18" rx="4" stroke="#C27A6F" stroke-width="2" fill="#C27A6F" fill-opacity="0.2"/>
                    
                    <rect x="4" y="30" width="18" height="18" rx="4" stroke="#C27A6F" stroke-width="2" stroke-dasharray="3 3"/>
                    <rect x="30" y="30" width="18" height="18" rx="4" stroke="#5F8C72" stroke-width="2" fill="#5F8C72" fill-opacity="0.25"/>
                    <rect x="56" y="30" width="18" height="18" rx="4" stroke="#5F8C72" stroke-width="2"/>
                    
                    <rect x="4" y="56" width="18" height="18" rx="4" stroke="#5F8C72" stroke-width="2" fill="#5F8C72" fill-opacity="0.15"/>
                    <rect x="30" y="56" width="18" height="18" rx="4" stroke="#C27A6F" stroke-width="2"/>
                    <rect x="56" y="56" width="18" height="18" rx="4" stroke="#C27A6F" stroke-width="2" stroke-dasharray="3 3"/>
                </svg>
            </div>

            <!-- ── HERO ACCESSORIES: DOT SCATTER MENGAMBANG ── -->
            <div class="absolute top-1/4 right-1/4 w-24 h-24 opacity-30 pointer-events-none z-0 hidden sm:block">
                <svg width="80" height="80" fill="none">
                    <circle cx="10" cy="10" r="2.5" fill="#C27A6F"/>
                    <circle cx="35" cy="15" r="3" fill="#5F8C72"/>
                    <circle cx="60" cy="8" r="2" fill="#DEA69E"/>
                    <circle cx="20" cy="45" r="3.5" fill="#DEAAA1"/>
                    <circle cx="50" cy="40" r="2.5" fill="#8C433C"/>
                    <circle cx="70" cy="55" r="3" fill="#5F8C72"/>
                    <circle cx="30" cy="70" r="2" fill="#C27A6F"/>
                    <circle cx="65" cy="75" r="3" fill="#DEAAA1"/>
                </svg>
            </div>

            <!-- ── GAMBAR DEKORASI DESKTOP / TABLET - KIRI (hidden md:flex) ── -->
            <div
                class="hidden md:flex flex-col justify-start gap-6 lg:gap-8 xl:gap-10 absolute left-0 top-2 bottom-0 w-36 lg:w-60 xl:w-72 pointer-events-none z-0">
                <!-- Foto Kiri Atas (Yoga) -->
                <div
                    class="hero-desktop-float-1 w-full h-36 lg:h-52 xl:h-60 rounded-2xl overflow-hidden shadow-lg opacity-90 hover:opacity-100 transition clip-slant-left-top bg-[#FAF0EE]/60 p-0.5">
                    <img src="https://images.unsplash.com/photo-1545205597-3d9d02c29597?auto=format&fit=crop&q=80&w=600"
                        alt="Yoga Class" class="w-full h-full object-cover rounded-xl">
                </div>
                <!-- Foto Kiri Bawah (Ibu dan Bayi) -->
                <div
                    class="hero-desktop-float-2 w-full h-36 lg:h-52 xl:h-60 rounded-2xl overflow-hidden shadow-lg opacity-90 hover:opacity-100 transition clip-slant-left-bottom bg-[#FAF0EE]/60 p-0.5">
                    <img src="https://images.unsplash.com/photo-1555252333-9f8e92e65df9?auto=format&fit=crop&q=80&w=600"
                        alt="Mother and Baby" class="w-full h-full object-cover rounded-xl">
                </div>
            </div>

            <!-- ── GAMBAR DEKORASI DESKTOP / TABLET - KANAN (hidden md:flex) ── -->
            <div
                class="hidden md:flex flex-col justify-start gap-6 lg:gap-8 xl:gap-10 absolute right-0 top-2 bottom-0 w-36 lg:w-60 xl:w-72 pointer-events-none z-0">
                <!-- Foto Kanan Atas (Prenatal Exercise / Health) -->
                <div
                    class="hero-desktop-float-3 w-full h-36 lg:h-52 xl:h-60 rounded-2xl overflow-hidden shadow-lg opacity-90 hover:opacity-100 transition clip-slant-right-bottom bg-[#FAF0EE]/60 p-0.5">
                    <img src="https://images.unsplash.com/photo-1518611012118-696072aa579a?auto=format&fit=crop&q=80&w=600"
                        alt="Prenatal Wellness" class="w-full h-full object-cover rounded-xl">
                </div>
                <!-- Foto Kanan Bawah (Seminar Event / Workshop) -->
                <div
                    class="hero-desktop-float-4 w-full h-36 lg:h-52 xl:h-60 rounded-2xl overflow-hidden shadow-lg opacity-90 hover:opacity-100 transition clip-slant-right-top bg-[#FAF0EE]/60 p-0.5">
                    <img src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?auto=format&fit=crop&q=80&w=600"
                        alt="Seminar Event" class="w-full h-full object-cover rounded-xl">
                </div>
            </div>

            <!-- CONTENT UTAMA (Tengah, Rapi, & Jernih di Depan Background) -->
            <div class="max-w-2xl text-center z-10 px-2 sm:px-6 w-full flex flex-col items-center">
                <!-- ── 3 ORGANIC DYNAMIC CAPSULE IMAGES UNTUK MOBILE (md:hidden) ── -->
                <div class="md:hidden flex items-center justify-center gap-1.5 min-[380px]:gap-2 mb-2 sm:mb-3.5 w-full max-w-[210px] min-[380px]:max-w-[250px] mx-auto pt-0.5">
                    <!-- Foto 1: Kiri (Yoga) -->
                    <div class="hero-mobile-1 w-1/3 aspect-[4/5] overflow-hidden shadow-xs border-2 border-white/95 bg-[#FAF0EE] flex-shrink-0">
                        <img src="https://images.unsplash.com/photo-1545205597-3d9d02c29597?auto=format&fit=crop&q=80&w=400"
                            alt="Yoga Wellness" class="w-full h-full object-cover">
                    </div>
                    <!-- Foto 2: Tengah (Ibu dan Bayi) -->
                    <div class="hero-mobile-2 w-1/3 aspect-[4/5] overflow-hidden shadow-sm border-2 border-white/95 bg-[#FAF0EE] flex-shrink-0">
                        <img src="https://images.unsplash.com/photo-1555252333-9f8e92e65df9?auto=format&fit=crop&q=80&w=400"
                            alt="Mother and Baby" class="w-full h-full object-cover">
                    </div>
                    <!-- Foto 3: Kanan (Prenatal Health) -->
                    <div class="hero-mobile-3 w-1/3 aspect-[4/5] overflow-hidden shadow-xs border-2 border-white/95 bg-[#FAF0EE] flex-shrink-0">
                        <img src="https://images.unsplash.com/photo-1518611012118-696072aa579a?auto=format&fit=crop&q=80&w=400"
                            alt="Prenatal Health" class="w-full h-full object-cover">
                    </div>
                </div>

                <h1
                    class="text-xl min-[380px]:text-2xl sm:text-6xl lg:text-7xl font-normal text-[#2E1D1B] tracking-tight leading-none mb-0.5 sm:mb-2"
                    style="font-family: 'DM Serif Display', serif;">
                    Empowering Women's
                </h1>
                <p class="font-handwriting text-2xl min-[380px]:text-3xl sm:text-6xl lg:text-7xl text-[#5F8C72] font-semibold mb-1.5 sm:mb-7 leading-tight">
                    Health Awareness
                </p>

                <p class="text-[#554846] text-xs sm:text-base lg:text-lg leading-relaxed mb-3 sm:mb-9 max-w-[280px] min-[380px]:max-w-md sm:max-w-xl mx-auto font-normal">
                    Seminar, e-book, dan artikel terpercaya untuk mendampingi perjalanan dari kehamilan hingga tumbuh kembang buah hati.
                </p>

                <!-- Action Buttons -->
                <div class="flex flex-row items-center justify-center gap-2 sm:gap-5 mt-0.5 sm:mt-2">
                    <!-- Akses Ebook Button -->
                    <a href="{{ url('/library') }}"
                        class="bg-[#DEAAA1] hover:bg-[#d0998f] text-[#2D1E1E] font-bold px-4 min-[380px]:px-6 sm:px-9 py-2 sm:py-3.5 rounded-full shadow-xs hover:shadow-md transition-all duration-200 text-xs sm:text-base text-center transform hover:scale-[1.03] active:scale-95 whitespace-nowrap">
                        Akses Ebook
                    </a>
                    
                    <!-- Akses Seminar Button -->
                    <a href="{{ url('/events') }}"
                        class="bg-[#5F8C72] hover:bg-[#4f755e] text-white font-bold px-4 min-[380px]:px-6 sm:px-9 py-2 sm:py-3.5 rounded-full shadow-xs hover:shadow-md transition-all duration-200 text-xs sm:text-base text-center transform hover:scale-[1.03] active:scale-95 whitespace-nowrap">
                        Akses Seminar
                    </a>
                </div>
            </div>

        </div>
    </div>

    <!-- ── WAVE DIVIDER: HERO TO OFFERINGS ── -->
    <div class="w-full overflow-hidden leading-none select-none pointer-events-none -mb-0.5">
        <svg class="w-full h-4 sm:h-8 lg:h-10 block text-[#fcf5f3]" viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
            <path d="M0,32L60,42.7C120,53,240,75,360,74.7C480,75,600,53,720,48C840,43,960,53,1080,64C1200,75,1320,85,1380,90.7L1440,96L1440,120L1380,120C1320,120,1200,120,1080,120C960,120,840,120,720,120C600,120,480,120,360,120C240,120,120,120,60,120L0,120Z" fill="currentColor"></path>
        </svg>
    </div>

    <!-- ── SECTION: APA YANG MATERNITY.ID TAWARKAN ── -->
    <section class="relative w-full bg-[#fcf5f3] pt-2 sm:pt-4 pb-5 sm:pb-8 px-3 sm:px-6 lg:px-8 overflow-hidden" style="font-family: 'Plus Jakarta Sans', sans-serif;">
        <div class="relative max-w-7xl mx-auto z-10">
            <!-- Header Section -->
            <div class="text-center max-w-2xl mx-auto mb-4 sm:mb-7 reveal-on-scroll">
                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 sm:px-3 sm:py-1 rounded-full text-[11px] sm:text-xs font-bold bg-[#FAF0EE] text-[#C27A6F] border border-[#DEA69E]/40 mb-1.5 sm:mb-2">
                    ✨ Layanan & Fitur Utama
                </span>
                <h2 class="text-xl sm:text-3xl lg:text-4xl font-extrabold text-[#2A1614] tracking-tight leading-tight" style="font-family: 'DM Serif Display', serif;">
                    Apa yang Bisa Kamu Temukan di Maternity.id?
                </h2>
                <p class="text-xs sm:text-sm text-[#6C5B57] mt-1 sm:mt-1.5 leading-relaxed">
                    Platform edukasi dan pendampingan terpadu untuk ibu hamil, persiapan melahirkan, hingga tumbuh kembang si kecil.
                </p>
            </div>

            <!-- Grid 4 Fitur Utama -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-2 min-[380px]:gap-3 sm:gap-5">
                
                <!-- Kartu 1: Webinar & Workshop -->
                <a href="{{ route('events') }}" class="group reveal-on-scroll stagger-1 relative bg-white rounded-xl sm:rounded-2xl p-2.5 min-[380px]:p-3.5 sm:p-5 border border-[#DEA69E]/30 hover:border-[#5F8C72] hover:shadow-md transition-all duration-300 flex flex-col justify-between overflow-hidden">
                    <div class="absolute top-0 right-0 w-16 h-16 sm:w-20 sm:h-20 bg-[#EDF5F0] rounded-bl-full -mr-3 -mt-3 sm:-mr-4 sm:-mt-4 opacity-50 group-hover:scale-110 transition-transform"></div>
                    <div>
                        <div class="w-8 h-8 sm:w-12 sm:h-12 rounded-lg sm:rounded-xl bg-[#EDF5F0] text-[#5F8C72] flex items-center justify-center mb-2 sm:mb-4 text-xs sm:text-xl shadow-2xs group-hover:scale-105 transition-transform">
                            <i class="fa-solid fa-calendar-check"></i>
                        </div>
                        <span class="text-[9px] sm:text-xs font-bold text-[#5F8C72] uppercase tracking-wider block mb-0.5 sm:mb-1">Edukasi Interaktif</span>
                        <h3 class="text-xs min-[380px]:text-sm sm:text-base font-bold text-[#2A1614] group-hover:text-[#5F8C72] transition-colors mb-1 leading-snug">
                            Event & Kelas Webinar
                        </h3>
                        <p class="text-[10px] min-[380px]:text-xs text-neutral-500 leading-snug line-clamp-2 sm:line-clamp-none">
                            Sesi belajar praktis & interaktif bersama dokter spesialis, bidan, dan praktisi kesehatan maternal.
                        </p>
                    </div>
                    <div class="mt-2.5 pt-2 border-t border-gray-100 flex items-center justify-between text-[10px] min-[380px]:text-xs font-bold text-[#5F8C72]">
                        <span>Jelajahi</span>
                        <i class="fa-solid fa-arrow-right text-[9px] transform group-hover:translate-x-1 transition-transform"></i>
                    </div>
                </a>

                <!-- Kartu 2: E-Book & Panduan Digital -->
                <a href="{{ route('library') }}" class="group reveal-on-scroll stagger-2 relative bg-white rounded-xl sm:rounded-2xl p-2.5 min-[380px]:p-3.5 sm:p-5 border border-[#DEA69E]/30 hover:border-[#8C433C] hover:shadow-md transition-all duration-300 flex flex-col justify-between overflow-hidden">
                    <div class="absolute top-0 right-0 w-16 h-16 sm:w-20 sm:h-20 bg-[#FAF0EE] rounded-bl-full -mr-3 -mt-3 sm:-mr-4 sm:-mt-4 opacity-50 group-hover:scale-110 transition-transform"></div>
                    <div>
                        <div class="w-8 h-8 sm:w-12 sm:h-12 rounded-lg sm:rounded-xl bg-[#FAF0EE] text-[#8C433C] flex items-center justify-center mb-2 sm:mb-4 text-xs sm:text-xl shadow-2xs group-hover:scale-105 transition-transform">
                            <i class="fa-solid fa-book-open"></i>
                        </div>
                        <span class="text-[9px] sm:text-xs font-bold text-[#8C433C] uppercase tracking-wider block mb-0.5 sm:mb-1">Panduan Digital</span>
                        <h3 class="text-xs min-[380px]:text-sm sm:text-base font-bold text-[#2A1614] group-hover:text-[#8C433C] transition-colors mb-1 leading-snug">
                            E-Book & Library PDF
                        </h3>
                        <p class="text-[10px] min-[380px]:text-xs text-neutral-500 leading-snug line-clamp-2 sm:line-clamp-none">
                            Koleksi e-book gratis & berbayar seputar nutrisi, persalinan, manajemen stres, dan perawatan bayi.
                        </p>
                    </div>
                    <div class="mt-2.5 pt-2 border-t border-gray-100 flex items-center justify-between text-[10px] min-[380px]:text-xs font-bold text-[#8C433C]">
                        <span>Unduh</span>
                        <i class="fa-solid fa-arrow-right text-[9px] transform group-hover:translate-x-1 transition-transform"></i>
                    </div>
                </a>

                <!-- Kartu 3: Artikel & Insight -->
                <a href="{{ route('articles.index') }}" class="group reveal-on-scroll stagger-3 relative bg-white rounded-xl sm:rounded-2xl p-2.5 min-[380px]:p-3.5 sm:p-5 border border-[#DEA69E]/30 hover:border-[#D97706] hover:shadow-md transition-all duration-300 flex flex-col justify-between overflow-hidden">
                    <div class="absolute top-0 right-0 w-16 h-16 sm:w-20 sm:h-20 bg-amber-50 rounded-bl-full -mr-3 -mt-3 sm:-mr-4 sm:-mt-4 opacity-50 group-hover:scale-110 transition-transform"></div>
                    <div>
                        <div class="w-8 h-8 sm:w-12 sm:h-12 rounded-lg sm:rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center mb-2 sm:mb-4 text-xs sm:text-xl shadow-2xs group-hover:scale-105 transition-transform">
                            <i class="fa-solid fa-newspaper"></i>
                        </div>
                        <span class="text-[9px] sm:text-xs font-bold text-amber-600 uppercase tracking-wider block mb-0.5 sm:mb-1">Bacaan Terpercaya</span>
                        <h3 class="text-xs min-[380px]:text-sm sm:text-base font-bold text-[#2A1614] group-hover:text-amber-600 transition-colors mb-1 leading-snug">
                            Artikel & Insight Ibu
                        </h3>
                        <p class="text-[10px] min-[380px]:text-xs text-neutral-500 leading-snug line-clamp-2 sm:line-clamp-none">
                            Informasi medis & tips praktis harian seputar kehamilan, laktasi, dan parenting yang mudah dipahami.
                        </p>
                    </div>
                    <div class="mt-2.5 pt-2 border-t border-gray-100 flex items-center justify-between text-[10px] min-[380px]:text-xs font-bold text-amber-600">
                        <span>Baca</span>
                        <i class="fa-solid fa-arrow-right text-[9px] transform group-hover:translate-x-1 transition-transform"></i>
                    </div>
                </a>

                <!-- Kartu 4: Produk & Rekomendasi Maternitas -->
                <a href="{{ route('product') }}" class="group reveal-on-scroll stagger-4 relative bg-white rounded-xl sm:rounded-2xl p-2.5 min-[380px]:p-3.5 sm:p-5 border border-[#DEA69E]/30 hover:border-[#C27A6F] hover:shadow-md transition-all duration-300 flex flex-col justify-between overflow-hidden">
                    <div class="absolute top-0 right-0 w-16 h-16 sm:w-20 sm:h-20 bg-[#FAF0EE] rounded-bl-full -mr-3 -mt-3 sm:-mr-4 sm:-mt-4 opacity-50 group-hover:scale-110 transition-transform"></div>
                    <div>
                        <div class="w-8 h-8 sm:w-12 sm:h-12 rounded-lg sm:rounded-xl bg-[#FAF0EE] text-[#C27A6F] flex items-center justify-center mb-2 sm:mb-4 text-xs sm:text-xl shadow-2xs group-hover:scale-105 transition-transform">
                            <i class="fa-solid fa-bag-shopping"></i>
                        </div>
                        <span class="text-[9px] sm:text-xs font-bold text-[#C27A6F] uppercase tracking-wider block mb-0.5 sm:mb-1">Produk Terkurasi</span>
                        <h3 class="text-xs min-[380px]:text-sm sm:text-base font-bold text-[#2A1614] group-hover:text-[#C27A6F] transition-colors mb-1 leading-snug">
                            Rekomendasi Produk
                        </h3>
                        <p class="text-[10px] min-[380px]:text-xs text-neutral-500 leading-snug line-clamp-2 sm:line-clamp-none">
                            Peralatan dan perlengkapan ibu hamil, menyusui, serta perlengkapan bayi berkualitas dan aman.
                        </p>
                    </div>
                    <div class="mt-2.5 pt-2 border-t border-gray-100 flex items-center justify-between text-[10px] min-[380px]:text-xs font-bold text-[#C27A6F]">
                        <span>Produk</span>
                        <i class="fa-solid fa-arrow-right text-[9px] transform group-hover:translate-x-1 transition-transform"></i>
                    </div>
                </a>

            </div>
        </div>
    </section>

    <!-- UPCOMING EVENT SECTION -->
    <section class="relative w-full bg-[#fcf5f3] pt-1 sm:pt-2 pb-6 sm:pb-8 px-4 sm:px-6 lg:px-8 overflow-hidden" style="font-family: 'Plus Jakarta Sans', sans-serif;">
        <!-- ── EVENTS ACCESSORIES: BLOB ORGANIK KANAN ATAS & KIRI BAWAH ── -->
        <div class="absolute -top-16 -right-16 w-52 sm:w-80 h-52 sm:h-80 bg-[#EBF5EE] opacity-75 blur-2xl rounded-full animate-blob-morph-1 pointer-events-none z-0"></div>
        <div class="absolute -bottom-16 -left-16 w-56 sm:w-80 h-56 sm:h-80 bg-[#F5E6E3] opacity-80 blur-2xl rounded-full animate-blob-morph-2 pointer-events-none z-0"></div>

        <div class="relative max-w-7xl mx-auto space-y-3.5 sm:space-y-4 z-10">
            <!-- Header Section (Title on left, Lihat Semua on right) -->
            <div class="flex items-center justify-between gap-4 reveal-on-scroll">
                <h2 class="text-xl sm:text-2xl lg:text-3xl font-extrabold text-[#2A1614] tracking-tight" style="font-family: 'DM Serif Display', serif;">
                    Upcoming Event
                </h2>
                <a href="{{ route('events') }}" class="group inline-flex items-center gap-1.5 text-xs sm:text-sm font-bold text-[#4D7C59] hover:text-[#3D6347] transition-colors">
                    <span>Lihat Semua</span>
                    <i class="fa-solid fa-arrow-right text-xs transform group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>

            <!-- Category Filter Badges -->
            @php
                $eventCategories = ['Semua', 'Webinar', 'Workshop', 'Kelas Prenatal', 'Kesehatan Anak'];
            @endphp
            <div class="flex items-center gap-2 sm:gap-2.5 overflow-x-auto pb-1 no-scrollbar reveal-on-scroll">
                @foreach ($eventCategories as $idx => $cat)
                    <button type="button" class="px-3.5 sm:px-4 py-1 sm:py-1.5 rounded-full text-xs font-semibold transition-colors duration-200 whitespace-nowrap {{ $idx === 0 ? 'bg-[#4D7C59] text-white font-bold shadow-xs' : 'bg-white text-[#5C4542] hover:text-[#2A1614] border border-gray-200 shadow-2xs' }}">
                        {{ $cat }}
                    </button>
                @endforeach
            </div>

            <!-- Cards Container -->
            <div class="grid grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-4 lg:gap-6 pt-0.5">
                @php
                    $events = [
                        [
                            'tag' => 'OFFLINE · JKT',
                            'tag_type' => 'offline',
                            'image' => 'https://images.unsplash.com/photo-1555252333-9f8e92e65df9?auto=format&fit=crop&w=800&q=80',
                            'date' => '22 Sep · 13.00 WIB',
                            'title' => 'Workshop Pijat Bayi untuk Ibu Baru',
                            'price' => 'Rp 150.000',
                            'category' => 'Workshop',
                            'is_free' => false,
                            'link' => route('events')
                        ],
                        [
                            'tag' => 'ONLINE',
                            'tag_type' => 'online',
                            'image' => 'https://images.unsplash.com/photo-1518611012118-696072aa579a?auto=format&fit=crop&w=800&q=80',
                            'date' => '30 Sep · 19.00 WIB',
                            'title' => 'Nutrisi Ibu Hamil Trimester 3',
                            'price' => 'Gratis',
                            'category' => 'Webinar',
                            'is_free' => true,
                            'link' => route('events')
                        ],
                        [
                            'tag' => 'ONLINE',
                            'tag_type' => 'online',
                            'image' => 'https://images.unsplash.com/photo-1545205597-3d9d02c29597?auto=format&fit=crop&w=800&q=80',
                            'date' => '12 Oct · 10.00 WIB',
                            'title' => 'Mindful Motherhood & Relaksasi',
                            'price' => 'Rp 75.000',
                            'category' => 'Kelas Prenatal',
                            'is_free' => false,
                            'link' => route('events')
                        ],
                    ];
                @endphp

                @foreach ($events as $index => $event)
                    <div class="reveal-on-scroll stagger-{{ $loop->iteration }} {{ $loop->iteration === 3 ? 'col-span-2 lg:col-span-1' : '' }}">
                        <x-event_card :event="$event" />
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- EBOOK SECTION (Tepat di bawah Upcoming Event) -->
    <section class="relative w-full bg-[#fcf5f3] pt-2 sm:pt-4 pb-6 sm:pb-8 px-4 sm:px-6 lg:px-8 overflow-hidden" style="font-family: 'Plus Jakarta Sans', sans-serif;">
        <!-- ── EBOOKS ACCESSORIES: 2 LINGKARAN DASHED BERTUMPUK DI KANAN ATAS & BLOB TERRACOTTA DI KIRI BAWAH ── -->
        <div class="absolute -top-6 right-4 sm:top-2 sm:right-16 pointer-events-none z-0 select-none opacity-40">
            <div class="relative w-32 h-32 sm:w-44 sm:h-44">
                <div class="absolute inset-0 rounded-full border-2 border-dashed border-[#DEAAA1] animate-spin-slow"></div>
                <div class="absolute top-3 left-3 w-26 h-26 sm:w-38 sm:h-38 rounded-full border-2 border-dashed border-[#8C433C]/60 animate-spin-slow" style="animation-direction: reverse; animation-duration: 25s;"></div>
            </div>
        </div>
        <div class="absolute -bottom-12 -left-12 w-48 sm:w-72 h-48 sm:h-72 bg-[#DEAAA1]/20 blur-2xl rounded-full animate-blob-morph-1 pointer-events-none z-0"></div>

        <div class="relative max-w-7xl mx-auto space-y-3.5 sm:space-y-4 z-10">
            
            {{-- Header Section (Title on left, Lihat Semua on right) --}}
            <div class="flex items-center justify-between gap-4 reveal-on-scroll">
                <h2 class="text-xl sm:text-2xl lg:text-3xl font-extrabold text-[#2A1614] tracking-tight" style="font-family: 'DM Serif Display', serif;">
                    E-Book Library
                </h2>
                <a href="{{ route('library') }}" class="group inline-flex items-center gap-1.5 text-xs sm:text-sm font-bold text-[#4D7C59] hover:text-[#3D6347] transition-colors">
                    <span>Lihat Semua</span>
                    <i class="fa-solid fa-arrow-right text-xs transform group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>

            {{-- Filter / Category Badges --}}
            @php
                $ebookCategories = [
                    'Semua',
                    'Parenting',
                    'Mental Health',
                    'Nutrisi',
                    'Self Care',
                    'Mindfulness'
                ];
            @endphp

            <div class="flex items-center gap-2 sm:gap-2.5 overflow-x-auto pb-1 no-scrollbar reveal-on-scroll">
                @foreach ($ebookCategories as $idx => $category)
                    <button 
                        type="button"
                        class="px-3.5 sm:px-4 py-1 sm:py-1.5 rounded-full text-xs font-semibold transition-colors duration-200 whitespace-nowrap cursor-pointer
                        {{ $idx === 0 
                            ? 'bg-[#4D7C59] text-white font-bold shadow-xs' 
                            : 'bg-white text-[#5C4542] hover:text-[#2A1614] border border-gray-200 shadow-2xs' 
                        }}">
                        {{ $category }}
                    </button>
                @endforeach
            </div>

            {{-- Product Grid --}}
            @php
                $products = [
                    [
                        'id' => 1,
                        'title' => "Panduan Nutrisi\nIbu Hamil",
                        'cover' => 'https://images.unsplash.com/photo-1544717305-2782549b5136?w=400&auto=format&fit=crop&q=80',
                        'book_title' => 'Nutrisi Lengkap & Menu Sehat Trimester 1-3',
                        'author' => 'Tim Ahli Gizi',
                        'price' => 'Gratis',
                        'link_text' => 'download pdf',
                        'handle' => '@maternity.id',
                        'btn_text' => 'Baca Sekarang',
                        'url' => route('library')
                    ],
                    [
                        'id' => 2,
                        'title' => "Mindful\nMotherhood",
                        'cover' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=400&auto=format&fit=crop&q=80',
                        'book_title' => 'Mengelola Emosi & Kecemasan Menjelang Persalinan',
                        'author' => 'Psikolog Maternitas',
                        'price' => 'Gratis',
                        'link_text' => 'download pdf',
                        'handle' => '@maternity.id',
                        'btn_text' => 'Baca Sekarang',
                        'url' => route('library')
                    ],
                    [
                        'id' => 3,
                        'title' => "E-Book Pijat\nBayi Baru Lahir",
                        'cover' => 'https://images.unsplash.com/photo-1517841905240-472988babdf9?w=400&auto=format&fit=crop&q=80',
                        'book_title' => 'Langkah Praktis Stimulasi Motorik Bayi',
                        'author' => 'Bidan Praktisi',
                        'price' => 'Gratis',
                        'link_text' => 'download pdf',
                        'handle' => '@maternity.id',
                        'btn_text' => 'Baca Sekarang',
                        'url' => route('library')
                    ],
                    [
                        'id' => 4,
                        'title' => "Panduan ASI &\nMenyusui Sukses",
                        'cover' => 'https://images.unsplash.com/photo-1524504388940-b1c1722653e1?w=400&auto=format&fit=crop&q=80',
                        'book_title' => 'Kiat Mengatasi Masalah Pelekatan & Produksi ASI',
                        'author' => 'Konselor Laktasi',
                        'price' => 'Gratis',
                        'link_text' => 'download pdf',
                        'handle' => '@maternity.id',
                        'btn_text' => 'Baca Sekarang',
                        'url' => route('library')
                    ],
                ];
            @endphp

            <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4 lg:gap-6 pt-0.5">
                @foreach ($products as $product)
                    <div class="reveal-on-scroll stagger-{{ $loop->iteration }}">
                        <x-ebook_card :ebook="$product" />
                    </div>
                @endforeach
            </div>

        </div>
    </section>

    <!-- ── WAVE DIVIDER: E-BOOK TO ARTIKEL KESEHATAN ── -->
    <div class="w-full overflow-hidden leading-none select-none pointer-events-none bg-[#fcf5f3] -mb-0.5">
        <svg class="w-full h-4 sm:h-8 lg:h-10 block text-[#FAF0EE]" viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
            <path d="M0,64L48,69.3C96,75,192,85,288,80C384,75,480,53,576,48C672,43,768,53,864,69.3C960,85,1056,107,1152,101.3C1248,96,1344,64,1392,48L1440,32L1440,120L1392,120C1344,120,1248,120,1152,120C1056,120,960,120,864,120C768,120,672,120,576,120C480,120,384,120,288,120C192,120,96,120,48,120L0,120Z" fill="currentColor"></path>
        </svg>
    </div>

    <!-- ARTIKEL KESEHATAN SECTION (SEO & GUEST DISCOVERY) -->
    <section class="relative w-full bg-[#FAF0EE] pt-2 sm:pt-4 pb-6 sm:pb-8 px-4 sm:px-6 lg:px-8 overflow-hidden" style="font-family: 'Plus Jakarta Sans', sans-serif;" x-data="{ activeTab: 'all' }">
        <!-- ── ARTICLES ACCESSORIES: SQUARE PATTERNS KIRI ATAS & KANAN BAWAH, DOT GRID DI POJOK KANAN ── -->
        <div class="absolute top-1 left-1 sm:top-3 sm:left-3 w-20 sm:w-28 h-20 sm:h-28 opacity-20 pointer-events-none z-0">
            <svg width="88" height="88" fill="none" viewBox="0 0 88 88">
                <pattern id="square-pattern-art-1" x="0" y="0" width="22" height="22" patternUnits="userSpaceOnUse">
                    <rect x="2" y="2" width="18" height="18" rx="3.5" stroke="#5F8C72" stroke-width="1.5" fill="#5F8C72" fill-opacity="0.1"/>
                </pattern>
                <rect width="88" height="88" fill="url(#square-pattern-art-1)"/>
            </svg>
        </div>
        <div class="absolute bottom-2 right-2 sm:bottom-4 sm:right-4 w-24 sm:w-32 h-24 sm:h-32 opacity-25 pointer-events-none z-0">
            <svg width="96" height="96" fill="none" viewBox="0 0 96 96">
                <pattern id="square-pattern-art-2" x="0" y="0" width="24" height="24" patternUnits="userSpaceOnUse">
                    <rect x="2" y="2" width="20" height="20" rx="4" stroke="#8C433C" stroke-width="1.5" stroke-dasharray="3 3" fill="#C27A6F" fill-opacity="0.08"/>
                </pattern>
                <rect width="96" height="96" fill="url(#square-pattern-art-2)"/>
            </svg>
        </div>
        <div class="absolute top-1/2 right-4 w-16 h-16 opacity-20 pointer-events-none z-0 hidden md:block">
            <svg width="60" height="60" fill="none" viewBox="0 0 60 60">
                <pattern id="dot-grid-art" x="0" y="0" width="12" height="12" patternUnits="userSpaceOnUse">
                    <circle cx="2" cy="2" r="1.5" fill="#8C433C"/>
                </pattern>
                <rect width="60" height="60" fill="url(#dot-grid-art)"/>
            </svg>
        </div>

        <div class="relative max-w-7xl mx-auto space-y-3.5 sm:space-y-4 z-10">
            <!-- Header Section (Title on left, Lihat Semua on right) -->
            <div class="flex items-center justify-between gap-4 reveal-on-scroll">
                <h2 class="text-xl sm:text-2xl lg:text-3xl font-extrabold text-[#2A1614] tracking-tight" style="font-family: 'DM Serif Display', serif;">
                    Artikel Kesehatan
                </h2>

                <a href="{{ route('articles.index') }}" class="group inline-flex items-center gap-1.5 text-xs sm:text-sm font-bold text-[#4D7C59] hover:text-[#3D6347] transition-colors">
                    <span>Lihat Semua</span>
                    <i class="fa-solid fa-arrow-right text-xs transform group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>

            <!-- Categories Tabs -->
            <div class="flex items-center gap-2 sm:gap-2.5 overflow-x-auto pb-1 no-scrollbar reveal-on-scroll">
                <!-- 1. Semua -->
                <button type="button" @click="activeTab = 'all'"
                    :class="activeTab === 'all' ? 'bg-[#5F8C72] text-white font-bold shadow-xs' : 'bg-white border border-[#EADBDB] text-neutral-800 hover:bg-[#FAF0EE] font-medium'"
                    class="px-3.5 sm:px-4 py-1 sm:py-1.5 rounded-full text-xs transition-all duration-200 whitespace-nowrap cursor-pointer transform hover:scale-105 active:scale-95 shrink-0">
                    Semua
                </button>

                <!-- 2. Trimester 1 -->
                <button type="button" @click="activeTab = 'trimester-1'"
                    :class="activeTab === 'trimester-1' ? 'bg-[#5F8C72] text-white font-bold shadow-xs' : 'bg-white border border-[#EADBDB] text-neutral-800 hover:bg-[#FAF0EE] font-medium'"
                    class="px-3.5 sm:px-4 py-1 sm:py-1.5 rounded-full text-xs transition-all duration-200 whitespace-nowrap cursor-pointer transform hover:scale-105 active:scale-95 shrink-0">
                    Trimester 1
                </button>

                <!-- 3. Trimester 2 -->
                <button type="button" @click="activeTab = 'trimester-2'"
                    :class="activeTab === 'trimester-2' ? 'bg-[#5F8C72] text-white font-bold shadow-xs' : 'bg-white border border-[#EADBDB] text-neutral-800 hover:bg-[#FAF0EE] font-medium'"
                    class="px-3.5 sm:px-4 py-1 sm:py-1.5 rounded-full text-xs transition-all duration-200 whitespace-nowrap cursor-pointer transform hover:scale-105 active:scale-95 shrink-0">
                    Trimester 2
                </button>

                <!-- 4. Trimester 3 -->
                <button type="button" @click="activeTab = 'trimester-3'"
                    :class="activeTab === 'trimester-3' ? 'bg-[#5F8C72] text-white font-bold shadow-xs' : 'bg-white border border-[#EADBDB] text-neutral-800 hover:bg-[#FAF0EE] font-medium'"
                    class="px-3.5 sm:px-4 py-1 sm:py-1.5 rounded-full text-xs transition-all duration-200 whitespace-nowrap cursor-pointer transform hover:scale-105 active:scale-95 shrink-0">
                    Trimester 3
                </button>

                <!-- 5. Nutrisi Ibu -->
                <button type="button" @click="activeTab = 'nutrisi'"
                    :class="activeTab === 'nutrisi' ? 'bg-[#5F8C72] text-white font-bold shadow-xs' : 'bg-white border border-[#EADBDB] text-neutral-800 hover:bg-[#FAF0EE] font-medium'"
                    class="px-3.5 sm:px-4 py-1 sm:py-1.5 rounded-full text-xs transition-all duration-200 whitespace-nowrap cursor-pointer transform hover:scale-105 active:scale-95 shrink-0">
                    Nutrisi Ibu
                </button>

                <!-- 6. Persalinan -->
                <button type="button" @click="activeTab = 'persalinan'"
                    :class="activeTab === 'persalinan' ? 'bg-[#5F8C72] text-white font-bold shadow-xs' : 'bg-white border border-[#EADBDB] text-neutral-800 hover:bg-[#FAF0EE] font-medium'"
                    class="px-3.5 sm:px-4 py-1 sm:py-1.5 rounded-full text-xs transition-all duration-200 whitespace-nowrap cursor-pointer transform hover:scale-105 active:scale-95 shrink-0">
                    Persalinan
                </button>

                <!-- 7. Perawatan Bayi -->
                <button type="button" @click="activeTab = 'bayi'"
                    :class="activeTab === 'bayi' ? 'bg-[#5F8C72] text-white font-bold shadow-xs' : 'bg-white border border-[#EADBDB] text-neutral-800 hover:bg-[#FAF0EE] font-medium'"
                    class="px-3.5 sm:px-4 py-1 sm:py-1.5 rounded-full text-xs transition-all duration-200 whitespace-nowrap cursor-pointer transform hover:scale-105 active:scale-95 shrink-0">
                    Perawatan Bayi
                </button>
            </div>

            <!-- Articles Grid (2 Kolom Bersih) -->
            @php
                $articles = [
                    [
                        'category_slug' => 'trimester-2',
                        'category_name' => 'Trimester 2',
                        'title' => '7 Gerakan Yoga Aman untuk Ibu Hamil di Trimester Kedua',
                        'meta' => '5 Sep 2026 · 5 mnt baca',
                        'image' => 'https://images.unsplash.com/photo-1545205597-3d9d02c29597?auto=format&fit=crop&w=500&q=80',
                        'link' => route('articles.show', 'cara-mengelola-stres-pada-ibu-hamil'),
                    ],
                    [
                        'category_slug' => 'nutrisi',
                        'category_name' => 'Nutrisi Ibu',
                        'title' => 'Asupan Zat Besi: Kunci Cegah Anemia Kehamilan',
                        'meta' => '3 Sep 2026 · 7 mnt baca',
                        'image' => 'https://images.unsplash.com/photo-1555252333-9f8e92e65df9?auto=format&fit=crop&w=500&q=80',
                        'link' => route('articles.show', 'nutrisi-seimbang-untuk-ibu-hamil'),
                    ],
                    [
                        'category_slug' => 'trimester-1',
                        'category_name' => 'Trimester 1',
                        'title' => 'Mengatasi Morning Sickness di Awal Masa Kehamilan',
                        'meta' => '1 Sep 2026 · 4 mnt baca',
                        'image' => 'https://images.unsplash.com/photo-1584515979956-d9f6e5d09982?auto=format&fit=crop&w=500&q=80',
                        'link' => route('articles.show', 'nutrisi-seimbang-untuk-ibu-hamil'),
                    ],
                    [
                        'category_slug' => 'trimester-3',
                        'category_name' => 'Trimester 3',
                        'title' => 'Tanda-Tanda Kontraksi Asli vs Palsu Menjelang HPL',
                        'meta' => '28 Agu 2026 · 6 mnt baca',
                        'image' => 'https://images.unsplash.com/photo-1518611012118-696072aa579a?auto=format&fit=crop&w=500&q=80',
                        'link' => route('articles.show', 'nutrisi-seimbang-untuk-ibu-hamil'),
                    ],
                    [
                        'category_slug' => 'persalinan',
                        'category_name' => 'Persalinan',
                        'title' => 'Mengenal Metode Gentle Birth untuk Persalinan yang Tenang',
                        'meta' => '25 Agu 2026 · 5 mnt baca',
                        'image' => 'https://images.unsplash.com/photo-1516589178581-6cd7833ae3b2?auto=format&fit=crop&w=500&q=80',
                        'link' => route('articles.show', 'peran-suami-mendampingi-kehamilan'),
                    ],
                    [
                        'category_slug' => 'bayi',
                        'category_name' => 'Perawatan Bayi',
                        'title' => 'Panduan Membangun Pola Tidur Teratur pada Bayi Baru Lahir',
                        'meta' => '22 Agu 2026 · 6 mnt baca',
                        'image' => 'https://images.unsplash.com/photo-1519689680058-324335c77eba?auto=format&fit=crop&w=500&q=80',
                        'link' => route('articles.show', 'pola-tidur-bayi-baru-lahir'),
                    ],
                ];
            @endphp

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-3 sm:gap-4">
                @foreach ($articles as $article)
                    <a href="{{ $article['link'] }}" 
                       x-show="activeTab === 'all' || activeTab === '{{ $article['category_slug'] }}'"
                       x-transition
                       class="group bg-white rounded-2xl sm:rounded-3xl border border-[#EADBDB]/60 hover:border-[#5F8C72]/60 p-2.5 sm:p-3.5 flex items-center justify-between gap-3 sm:gap-4 shadow-xs hover:shadow-md card-spring reveal-on-scroll stagger-{{ ($loop->iteration % 4) + 1 }}">
                        
                        <!-- Left: Thumbnail & Text Info -->
                        <div class="flex items-center gap-3 sm:gap-3.5 overflow-hidden min-w-0 flex-1">
                            <!-- Image Thumbnail (Rounded Square) -->
                            <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-xl sm:rounded-2xl overflow-hidden bg-neutral-100 shrink-0">
                                <img src="{{ $article['image'] }}" alt="{{ $article['title'] }}" class="w-full h-full object-cover group-hover:scale-108 transition-transform duration-500 ease-out" loading="lazy">
                            </div>

                            <!-- Text Content -->
                            <div class="min-w-0 space-y-1 sm:space-y-1.5">
                                <!-- Category Badge -->
                                <span class="inline-block px-2.5 py-0.5 bg-[#EDF5F0] text-[#5F8C72] text-[9px] sm:text-[10px] font-semibold rounded-full">
                                    {{ $article['category_name'] }}
                                </span>

                                <!-- Title -->
                                <h3 class="font-bold text-xs sm:text-sm text-[#2D1E1E] leading-snug line-clamp-2 group-hover:text-[#5F8C72] transition-colors">
                                    {{ $article['title'] }}
                                </h3>

                                <!-- Date & Read Time -->
                                <p class="text-[10px] sm:text-[11px] text-neutral-400 font-medium">
                                    {{ $article['meta'] }}
                                </p>
                            </div>
                        </div>

                        <!-- Right: Sage Green Arrow Button -->
                        <div class="shrink-0 pl-1">
                            <div class="w-8 h-8 sm:w-9 sm:h-9 rounded-full bg-[#5F8C72] group-hover:bg-[#4d725d] text-white flex items-center justify-center group-hover:scale-110 group-hover:translate-x-0.5 transition-all duration-300 shadow-xs">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                </svg>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

        </div>
    </section>

    <!-- ── WAVE DIVIDER: ARTIKEL TO PRODUK PILIHAN ── -->
    <div class="w-full overflow-hidden leading-none select-none pointer-events-none bg-[#FAF0EE] -mb-0.5">
        <svg class="w-full h-4 sm:h-8 lg:h-10 block text-[#fcf5f3]" viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
            <path d="M0,48L60,58.7C120,69,240,91,360,85.3C480,80,600,48,720,37.3C840,27,960,37,1080,53.3C1200,69,1320,91,1380,101.3L1440,112L1440,120L1380,120C1320,120,1200,120,1080,120C960,120,840,120,720,120C600,120,480,120,360,120C240,120,120,120,60,120L0,120Z" fill="currentColor"></path>
        </svg>
    </div>

    <!-- PHYSICAL PRODUCT / SHOP SECTION (Setelah Artikel) -->
    <section class="relative w-full bg-[#fcf5f3] bg-diagonal-lines pt-2 sm:pt-4 pb-6 sm:pb-8 px-4 sm:px-6 lg:px-8 overflow-hidden" style="font-family: 'Plus Jakarta Sans', sans-serif;">
        <!-- ── PRODUCTS ACCESSORIES: BLOB ROSE DI KANAN ATAS ── -->
        <div class="absolute -top-16 -right-16 w-56 sm:w-80 h-56 sm:h-80 bg-[#DEA69E]/25 blur-3xl rounded-full animate-blob-morph-1 pointer-events-none z-0"></div>

        <div class="relative max-w-7xl mx-auto space-y-3.5 sm:space-y-4 z-10">

            {{-- Header Section (Title on left, Lihat Semua on right) --}}
            <div class="flex items-center justify-between gap-4 reveal-on-scroll">
                <h2 class="text-xl sm:text-2xl lg:text-3xl font-extrabold text-[#2A1614] tracking-tight" style="font-family: 'DM Serif Display', serif;">
                    Produk Pilihan
                </h2>

                <a href="{{ route('product') }}" class="group inline-flex items-center gap-1.5 text-xs sm:text-sm font-bold text-[#4D7C59] hover:text-[#3D6347] transition-colors">
                    <span>Lihat Semua</span>
                    <i class="fa-solid fa-arrow-right text-xs transform group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>

            {{-- Category Tabs --}}
            @php
                $productCategories = ['Semua', 'Perlengkapan Nakes', 'Kebutuhan Wanita', 'Herbal & Vitamin'];
            @endphp

            <div class="flex items-center gap-2 sm:gap-2.5 overflow-x-auto pb-1 no-scrollbar reveal-on-scroll">
                @foreach ($productCategories as $idx => $category)
                    <button 
                        type="button"
                        class="px-3.5 sm:px-4 py-1 sm:py-1.5 rounded-full text-xs font-semibold transition-colors duration-200 whitespace-nowrap cursor-pointer
                        {{ $idx === 0 
                            ? 'bg-[#4D7C59] text-white font-bold shadow-xs' 
                            : 'bg-white text-[#5C4542] hover:text-[#2A1614] border border-gray-200 shadow-2xs' 
                        }}">
                        {{ $category }}
                    </button>
                @endforeach
            </div>

            {{-- Product Grid --}}
            @php
                $physicalProducts = [
                    [
                        'id' => 1,
                        'title' => 'Seragam Bidan Premium',
                        'tag' => 'Nakes',
                        'image' => 'https://images.unsplash.com/photo-1584515979956-d9f6e5d09982?w=600&auto=format&fit=crop&q=80',
                        'location' => 'Jakarta',
                        'price' => 'Rp 285.000',
                        'sold' => '120+',
                        'tiktok_url' => route('product')
                    ],
                    [
                        'id' => 2,
                        'title' => 'Nursing Bra 2–Pack',
                        'tag' => 'Wanita',
                        'image' => 'https://images.unsplash.com/photo-1518611012118-696072aa579a?w=600&auto=format&fit=crop&q=80',
                        'location' => 'Surabaya',
                        'price' => 'Rp 179.000',
                        'sold' => '85+',
                        'tiktok_url' => route('product')
                    ],
                    [
                        'id' => 3,
                        'title' => 'Bantal Hamil Ergonomis U-Shape',
                        'tag' => 'Ibu Hamil',
                        'image' => 'https://images.unsplash.com/photo-1555252333-9f8e92e65df9?w=600&auto=format&fit=crop&q=80',
                        'location' => 'Bandung',
                        'price' => 'Rp 210.000',
                        'sold' => '64+',
                        'tiktok_url' => route('product')
                    ],
                    [
                        'id' => 4,
                        'title' => 'Maternity Care Herbal Oil 100ml',
                        'tag' => 'Herbal',
                        'image' => 'https://images.unsplash.com/photo-1545205597-3d9d02c29597?w=600&auto=format&fit=crop&q=80',
                        'location' => 'Yogyakarta',
                        'price' => 'Rp 125.000',
                        'sold' => '210+',
                        'tiktok_url' => route('product')
                    ],
                ];
            @endphp

            <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-4 lg:gap-5">
                @foreach ($physicalProducts as $product)
                    <div class="reveal-on-scroll stagger-{{ $loop->iteration }}">
                        <x-product_card :product="$product" />
                    </div>
                @endforeach
            </div>

        </div>
    </section>

    <!-- ── WAVE DIVIDER: PRODUK PILIHAN TO BOTTOM ── -->
    <div class="w-full overflow-hidden leading-none select-none pointer-events-none bg-[#fcf5f3] -mb-0.5">
        <svg class="w-full h-4 sm:h-8 lg:h-10 block text-[#FAF0EE]" viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
            <path d="M0,32L48,42.7C96,53,192,75,288,80C384,85,480,75,576,58.7C672,43,768,21,864,26.7C960,32,1056,64,1152,74.7C1248,85,1344,75,1392,69.3L1440,64L1440,120L1392,120C1344,120,1248,120,1152,120C1056,120,960,120,864,120C768,120,672,120,576,120C480,120,384,120,288,120C192,120,96,120,48,120L0,120Z" fill="currentColor"></path>
        </svg>
    </div>

    <!-- ── INTERACTIVE ARCHITECTURAL GRID BANNER (KOMUNITAS & KONSULTASI) ── -->
    <div class="py-3 sm:py-5 bg-[#FAF0EE]">
        <x-grid_hero_banner 
            badge="Komunitas & Konsultasi Bidan"
            title="Pendampingan Kesehatan Ibu & Bayi Terpadu"
            subtitle="Bergabunglah dengan ribuan ibu di Indonesia untuk mendapatkan materi parenting, webinar eksklusif, serta bimbingan langsung dari bidan dan dokter terpercaya."
            primaryText="Daftar Event Terdekat"
            :primaryUrl="route('events')"
            secondaryText="Tanya Bidan Sekarang"
            secondaryUrl="https://wa.me/"
        />
    </div>

    <!-- ── SINGLE EXPANDABLE FLOATING ACTION BUTTON (Pojok Kanan Bawah: 1 Tombol Utama yang Menampilkan Menu saat Ditekan) ── -->
    <div x-data="{ openFab: false }" 
         @click.away="openFab = false"
         class="fixed bottom-16 right-3 sm:bottom-8 sm:right-8 z-50 flex flex-col items-end gap-2.5 select-none">
        
        <!-- ── Popup Sub-Menu Items (Muncul ke atas saat tombol utama ditekan) ── -->
        <div x-show="openFab"
             x-transition:enter="transition ease-out duration-300 transform"
             x-transition:enter-start="opacity-0 translate-y-4 scale-90"
             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
             x-transition:leave="transition ease-in duration-200 transform"
             x-transition:leave-start="opacity-100 translate-y-0 scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 scale-90"
             class="flex flex-col items-end gap-2"
             style="display: none;">

            <!-- 1. Ajukan Event (Khusus Mobile: md:hidden) -->
            <a href="{{ route('events') }}" 
               class="md:hidden flex items-center gap-2 bg-[#7A9E7E] hover:bg-[#5a7a66] text-white px-3.5 py-2 rounded-full shadow-[0_8px_20px_rgba(122,158,126,0.4)] border border-white transition-all transform hover:scale-105 active:scale-95 text-[11px] font-bold group">
                <span>Ajukan Event</span>
                <span class="w-6 h-6 rounded-full bg-white/20 flex items-center justify-center">
                    <i class="fa-solid fa-calendar-plus text-xs"></i>
                </span>
            </a>

            <!-- 2. Instagram (Tampil di Mobile & Desktop) -->
            <a href="https://instagram.com/maternity.id" target="_blank"
               class="flex items-center gap-2 bg-gradient-to-r from-[#f9ce34] via-[#ee2a7b] to-[#6228d7] text-white px-3.5 py-2 rounded-full shadow-[0_8px_20px_rgba(238,42,123,0.35)] border border-white transition-all transform hover:scale-105 active:scale-95 text-[11px] font-bold group">
                <span class="hidden sm:inline">Instagram</span>
                <span class="w-6 h-6 rounded-full bg-white/20 flex items-center justify-center">
                    <i class="fa-brands fa-instagram text-xs"></i>
                </span>
            </a>

            <!-- 3. WhatsApp (Tampil di Mobile & Desktop) -->
            <a href="https://wa.me/" target="_blank"
               class="flex items-center gap-2 bg-[#25D366] hover:bg-[#20ba5a] text-white px-3.5 py-2 rounded-full shadow-[0_8px_20px_rgba(37,211,102,0.35)] border border-white transition-all transform hover:scale-105 active:scale-95 text-[11px] font-bold group">
                <span class="hidden sm:inline">WhatsApp Kami</span>
                <span class="w-6 h-6 rounded-full bg-white/20 flex items-center justify-center">
                    <i class="fa-brands fa-whatsapp text-sm"></i>
                </span>
            </a>

        </div>

        <!-- ── Main Trigger Button (Tombol Utama FAB dengan Ikon Komunikasi/Bantuan) ── -->
        <button type="button" 
                @click="openFab = !openFab"
                class="w-11 h-11 sm:w-14 sm:h-14 bg-gradient-to-tr from-[#C27A6F] to-[#8C433C] hover:from-[#8C433C] hover:to-[#782819] text-white rounded-full flex items-center justify-center shadow-[0_8px_20px_rgba(140,67,60,0.4)] border-2 border-white transition-all transform hover:scale-110 active:scale-95 focus:outline-none relative group"
                aria-label="Hubungi & Menu Cepat"
                title="Bantuan & Layanan">
            <i class="fa-solid text-base sm:text-2xl transition-transform duration-300"
               :class="openFab ? 'fa-xmark rotate-90 text-white' : 'fa-comment-dots group-hover:scale-110'"></i>
        </button>

    </div>

    <!-- ── Intersection Observer Script untuk Animasi Scroll Mulus ── -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const reveals = document.querySelectorAll('.reveal-on-scroll');
            
            const observer = new IntersectionObserver((entries, obs) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-revealed');
                        obs.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.12,
                rootMargin: '0px 0px -40px 0px'
            });

            reveals.forEach(el => observer.observe(el));
        });
    </script>
</x-layout>
