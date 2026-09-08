<x-layout title="Empowering Women's Health">
    <x-slot name="head">
        <!-- Google Fonts & FontAwesome -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link
            href="https://fonts.googleapis.com/css2?family=Caveat:wght@600&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
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
        </style>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
        <!-- HERO SECTION -->
        <div
            class="relative flex items-center justify-center min-h-[420px] sm:min-h-[480px] lg:min-h-[540px] pt-6 sm:pt-10 pb-8 sm:pb-12 overflow-hidden">

            <!-- ── AMBIENT BACKGROUND FOTO UNTUK TAMPILAN HP / MOBILE (md:hidden) DENGAN SUDUT LENGKUNG UTUH ── -->
            <div class="md:hidden absolute inset-0 pointer-events-none z-0 overflow-hidden select-none">
                <!-- Foto 1: Kiri Atas (Slanted Left-Top dengan Rounded Corners Utuh) -->
                <div class="absolute top-2 left-2 w-32 min-[400px]:w-36 h-36 min-[400px]:h-40 rounded-2xl overflow-hidden opacity-25 clip-slant-left-top bg-[#FAF0EE]/80 p-0.5 shadow-sm">
                    <img src="https://images.unsplash.com/photo-1545205597-3d9d02c29597?auto=format&fit=crop&q=80&w=400"
                        alt="Yoga" class="w-full h-full object-cover rounded-2xl">
                </div>
                <!-- Foto 2: Kiri Bawah (Slanted Left-Bottom dengan Rounded Corners Utuh) -->
                <div class="absolute bottom-2 left-2 w-32 min-[400px]:w-36 h-36 min-[400px]:h-40 rounded-2xl overflow-hidden opacity-25 clip-slant-left-bottom bg-[#FAF0EE]/80 p-0.5 shadow-sm">
                    <img src="https://images.unsplash.com/photo-1555252333-9f8e92e65df9?auto=format&fit=crop&q=80&w=400"
                        alt="Mother and Baby" class="w-full h-full object-cover rounded-2xl">
                </div>
                <!-- Foto 3: Kanan Atas (Slanted Right-Bottom dengan Rounded Corners Utuh) -->
                <div class="absolute top-2 right-2 w-32 min-[400px]:w-36 h-36 min-[400px]:h-40 rounded-2xl overflow-hidden opacity-25 clip-slant-right-bottom bg-[#FAF0EE]/80 p-0.5 shadow-sm">
                    <img src="https://images.unsplash.com/photo-1518611012118-696072aa579a?auto=format&fit=crop&q=80&w=400"
                        alt="Prenatal Wellness" class="w-full h-full object-cover rounded-2xl">
                </div>
                <!-- Foto 4: Kanan Bawah (Slanted Right-Top dengan Rounded Corners Utuh) -->
                <div class="absolute bottom-2 right-2 w-32 min-[400px]:w-36 h-36 min-[400px]:h-40 rounded-2xl overflow-hidden opacity-25 clip-slant-right-top bg-[#FAF0EE]/80 p-0.5 shadow-sm">
                    <img src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?auto=format&fit=crop&q=80&w=400"
                        alt="Workshop" class="w-full h-full object-cover rounded-2xl">
                </div>
                <!-- Soft Gradient Veil -->
                <div class="absolute inset-0 bg-gradient-to-b from-[#FAF0EE]/20 via-transparent to-[#FAF0EE]/40"></div>
            </div>

            <!-- ── GAMBAR DEKORASI DESKTOP / TABLET - KIRI (hidden md:flex) ── -->
            <div
                class="hidden md:flex flex-col justify-start gap-6 lg:gap-8 xl:gap-10 absolute left-0 top-2 bottom-0 w-36 lg:w-60 xl:w-72 pointer-events-none z-0">
                <!-- Foto Kiri Atas (Yoga) -->
                <div
                    class="w-full h-36 lg:h-52 xl:h-60 rounded-2xl overflow-hidden shadow-lg opacity-90 hover:opacity-100 transition clip-slant-left-top bg-[#FAF0EE]/60 p-0.5">
                    <img src="https://images.unsplash.com/photo-1545205597-3d9d02c29597?auto=format&fit=crop&q=80&w=600"
                        alt="Yoga Class" class="w-full h-full object-cover rounded-xl">
                </div>
                <!-- Foto Kiri Bawah (Ibu dan Bayi) -->
                <div
                    class="w-full h-36 lg:h-52 xl:h-60 rounded-2xl overflow-hidden shadow-lg opacity-90 hover:opacity-100 transition clip-slant-left-bottom bg-[#FAF0EE]/60 p-0.5">
                    <img src="https://images.unsplash.com/photo-1555252333-9f8e92e65df9?auto=format&fit=crop&q=80&w=600"
                        alt="Mother and Baby" class="w-full h-full object-cover rounded-xl">
                </div>
            </div>

            <!-- ── GAMBAR DEKORASI DESKTOP / TABLET - KANAN (hidden md:flex) ── -->
            <div
                class="hidden md:flex flex-col justify-start gap-6 lg:gap-8 xl:gap-10 absolute right-0 top-2 bottom-0 w-36 lg:w-60 xl:w-72 pointer-events-none z-0">
                <!-- Foto Kanan Atas (Prenatal Exercise / Health) -->
                <div
                    class="w-full h-36 lg:h-52 xl:h-60 rounded-2xl overflow-hidden shadow-lg opacity-90 hover:opacity-100 transition clip-slant-right-bottom bg-[#FAF0EE]/60 p-0.5">
                    <img src="https://images.unsplash.com/photo-1518611012118-696072aa579a?auto=format&fit=crop&q=80&w=600"
                        alt="Prenatal Wellness" class="w-full h-full object-cover rounded-xl">
                </div>
                <!-- Foto Kanan Bawah (Seminar Event / Workshop) -->
                <div
                    class="w-full h-36 lg:h-52 xl:h-60 rounded-2xl overflow-hidden shadow-lg opacity-90 hover:opacity-100 transition clip-slant-right-top bg-[#FAF0EE]/60 p-0.5">
                    <img src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?auto=format&fit=crop&q=80&w=600"
                        alt="Seminar Event" class="w-full h-full object-cover rounded-xl">
                </div>
            </div>

            <!-- CONTENT UTAMA (Tengah, Rapi, & Jernih di Depan Background) -->
            <div class="max-w-2xl text-center z-10 px-4 sm:px-6">
                <h1
                    class="text-3xl sm:text-5xl lg:text-6xl font-semibold text-[#3D2B2B] tracking-tight leading-tight mb-2"
                    style="font-family: 'Lexend', sans-serif;">
                    Empowering Women's
                </h1>
                <p class="font-handwriting text-3xl sm:text-5xl lg:text-6xl text-[#5F8A6E] font-bold mb-4 sm:mb-8">
                    Health Awareness
                </p>

                <p class="text-gray-600 text-xs sm:text-base leading-relaxed sm:leading-loose mb-6 sm:mb-10 max-w-xl mx-auto font-medium" style="font-family: 'Lexend', sans-serif;">
                    Temukan seminar, pelatihan, konsultasi, dan e-book terpercaya untuk mendampingi perjalanan Anda, mulai dari persiapan<br
                        class="hidden sm:block">
                    kehamilan hingga tumbuh kembang buah hati.
                </p>

                <!-- Action Buttons -->
                <div class="flex flex-row items-center justify-center gap-3 sm:gap-5 mt-2 sm:mt-4">
                    <!-- Akses Ebook Button -->
                    <a href="{{ url('/library') }}"
                        class="bg-transparent hover:bg-[#C27A6F] border-2 border-[#C27A6F] text-[#C27A6F] hover:text-white font-bold px-6 sm:px-10 py-2.5 sm:py-3.5 rounded-xl sm:rounded-2xl shadow-xs hover:shadow-md transition-all duration-200 text-xs sm:text-base text-center transform hover:scale-[1.02] active:scale-95 whitespace-nowrap">
                        Akses Ebook
                    </a>
                    
                    <!-- Akses Seminar Button -->
                    <a href="{{ url('/seminars') }}"
                        class="bg-transparent hover:bg-[#C27A6F] border-2 border-[#C27A6F] text-[#C27A6F] hover:text-white font-bold px-6 sm:px-10 py-2.5 sm:py-3.5 rounded-xl sm:rounded-2xl shadow-xs hover:shadow-md transition-all duration-200 text-xs sm:text-base text-center transform hover:scale-[1.02] active:scale-95 whitespace-nowrap">
                        Akses Seminar
                    </a>
                </div>
            </div>

        </div>
    </div>

    <!-- UPCOMING EVENT SECTION -->
    <section class="w-full bg-[#fcf5f3] pt-4 sm:pt-6 pb-16 px-4 sm:px-6 lg:px-8" style="font-family: 'Plus Jakarta Sans', sans-serif;">
        <div class="max-w-7xl mx-auto">
            <!-- Header Section -->
            <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-8 gap-4 reveal-on-scroll">
                <div>
                    <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-[#3D2B2B] tracking-tight" style="font-family: 'Plus Jakarta Sans', sans-serif;">
                        Upcoming Event
                    </h2>
                    <p class="mt-2 text-sm sm:text-base text-neutral-600 font-medium" style="font-family: 'Plus Jakarta Sans', sans-serif;">
                        Join our expert-led sessions designed to empower and inform
                    </p>
                </div>
                <a href="{{ route('events') }}" class="group inline-flex items-center gap-1.5 text-sm font-bold text-[#7A9E7E] hover:text-[#5a7a66] transition-all duration-200" style="font-family: 'Plus Jakarta Sans', sans-serif;">
                    <span>View All Calendar</span>
                    <i class="fa-solid fa-arrow-right text-xs transform group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>

            <!-- Cards Grid (2 Kolom berdampingan di mobile, 3 Kolom di desktop) -->
            <div class="grid grid-cols-2 lg:grid-cols-3 gap-3.5 sm:gap-6 lg:gap-8">
                @php
                    // Data dummy event (dapat diganti dengan data dari Controller/Database)
                    $events = [
                        [
                            'tag' => 'ONLINE',
                            'image' => 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=800&q=80',
                            'date' => 'Oct 12, 2024',
                            'time' => '10:00 AM',
                            'title' => 'Mindful Motherhood',
                            'description' => 'Building mental resilience and community during early parenting stages',
                            'link' => route('events')
                        ],
                        [
                            'tag' => 'OFFLINE-UNS',
                            'image' => 'https://images.unsplash.com/photo-1518611012118-696072aa579a?auto=format&fit=crop&w=800&q=80',
                            'date' => 'Oct 12, 2024',
                            'time' => '10:00 AM',
                            'title' => 'Holistic Hormone Health',
                            'description' => 'A deep dive into balancing your cycle naturally with Dr. Jenkins',
                            'link' => route('events')
                        ],
                        [
                            'tag' => 'ONLINE',
                            'image' => 'https://images.unsplash.com/photo-1545205597-3d9d02c29597?auto=format&fit=crop&w=800&q=80',
                            'date' => 'Oct 12, 2024',
                            'time' => '10:00 AM',
                            'title' => 'Mindful Motherhood',
                            'description' => 'Building mental resilience and community during early parenting stages',
                            'link' => route('events')
                        ],
                    ];
                @endphp

                @foreach ($events as $index => $event)
                    <div class="group bg-[#FAF0EE] rounded-2xl sm:rounded-3xl border border-[#DEA69E]/50 hover:border-[#DEA69E] p-2.5 sm:p-4 flex flex-col justify-between shadow-sm card-spring reveal-on-scroll stagger-{{ $loop->iteration }}">
                        <div>
                            <!-- Image Container -->
                            <div class="relative w-full h-32 sm:h-48 lg:h-52 rounded-xl sm:rounded-2xl overflow-hidden mb-2.5 sm:mb-4 bg-gray-100">
                                <img src="{{ $event['image'] }}" alt="{{ $event['title'] }}" class="w-full h-full object-cover transform group-hover:scale-108 transition-transform duration-700 ease-out">
                                
                                <!-- Badge/Tag -->
                                <span class="absolute top-2 sm:top-3 left-2 sm:left-3 bg-[#e8a394]/95 backdrop-blur-xs text-[#782819] text-[9px] sm:text-[11px] font-bold tracking-wider px-2 sm:px-3 py-0.5 sm:py-1 rounded-full uppercase shadow-xs transition-all duration-300 group-hover:scale-105 group-hover:bg-[#DEA69E]">
                                    {{ $event['tag'] }}
                                </span>
                            </div>

                            <!-- Content Details -->
                            <div class="px-1 sm:px-2">
                                <!-- Date & Time -->
                                <div class="flex items-center text-[10px] sm:text-xs font-semibold text-[#c86d5c] mb-1 sm:mb-2 space-x-1 sm:space-x-1.5">
                                    <svg class="w-3 h-3 sm:w-4 sm:h-4 inline-block -mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <span class="truncate">{{ $event['date'] }} &bull; {{ $event['time'] }}</span>
                                </div>

                                <!-- Title -->
                                <h3 class="text-xs sm:text-lg font-bold text-[#3D2B2B] mb-1 sm:mb-2 leading-snug group-hover:text-[#80382D] transition-colors duration-200 line-clamp-2">
                                    {{ $event['title'] }}
                                </h3>

                                <!-- Description -->
                                <p class="text-neutral-500 text-[11px] sm:text-sm leading-relaxed mb-2.5 sm:mb-5 line-clamp-2">
                                    {{ $event['description'] }}
                                </p>
                            </div>
                        </div>

                        <!-- Action Button -->
                        <div class="px-0.5 sm:px-2 pb-0.5 sm:pb-1 pt-1 sm:pt-2">
                            <a href="{{ $event['link'] }}" class="block w-full text-center py-2 sm:py-2.5 px-2 sm:px-4 bg-[#f0c2b8] group-hover:bg-[#e8a89b] hover:!bg-[#C27A6F] text-[#782819] hover:!text-white font-bold text-xs sm:text-sm rounded-xl sm:rounded-2xl transition-all duration-300 shadow-xs hover:shadow-md transform active:scale-95">
                                View Detail
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- EBOOK SECTION (Tepat di bawah Upcoming Event) -->
    <section class="w-full bg-[#fcf5f3] pt-4 sm:pt-6 pb-16 px-4 sm:px-6 lg:px-8" style="font-family: 'Plus Jakarta Sans', sans-serif;">
        <div class="max-w-7xl mx-auto space-y-8">
            
            {{-- Header Section (Disamakan dengan Upcoming Event) --}}
            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 pb-2 reveal-on-scroll">
                <div>
                    <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-[#3D2B2B] tracking-tight" style="font-family: 'Plus Jakarta Sans', sans-serif;">
                        Ebook
                    </h2>
                    <p class="mt-2 text-sm sm:text-base text-neutral-600 font-medium" style="font-family: 'Plus Jakarta Sans', sans-serif;">
                        Access our curated collection of expert-approved health resources.
                    </p>
                </div>
                
                <a href="{{ route('library') }}" class="group inline-flex items-center gap-1.5 text-sm font-bold text-[#7A9E7E] hover:text-[#5a7a66] transition-all duration-200" style="font-family: 'Plus Jakarta Sans', sans-serif;">
                    <span>View All Ebooks</span>
                    <i class="fa-solid fa-arrow-right text-xs transform group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>

            {{-- Filter / Category Badges --}}
            @php
                $activeCategory = 'Parenting';
                $categories = [
                    'Parenting',
                    'Mental Health',
                    'Nutrition Guide',
                    'Self Growth',
                    'Mindfulness'
                ];
            @endphp

            <div class="flex items-center gap-2.5 sm:gap-3 overflow-x-auto pb-2 no-scrollbar reveal-on-scroll">
                @foreach ($categories as $category)
                    @php $isActive = $category === $activeCategory; @endphp
                    <button 
                        type="button"
                        class="px-4 sm:px-6 py-2 sm:py-2.5 rounded-full text-xs sm:text-sm font-semibold transition-all duration-200 whitespace-nowrap cursor-pointer transform hover:scale-105 active:scale-95
                        {{ $isActive 
                            ? 'bg-[#F2C4BA] text-[#782819] font-bold border border-[#C27A6F] shadow-xs' 
                            : 'bg-white/60 text-[#782819] hover:bg-[#F2C4BA]/50 border border-[#C27A6F]/50' 
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
                        'title' => "Download My New\nebook",
                        'cover' => 'https://images.unsplash.com/photo-1544717305-2782549b5136?w=400&auto=format&fit=crop&q=80',
                        'book_title' => 'The Comprehensive Guide to Making $1000/month with Instagram Theme Pages',
                        'author' => 'Pretty Girls Aesthetics',
                        'price' => '$25',
                        'link_text' => 'link in bio',
                        'handle' => '@cute_prettygirlsaesthetics',
                        'btn_text' => 'Baca Sekarang',
                        'url' => route('library')
                    ],
                    [
                        'id' => 2,
                        'title' => "Download My New\nebook",
                        'cover' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=400&auto=format&fit=crop&q=80',
                        'book_title' => 'The Comprehensive Guide to Making $1000/month with Instagram Theme Pages',
                        'author' => 'Pretty Girls Aesthetics',
                        'price' => '$25',
                        'link_text' => 'link in bio',
                        'handle' => '@cute_prettygirlsaesthetics',
                        'btn_text' => 'Baca Sekarang',
                        'url' => route('library')
                    ],
                    [
                        'id' => 3,
                        'title' => "Download My New\nebook",
                        'cover' => 'https://images.unsplash.com/photo-1517841905240-472988babdf9?w=400&auto=format&fit=crop&q=80',
                        'book_title' => 'The Comprehensive Guide to Making $1000/month with Instagram Theme Pages',
                        'author' => 'Pretty Girls Aesthetics',
                        'price' => '$25',
                        'link_text' => 'link in bio',
                        'handle' => '@cute_prettygirlsaesthetics',
                        'btn_text' => 'Baca Sekarang',
                        'url' => route('library')
                    ],
                    [
                        'id' => 4,
                        'title' => "Download My New\nebook",
                        'cover' => 'https://images.unsplash.com/photo-1524504388940-b1c1722653e1?w=400&auto=format&fit=crop&q=80',
                        'book_title' => 'The Comprehensive Guide to Making $1000/month with Instagram Theme Pages',
                        'author' => 'Pretty Girls Aesthetics',
                        'price' => '$25',
                        'link_text' => 'link in bio',
                        'handle' => '@cute_prettygirlsaesthetics',
                        'btn_text' => 'Baca Sekarang',
                        'url' => route('library')
                    ],
                ];
            @endphp

            <div class="grid grid-cols-2 lg:grid-cols-4 gap-3.5 sm:gap-6">
                @foreach ($products as $product)
                    <div class="group flex flex-col bg-white rounded-2xl sm:rounded-3xl overflow-hidden shadow-sm card-spring reveal-on-scroll stagger-{{ $loop->iteration }} border border-[#DEA69E]/50 hover:border-[#DEA69E]">
                        
                        {{-- Top Header (Background transparan menyatu dengan card putih) --}}
                        <div class="pt-4 sm:pt-7 pb-2.5 sm:pb-4 px-2 sm:px-4 text-center bg-transparent">
                            <h2 class="font-serif italic font-extrabold text-sm min-[400px]:text-base sm:text-2xl text-[#8C433C] group-hover:text-[#782819] leading-tight group-hover:scale-105 transition-all duration-300">
                                {!! nl2br(e($product['title'])) !!}
                            </h2>
                        </div>

                        {{-- Arched Terracotta/Rose Body Section (Diselaraskan dari pink ke palet brand) --}}
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
                            class="w-full bg-[#FAF0EE] hover:bg-[#8C433C] text-[#782819] hover:text-white text-center font-bold py-2 sm:py-3.5 text-xs sm:text-sm transition-all duration-300 block border-t border-[#DEA69E]/40 shadow-xs">
                            {{ $product['btn_text'] }}
                        </a>
                    </div>
                @endforeach
            </div>

        </div>
    </section>

    <!-- ARTIKEL KESEHATAN SECTION (SEO & GUEST DISCOVERY) -->
    <section class="w-full bg-[#FAF0EE] pt-8 pb-20 px-4 sm:px-6 lg:px-8" style="font-family: 'Plus Jakarta Sans', sans-serif;" x-data="{ activeTab: 'all' }">
        <div class="max-w-7xl mx-auto">
            <!-- Header Section -->
            <div class="mb-8 reveal-on-scroll">
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-[#3D2B2B] tracking-tight">
                    Eksplorasi Artikel Kesehatan Terbaru
                </h2>
                <p class="mt-2 text-sm sm:text-base text-neutral-600 font-medium">
                    Panduan &amp; tips medis tepercaya, tervalidasi oleh pakar kesehatan.
                </p>
            </div>

            <!-- Categories Tabs & Lihat Semua Link -->
            <div class="flex flex-wrap items-center justify-between gap-4 mb-8 reveal-on-scroll">
                <!-- Filter Pills -->
                <div class="flex flex-wrap items-center gap-2.5 sm:gap-3">
                    <button type="button" @click="activeTab = 'all'"
                        :class="activeTab === 'all' ? 'bg-[#F2C4BA] text-[#782819] font-bold border-[#C27A6F] shadow-xs' : 'bg-transparent text-[#782819] hover:bg-[#F2C4BA]/50 border-[#C27A6F]/60'"
                        class="px-5 py-2 rounded-full border text-xs sm:text-sm font-semibold transition-all duration-200 cursor-pointer transform hover:scale-105 active:scale-95">
                        Terbaru
                    </button>
                    <button type="button" @click="activeTab = 'trimester'"
                        :class="activeTab === 'trimester' ? 'bg-[#F2C4BA] text-[#782819] font-bold border-[#C27A6F] shadow-xs' : 'bg-transparent text-[#782819] hover:bg-[#F2C4BA]/50 border-[#C27A6F]/60'"
                        class="px-5 py-2 rounded-full border text-xs sm:text-sm font-semibold transition-all duration-200 cursor-pointer transform hover:scale-105 active:scale-95">
                        Trisemester 1-3
                    </button>
                    <button type="button" @click="activeTab = 'nutrisi'"
                        :class="activeTab === 'nutrisi' ? 'bg-[#F2C4BA] text-[#782819] font-bold border-[#C27A6F] shadow-xs' : 'bg-transparent text-[#782819] hover:bg-[#F2C4BA]/50 border-[#C27A6F]/60'"
                        class="px-5 py-2 rounded-full border text-xs sm:text-sm font-semibold transition-all duration-200 cursor-pointer transform hover:scale-105 active:scale-95">
                        Nutrisi Ibu
                    </button>
                    <button type="button" @click="activeTab = 'persalinan'"
                        :class="activeTab === 'persalinan' ? 'bg-[#F2C4BA] text-[#782819] font-bold border-[#C27A6F] shadow-xs' : 'bg-transparent text-[#782819] hover:bg-[#F2C4BA]/50 border-[#C27A6F]/60'"
                        class="px-5 py-2 rounded-full border text-xs sm:text-sm font-semibold transition-all duration-200 cursor-pointer transform hover:scale-105 active:scale-95">
                        Persalinan
                    </button>
                    <button type="button" @click="activeTab = 'bayi'"
                        :class="activeTab === 'bayi' ? 'bg-[#F2C4BA] text-[#782819] font-bold border-[#C27A6F] shadow-xs' : 'bg-transparent text-[#782819] hover:bg-[#F2C4BA]/50 border-[#C27A6F]/60'"
                        class="px-5 py-2 rounded-full border text-xs sm:text-sm font-semibold transition-all duration-200 cursor-pointer transform hover:scale-105 active:scale-95">
                        Perawatan Bayi
                    </button>
                </div>

                <!-- Link Lihat Semua Artikel -->
                <a href="{{ route('articles.index') }}" class="inline-flex items-center gap-1.5 text-sm sm:text-base font-bold text-[#A8584B] hover:text-[#782819] transition-colors group">
                    <span>Lihat Semua Artikel</span>
                    <i class="fa-solid fa-arrow-right text-xs transform group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>

            <!-- Articles Grid (2 Kolom sesuai mockup) -->
            @php
                $articles = [
                    [
                        'category' => 'trimester',
                        'title' => 'Edukasi & Panduan Kehamilan Terkini',
                        'description' => 'Tips kesehatan ibu dan janin tepercaya, ditinjau langsung oleh dokter spesialis kandungan',
                        'image' => 'https://images.unsplash.com/photo-1584515979956-d9f6e5d09982?auto=format&fit=crop&w=400&q=80',
                        'link' => route('articles.index'),
                    ],
                    [
                        'category' => 'nutrisi',
                        'title' => 'Edukasi & Panduan Kehamilan Terkini',
                        'description' => 'Tips kesehatan ibu dan janin tepercaya, ditinjau langsung oleh dokter spesialis kandungan',
                        'image' => 'https://images.unsplash.com/photo-1584515979956-d9f6e5d09982?auto=format&fit=crop&w=400&q=80',
                        'link' => route('articles.index'),
                    ],
                    [
                        'category' => 'persalinan',
                        'title' => 'Edukasi & Panduan Kehamilan Terkini',
                        'description' => 'Tips kesehatan ibu dan janin tepercaya, ditinjau langsung oleh dokter spesialis kandungan',
                        'image' => 'https://images.unsplash.com/photo-1584515979956-d9f6e5d09982?auto=format&fit=crop&w=400&q=80',
                        'link' => route('articles.index'),
                    ],
                    [
                        'category' => 'bayi',
                        'title' => 'Edukasi & Panduan Kehamilan Terkini',
                        'description' => 'Tips kesehatan ibu dan janin tepercaya, ditinjau langsung oleh dokter spesialis kandungan',
                        'image' => 'https://images.unsplash.com/photo-1584515979956-d9f6e5d09982?auto=format&fit=crop&w=400&q=80',
                        'link' => route('articles.index'),
                    ],
                    [
                        'category' => 'trimester',
                        'title' => 'Edukasi & Panduan Kehamilan Terkini',
                        'description' => 'Tips kesehatan ibu dan janin tepercaya, ditinjau langsung oleh dokter spesialis kandungan',
                        'image' => 'https://images.unsplash.com/photo-1584515979956-d9f6e5d09982?auto=format&fit=crop&w=400&q=80',
                        'link' => route('articles.index'),
                    ],
                    [
                        'category' => 'nutrisi',
                        'title' => 'Edukasi & Panduan Kehamilan Terkini',
                        'description' => 'Tips kesehatan ibu dan janin tepercaya, ditinjau langsung oleh dokter spesialis kandungan',
                        'image' => 'https://images.unsplash.com/photo-1584515979956-d9f6e5d09982?auto=format&fit=crop&w=400&q=80',
                        'link' => route('articles.index'),
                    ],
                    [
                        'category' => 'persalinan',
                        'title' => 'Edukasi & Panduan Kehamilan Terkini',
                        'description' => 'Tips kesehatan ibu dan janin tepercaya, ditinjau langsung oleh dokter spesialis kandungan',
                        'image' => 'https://images.unsplash.com/photo-1584515979956-d9f6e5d09982?auto=format&fit=crop&w=400&q=80',
                        'link' => route('articles.index'),
                    ],
                    [
                        'category' => 'bayi',
                        'title' => 'Edukasi & Panduan Kehamilan Terkini',
                        'description' => 'Tips kesehatan ibu dan janin tepercaya, ditinjau langsung oleh dokter spesialis kandungan',
                        'image' => 'https://images.unsplash.com/photo-1584515979956-d9f6e5d09982?auto=format&fit=crop&w=400&q=80',
                        'link' => route('articles.index'),
                    ],
                ];
            @endphp

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-5">
                @foreach ($articles as $article)
                    <a href="{{ $article['link'] }}" 
                       x-show="activeTab === 'all' || activeTab === '{{ $article['category'] }}'"
                       x-transition
                       class="group bg-[#FAF0EE] rounded-2xl sm:rounded-3xl border-2 border-[#2D1E1E]/80 hover:border-[#8C433C] p-3 sm:p-4 flex items-center justify-between gap-3 sm:gap-4 shadow-xs card-spring reveal-on-scroll stagger-{{ ($loop->iteration % 4) + 1 }}">
                        
                        <!-- Left: Thumbnail & Text -->
                        <div class="flex items-center gap-3 sm:gap-4 overflow-hidden min-w-0">
                            <!-- Image Thumbnail -->
                            <div class="w-20 h-16 sm:w-24 sm:h-20 rounded-xl sm:rounded-2xl overflow-hidden bg-gray-200 shrink-0">
                                <img src="{{ $article['image'] }}" alt="{{ $article['title'] }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            </div>

                            <!-- Text Content -->
                            <div class="min-w-0">
                                <h3 class="font-bold text-sm sm:text-base text-[#2D1E1E] leading-snug truncate group-hover:text-[#8C433C] transition-colors">
                                    {{ $article['title'] }}
                                </h3>
                                <p class="text-xs sm:text-[13px] text-neutral-600 mt-1 leading-relaxed line-clamp-2">
                                    {{ $article['description'] }}
                                </p>
                            </div>
                        </div>

                        <!-- Right: Arrow Action Button -->
                        <div class="shrink-0 pl-1">
                            <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-[#2D1E1E] text-white flex items-center justify-center group-hover:bg-[#8C433C] group-hover:scale-110 group-hover:rotate-45 transition-all duration-300 shadow-sm">
                                <i class="fa-solid fa-arrow-right text-xs"></i>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- PHYSICAL PRODUCT / SHOP SECTION (Setelah Artikel) -->
    <section class="w-full bg-[#fcf5f3] pt-6 pb-20 px-4 sm:px-6 lg:px-8" style="font-family: 'Plus Jakarta Sans', sans-serif;">
        <div class="max-w-7xl mx-auto space-y-8">

            {{-- Header Section (Disamakan dengan Upcoming Event & Ebook) --}}
            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 pb-2 reveal-on-scroll">
                <div>
                    <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-[#3D2B2B] tracking-tight">
                        Product
                    </h2>
                    <p class="mt-2 text-sm sm:text-base text-neutral-600 font-medium">
                        Temukan berbagai barang pilihan yang siap mendukung aktivitasmu
                    </p>
                </div>

                <a href="{{ route('product') }}" class="group inline-flex items-center gap-1.5 text-sm font-bold text-[#7A9E7E] hover:text-[#5a7a66] transition-all duration-200">
                    <span>View All Products</span>
                    <i class="fa-solid fa-arrow-right text-xs transform group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>

            {{-- Category Tabs --}}
            @php
                $activeProductCat = 'Semua';
                $productCategories = ['Semua', 'Perlengkapan Nakes', 'Kebutuhan Wanita'];
            @endphp

            <div class="flex items-center gap-3 overflow-x-auto pb-2 no-scrollbar reveal-on-scroll">
                @foreach ($productCategories as $category)
                    @php $isActive = $category === $activeProductCat; @endphp
                    <button 
                        type="button"
                        class="px-6 py-2.5 rounded-full text-xs sm:text-sm font-semibold transition-all duration-200 whitespace-nowrap cursor-pointer transform hover:scale-105 active:scale-95
                        {{ $isActive 
                            ? 'bg-[#F2C4BA] text-[#782819] font-bold border border-[#C27A6F] shadow-xs' 
                            : 'bg-transparent text-[#782819] hover:bg-[#F2C4BA]/50 border border-[#C27A6F]/60' 
                        }}">
                        {{ $category }}
                    </button>
                @endforeach
            </div>

            {{-- Product Grid (5 Kolom di desktop) --}}
            @php
                $physicalProducts = [
                    [
                        'id' => 1,
                        'title' => 'Set Baju Perawat Premium',
                        'tag' => 'Perlengkapan Nakes',
                        'image' => 'https://images.unsplash.com/photo-1584515979956-d9f6e5d09982?w=600&auto=format&fit=crop&q=80',
                        'location' => 'Surakarta',
                        'price' => 'Rp 30.000',
                        'tiktok_url' => '#'
                    ],
                    [
                        'id' => 2,
                        'title' => 'Set Baju Perawat Premium',
                        'tag' => 'Perlengkapan Nakes',
                        'image' => 'https://images.unsplash.com/photo-1584515979956-d9f6e5d09982?w=600&auto=format&fit=crop&q=80',
                        'location' => 'Surakarta',
                        'price' => 'Rp 30.000',
                        'tiktok_url' => '#'
                    ],
                    [
                        'id' => 3,
                        'title' => 'Set Baju Perawat Premium',
                        'tag' => 'Perlengkapan Nakes',
                        'image' => 'https://images.unsplash.com/photo-1584515979956-d9f6e5d09982?w=600&auto=format&fit=crop&q=80',
                        'location' => 'Surakarta',
                        'price' => 'Rp 30.000',
                        'tiktok_url' => '#'
                    ],
                    [
                        'id' => 4,
                        'title' => 'Set Baju Perawat Premium',
                        'tag' => 'Perlengkapan Nakes',
                        'image' => 'https://images.unsplash.com/photo-1584515979956-d9f6e5d09982?w=600&auto=format&fit=crop&q=80',
                        'location' => 'Surakarta',
                        'price' => 'Rp 30.000',
                        'tiktok_url' => '#'
                    ],
                    [
                        'id' => 5,
                        'title' => 'Set Baju Perawat Premium',
                        'tag' => 'Perlengkapan Nakes',
                        'image' => 'https://images.unsplash.com/photo-1584515979956-d9f6e5d09982?w=600&auto=format&fit=crop&q=80',
                        'location' => 'Surakarta',
                        'price' => 'Rp 30.000',
                        'tiktok_url' => '#'
                    ],
                ];
            @endphp

            <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-3 sm:gap-4 lg:gap-5">
                @foreach ($physicalProducts as $product)
                    <div class="group flex flex-col justify-between bg-white rounded-3xl p-3 shadow-sm card-spring reveal-on-scroll stagger-{{ $loop->iteration }} border border-[#DEA69E]/40 hover:border-[#DEA69E]">
                        
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
                                <div class="pt-1">
                                    <span class="text-base font-extrabold text-[#3D2B2B] tracking-tight">
                                        {{ $product['price'] }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        {{-- Bottom Action: TikTok Button --}}
                        <div class="pt-2">
                            <a 
                                href="{{ $product['tiktok_url'] }}" 
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

        </div>
    </section>

    <!-- ── SINGLE EXPANDABLE FLOATING ACTION BUTTON (Pojok Kanan Bawah: 1 Tombol Utama yang Menampilkan Menu saat Ditekan) ── -->
    <div x-data="{ openFab: false }" 
         @click.away="openFab = false"
         class="fixed bottom-24 right-4 sm:bottom-8 sm:right-8 z-50 flex flex-col items-end gap-3 select-none">
        
        <!-- ── Popup Sub-Menu Items (Muncul ke atas saat tombol utama ditekan) ── -->
        <div x-show="openFab"
             x-transition:enter="transition ease-out duration-300 transform"
             x-transition:enter-start="opacity-0 translate-y-4 scale-90"
             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
             x-transition:leave="transition ease-in duration-200 transform"
             x-transition:leave-start="opacity-100 translate-y-0 scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 scale-90"
             class="flex flex-col items-end gap-2.5"
             style="display: none;">

            <!-- 1. Ajukan Event (Khusus Mobile: md:hidden) -->
            <a href="{{ route('events') }}" 
               class="md:hidden flex items-center gap-2.5 bg-[#7A9E7E] hover:bg-[#5a7a66] text-white px-4 py-2.5 rounded-full shadow-[0_8px_20px_rgba(122,158,126,0.4)] border-2 border-white transition-all transform hover:scale-105 active:scale-95 text-xs font-bold group">
                <span>Ajukan Event</span>
                <span class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center">
                    <i class="fa-solid fa-calendar-plus text-sm"></i>
                </span>
            </a>

            <!-- 2. Instagram (Tampil di Mobile & Desktop) -->
            <a href="https://instagram.com/maternity.id" target="_blank"
               class="flex items-center gap-2.5 bg-gradient-to-r from-[#f9ce34] via-[#ee2a7b] to-[#6228d7] text-white px-4 py-2.5 rounded-full shadow-[0_8px_20px_rgba(238,42,123,0.35)] border-2 border-white transition-all transform hover:scale-105 active:scale-95 text-xs font-bold group">
                <span class="hidden sm:inline">Instagram</span>
                <span class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center">
                    <i class="fa-brands fa-instagram text-base"></i>
                </span>
            </a>

            <!-- 3. WhatsApp (Tampil di Mobile & Desktop) -->
            <a href="https://wa.me/" target="_blank"
               class="flex items-center gap-2.5 bg-[#25D366] hover:bg-[#20ba5a] text-white px-4 py-2.5 rounded-full shadow-[0_8px_20px_rgba(37,211,102,0.35)] border-2 border-white transition-all transform hover:scale-105 active:scale-95 text-xs font-bold group">
                <span class="hidden sm:inline">WhatsApp Kami</span>
                <span class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center">
                    <i class="fa-brands fa-whatsapp text-lg"></i>
                </span>
            </a>

        </div>

        <!-- ── Main Trigger Button (Tombol Utama FAB dengan Ikon Komunikasi/Bantuan) ── -->
        <button type="button" 
                @click="openFab = !openFab"
                class="w-13 h-13 sm:w-14 sm:h-14 bg-gradient-to-tr from-[#C27A6F] to-[#8C433C] hover:from-[#8C433C] hover:to-[#782819] text-white rounded-full flex items-center justify-center shadow-[0_12px_28px_rgba(140,67,60,0.4)] border-2 border-white transition-all transform hover:scale-110 active:scale-95 focus:outline-none relative group"
                aria-label="Hubungi & Menu Cepat"
                title="Bantuan & Layanan">
            <i class="fa-solid text-xl sm:text-2xl transition-transform duration-300"
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
