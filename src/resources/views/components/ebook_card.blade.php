@props(['ebook'])

@php
    $title = $ebook['title'] ?? 'Modul Edukasi';
    $bookTitle = $ebook['book_title'] ?? ($ebook['title'] ?? 'Panduan Kehamilan');
    $author = $ebook['author'] ?? 'Tim Medis Maternity.id';
    $cover = $ebook['cover'] ?? ($ebook['image'] ?? 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&q=80&w=600');
    $price = $ebook['price'] ?? 'Gratis';
    $linkText = $ebook['link_text'] ?? 'download e-book';
    $handle = $ebook['handle'] ?? '@maternity.id';
    $url = $ebook['url'] ?? route('library');
    $btnText = $ebook['btn_text'] ?? 'Akses Ebook';
@endphp

<div class="group flex flex-col bg-white rounded-2xl sm:rounded-3xl overflow-hidden shadow-xs hover:shadow-md card-spring border border-[#DEA69E]/40 hover:border-[#DEA69E] transition-all">
    
    {{-- Top Header --}}
    <div class="pt-3.5 sm:pt-6 pb-2 sm:pb-3 px-2 sm:px-4 text-center bg-transparent">
        <h3 class="font-serif italic font-extrabold text-xs min-[400px]:text-sm sm:text-xl text-[#8C433C] group-hover:text-[#782819] leading-tight group-hover:scale-102 transition-all duration-300 line-clamp-2" style="font-family: 'DM Serif Display', serif;">
            {!! nl2br(e($title)) !!}
        </h3>
    </div>

    {{-- Arched Terracotta Body Section with Realistic Tablet Mockup --}}
    <div class="flex-1 bg-[#C27A6F] rounded-t-[36px] sm:rounded-t-[64px] pt-3.5 sm:pt-6 pb-3.5 sm:pb-5 px-2 sm:px-4 flex flex-col items-center justify-between text-center shadow-inner">
        
        {{-- Tablet Mockup --}}
        <div class="w-20 min-[400px]:w-24 sm:w-28 aspect-[3/4] bg-neutral-900 rounded-lg sm:rounded-xl p-1 sm:p-1.5 shadow-xl border border-neutral-800 relative group-hover:scale-108 group-hover:-rotate-1 transition-all duration-500">
            {{-- Camera dot --}}
            <div class="w-1 h-1 sm:w-1.5 sm:h-1.5 bg-neutral-700 rounded-full mx-auto mb-0.5"></div>
            
            {{-- Screen Display --}}
            <div class="w-full h-[calc(100%-6px)] sm:h-[calc(100%-8px)] bg-white rounded-md sm:rounded-lg p-1 sm:p-1.5 flex flex-col items-center justify-between overflow-hidden shadow-inner text-left">
                <img 
                    src="{{ $cover }}" 
                    alt="{{ $bookTitle }}" 
                    class="w-full h-8 min-[400px]:h-10 sm:h-14 object-cover rounded"
                    loading="lazy"
                />
                <div class="w-full mt-0.5">
                    <p class="text-[5px] min-[400px]:text-[5.5px] sm:text-[6.5px] font-bold text-neutral-800 leading-tight line-clamp-2">
                        {{ $bookTitle }}
                    </p>
                    <p class="text-[4px] min-[400px]:text-[4.5px] sm:text-[5.5px] text-neutral-500 mt-0.5 truncate">
                        by {{ $author }}
                    </p>
                </div>
            </div>
        </div>

        {{-- Metadata & Price --}}
        <div class="mt-2.5 sm:mt-3.5 space-y-0.5 text-white">
            <p class="text-[10px] sm:text-xs font-bold tracking-tight">
                Available for {{ $price }}
            </p>
            <p class="text-[8.5px] sm:text-[10px] font-medium text-pink-100/90 lowercase tracking-wide">
                {{ $linkText }}
            </p>

            @if (!empty($handle))
                <div class="pt-1">
                    <span class="inline-block px-2 sm:px-2.5 py-0.5 rounded-full border border-white/40 bg-white/15 backdrop-blur-sm text-[7.5px] sm:text-[8.5px] text-white/95 font-mono group-hover:bg-white/25 transition-colors truncate max-w-full">
                        {{ $author }}
                    </span>
                </div>
            @endif
        </div>
    </div>

    {{-- Bottom Action Button --}}
    <a 
        href="{{ $url }}" 
        onclick="alert('Membuka e-book {{ $bookTitle }}...')"
        class="w-full bg-[#FAF0EE] hover:bg-[#8C433C] text-[#782819] hover:text-white text-center font-bold py-2 sm:py-2.5 text-xs sm:text-sm transition-all duration-300 block border-t border-[#DEA69E]/40 shadow-xs">
        {{ $btnText }}
    </a>
</div>
