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

        {{-- Daftar Pilihan Pelatihan --}}
        <div class="space-y-3">
            {{-- Opsi 1: Pelatihan Yoga --}}
            <label @click="tempSelected = 'yoga'"
                   :class="tempSelected === 'yoga' ? 'bg-[#C5D5C5] border-[#9DB89D]' : 'bg-white/80 border-neutral-200 hover:bg-neutral-50'"
                   class="relative flex items-center justify-between p-4 rounded-2xl border cursor-pointer transition-all duration-150">
                <div class="space-y-1">
                    <span class="block font-bold text-sm text-neutral-800">Pelatihan Yoga</span>
                    <span class="block text-[11px] text-[#608D72] font-medium" x-show="tempSelected === 'yoga'">Sedang dipilih</span>
                </div>

                <div class="flex items-center gap-3">
                    <span class="text-xs font-semibold text-neutral-700">Rp 60.000, 00</span>
                    
                    {{-- Custom Radio Bulat --}}
                    <div class="w-6 h-6 rounded-full border-2 flex items-center justify-center transition-all"
                         :class="tempSelected === 'yoga' ? 'border-[#608D72] bg-white shadow-2xs' : 'border-neutral-300 bg-white/80'">
                        <div class="w-3 h-3 rounded-full bg-[#608D72] transition-transform" 
                             x-show="tempSelected === 'yoga'" 
                             x-transition></div>
                    </div>
                </div>
            </label>

            {{-- Opsi 2: Workshop Perawatan Bayi --}}
            <label @click="tempSelected = 'perawatan-bayi'"
                   :class="tempSelected === 'perawatan-bayi' ? 'bg-[#C5D5C5] border-[#9DB89D]' : 'bg-white/80 border-neutral-200 hover:bg-neutral-50'"
                   class="relative flex items-center justify-between p-4 rounded-2xl border cursor-pointer transition-all duration-150">
                <div class="space-y-1">
                    <span class="block font-bold text-sm text-neutral-800">Workshop Perawatan Bayi</span>
                    <span class="block text-[11px] text-[#608D72] font-medium" x-show="tempSelected === 'perawatan-bayi'">Sedang dipilih</span>
                </div>

                <div class="flex items-center gap-3">
                    <span class="text-xs font-semibold text-neutral-700">Rp 60.000, 00</span>
                    
                    {{-- Custom Radio Bulat --}}
                    <div class="w-6 h-6 rounded-full border-2 flex items-center justify-center transition-all"
                         :class="tempSelected === 'perawatan-bayi' ? 'border-[#608D72] bg-white shadow-2xs' : 'border-neutral-300 bg-white/80'">
                        <div class="w-3 h-3 rounded-full bg-[#608D72] transition-transform" 
                             x-show="tempSelected === 'perawatan-bayi'" 
                             x-transition></div>
                    </div>
                </div>
            </label>
        </div>

        {{-- Footer Tombol Simpan --}}
        <div class="pt-2 flex items-center justify-end gap-3 border-t border-[#EADBDB]/60">
            <button @click="openModal = false" 
                    type="button" 
                    class="px-4 py-2 rounded-xl text-xs font-semibold text-neutral-600 hover:bg-neutral-200/60 transition">
                Batal
            </button>
            <button @click="saveSelection()" 
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
