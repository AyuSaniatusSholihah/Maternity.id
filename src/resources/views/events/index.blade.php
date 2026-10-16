<x-layout title="Event & Kelas — Maternity.id" metaDescription="Temukan event, workshop, dan kelas prenatal serta nifas untuk mendukung kesehatan dan tumbuh kembangmu.">
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

    <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8 w-full py-2 sm:py-4 space-y-4 sm:space-y-6">
        
        <!-- ── 1. HERO BANNER (EVENT & KELAS) ── -->
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

            <!-- Content Area: Text on Left + Mother & Baby on Right -->
            <div class="relative z-10 flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="space-y-1 text-center sm:text-left max-w-lg">
                    <span class="inline-block px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-[#EBF5EE] text-[#4D7C59] border border-[#BDE0C6] mb-1">
                        🗓 Jadwal Terbuka
                    </span>
                    <h1 class="text-2xl sm:text-3xl font-extrabold text-[#8C433C] tracking-tight leading-snug" style="font-family: 'DM Serif Display', serif;">
                        Event & Kelas
                    </h1>
                    <p class="text-xs sm:text-sm text-[#5C4542] leading-relaxed">
                        Temukan event dan kelas untuk mendukung kesehatan dan tumbuh kembangmu.
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

        <!-- ── 2. TOP FILTER CONTROLS (TABS & CATEGORY DROPDOWN) ── -->
        <div class="flex flex-wrap items-center justify-between gap-3 pt-1">
            <!-- Left Tabs: Semua Event vs Event Saya -->
            <div class="flex items-center gap-1 p-1 bg-white/70 backdrop-blur-sm rounded-full border border-[#DEA69E]/40 shadow-2xs">
                <a href="{{ route('events', ['tab' => 'all', 'month' => $currentMonth, 'category' => $currentCategory]) }}"
                   class="px-4 sm:px-5 py-1 sm:py-1.5 rounded-full text-xs font-bold transition-all {{ $currentTab === 'all' ? 'bg-[#8C433C] text-white shadow-xs' : 'text-[#5C4542] hover:text-[#8C433C]' }}">
                    Semua Event
                </a>
                <a href="{{ route('events', ['tab' => 'my', 'month' => $currentMonth, 'category' => $currentCategory]) }}"
                   class="px-4 sm:px-5 py-1 sm:py-1.5 rounded-full text-xs font-bold transition-all {{ $currentTab === 'my' ? 'bg-[#8C433C] text-white shadow-xs' : 'text-[#5C4542] hover:text-[#8C433C]' }}">
                    Event Saya
                </a>
            </div>

            <!-- Right Dropdown: Semua Kategori -->
            <div class="relative" x-data="{ openCat: false }">
                <button @click="openCat = !openCat" 
                        class="flex items-center gap-2 px-3.5 sm:px-4 py-1.5 sm:py-2 bg-white rounded-2xl border border-[#DEA69E]/50 text-xs font-semibold text-[#2A1614] shadow-2xs hover:border-[#8C433C] transition">
                    <i class="fa-solid fa-list-ul text-[#8C433C]"></i>
                    <span>{{ collect($categories)->firstWhere('slug', $currentCategory)['name'] ?? 'Semua Kategori' }}</span>
                    <i class="fa-solid fa-chevron-down text-[10px] text-neutral-400 ml-1"></i>
                </button>

                <div x-show="openCat" 
                     @click.away="openCat = false"
                     x-transition
                     class="absolute right-0 mt-2 w-48 bg-white rounded-2xl shadow-xl border border-gray-100 py-1.5 z-30 text-xs"
                     style="display: none;">
                    @foreach ($categories as $cat)
                        <a href="{{ route('events', ['category' => $cat['slug'], 'month' => $currentMonth, 'tab' => $currentTab]) }}" 
                           class="block px-4 py-2 hover:bg-[#FAF0EE] hover:text-[#8C433C] font-medium {{ $currentCategory === $cat['slug'] ? 'text-[#8C433C] font-bold bg-[#FAF0EE]/60' : 'text-neutral-700' }}">
                            {{ $cat['name'] }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- ── 3. FILTER BULAN ── -->
        <div class="bg-white rounded-2xl p-2.5 sm:px-4 sm:py-3 border border-[#DEA69E]/30 shadow-2xs flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-4 overflow-hidden">
            <div class="flex items-center gap-1.5 shrink-0 text-xs font-bold text-[#2A1614]">
                <i class="fa-regular fa-calendar-days text-[#8C433C]"></i>
                <span>Filter Bulan</span>
            </div>

            <!-- Month Pills -->
            <div class="flex items-center gap-1.5 overflow-x-auto pb-1 sm:pb-0 no-scrollbar">
                @foreach ($months as $m)
                    @php
                        $isActive = ($currentMonth === $m['code']);
                    @endphp
                    <a href="{{ route('events', ['month' => $m['code'], 'tab' => $currentTab, 'category' => $currentCategory]) }}"
                       class="shrink-0 px-3 sm:px-3.5 py-1 rounded-full text-xs font-semibold transition-all {{ $isActive ? 'bg-[#8C433C] text-white shadow-xs' : 'bg-slate-50 hover:bg-[#FAF0EE] text-slate-600 hover:text-[#8C433C]' }}">
                        {{ $m['name'] }}
                    </a>
                @endforeach
            </div>
        </div>

        <!-- ── 4. EVENT CARDS LISTING ── -->
        @if(count($events) > 0)
            <div x-data="{
                scrollEl: null,
                canPrev: false,
                canNext: true,
                isDragging: false,
                startX: 0,
                scrollLeft: 0,
                init() {
                    this.scrollEl = this.$refs.carousel;
                    this.scrollEl.addEventListener('scroll', () => this.updateNav());
                    this.updateNav();
                    // Mouse drag
                    this.scrollEl.addEventListener('mousedown', (e) => {
                        this.isDragging = true;
                        this.startX = e.pageX - this.scrollEl.offsetLeft;
                        this.scrollLeft = this.scrollEl.scrollLeft;
                        this.scrollEl.style.cursor = 'grabbing';
                    });
                    window.addEventListener('mouseup', () => {
                        this.isDragging = false;
                        this.scrollEl.style.cursor = 'grab';
                    });
                    this.scrollEl.addEventListener('mousemove', (e) => {
                        if (!this.isDragging) return;
                        e.preventDefault();
                        const x = e.pageX - this.scrollEl.offsetLeft;
                        this.scrollEl.scrollLeft = this.scrollLeft - (x - this.startX);
                    });
                },
                updateNav() {
                    this.canPrev = this.scrollEl.scrollLeft > 10;
                    this.canNext = this.scrollEl.scrollLeft < this.scrollEl.scrollWidth - this.scrollEl.clientWidth - 10;
                },
                scrollBy(dir) {
                    const amount = this.scrollEl.clientWidth * 0.75;
                    this.scrollEl.scrollBy({ left: dir * amount, behavior: 'smooth' });
                }
            }" class="space-y-2">

                <!-- Header Navigation Bar: Title & Prev/Next Controls (Never Overlaps Cards) -->
                <div class="flex items-center justify-between px-1">
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-[#8C433C]"></span>
                        <h2 class="text-xs sm:text-sm font-bold text-[#2A1614]">
                            Jadwal Event & Kelas
                        </h2>
                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-[#FAF0EE] text-[#8C433C] border border-[#DEA69E]/40">
                            {{ count($events) }} Event
                        </span>
                    </div>

                    <!-- Clean Carousel Arrow Buttons in Header -->
                    <div class="flex items-center gap-1.5">
                        <button type="button"
                                @click="scrollBy(-1)"
                                :disabled="!canPrev"
                                aria-label="Geser ke kiri"
                                class="w-8 h-8 rounded-full border border-[#DEA69E]/50 bg-white hover:bg-[#FAF0EE] disabled:opacity-35 disabled:hover:bg-white flex items-center justify-center text-[#8C433C] transition shadow-2xs cursor-pointer disabled:cursor-not-allowed">
                            <i class="fa-solid fa-chevron-left text-xs"></i>
                        </button>
                        <button type="button"
                                @click="scrollBy(1)"
                                :disabled="!canNext"
                                aria-label="Geser ke kanan"
                                class="w-8 h-8 rounded-full border border-[#DEA69E]/50 bg-white hover:bg-[#FAF0EE] disabled:opacity-35 disabled:hover:bg-white flex items-center justify-center text-[#8C433C] transition shadow-2xs cursor-pointer disabled:cursor-not-allowed">
                            <i class="fa-solid fa-chevron-right text-xs"></i>
                        </button>
                    </div>
                </div>

                <!-- Carousel Container with Outer Gutter Margins -->
                <div class="relative px-0">
                    <!-- Carousel Track (Spacious Gaps & Soft Shadows Padding) -->
                    <div x-ref="carousel"
                         class="flex gap-3.5 sm:gap-5 overflow-x-auto py-2.5 px-1 sm:px-2 no-scrollbar snap-x snap-mandatory scroll-smooth"
                         style="cursor: grab;">
                        @foreach ($events as $event)
                            <div class="shrink-0 w-[80vw] min-[400px]:w-[74vw] sm:w-[310px] md:w-[320px] max-w-[330px] snap-start">
                                <x-event_card :event="$event" />
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @else
            <!-- Empty State -->
            <div class="bg-white rounded-3xl p-10 text-center border border-[#DEA69E]/30 max-w-md mx-auto space-y-3">
                <div class="w-14 h-14 bg-[#FAF0EE] rounded-full flex items-center justify-center mx-auto text-[#8C433C] text-xl">
                    <i class="fa-regular fa-calendar-xmark"></i>
                </div>
                <h3 class="text-base font-bold text-[#2A1614]">Belum Ada Event di Bulan Ini</h3>
                <p class="text-xs text-neutral-500">
                    Silakan pilih bulan lain atau kembali ke bulan Juli untuk melihat jadwal kelas dan seminar aktif.
                </p>
                <a href="{{ route('events', ['month' => 'Jul']) }}" class="inline-block px-4 py-2 bg-[#8C433C] text-white text-xs font-bold rounded-full hover:bg-[#782819] transition">
                    Lihat Event Bulan Juli
                </a>
            </div>
        @endif

        <!-- ── AJUKAN EVENT & KELAS BARU BANNER ── -->
        <x-grid_hero_banner 
            badge="Kolaborasi & Workshop"
            title="Punya Materi atau Ingin Menjadi Narasumber?"
            subtitle="Ajukan topik webinar, kelas prenatal, atau workshop Anda bersama Maternity.id dan jangkau calon ibu di seluruh nusantara."
            primaryText="Daftar Menjadi Pemateri"
            :primaryUrl="route('events')"
            secondaryText="Hubungi Tim Partnership"
            secondaryUrl="https://wa.me/"
        />

    </div>

    {{-- Floating Social Media (Kanan Bawah) --}}
    <x-floating_social />

</x-layout>
