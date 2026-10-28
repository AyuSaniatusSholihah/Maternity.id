<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah E-Book - Maternity.id</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=DM+Serif+Display&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="min-h-screen bg-[#FAF5F2] text-neutral-800 antialiased">
    <main class="mx-auto max-w-4xl px-4 py-6 sm:px-6 sm:py-10">
        <div class="mb-6 flex items-center justify-between gap-4">
            <div>
                <a href="{{ route('admin.ebook') }}"
                    class="mb-3 inline-flex items-center gap-2 text-xs font-semibold text-[#5F8C72] hover:text-[#4f755e]">
                    <i class="fa-solid fa-arrow-left"></i>
                    Kembali ke daftar e-book
                </a>
                <h1 class="font-serif-brand text-2xl font-bold text-neutral-900">Tambah E-Book</h1>
                <p class="mt-1 text-xs text-neutral-500">Lengkapi semua data materi sebelum menyimpannya ke library.</p>
            </div>
            <span
                class="hidden rounded-full bg-[#E4F5E6] px-3 py-1.5 text-[10px] font-bold text-[#428E53] sm:inline-flex">Admin
                Portal</span>
        </div>

        @if ($errors->any())
            <div class="mb-5 rounded-2xl border border-red-200 bg-red-50 p-4 text-xs text-red-700">
                <p class="font-bold">Periksa kembali data berikut:</p>
                <ul class="mt-2 list-disc space-y-1 pl-4">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.ebook.store') }}" method="POST"
            class="space-y-6 rounded-3xl border border-neutral-200/70 bg-white p-5 shadow-sm sm:p-8">
            @csrf
            <div class="grid gap-5 md:grid-cols-2">
                <div>
                    <label for="categories" class="mb-1.5 block text-xs font-bold text-neutral-700">Kategori <span
                            class="text-red-500">*</span></label>
                    <select id="categories" name="categories" required
                        class="w-full rounded-xl border border-neutral-300 bg-[#FAF5F2] px-3 py-3 text-sm focus:border-[#5F8C72] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#5F8C72]/20">
                        <option value="">Pilih kategori</option>
                        @foreach ($adminCategories as $category)
                            <option value="{{ $category->id }}" @selected(old('categories') === $category->id)>{{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="title" class="mb-1.5 block text-xs font-bold text-neutral-700">Judul E-Book <span
                            class="text-red-500">*</span></label>
                    <input id="title" name="title" value="{{ old('title') }}" required maxlength="255"
                        class="w-full rounded-xl border border-neutral-300 bg-[#FAF5F2] px-4 py-3 text-sm focus:border-[#5F8C72] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#5F8C72]/20"
                        placeholder="Contoh: Panduan Nutrisi Ibu Hamil">
                </div>
                <div class="md:col-span-2">
                    <label for="image_url" class="mb-1.5 block text-xs font-bold text-neutral-700">URL Gambar</label>
                    <input id="image_url" type="url" name="image_url" value="{{ old('image_url') }}" maxlength="255"
                        class="w-full rounded-xl border border-neutral-300 bg-[#FAF5F2] px-4 py-3 text-sm focus:border-[#5F8C72] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#5F8C72]/20"
                        placeholder="https://...">
                </div>
                <div class="md:col-span-2">
                    <label for="description" class="mb-1.5 block text-xs font-bold text-neutral-700">Deskripsi <span
                            class="text-red-500">*</span></label>
                    <textarea id="description" name="description" rows="4" required
                        class="w-full rounded-xl border border-neutral-300 bg-[#FAF5F2] px-4 py-3 text-sm focus:border-[#5F8C72] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#5F8C72]/20"
                        placeholder="Ringkasan isi e-book">{{ old('description') }}</textarea>
                </div>
                <div class="md:col-span-2">
                    <label for="content" class="mb-1.5 block text-xs font-bold text-neutral-700">Konten E-Book <span
                            class="text-red-500">*</span></label>
                    <textarea id="content" name="content" rows="12" required
                        class="w-full rounded-xl border border-neutral-300 bg-[#FAF5F2] px-4 py-3 text-sm focus:border-[#5F8C72] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#5F8C72]/20"
                        placeholder="Tulis atau tempel konten materi e-book">{{ old('content') }}</textarea>
                </div>
            </div>
            <div class="flex items-center justify-end gap-3 border-t border-neutral-100 pt-5">
                <a href="{{ route('admin.ebook') }}"
                    class="rounded-xl px-5 py-3 text-xs font-semibold text-neutral-600 hover:bg-neutral-100">Batal</a>
                <button type="submit"
                    class="rounded-xl bg-[#5F8C72] px-5 py-3 text-xs font-bold text-white shadow-sm transition hover:bg-[#4f755e]">
                    <i class="fa-solid fa-book-medical mr-2"></i>Simpan E-Book
                </button>
            </div>
        </form>
    </main>
</body>

</html>
