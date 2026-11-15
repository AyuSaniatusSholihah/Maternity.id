<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('logologin.png') }}">
    <title>Tambah Produk - Maternity.id</title>
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
        <div class="mb-6">
            <a href="{{ route('admin.dashboard') }}"
                class="mb-3 inline-flex items-center gap-2 text-xs font-semibold text-[#5F8C72] hover:text-[#4f755e]">
                <i class="fa-solid fa-arrow-left"></i>
                Kembali ke dashboard
            </a>
            <h1 class="font-serif-brand text-2xl font-bold text-neutral-900">Tambah Produk</h1>
            <p class="mt-1 text-xs text-neutral-500">Tambahkan gambar, nama, dan link afiliasi produk.</p>
        </div>

        @if (session('status'))
            <div class="mb-5 rounded-2xl border border-emerald-200 bg-emerald-50 p-4 text-xs text-emerald-700">
                {{ session('status') }}
            </div>
        @endif

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

        <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data"
            class="space-y-6 rounded-3xl border border-neutral-200/70 bg-white p-5 shadow-sm sm:p-8">
            @csrf
            <div class="grid gap-5 md:grid-cols-2">
                <div>
                    <label for="categories" class="mb-1.5 block text-xs font-bold text-neutral-700">Kategori <span class="text-red-500">*</span></label>
                    <select id="categories" name="categories" required
                        class="w-full rounded-xl border border-neutral-300 bg-[#FAF5F2] px-3 py-3 text-sm focus:border-[#5F8C72] focus:outline-none focus:ring-2 focus:ring-[#5F8C72]/20">
                        <option value="">Pilih kategori</option>
                        @foreach ($adminCategories as $category)
                            <option value="{{ $category->id }}" @selected(old('categories') === $category->id)>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="name" class="mb-1.5 block text-xs font-bold text-neutral-700">Nama Produk <span class="text-red-500">*</span></label>
                    <input id="name" name="name" value="{{ old('name') }}" required maxlength="255"
                        class="w-full rounded-xl border border-neutral-300 bg-[#FAF5F2] px-4 py-3 text-sm focus:border-[#5F8C72] focus:outline-none focus:ring-2 focus:ring-[#5F8C72]/20"
                        placeholder="Contoh: Bantal Ibu Hamil">
                </div>
                <div>
                    <label for="price" class="mb-1.5 block text-xs font-bold text-neutral-700">Harga <span class="text-red-500">*</span></label>
                    <input id="price" name="price" type="number" min="0" step="0.01" value="{{ old('price', 0) }}" required
                        class="w-full rounded-xl border border-neutral-300 bg-[#FAF5F2] px-4 py-3 text-sm focus:border-[#5F8C72] focus:outline-none focus:ring-2 focus:ring-[#5F8C72]/20">
                </div>
                <div>
                    <label for="image" class="mb-1.5 block text-xs font-bold text-neutral-700">Gambar Produk <span class="text-red-500">*</span></label>
                    <input id="image" type="file" name="image" accept=".jpg,.jpeg,.png,image/jpeg,image/png" required
                        class="w-full rounded-xl border border-neutral-300 bg-[#FAF5F2] px-3 py-2.5 text-sm file:mr-3 file:rounded-lg file:border-0 file:bg-[#5F8C72] file:px-3 file:py-2 file:text-xs file:font-bold file:text-white">
                    <p class="mt-1.5 text-[11px] text-neutral-500">Format JPG atau PNG, maksimal 5 MB.</p>
                </div>
                <div class="md:col-span-2">
                    <label for="affiliate_url" class="mb-1.5 block text-xs font-bold text-neutral-700">Link Afiliasi Produk <span class="text-red-500">*</span></label>
                    <input id="affiliate_url" name="affiliate_url" type="url" value="{{ old('affiliate_url') }}" required maxlength="2048"
                        class="w-full rounded-xl border border-neutral-300 bg-[#FAF5F2] px-4 py-3 text-sm focus:border-[#5F8C72] focus:outline-none focus:ring-2 focus:ring-[#5F8C72]/20"
                        placeholder="https://contoh-toko.com/produk?ref=maternity">
                </div>
                <div class="md:col-span-2">
                    <label for="description" class="mb-1.5 block text-xs font-bold text-neutral-700">Deskripsi</label>
                    <textarea id="description" name="description" rows="4"
                        class="w-full rounded-xl border border-neutral-300 bg-[#FAF5F2] px-4 py-3 text-sm focus:border-[#5F8C72] focus:outline-none focus:ring-2 focus:ring-[#5F8C72]/20"
                        placeholder="Deskripsi singkat produk">{{ old('description') }}</textarea>
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit"
                    class="inline-flex items-center gap-2 rounded-xl bg-[#5F8C72] px-5 py-3 text-xs font-bold text-white transition hover:bg-[#4f755e]">
                    <i class="fa-solid fa-upload"></i>
                    Simpan Produk
                </button>
            </div>
        </form>
    </main>
</body>

</html>
