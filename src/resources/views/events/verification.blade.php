<x-layout title="Status Verifikasi Pembayaran — {{ $event->title ?? 'Pelatihan Maternitas' }} — Maternity.id">
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

            {{-- ── 2. KOLOM KANAN: STEPPER & VERIFICATION CARD ── --}}
            <div class="lg:col-span-6 flex flex-col items-center justify-start" x-data="{ step: 3 }">
                
                {{-- Stepper Navigation --}}
                <x-checkout.stepper />

                {{-- Verification Card --}}
                <div class="w-full max-w-md bg-[#FDF1ED] rounded-3xl p-8 sm:p-10 shadow-sm border border-[#EADBDB]/60 text-center flex flex-col items-center mt-2">
                    
                    {{-- Ilustrasi Jam & Badge Centang Hijau di Pojok Kanan Bawah --}}
                    <div class="relative w-24 h-24 flex items-center justify-center mb-6 mx-auto">
                        <div class="w-20 h-20 rounded-2xl bg-[#FCEBE7] border border-[#DEAAA1] flex items-center justify-center shadow-xs">
                            <svg class="w-10 h-10 text-[#C97A70]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        
                        {{-- Badge Centang Hijau --}}
                        <div class="absolute bottom-0 right-0 w-8 h-8 bg-[#5F8C72] rounded-full flex items-center justify-center text-white border-2 border-[#FDF1ED] shadow-sm">
                            <svg class="w-4 h-4 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                    </div>

                    {{-- Judul Status --}}
                    <h3 class="text-xl font-extrabold text-neutral-900 tracking-tight mb-3" style="font-family: 'DM Serif Display', serif;">
                        Sedang Diverifikasi
                    </h3>

                    {{-- Deskripsi Pesan --}}
                    <div class="space-y-2 text-xs text-neutral-600 leading-relaxed max-w-xs mb-8">
                        <p>
                            Bukti pembayaran Anda telah kami terima dan sedang dalam proses verifikasi oleh admin.
                        </p>
                        <p>
                            Kami akan menghubungi Anda melalui email jika sudah ada pembaruan.
                        </p>
                    </div>

                    {{-- Tombol Aksi --}}
                    <a href="{{ url('/') }}" 
                       class="w-full py-3.5 px-6 rounded-2xl bg-[#608D72] hover:bg-[#4e745d] text-white font-medium text-xs tracking-wide transition shadow-sm text-center">
                        Kembali ke Beranda
                    </a>

                </div>

            </div>

        </div>
    </div>
</x-layout>
