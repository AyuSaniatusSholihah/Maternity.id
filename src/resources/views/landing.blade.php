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
            class="relative flex items-start justify-center min-h-[480px] lg:min-h-[540px] pt-8 sm:pt-10 pb-6 sm:pb-8">

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

    <!-- UPCOMING EVENT SECTION -->
    <section class="w-full bg-[#fcf5f3] pt-4 sm:pt-6 pb-16 px-4 sm:px-6 lg:px-8" style="font-family: 'Plus Jakarta Sans', sans-serif;">
        <div class="max-w-7xl mx-auto">
            <!-- Header Section -->
            <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-8 gap-4">
                <div>
                    <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-[#3D2B2B] tracking-tight" style="font-family: 'Plus Jakarta Sans', sans-serif;">
                        Upcoming Event
                    </h2>
                    <p class="mt-2 text-sm sm:text-base text-neutral-600 font-medium" style="font-family: 'Plus Jakarta Sans', sans-serif;">
                        Join our expert-led sessions designed to empower and inform
                    </p>
                </div>
                <a href="{{ route('events') }}" class="group inline-flex items-center gap-1.5 text-sm font-bold text-[#7A9E7E] hover:text-[#5a7a66] transition-all duration-200" style="font-family: 'Plus Jakarta Sans', sans-serif;">
                    <span>View All Calendar</span>
                    <i class="fa-solid fa-arrow-right text-xs transform group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>

            <!-- Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                @php
                    // Data dummy event (dapat diganti dengan data dari Controller/Database)
                    $events = [
                        [
                            'tag' => 'ONLINE',
                            'image' => 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=800&q=80',
                            'date' => 'Oct 12, 2024',
                            'time' => '10:00 AM',
                            'title' => 'Mindful Motherhood',
                            'description' => 'Building mental resilience and community during early parenting stages',
                            'link' => route('events')
                        ],
                        [
                            'tag' => 'OFFLINE-UNS',
                            'image' => 'https://images.unsplash.com/photo-1518611012118-696072aa579a?auto=format&fit=crop&w=800&q=80',
                            'date' => 'Oct 12, 2024',
                            'time' => '10:00 AM',
                            'title' => 'Holistic Hormone Health',
                            'description' => 'A deep dive into balancing your cycle naturally with Dr. Jenkins',
                            'link' => route('events')
                        ],
                        [
                            'tag' => 'ONLINE',
                            'image' => 'https://images.unsplash.com/photo-1545205597-3d9d02c29597?auto=format&fit=crop&w=800&q=80',
                            'date' => 'Oct 12, 2024',
                            'time' => '10:00 AM',
                            'title' => 'Mindful Motherhood',
                            'description' => 'Building mental resilience and community during early parenting stages',
                            'link' => route('events')
                        ],
                    ];
                @endphp

                @foreach ($events as $event)
                    <div class="group bg-[#FAF0EE] rounded-3xl border border-[#DEA69E]/50 hover:border-[#DEA69E] p-3.5 flex flex-col justify-between shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300 ease-out">
                        <div>
                            <!-- Image Container -->
                            <div class="relative w-full h-48 sm:h-52 rounded-2xl overflow-hidden mb-4 bg-gray-100">
                                <img src="{{ $event['image'] }}" alt="{{ $event['title'] }}" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500 ease-out">
                                
                                <!-- Badge/Tag -->
                                <span class="absolute top-3 left-3 bg-[#e8a394]/95 backdrop-blur-xs text-[#782819] text-[11px] font-bold tracking-wider px-3 py-1 rounded-full uppercase shadow-xs transition-transform duration-300 group-hover:scale-105">
                                    {{ $event['tag'] }}
                                </span>
                            </div>

                            <!-- Content Details -->
                            <div class="px-2">
                                <!-- Date & Time -->
                                <div class="flex items-center text-xs font-semibold text-[#c86d5c] mb-2 space-x-1.5">
                                    <svg class="w-4 h-4 inline-block -mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <span>{{ $event['date'] }} &bull; {{ $event['time'] }}</span>
                                </div>

                                <!-- Title -->
                                <h3 class="text-lg font-bold text-[#3D2B2B] mb-2 leading-tight group-hover:text-[#80382D] transition-colors duration-200">
                                    {{ $event['title'] }}
                                </h3>

                                <!-- Description -->
                                <p class="text-neutral-500 text-sm leading-relaxed mb-5 line-clamp-2">
                                    {{ $event['description'] }}
                                </p>
                            </div>
                        </div>

                        <!-- Action Button -->
                        <div class="px-2 pb-1 pt-2">
                            <a href="{{ $event['link'] }}" class="block w-full text-center py-2.5 px-4 bg-[#f0c2b8] group-hover:bg-[#e8a89b] hover:!bg-[#C27A6F] text-[#782819] hover:!text-white font-bold text-sm rounded-2xl transition-all duration-300 shadow-xs hover:shadow-md transform active:scale-95">
                                View Detail
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- FLOATING WHATSAPP BUTTON -->
    <div class="fixed bottom-6 right-6 z-50">
        <a href="https://wa.me/" target="_blank"
            class="bg-[#25D366] hover:bg-[#20ba5a] text-white w-12 h-12 rounded-full flex items-center justify-center shadow-xl transition-all transform hover:scale-110 border-2 border-white focus:outline-none"
            title="Hubungi Kami via WhatsApp">
            <i class="fa-brands fa-whatsapp text-2xl"></i>
        </a>
    </div>
</x-layout>
