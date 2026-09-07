<x-layout title="Pendaftaran Diterima — {{ $event->title ?? 'Pelatihan Maternitas' }} — Maternity.id">
    <x-slot name="head">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <style>
            details summary::-webkit-details-marker {
                display: none;
            }
        </style>
    </x-slot>

    <div class="w-full min-h-[calc(100vh-120px)] bg-[#FBF5F2] text-neutral-800 p-4 sm:p-6 md:p-10 font-sans rounded-3xl border border-[#DEAAA1]/30 shadow-xs my-2 relative">
        <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-start">
            
            {{-- ── 1. KOLOM KIRI: FAQ & TESTIMONIAL REUSABLE ── --}}
            <div class="lg:col-span-6 flex flex-col justify-between space-y-10">
                <x-checkout.faq />
                <x-checkout.testimonial />
            </div>

            {{-- ── 2. KOLOM KANAN: STEPPER & CONFIRMATION APPROVED CARD ── --}}
            <div class="lg:col-span-6 flex flex-col items-center justify-start" x-data="{ step: 6 }">
                
                {{-- Stepper Navigation (Step 1, 2, 3 Selesai dengan Centang Hijau) --}}
                <x-checkout.stepper />

                {{-- Confirmation Card --}}
                <div class="w-full max-w-md bg-[#FAF0EC] rounded-3xl p-8 sm:p-10 shadow-sm border border-[#EADBDB]/60 text-center flex flex-col items-center mt-2">
                    
                    {{-- Ilustrasi Amplop Surat & Centang Diterima Bersih --}}
                    <div class="relative w-24 h-24 flex items-center justify-center mb-6 mx-auto">
                        <div class="w-20 h-20 rounded-2xl bg-[#EDF5F0] border border-[#9DB89D] flex items-center justify-center shadow-xs">
                            <svg class="w-10 h-10 text-[#5F8C72]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        
                        {{-- Badge Centang Hijau di Pojok Kanan Bawah --}}
                        <div class="absolute bottom-0 right-0 w-8 h-8 bg-[#5F8C72] rounded-full flex items-center justify-center text-white border-2 border-[#FAF0EC] shadow-sm">
                            <svg class="w-4 h-4 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                    </div>

                    {{-- Judul Status --}}
                    <h3 class="text-xl font-extrabold text-neutral-900 tracking-tight mb-3" style="font-family: 'DM Serif Display', serif;">
                        Pendaftaran Diterima!
                    </h3>

                    {{-- Deskripsi Pesan --}}
                    <p class="text-xs text-neutral-600 leading-relaxed max-w-xs mb-8">
                        Selamat! Pendaftaran Anda telah disetujui oleh admin. Email konfirmasi telah dikirimkan ke alamat email Anda.
                    </p>

                    {{-- Tombol Aksi --}}
                    <a href="{{ route('events') }}" 
                       class="w-full py-3.5 px-6 rounded-2xl bg-[#5F8C72] hover:bg-[#4e745d] text-white font-semibold text-xs tracking-wide transition shadow-sm text-center">
                        Lihat Detail Pelatihan
                    </a>

                </div>

            </div>

        </div>
    </div>
</x-layout>
