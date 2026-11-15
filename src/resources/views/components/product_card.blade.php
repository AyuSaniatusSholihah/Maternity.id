@props(['product'])

@php
    $title = $product['title'] ?? 'Produk Pilihan';
    $image = $product['image'] ?? 'https://images.unsplash.com/photo-1584515979956-d9f6e5d09982?auto=format&fit=crop&q=80&w=600';
    $tag = $product['tag'] ?? '';
    $location = $product['location'] ?? 'Indonesia';
    $price = $product['price'] ?? 'Rp 0';
    $sold = $product['sold'] ?? '';
    $affiliateUrl = $product['affiliate_url'] ?? ($product['tiktok_url'] ?? ($product['url'] ?? '#'));
@endphp

<div class="group flex flex-col justify-between bg-white rounded-2xl sm:rounded-3xl p-2 min-[380px]:p-2.5 sm:p-3 shadow-xs hover:shadow-md card-spring border border-[#DEA69E]/40 hover:border-[#DEA69E] transition-all">
    
    {{-- Top Area: Image + Details --}}
    <div>
        {{-- Image Thumbnail with Overlay Badge --}}
        <div class="relative w-full aspect-[4/3] rounded-xl sm:rounded-2xl overflow-hidden bg-neutral-100">
            <img 
                src="{{ $image }}" 
                alt="{{ $title }}" 
                class="w-full h-full object-cover group-hover:scale-106 transition-transform duration-500 ease-out"
                loading="lazy"
            />
            
            {{-- Floating Tag --}}
            @if (!empty($tag))
                <span class="absolute top-1.5 left-1.5 sm:top-2 sm:left-2 px-1.5 sm:px-2 py-0.5 rounded-full bg-[#F2C4BA]/95 backdrop-blur-sm text-[8px] min-[380px]:text-[9px] min-[400px]:text-[10px] font-bold text-[#782819] shadow-xs group-hover:bg-[#DEA69E] transition-colors">
                    {{ $tag }}
                </span>
            @endif
        </div>

        {{-- Card Info --}}
        <div class="pt-2 sm:pt-3 pb-0.5 px-0.5 space-y-1 sm:space-y-1.5">
            <h3 class="font-bold text-[11px] min-[380px]:text-xs sm:text-sm text-[#2D1E1E] line-clamp-1 group-hover:text-[#8C433C] transition-colors">
                {{ $title }}
            </h3>

            {{-- Location --}}
            <div class="flex items-center gap-1 text-[#8C433C] text-[9px] min-[380px]:text-[10px] sm:text-xs font-medium">
                <svg class="w-2.5 h-2.5 sm:w-3 sm:h-3 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <span class="text-neutral-500 text-[9px] min-[380px]:text-[10px] sm:text-[11px] truncate">{{ $location }}</span>
            </div>

            {{-- Price & Sold Count --}}
            <div class="pt-0.5 flex items-center justify-between">
                <span class="text-[11px] min-[380px]:text-xs sm:text-base font-extrabold text-[#3D2B2B] tracking-tight">
                    {{ $price }}
                </span>
                @if(!empty($sold))
                    <span class="text-[8px] min-[380px]:text-[9px] sm:text-[10px] text-neutral-400 font-medium">
                        Terjual {{ $sold }}
                    </span>
                @endif
            </div>
        </div>
    </div>

    {{-- Bottom Action: Affiliate Link --}}
    <div class="pt-1.5 sm:pt-2">
        <a 
            href="{{ $affiliateUrl }}" 
            target="_blank"
            rel="noopener noreferrer"
            class="w-full bg-[#FAF0EE] hover:bg-[#8C433C] text-[#782819] hover:text-white rounded-xl font-bold py-1.5 sm:py-2.5 px-2 sm:px-2.5 text-[10px] min-[380px]:text-[11px] sm:text-xs tracking-wide transition-all duration-300 flex items-center justify-between shadow-xs border border-[#DEA69E]/50 hover:border-[#8C433C] group/btn">
            <div class="flex items-center gap-1.5 mx-auto">
                <i class="fa-solid fa-arrow-up-right-from-square text-[10px] sm:text-xs"></i>
                <span>Lihat Produk</span>
            </div>
            <svg class="w-3 h-3 sm:w-3.5 sm:h-3.5 flex-shrink-0 transition-transform duration-300 group-hover/btn:translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
            </svg>
        </a>
    </div>

</div>
