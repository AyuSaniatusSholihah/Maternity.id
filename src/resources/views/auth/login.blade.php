<x-layout title="Login" :minimalHeader="true">
    <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 my-auto">
        <div class="w-full grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center">
            
            <!-- Kolom Kiri: Gambar Hero (Ukuran pas tanpa overflow/scroll) -->
            <div class="w-full flex justify-center lg:justify-start">
                <div class="relative w-full max-w-[420px] lg:max-w-[460px] aspect-[4/4.2] rounded-3xl overflow-hidden shadow-sm border border-[#EEE0DC]">
                    <img 
                        src="https://images.unsplash.com/photo-1506126613408-eca07ce68773?q=80&w=1000&auto=format&fit=crop" 
                        alt="Maternity Yoga Class" 
                        class="w-full h-full object-cover object-center"
                    />
                </div>
            </div>

            <!-- Kolom Kanan: Form / Konten Login -->
            <div class="flex flex-col items-center text-center max-w-md mx-auto w-full px-2">
                <!-- Judul Utama: Plus Jakarta Sans, Bold, Warna #3D2B2B -->
                <h1 class="text-2xl md:text-3xl lg:text-[34px] font-bold leading-tight text-[#3D2B2B] mb-3" style="font-family: 'Plus Jakarta Sans', sans-serif;">
                    Masuk untuk menemukan pelatihan yang tepat untukmu
                </h1>
                
                <!-- Subtitle: Lexend (Tipis) -->
                <p class="text-[#6B5B5B] text-sm md:text-base mb-8 font-light" style="font-family: 'Lexend', sans-serif;">
                    Akses ebook sebagai bahan belajarmu
                </p>

                <!-- Tombol Sign in with Google: Poppins -->
                <a href="{{ route('google.login') }}" 
                   class="w-full bg-white border border-gray-300 rounded-xl py-3.5 px-6 flex items-center justify-center gap-3 shadow-sm hover:shadow-md hover:bg-gray-50 transition-all mb-8">
                    <svg class="w-5 h-5 flex-shrink-0" viewBox="0 0 24 24">
                        <path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.665-5.17 3.665-9.17z"/>
                        <path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.11-6.72-4.96H1.29v3.15C3.26 21.3 7.33 24 12 24z"/>
                        <path fill="#FBBC05" d="M5.28 14.24c-.25-.72-.38-1.49-.38-2.24s.13-1.52.38-2.24V6.61H1.29C.47 8.24 0 10.06 0 12s.47 3.76 1.29 5.39l3.99-3.15z"/>
                        <path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.33 0 3.26 2.7 1.29 6.61l3.99 3.15c.95-2.85 3.6-4.96 6.72-4.96z"/>
                    </svg>
                    <span class="font-medium text-gray-700 text-sm md:text-base" style="font-family: 'Poppins', sans-serif;">
                        Sign in with Google
                    </span>
                </a>

                <!-- Faded Navigasi Status -->
                <div class="flex items-center justify-center gap-2 text-[#EAE0DE] font-semibold select-none">
                    <svg class="w-4 h-4 text-[#EAE0DE]" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                    <span class="text-sm">Login</span>
                </div>
            </div>

        </div>
    </div>
</x-layout>