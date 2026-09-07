{{-- Reusable Testimonial Carousel Component --}}
<div class="flex items-center gap-4 pt-2" x-data="{
    active: 0,
    reviews: [
        {
            name: 'Dinda Permata',
            role: 'Peserta Seminar Gizi • 1 bulan lalu',
            avatar: 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=100&h=100&fit=crop',
            text: 'Seminar gizinya beneran membuka wawasan. Materinya praktis, bukan teori doang. Langsung bisa diterapkan untuk pola makan sehari-hari. Daftar via WA juga gampang, adminnya responsif dan ramah.'
        },
        {
            name: 'Siti Rahmawati',
            role: 'Peserta Prenatal Yoga • 1 bulan lalu',
            avatar: 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=100&h=100&fit=crop',
            text: 'Instruktur yoganya sangat sabar dan telaten memandu gerakan pernapasan. Pinggang yang pegal selama hamil trimester 3 jadi jauh lebih nyaman setelah ikut kelas.'
        }
    ],
    next() { this.active = (this.active + 1) % this.reviews.length; },
    prev() { this.active = (this.active - 1 + this.reviews.length) % this.reviews.length; }
}">
    <button @click="prev()" type="button" class="text-[#5F8C72] hover:opacity-75 transition p-1" title="Sebelumnya">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
        </svg>
    </button>

    <div class="relative w-full max-w-sm">
        {{-- Shadow Accent Card --}}
        <div class="absolute inset-0 bg-[#DEAAA1] rounded-2xl transform -rotate-3 scale-95 translate-y-1"></div>
        
        {{-- Konten Testimoni --}}
        <div class="relative bg-white border border-[#DEAAA1] rounded-2xl p-4 shadow-xs min-h-[140px] flex flex-col justify-between">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <img :src="reviews[active].avatar" 
                         alt="Avatar" class="w-10 h-10 rounded-full object-cover border border-[#DEAAA1]">
                    <div>
                        <h4 class="text-xs font-bold leading-tight text-neutral-900" x-text="reviews[active].name">Dinda Permata</h4>
                        <p class="text-[10px] text-neutral-500" x-text="reviews[active].role">Peserta Seminar Gizi • 1 bulan lalu</p>
                    </div>
                </div>
                <div class="flex text-amber-400 text-xs mb-2">★★★★★</div>
                <p class="text-[11px] text-neutral-700 leading-snug" x-text="reviews[active].text">
                    Seminar gizinya beneran membuka wawasan. Materinya praktis, bukan teori doang. Langsung bisa diterapkan untuk pola makan sehari-hari. Daftar via WA juga gampang, adminnya responsif dan ramah.
                </p>
            </div>
        </div>
    </div>

    <button @click="next()" type="button" class="text-[#5F8C72] hover:opacity-75 transition p-1" title="Selanjutnya">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
        </svg>
    </button>
</div>
