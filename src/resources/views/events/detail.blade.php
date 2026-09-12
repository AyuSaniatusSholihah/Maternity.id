<x-layout :title="($event->title ?? 'Detail Event') . ' — Maternity.id'" :metaDescription="$event->description ?? 'Detail event dan kelas Maternity.id'">
    <x-slot name="head">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <style>
            @keyframes badge-pulse {
                0%, 100% { opacity: 1; transform: scale(1); }
                50% { opacity: 0.8; transform: scale(1.04); }
            }
            .badge-pulse { animation: badge-pulse 2.5s ease-in-out infinite; }

            @keyframes float-up {
                from { opacity: 0; transform: translateY(16px); }
                to   { opacity: 1; transform: translateY(0); }
            }
            .animate-float-up { animation: float-up 0.5s ease both; }
            .animate-float-up-2 { animation: float-up 0.5s 0.1s ease both; }
            .animate-float-up-3 { animation: float-up 0.5s 0.2s ease both; }

            .card-glow:hover {
                box-shadow: 0 8px 40px 0 rgba(140, 67, 60, 0.13);
            }
            .progress-bar-fill {
                transition: width 1s cubic-bezier(0.34, 1.56, 0.64, 1);
            }
        </style>
    </x-slot>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-4 sm:py-8 space-y-5">

        {{-- BREADCRUMB --}}
        <nav class="flex items-center gap-1.5 text-xs text-neutral-400 animate-float-up">
            <a href="{{ route('events') }}" class="hover:text-[#8C433C] transition">Event & Kelas</a>
            <i class="fa-solid fa-chevron-right text-[9px]"></i>
            <span class="text-neutral-600 font-medium line-clamp-1">{{ $event->title ?? 'Detail Event' }}</span>
        </nav>

        {{-- MAIN DETAIL CARD --}}
        <div class="bg-white rounded-2xl sm:rounded-3xl border border-[#DEA69E]/30 shadow-sm overflow-hidden card-glow transition-shadow animate-float-up-2">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-0">

                {{-- KOLOM KIRI: Event Image with Badge --}}
                <div class="relative min-h-[220px] sm:min-h-[300px] md:min-h-[360px] overflow-hidden bg-[#FCEBE7]">
                    @php
                        $imgSrc = $event->thumbnail_image ?? 'https://images.unsplash.com/photo-1545205597-3d9d02c29597?auto=format&fit=crop&q=80&w=800';
                        if (file_exists(public_path('images/yoga_event_detail.jpg')) && str_contains(strtolower($event->title ?? ''), 'yoga')) {
                            $imgSrc = asset('images/yoga_event_detail.jpg');
                        }
                    @endphp
                    <img src="{{ $imgSrc }}"
                         alt="{{ $event->title ?? 'Event' }}"
                         class="absolute inset-0 w-full h-full object-cover">

                    {{-- Gradient Overlay --}}
                    <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent pointer-events-none"></div>

                    {{-- Badge Status (Top Left) --}}
                    @if(!empty($event->badge))
                        <div class="absolute top-4 left-4">
                            <span class="badge-pulse inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-extrabold shadow-md
                                @if($event->badge === 'Gratis') bg-[#EBF5EE] text-[#4D7C59] border border-[#BDE0C6]
                                @elseif($event->badge === 'Terlaris') bg-[#FFF3EC] text-[#D96B27] border border-[#FFD8C2]
                                @elseif($event->badge === 'Hampir Penuh') bg-[#FEF3CD] text-[#B45309] border border-[#FCD34D]
                                @else bg-[#8C433C] text-white border border-[#8C433C]/20
                                @endif">
                                <span class="w-1.5 h-1.5 rounded-full
                                    @if($event->badge === 'Gratis') bg-[#4D7C59]
                                    @elseif($event->badge === 'Terlaris') bg-[#D96B27]
                                    @elseif($event->badge === 'Hampir Penuh') bg-[#B45309]
                                    @else bg-white
                                    @endif"></span>
                                {{ $event->badge }}
                            </span>
                        </div>
                    @endif

                    {{-- Format Badge (Bottom Left) --}}
                    <div class="absolute bottom-4 left-4">
                        @php $isOnline = ($event->format_type ?? 'online') === 'online'; @endphp
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-extrabold backdrop-blur-md shadow-sm
                            {{ $isOnline ? 'bg-[#EBF5EE]/90 text-[#4D7C59] border border-[#BDE0C6]' : 'bg-[#FFF3EC]/90 text-[#D96B27] border border-[#FFD8C2]' }}">
                            <i class="fa-solid {{ $isOnline ? 'fa-wifi' : 'fa-location-dot' }} text-[10px]"></i>
                            {{ $event->format ?? 'ONLINE' }}
                        </span>
                    </div>
                </div>

                {{-- KOLOM KANAN: Detail Info --}}
                <div class="p-6 sm:p-8 flex flex-col justify-between gap-5">

                    {{-- Judul & Rating --}}
                    <div class="space-y-3">
                        <h1 class="text-2xl sm:text-3xl font-extrabold text-[#2A1614] leading-tight"
                            style="font-family: 'DM Serif Display', serif;">
                            {{ $event->title ?? 'Pelatihan Yoga' }}
                        </h1>

                        <div class="flex items-center gap-3 text-sm">
                            <div class="flex items-center gap-1.5">
                                <i class="fa-solid fa-star text-amber-400 text-sm"></i>
                                <span class="font-bold text-neutral-800">{{ $event->rating ?? '4.8' }}</span>
                            </div>
                            <span class="text-neutral-300">|</span>
                            <div class="flex items-center gap-1.5 text-neutral-600">
                                <i class="fa-solid fa-users text-[#5F8C72] text-sm"></i>
                                <span>{{ number_format($event->total_participants ?? 124) }} peserta</span>
                            </div>
                        </div>

                        {{-- Progress kuota --}}
                        @if(!empty($event->total_participants) && !empty($event->max_participants))
                            @php $pct = min(100, round(($event->total_participants / $event->max_participants) * 100)); @endphp
                            <div class="space-y-1">
                                <div class="flex justify-between text-[11px] text-neutral-500">
                                    <span>{{ $event->total_participants }} / {{ $event->max_participants }} peserta</span>
                                    <span class="font-semibold {{ $pct >= 80 ? 'text-amber-600' : 'text-[#5F8C72]' }}">{{ $pct }}% terisi</span>
                                </div>
                                <div class="h-1.5 bg-neutral-100 rounded-full overflow-hidden">
                                    <div class="h-full rounded-full progress-bar-fill {{ $pct >= 80 ? 'bg-amber-400' : 'bg-[#5F8C72]' }}"
                                         style="width: {{ $pct }}%"></div>
                                </div>
                            </div>
                        @endif
                    </div>

                    {{-- Jadwal & Lokasi --}}
                    <div class="grid grid-cols-2 gap-3">
                        <div class="flex items-start gap-2.5">
                            <div class="w-8 h-8 shrink-0 rounded-lg bg-[#FAF0EE] flex items-center justify-center">
                                <i class="fa-regular fa-calendar-days text-[#8C433C] text-sm"></i>
                            </div>
                            <div>
                                <p class="text-[10px] text-neutral-400 font-semibold uppercase tracking-wider">Tanggal</p>
                                <p class="text-sm font-bold text-neutral-800">{{ $event->date_string ?? '12 Des 2025' }}</p>
                                <p class="text-xs text-neutral-500">{{ $event->time_string ?? '09.00 – 12.00 WIB' }}</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-2.5">
                            <div class="w-8 h-8 shrink-0 rounded-lg bg-[#FAF0EE] flex items-center justify-center">
                                <i class="fa-solid fa-location-dot text-[#8C433C] text-sm"></i>
                            </div>
                            <div>
                                <p class="text-[10px] text-neutral-400 font-semibold uppercase tracking-wider">Lokasi</p>
                                <p class="text-sm font-bold text-neutral-800">{{ ($event->format_type ?? 'online') === 'online' ? 'Online' : 'Offline' }}</p>
                                <p class="text-xs text-neutral-500 leading-snug">{{ $event->location ?? '-' }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Harga & Tombol CTA --}}
                    @php $isFree = ($event->price_numeric ?? 1) === 0 || strtolower($event->price ?? '') === 'gratis / free'; @endphp
                    <div class="flex items-center gap-3">
                        <div class="bg-[#FAF0EE] rounded-xl px-5 py-3 text-center shrink-0">
                            <p class="text-xl font-black {{ $isFree ? 'text-[#4D7C59]' : 'text-[#2A1614]' }}">
                                {{ $isFree ? 'Gratis' : ($event->price ?? 'Rp150.000') }}
                            </p>
                            <p class="text-[11px] text-neutral-500">/ peserta</p>
                        </div>

                        <a href="{{ route('events.checkout', $event->slug ?? 'mindful-motherhood') }}"
                           id="btn-daftar-sekarang"
                           class="flex-1 flex items-center justify-center gap-2 bg-[#2D5C3E] hover:bg-[#1e4329] text-white font-bold text-sm py-4 px-5 rounded-xl transition-all duration-200 shadow-sm hover:shadow-md group">
                            <span>Daftar Sekarang</span>
                            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>

                    {{-- Penyelenggara Terverifikasi --}}
                    @if(!empty($event->is_verified))
                        <div class="flex items-center gap-3 bg-[#EBF5EE] border border-[#BDE0C6] rounded-xl p-3.5">
                            <div class="w-9 h-9 shrink-0 rounded-full bg-[#5F8C72] flex items-center justify-center shadow-sm">
                                <i class="fa-solid fa-shield-halved text-white text-sm"></i>
                            </div>
                            <div>
                                <p class="text-xs font-extrabold text-[#2D5C3E]">Penyelenggara Terverifikasi</p>
                                <p class="text-[11px] text-[#4D7C59] leading-snug">Event ini telah diverifikasi oleh sistem kami.</p>
                            </div>
                            <i class="fa-solid fa-circle-check text-[#5F8C72] text-xl ml-auto"></i>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- BOTTOM INFO 4 KOLOM --}}
        <div class="bg-white rounded-2xl sm:rounded-3xl border border-[#DEA69E]/20 shadow-2xs px-4 sm:px-8 py-5 animate-float-up-3">
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-5">

                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 shrink-0 rounded-xl bg-[#FAF0EE] flex items-center justify-center">
                        <i class="fa-solid fa-coins text-[#8C433C]"></i>
                    </div>
                    <div>
                        <p class="text-[11px] text-neutral-400 font-semibold">Harga</p>
                        <p class="text-sm font-bold text-neutral-800">{{ $isFree ? 'Gratis' : ($event->price ?? 'Rp150.000') }}</p>
                        <p class="text-[11px] text-neutral-400">/ peserta</p>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 shrink-0 rounded-xl bg-[#FAF0EE] flex items-center justify-center">
                        <i class="fa-regular fa-calendar text-[#8C433C]"></i>
                    </div>
                    <div>
                        <p class="text-[11px] text-neutral-400 font-semibold">Tanggal & Waktu</p>
                        <p class="text-sm font-bold text-neutral-800">{{ $event->date_string ?? '12 Des 2025' }}</p>
                        <p class="text-[11px] text-neutral-500">{{ $event->time_string ?? '09.00 – 12.00 WIB' }}</p>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 shrink-0 rounded-xl bg-[#FAF0EE] flex items-center justify-center">
                        <i class="fa-solid fa-location-dot text-[#8C433C]"></i>
                    </div>
                    <div>
                        <p class="text-[11px] text-neutral-400 font-semibold">Lokasi</p>
                        <p class="text-sm font-bold text-neutral-800 text-xs leading-snug">{{ $event->location ?? '-' }}</p>
                        @if(!empty($event->maps_url))
                            <a href="{{ $event->maps_url }}" target="_blank"
                               class="text-[11px] text-[#5F8C72] font-semibold hover:underline inline-flex items-center gap-0.5">
                                Lihat di Maps <i class="fa-solid fa-arrow-right text-[9px]"></i>
                            </a>
                        @endif
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 shrink-0 rounded-xl bg-[#FAF0EE] flex items-center justify-center">
                        <i class="fa-solid fa-users text-[#8C433C]"></i>
                    </div>
                    <div>
                        <p class="text-[11px] text-neutral-400 font-semibold">Peserta</p>
                        <p class="text-sm font-bold text-neutral-800">{{ number_format($event->total_participants ?? 124) }} orang</p>
                        <p class="text-[11px] text-neutral-400">({{ $event->rating ?? '4.8' }}/5)</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- DESKRIPSI & NARASUMBER --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="sm:col-span-2 bg-white rounded-2xl border border-[#DEA69E]/20 p-6 shadow-2xs space-y-3">
                <h2 class="text-base font-bold text-[#2A1614]" style="font-family: 'DM Serif Display', serif;">
                    Tentang Event Ini
                </h2>
                <p class="text-sm text-neutral-600 leading-relaxed">
                    {{ $event->long_description ?? $event->description ?? 'Informasi detail akan segera tersedia.' }}
                </p>
                <ul class="space-y-2 pt-1">
                    <li class="flex items-start gap-2 text-sm text-neutral-700">
                        <i class="fa-solid fa-circle-check text-[#5F8C72] mt-0.5 shrink-0"></i>
                        <span>Materi disampaikan oleh narasumber bersertifikat & berpengalaman</span>
                    </li>
                    <li class="flex items-start gap-2 text-sm text-neutral-700">
                        <i class="fa-solid fa-circle-check text-[#5F8C72] mt-0.5 shrink-0"></i>
                        <span>Sertifikat keikutsertaan dikirim via email setelah acara</span>
                    </li>
                    <li class="flex items-start gap-2 text-sm text-neutral-700">
                        <i class="fa-solid fa-circle-check text-[#5F8C72] mt-0.5 shrink-0"></i>
                        <span>Rekaman & materi tersedia selama 30 hari setelah acara</span>
                    </li>
                </ul>
            </div>

            <div class="bg-white rounded-2xl border border-[#DEA69E]/20 p-6 shadow-2xs flex flex-col gap-4">
                <h2 class="text-base font-bold text-[#2A1614]" style="font-family: 'DM Serif Display', serif;">
                    Narasumber
                </h2>
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 shrink-0 rounded-full bg-gradient-to-br from-[#DEAAA1] to-[#8C433C] flex items-center justify-center text-white font-extrabold text-lg">
                        {{ strtoupper(substr($event->speaker ?? 'N', 0, 1)) }}
                    </div>
                    <div>
                        <p class="text-sm font-bold text-neutral-800">{{ $event->speaker ?? 'Narasumber' }}</p>
                        <p class="text-[11px] text-neutral-500 leading-snug">{{ $event->speaker_bio ?? 'Tenaga profesional bersertifikat' }}</p>
                    </div>
                </div>
                <div class="bg-[#EBF5EE] rounded-xl px-4 py-3">
                    <div class="flex items-center gap-2 text-[#2D5C3E]">
                        <i class="fa-solid fa-shield-halved text-sm"></i>
                        <span class="text-xs font-bold">Terverifikasi Maternity.id</span>
                    </div>
                </div>
                <a href="{{ route('events.checkout', $event->slug ?? 'mindful-motherhood') }}"
                   class="mt-auto flex items-center justify-center gap-2 bg-[#2D5C3E] hover:bg-[#1e4329] text-white font-bold text-sm py-3 px-4 rounded-xl transition-all duration-200 shadow-sm group">
                    <span>{{ $isFree ? 'Daftar Gratis' : 'Daftar Sekarang' }}</span>
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>

        {{-- EVENT TERKAIT --}}
        @if(!empty($relatedEvents) && count($relatedEvents) > 0)
            <div class="space-y-3">
                <h2 class="text-base font-bold text-[#2A1614]" style="font-family: 'DM Serif Display', serif;">
                    Event Lainnya
                </h2>
                <div class="grid grid-cols-2 lg:grid-cols-3 gap-3.5 sm:gap-5">
                    @foreach($relatedEvents as $rel)
                        <x-event_card :event="$rel" />
                    @endforeach
                </div>
            </div>
        @endif

    </div>

    {{-- Floating Social Media (Kanan Bawah) --}}
    <x-floating_social />

</x-layout>
