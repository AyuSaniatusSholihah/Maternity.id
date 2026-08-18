<x-layout title="Empowering Women's Health">
    <x-slot name="head">
        <!-- Google Fonts & FontAwesome -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link
            href="https://fonts.googleapis.com/css2?family=Caveat:wght@600&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
            rel="stylesheet">
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
        <div
            class="relative flex items-start justify-center min-h-[560px] lg:min-h-[620px] pt-10 sm:pt-14 pb-16 sm:pb-20">

            <!-- GAMBAR DEKORASI - KIRI -->
            <div
                class="hidden lg:flex flex-col justify-start gap-8 xl:gap-10 absolute left-0 top-2 bottom-0 w-60 xl:w-72 pointer-events-none z-0">
                <!-- Foto Kiri Atas (Yoga) -->
                <div
                    class="w-full h-52 xl:h-60 rounded-2xl overflow-hidden shadow-lg opacity-90 hover:opacity-100 transition clip-slant-left-top bg-[#FAF0EE]/60 p-0.5">
                    <img src="https://images.unsplash.com/photo-1545205597-3d9d02c29597?auto=format&fit=crop&q=80&w=600"
                        alt="Yoga Class" class="w-full h-full object-cover rounded-xl">
                </div>
                <!-- Foto Kiri Bawah (Ibu dan Bayi) -->
                <div
                    class="w-full h-52 xl:h-60 rounded-2xl overflow-hidden shadow-lg opacity-90 hover:opacity-100 transition clip-slant-left-bottom bg-[#FAF0EE]/60 p-0.5">
                    <img src="https://images.unsplash.com/photo-1555252333-9f8e92e65df9?auto=format&fit=crop&q=80&w=600"
                        alt="Mother and Baby" class="w-full h-full object-cover rounded-xl">
                </div>
            </div>

            <!-- GAMBAR DEKORASI - KANAN -->
            <div
                class="hidden lg:flex flex-col justify-start gap-8 xl:gap-10 absolute right-0 top-2 bottom-0 w-60 xl:w-72 pointer-events-none z-0">
                <!-- Foto Kanan Atas (Prenatal Exercise / Health) -->
                <div
                    class="w-full h-52 xl:h-60 rounded-2xl overflow-hidden shadow-lg opacity-90 hover:opacity-100 transition clip-slant-right-bottom bg-[#FAF0EE]/60 p-0.5">
                    <img src="https://images.unsplash.com/photo-1518611012118-696072aa579a?auto=format&fit=crop&q=80&w=600"
                        alt="Prenatal Wellness" class="w-full h-full object-cover rounded-xl">
                </div>
                <!-- Foto Kanan Bawah (Seminar Event / Workshop) -->
                <div
                    class="w-full h-52 xl:h-60 rounded-2xl overflow-hidden shadow-lg opacity-90 hover:opacity-100 transition clip-slant-right-top bg-[#FAF0EE]/60 p-0.5">
                    <img src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?auto=format&fit=crop&q=80&w=600"
                        alt="Seminar Event" class="w-full h-full object-cover rounded-xl">
                </div>
            </div>

            <!-- CONTENT UTAMA -->
            <div class="max-w-2xl text-center z-10 px-4">
                <h1
                    class="text-4xl sm:text-5xl lg:text-6xl font-semibold text-[#3D2B2B] tracking-tight leading-tight mb-2"
                    style="font-family: 'Lexend', sans-serif;">
                    Empowering Women's
                </h1>
                <p class="font-handwriting text-4xl sm:text-5xl lg:text-6xl text-[#5F8A6E] font-bold mb-8">
                    Health Awareness
                </p>

                <p class="text-gray-600 text-sm sm:text-base leading-loose mb-10 max-w-xl mx-auto font-medium" style="font-family: 'Lexend', sans-serif;">
                    Temukan seminar, pelatihan, konsultasi, dan e-book terpercaya untuk mendampingi perjalanan Anda, mulai dari persiapan<br
                        class="hidden sm:block">
                    kehamilan hingga tumbuh kembang buah hati.
                </p>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row items-center justify-center gap-5 mt-4">
                    <!-- Akses Ebook Button -->
                    <a href="{{ url('/library') }}"
                        class="w-full sm:w-auto bg-transparent hover:bg-[#C27A6F] border-2 border-[#C27A6F] text-[#C27A6F] hover:text-white font-bold px-10 py-3.5 rounded-2xl shadow-sm hover:shadow-md transition-all duration-200 text-base text-center transform hover:scale-[1.02]">
                        Akses Ebook
                    </a>
                    
                    <!-- Akses Seminar Button -->
                    <a href="{{ url('/seminars') }}"
                        class="w-full sm:w-auto bg-transparent hover:bg-[#C27A6F] border-2 border-[#C27A6F] text-[#C27A6F] hover:text-white font-bold px-10 py-3.5 rounded-2xl shadow-sm hover:shadow-md transition-all duration-200 text-base text-center transform hover:scale-[1.02]">
                        Akses Seminar
                    </a>
                </div>
            </div>

        </div>
    </div>

    <!-- FLOATING WHATSAPP BUTTON -->
    <div class="fixed bottom-6 right-6 z-50">
        <a href="https://wa.me/" target="_blank"
            class="bg-[#25D366] hover:bg-[#20ba5a] text-white w-12 h-12 rounded-full flex items-center justify-center shadow-xl transition-all transform hover:scale-110 border-2 border-white focus:outline-none"
            title="Hubungi Kami via WhatsApp">
            <i class="fa-brands fa-whatsapp text-2xl"></i>
        </a>
    </div>
</x-layout>
