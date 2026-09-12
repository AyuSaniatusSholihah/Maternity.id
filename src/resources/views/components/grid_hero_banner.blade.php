@props([
    'title' => 'Bergabung dengan Komunitas Maternity.id',
    'subtitle' => 'Dapatkan pendampingan eksklusif dari bidan, dokter spesialis, serta akses materi kehamilan & parenting terlengkap.',
    'primaryText' => 'Mulai Sekarang',
    'primaryUrl' => url('/events'),
    'secondaryText' => 'Konsultasi Ahli',
    'secondaryUrl' => 'https://wa.me/6281234567890?text=Halo%20Admin%20Maternity.id,%20saya%20ingin%20konsultasi',
    'badge' => 'Eksklusif & Terpercaya',
    'avatarUrl' => 'https://images.unsplash.com/photo-1555252333-9f8e92e65df9?auto=format&fit=crop&q=80&w=200',
    'avatarAlt' => 'Maternity Care',
    'caption' => ''
])

<div class="relative w-full max-w-5xl mx-auto my-4 sm:my-6 px-2 sm:px-4 select-none">
    <div class="relative w-full border border-[#DEA69E]/50 rounded-2xl sm:rounded-3xl overflow-hidden bg-white/80 backdrop-blur-xs shadow-sm">
        
        <!-- Subtle Architectural Grid Background Pattern -->
        <div class="absolute inset-0 -z-10 pointer-events-none opacity-40"
             style="background-size: 24px 24px;
                    background-image: 
                        linear-gradient(to right, rgba(222, 170, 161, 0.25) 1px, transparent 1px),
                        linear-gradient(to bottom, rgba(222, 170, 161, 0.25) 1px, transparent 1px);">
        </div>

        <!-- Ambient Glow Gradient -->
        <div class="absolute inset-0 -z-10 pointer-events-none"
             style="background: radial-gradient(60% 80% at 50% 100%, rgba(222, 170, 161, 0.35) 0%, rgba(95, 140, 114, 0.15) 60%, transparent 100%);">
        </div>
         
        <!-- Corner Plus Markers -->
        <div class="absolute top-2 left-2 text-[#8C433C]/40 font-light select-none z-20 pointer-events-none">
            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m7-7H5" />
            </svg>
        </div>
        <div class="absolute top-2 right-2 text-[#8C433C]/40 font-light select-none z-20 pointer-events-none">
            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m7-7H5" />
            </svg>
        </div>
        <div class="absolute bottom-2 left-2 text-[#8C433C]/40 font-light select-none z-20 pointer-events-none">
            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m7-7H5" />
            </svg>
        </div>
        <div class="absolute bottom-2 right-2 text-[#8C433C]/40 font-light select-none z-20 pointer-events-none">
            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m7-7H5" />
            </svg>
        </div>

        <!-- Compact Hero Content -->
        <div class="relative w-full flex items-center flex-col justify-center py-6 sm:py-8 px-4 sm:px-10 text-center z-10">
            
            @if(!empty($badge))
                <div class="inline-flex items-center gap-1.5 px-3 py-0.5 rounded-full text-[11px] font-bold bg-[#EBF5EE] text-[#4D7C59] border border-[#BDE0C6] mb-2.5 shadow-2xs">
                    <span class="w-1.5 h-1.5 rounded-full bg-[#4D7C59] animate-pulse"></span>
                    <span>{{ $badge }}</span>
                </div>
            @endif

            <h2 class="text-xl sm:text-2xl md:text-3xl font-extrabold text-[#2A1614] tracking-tight leading-snug max-w-2xl"
                style="font-family: 'DM Serif Display', serif;">
                {{ $title }}
            </h2>

            <p class="text-xs sm:text-sm text-[#5C4542] py-2 sm:py-3 max-w-lg mx-auto leading-relaxed">
                {{ $subtitle }}
            </p>

            <!-- Action Buttons -->
            <div class="flex flex-wrap items-center justify-center gap-2.5 pt-1">
                <a href="{{ $primaryUrl }}"
                   class="inline-flex items-center justify-center gap-1.5 bg-[#5F8C72] hover:bg-[#4d725d] text-white font-bold px-5 sm:px-6 py-2 rounded-full text-xs sm:text-sm shadow-xs hover:shadow-md transition-all duration-200 transform hover:scale-102 active:scale-98">
                    <span>{{ $primaryText }}</span>
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </a>

                <a href="{{ $secondaryUrl }}" target="_blank"
                   class="inline-flex items-center justify-center gap-1.5 bg-white hover:bg-[#FAF0EE] text-[#2E1D1B] font-bold px-5 sm:px-6 py-2 rounded-full text-xs sm:text-sm border border-[#DEA69E]/60 shadow-2xs hover:shadow-xs transition-all duration-200 transform hover:scale-102 active:scale-98">
                    <i class="fa-brands fa-whatsapp text-xs text-[#25D366]"></i>
                    <span>{{ $secondaryText }}</span>
                </a>
            </div>
        </div>

        <!-- Subtle Bottom Border Bar with Accent Dot Pattern -->
        <div class="w-full h-2 bg-gradient-to-r from-[#DEA69E]/30 via-[#5F8C72]/30 to-[#DEA69E]/30 border-t border-[#DEA69E]/30"></div>

    </div>
</div>
