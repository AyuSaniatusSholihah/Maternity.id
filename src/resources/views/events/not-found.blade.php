<x-layout title="Event Tidak Ditemukan — Maternity.id" metaDescription="Event yang Anda cari tidak ditemukan.">
    <x-slot name="head">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <script>
            // Auto-redirect after 3 seconds
            setTimeout(function() {
                window.location.href = '{{ route("events") }}';
            }, 3000);
        </script>
    </x-slot>

    <div class="max-w-2xl mx-auto px-3 sm:px-6 lg:px-8 w-full py-16 sm:py-24">
        <div class="text-center space-y-6">
            <!-- Large Icon -->
            <div class="w-24 h-24 mx-auto rounded-full bg-[#FAF0EE] flex items-center justify-center text-[#8C433C] text-5xl">
                <i class="fa-regular fa-calendar-xmark"></i>
            </div>

            <!-- Heading -->
            <div class="space-y-2">
                <h1 class="text-3xl sm:text-4xl font-extrabold text-[#2A1614] tracking-tight" style="font-family: 'DM Serif Display', serif;">
                    Event Tidak Ditemukan
                </h1>
                <p class="text-base sm:text-lg text-neutral-600">
                    Maaf, event dengan slug <span class="font-mono font-semibold text-[#8C433C]">"{{ $slug }}"</span> tidak ada atau telah dihapus.
                </p>
            </div>

            <!-- Redirect Info -->
            <div class="bg-[#EBF5EE] border border-[#BDE0C6] rounded-2xl p-4 sm:p-5">
                <p class="text-sm text-[#2D5C3E] font-medium">
                    <i class="fa-solid fa-circle-info text-[#4D7C59] mr-2"></i>
                    Anda akan diarahkan ke halaman Event dalam <span class="font-bold countdown">3</span> detik...
                </p>
            </div>

            <!-- Manual Button -->
            <div class="flex flex-col sm:flex-row items-center justify-center gap-3 pt-4">
                <a href="{{ route('events') }}" 
                   class="inline-flex items-center gap-2 px-6 py-3 bg-[#8C433C] text-white font-bold rounded-full hover:bg-[#782819] transition-all duration-200 shadow-sm">
                    <i class="fa-solid fa-arrow-left"></i>
                    Kembali ke Event
                </a>
                <a href="{{ route('articles') }}" 
                   class="inline-flex items-center gap-2 px-6 py-3 bg-white text-[#8C433C] font-bold rounded-full border border-[#DEA69E]/50 hover:bg-[#FAF0EE] transition-all duration-200 shadow-sm">
                    <i class="fa-solid fa-newspaper"></i>
                    Lihat Artikel
                </a>
            </div>

            <!-- Helpful Info -->
            <div class="pt-6 border-t border-[#DEA69E]/30">
                <p class="text-xs sm:text-sm text-neutral-500 mb-3">
                    Atau cari event yang Anda inginkan:
                </p>
                <form action="{{ route('events') }}" method="GET" class="flex gap-2">
                    <input type="text" 
                           name="search" 
                           placeholder="Cari event..." 
                           class="flex-1 px-4 py-2 border border-[#DEA69E]/50 rounded-full text-sm focus:outline-none focus:border-[#8C433C] focus:ring-1 focus:ring-[#8C433C]/30">
                    <button type="submit" 
                            class="px-6 py-2 bg-[#8C433C] text-white font-semibold rounded-full hover:bg-[#782819] transition text-sm">
                        Cari
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Update countdown
        let counter = 3;
        setInterval(function() {
            counter--;
            document.querySelector('.countdown').textContent = counter;
        }, 1000);
    </script>

</x-layout>
