<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maternity - Masuk</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Playfair+Display:ital,wght@0,600;0,700;1,600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .font-serif-brand {
            font-family: 'Playfair Display', serif;
        }

        /* ── Background Slideshow ── */
        .bg-slideshow {
            position: absolute;
            inset: 0;
            z-index: 0;
            overflow: hidden;
        }
        .bg-slideshow .slide {
            position: absolute;
            inset: 0;
            background-size: cover;
            background-position: center;
            filter: blur(8px) brightness(0.65);
            transform: scale(1.1); /* prevent blur white edges */
            opacity: 0;
            animation: slideFade 24s infinite;
        }
        .bg-slideshow .slide:nth-child(1) { animation-delay: 0s; }
        .bg-slideshow .slide:nth-child(2) { animation-delay: 6s; }
        .bg-slideshow .slide:nth-child(3) { animation-delay: 12s; }
        .bg-slideshow .slide:nth-child(4) { animation-delay: 18s; }

        @keyframes slideFade {
            0%   { opacity: 0; transform: scale(1.1); }
            4%   { opacity: 1; transform: scale(1.1); }
            25%  { opacity: 1; transform: scale(1.15); }  /* subtle zoom */
            29%  { opacity: 0; transform: scale(1.15); }
            100% { opacity: 0; transform: scale(1.1); }
        }

        /* ── Warm overlay on top of slides ── */
        .bg-overlay {
            position: absolute;
            inset: 0;
            z-index: 1;
            background: linear-gradient(
                135deg,
                rgba(251, 244, 242, 0.55) 0%,
                rgba(224, 139, 136, 0.25) 50%,
                rgba(251, 244, 242, 0.55) 100%
            );
        }

        /* ── Glass Card ── */
        .glass-card {
            background: rgba(255, 255, 255, 0.82);
            backdrop-filter: blur(20px) saturate(1.4);
            -webkit-backdrop-filter: blur(20px) saturate(1.4);
            border: 1px solid rgba(255, 255, 255, 0.6);
            box-shadow:
                0 8px 32px rgba(0, 0, 0, 0.08),
                0 1px 4px rgba(0, 0, 0, 0.04);
        }
    </style>
