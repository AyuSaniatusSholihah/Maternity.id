<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="{{ $metaDescription ?? 'Maternity.id — Platform seminar & pelatihan maternitas untuk ibu hamil dan nifas di Solo & Jogja.' }}">

    <title>{{ $title ?? 'Maternity.id' }} — Maternity Woman's Health</title>

    {{-- Preconnect Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=Lexend:wght@300;400;500&family=Plus+Jakarta+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400&family=Poppins:wght@400;500;600&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>

    {{-- Slot untuk tambahan head --}}
    {{ $head ?? '' }}
</head>

<body class="bg-[#FAF0EE] text-[#2A1614] min-h-screen flex flex-col justify-between">

    {{-- ─── HEADER ─────────────────────────────────────────── --}}
    @if (isset($minimalHeader) && $minimalHeader)
        <header class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between pt-4">
            <a href="{{ url('/') }}" class="flex items-center gap-2.5">
                <x-logo_putih class="w-8 h-8" />
                <span class="text-xl md:text-2xl" style="font-family: 'DM Serif Display', serif; background: linear-gradient(to right, rgba(61, 43, 43, 0.8), #2A1614); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                    Maternity
                </span>
            </a>
            <a href="{{ url('/') }}"
                class="flex items-center gap-2 text-sm font-semibold text-[#2A1614] hover:opacity-80 transition-opacity">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M22 20.418C19.5533 17.4313 17.3807 15.7367 15.482 15.334C13.5833 14.9313 11.7757 14.8705 10.059 15.1515V20.5L2 11.7725L10.059 3.5V8.5835C13.2333 8.6085 15.932 9.74733 18.155 12C20.3777 14.2527 21.6593 17.0587 22 20.418Z" fill="#7A9E7E" stroke="#7A9E7E" stroke-width="2" stroke-linejoin="round"/>
                </svg>
                <span>Back to Home</span>
            </a>
        </header>
    @else
        {{-- Sticky Static Header (Stabil tanpa animasi menciut/getar) --}}
        <div class="sticky top-0 z-50 w-full px-3 sm:px-6 lg:px-8 pt-3 sm:pt-4 pb-2">
            <div class="mx-auto max-w-7xl">
                <x-header />
            </div>
        </div>
    @endif

    {{-- ─── MAIN CONTENT ───────────────────────────────────── --}}
    <main class="flex-grow flex flex-col items-center justify-start py-2 sm:py-4">
        {{ $slot }}
    </main>

    {{-- ─── FOOTER ─────────────────────────────────────────── --}}
    <x-footer />

    {{-- ─── MOBILE FLOATING BOTTOM NAVIGATION (md:hidden) ─── --}}
    <div class="md:hidden fixed bottom-4 left-1/2 -translate-x-1/2 z-40 w-[92%] max-w-sm">
        <x-bottom_nav />
    </div>

</body>

</html>
