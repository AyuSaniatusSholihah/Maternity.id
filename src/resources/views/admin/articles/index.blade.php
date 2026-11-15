<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artikel - Admin Maternity.id</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="min-h-screen bg-[#FAF5F2] text-neutral-800" x-data="{ mobileSidebar: false }">
    <div class="flex min-h-screen overflow-hidden">
        @include('admin.partials.sidebar', ['activeMenu' => 'articles'])
        <main class="min-w-0 flex-1 px-4 py-8 sm:px-8">
        <button @click="mobileSidebar = true" class="mb-4 rounded-lg bg-white px-3 py-2 text-xs font-bold shadow-sm md:hidden">
            <i class="fa-solid fa-bars mr-2"></i>Menu
        </button>
        <div class="mb-6 flex items-center justify-between gap-4">
            <div>
                <a href="{{ route('admin.dashboard') }}" class="text-xs font-semibold text-[#5F8C72]">← Kembali ke dashboard</a>
                <h1 class="mt-2 text-2xl font-bold text-neutral-900">Artikel Edukasi</h1>
                <p class="mt-1 text-sm text-neutral-500">Kelola artikel dan cover JPG untuk halaman publik.</p>
            </div>
            <a href="{{ route('admin.article.create') }}" class="rounded-xl bg-[#5F8C72] px-4 py-3 text-xs font-bold text-white">+ Tambah Artikel</a>
        </div>

        @if (session('status'))
            <div class="mb-5 rounded-xl bg-emerald-50 p-4 text-sm text-emerald-700">{{ session('status') }}</div>
        @endif

        <div class="overflow-hidden rounded-2xl bg-white shadow-sm">
            <div class="divide-y divide-neutral-100">
                @forelse ($articles as $article)
                    <div class="flex flex-col gap-4 p-5 sm:flex-row sm:items-center sm:justify-between">
                        <div class="flex min-w-0 items-center gap-4">
                            @if ($article->image_url)
                                <img src="{{ $article->image_url }}" alt="Cover {{ $article->title }}" class="h-16 w-24 rounded-lg object-cover">
                            @else
                                <div class="flex h-16 w-24 items-center justify-center rounded-lg bg-neutral-100 text-xs text-neutral-400">Tanpa cover</div>
                            @endif
                            <div class="min-w-0">
                                <span class="text-xs font-semibold text-[#B96A5C]">{{ $article->category?->name ?? 'Tanpa kategori' }}</span>
                                <h2 class="truncate font-bold text-neutral-900">{{ $article->title }}</h2>
                                <p class="truncate text-xs text-neutral-500">{{ $article->description }}</p>
                            </div>
                        </div>
                        <div class="flex shrink-0 gap-2">
                            <a href="{{ route('admin.article.edit', $article->id) }}" class="rounded-lg bg-neutral-100 px-3 py-2 text-xs font-semibold">Edit</a>
                            <form action="{{ route('admin.article.destroy', $article->id) }}" method="POST" onsubmit="return confirm('Hapus artikel ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="rounded-lg bg-red-50 px-3 py-2 text-xs font-semibold text-red-600">Hapus</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p class="p-8 text-center text-sm text-neutral-500">Belum ada artikel.</p>
                @endforelse
            </div>
        </div>
        </main>
    </div>
</body>
</html>