</head>
<body class="min-h-screen flex flex-col text-[#333333]">

    <!-- ════════════ HERO SECTION — Full Viewport ════════════ -->
    <section class="relative h-screen flex flex-col overflow-hidden">

        <!-- Background Slideshow Images -->
        <div class="bg-slideshow">
            <div class="slide" style="background-image: url('https://images.unsplash.com/photo-1545205597-3d9d02c29597?q=80&w=1600&auto=format&fit=crop');"></div>
            <div class="slide" style="background-image: url('https://images.unsplash.com/photo-1518611012118-696072aa579a?q=80&w=1600&auto=format&fit=crop');"></div>
            <div class="slide" style="background-image: url('https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?q=80&w=1600&auto=format&fit=crop');"></div>
            <div class="slide" style="background-image: url('https://images.unsplash.com/photo-1506126613408-eca07ce68773?q=80&w=1600&auto=format&fit=crop');"></div>
        </div>

        <!-- Warm Color Overlay -->
        <div class="bg-overlay"></div>

        <!-- Header Navigation -->
        <header class="relative z-10 w-full px-8 md:px-16 py-5 flex items-center justify-between shrink-0">
            <a href="{{ url('/') }}" class="flex items-center gap-3">
                <img src="{{ asset('logologin.png') }}" alt="Maternity Logo" class="h-9 w-auto object-contain">
                <span class="font-serif-brand text-2xl font-bold tracking-tight text-white drop-shadow-sm">Maternity</span>
            </a>
            <a href="{{ url('/') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-white/90 hover:text-white transition-colors duration-200 drop-shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                <span>Back to Home</span>
            </a>
        </header>

        <!-- Centered Login Content with Frosted Glass Card -->
        <div class="relative z-10 flex-1 flex items-center justify-center px-6 -translate-y-6 sm:-translate-y-8">
            <div class="glass-card rounded-3xl px-8 py-10 sm:px-14 sm:py-12 w-full max-w-2xl text-center space-y-6 flex flex-col items-center shadow-lg">

                <!-- Heading -->
                <div class="space-y-3">
                    <h1 class="text-2xl sm:text-3xl lg:text-[32px] font-extrabold text-[#2F2927] leading-snug">
                        Masuk untuk menemukan pelatihan<br>yang tepat untukmu
                    </h1>
                    <p class="text-sm sm:text-base text-[#6B6462] font-medium">
                        Akses ebook sebagai bahan belajarmu
                    </p>
                </div>

                <!-- Google Login Button -->
                <div class="pt-2 w-full flex justify-center">
                    <a
                        href="{{ route('google.login') }}"
                        class="w-full max-w-[340px] flex items-center justify-center gap-3 bg-white hover:bg-neutral-50 border border-[#D9D9D9] hover:border-gray-400 hover:shadow-md active:scale-[0.98] transition-all duration-200 rounded-xl py-3.5 px-6 text-[#2F2927] font-semibold text-sm sm:text-base shadow-sm"
                    >
                        <svg class="w-5 h-5 flex-shrink-0" viewBox="0 0 24 24">
                            <path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.665-5.17 3.665-9.17z"/>
                            <path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.15C3.26 21.36 7.35 24 12 24z"/>
                            <path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.25C.45 8.18 0 10.03 0 12s.45 3.82 1.25 5.42l4.03-3.15z"/>
                            <path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.35 0 3.26 2.64 1.25 6.58l4.03 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/>
                        </svg>
                        <span>Masuk dengan Google</span>
                    </a>
                </div>

            </div>
        </div>

        <!-- ── Decorative Floral SVG — Pojok Kanan Bawah ── -->
        <div class="absolute bottom-0 right-0 pointer-events-none z-[2] select-none opacity-60 w-[180px] md:w-[260px] lg:w-[300px]">
            <svg viewBox="0 0 207 223" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-auto">
                <path d="M178.289 53.5778C176.262 59.1018 174.343 65.8865 173.28 74.6963C170.9 83.8476 166.835 94.3483 165.1 98.4546C159.151 113.707 141.751 150.899 119.741 177.649C114.184 185.047 96.2992 199.355 78.8143 211.967C77.5813 212.856 76.3503 213.737 75.1258 214.607C56.536 227.806 37.9463 233.965 0.0231934 232.205M178.289 53.5778C181.931 43.6528 185.921 37.7976 185.921 31.5792C185.921 9.58074 180.715 -3.61835 175.51 1.66128C170.305 6.94092 167.331 22.7798 170.305 31.5792C172.685 38.6188 176.619 49.1781 178.289 53.5778ZM78.8143 211.967C84.8459 200.472 87.1254 197.49 87.987 193.488M87.987 193.488C88.5104 191.057 88.5104 188.25 88.5104 182.929C88.5104 163.57 88.5104 155.651 92.2283 147.731C95.2027 142.452 99.6642 138.052 99.6642 153.011C99.6642 167.97 99.6642 164.45 95.9463 177.649C91.1873 189.616 88.6572 193.195 87.987 193.488Z" stroke="#FFFFFF" stroke-width="1.3"/>
                <path d="M122.715 172.37C122.715 152.131 119.741 158.291 116.023 140.692C113.049 123.093 113.049 113.414 114.536 106.374C114.536 95.8148 118.254 97.5747 120.485 98.4547C122.716 99.3346 126.434 101.974 126.434 109.894C126.434 117.813 127.921 118.693 127.178 123.973C126.434 129.253 128.665 135.412 126.434 141.572C124.649 146.499 122.22 152.424 121.229 154.771" stroke="#FFFFFF" stroke-width="1.3"/>
                <path d="M147.254 134.532C146.469 116.879 143.05 104.897 139.818 97.7781M139.818 97.7781C138.152 94.1096 136.536 91.7323 135.356 90.5353C131.886 88.1888 125.095 81.56 125.69 73.8165C126.433 64.1372 124.945 46.5384 130.151 51.818C136.843 55.3377 137.587 61.4973 139.074 64.1371C140.561 66.7769 145.023 72.0565 144.279 72.9365C143.536 73.8165 147.254 80.8559 144.279 88.7754C141.9 95.111 140.313 97.417 139.818 97.7781ZM75.8689 214.607C77.1482 215.039 80.3412 215.599 84.792 215.299M84.792 215.299C86.3773 215.193 88.1222 214.977 89.9971 214.607C98.9202 212.847 105.612 208.447 111.561 213.727C117.51 219.006 124.946 220.766 121.971 225.166C111.264 227.982 102.142 226.926 98.9202 226.046C97.9287 225.541 94.9048 223.602 90.7407 219.886C86.5766 216.171 85.0398 215.28 84.792 215.299Z" stroke="#FFFFFF" stroke-width="1.3"/>
                <path d="M104.126 192.608C118.998 191.728 116.023 191.728 127.921 188.208C135.654 186.096 146.51 189.088 150.972 190.848C152.707 191.435 156.028 193.136 155.433 195.248C146.51 201.407 147.254 203.167 137.587 200.527C129.854 198.416 119.989 194.368 116.023 192.608" stroke="#FFFFFF" stroke-width="1.3"/>
                <path d="M125.69 171.489C139.075 170.609 143.536 175.009 154.69 176.769C168.967 178.177 175.511 174.423 176.998 172.369C175.759 169.436 172.239 163.394 168.075 162.69C162.87 161.81 159.152 160.93 153.203 161.81C146.659 163.218 138.579 168.263 135.357 170.61" stroke="#FFFFFF" stroke-width="1.3"/>
                <path d="M145.766 139.812C146.758 141.572 150.674 142.804 158.407 133.652C171.048 121.333 176.254 115.174 185.177 115.174C192.315 115.174 198.066 117.52 200.048 118.693C200.048 123.093 198.561 131.892 192.613 131.892C177.741 135.412 176.323 137.172 166.587 136.292C158.798 135.588 157.393 135.412 157.664 135.412" stroke="#FFFFFF" stroke-width="1.3"/>
                <path d="M172.536 79.9761C173.687 79.7037 178.188 79.1481 184.433 70.2967M184.433 70.2967C184.914 69.6151 184.666 66.6521 185.177 65.897C194.1 52.6979 200.049 42.1387 206.741 42.1387C212.095 42.1387 228.553 42.7253 232.023 43.0186C231.032 48.5916 220.869 62.6868 217.895 65.5026C207.485 76.4563 190.382 69.872 184.433 70.2967Z" stroke="#FFFFFF" stroke-width="1.3"/>
            </svg>
        </div>
    </section>

    <!-- ════════════ FOOTER — di bawah hero ════════════ -->
    <footer class="w-full border-t border-[#E8DCDA] px-8 md:px-16 py-6 bg-[#FBF4F2]">
        <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-6 items-start">
            <div class="flex items-start gap-4">
                <div class="w-8 h-8 flex-shrink-0 mt-0.5">
                    <img src="{{ asset('logologin.png') }}" alt="Maternity Logo" class="w-full h-full object-contain">
                </div>
                <p class="text-xs text-[#5C5552] leading-relaxed max-w-xs">
                    Cerdas memilih, aman melangkah, bersama Maternity.id
                </p>
            </div>
            <div class="space-y-1.5">
                <h3 class="text-sm font-bold text-[#3B6652]">Jelajahi</h3>
                <ul class="space-y-0.5 text-xs text-[#6B6462]">
                    <li><a href="{{ url('/seminars') }}" class="hover:text-[#3B6652] transition-colors">Pelatihan</a></li>
                    <li><a href="{{ url('/library') }}" class="hover:text-[#3B6652] transition-colors">Ebook</a></li>
                </ul>
            </div>
            <div class="space-y-1.5">
                <h3 class="text-sm font-bold text-[#3B6652]">Ikuti Kami</h3>
                <p class="text-xs text-[#7A7370]">Temukan info dan cerita terbaru dari Maternity</p>
                <div class="space-y-1 pt-0.5 text-xs text-[#6B6462]">
                    <a href="https://instagram.com/suara_kelas" target="_blank" class="flex items-center gap-2 hover:text-[#3B6652] transition-colors">
                        <svg class="w-3.5 h-3.5 text-[#8C3A36]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                            <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                        </svg>
                        <span>suara_kelas</span>
                    </a>
                    <a href="https://tiktok.com/@Maternity" target="_blank" class="flex items-center gap-2 hover:text-[#3B6652] transition-colors">
                        <svg class="w-3.5 h-3.5 text-[#8C3A36]" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64c.298 0 .59.043.87.128V9.38a6.34 6.34 0 0 0-.87-.06A6.34 6.34 0 0 0 3 15.66a6.34 6.34 0 0 0 10.82 4.48c.38-.4.7-.85.95-1.34V10.7a8.28 8.28 0 0 0 4.82 1.55v-3.45a4.85 4.85 0 0 1-2.11-.64z"/>
                        </svg>
                        <span>Maternity</span>
                    </a>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>