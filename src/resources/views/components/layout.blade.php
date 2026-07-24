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
                <span class="text-xl md:text-2xl text-[#2A1614]" style="font-family: 'DM Serif Display', serif;">
                    Maternity
                </span>
            </a>
            <a href="{{ url('/') }}"
                class="flex items-center gap-2 text-sm font-semibold text-[#2A1614] hover:opacity-80 transition-opacity">
                <svg class="w-4 h-4 text-[#4D6A56]" fill="none" stroke="currentColor" stroke-width="2.5"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                <span>Back to Home</span>
            </a>
        </header>
    @else
        {{-- Hanya kotak pink nav yang sticky, background halaman ikut scroll --}}
        <div class="sticky top-0 z-50 w-full px-4 sm:px-6 lg:px-8 pt-4 pb-2">
            <div class="max-w-7xl mx-auto">
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

</body>

</html>
