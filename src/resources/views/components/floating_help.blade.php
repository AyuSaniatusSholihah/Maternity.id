{{--
    Floating Help / FAQ Button (Kanan Bawah)
    Menampilkan modal FAQ mini tentang pembayaran saat diklik.
    Dipakai di: events/checkout.blade.php
--}}
<div x-data="{
        openHelp: false,
        faqs: [
            {
                q: 'Bagaimana cara melakukan pembayaran?',
                a: 'Scan QRIS yang tersedia, lalu upload bukti transfer pada langkah berikutnya. Konfirmasi akan dikirim via email setelah verifikasi.',
                open: false
            },
            {
                q: 'Berapa lama proses verifikasi pembayaran?',
                a: 'Verifikasi pembayaran dilakukan dalam 1×24 jam kerja. Anda akan mendapat notifikasi via email setelah disetujui.',
                open: false
            },
            {
                q: 'Apakah saya bisa mendapat refund?',
                a: 'Refund dapat diajukan maksimal 3 hari sebelum tanggal event dengan menghubungi tim kami via WhatsApp.',
                open: false
            },
            {
                q: 'Bagaimana jika bukti pembayaran ditolak?',
                a: 'Anda akan mendapat notifikasi dan dapat mengupload ulang bukti pembayaran yang valid melalui halaman checkout.',
                open: false
            },
        ]
     }"
     @click.away="openHelp = false"
     class="fixed bottom-16 right-3 sm:bottom-8 sm:right-8 z-50 flex flex-col items-end gap-2.5 select-none">

    {{-- Panel FAQ --}}
    <div x-show="openHelp"
         x-transition:enter="transition ease-out duration-300 transform origin-bottom-right"
         x-transition:enter-start="opacity-0 translate-y-4 scale-90"
         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
         x-transition:leave="transition ease-in duration-200 transform origin-bottom-right"
         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
         x-transition:leave-end="opacity-0 translate-y-4 scale-90"
         class="w-72 sm:w-80 bg-white rounded-2xl shadow-2xl border border-[#DEA69E]/30 overflow-hidden"
         style="display: none;">

        {{-- Header Panel --}}
        <div class="px-4 py-3 bg-gradient-to-r from-[#FAF0EE] to-[#FDF5F3] border-b border-[#DEA69E]/20 flex items-center gap-2.5">
            <div class="w-7 h-7 rounded-full bg-[#8C433C] flex items-center justify-center shrink-0">
                <i class="fa-solid fa-circle-question text-white text-sm"></i>
            </div>
            <div>
                <p class="text-xs font-extrabold text-[#2A1614]">Bantuan Pembayaran</p>
                <p class="text-[10px] text-neutral-500">Pertanyaan yang sering ditanyakan</p>
            </div>
        </div>

        {{-- FAQ List --}}
        <div class="max-h-72 overflow-y-auto divide-y divide-gray-50">
            <template x-for="(faq, i) in faqs" :key="i">
                <div class="px-4 py-3">
                    <button type="button"
                            @click="faq.open = !faq.open"
                            class="w-full flex items-start justify-between gap-2 text-left cursor-pointer group">
                        <span class="text-xs font-semibold text-neutral-800 group-hover:text-[#8C433C] transition leading-snug" x-text="faq.q"></span>
                        <i class="fa-solid fa-chevron-down text-[10px] text-neutral-400 shrink-0 mt-0.5 transition-transform duration-200"
                           :class="faq.open ? 'rotate-180 text-[#8C433C]' : ''"></i>
                    </button>
                    <div x-show="faq.open"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 -translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         class="mt-2 text-[11px] text-neutral-500 leading-relaxed"
                         style="display: none;"
                         x-text="faq.a">
                    </div>
                </div>
            </template>
        </div>

        {{-- Footer --}}
        <div class="px-4 py-2.5 bg-gray-50/80 border-t border-gray-100">
            <a href="https://wa.me/" target="_blank"
               class="flex items-center justify-center gap-1.5 text-[11px] text-[#25D366] font-bold hover:underline">
                <i class="fa-brands fa-whatsapp text-sm"></i>
                Chat langsung via WhatsApp
            </a>
        </div>
    </div>

    {{-- Main ? Button --}}
    <button type="button"
            @click="openHelp = !openHelp"
            class="w-11 h-11 sm:w-13 sm:h-13 bg-white hover:bg-[#FAF0EE] text-[#8C433C] rounded-full flex items-center justify-center shadow-[0_8px_24px_rgba(140,67,60,0.2)] border-2 border-[#DEA69E] transition-all transform hover:scale-110 active:scale-95 focus:outline-none relative group"
            aria-label="Bantuan Pembayaran"
            title="Bantuan & FAQ Pembayaran">
        <i class="fa-solid text-base sm:text-xl transition-transform duration-300 font-black"
           :class="openHelp ? 'fa-xmark rotate-90 text-[#8C433C]' : 'fa-circle-question group-hover:scale-110 text-[#8C433C]'"></i>

        {{-- Pulse ring saat tertutup --}}
        <span x-show="!openHelp"
              class="absolute inset-0 rounded-full border-2 border-[#DEA69E] animate-ping opacity-30 pointer-events-none"
              style="display: none;"></span>
    </button>

</div>
