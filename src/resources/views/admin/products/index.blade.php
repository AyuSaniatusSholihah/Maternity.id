<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('logologin.png') }}">
    <title>Produk Afiliasi - Maternity.id</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-[#FAF5F2] text-neutral-800 antialiased">
    <main class="mx-auto max-w-6xl px-4 py-6 sm:px-6 sm:py-10">
        <div class="mb-6 flex flex-wrap items-end justify-between gap-4">
            <div>
                <a href="{{ route('admin.dashboard') }}" class="mb-3 inline-flex items-center gap-2 text-xs font-semibold text-[#5F8C72]">
                    <span aria-hidden="true">&larr;</span> Kembali ke dashboard
                </a>
                <h1 class="text-2xl font-bold text-neutral-900">Produk Afiliasi</h1>
                <p class="mt-1 text-xs text-neutral-500">Kelola gambar, informasi, dan link afiliasi produk.</p>
            </div>
            <a href="{{ route('admin.product.create') }}"
                class="inline-flex items-center gap-2 rounded-xl bg-[#5F8C72] px-4 py-3 text-xs font-bold text-white hover:bg-[#4f755e]">
                <span aria-hidden="true">+</span> Tambah Produk
            </a>
        </div>

        @if (session('status'))
            <div class="mb-5 rounded-2xl border border-emerald-200 bg-emerald-50 p-4 text-xs text-emerald-700">
                {{ session('status') }}
            </div>
        @endif

        <div class="grid gap-5 lg:grid-cols-[220px_minmax(0,1fr)] lg:items-start">
            <aside class="flex gap-2 overflow-x-auto rounded-3xl border border-neutral-200/70 bg-white p-3 shadow-sm lg:sticky lg:top-5 lg:block lg:space-y-1">
                <p class="hidden px-3 py-2 text-[10px] font-bold uppercase tracking-wider text-neutral-400 lg:block">Menu Admin</p>
                <a href="{{ route('admin.dashboard') }}" class="shrink-0 rounded-xl px-3 py-2.5 text-xs font-semibold text-neutral-600 hover:bg-[#FAF5F2]">
                    Dashboard
                </a>
                <a href="{{ route('admin.users') }}" class="shrink-0 rounded-xl px-3 py-2.5 text-xs font-semibold text-neutral-600 hover:bg-[#FAF5F2]">
                    Pengguna
                </a>
                <a href="{{ route('admin.event') }}" class="shrink-0 rounded-xl px-3 py-2.5 text-xs font-semibold text-neutral-600 hover:bg-[#FAF5F2]">
                    Event & Pelatihan
                </a>
                <a href="{{ route('admin.ebook') }}" class="shrink-0 rounded-xl px-3 py-2.5 text-xs font-semibold text-neutral-600 hover:bg-[#FAF5F2]">
                    E-Book
                </a>
                <a href="{{ route('admin.product') }}" class="shrink-0 rounded-xl bg-[#B8E6B8] px-3 py-2.5 text-xs font-bold text-neutral-900">
                    Produk Afiliasi
                </a>
                <a href="{{ route('admin.voucher') }}" class="shrink-0 rounded-xl px-3 py-2.5 text-xs font-semibold text-neutral-600 hover:bg-[#FAF5F2]">
                    Voucher
                </a>
            </aside>

            <div class="overflow-x-auto rounded-3xl border border-neutral-200/70 bg-white shadow-sm">
            <table class="w-full min-w-[720px] text-left text-xs">
                <thead class="border-b border-neutral-200 bg-neutral-50 text-neutral-500">
                    <tr>
                        <th class="px-4 py-3 font-bold">Produk</th>
                        <th class="px-4 py-3 font-bold">Kategori</th>
                        <th class="px-4 py-3 font-bold">Harga</th>
                        <th class="px-4 py-3 text-right font-bold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-100">
                    @forelse ($products as $product)
                        <tr>
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-3">
                                    <img src="{{ $product->thumbnail_img ?: asset('images/placeholder.jpg') }}"
                                        alt="{{ $product->name }}" class="h-14 w-14 rounded-xl object-cover">
                                    <div>
                                        <p class="font-bold text-neutral-800">{{ $product->name }}</p>
                                        <a href="{{ $product->affiliate_url }}" target="_blank" rel="noopener noreferrer"
                                            class="mt-1 block max-w-xs truncate text-[11px] text-[#5F8C72]">{{ $product->affiliate_url }}</a>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-neutral-500">{{ $product->category?->name ?? '-' }}</td>
                            <td class="px-4 py-3 font-semibold text-neutral-700">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                            <td class="px-4 py-3">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.product.edit', $product->id) }}"
                                        class="rounded-lg bg-[#FAF0EE] px-3 py-2 font-bold text-[#8C433C] hover:bg-[#F2DAD5]">Edit</a>
                                    <form action="{{ route('admin.product.destroy', $product->id) }}" method="POST"
                                        onsubmit="return confirm('Hapus produk ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="rounded-lg bg-red-50 px-3 py-2 font-bold text-red-600 hover:bg-red-100">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-10 text-center text-neutral-500">Belum ada produk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            </div>
        </div>
    </main>
</body>

</html>
