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
@endphp

<div class="bg-white rounded-2xl sm:rounded-3xl border border-[#DEA69E]/40 p-2 min-[380px]:p-3 sm:p-4 shadow-xs hover:shadow-md transition-all flex flex-col justify-between space-y-2 sm:space-y-3 card-spring group">
    
    <!-- Event Image Container -->
    <div class="group/poster relative w-full aspect-[210/297] rounded-xl sm:rounded-2xl overflow-hidden bg-neutral-100">
        <img src="{{ $image }}" 
             alt="{{ $title }}" 
             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
             loading="lazy">

        <!-- Poster Hover Preview -->
        <a href="{{ $url }}"
           aria-label="Lihat detail {{ $title }}"
           class="absolute inset-0 flex items-end bg-neutral-950/0 p-3 sm:p-4 text-white opacity-0 transition-all duration-300 group-hover/poster:bg-neutral-950/65 group-hover/poster:opacity-100 focus-visible:bg-neutral-950/65 focus-visible:opacity-100 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-inset">
            <span class="translate-y-3 transition-transform duration-300 group-hover/poster:translate-y-0">
                <span class="mb-1.5 inline-flex items-center gap-1 rounded-full bg-white/20 px-2 py-1 text-[9px] font-bold uppercase tracking-wider backdrop-blur-sm">
                    <i class="fa-solid fa-arrow-up-right-from-square text-[8px]"></i>
                    Lihat event
                </span>
                <span class="block line-clamp-2 text-sm font-bold leading-snug sm:text-base">{{ $title }}</span>
                <span class="mt-2 flex items-center gap-1 text-[10px] font-semibold text-white/90 sm:text-xs">
                    <i class="fa-regular fa-calendar text-[9px]"></i>
                    {{ $dateString }}{{ $timeString ? ' • ' . $timeString : '' }}
                </span>
                <span class="mt-1 block line-clamp-2 text-[10px] leading-relaxed text-white/85 sm:text-xs">
                    {{ $event['description'] ?? 'Lihat jadwal, lokasi, dan informasi lengkap event.' }}
                </span>
            </span>
        </a>
        
        <!-- Format Badge (Top Left) -->
        <div class="absolute top-2 left-2 sm:top-3 sm:left-3">
            @if($formatType === 'online')
                <span class="px-2 py-0.5 bg-[#EBF5EE]/95 backdrop-blur-md text-[#4D7C59] text-[8px] min-[380px]:text-[9px] min-[400px]:text-[10px] font-extrabold uppercase tracking-wider rounded-full shadow-2xs border border-[#BDE0C6]">
                    {{ $format }}
                </span>
            @else
                <span class="px-2 py-0.5 bg-[#FFF3EC]/95 backdrop-blur-md text-[#D96B27] text-[8px] min-[380px]:text-[9px] min-[400px]:text-[10px] font-extrabold uppercase tracking-wider rounded-full shadow-2xs border border-[#FFD8C2]">
                    {{ $format }}
                </span>
            @endif
        </div>

        <!-- Bookmark Indicator / Action (Top Right) -->
        <button type="button" 
                class="absolute top-2 right-2 sm:top-3 sm:right-3 w-6 h-6 sm:w-8 sm:h-8 rounded-lg sm:rounded-xl bg-white/90 backdrop-blur-md text-[#8C433C] hover:bg-white shadow-2xs flex items-center justify-center transition"
                title="Simpan Event">
            <i class="{{ !empty($event['is_bookmarked']) ? 'fa-solid fa-bookmark' : 'fa-regular fa-bookmark' }} text-[10px] sm:text-xs"></i>
        </button>
    </div>

</div>
