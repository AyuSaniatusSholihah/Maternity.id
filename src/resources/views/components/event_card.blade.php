@props(['event', 'stagger' => 1])

@php
    $title = $event['title'] ?? 'Event Maternity';
    $slug = $event['slug'] ?? '';
    $url = !empty($slug) ? route('events.show', $slug) : ($event['link'] ?? route('events'));
    $image = $event['thumbnail_image'] ?? ($event['image'] ?? 'https://images.unsplash.com/photo-1555252333-9f8e92e65df9?auto=format&fit=crop&w=800&q=80');
    $format = $event['format'] ?? ($event['tag'] ?? 'ONLINE');
    $formatType = $event['format_type'] ?? ($event['tag_type'] ?? (str_contains(strtolower($format), 'offline') ? 'offline' : 'online'));
    $dateString = $event['date_string'] ?? ($event['date'] ?? 'Jadwal Terbuka');
    $timeString = $event['time_string'] ?? '';
    $category = $event['category'] ?? 'Event';
    $price = $event['price'] ?? 'Gratis';
    $isFree = !empty($event['is_free']) || strtolower($price) === 'gratis';
    $duration = $event['duration'] ?? '';
@endphp

<div class="bg-white rounded-2xl sm:rounded-3xl border border-[#DEA69E]/40 p-3 sm:p-4 shadow-xs hover:shadow-md transition-all flex flex-col justify-between space-y-2.5 sm:space-y-3 card-spring group">
    
    <!-- Event Image Container -->
    <div class="relative w-full h-36 min-[450px]:h-40 sm:h-44 lg:h-48 rounded-xl sm:rounded-2xl overflow-hidden bg-neutral-100">
        <img src="{{ $image }}" 
             alt="{{ $title }}" 
             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
             loading="lazy">
        
        <!-- Format Badge (Top Left) -->
        <div class="absolute top-2 left-2 sm:top-3 sm:left-3">
            @if($formatType === 'online')
                <span class="px-2.5 py-0.5 bg-[#EBF5EE]/95 backdrop-blur-md text-[#4D7C59] text-[9px] min-[400px]:text-[10px] font-extrabold uppercase tracking-wider rounded-full shadow-2xs border border-[#BDE0C6]">
                    {{ $format }}
                </span>
            @else
                <span class="px-2.5 py-0.5 bg-[#FFF3EC]/95 backdrop-blur-md text-[#D96B27] text-[9px] min-[400px]:text-[10px] font-extrabold uppercase tracking-wider rounded-full shadow-2xs border border-[#FFD8C2]">
                    {{ $format }}
                </span>
            @endif
        </div>

        <!-- Bookmark Indicator / Action (Top Right) -->
        <button type="button" 
                onclick="alert('Event disimpan ke favorit!')"
                class="absolute top-2 right-2 sm:top-3 sm:right-3 w-7 h-7 sm:w-8 sm:h-8 rounded-lg sm:rounded-xl bg-white/90 backdrop-blur-md text-[#8C433C] hover:bg-white shadow-2xs flex items-center justify-center transition"
                title="Simpan Event">
            <i class="{{ !empty($event['is_bookmarked']) ? 'fa-solid fa-bookmark' : 'fa-regular fa-bookmark' }} text-xs"></i>
        </button>
    </div>

    <!-- Event Details Body -->
    <div class="space-y-1.5 sm:space-y-2 flex-1 flex flex-col justify-between">
        <div class="space-y-1 sm:space-y-1.5">
            <!-- Schedule Date & Time -->
            <div class="flex items-center gap-1.5 text-[10px] min-[400px]:text-[11px] font-bold text-[#8C433C]">
                <i class="fa-regular fa-calendar text-[10px]"></i>
                <span class="truncate">{{ $dateString }}{{ $timeString ? ' • ' . $timeString : '' }}</span>
            </div>

            <!-- Event Title -->
            <h3 class="text-xs min-[400px]:text-sm sm:text-base font-bold text-[#2A1614] leading-snug group-hover:text-[#8C433C] transition line-clamp-2" style="font-family: 'DM Serif Display', serif;">
                <a href="{{ $url }}">
                    {{ $title }}
                </a>
            </h3>

            @if (!empty($event['description']))
                <p class="hidden min-[480px]:block text-[11px] sm:text-xs text-neutral-500 line-clamp-2 leading-relaxed">
                    {{ $event['description'] }}
                </p>
            @endif
        </div>

        <!-- Card Footer: Tag, Duration/Price & Lihat Detail Button -->
        <div class="pt-2 sm:pt-2.5 border-t border-slate-100 flex items-center justify-between gap-2">
            <div class="flex items-center gap-1.5">
                <span class="px-2 py-0.5 bg-[#FAF0EE] text-[#8C433C] rounded-md font-semibold text-[9px] min-[400px]:text-[10px]">
                    {{ $category }}
                </span>
                @if($duration)
                    <span class="hidden sm:inline-flex items-center gap-1 text-[10px] text-neutral-400">
                        <i class="fa-regular fa-clock text-[9px]"></i>
                        <span>{{ $duration }}</span>
                    </span>
                @elseif($price)
                    <span class="text-[11px] font-bold {{ $isFree ? 'text-[#4D7C59]' : 'text-[#8C433C]' }}">
                        {{ $price }}
                    </span>
                @endif
            </div>

            <a href="{{ $url }}" 
               class="px-3 sm:px-4 py-1.5 rounded-full bg-[#FAF0EE] hover:bg-[#8C433C] text-[#8C433C] hover:text-white text-[11px] sm:text-xs font-bold transition duration-200 border border-[#DEA69E]/50 shadow-2xs">
                Lihat Detail
            </a>
        </div>
    </div>

</div>
