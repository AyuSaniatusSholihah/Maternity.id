<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $event ? 'Edit Event' : 'Tambah Event' }} - Maternity.id</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
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
                <a href="{{ route('admin.event') }}"
                    class="mb-3 inline-flex items-center gap-2 text-xs font-semibold text-[#5F8C72] hover:text-[#4f755e]">
                    <i class="fa-solid fa-arrow-left"></i>
                    Kembali ke daftar event
                </a>
                <h1 class="font-serif-brand text-2xl font-bold text-neutral-900">
                    {{ $event ? 'Edit Pelatihan' : 'Tambah Pelatihan Baru' }}</h1>
                <p class="mt-1 text-xs text-neutral-500">
                    {{ $event ? 'Perbarui data pelatihan yang tersimpan.' : 'Isi data sesuai struktur event untuk menerbitkan pelatihan.' }}
                </p>
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

        <form action="{{ $event ? route('admin.event.update', $event->slug) : route('admin.event.store') }}"
            method="POST" class="space-y-6 rounded-3xl border border-neutral-200/70 bg-white p-5 shadow-sm sm:p-8">
            @csrf
            @if ($event)
                @method('PUT')
            @endif

            <div class="grid gap-5 md:grid-cols-2">
                <div class="md:col-span-2">
                    <label for="title" class="mb-1.5 block text-xs font-bold text-neutral-700">Judul Event <span
                            class="text-red-500">*</span></label>
                    <input id="title" name="title" value="{{ old('title', $event?->title) }}" required
                        maxlength="255"
                        class="w-full rounded-xl border border-neutral-300 bg-[#FAF5F2] px-4 py-3 text-sm focus:border-[#5F8C72] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#5F8C72]/20"
                        placeholder="Contoh: Workshop Yoga Prenatal">
                </div>

                <div>
                    <label for="categories" class="mb-1.5 block text-xs font-bold text-neutral-700">Kategori <span
                            class="text-red-500">*</span></label>
                    <select id="categories" name="categories" required
                        class="w-full rounded-xl border border-neutral-300 bg-[#FAF5F2] px-3 py-3 text-sm focus:border-[#5F8C72] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#5F8C72]/20">
                        <option value="">Pilih kategori</option>
                        @foreach ($adminCategories as $category)
                            <option value="{{ $category->id }}" @selected(old('categories', $event?->categories) === $category->id)>{{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="speaker" class="mb-1.5 block text-xs font-bold text-neutral-700">Pembicara <span
                            class="text-red-500">*</span></label>
                    <input id="speaker" name="speaker" value="{{ old('speaker', $event?->speaker) }}" required
                        maxlength="255"
                        class="w-full rounded-xl border border-neutral-300 bg-[#FAF5F2] px-4 py-3 text-sm focus:border-[#5F8C72] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#5F8C72]/20"
                        placeholder="Nama pembicara atau mentor">
                </div>

                <div>
                    <label for="event_date" class="mb-1.5 block text-xs font-bold text-neutral-700">Tanggal Event <span
                            class="text-red-500">*</span></label>
                    <input id="event_date" type="date" name="event_date"
                        value="{{ old('event_date', $event?->event_date?->format('Y-m-d')) }}" required
                        class="w-full rounded-xl border border-neutral-300 bg-[#FAF5F2] px-4 py-3 text-sm focus:border-[#5F8C72] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#5F8C72]/20">
                </div>
                <div>
                    <label for="location" class="mb-1.5 block text-xs font-bold text-neutral-700">Lokasi <span
                            class="text-red-500">*</span></label>
                    <input id="location" name="location" value="{{ old('location', $event?->location) }}" required
                        maxlength="255"
                        class="w-full rounded-xl border border-neutral-300 bg-[#FAF5F2] px-4 py-3 text-sm focus:border-[#5F8C72] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#5F8C72]/20"
                        placeholder="Lokasi atau tautan platform online">
                </div>

                <div>
                    <label for="open_registration_date"
                        class="mb-1.5 block text-xs font-bold text-neutral-700">Pendaftaran Dibuka <span
                            class="text-red-500">*</span></label>
                    <input id="open_registration_date" type="date" name="open_registration_date"
                        value="{{ old('open_registration_date', $event?->open_registration_date?->format('Y-m-d')) }}"
                        required
                        class="w-full rounded-xl border border-neutral-300 bg-[#FAF5F2] px-4 py-3 text-sm focus:border-[#5F8C72] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#5F8C72]/20">
                </div>
                <div>
                    <label for="close_registration_date"
                        class="mb-1.5 block text-xs font-bold text-neutral-700">Pendaftaran Ditutup <span
                            class="text-red-500">*</span></label>
                    <input id="close_registration_date" type="date" name="close_registration_date"
                        value="{{ old('close_registration_date', $event?->close_registration_date?->format('Y-m-d')) }}"
                        required
                        class="w-full rounded-xl border border-neutral-300 bg-[#FAF5F2] px-4 py-3 text-sm focus:border-[#5F8C72] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#5F8C72]/20">
                </div>

                <div>
                    <label for="slot" class="mb-1.5 block text-xs font-bold text-neutral-700">Kuota Peserta <span
                            class="text-red-500">*</span></label>
                    <input id="slot" type="number" min="1" name="slot"
                        value="{{ old('slot', $event?->slot ?? 100) }}" required
                        class="w-full rounded-xl border border-neutral-300 bg-[#FAF5F2] px-4 py-3 text-sm focus:border-[#5F8C72] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#5F8C72]/20">
                </div>
                <div>
                    <label for="fee" class="mb-1.5 block text-xs font-bold text-neutral-700">Biaya <span
                            class="text-red-500">*</span></label>
                    <input id="fee" type="number" min="0" name="fee"
                        value="{{ old('fee', $event?->fee ?? 0) }}" required
                        class="w-full rounded-xl border border-neutral-300 bg-[#FAF5F2] px-4 py-3 text-sm focus:border-[#5F8C72] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#5F8C72]/20">
                </div>

                <div class="md:col-span-2">
                    <label for="image_url" class="mb-1.5 block text-xs font-bold text-neutral-700">URL Gambar</label>
                    <input id="image_url" type="url" name="image_url"
                        value="{{ old('image_url', $event?->image_url) }}" maxlength="255"
                        class="w-full rounded-xl border border-neutral-300 bg-[#FAF5F2] px-4 py-3 text-sm focus:border-[#5F8C72] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#5F8C72]/20"
                        placeholder="https://...">
                </div>

                <div class="md:col-span-2">
                    <label for="description" class="mb-1.5 block text-xs font-bold text-neutral-700">Deskripsi <span
                            class="text-red-500">*</span></label>
                    <textarea id="description" name="description" rows="6" required
                        class="w-full rounded-xl border border-neutral-300 bg-[#FAF5F2] px-4 py-3 text-sm focus:border-[#5F8C72] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#5F8C72]/20"
                        placeholder="Jelaskan materi dan tujuan event">{{ old('description', $event?->description) }}</textarea>
                </div>
            </div>

            @if ($event)
                @php
                    $selectedMaterials = old('materials', $event->materials->pluck('id')->all());
                    $materialOptions = $adminMaterials
                        ->map(
                            fn($material) => [
                                'id' => $material->id,
                                'title' => $material->title,
                                'description' => $material->description,
                            ],
                        )
                        ->values();
                @endphp
                <section x-data="{
                    availableMaterials: {{ Illuminate\Support\Js::from($materialOptions)->toHtml() }},
                    selectedIds: {{ Illuminate\Support\Js::from($selectedMaterials)->toHtml() }},
                    selectedForAdd: '',
                    get linkedMaterials() {
                        return this.selectedIds
                            .map(id => this.availableMaterials.find(material => material.id === id))
                            .filter(Boolean);
                    },
                    get unlinkedMaterials() {
                        return this.availableMaterials.filter(material => !this.selectedIds.includes(material.id));
                    },
                    addMaterial() {
                        if (this.selectedForAdd && !this.selectedIds.includes(this.selectedForAdd)) {
                            this.selectedIds.push(this.selectedForAdd);
                            this.selectedForAdd = '';
                        }
                    },
                    removeMaterial(id) {
                        this.selectedIds = this.selectedIds.filter(materialId => materialId !== id);
                    }
                }" class="space-y-4 border-t border-neutral-100 pt-5">
                    <div>
                        <h2 class="text-sm font-bold text-neutral-900">E-Book untuk Event</h2>
                        <p class="mt-1 text-xs text-neutral-500">Daftar e-book yang saat ini terkait dengan event.</p>
                    </div>
                    @if ($adminMaterials->isNotEmpty())
                        <div class="overflow-x-auto rounded-xl border border-neutral-200">
                            <table class="w-full min-w-[520px] text-left text-xs">
                                <thead>
                                    <tr
                                        class="border-b border-neutral-100 bg-neutral-50 text-[11px] font-semibold text-neutral-500">
                                        <th class="px-4 py-3">E-Book</th>
                                        <th class="px-4 py-3">Deskripsi</th>
                                        <th class="px-4 py-3 text-right">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-neutral-100">
                                    <template x-for="material in linkedMaterials" :key="material.id">
                                        <tr>
                                            <td class="px-4 py-3 font-semibold text-neutral-800"
                                                x-text="material.title"></td>
                                            <td class="px-4 py-3 text-neutral-600" x-text="material.description"></td>
                                            <td class="px-4 py-3 text-right">
                                                <button type="button" @click="removeMaterial(material.id)"
                                                    :aria-label="'Remove ' + material.title"
                                                    class="inline-flex h-8 w-8 items-center justify-center rounded-lg text-neutral-500 transition hover:bg-red-50 hover:text-red-600"
                                                    title="Hapus e-book dari event">
                                                    <i class="fa-solid fa-xmark"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </template>
                                    <template x-if="linkedMaterials.length === 0">
                                        <tr>
                                            <td colspan="3" class="px-4 py-8 text-center text-neutral-500">Belum
                                                ada e-book yang terkait.</td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                        </div>

                        <template x-for="materialId in selectedIds" :key="'selected-' + materialId">
                            <input type="hidden" name="materials[]" :value="materialId">
                        </template>

                        <div class="flex flex-col gap-2 sm:flex-row">
                            <select x-model="selectedForAdd"
                                class="min-w-0 flex-1 rounded-xl border border-neutral-300 bg-[#FAF5F2] px-3 py-2.5 text-xs focus:border-[#5F8C72] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#5F8C72]/20">
                                <option value="">Pilih e-book untuk ditambahkan</option>
                                <template x-for="material in unlinkedMaterials" :key="'option-' + material.id">
                                    <option :value="material.id" x-text="material.title"></option>
                                </template>
                            </select>
                            <button type="button" @click="addMaterial" :disabled="!selectedForAdd"
                                class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#5F8C72] px-4 py-2.5 text-xs font-bold text-white transition hover:bg-[#4f755e] disabled:cursor-not-allowed disabled:opacity-50">
                                <i class="fa-solid fa-plus"></i>
                                <span>Tambah E-Book</span>
                            </button>
                        </div>
                    @else
                        <p class="rounded-xl bg-neutral-50 p-4 text-xs text-neutral-500">Belum ada e-book. Tambahkan
                            e-book terlebih dahulu melalui halaman E-Book.</p>
                    @endif
                </section>
            @endif

            <div class="flex items-center justify-end gap-3 border-t border-neutral-100 pt-5">
                <a href="{{ route('admin.event') }}"
                    class="rounded-xl px-5 py-3 text-xs font-semibold text-neutral-600 hover:bg-neutral-100">Batal</a>
                <button type="submit"
                    class="rounded-xl bg-[#5F8C72] px-5 py-3 text-xs font-bold text-white shadow-sm transition hover:bg-[#4f755e]">
                    <i class="fa-solid fa-calendar-plus mr-2"></i>{{ $event ? 'Simpan Perubahan' : 'Simpan Event' }}
                </button>
            </div>
        </form>
    </main>
</body>

</html>
