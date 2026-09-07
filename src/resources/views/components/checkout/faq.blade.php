@props([
    'backUrl' => route('events'),
    'title' => 'FAQ',
    'subtitle' => 'Join our expert-led sessions designed to empower and inform'
])

<div>
    {{-- Header FAQ & Tombol Back --}}
    <div class="flex items-center gap-3 mb-2">
        <a href="{{ $backUrl }}" class="text-[#5F8C72] hover:opacity-80 transition inline-flex items-center justify-center p-1 rounded-lg hover:bg-[#5F8C72]/10" title="Kembali ke Event">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M10 9V5l-7 7 7 7v-4.1c5 0 8.5 1.6 11 5.1-1-5-4-10-11-11z"/>
            </svg>
        </a>
        <h2 class="text-2xl font-bold tracking-tight text-neutral-900" style="font-family: 'DM Serif Display', serif;">{{ $title }}</h2>
    </div>
    <p class="text-sm text-neutral-600 mb-6">
        {{ $subtitle }}
    </p>

    {{-- Accordion List FAQ --}}
    @php
        $faqs = [
            'Bagaimana cara mendaftar pelatihan' => 'Silakan hubungi admin atau ikuti petunjuk pembayaran yang tertera di layar untuk melanjutkan proses pendaftaran.',
            'Apa benefit jika terdaftar sebagai member' => 'Member mendapatkan potongan harga khusus, akses rekaman video selamanya, konsultasi prioritas, dan modul PDF eksklusif.',
            'Bagaimana mendaftar pelatihan offline' => 'Untuk pelatihan tatap muka, pastikan memilih lokasi kota yang sesuai (JKT, SBY, BDG). Tiket fisik & barcode akan dikirim via email/WhatsApp.',
            'Bagaimana mengakses ebooknya' => 'Setelah pembayaran terkonfirmasi, materi ebook dapat langsung dibaca dan diunduh di menu Library akun Anda.',
            'Bagaimana mendapatkan kode akses member' => 'Kode akses dikirim otomatis setelah mendaftar paket membership atau melalui admin komunitas Maternity.id.',
        ];
    @endphp

    <div class="space-y-3">
        @foreach ($faqs as $question => $answer)
            <details class="group bg-[#FAF6F4] border border-[#DEAAA1] rounded-xl px-4 py-3 cursor-pointer transition-all shadow-2xs">
                <summary class="flex justify-between items-center list-none font-medium text-sm text-neutral-800 select-none">
                    <span>{{ $question }}</span>
                    <svg class="w-4 h-4 text-[#5F8C72] transition-transform duration-200 group-open:rotate-180 shrink-0 ml-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </summary>
                <p class="mt-3 text-xs text-neutral-600 leading-relaxed pt-2 border-t border-neutral-100">
                    {{ $answer }}
                </p>
            </details>
        @endforeach
    </div>
</div>
