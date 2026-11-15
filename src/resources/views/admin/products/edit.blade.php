<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('logologin.png') }}">
    <title>Edit Produk - Maternity.id</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-[#FAF5F2] text-neutral-800 antialiased">
    <main class="mx-auto max-w-4xl px-4 py-6 sm:px-6 sm:py-10">
        <div class="mb-6">
            <a href="{{ route('admin.product') }}" class="mb-3 inline-flex items-center gap-2 text-xs font-semibold text-[#5F8C72]">
                <span aria-hidden="true">&larr;</span> Kembali ke produk
            </a>
            <h1 class="text-2xl font-bold text-neutral-900">Edit Produk</h1>
        </div>

        @if ($errors->any())
            <div class="mb-5 rounded-2xl border border-red-200 bg-red-50 p-4 text-xs text-red-700">
                <ul class="list-disc space-y-1 pl-4">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data"
            class="space-y-6 rounded-3xl border border-neutral-200/70 bg-white p-5 shadow-sm sm:p-8">
            @csrf
            @method('PUT')
            <div class="grid gap-5 md:grid-cols-2">
                <div>
                    <label for="categories" class="mb-1.5 block text-xs font-bold text-neutral-700">Kategori <span class="text-red-500">*</span></label>
                    <select id="categories" name="categories" required class="w-full rounded-xl border border-neutral-300 bg-[#FAF5F2] px-3 py-3 text-sm">
                        @foreach ($adminCategories as $category)
                            <option value="{{ $category->id }}" @selected(old('categories', $product->categories) === $category->id)>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="name" class="mb-1.5 block text-xs font-bold text-neutral-700">Nama Produk <span class="text-red-500">*</span></label>
                    <input id="name" name="name" value="{{ old('name', $product->name) }}" required maxlength="255"
                        class="w-full rounded-xl border border-neutral-300 bg-[#FAF5F2] px-4 py-3 text-sm">
                </div>
                <div>
                    <label for="price" class="mb-1.5 block text-xs font-bold text-neutral-700">Harga <span class="text-red-500">*</span></label>
                    <input id="price" name="price" type="number" min="0" step="0.01" value="{{ old('price', $product->price) }}" required
                        class="w-full rounded-xl border border-neutral-300 bg-[#FAF5F2] px-4 py-3 text-sm">
                </div>
                <div>
                    <label for="image" class="mb-1.5 block text-xs font-bold text-neutral-700">Ganti Gambar Produk</label>
                    <input id="image" type="file" name="image" accept=".jpg,.jpeg,.png,image/jpeg,image/png"
                        class="w-full rounded-xl border border-neutral-300 bg-[#FAF5F2] px-3 py-2.5 text-sm">
                    <p class="mt-1.5 text-[11px] text-neutral-500">Kosongkan jika tidak ingin mengganti gambar.</p>
                </div>
                <div class="md:col-span-2">
                    <img src="{{ $product->thumbnail_img ?: asset('images/placeholder.jpg') }}" alt="{{ $product->name }}"
                        class="h-28 w-28 rounded-xl object-cover">
                </div>
                <div class="md:col-span-2">
                    <label for="affiliate_url" class="mb-1.5 block text-xs font-bold text-neutral-700">Link Afiliasi Produk <span class="text-red-500">*</span></label>
                    <input id="affiliate_url" name="affiliate_url" type="url" value="{{ old('affiliate_url', $product->affiliate_url) }}" required maxlength="2048"
                        class="w-full rounded-xl border border-neutral-300 bg-[#FAF5F2] px-4 py-3 text-sm">
                </div>
                <div class="md:col-span-2">
                    <label for="description" class="mb-1.5 block text-xs font-bold text-neutral-700">Deskripsi</label>
                    <textarea id="description" name="description" rows="4"
                        class="w-full rounded-xl border border-neutral-300 bg-[#FAF5F2] px-4 py-3 text-sm">{{ old('description', $product->description) }}</textarea>
                </div>
            </div>
            <div class="flex justify-end">
                <button type="submit" class="rounded-xl bg-[#5F8C72] px-5 py-3 text-xs font-bold text-white hover:bg-[#4f755e]">Simpan Perubahan</button>
            </div>
        </form>
    </main>
</body>

</html>
