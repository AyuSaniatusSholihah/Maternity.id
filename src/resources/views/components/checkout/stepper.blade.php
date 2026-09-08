@props(['step' => 1])

{{-- Stepper Component Reusable (100% Reliable Render with fallback) --}}
<div class="flex items-center justify-center max-w-xs mx-auto mb-6 w-full select-none">
    {{-- Step 1: Pilih Paket --}}
    <div class="flex flex-col items-center cursor-pointer" @click="step = 1">
        <span class="w-9 h-9 flex items-center justify-center rounded-full text-white font-semibold text-sm transition-all duration-300 shadow-xs"
              :class="step > 1 ? 'bg-[#5F8C72]' : (step === 1 ? 'bg-[#DEAAA1]' : 'bg-neutral-300 text-neutral-600')">
            <span x-show="step > 1" class="flex items-center justify-center">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                </svg>
            </span>
            <span x-show="step <= 1">1</span>
        </span>
        <span class="text-xs font-medium mt-1 transition-colors"
              :class="step > 1 ? 'text-[#5F8C72]' : (step === 1 ? 'text-[#DEAAA1] font-bold' : 'text-neutral-500')">
            Pilih Paket
        </span>
    </div>

    {{-- Line 1-2 --}}
    <div class="flex-1 h-[2px] mx-2 -mt-4 transition-colors duration-300"
         :class="step >= 2 ? 'bg-[#5F8C72]' : 'bg-neutral-300'"></div>

    {{-- Step 2: Pembayaran --}}
    <div class="flex flex-col items-center cursor-pointer" @click="step = 2">
        <span class="w-9 h-9 flex items-center justify-center rounded-full text-white font-semibold text-sm transition-all duration-300 shadow-xs"
              :class="step > 2 ? 'bg-[#5F8C72]' : (step === 2 ? 'bg-[#DEAAA1]' : 'bg-neutral-300 text-neutral-600')">
            <span x-show="step > 2" class="flex items-center justify-center">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                </svg>
            </span>
            <span x-show="step <= 2">2</span>
        </span>
        <span class="text-xs font-medium mt-1 transition-colors"
              :class="step > 2 ? 'text-[#5F8C72]' : (step === 2 ? 'text-[#DEAAA1] font-bold' : 'text-neutral-500')">
            Pembayaran
        </span>
    </div>

    {{-- Line 2-3 --}}
    <div class="flex-1 h-[2px] mx-2 -mt-4 transition-colors duration-300"
         :class="step >= 3 ? 'bg-[#5F8C72]' : 'bg-neutral-300'"></div>

    {{-- Step 3: Konfirmasi --}}
    <div class="flex flex-col items-center cursor-pointer" @click="step = 3">
        <span class="w-9 h-9 flex items-center justify-center rounded-full text-white font-semibold text-sm transition-all duration-300 shadow-xs"
              :class="step >= 6 ? 'bg-[#5F8C72]' : (step >= 3 ? 'bg-[#DEAAA1]' : 'bg-neutral-300 text-neutral-600')">
            <span x-show="step >= 6" class="flex items-center justify-center">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                </svg>
            </span>
            <span x-show="step < 6">3</span>
        </span>
        <span class="text-xs font-medium mt-1 transition-colors"
              :class="step >= 6 ? 'text-[#5F8C72]' : (step >= 3 ? 'text-[#DEAAA1] font-bold' : 'text-neutral-500')">
            Konfirmasi
        </span>
    </div>
</div>
