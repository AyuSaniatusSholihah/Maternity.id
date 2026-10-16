{{-- Component: Pending Payment Banner & Cancellation Modal --}}
<div x-data="pendingPaymentBanner()" 
     x-init="init()"
     class="w-full flex justify-center">

    {{-- ── 1. TOAST NOTIFIKASI SUKSES PEMBATALAN ── --}}
    <div x-show="showSuccessToast" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 -translate-y-3 scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
         x-transition:leave-end="opacity-0 -translate-y-3 scale-95"
         class="fixed top-20 sm:top-24 right-4 sm:right-8 z-50 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-2xl p-4 shadow-xl flex items-center justify-between gap-3 max-w-md w-full"
         style="display: none;">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0">
                <i class="fa-solid fa-circle-check text-base"></i>
            </div>
            <div>
                <p class="text-xs font-bold text-emerald-900">Pendaftaran Dibatalkan</p>
                <p class="text-xs text-emerald-700" x-text="cancelSuccessMessage"></p>
            </div>
        </div>
        <button type="button" 
                @click="showSuccessToast = false" 
                class="text-emerald-500 hover:text-emerald-700 p-1 text-sm transition cursor-pointer">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>

    {{-- ── 2. FLOATING COMPACT PENDING PAYMENT CARD (Ramping, fit di HP, tidak boros layar) ── --}}
    <div x-show="hasPending && !isDismissed" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 -translate-y-3 scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
         x-transition:leave-end="opacity-0 -translate-y-3 scale-95"
         class="w-full sm:w-fit max-w-[96vw] lg:max-w-4xl bg-white/95 backdrop-blur-md border border-[#DEAAA1]/80 rounded-xl sm:rounded-3xl p-2 sm:px-5 sm:py-3 shadow-md shadow-[#8C433C]/8 relative overflow-hidden transition-all"
         style="display: none;">
        
        <div class="flex items-center justify-between gap-2 sm:gap-6">
            
            {{-- Bagian Kiri: Ikon & Detail Teks Ringkas --}}
            <div class="flex items-center gap-2 sm:gap-3.5 min-w-0 flex-1">
                {{-- Ikon Waktu --}}
                <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-lg sm:rounded-2xl bg-[#F8DED9]/70 border border-[#DEAAA1]/60 text-[#8C433C] flex items-center justify-center shrink-0">
                    <i class="fa-solid fa-clock-rotate-left text-xs sm:text-base"></i>
                </div>

                {{-- Teks Ringkas & To The Point --}}
                <div class="min-w-0 space-y-0.5 text-left">
                    {{-- Badge Status (Desktop Only) --}}
                    <div class="hidden sm:flex items-center gap-1.5">
                        <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-[10px] font-bold bg-[#F8DED9] text-[#8C433C] uppercase tracking-wider">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#8C433C] animate-ping"></span>
                            Menunggu Pembayaran
                        </span>
                    </div>

                    {{-- Nama Event & Harga Fit Sesuaikan Tulisan --}}
                    <div class="flex items-center gap-1.5 flex-wrap sm:flex-nowrap">
                        <span class="text-xs sm:text-sm font-bold text-neutral-800 leading-tight truncate max-w-[150px] min-[380px]:max-w-[210px] sm:max-w-none" x-text="pendingPayment?.eventTitle || 'Prenatal Yoga for Calm & Strength'"></span>
                        <span class="text-[10px] sm:text-xs font-semibold px-1.5 py-0.5 rounded bg-[#FAF0EE] text-[#8C433C] border border-[#DEAAA1]/40 shrink-0" x-text="pendingPayment?.totalAmount || 'Rp 75.000,00'"></span>
                    </div>

                    {{-- Subteks 1 Kalimat Padat (Desktop Only) --}}
                    <p class="hidden sm:block text-[11px] text-neutral-500 leading-tight">
                        Pendaftaran tersimpan. Selesaikan pembayaran untuk mengamankan kuota peserta.
                    </p>
                </div>
            </div>

            {{-- Bagian Kanan: Tombol Aksi & Tombol Close --}}
            <div class="flex items-center gap-1.5 sm:gap-2 shrink-0">
                {{-- Tombol Batalkan --}}
                <button type="button" 
                        @click="openCancelModal()"
                        class="px-2.5 sm:px-3.5 py-1 sm:py-1.5 rounded-full bg-white hover:bg-red-50 text-[#8C433C] border border-[#DEAAA1] hover:border-red-300 font-semibold text-[11px] sm:text-xs transition shadow-2xs cursor-pointer">
                    Batalkan
                </button>

                {{-- Tombol Lanjutkan Pembayaran --}}
                <a :href="'/events/' + (pendingPayment?.eventSlug || 'mindful-motherhood') + '/checkout?step=' + (pendingPayment?.step === 3 ? '3' : '2')"
                   class="inline-flex items-center gap-1 px-3 sm:px-4 py-1 sm:py-1.5 rounded-full bg-[#5F8C72] hover:bg-[#4e745d] active:scale-95 text-white font-semibold text-[11px] sm:text-xs shadow-sm transition cursor-pointer">
                    <span class="hidden sm:inline">Lanjutkan Pembayaran</span>
                    <span class="inline sm:hidden">Bayar</span>
                    <i class="fa-solid fa-arrow-right text-[9px] sm:text-[10px]"></i>
                </a>

                {{-- Tombol Close/Dismiss agar bisa ditutup user --}}
                <button type="button" 
                        @click="dismissBanner()" 
                        class="w-6 h-6 sm:w-7 sm:h-7 rounded-full flex items-center justify-center text-neutral-400 hover:text-neutral-700 hover:bg-neutral-100 transition cursor-pointer shrink-0 ml-0.5"
                        title="Tutup pemberitahuan"
                        aria-label="Tutup">
                    <i class="fa-solid fa-xmark text-xs sm:text-sm"></i>
                </button>
            </div>

        </div>
    </div>

    {{-- ── 3. MODAL ALASAN PEMBATALAN JOIN EVENT ── --}}
    <div x-show="showCancelModal" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 flex items-center justify-center p-3 sm:p-4 bg-black/60 backdrop-blur-xs"
         @keydown.escape.window="closeCancelModal()"
         style="display: none;">
        
        {{-- Card Modal --}}
        <div @click.away="closeCancelModal()"
             x-show="showCancelModal"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95 translate-y-3"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100 translate-y-0"
             x-transition:leave-end="opacity-0 scale-95 translate-y-3"
             class="bg-white rounded-2xl sm:rounded-3xl max-w-lg w-full p-5 sm:p-7 shadow-2xl border border-neutral-100 relative overflow-hidden max-h-[90vh] overflow-y-auto">
            
            {{-- Aksen Garis Modal --}}
            <div class="absolute top-0 inset-x-0 h-1.5 bg-gradient-to-r from-red-400 via-[#DEAAA1] to-[#8C433C]"></div>

            {{-- Header Modal --}}
            <div class="flex items-start justify-between gap-3 mb-5">
                <div class="flex items-center gap-3">
                    <div class="w-11 h-11 rounded-2xl bg-red-50 text-red-600 flex items-center justify-center shrink-0 border border-red-100">
                        <i class="fa-solid fa-triangle-exclamation text-lg"></i>
                    </div>
                    <div>
                        <h3 class="text-base sm:text-lg font-bold text-neutral-900 tracking-tight" style="font-family: 'DM Serif Display', serif;">
                            Batalkan Pendaftaran Event
                        </h3>
                        <p class="text-xs text-neutral-500">
                            Event: <span class="font-semibold text-neutral-800" x-text="pendingPayment?.eventTitle || 'Pelatihan Maternitas'"></span>
                        </p>
                    </div>
                </div>
                <button type="button" 
                        @click="closeCancelModal()" 
                        class="text-neutral-400 hover:text-neutral-700 p-1 rounded-lg transition">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>

            {{-- Pesan Pengantar --}}
            <p class="text-xs text-neutral-600 mb-4 leading-relaxed">
                Apakah Anda yakin ingin membatalkan pendaftaran event ini? Mohon pilih alasan pembatalan Anda agar kami dapat terus meningkatkan layanan Maternity.id:
            </p>

            {{-- Error Message if No Reason Selected --}}
            <div x-show="errorMessage" 
                 x-transition
                 class="mb-3.5 bg-red-50 border border-red-200 text-red-700 text-xs px-3 py-2 rounded-xl flex items-center gap-2">
                <i class="fa-solid fa-circle-exclamation shrink-0 text-red-500"></i>
                <span x-text="errorMessage"></span>
            </div>

            {{-- Daftar Pilihan Alasan Batal --}}
            <div class="space-y-2 mb-4">
                <template x-for="(reason, index) in reasons" :key="index">
                    <label class="flex items-center gap-3 p-3 rounded-xl border transition cursor-pointer text-xs select-none"
                           :class="cancelReason === reason ? 'bg-[#FAF0EE] border-[#DEAAA1] text-[#8C433C] font-semibold' : 'bg-[#FAF5F2]/50 border-neutral-200/80 text-neutral-700 hover:bg-[#FAF5F2]'">
                        <input type="radio" 
                               name="cancel_reason" 
                               :value="reason" 
                               x-model="cancelReason" 
                               @change="errorMessage = ''"
                               class="w-4 h-4 text-[#8C433C] focus:ring-[#8C433C] border-neutral-300">
                        <span x-text="reason"></span>
                    </label>
                </template>
            </div>

            {{-- Textarea Alasan Tambahan / Khusus Jika "Lainnya" Dipilih --}}
            <div x-show="cancelReason === 'Alasan lainnya'" 
                 x-transition
                 class="mb-5">
                <label class="block text-xs font-semibold text-neutral-700 mb-1.5">
                    Tuliskan alasan Anda (opsional):
                </label>
                <textarea x-model="customReason" 
                          rows="3" 
                          placeholder="Ceritakan kendala atau alasan Anda membatalkan..." 
                          class="w-full bg-[#FAF5F2] border border-neutral-300 rounded-xl p-3 text-xs text-neutral-800 placeholder-neutral-400 focus:outline-none focus:ring-2 focus:ring-[#DEAAA1] focus:bg-white transition resize-none"></textarea>
            </div>

            {{-- Footer Tombol Konfirmasi --}}
            <div class="flex items-center justify-end gap-2.5 pt-3 border-t border-neutral-100">
                <button type="button" 
                        @click="closeCancelModal()" 
                        class="px-4 py-2.5 rounded-xl border border-neutral-300 text-neutral-600 hover:bg-neutral-100 font-semibold text-xs transition cursor-pointer">
                    Kembali
                </button>
                <button type="button" 
                        @click="confirmCancellation()" 
                        class="px-5 py-2.5 rounded-xl bg-red-600 hover:bg-red-700 text-white font-semibold text-xs shadow-sm transition cursor-pointer flex items-center gap-2">
                    <i class="fa-solid fa-trash-can text-xs"></i>
                    <span>Ya, Batalkan Pendaftaran</span>
                </button>
            </div>

        </div>
    </div>
</div>

<script>
    function pendingPaymentBanner() {
        return {
            pendingPayment: null,
            hasPending: false,
            isDismissed: false,
            showCancelModal: false,
            cancelReason: '',
            customReason: '',
            errorMessage: '',
            showSuccessToast: false,
            cancelSuccessMessage: '',

            reasons: [
                'Ingin mengganti jadwal atau tanggal event lain',
                'Ingin memilih paket pelatihan atau kelas yang berbeda',
                'Metode pembayaran yang diinginkan tidak tersedia',
                'Kendala koneksi atau teknis saat proses checkout',
                'Kendala biaya / perubahan rencana pribadi',
                'Alasan lainnya'
            ],

            init() {
                // Dukungan preview instan via query parameter ?test_pending=1
                const urlParams = new URLSearchParams(window.location.search);
                if (urlParams.get('test_pending') === '1') {
                    sessionStorage.removeItem('maternity_pending_dismissed');
                    if (!localStorage.getItem('maternity_pending_payment')) {
                        localStorage.setItem('maternity_pending_payment', JSON.stringify({
                            eventSlug: 'mindful-motherhood',
                            eventTitle: 'Prenatal Yoga for Calm & Strength',
                            totalAmount: 'Rp 75.000,00',
                            step: 2,
                            timestamp: Date.now()
                        }));
                    }
                }

                if (sessionStorage.getItem('maternity_pending_dismissed') === '1') {
                    this.isDismissed = true;
                }

                this.checkPending();
                window.addEventListener('storage', () => this.checkPending());
            },

            checkPending() {
                try {
                    const raw = localStorage.getItem('maternity_pending_payment');
                    if (raw) {
                        this.pendingPayment = JSON.parse(raw);
                        this.hasPending = true;
                    } else {
                        this.pendingPayment = null;
                        this.hasPending = false;
                    }
                } catch (e) {
                    this.hasPending = false;
                }
            },

            dismissBanner() {
                this.isDismissed = true;
                try {
                    sessionStorage.setItem('maternity_pending_dismissed', '1');
                } catch(e) {}
            },

            openCancelModal() {
                this.cancelReason = '';
                this.customReason = '';
                this.errorMessage = '';
                this.showCancelModal = true;
            },

            closeCancelModal() {
                this.showCancelModal = false;
                this.errorMessage = '';
            },

            confirmCancellation() {
                if (!this.cancelReason) {
                    this.errorMessage = 'Silakan pilih salah satu alasan pembatalan pendaftaran.';
                    return;
                }

                const finalReason = this.cancelReason === 'Alasan lainnya' && this.customReason.trim()
                    ? this.customReason.trim()
                    : this.cancelReason;

                // Catat log pembatalan ke localStorage untuk referensi
                try {
                    const history = JSON.parse(localStorage.getItem('maternity_cancelled_events') || '[]');
                    history.push({
                        eventSlug: this.pendingPayment?.eventSlug,
                        eventTitle: this.pendingPayment?.eventTitle,
                        totalAmount: this.pendingPayment?.totalAmount,
                        reason: finalReason,
                        cancelledAt: new Date().toISOString()
                    });
                    localStorage.setItem('maternity_cancelled_events', JSON.stringify(history));
                } catch (e) {}

                const eventTitle = this.pendingPayment?.eventTitle || 'Pelatihan Maternitas';

                // Hapus status pending payment dari localStorage
                localStorage.removeItem('maternity_pending_payment');
                this.hasPending = false;
                this.showCancelModal = false;

                // Tampilkan pesan sukses pembatalan
                this.cancelSuccessMessage = `Pendaftaran "${eventTitle}" berhasil dibatalkan.`;
                this.showSuccessToast = true;

                setTimeout(() => {
                    this.showSuccessToast = false;
                }, 5000);
            }
        };
    }
</script>
