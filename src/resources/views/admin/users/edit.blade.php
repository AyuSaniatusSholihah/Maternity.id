<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User - Maternity.id</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=DM+Serif+Display&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="min-h-screen bg-[#FAF5F2] text-neutral-800 antialiased">
    <main class="mx-auto max-w-5xl px-4 py-6 sm:px-6 sm:py-10">
        <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <a href="{{ route('admin.users') }}"
                    class="mb-3 inline-flex items-center gap-2 text-xs font-semibold text-[#5F8C72] hover:text-[#4f755e]">
                    <i class="fa-solid fa-arrow-left"></i>
                    Kembali ke daftar user
                </a>
                <h1 class="font-serif-brand text-2xl font-bold text-neutral-900">Edit User</h1>
                <p class="mt-1 text-xs text-neutral-500">Perbarui data akun dan detail peran sesuai role yang dipilih.
                </p>
            </div>
            <span class="inline-flex rounded-full bg-[#E4F5E6] px-3 py-1.5 text-[10px] font-bold text-[#428E53]">Admin
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

        <form action="{{ route('admin.users.update', $user->id) }}" method="POST" x-data="{
            role: '{{ old('role', $user->role ?? 'member') }}',
            hasMemberData: '{{ old('role', $user->role ?? 'member') }}' === 'member',
            hasAdminData: '{{ old('role', $user->role ?? 'member') }}' === 'admin'
        }"
            x-init="$watch('role', value => {
                hasMemberData = value === 'member';
                hasAdminData = value === 'admin';
            })"
            class="space-y-6 rounded-3xl border border-neutral-200/70 bg-white p-5 shadow-sm sm:p-8">
            @csrf
            @method('PUT')

            <div class="grid gap-5 md:grid-cols-2">
                <div class="md:col-span-2">
                    <label for="name" class="mb-1.5 block text-xs font-bold text-neutral-700">Nama Lengkap <span
                            class="text-red-500">*</span></label>
                    <input id="name" name="name" value="{{ old('name', $user->name) }}" required maxlength="255"
                        class="w-full rounded-xl border border-neutral-300 bg-[#FAF5F2] px-4 py-3 text-sm focus:border-[#5F8C72] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#5F8C72]/20">
                </div>

                <div>
                    <label for="email" class="mb-1.5 block text-xs font-bold text-neutral-700">Email <span
                            class="text-red-500">*</span></label>
                    <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}"
                        required maxlength="255"
                        class="w-full rounded-xl border border-neutral-300 bg-[#FAF5F2] px-4 py-3 text-sm focus:border-[#5F8C72] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#5F8C72]/20">
                </div>

                <div>
                    <label for="role" class="mb-1.5 block text-xs font-bold text-neutral-700">Role <span
                            class="text-red-500">*</span></label>
                    <select id="role" name="role" x-model="role" required
                        class="w-full rounded-xl border border-neutral-300 bg-[#FAF5F2] px-3 py-3 text-sm focus:border-[#5F8C72] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#5F8C72]/20">
                        <option value="member" @selected(old('role', $user->role) === 'member')>Member</option>
                        <option value="admin" @selected(old('role', $user->role) === 'admin')>Admin</option>
                    </select>
                </div>
            </div>

            <div x-show="hasMemberData" x-transition class="space-y-5">
                <div class="flex items-center gap-3 border-b border-neutral-100 pb-3">
                    <i class="fa-solid fa-user-check text-[#5F8C72]"></i>
                    <h2 class="text-sm font-bold text-neutral-900">Informasi Member</h2>
                </div>

                <div class="grid gap-5 md:grid-cols-2">
                    <div>
                        <label for="member_phone" class="mb-1.5 block text-xs font-bold text-neutral-700">Nomor
                            Telepon</label>
                        <input id="member_phone" name="member_phone" value="{{ old('member_phone', $member?->phone) }}"
                            maxlength="20"
                            class="w-full rounded-xl border border-neutral-300 bg-[#FAF5F2] px-4 py-3 text-sm focus:border-[#5F8C72] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#5F8C72]/20">
                    </div>

                    <div>
                        <label for="date_of_birth" class="mb-1.5 block text-xs font-bold text-neutral-700">Tanggal
                            Lahir</label>
                        <input id="date_of_birth" name="date_of_birth" type="date"
                            value="{{ old('date_of_birth', optional($member?->date_of_birth)->format('Y-m-d')) }}"
                            class="w-full rounded-xl border border-neutral-300 bg-[#FAF5F2] px-4 py-3 text-sm focus:border-[#5F8C72] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#5F8C72]/20">
                    </div>

                    <div>
                        <label for="gender" class="mb-1.5 block text-xs font-bold text-neutral-700">Jenis
                            Kelamin</label>
                        <select id="gender" name="gender"
                            class="w-full rounded-xl border border-neutral-300 bg-[#FAF5F2] px-3 py-3 text-sm focus:border-[#5F8C72] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#5F8C72]/20">
                            <option value="">Pilih jenis kelamin</option>
                            <option value="L" @selected(old('gender', $member?->gender) === 'L')>Laki-laki</option>
                            <option value="P" @selected(old('gender', $member?->gender) === 'P')>Perempuan</option>
                            <option value="W" @selected(old('gender', $member?->gender) === 'W')>Wanita</option>
                        </select>
                    </div>

                    <div class="md:col-span-2">
                        <label for="address" class="mb-1.5 block text-xs font-bold text-neutral-700">Alamat</label>
                        <textarea id="address" name="address" rows="3"
                            class="w-full rounded-xl border border-neutral-300 bg-[#FAF5F2] px-4 py-3 text-sm focus:border-[#5F8C72] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#5F8C72]/20">{{ old('address', $member?->address) }}</textarea>
                    </div>

                    <div>
                        <label for="city" class="mb-1.5 block text-xs font-bold text-neutral-700">Kota</label>
                        <input id="city" name="city" value="{{ old('city', $member?->city) }}" maxlength="100"
                            class="w-full rounded-xl border border-neutral-300 bg-[#FAF5F2] px-4 py-3 text-sm focus:border-[#5F8C72] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#5F8C72]/20">
                    </div>

                    <div>
                        <label for="province" class="mb-1.5 block text-xs font-bold text-neutral-700">Provinsi</label>
                        <input id="province" name="province" value="{{ old('province', $member?->province) }}"
                            maxlength="100"
                            class="w-full rounded-xl border border-neutral-300 bg-[#FAF5F2] px-4 py-3 text-sm focus:border-[#5F8C72] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#5F8C72]/20">
                    </div>

                    <div class="md:col-span-2">
                        <label for="member_image_url" class="mb-1.5 block text-xs font-bold text-neutral-700">URL Foto
                            Member</label>
                        <input id="member_image_url" name="member_image_url" type="url"
                            value="{{ old('member_image_url', $member?->image_url) }}" maxlength="255"
                            class="w-full rounded-xl border border-neutral-300 bg-[#FAF5F2] px-4 py-3 text-sm focus:border-[#5F8C72] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#5F8C72]/20">
                    </div>
                </div>
            </div>

            <div x-show="hasAdminData" x-transition class="space-y-5">
                <div class="flex items-center gap-3 border-b border-neutral-100 pb-3">
                    <i class="fa-solid fa-shield-halved text-[#5F8C72]"></i>
                    <h2 class="text-sm font-bold text-neutral-900">Informasi Admin</h2>
                </div>

                <div class="grid gap-5 md:grid-cols-2">
                    <div>
                        <label for="admin_phone" class="mb-1.5 block text-xs font-bold text-neutral-700">Nomor
                            Telepon</label>
                        <input id="admin_phone" name="admin_phone" value="{{ old('admin_phone', $admin?->phone) }}"
                            maxlength="20"
                            class="w-full rounded-xl border border-neutral-300 bg-[#FAF5F2] px-4 py-3 text-sm focus:border-[#5F8C72] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#5F8C72]/20">
                    </div>

                    <div>
                        <label for="admin_role" class="mb-1.5 block text-xs font-bold text-neutral-700">Status
                            Admin</label>
                        <input id="admin_role" name="admin_role"
                            value="{{ old('admin_role', $admin?->role ?? 'active') }}" maxlength="50"
                            class="w-full rounded-xl border border-neutral-300 bg-[#FAF5F2] px-4 py-3 text-sm focus:border-[#5F8C72] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#5F8C72]/20">
                    </div>

                    <div class="md:col-span-2">
                        <label for="admin_profile_img" class="mb-1.5 block text-xs font-bold text-neutral-700">URL
                            Foto Admin</label>
                        <input id="admin_profile_img" name="admin_profile_img" type="url"
                            value="{{ old('admin_profile_img', $admin?->profile_img) }}" maxlength="255"
                            class="w-full rounded-xl border border-neutral-300 bg-[#FAF5F2] px-4 py-3 text-sm focus:border-[#5F8C72] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#5F8C72]/20">
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 border-t border-neutral-100 pt-5">
                <a href="{{ route('admin.users') }}"
                    class="rounded-xl px-5 py-3 text-xs font-semibold text-neutral-600 hover:bg-neutral-100">Batal</a>
                <button type="submit"
                    class="rounded-xl bg-[#5F8C72] px-5 py-3 text-xs font-bold text-white shadow-sm transition hover:bg-[#4f755e]">
                    <i class="fa-solid fa-floppy-disk mr-2"></i>Simpan Perubahan
                </button>
            </div>
        </form>
    </main>
</body>

</html>
