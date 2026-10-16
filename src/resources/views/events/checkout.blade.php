<x-layout title="Checkout & Pembayaran — {{ $event->title ?? 'Pelatihan Maternitas' }} — Maternity.id">
    <x-slot name="head">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <style>
            details summary::-webkit-details-marker {
                display: none;
            }
        </style>
    </x-slot>

    <div x-data="{ 
            step: {{ request('status') === 'approved' ? 6 : (request('status') === 'verifying' ? 5 : (request('step', 1))) }},
            openModal: false, 
            selected: '{{ ($event->slug ?? '') === 'newborn-gentle-care-and-massage' ? 'perawatan-bayi' : 'yoga' }}',
            tempSelected: '{{ ($event->slug ?? '') === 'newborn-gentle-care-and-massage' ? 'perawatan-bayi' : 'yoga' }}',
            selectedTitle: '{{ $event->title ?? 'Pelatihan Yoga' }}',
            selectedPrice: '{{ $event->price ?? 'Rp60.000' }}',
            promoCode: '',
            promoApplied: false,
            discount: {{ round(($event->price_numeric ?? 60000) * 0.1) }},
            basePrice: {{ $event->price_numeric ?? 60000 }},
            proofSelected: false,
            proofName: '',
            
            get totalAmount() {
                let total = this.basePrice - (this.promoApplied ? this.discount : 0);
                return 'Rp ' + total.toLocaleString('id-ID') + ',00';
            },

            applyPromo() {
                if (this.promoCode.trim() !== '') {
                    this.promoApplied = true;
                }
            },

            removePromo() {
                this.promoApplied = false;
                this.promoCode = '';
            },

            saveSelection() {
                this.selected = this.tempSelected;
                if (this.selected === 'yoga') {
                    this.selectedTitle = 'Pelatihan Yoga';
                    this.selectedPrice = 'Rp60.000';
                    this.basePrice = 60000;
                } else if (this.selected === 'perawatan-bayi') {
                    this.selectedTitle = 'Workshop Perawatan Bayi';
                    this.selectedPrice = 'Rp60.000';
                    this.basePrice = 60000;
                }
                this.openModal = false;
            },

            init() {
                this.$watch('step', value => {
                    if (value === 2 || value === 3) {
                        this.savePendingPayment();
                    } else if (value >= 4) {
                        this.clearPendingPayment();
                    }
                });
                if (this.step === 2 || this.step === 3) {
                    this.savePendingPayment();
                }
            },

            savePendingPayment() {
                try {
                    sessionStorage.removeItem('maternity_pending_dismissed');
                    localStorage.setItem('maternity_pending_payment', JSON.stringify({
                        eventSlug: '{{ $event->slug ?? 'mindful-motherhood' }}',
                        eventTitle: this.selectedTitle || '{{ $event->title ?? 'Pelatihan Maternitas' }}',
                        totalAmount: this.totalAmount,
                        step: this.step,
                        timestamp: Date.now()
                    }));
                } catch(e) {}
            },

            clearPendingPayment() {
                try {
                    localStorage.removeItem('maternity_pending_payment');
                } catch(e) {}
            },

            submitProof() {
                // Transisi ke Step 4 (Berhasil Mengupload Bukti Pembayaran)
                this.step = 4;
                this.clearPendingPayment();
            }
         }" 
         class="w-full min-h-[calc(100vh-120px)] bg-[#FBF5F2] text-neutral-800 p-2.5 sm:p-6 md:p-10 font-sans rounded-2xl sm:rounded-3xl border border-[#DEAAA1]/30 shadow-xs my-2 relative">
        
        <div class="max-w-6xl mx-auto space-y-4">

            {{-- Breadcrumb Back to Detail --}}
            <nav class="flex items-center gap-1.5 text-xs text-neutral-500">
                <a href="{{ route('events') }}" class="hover:text-[#8C433C] transition">Event & Kelas</a>
                <i class="fa-solid fa-chevron-right text-[9px]"></i>
                <a href="{{ route('events.show', $event->slug ?? '#') }}" class="hover:text-[#8C433C] transition line-clamp-1">{{ $event->title ?? 'Detail Event' }}</a>
                <i class="fa-solid fa-chevron-right text-[9px]"></i>
                <span class="text-neutral-700 font-semibold">Checkout</span>
            </nav>

        <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-12 items-start">
            
            {{-- ── 1. KOLOM KIRI: FAQ & TESTIMONIAL (DI MOBILE PINDAH KE BAWAH) ── --}}
            <div class="order-2 lg:order-1 lg:col-span-6 flex flex-col justify-between space-y-6 sm:space-y-10">
                <x-checkout.faq />
                <x-checkout.testimonial />
            </div>

            {{-- ── 2. KOLOM KANAN: STEPPER & KONTEN DINAMIS SESUAI STEP (DI MOBILE TAMPIL PERTAMA) ── --}}
            <div class="order-1 lg:order-2 lg:col-span-6 flex flex-col justify-start">
                
                {{-- Stepper Navigation Reusable --}}
                <x-checkout.stepper />

                {{-- ── STEP 1: DETAIL PEMESANAN & PILIH PAKET ── --}}
                <div x-show="step === 1" 
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 translate-y-2"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     class="space-y-6">
                    
                    {{-- Input Kode Promo --}}
                    <form @submit.prevent="applyPromo()" class="flex items-center gap-2">
                        @csrf
                        <div class="relative flex-1">
                            <input type="text" 
                                   x-model="promoCode"
                                   :disabled="promoApplied"
                                   placeholder="Masukkan Kode promo /refeal" 
                                   class="w-full bg-[#D3CECC] placeholder-neutral-700 text-neutral-900 text-sm rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#5F8C72] border-0 transition disabled:opacity-80">
                            
                            <button type="button" 
                                    x-show="promoApplied" 
                                    @click="removePromo()" 
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-xs text-neutral-500 hover:text-red-500 transition cursor-pointer">
                                Hapus
                            </button>
                        </div>

                        {{-- Tombol Terapkan: Bulat saat aktif, Kotak saat belum --}}
                        <template x-if="!promoApplied">
                            <button type="submit" 
                                    class="bg-[#DEAAA1] hover:bg-[#c99b92] text-white font-medium text-sm px-6 py-3 rounded-xl transition-all duration-200 shadow-xs shrink-0 cursor-pointer">
                                Terapkan
                            </button>
                        </template>

                        <template x-if="promoApplied">
                            <button type="button" 
                                    @click="removePromo()"
                                    title="Kode promo aktif! Klik untuk ubah"
                                    class="w-11 h-11 rounded-full bg-[#5F8C72] hover:bg-[#4f755e] text-white flex items-center justify-center transition-all duration-300 shadow-sm shrink-0 cursor-pointer">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                </svg>
                            </button>
                        </template>
                    </form>

                    {{-- Ringkasan Pesanan --}}
                    <div>
                        <h3 class="font-bold text-neutral-800 text-base mb-3" style="font-family: 'DM Serif Display', serif;">Detail Pemesanan</h3>
                        
                        <div class="bg-[#D3CECC] rounded-2xl p-5 space-y-3 shadow-2xs">
                            <div class="flex justify-between items-start">
                                <div>
                                    <span class="font-semibold text-neutral-900 text-sm block" x-text="selectedTitle">
                                        {{ $event->title ?? 'Pelatihan Yoga' }}
                                    </span>
                                    <div>
                                        <button type="button" 
                                                @click="tempSelected = selected; openModal = true" 
                                                class="inline-flex items-center text-xs text-[#5F8C72] hover:underline mt-0.5 font-medium cursor-pointer">
                                            Ganti Pelatihan 
                                            <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <span class="font-medium text-sm text-neutral-900 shrink-0 ml-4" x-text="selectedPrice">
                                    {{ $event->price ?? 'Rp60.000' }}
                                </span>
                            </div>

                            <div class="flex justify-between text-sm text-[#8C433C] font-semibold pt-1">
                                <span>Diskon Kode Promo</span>
                                <span x-text="promoApplied ? '-Rp6.000' : '-Rp0'">-Rp6.000</span>
                            </div>

                            <hr class="border-t border-neutral-400/80 my-2">

                            <div class="flex justify-between font-bold text-neutral-900 text-sm pt-1">
                                <span>Total</span>
                                <span x-text="totalAmount">
                                    Rp 54.000,00
                                </span>
                            </div>
                        </div>
                    </div>

                    <hr class="border-t border-[#DEAAA1]/60 my-1">

                    {{-- Tombol Lanjut ke Step 2 (Pembayaran) & Footer Keamanan --}}
                    <div class="space-y-3">
                        <button type="button" 
                                @click="step = 2"
                                class="w-full bg-[#5F8C72] hover:bg-[#4f755e] text-white font-semibold py-3.5 px-6 rounded-xl flex items-center justify-center gap-2 transition shadow-sm text-sm cursor-pointer">
                            <span>Lanjut ke Pembayaran</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>

                        <div class="flex items-center justify-center gap-1.5 text-[11px] text-neutral-600">
                            <svg class="w-3.5 h-3.5 text-neutral-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                            <span>Pembayaran Aman dan Terverifikasi</span>
                        </div>
                    </div>
                </div>

                {{-- ── STEP 2: PEMBAYARAN QRIS ── --}}
                <div x-show="step === 2" 
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 translate-y-2"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     class="flex flex-col items-center">
                    
                    {{-- Info QRIS --}}
                    <div class="text-center mb-4">
                        <div class="inline-flex items-center justify-center w-7 h-7 rounded-md bg-[#F0D5D0] text-[#DEAAA1] mb-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/>
                            </svg>
                        </div>
                        <h3 class="font-bold text-neutral-900 text-base" style="font-family: 'DM Serif Display', serif;">Pembayaran QRIS</h3>
                        <p class="text-xs text-neutral-500">Scan QRIS di bawah untuk menyelesaikan pembayaran</p>
                    </div>

                    {{-- Kartu QRIS --}}
                    <div class="w-full max-w-[270px] bg-white rounded-xl shadow-md border border-neutral-200 overflow-hidden relative p-4 mb-4">
                        {{-- Header Brand QRIS --}}
                        <div class="flex items-center justify-between pb-2 border-b border-neutral-100">
                            <span class="text-base font-black tracking-wider text-neutral-900">QRIS</span>
                            <span class="text-[9px] font-bold text-red-600">GPN</span>
                        </div>

                        {{-- Merchant Info --}}
                        <div class="text-center my-2">
                            <p class="text-xs font-extrabold text-neutral-800 uppercase tracking-wide">TUAN NYONYA</p>
                            <p class="text-[9px] text-neutral-400 font-mono">NMID: ID19360091130261059010</p>
                        </div>

                        {{-- QR Code Image --}}
                        <div class="relative flex justify-center items-center my-2">
                            <div class="absolute -left-4 top-1 w-2.5 h-16 bg-red-600 rounded-r-sm"></div>
                            <div class="absolute -right-4 bottom-1 w-2.5 h-12 bg-red-600 rounded-l-sm"></div>

                            <img src="{{ file_exists(public_path('images/qris.png')) ? asset('images/qris.png') : (file_exists(public_path('qris.png')) ? asset('qris.png') : 'https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=Maternity-Payment-Event') }}" 
                                 alt="Kode QRIS Maternity" 
                                 onerror="this.onerror=null; this.src='https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=Maternity-Payment-Event';"
                                 class="w-44 h-44 object-contain rounded-md">
                        </div>

                        <div class="text-center pt-2">
                            <p class="text-[9px] text-neutral-400 font-mono">Dicetak oleh: 936009110</p>
                        </div>
                    </div>

                    {{-- Total Pembayaran --}}
                    <div class="text-center space-y-0.5 mb-5">
                        <span class="text-xs text-neutral-500 font-medium">Total Pembayaran</span>
                        <p class="text-lg font-bold text-[#DEAAA1]" x-text="totalAmount">Rp 54.000,00</p>
                    </div>

                    {{-- Tombol Konfirmasi & Kembali --}}
                    <div class="w-full max-w-[270px] space-y-2">
                        <button type="button" 
                                @click="step = 3"
                                class="w-full block text-center bg-[#5F8C72] hover:bg-[#4f755e] text-white font-semibold py-3 px-4 rounded-xl text-xs transition shadow-sm cursor-pointer">
                            Lanjut untuk konfirmasi
                        </button>
                        <button type="button" 
                                @click="step = 1"
                                class="w-full block text-center text-xs text-neutral-500 hover:text-neutral-800 py-1 transition cursor-pointer">
                            ← Kembali ke detail paket
                        </button>
                        <a href="{{ route('home') }}" 
                           class="w-full block text-center text-xs text-[#8C433C] hover:text-[#6e302a] hover:underline py-1 transition font-medium cursor-pointer">
                            ← Kembali ke Beranda
                        </a>
                    </div>
                </div>

                {{-- ── STEP 3: FORM KONFIRMASI & UPLOAD BUKTI PEMBAYARAN ── --}}
                <div x-show="step === 3" 
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 translate-y-2"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     class="space-y-6">
                    
                    <form action="#" method="POST" enctype="multipart/form-data" @submit.prevent="submitProof()" class="space-y-6">
                        @csrf

                        {{-- Bagian Upload Bukti Pembayaran --}}
                        <div>
                            <h3 class="font-bold text-center text-neutral-800 text-sm mb-3">Upload Bukti Pembayaran</h3>
                            
                            <label class="flex flex-col items-center justify-center border border-dashed border-[#DEAAA1] rounded-2xl bg-[#F8ECE8] hover:bg-[#f3e1dc] cursor-pointer py-6 px-4 transition text-center">
                                <input type="file" 
                                       name="payment_proof" 
                                       accept="image/png, image/jpeg" 
                                       class="hidden" 
                                       @change="proofSelected = true; proofName = $event.target.files[0]?.name || ''">
                                
                                <div class="text-[#B96A5C] mb-2">
                                    <svg class="w-7 h-7 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                    </svg>
                                </div>
                                <span class="text-xs font-semibold text-neutral-800" x-text="proofSelected ? 'File Terpilih: ' + proofName : 'Upload bukti pembayaran disini'">
                                    Upload bukti pembayaran disini
                                </span>
                                <span class="text-[10px] text-neutral-500 mt-0.5">Format JPG/PNG Maksimal 5 MB</span>
                            </label>
                        </div>

                        {{-- Bagian Form Lengkapi Data Diri --}}
                        <div class="bg-[#E7EAE4] border border-[#D5DDD1] rounded-2xl p-6 space-y-4">
                            <h4 class="font-bold text-neutral-800 text-sm">Lengkapi data diri</h4>

                            {{-- Nama Lengkap --}}
                            <div>
                                <label class="block text-xs font-medium text-neutral-700 mb-1">Nama Lengkap</label>
                                <input type="text" name="name" value="{{ Auth::user()->name ?? 'Sandi' }}" 
                                       class="w-full bg-[#D8DCD5] border border-neutral-300 text-neutral-800 text-xs rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#5F8C72]">
                            </div>

                            {{-- No. WhatsApp --}}
                            <div>
                                <label class="block text-xs font-medium text-neutral-700 mb-1">No. WhatsApp</label>
                                <input type="tel" name="whatsapp" value="089570429XXXX" 
                                       class="w-full bg-[#D8DCD5] border border-neutral-300 text-neutral-800 text-xs rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#5F8C72]">
                            </div>

                            {{-- Tanggal Lahir --}}
                            <div>
                                <label class="block text-xs font-medium text-neutral-700 mb-1">Tanggal Lahir</label>
                                <div class="relative">
                                    <input type="text" name="birth_date" placeholder="DD/MM/YY" 
                                           onfocus="(this.type='date')" onblur="(this.type='text')"
                                           class="w-full bg-[#D8DCD5] border border-neutral-300 text-neutral-800 text-xs rounded-xl px-4 py-2.5 pr-10 placeholder-neutral-500 focus:outline-none focus:ring-2 focus:ring-[#5F8C72]">
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-neutral-600">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Tombol Kirim & Kembali --}}
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <button type="button" 
                                        @click="step = 2" 
                                        class="text-xs text-neutral-500 hover:text-neutral-800 transition cursor-pointer">
                                    ← Kembali ke QRIS
                                </button>
                                <a href="{{ route('home') }}" 
                                   class="text-xs text-[#8C433C] hover:text-[#6e302a] hover:underline transition font-medium">
                                    Kembali ke Beranda
                                </a>
                            </div>
                            <button type="submit" 
                                    class="bg-[#5F8C72] hover:bg-[#4d725d] text-white font-semibold text-xs px-8 py-2.5 rounded-xl shadow-xs transition cursor-pointer">
                                Kirim
                            </button>
                        </div>
                    </form>
                </div>

                {{-- ── STEP 4: KARTU SUKSES UPLOAD BUKTI PEMBAYARAN ── --}}
                <div x-show="step === 4" 
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     class="w-full flex flex-col items-center">
                    
                    {{-- Success Card --}}
                    <div class="w-full max-w-md bg-[#FAF0EC] rounded-3xl p-8 sm:p-10 shadow-sm border border-[#EADBDB]/60 text-center flex flex-col items-center">
                        
                        {{-- Ilustrasi Sukses Bersih & Rapi --}}
                        <div class="relative w-24 h-24 flex items-center justify-center mb-5 mx-auto">
                            <div class="w-20 h-20 rounded-2xl bg-[#FCEBE7] border border-[#DEAAA1] flex items-center justify-center shadow-xs">
                                <svg class="w-10 h-10 text-[#C97A70]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                </svg>
                            </div>
                            <div class="absolute bottom-0 right-0 w-8 h-8 rounded-full bg-[#5F8C72] text-white flex items-center justify-center border-2 border-[#FAF0EC] shadow-sm">
                                <svg class="w-4 h-4 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                        </div>

                        {{-- Judul Status --}}
                        <h3 class="text-lg sm:text-xl font-extrabold text-neutral-900 leading-tight mb-3" style="font-family: 'DM Serif Display', serif;">
                            Berhasil Mengupload<br>Bukti Pembayaran!
                        </h3>

                        {{-- Deskripsi Status --}}
                        <p class="text-xs text-neutral-600 leading-relaxed max-w-xs mb-6">
                            Terima kasih telah melakukan pendaftaran. Bukti pembayaran Anda sudah kami terima dan akan diverifikasi oleh admin.
                        </p>

                        <div class="w-full space-y-2">
                            {{-- Tombol Cek Status Verifikasi --}}
                            <button type="button" 
                                    @click="step = 5" 
                                    class="w-full py-3 px-6 rounded-2xl bg-[#5F8C72] hover:bg-[#4e745d] text-white font-semibold text-xs tracking-wide transition shadow-sm text-center cursor-pointer">
                                Cek Status Verifikasi
                            </button>

                            {{-- Tombol Kembali --}}
                            <a href="{{ url('/') }}" 
                               class="w-full block py-2.5 px-6 rounded-2xl text-neutral-600 hover:text-neutral-900 font-medium text-xs tracking-wide transition text-center">
                                Kembali ke Beranda
                            </a>
                        </div>

                    </div>
                </div>

                {{-- ── STEP 5: SEDANG DIVERIFIKASI (STATUS VERIFIKASI) ── --}}
                <div x-show="step === 5" 
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     class="w-full flex flex-col items-center">
                    
                    {{-- Verification Card --}}
                    <div class="w-full max-w-md bg-[#FDF1ED] rounded-3xl p-8 sm:p-10 shadow-sm border border-[#EADBDB]/60 text-center flex flex-col items-center">
                        
                        {{-- Ilustrasi Jam & Badge Centang Hijau di Pojok Kanan Bawah --}}
                        <div class="relative w-24 h-24 flex items-center justify-center mb-5 mx-auto">
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
                        <div class="space-y-2 text-xs text-neutral-600 leading-relaxed max-w-xs mb-6">
                            <p>
                                Bukti pembayaran Anda telah kami terima dan sedang dalam proses verifikasi oleh admin.
                            </p>
                            <p>
                                Kami akan menghubungi Anda melalui email jika sudah ada pembaruan.
                            </p>
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="w-full space-y-2">
                            <button type="button"
                                    @click="step = 6"
                                    class="w-full py-3 px-6 rounded-2xl bg-[#5F8C72] hover:bg-[#4e745d] text-white font-medium text-xs tracking-wide transition shadow-sm text-center cursor-pointer">
                                Simulasi: Verifikasi Disetujui Admin
                            </button>
                            <a href="{{ url('/') }}" 
                               class="w-full block py-2.5 px-6 rounded-2xl text-neutral-600 hover:text-neutral-900 font-medium text-xs tracking-wide transition text-center">
                                Kembali ke Beranda
                            </a>
                        </div>

                    </div>
                </div>

                {{-- ── STEP 6: PENDAFTARAN DITERIMA (VERIFIKASI DISETUJUI ADMIN) ── --}}
                <div x-show="step === 6" 
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     class="w-full flex flex-col items-center">
                    
                    {{-- Confirmation Card --}}
                    <div class="w-full max-w-md bg-[#FAF0EC] rounded-3xl p-8 sm:p-10 shadow-sm border border-[#EADBDB]/60 text-center flex flex-col items-center">
                        
                        {{-- Ilustrasi Amplop Surat & Centang Diterima Bersih --}}
                        <div class="relative w-24 h-24 flex items-center justify-center mb-5 mx-auto">
                            <div class="w-20 h-20 rounded-2xl bg-[#EDF5F0] border border-[#9DB89D] flex items-center justify-center shadow-xs">
                                <svg class="w-10 h-10 text-[#5F8C72]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div class="absolute bottom-0 right-0 w-8 h-8 rounded-full bg-[#5F8C72] text-white flex items-center justify-center border-2 border-[#FAF0EC] shadow-sm">
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

        {{-- MODAL PILIH / GANTI PELATIHAN --}}
        <x-checkout.modal-training />

    </div>

    {{-- Floating Help Button (Kanan Bawah) --}}
    <x-floating_help />

</x-layout>
