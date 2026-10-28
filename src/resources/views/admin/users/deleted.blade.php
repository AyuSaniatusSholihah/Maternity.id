<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deleted Users - Maternity.id</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=DM+Serif+Display&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="min-h-screen bg-[#FAF5F2] text-neutral-800 antialiased">
    <main class="mx-auto max-w-6xl px-4 py-6 sm:px-6 sm:py-10">
        <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <a href="{{ route('admin.users') }}"
                    class="mb-3 inline-flex items-center gap-2 text-xs font-semibold text-[#5F8C72] hover:text-[#4f755e]">
                    <i class="fa-solid fa-arrow-left"></i>
                    Kembali ke Manage Users
                </a>
                <h1 class="font-serif-brand text-2xl font-bold text-neutral-900">Deleted Users</h1>
                <p class="mt-1 text-xs text-neutral-500">Akun yang dihapus tetap tersimpan dan dapat dipulihkan.</p>
            </div>
            <span
                class="inline-flex self-start rounded-full bg-red-50 px-3 py-1.5 text-[10px] font-bold text-red-700 sm:self-auto">
                <i class="fa-solid fa-trash-can mr-2"></i>{{ $users->count() }} akun dihapus
            </span>
        </div>

        @if (session('status'))
            <div
                class="mb-5 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-xs font-semibold text-emerald-800">
                {{ session('status') }}
            </div>
        @endif

        <section class="overflow-hidden rounded-2xl border border-neutral-200/70 bg-white shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="border-b border-neutral-100 text-[11px] font-semibold text-neutral-500">
                            <th class="px-4 py-3">User</th>
                            <th class="px-4 py-3">Email</th>
                            <th class="px-4 py-3">Role</th>
                            <th class="px-4 py-3">Deleted At</th>
                            <th class="px-4 py-3 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-neutral-100">
                        @forelse ($users as $user)
                            <tr class="hover:bg-[#FAF5F2]/60">
                                <td class="px-4 py-3.5">
                                    <p class="font-bold text-neutral-900">{{ $user->name }}</p>
                                    <p class="mt-0.5 text-[10px] text-neutral-500">{{ $user->id }}</p>
                                </td>
                                <td class="px-4 py-3.5 text-neutral-600">{{ $user->email }}</td>
                                <td class="px-4 py-3.5">
                                    <span
                                        class="rounded-full bg-[#E4F5E6] px-2.5 py-1 text-[10px] font-bold uppercase text-[#428E53]">{{ $user->role }}</span>
                                </td>
                                <td class="px-4 py-3.5 text-neutral-600">{{ $user->deleted_at?->format('d M Y, H:i') }}
                                </td>
                                <td class="px-4 py-3.5 text-right">
                                    <form action="{{ route('admin.users.restore', $user->id) }}" method="POST"
                                        onsubmit="return confirm('Recover this account?')">
                                        @csrf
                                        <button type="submit"
                                            class="inline-flex items-center gap-2 rounded-lg bg-[#E4F5E6] px-3 py-2 text-[11px] font-bold text-[#347746] transition hover:bg-[#d3ecd7]">
                                            <i class="fa-solid fa-rotate-left"></i>
                                            Restore
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-14 text-center text-sm text-neutral-500">
                                    <i class="fa-regular fa-circle-check mb-3 block text-2xl text-[#5F8C72]"></i>
                                    No deleted users.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</body>

</html>
