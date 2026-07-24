<x-layout title="Empowering Women's Health">
    <x-slot name="head">
        <!-- Google Fonts & FontAwesome -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@600&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <style>
            .font-handwriting {
                font-family: 'Caveat', cursive;
            }
            /* Custom Clip Path untuk efek gambar miring */
            .clip-slant-left-top {
                clip-path: polygon(0 0, 100% 0, 80% 100%, 0 100%);
            }
            .clip-slant-left-bottom {
                clip-path: polygon(0 0, 80% 0, 100% 100%, 0 100%);
            }
            .clip-slant-right-top {
                clip-path: polygon(20% 0, 100% 0, 100% 100%, 0 100%);
            }
            .clip-slant-right-bottom {
                clip-path: polygon(0 0, 100% 0, 100% 100%, 20% 100%);
            }
        </style>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
        <!-- HERO SECTION -->
        <div class="relative flex items-start justify-center min-h-[560px] lg:min-h-[620px] pt-10 sm:pt-14 pb-16 sm:pb-20">

            <!-- GAMBAR DEKORASI - KIRI -->
            <div class="hidden lg:flex flex-col justify-start gap-8 xl:gap-10 absolute left-0 top-2 bottom-0 w-60 xl:w-72 pointer-events-none z-0">
                <!-- Foto Kiri Atas (Yoga) -->
                <div class="w-full h-52 xl:h-60 rounded-2xl overflow-hidden shadow-lg opacity-90 hover:opacity-100 transition clip-slant-left-top bg-[#FAF0EE]/60 p-0.5">
                    <img src="https://images.unsplash.com/photo-1545205597-3d9d02c29597?auto=format&fit=crop&q=80&w=600" 
                         alt="Yoga Class" class="w-full h-full object-cover rounded-xl">
                </div>
                <!-- Foto Kiri Bawah (Ibu dan Bayi) -->
                <div class="w-full h-52 xl:h-60 rounded-2xl overflow-hidden shadow-lg opacity-90 hover:opacity-100 transition clip-slant-left-bottom bg-[#FAF0EE]/60 p-0.5">
                    <img src="https://images.unsplash.com/photo-1555252333-9f8e92e65df9?auto=format&fit=crop&q=80&w=600" 
                         alt="Mother and Baby" class="w-full h-full object-cover rounded-xl">
                </div>
            </div>

            <!-- GAMBAR DEKORASI - KANAN -->
            <div class="hidden lg:flex flex-col justify-start gap-8 xl:gap-10 absolute right-0 top-2 bottom-0 w-60 xl:w-72 pointer-events-none z-0">
                <!-- Foto Kanan Atas (Prenatal Exercise / Health) -->
                <div class="w-full h-52 xl:h-60 rounded-2xl overflow-hidden shadow-lg opacity-90 hover:opacity-100 transition clip-slant-right-top bg-[#FAF0EE]/60 p-0.5">
                    <img src="https://images.unsplash.com/photo-1518611012118-696072aa579a?auto=format&fit=crop&q=80&w=600" 
                         alt="Prenatal Wellness" class="w-full h-full object-cover rounded-xl">
                </div>
                <!-- Foto Kanan Bawah (Seminar Event / Workshop) -->
                <div class="w-full h-52 xl:h-60 rounded-2xl overflow-hidden shadow-lg opacity-90 hover:opacity-100 transition clip-slant-right-bottom bg-[#FAF0EE]/60 p-0.5">
                    <img src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?auto=format&fit=crop&q=80&w=600" 
                         alt="Seminar Event" class="w-full h-full object-cover rounded-xl">
                </div>
            </div>

            <!-- CONTENT UTAMA -->
            <div class="max-w-2xl text-center z-10 px-4">
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black text-[#331E1E] tracking-tight leading-tight mb-2">
                    Empowering Women's
                </h1>
                <p class="font-handwriting text-4xl sm:text-5xl lg:text-6xl text-[#5F8A6E] font-bold mb-8">
                    Health Awareness
                </p>

                <p class="text-gray-600 text-sm sm:text-base leading-loose mb-10 max-w-xl mx-auto font-medium">
                    Temukan seminar, pelatihan, konsultasi, dan e-book terpercaya untuk mendampingi perjalanan Anda,<br class="hidden sm:block">
                    mulai dari persiapan kehamilan hingga tumbuh kembang buah hati.
                </p>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mt-2">
                    <a href="{{ url('/library') }}" class="w-full sm:w-auto bg-[#C47366] hover:bg-[#b06357] text-white font-semibold px-8 py-3.5 rounded-2xl shadow-md transition text-base">
                        Akses Ebook
                    </a>
                    <a href="{{ url('/seminars') }}" class="w-full sm:w-auto bg-[#E6D9D0] hover:bg-[#dbcbc0] text-[#331E1E] font-semibold px-8 py-3.5 rounded-2xl shadow-sm transition text-base">
                        Akses Seminar
                    </a>
                </div>
            </div>

        </div>
    </div>

    <!-- FLOATING WHATSAPP / AJUKAN EVENT BUTTON -->
    <div class="fixed bottom-6 right-6 z-50">
        <a href="https://wa.me/" target="_blank" class="bg-[#5F8A6E] hover:bg-[#4f755d] text-white px-4 py-2.5 rounded-full flex items-center space-x-2 shadow-lg transition transform hover:scale-105 border-2 border-white">
            <div class="bg-white/20 p-1.5 rounded-full flex items-center justify-center">
                <i class="fa-brands fa-whatsapp text-lg"></i>
            </div>
            <span class="text-sm font-semibold pr-1">Ajukan Event &gt;</span>
        </a>
    </div>
</x-layout>