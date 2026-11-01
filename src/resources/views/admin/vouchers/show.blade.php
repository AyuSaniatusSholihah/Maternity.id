<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Voucher - Maternity.id</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=DM+Serif+Display&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="min-h-screen bg-[#FAF5F2] text-neutral-800 antialiased">
    @php
        $redemptionCount = $eventRegistrations->count() + $subscriptionPayments->count();
        $remainingRedemptions = max(0, (int) $voucher->max_redem - $redemptionCount);
    @endphp
    <main class="mx-auto max-w-6xl space-y-6 px-4 py-6 sm:px-6 sm:py-10">
        <header class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <a href="{{ route('admin.voucher') }}"
                    class="mb-3 inline-flex items-center gap-2 text-xs font-semibold text-[#5F8C72] hover:text-[#4f755e]">
                    <i class="fa-solid fa-arrow-left"></i> Kembali ke daftar voucher
                </a>
                <h1 class="font-serif-brand text-2xl font-bold text-neutral-900">Detail Voucher</h1>
                <p class="mt-1 break-all font-mono text-xs text-neutral-500">{{ $voucher->id }}</p>
            </div>
            <div class="flex flex-wrap items-center gap-2">
                <form action="{{ route('admin.voucher.toggle', $voucher->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit"
                        class="inline-flex items-center gap-2 rounded-xl border border-neutral-300 bg-white px-4 py-2.5 text-xs font-bold text-neutral-700 transition hover:bg-neutral-50">
                        <i
                            class="fa-solid {{ $voucher->is_usable ? 'fa-toggle-on text-[#5F8C72]' : 'fa-toggle-off text-neutral-400' }}"></i>
                        {{ $voucher->is_usable ? 'Nonaktifkan' : 'Aktifkan' }}
                    </button>
                </form>
                <a href="{{ route('admin.voucher.edit', $voucher->id) }}"
                    class="inline-flex items-center gap-2 rounded-xl bg-[#5F8C72] px-4 py-2.5 text-xs font-bold text-white transition hover:bg-[#4f755e]">
                    <i class="fa-solid fa-pen-to-square"></i> Edit
                </a>
                <form action="{{ route('admin.voucher.destroy', $voucher->id) }}" method="POST"
                    onsubmit="return confirm('Hapus voucher ini? Riwayat penukaran akan tetap ada, tetapi tautan voucher akan dilepas.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="inline-flex items-center gap-2 rounded-xl bg-red-50 px-4 py-2.5 text-xs font-bold text-red-700 transition hover:bg-red-100">
                        <i class="fa-solid fa-trash-can"></i> Hapus
                    </button>
                </form>
            </div>
        </header>

        @if (session('status'))
            <div
                class="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-xs font-semibold text-emerald-800">
                {{ session('status') }}
            </div>
        @endif

        <section class="border-y border-neutral-200 bg-white py-5">
            <div class="mb-4 flex items-center justify-between gap-3">
                <h2 class="text-sm font-bold text-neutral-900">Informasi Voucher</h2>
                <span
                    class="inline-flex rounded-full px-2.5 py-1 text-[10px] font-bold {{ $voucher->is_usable ? 'bg-[#E4F5E6] text-[#428E53]' : 'bg-neutral-100 text-neutral-500' }}">
                    {{ $voucher->is_usable ? 'Aktif' : 'Nonaktif' }}
                </span>
            </div>
            <dl class="grid gap-x-8 gap-y-5 sm:grid-cols-2 lg:grid-cols-4">
                <div>
                    <dt class="text-[10px] font-semibold uppercase text-neutral-500">Diskon</dt>
                    <dd class="mt-1 text-sm font-bold text-[#5F8C72]">
                        {{ rtrim(rtrim(number_format((float) $voucher->discount, 2), '0'), '.') }}%</dd>
                </div>
                <div>
                    <dt class="text-[10px] font-semibold uppercase text-neutral-500">Maksimum Diskon</dt>
                    <dd class="mt-1 text-sm font-semibold text-neutral-800">
                        {{ $voucher->maximum_discount === null ? 'Tanpa batas' : 'Rp ' . number_format($voucher->maximum_discount, 0, ',', '.') }}
                    </dd>
                </div>
                <div>
                    <dt class="text-[10px] font-semibold uppercase text-neutral-500">Masa Berlaku</dt>
                    <dd class="mt-1 text-sm font-semibold text-neutral-800">
                        {{ \Illuminate\Support\Carbon::parse($voucher->valid_from)->format('d M Y H:i') }}
                        <span class="text-neutral-400">sampai</span>
                        {{ $voucher->valid_until ? \Illuminate\Support\Carbon::parse($voucher->valid_until)->format('d M Y H:i') : 'Tanpa batas' }}
                    </dd>
                </div>
                <div>
                    <dt class="text-[10px] font-semibold uppercase text-neutral-500">Penukaran Tersisa</dt>
                    <dd class="mt-1 text-sm font-semibold text-neutral-800">{{ $remainingRedemptions }} <span
                            class="font-normal text-neutral-500">/ {{ $voucher->max_redem }}</span></dd>
                </div>
                <div>
                    <dt class="text-[10px] font-semibold uppercase text-neutral-500">Dibuat Oleh</dt>
                    <dd class="mt-1 text-sm font-semibold text-neutral-800">
                        {{ $voucher->creator_name ?? 'Tidak diketahui' }}</dd>
                    @if ($voucher->creator_email)
                        <dd class="mt-0.5 text-xs text-neutral-500">{{ $voucher->creator_email }}</dd>
                    @endif
                </div>
                <div>
                    <dt class="text-[10px] font-semibold uppercase text-neutral-500">Dibuat</dt>
                    <dd class="mt-1 text-sm text-neutral-700">
                        {{ \Illuminate\Support\Carbon::parse($voucher->created_at)->format('d M Y H:i') }}</dd>
                </div>
                <div>
                    <dt class="text-[10px] font-semibold uppercase text-neutral-500">Terakhir Diubah</dt>
                    <dd class="mt-1 text-sm text-neutral-700">
                        {{ \Illuminate\Support\Carbon::parse($voucher->updated_at)->format('d M Y H:i') }}</dd>
                </div>
            </dl>
        </section>

        <section class="space-y-4 border-b border-neutral-200 pb-6">
            <div class="flex items-baseline justify-between gap-3">
                <h2 class="text-sm font-bold text-neutral-900">Layanan yang Dapat Ditukarkan</h2>
                <span class="text-xs text-neutral-500">{{ $events->count() + $subscriptionPlans->count() }}
                    layanan</span>
            </div>
            <div class="grid gap-6 lg:grid-cols-2">
                <div>
                    <h3 class="mb-2 text-xs font-bold text-neutral-700">Events</h3>
                    <div class="divide-y divide-neutral-100 border-y border-neutral-200">
                        @forelse ($events as $event)
                            <div class="flex items-start justify-between gap-4 py-3">
                                <div>
                                    <p class="text-xs font-semibold text-neutral-800">{{ $event->title }}</p>
                                    <p class="mt-1 text-[11px] text-neutral-500">{{ $event->slug }}</p>
                                </div>
                                <span
                                    class="shrink-0 text-[11px] text-neutral-600">{{ \Illuminate\Support\Carbon::parse($event->event_date)->format('d M Y') }}</span>
                            </div>
                        @empty
                            <p class="py-4 text-xs text-neutral-500">Tidak ada event terkait.</p>
                        @endforelse
                    </div>
                </div>
                <div>
                    <h3 class="mb-2 text-xs font-bold text-neutral-700">Paket Langganan</h3>
                    <div class="divide-y divide-neutral-100 border-y border-neutral-200">
                        @forelse ($subscriptionPlans as $plan)
                            <div class="flex items-start justify-between gap-4 py-3">
                                <div>
                                    <p class="text-xs font-semibold text-neutral-800">{{ $plan->name ?? $plan->code }}
                                    </p>
                                    <p class="mt-1 text-[11px] text-neutral-500">{{ $plan->code }} ·
                                        {{ $plan->period }} bulan</p>
                                </div>
                                <span class="shrink-0 text-[11px] font-semibold text-neutral-700">Rp
                                    {{ number_format($plan->price, 0, ',', '.') }}</span>
                            </div>
                        @empty
                            <p class="py-4 text-xs text-neutral-500">Tidak ada paket langganan terkait.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </section>

        <section class="space-y-3">
            <div class="flex items-baseline justify-between gap-3">
                <h2 class="text-sm font-bold text-neutral-900">Penukaran Voucher</h2>
                <span class="text-xs text-neutral-500">{{ $redemptionCount }} penukaran</span>
            </div>
            <div class="overflow-x-auto border-y border-neutral-200 bg-white">
                <table class="w-full min-w-[820px] text-left text-xs">
                    <thead>
                        <tr class="border-b border-neutral-100 text-[10px] font-semibold uppercase text-neutral-500">
                            <th class="px-3 py-3">Jenis Layanan</th>
                            <th class="px-3 py-3">Layanan</th>
                            <th class="px-3 py-3">Pengguna</th>
                            <th class="px-3 py-3">Jumlah</th>
                            <th class="px-3 py-3">Status</th>
                            <th class="px-3 py-3">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-neutral-100">
                        @foreach ($eventRegistrations as $registration)
                            <tr>
                                <td class="px-3 py-3 text-neutral-600">Event</td>
                                <td class="px-3 py-3 font-semibold text-neutral-800">{{ $registration->service_name }}
                                </td>
                                <td class="px-3 py-3 text-neutral-700">
                                    {{ $registration->member_name ?? 'Unknown' }}<span
                                        class="mt-0.5 block text-[10px] text-neutral-500">{{ $registration->member_email }}</span>
                                </td>
                                <td class="px-3 py-3 text-neutral-500">-</td>
                                <td class="px-3 py-3">{{ ucfirst($registration->payment_status) }}</td>
                                <td class="px-3 py-3 whitespace-nowrap text-neutral-500">
                                    {{ \Illuminate\Support\Carbon::parse($registration->created_at)->format('d M Y H:i') }}
                                </td>
                            </tr>
                        @endforeach
                        @foreach ($subscriptionPayments as $payment)
                            <tr>
                                <td class="px-3 py-3 text-neutral-600">Langganan</td>
                                <td class="px-3 py-3 font-semibold text-neutral-800">
                                    {{ $payment->service_name ?? $payment->service_code }}<span
                                        class="mt-0.5 block text-[10px] text-neutral-500">{{ $payment->service_code }}</span>
                                </td>
                                <td class="px-3 py-3 text-neutral-700">{{ $payment->member_name ?? 'Unknown' }}<span
                                        class="mt-0.5 block text-[10px] text-neutral-500">{{ $payment->member_email }}</span>
                                </td>
                                <td class="px-3 py-3 text-neutral-700">Rp
                                    {{ number_format($payment->total_amount, 0, ',', '.') }}<span
                                        class="mt-0.5 block text-[10px] text-neutral-500">Sebelum diskon: Rp
                                        {{ number_format($payment->subamount, 0, ',', '.') }}</span></td>
                                <td class="px-3 py-3">{{ ucfirst($payment->payment_status) }}</td>
                                <td class="px-3 py-3 whitespace-nowrap text-neutral-500">
                                    {{ \Illuminate\Support\Carbon::parse($payment->created_at)->format('d M Y H:i') }}
                                </td>
                            </tr>
                        @endforeach
                        @if ($redemptionCount === 0)
                            <tr>
                                <td colspan="6" class="px-3 py-10 text-center text-neutral-500">Voucher belum
                                    pernah digunakan.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</body>

</html>
