<x-layout title="Akun Saya">
    <x-slot name="head">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <style>
            .card-glass {
                background: rgba(255, 255, 255, 0.7);
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.5);
            }
            .stat-pill {
                background: linear-gradient(135deg, #FAF0EE, #f0e0db);
            }
        </style>
    </x-slot>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 w-full py-8">

        {{-- ── Greeting Banner ── --}}
        <div class="card-glass rounded-3xl p-6 sm:p-8 mb-8 flex flex-col sm:flex-row items-center sm:items-start gap-6 shadow-sm">
            {{-- Avatar --}}
            <div class="relative flex-shrink-0">
                <img src="{{ Auth::user()->profile_img ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=6B8E78&color=fff&size=128' }}"
                     alt="{{ Auth::user()->name }}"
                     class="w-24 h-24 rounded-full object-cover border-4 border-white shadow-md">
                <span class="absolute bottom-1 right-1 w-4 h-4 bg-green-400 border-2 border-white rounded-full"></span>
            </div>

            {{-- Info --}}
            <div class="flex-1 text-center sm:text-left">
                <p class="text-sm text-[#6B8E78] font-semibold uppercase tracking-widest mb-1">Selamat datang kembali 👋</p>
                <h1 class="text-2xl sm:text-3xl font-black text-[#2A1614] mb-1">{{ Auth::user()->name }}</h1>
                <p class="text-sm text-gray-500 mb-4">{{ Auth::user()->email }}</p>

                <div class="flex flex-wrap justify-center sm:justify-start gap-3">
                    <a href="{{ route('profile.edit') }}"
                       class="inline-flex items-center gap-2 bg-[#2A1614] text-white text-sm font-semibold px-5 py-2.5 rounded-xl hover:bg-[#3D2B2B] transition shadow-sm">
                        <i class="fa-regular fa-pen-to-square text-xs"></i>
                        Edit Profil
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit"
                                class="inline-flex items-center gap-2 bg-white text-red-500 border border-red-200 text-sm font-semibold px-5 py-2.5 rounded-xl hover:bg-red-50 transition shadow-sm">
                            <i class="fa-solid fa-arrow-right-from-bracket text-xs"></i>
                            Keluar
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- ── Stats Row ── --}}
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-8">
            <div class="stat-pill rounded-2xl p-5 text-center shadow-sm">
                <p class="text-3xl font-black text-[#C47366]">0</p>
                <p class="text-xs text-gray-500 font-medium mt-1">Seminar Diikuti</p>
            </div>
            <div class="stat-pill rounded-2xl p-5 text-center shadow-sm">
                <p class="text-3xl font-black text-[#4D6A56]">0</p>
                <p class="text-xs text-gray-500 font-medium mt-1">Ebook Diakses</p>
            </div>
            <div class="stat-pill rounded-2xl p-5 text-center shadow-sm">
                <p class="text-3xl font-black text-[#C47366]">0</p>
                <p class="text-xs text-gray-500 font-medium mt-1">Artikel Disimpan</p>
            </div>
            <div class="stat-pill rounded-2xl p-5 text-center shadow-sm">
                <p class="text-3xl font-black text-[#4D6A56]">—</p>
                <p class="text-xs text-gray-500 font-medium mt-1">Status Member</p>
            </div>
        </div>

        {{-- ── Quick Menu ── --}}
        <h2 class="text-lg font-bold text-[#2A1614] mb-4 px-1">Menu Cepat</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">

            <a href="{{ url('/seminars') }}"
               class="card-glass rounded-2xl p-5 flex items-center gap-4 hover:shadow-md transition group">
                <div class="w-12 h-12 rounded-xl bg-[#FAF0EE] flex items-center justify-center text-[#C47366] group-hover:bg-[#C47366] group-hover:text-white transition">
                    <i class="fa-solid fa-chalkboard-user text-xl"></i>
                </div>
                <div>
                    <p class="font-bold text-[#2A1614] text-sm">Info Seminar</p>
                    <p class="text-xs text-gray-400">Lihat seminar tersedia</p>
                </div>
            </a>

            <a href="{{ url('/library') }}"
               class="card-glass rounded-2xl p-5 flex items-center gap-4 hover:shadow-md transition group">
                <div class="w-12 h-12 rounded-xl bg-[#FAF0EE] flex items-center justify-center text-[#4D6A56] group-hover:bg-[#4D6A56] group-hover:text-white transition">
                    <i class="fa-solid fa-book-open text-xl"></i>
                </div>
                <div>
                    <p class="font-bold text-[#2A1614] text-sm">Ebook & Library</p>
                    <p class="text-xs text-gray-400">Akses konten pilihan</p>
                </div>
            </a>

            <a href="{{ url('/consult') }}"
               class="card-glass rounded-2xl p-5 flex items-center gap-4 hover:shadow-md transition group">
                <div class="w-12 h-12 rounded-xl bg-[#FAF0EE] flex items-center justify-center text-[#C47366] group-hover:bg-[#C47366] group-hover:text-white transition">
                    <i class="fa-solid fa-stethoscope text-xl"></i>
                </div>
                <div>
                    <p class="font-bold text-[#2A1614] text-sm">Konsultasi</p>
                    <p class="text-xs text-gray-400">Tanya langsung ahlinya</p>
                </div>
            </a>

            <a href="{{ url('/bookmarks') }}"
               class="card-glass rounded-2xl p-5 flex items-center gap-4 hover:shadow-md transition group">
                <div class="w-12 h-12 rounded-xl bg-[#FAF0EE] flex items-center justify-center text-[#4D6A56] group-hover:bg-[#4D6A56] group-hover:text-white transition">
                    <i class="fa-solid fa-bookmark text-xl"></i>
                </div>
                <div>
                    <p class="font-bold text-[#2A1614] text-sm">Bookmark Saya</p>
                    <p class="text-xs text-gray-400">Konten yang disimpan</p>
                </div>
            </a>

            <a href="{{ url('/my-subscriptions') }}"
               class="card-glass rounded-2xl p-5 flex items-center gap-4 hover:shadow-md transition group">
                <div class="w-12 h-12 rounded-xl bg-[#FAF0EE] flex items-center justify-center text-amber-500 group-hover:bg-amber-500 group-hover:text-white transition">
                    <i class="fa-solid fa-gem text-xl"></i>
                </div>
                <div>
                    <p class="font-bold text-[#2A1614] text-sm">Status Langganan</p>
                    <p class="text-xs text-gray-400">Info paket membership</p>
                </div>
            </a>

            <a href="{{ route('profile.edit') }}"
               class="card-glass rounded-2xl p-5 flex items-center gap-4 hover:shadow-md transition group">
                <div class="w-12 h-12 rounded-xl bg-[#FAF0EE] flex items-center justify-center text-[#2A1614] group-hover:bg-[#2A1614] group-hover:text-white transition">
                    <i class="fa-regular fa-user text-xl"></i>
                </div>
                <div>
                    <p class="font-bold text-[#2A1614] text-sm">Edit Profil</p>
                    <p class="text-xs text-gray-400">Ubah data akun Anda</p>
                </div>
            </a>

        </div>

    </div>
</x-layout>
