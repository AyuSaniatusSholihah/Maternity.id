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

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full py-2 sm:py-4 space-y-5 sm:space-y-6">
        
        <!-- ── 1. HERO BANNER (EVENT & KELAS) ── -->
        <div class="relative bg-gradient-to-r from-[#FCEBE7] via-[#FDF3F0] to-[#FAF0EE] rounded-3xl px-6 py-4 sm:px-8 sm:py-5 border border-[#DEA69E]/30 overflow-hidden shadow-xs">
            <!-- Decorative Leaves on Right -->
            <div class="absolute right-64 bottom-0 opacity-30 pointer-events-none select-none hidden lg:block">
                <svg width="70" height="70" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M20 90C20 90 25 40 70 30C70 30 50 65 20 90Z" fill="#DEA69E" />
                    <path d="M10 65C10 65 30 35 60 40C60 40 40 60 10 65Z" fill="#8C433C" opacity="0.6"/>
                </svg>
            </div>

            <!-- Decorative Calendar Heart Icon in Background -->
            <div class="absolute top-2 right-64 opacity-25 pointer-events-none hidden md:block text-[#8C433C]">
                <div class="w-14 h-14 bg-white/60 rounded-2xl border border-[#DEA69E] flex flex-col items-center justify-center p-1 shadow-xs">
                    <div class="w-full h-2.5 bg-[#8C433C]/40 rounded-t-sm mb-1"></div>
                    <i class="fa-solid fa-heart text-[#8C433C] text-sm"></i>
                </div>
            </div>

            <!-- Content Area: Text on Left + Mother & Baby on Right -->
            <div class="relative z-10 flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="space-y-1 text-center sm:text-left max-w-lg">
                    <h1 class="text-2xl sm:text-3xl font-extrabold text-[#8C433C] tracking-tight leading-snug" style="font-family: 'DM Serif Display', serif;">
                        Event & Kelas
                    </h1>
                    <p class="text-xs sm:text-sm text-[#5C4542] leading-relaxed">
                        Temukan event dan kelas untuk mendukung kesehatan dan tumbuh kembangmu.
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

        <!-- ── 2. TOP FILTER CONTROLS (TABS & CATEGORY DROPDOWN) ── -->
        <div class="flex flex-wrap items-center justify-between gap-3 pt-1">
            <!-- Left Tabs: Semua Event vs Event Saya -->
            <div class="flex items-center gap-1.5 p-1 bg-white/70 backdrop-blur-sm rounded-full border border-[#DEA69E]/40 shadow-2xs">
                <a href="{{ route('events', ['tab' => 'all', 'month' => $currentMonth, 'category' => $currentCategory]) }}"
                   class="px-5 py-1.5 rounded-full text-xs font-bold transition-all {{ $currentTab === 'all' ? 'bg-[#8C433C] text-white shadow-xs' : 'text-[#5C4542] hover:text-[#8C433C]' }}">
                    Semua Event
                </a>
                <a href="{{ route('events', ['tab' => 'my', 'month' => $currentMonth, 'category' => $currentCategory]) }}"
                   class="px-5 py-1.5 rounded-full text-xs font-bold transition-all {{ $currentTab === 'my' ? 'bg-[#8C433C] text-white shadow-xs' : 'text-[#5C4542] hover:text-[#8C433C]' }}">
                    Event Saya
                </a>
            </div>

            <!-- Right Dropdown: Semua Kategori -->
            <div class="relative" x-data="{ openCat: false }">
                <button @click="openCat = !openCat" 
                        class="flex items-center gap-2 px-4 py-2 bg-white rounded-2xl border border-[#DEA69E]/50 text-xs font-semibold text-[#2A1614] shadow-2xs hover:border-[#8C433C] transition">
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
        <div class="bg-white rounded-2xl p-2.5 sm:px-4 sm:py-3 border border-[#DEA69E]/30 shadow-2xs flex flex-col sm:flex-row sm:items-center gap-2.5 sm:gap-4 overflow-hidden">
            <div class="flex items-center gap-2 shrink-0 text-xs font-bold text-[#2A1614]">
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
                       class="shrink-0 px-3.5 py-1 rounded-full text-xs font-semibold transition-all {{ $isActive ? 'bg-[#8C433C] text-white shadow-xs' : 'bg-slate-50 hover:bg-[#FAF0EE] text-slate-600 hover:text-[#8C433C]' }}">
                        {{ $m['name'] }}
                    </a>
                @endforeach
            </div>
        </div>

        <!-- ── 4. EVENT CARDS LISTING (GRID) ── -->
        @if(count($events) > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 sm:gap-6">
                @foreach ($events as $event)
                    <div class="bg-white rounded-3xl border border-[#DEA69E]/30 p-3.5 sm:p-4 shadow-xs hover:shadow-md transition-all flex flex-col justify-between space-y-3 card-spring group">
                        
                        <!-- Event Image Container -->
                        <div class="relative w-full h-44 sm:h-48 rounded-2xl overflow-hidden bg-neutral-100">
                            <img src="{{ $event['thumbnail_image'] }}" 
                                 alt="{{ $event['title'] }}" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            
                            <!-- Format Badge (Top Left) -->
                            <div class="absolute top-3 left-3">
                                @if($event['format_type'] === 'online')
                                    <span class="px-2.5 py-0.5 bg-white/95 backdrop-blur-md text-[#8C433C] text-[10px] font-extrabold uppercase tracking-wider rounded-full shadow-2xs border border-[#DEA69E]/40">
                                        {{ $event['format'] }}
                                    </span>
                                @else
                                    <span class="px-2.5 py-0.5 bg-white/95 backdrop-blur-md text-[#2A1614] text-[10px] font-extrabold uppercase tracking-wider rounded-full shadow-2xs border border-gray-200">
                                        {{ $event['format'] }}
                                    </span>
                                @endif
                            </div>

                            <!-- Bookmark Button (Top Right) -->
                            <button type="button" 
                                    onclick="alert('Event disimpan ke favorit!')"
                                    class="absolute top-3 right-3 w-8 h-8 rounded-xl bg-white/90 backdrop-blur-md text-[#8C433C] hover:bg-white shadow-2xs flex items-center justify-center transition"
                                    title="Simpan Event">
                                <i class="{{ !empty($event['is_bookmarked']) ? 'fa-solid fa-bookmark' : 'fa-regular fa-bookmark' }} text-xs"></i>
                            </button>
                        </div>

                        <!-- Event Details Body -->
                        <div class="space-y-2 flex-1 flex flex-col justify-between">
                            <div class="space-y-1.5">
                                <!-- Schedule Date & Time -->
                                <div class="flex items-center gap-1.5 text-[11px] font-bold text-[#8C433C]">
                                    <i class="fa-regular fa-calendar text-[10px]"></i>
                                    <span>{{ $event['date_string'] }} • {{ $event['time_string'] }}</span>
                                </div>

                                <!-- Event Title -->
                                <h3 class="text-sm sm:text-base font-bold text-[#2A1614] leading-snug group-hover:text-[#8C433C] transition" style="font-family: 'DM Serif Display', serif;">
                                    <a href="#">
                                        {{ $event['title'] }}
                                    </a>
                                </h3>

                                <!-- Event Excerpt -->
                                <p class="text-xs text-neutral-500 line-clamp-2 leading-relaxed">
                                    {{ $event['description'] }}
                                </p>
                            </div>

                            <!-- Card Footer: Tag, Duration, and Button -->
                            <div class="pt-3 border-t border-slate-50 flex items-center justify-between gap-2">
                                <div class="flex items-center gap-2 text-[11px] text-neutral-500">
                                    <span class="px-2 py-0.5 bg-[#FAF0EE] text-[#8C433C] rounded-md font-semibold text-[10px]">
                                        {{ $event['category'] }}
                                    </span>
                                    <span class="flex items-center gap-1 text-[10px]">
                                        <i class="fa-regular fa-clock text-slate-400"></i>
                                        <span>{{ $event['duration'] }}</span>
                                    </span>
                                </div>

                                <button type="button" 
                                        onclick="alert('Pendaftaran untuk event {{ $event['title'] }} akan segera dibuka!')"
                                        class="px-3.5 py-1.5 rounded-full bg-[#FAF0EE] hover:bg-[#8C433C] text-[#8C433C] hover:text-white text-xs font-bold transition duration-200 border border-[#DEA69E]/50">
                                    Lihat Detail
                                </button>
                            </div>
                        </div>

                    </div>
                @endforeach
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

    </div>
</x-layout>
