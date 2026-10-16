@props(['article'])

@php
    $title = $article['title'] ?? 'Artikel Kesehatan';
    $slug = $article['slug'] ?? '';
    $url = !empty($slug) ? route('articles.show', $slug) : ($article['link'] ?? route('articles.index'));
    // Handling for articles without images
    $image = $article['thumbnail_image'] ?? ($article['image'] ?? 'https://images.unsplash.com/photo-1555252333-9f8e92e65df9?auto=format&fit=crop&q=80&w=600');
    $category = $article['category'] ?? 'Umum';
    $excerpt = $article['excerpt'] ?? '';
    // Display author name instead of reading time
    $authorName = $article['author'] ?? 'Tim Medis';
@endphp

<a href="{{ $url }}" class="block">
    <article class="bg-white rounded-2xl sm:rounded-3xl border border-[#DEA69E]/40 p-2 min-[380px]:p-2.5 sm:p-4 shadow-xs hover:shadow-md flex flex-col justify-between space-y-2 sm:space-y-2.5 card-spring group transition-all">
        <!-- Card Image -->
        <div class="w-full h-24 min-[380px]:h-28 min-[450px]:h-36 sm:h-40 rounded-xl sm:rounded-2xl overflow-hidden bg-neutral-100">
            <img src="{{ $image }}" 
                 alt="{{ $title }}" 
                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                 loading="lazy">
        </div>

        <!-- Card Content -->
        <div class="space-y-1.5 sm:space-y-2 flex-1 flex flex-col justify-between">
            <div class="space-y-1 sm:space-y-1.5">
                {{-- Display only first category --}}
                <span class="inline-block px-1.5 sm:px-2.5 py-0.5 bg-[#FAF0EE] text-[#8C433C] text-[8px] min-[380px]:text-[9px] min-[400px]:text-[10px] font-bold rounded-full">
                    {{ $category }}
                </span>

                <h3 class="text-[11px] min-[380px]:text-xs min-[400px]:text-sm sm:text-sm font-bold text-[#2A1614] leading-snug line-clamp-2 group-hover:text-[#8C433C] transition" style="font-family: 'DM Serif Display', serif;">
                    {{ $title }}
                </h3>

                @if(!empty($excerpt))
                    <p class="hidden min-[480px]:block text-[11px] text-neutral-500 line-clamp-2 leading-relaxed">
                        {{ $excerpt }}
                    </p>
                @endif
            </div>

            {{-- Display author name instead of read time, hide comment icon --}}
            <div class="pt-1.5 sm:pt-2 border-t border-slate-50 flex items-center justify-between text-[8px] min-[380px]:text-[9px] min-[400px]:text-[10px] text-slate-400">
                <div class="flex items-center gap-1">
                    <i class="fa-regular fa-user text-slate-400 text-[8px] sm:text-[9px]"></i>
                    <span class="truncate max-w-[90px] sm:max-w-none">{{ $authorName }}</span>
                </div>
                <span class="text-[#8C433C] font-bold flex items-center gap-0.5">
                    <i class="fa-solid fa-chevron-right text-[8px]"></i>
                </span>
            </div>
        </div>
    </article>
</a>
