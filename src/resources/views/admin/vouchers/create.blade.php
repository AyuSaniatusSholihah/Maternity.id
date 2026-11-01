<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Voucher - Maternity.id</title>
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
    @php
        $isEditing = $voucher !== null;
        $selectedEventValues = collect(old('events', $selectedEvents ?? []))->map(fn($id) => (string) $id)->values();
        $selectedPlanValues = collect(old('subscription_plans', $selectedSubscriptionPlans ?? []))
            ->map(fn($code) => (string) $code)
            ->values();
    @endphp
    <main class="mx-auto max-w-5xl px-4 py-6 sm:px-6 sm:py-10">
        <div class="mb-6 flex items-center justify-between gap-4">
            <div>
                <a href="{{ route('admin.voucher') }}"
                    class="mb-3 inline-flex items-center gap-2 text-xs font-semibold text-[#5F8C72] hover:text-[#4f755e]">
                    <i class="fa-solid fa-arrow-left"></i>
                    Kembali ke daftar voucher
                </a>
                <h1 class="font-serif-brand text-2xl font-bold text-neutral-900">
                    {{ $isEditing ? 'Edit Voucher' : 'Tambah Voucher' }}</h1>
                <p class="mt-1 text-xs text-neutral-500">Atur diskon, masa berlaku, dan layanan yang dapat menggunakan
                    voucher.</p>
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

        <form action="{{ $isEditing ? route('admin.voucher.update', $voucher->id) : route('admin.voucher.store') }}"
            method="POST" class="space-y-6 rounded-3xl border border-neutral-200/70 bg-white p-5 shadow-sm sm:p-8">
            @csrf
            @if ($isEditing)
                @method('PUT')
            @endif

            <div class="grid gap-5 md:grid-cols-2">
                <div>
                    <label for="discount" class="mb-1.5 block text-xs font-bold text-neutral-700">Diskon (%) <span
                            class="text-red-500">*</span></label>
                    <input id="discount" name="discount" type="number" min="0.01" max="100" step="0.01"
                        required
                        value="{{ old('discount', $voucher ? number_format((float) $voucher->discount, 2, '.', '') : '') }}"
                        class="w-full rounded-xl border border-neutral-300 bg-[#FAF5F2] px-4 py-3 text-sm focus:border-[#5F8C72] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#5F8C72]/20">
                </div>
                <div>
                    <label for="maximum_discount" class="mb-1.5 block text-xs font-bold text-neutral-700">Maksimum
                        Diskon (Rp)</label>
                    <input id="maximum_discount" name="maximum_discount" type="number" min="0" step="1"
                        value="{{ old('maximum_discount', $voucher?->maximum_discount) }}"
                        class="w-full rounded-xl border border-neutral-300 bg-[#FAF5F2] px-4 py-3 text-sm focus:border-[#5F8C72] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#5F8C72]/20"
                        placeholder="Kosongkan untuk tanpa batas">
                </div>
                <div>
                    <label for="valid_from" class="mb-1.5 block text-xs font-bold text-neutral-700">Berlaku Dari <span
                            class="text-red-500">*</span></label>
                    <input id="valid_from" name="valid_from" type="datetime-local" required
                        value="{{ old('valid_from', $voucher ? \Illuminate\Support\Carbon::parse($voucher->valid_from)->format('Y-m-d\TH:i') : '') }}"
                        class="w-full rounded-xl border border-neutral-300 bg-[#FAF5F2] px-4 py-3 text-sm focus:border-[#5F8C72] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#5F8C72]/20">
                </div>
                <div>
                    <label for="valid_until" class="mb-1.5 block text-xs font-bold text-neutral-700">Berlaku
                        Sampai</label>
                    <input id="valid_until" name="valid_until" type="datetime-local"
                        value="{{ old('valid_until', $voucher?->valid_until ? \Illuminate\Support\Carbon::parse($voucher->valid_until)->format('Y-m-d\TH:i') : '') }}"
                        class="w-full rounded-xl border border-neutral-300 bg-[#FAF5F2] px-4 py-3 text-sm focus:border-[#5F8C72] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#5F8C72]/20">
                </div>
                <div>
                    <label for="max_redem" class="mb-1.5 block text-xs font-bold text-neutral-700">Maksimum Penukaran
                        <span class="text-red-500">*</span></label>
                    <input id="max_redem" name="max_redem" type="number" min="0" step="1" required
                        value="{{ old('max_redem', $voucher?->max_redem) }}"
                        class="w-full rounded-xl border border-neutral-300 bg-[#FAF5F2] px-4 py-3 text-sm focus:border-[#5F8C72] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#5F8C72]/20">
                </div>
                <div>
                    <label for="is_usable" class="mb-1.5 block text-xs font-bold text-neutral-700">Status <span
                            class="text-red-500">*</span></label>
                    <select id="is_usable" name="is_usable" required
                        class="w-full rounded-xl border border-neutral-300 bg-[#FAF5F2] px-3 py-3 text-sm focus:border-[#5F8C72] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#5F8C72]/20">
                        <option value="1" @selected((string) old('is_usable', $voucher ? (int) $voucher->is_usable : 1) === '1')>Aktif</option>
                        <option value="0" @selected((string) old('is_usable', $voucher ? (int) $voucher->is_usable : 1) === '0')>Nonaktif</option>
                    </select>
                </div>
            </div>

            <section class="space-y-4 border-t border-neutral-100 pt-5">
                <div>
                    <h2 class="text-sm font-bold text-neutral-900">Layanan yang Berlaku</h2>
                    <p class="mt-1 text-xs text-neutral-500">Pilih event dan paket langganan yang dapat menggunakan
                        voucher.</p>
                </div>

                <div>
                    <h3 class="mb-2 text-xs font-bold text-neutral-700">Events</h3>
                    @if ($events->isNotEmpty())
                        @php
                            $eventOptions = $events
                                ->map(fn($event) => ['id' => $event->id, 'title' => $event->title])
                                ->values();
                            $selectedEventIds = $selectedEventValues;
                        @endphp
                        <div x-data="{
                            events: {{ Illuminate\Support\Js::from($eventOptions)->toHtml() }},
                            selectedIds: {{ Illuminate\Support\Js::from($selectedEventIds)->toHtml() }},
                            search: '',
                            open: false,
                            get selectedEvents() {
                                return this.selectedIds
                                    .map(id => this.events.find(event => event.id === id))
                                    .filter(Boolean);
                            },
                            get filteredEvents() {
                                const query = this.search.trim().toLowerCase();
                                return this.events.filter(event =>
                                    !this.selectedIds.includes(event.id) &&
                                    event.title.toLowerCase().includes(query)
                                );
                            },
                            toggleEvent(id) {
                                if (this.selectedIds.includes(id)) {
                                    this.selectedIds = this.selectedIds.filter(selectedId => selectedId !== id);
                                } else {
                                    this.selectedIds.push(id);
                                }
                                this.search = '';
                            },
                            removeEvent(id) {
                                this.selectedIds = this.selectedIds.filter(selectedId => selectedId !== id);
                            }
                        }" @click.outside="open = false" class="relative space-y-2">
                            <div
                                class="flex min-h-11 flex-wrap items-center gap-2 rounded-xl border border-neutral-300 bg-white p-2 focus-within:border-[#5F8C72] focus-within:ring-2 focus-within:ring-[#5F8C72]/20">
                                <template x-for="event in selectedEvents" :key="'selected-event-' + event.id">
                                    <span
                                        class="inline-flex max-w-full items-center gap-2 rounded-lg bg-[#E4F5E6] px-2.5 py-1.5 text-xs font-semibold text-[#347746]">
                                        <span class="truncate" x-text="event.title"></span>
                                        <button type="button" @click="removeEvent(event.id)"
                                            :aria-label="'Remove ' + event.title"
                                            class="shrink-0 text-[#347746] hover:text-red-600"
                                            title="Hapus event terpilih">
                                            <i class="fa-solid fa-xmark"></i>
                                        </button>
                                    </span>
                                </template>
                                <input type="search" x-model="search" @focus="open = true" @input="open = true"
                                    @keydown.escape="open = false"
                                    @keydown.enter.prevent="if (filteredEvents.length) toggleEvent(filteredEvents[0].id)"
                                    placeholder="Cari dan pilih beberapa event..." autocomplete="off"
                                    class="min-w-[180px] flex-1 border-0 bg-transparent px-2 py-1 text-xs text-neutral-800 placeholder-neutral-400 focus:outline-none focus:ring-0">
                                <i class="fa-solid fa-magnifying-glass px-2 text-xs text-neutral-400"></i>
                            </div>

                            <template x-for="eventId in selectedIds" :key="'event-input-' + eventId">
                                <input type="hidden" name="events[]" :value="eventId">
                            </template>

                            <div x-show="open" x-transition
                                class="absolute z-20 mt-1 max-h-56 w-full overflow-y-auto rounded-xl border border-neutral-200 bg-white py-1 shadow-lg">
                                <template x-for="event in filteredEvents" :key="'event-option-' + event.id">
                                    <button type="button" @click="toggleEvent(event.id)"
                                        class="flex w-full items-center justify-between px-3 py-2.5 text-left text-xs text-neutral-700 transition hover:bg-[#FAF5F2]">
                                        <span x-text="event.title"></span>
                                        <i class="fa-solid fa-plus text-[10px] text-[#5F8C72]"></i>
                                    </button>
                                </template>
                                <p x-show="filteredEvents.length === 0" class="px-3 py-3 text-xs text-neutral-500"
                                    x-text="search ? 'Tidak ada event yang cocok.' : 'Semua event sudah dipilih.'"></p>
                            </div>
                        </div>
                    @else
                        <p class="rounded-xl bg-neutral-50 p-3 text-xs text-neutral-500">Belum ada event.</p>
                    @endif
                </div>

                <div>
                    <h3 class="mb-2 text-xs font-bold text-neutral-700">Paket Langganan</h3>
                    <div class="grid gap-2 sm:grid-cols-2">
                        @forelse ($subscriptionPlans as $plan)
                            <label for="plan-{{ $plan->code }}"
                                class="flex items-start gap-3 rounded-xl border border-neutral-200 bg-[#FAF5F2]/60 p-3 text-xs">
                                <input id="plan-{{ $plan->code }}" type="checkbox" name="subscription_plans[]"
                                    value="{{ $plan->code }}" @checked($selectedPlanValues->contains((string) $plan->code))
                                    class="mt-0.5 h-4 w-4 rounded border-neutral-300 text-[#5F8C72] focus:ring-[#5F8C72]">
                                <span>
                                    <span
                                        class="block font-semibold text-neutral-800">{{ $plan->name ?? $plan->code }}</span>
                                    <span class="mt-0.5 block text-neutral-500">Rp
                                        {{ number_format($plan->price, 0, ',', '.') }}</span>
                                </span>
                            </label>
                        @empty
                            <p class="rounded-xl bg-neutral-50 p-3 text-xs text-neutral-500">Belum ada paket langganan.
                            </p>
                        @endforelse
                    </div>
                </div>
            </section>

            <div class="flex items-center justify-end gap-3 border-t border-neutral-100 pt-5">
                <a href="{{ route('admin.voucher') }}"
                    class="rounded-xl px-5 py-3 text-xs font-semibold text-neutral-600 hover:bg-neutral-100">Batal</a>
                <button type="submit"
                    class="rounded-xl bg-[#5F8C72] px-5 py-3 text-xs font-bold text-white shadow-sm transition hover:bg-[#4f755e]">
                    <i class="fa-solid fa-ticket mr-2"></i>{{ $isEditing ? 'Simpan Perubahan' : 'Simpan Voucher' }}
                </button>
            </div>
        </form>
    </main>
</body>

</html>
