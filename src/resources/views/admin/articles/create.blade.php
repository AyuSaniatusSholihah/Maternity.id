<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $article ? 'Edit' : 'Tambah' }} Artikel - Admin Maternity.id</title>
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
        <a href="{{ route('admin.article') }}" class="text-xs font-semibold text-[#5F8C72]">← Kembali ke artikel</a>
        <h1 class="mt-3 text-2xl font-bold text-neutral-900">{{ $article ? 'Edit' : 'Tambah' }} Artikel</h1>
        <p class="mt-1 text-sm text-neutral-500">Isi artikel edukasi untuk ditampilkan di website.</p>

        @if ($errors->any())
            <div class="mt-5 rounded-xl bg-red-50 p-4 text-sm text-red-700">
                <ul class="list-disc space-y-1 pl-5">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
            </div>
        @endif

        <form action="{{ $article ? route('admin.article.update', $article->id) : route('admin.article.store') }}" method="POST" enctype="multipart/form-data" class="mt-6 space-y-5 rounded-2xl bg-white p-6 shadow-sm">
            @csrf
            @if ($article) @method('PUT') @endif
            <div>
                <label for="categories" class="mb-1 block text-sm font-bold">Kategori</label>
                <select id="categories" name="categories" required class="w-full rounded-lg border border-neutral-300 px-3 py-2.5">
                    <option value="">Pilih kategori</option>
                    @foreach ($adminCategories as $category)
                        <option value="{{ $category->id }}" @selected(old('categories', $article?->categories) === $category->id)>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="title" class="mb-1 block text-sm font-bold">Judul Artikel</label>
                <input id="title" name="title" value="{{ old('title', $article?->title) }}" maxlength="255" required class="w-full rounded-lg border border-neutral-300 px-3 py-2.5">
            </div>
            <div>
                <label for="image" class="mb-1 block text-sm font-bold">Cover Artikel</label>
                <input id="image" type="file" name="image" accept=".jpg,.jpeg,image/jpeg" class="w-full rounded-lg border border-neutral-300 px-3 py-2.5">
                <p class="mt-1 text-xs text-neutral-500">Format JPG/JPEG, maksimal 5 MB.</p>
                @if ($article?->image_url)<img src="{{ $article->image_url }}" alt="Cover {{ $article->title }}" class="mt-2 h-24 rounded-lg object-cover">@endif
            </div>
            <div>
                <label for="description" class="mb-1 block text-sm font-bold">Penjelasan singkat</label>
                <textarea id="description" name="description" maxlength="500" required rows="4" class="w-full rounded-lg border border-neutral-300 px-3 py-2.5" placeholder="Maksimal 500 karakter">{{ old('description', $article?->description) }}</textarea>
                <p class="mt-1 text-xs text-neutral-500">Maksimal 500 karakter.</p>
            </div>
            <div>
                <label for="content" class="mb-1 block text-sm font-bold">Isi Artikel</label>
                <textarea id="content" name="content" required rows="12" class="w-full rounded-lg border border-neutral-300 px-3 py-2.5">{{ old('content', $article?->content) }}</textarea>
            </div>
            <div class="flex justify-end gap-3 border-t border-neutral-100 pt-4">
                <a href="{{ route('admin.article') }}" class="rounded-lg px-4 py-2.5 text-sm font-semibold">Batal</a>
                <button class="rounded-lg bg-[#5F8C72] px-4 py-2.5 text-sm font-bold text-white">Simpan Artikel</button>
            </div>
        </form>
        </main>
    </div>
</body>
</html>
