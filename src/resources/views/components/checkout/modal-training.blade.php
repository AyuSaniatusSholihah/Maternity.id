{{-- Reusable Modal Pilih / Ganti Pelatihan --}}
<div x-show="openModal" 
     x-transition:enter="ease-out duration-200"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="ease-in duration-150"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/40 backdrop-blur-[2px]"
     style="display: none;">
     
    {{-- Modal Card --}}
    <div @click.away="openModal = false" 
         x-show="openModal"
         x-transition:enter="ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="ease-in duration-150"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="relative w-full max-w-lg bg-[#FAF5F2] rounded-3xl p-5 sm:p-8 shadow-2xl border border-[#EADBDB] transition-all flex flex-col space-y-4 max-h-[90vh] overflow-y-auto">
        
        {{-- Header & Close Button --}}
        <div class="flex items-start justify-between">
            <div>
                <h3 class="text-lg font-bold text-neutral-900 tracking-tight" style="font-family: 'DM Serif Display', serif;">Pilih Pelatihan</h3>
                <p class="text-xs text-neutral-500 mt-0.5">Pilih pelatihan yang ingin kamu ikuti</p>
            </div>
            <button @click="openModal = false" 
                    type="button" 
                    class="text-[#D37B75] hover:text-[#b25b55] p-1 rounded-lg transition cursor-pointer"
                    title="Tutup Modal">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        {{-- Pelatihan yang berasal dari event yang dipilih user --}}
        <div class="rounded-2xl border border-[#9DB89D] bg-[#C5D5C5] p-4">
            <div class="flex items-center justify-between gap-4">
                <div class="space-y-1">
                    <span class="block font-bold text-sm text-neutral-800">{{ $event->title }}</span>
                    <span class="block text-[11px] text-[#608D72] font-medium">Pelatihan yang dipilih</span>
                </div>
                <span class="shrink-0 text-xs font-semibold text-neutral-700">{{ $event->price }}</span>
            </div>
        </div>

        {{-- Footer Tombol Simpan --}}
        <div class="pt-2 flex items-center justify-end gap-3 border-t border-[#EADBDB]/60">
            <button @click="openModal = false" 
                    type="button" 
                    class="px-4 py-2 rounded-xl text-xs font-semibold text-neutral-600 hover:bg-neutral-200/60 transition">
                Batal
            </button>
            <button @click="openModal = false" 
                    type="button" 
                    class="bg-[#608D72] hover:bg-[#4f755e] text-white text-xs font-bold px-6 py-2.5 rounded-xl transition-all shadow-sm flex items-center gap-1.5 cursor-pointer">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                <span>Simpan</span>
            </button>
        </div>

    </div>
</div>
