<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard Workspace — Maternity.id</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=DM+Serif+Display:ital@0;1&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #FAF5F2;
        }

        .font-serif-brand {
            font-family: 'DM Serif Display', serif;
        }

        .custom-scrollbar::-webkit-scrollbar {
            width: 5px;
            height: 5px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #E5D5D0;
            border-radius: 9999px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #C3786B;
        }
    </style>
</head>

<body class="min-h-screen text-neutral-800 antialiased selection:bg-[#5F8C72] selection:text-white"
    x-data="{
        activeTab: (() => {
            const path = window.location.pathname;
            if (path.includes('/article')) return 'articles';
            if (path.includes('/event')) return 'events';
            if (path.includes('/ebook')) return 'library';
            if (path.includes('/users')) return 'users';
            return new URLSearchParams(window.location.search).get('tab') || 'approvals';
        })(),
        mobileSidebar: false,
        searchQuery: '',
        approvalFilter: 'all',
        users: {{ Illuminate\Support\Js::from($adminUsers ?? [])->toHtml() }},
        selectedVerification: null,
        showProofModal: false,
        verifications: [{
            id: 'TRX-895',
            userName: 'Nadia Rahmawati',
            userEmail: 'nadia.r@yahoo.com',
            userWhatsapp: '0878-9988-1122',
            userBirthDate: '05/11/1995',
            eventName: 'Seminar Gizi 1000 Hari Pertama (Jogja)',
            linkedEvent: null
        }],
    
        articleFilter: 'all',
        showArticleModal: false,
        articleForm: {
            title: '',
            category: 'Nutrisi Ibu',
            author: '',
            excerpt: '',
            content: '',
            linkedEvent: ''
        },
        articles: [],
    
        // ── DATA EVENT / JADWAL PELATIHAN ──
        eventMonthFilter: 'all',
        showEventModal: false,
        eventPosterPreview: '',
        eventForm: {
            title: '',
            category: {{ Illuminate\Support\Js::from(($adminCategories ?? collect())->first()?->id)->toHtml() }},
            date: '{{ now()->toDateString() }}',
            openDate: '{{ now()->toDateString() }}',
            closeDate: '{{ now()->addDays(7)->toDateString() }}',
            location: '',
            speaker: '',
            price: '54000',
            quota: '100',
            description: ''
        },
        handleEventPoster(e) {
            const file = e.target.files?.[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (event) => {
                    this.eventPosterPreview = event.target.result;
                };
                reader.readAsDataURL(file);
            }
        },
        eventCategories: {{ Illuminate\Support\Js::from($adminCategories ?? [])->toHtml() }},
        events: {{ Illuminate\Support\Js::from($adminEvents ?? [])->toHtml() }},
        get filteredEvents() {
            return this.events.filter(ev => {
                const matchMonth = (this.eventMonthFilter === 'all' || ev.month === this.eventMonthFilter);
                const matchSearch = ev.title.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                    ev.speaker.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                    ev.location.toLowerCase().includes(this.searchQuery.toLowerCase());
                return matchMonth && matchSearch;
            });
        },
    
        // ── DATA E-BOOK PDF ──
        pdfResources: {{ Illuminate\Support\Js::from($adminMaterials ?? [])->toHtml() }},
    
        // ── METHOD APPROVAL ACTION ──
        approveVerification(item) {
            item.status = 'approved';
            item.adminNotes = 'Disetujui oleh admin pada ' + new Date().toLocaleTimeString('id-ID');
            this.showProofModal = false;
        },
        rejectVerification(item) {
            const reason = prompt('Masukkan alasan penolakan pembayaran:') || 'Bukti pembayaran tidak sesuai atau tidak valid.';
            item.status = 'rejected';
            item.adminNotes = reason;
            this.showProofModal = false;
        },
    
        get pendingCount() {
            return this.verifications.filter(v => v.status === 'pending').length;
        },
        get approvedCount() {
            return this.verifications.filter(v => v.status === 'approved').length;
        },
        get filteredUsers() {
            const term = this.searchQuery.toLowerCase();
            return (this.users || []).filter(user => {
                return (user.name || '').toLowerCase().includes(term) ||
                    (user.email || '').toLowerCase().includes(term) ||
                    (user.role || '').toLowerCase().includes(term);
            });
        },
        get filteredVerifications() {
            return this.verifications.filter(v => {
                const matchStatus = (this.approvalFilter === 'all' || v.status === this.approvalFilter);
                const matchSearch = v.userName.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                    v.eventName.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                    v.userWhatsapp.toLowerCase().includes(this.searchQuery.toLowerCase());
                return matchStatus && matchSearch;
            });
        }
    }">

    {{-- Main Outer Wrapper (NO PUBLIC HEADER / FOOTER) --}}
    <div class="flex h-screen overflow-hidden">

        {{-- ── 1. SIDEBAR NAVIGASI ADMIN KHUSUS ── --}}

        {{-- Mobile Overlay --}}
        <div x-show="mobileSidebar" x-transition:enter="transition-opacity ease-linear duration-200"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease-linear duration-200" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0" @click="mobileSidebar = false"
            class="fixed inset-0 bg-neutral-900/50 z-40 md:hidden"></div>

        <aside :class="mobileSidebar ? 'translate-x-0' : '-translate-x-full md:translate-x-0'"
            class="fixed md:static inset-y-0 left-0 z-50 w-64 bg-white border-r border-[#EFE8E3] flex flex-col justify-between shrink-0 transition-transform duration-300 ease-in-out p-5">
            <div>
                {{-- Logo & Brand --}}
                <div class="flex items-center justify-between pb-5 mb-5 border-b border-neutral-100">
                    <div class="flex items-center gap-2.5">
                        <span
                            class="w-9 h-9 rounded-xl bg-[#5F8C72] text-white flex items-center justify-center font-extrabold text-sm shadow-xs">
                            M
                        </span>
                        <div>
                            <span
                                class="font-extrabold text-base text-[#8C433C] tracking-tight leading-none">Maternity<span
                                    class="text-[#5F8C72]">.id</span></span>
                            <span
                                class="block text-[10px] text-neutral-400 font-semibold tracking-wider uppercase mt-1">Admin
                                Portal</span>
                        </div>
                    </div>
                    <button @click="mobileSidebar = false" class="md:hidden text-neutral-400 hover:text-neutral-700">
                        <i class="fa-solid fa-xmark text-base"></i>
                    </button>
                </div>

                {{-- Admin User Card --}}
                <div class="bg-[#FAF5F2] rounded-2xl p-3.5 flex items-center gap-3 mb-6 border border-[#EFE8E3]">
                    <img src="{{ auth()->user()->profile_img ?? 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=100&h=100&fit=crop' }}"
                        alt="Admin Profile"
                        class="w-10 h-10 rounded-full object-cover border-2 border-white shadow-xs shrink-0">
                    <div class="min-w-0">
                        <h4 class="text-xs font-bold text-neutral-900 truncate">{{ auth()->user()->name }}</h4>
                        <div class="flex items-center gap-1.5 mt-0.5">
                            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                            <p class="text-[10px] text-neutral-500 font-medium truncate">
                                {{ ucfirst(auth()->user()->role) }}</p>
                        </div>
                    </div>
                </div>

                {{-- Menu List --}}
                <div class="space-y-1">
                    <p class="text-[10px] font-bold text-neutral-400 uppercase tracking-wider px-3 mb-2">Manajemen
                        Konten & User</p>

                    {{-- 1. Verifikasi Pembayaran (User Approval) --}}
                    <a href="{{ route('admin.approval') }}" @click="mobileSidebar = false"
                        :class="activeTab === 'approvals' ? 'bg-[#B8E6B8] text-neutral-900 font-bold shadow-xs' :
                            'text-neutral-600 hover:bg-[#FAF5F2] hover:text-neutral-900 font-medium'"
                        class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl transition text-xs cursor-pointer text-left">
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-user-check text-xs text-emerald-800"></i>
                            <span>Verifikasi Pembayaran</span>
                        </div>
                        <span x-show="pendingCount > 0"
                            class="text-[10px] bg-[#B96A5C] text-white font-bold px-2 py-0.5 rounded-full"
                            x-text="pendingCount"></span>
                    </a>

                    {{-- 2. Kelola User --}}
                    <a href="{{ route('admin.users') }}" @click="mobileSidebar = false"
                        :class="activeTab === 'users' ? 'bg-[#B8E6B8] text-neutral-900 font-bold shadow-xs' :
                            'text-neutral-600 hover:bg-[#FAF5F2] hover:text-neutral-900 font-medium'"
                        class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl transition text-xs cursor-pointer text-left">
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-users-gear text-xs text-emerald-800"></i>
                            <span>Manage Users</span>
                        </div>
                        <span class="text-[10px] text-neutral-400 font-semibold" x-text="(users || []).length"></span>
                    </a>

                    {{-- 3. Tulis & Kelola Artikel Ketikan --}}
                    <a href="{{ route('admin.article') }}" @click="mobileSidebar = false"
                        :class="activeTab === 'articles' ? 'bg-[#B8E6B8] text-neutral-900 font-bold shadow-xs' :
                            'text-neutral-600 hover:bg-[#FAF5F2] hover:text-neutral-900 font-medium'"
                        class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl transition text-xs cursor-pointer text-left">
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-newspaper text-xs text-emerald-800"></i>
                            <span>Upload & Tulis Artikel</span>
                        </div>
                        <span class="text-[10px] text-neutral-400 font-semibold" x-text="articles.length"></span>
                    </a>

                    {{-- 4. Jadwal Event & Pelatihan --}}
                    <a href="{{ route('admin.event') }}" @click="mobileSidebar = false"
                        :class="activeTab === 'events' ? 'bg-[#B8E6B8] text-neutral-900 font-bold shadow-xs' :
                            'text-neutral-600 hover:bg-[#FAF5F2] hover:text-neutral-900 font-medium'"
                        class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl transition text-xs cursor-pointer text-left">
                        <div class="flex items-center gap-3">
                            <i class="fa-regular fa-calendar-check text-xs text-emerald-800"></i>
                            <span>Event & Pelatihan</span>
                        </div>
                        <span class="text-[10px] text-neutral-400 font-semibold" x-text="events.length"></span>
                    </a>

                    {{-- 5. E-book & Modul PDF --}}
                    <a href="{{ route('admin.ebook') }}" @click="mobileSidebar = false"
                        :class="activeTab === 'library' ? 'bg-[#B8E6B8] text-neutral-900 font-bold shadow-xs' :
                            'text-neutral-600 hover:bg-[#FAF5F2] hover:text-neutral-900 font-medium'"
                        class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl transition text-xs cursor-pointer text-left">
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-book-open text-xs text-emerald-800"></i>
                            <span>E-Book & Modul PDF</span>
                        </div>
                        <span class="text-[10px] text-neutral-400 font-semibold" x-text="pdfResources.length"></span>
                    </a>
                </div>
            </div>

            {{-- Sidebar Footer --}}
            <div class="pt-4 border-t border-neutral-100 space-y-2">
                <a href="{{ route('home') }}" target="_blank"
                    class="flex items-center justify-between px-3.5 py-2 rounded-xl text-neutral-500 hover:bg-[#FAF5F2] hover:text-neutral-800 transition text-xs font-medium">
                    <span class="flex items-center gap-2">
                        <i class="fa-solid fa-arrow-up-right-from-square text-[11px]"></i>
                        <span>Lihat Website User</span>
                    </span>
                </a>
                <a href="{{ route('logout') }}"
                    class="flex items-center gap-2 px-3.5 py-2 rounded-xl text-red-600 hover:bg-red-50 transition text-xs font-semibold">
                    <i class="fa-solid fa-arrow-right-from-bracket text-xs"></i>
                    <span>Keluar Portal</span>
                </a>
            </div>
        </aside>

        {{-- ── 2. MAIN CONTENT AREA (TANPA HEADER/FOOTER USER) ── --}}
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden">

            {{-- Top Navbar Admin Header Bar --}}
            <header
                class="bg-white border-b border-[#EFE8E3] px-5 sm:px-8 py-4 flex items-center justify-between gap-4 shrink-0">
                <div class="flex items-center gap-3">
                    <button @click="mobileSidebar = true"
                        class="md:hidden p-2 rounded-xl bg-[#FAF5F2] text-neutral-700 hover:bg-neutral-200">
                        <i class="fa-solid fa-bars"></i>
                    </button>
                    <div>
                        <h1 class="text-lg sm:text-xl font-extrabold text-neutral-900 tracking-tight font-serif-brand">
                            <span x-show="activeTab === 'approvals'">Verifikasi Pendaftaran & Pembayaran</span>
                            <span x-show="activeTab === 'users'">Manage Users</span>
                            <span x-show="activeTab === 'articles'">Upload & Manajemen Artikel Edukasi</span>
                            <span x-show="activeTab === 'events'">Jadwal Seminar & Pelatihan</span>
                            <span x-show="activeTab === 'library'">Knowledge Library (E-Book PDF)</span>
                        </h1>
                        <p class="text-[11px] text-neutral-500 hidden sm:block">
                            <span x-show="activeTab === 'approvals'">Verifikasi bukti transfer user untuk mengaktifkan
                                akses pelatihan & ebook</span>
                            <span x-show="activeTab === 'users'">Kelola akun, peran, dan data pengguna platform dengan
                                cepat.</span>
                            <span x-show="activeTab === 'articles'">Tulis artikel ketikan berbasis SEO untuk
                                ditampilkan di portal publik</span>
                            <span x-show="activeTab === 'events'">Atur jadwal seminar, kuota pendaftaran, dan informasi
                                pemateri</span>
                            <span x-show="activeTab === 'library'">Kelola repositori berkas PDF digital materi
                                kehamilan & nifas</span>
                        </p>
                    </div>
                </div>

                {{-- Search & Quick Shortcut --}}
                <div class="flex items-center gap-2 sm:gap-3">
                    <div class="relative w-28 min-[400px]:w-40 sm:w-64">
                        <span
                            class="absolute inset-y-0 left-0 flex items-center pl-3 text-neutral-400 pointer-events-none">
                            <i class="fa-solid fa-magnifying-glass text-xs"></i>
                        </span>
                        <input type="text" x-model="searchQuery" placeholder="Cari data..."
                            class="w-full bg-[#FAF5F2] border border-neutral-200 rounded-full pl-8 pr-4 py-1.5 text-xs text-neutral-800 placeholder-neutral-400 focus:outline-none focus:ring-2 focus:ring-[#5F8C72] focus:bg-white">
                    </div>

                    <a href="{{ route('home') }}" target="_blank" title="Buka Tampilan User"
                        class="p-2 rounded-full bg-[#FAF5F2] text-neutral-600 hover:text-[#8C433C] hover:bg-[#FCEBE7] transition text-xs flex items-center justify-center w-8 h-8">
                        <i class="fa-solid fa-globe"></i>
                    </a>
                </div>
            </header>

            {{-- Main Dynamic Workspace Scrollable Body --}}
            <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8 space-y-6">

                {{-- ═════════════════════════════════════════════════════════
                     TAB 1: VERIFIKASI PEMBAYARAN & APPROVAL USER
                ═════════════════════════════════════════════════════════ --}}
                <div x-show="activeTab === 'approvals'" class="space-y-6">

                    {{-- Metric Cards Approval --}}
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div
                            class="bg-white rounded-2xl p-4.5 border border-neutral-200/70 shadow-2xs flex items-center gap-4">
                            <div
                                class="w-11 h-11 rounded-2xl bg-[#FEF3C7] text-[#B45309] flex items-center justify-center shrink-0">
                                <i class="fa-regular fa-clock text-lg"></i>
                            </div>
                            <div>
                                <p class="text-[11px] text-neutral-500 font-medium">Menunggu Verifikasi</p>
                                <div class="flex items-baseline gap-2">
                                    <p class="text-2xl font-black text-[#B45309]" x-text="pendingCount">2</p>
                                    <span
                                        class="text-[10px] bg-amber-100 text-amber-800 px-2 py-0.5 rounded-full font-bold">Perlu
                                        Tindakan</span>
                                </div>
                            </div>
                        </div>

                        <div
                            class="bg-white rounded-2xl p-4.5 border border-neutral-200/70 shadow-2xs flex items-center gap-4">
                            <div
                                class="w-11 h-11 rounded-2xl bg-[#E4F5E6] text-[#428E53] flex items-center justify-center shrink-0">
                                <i class="fa-solid fa-circle-check text-lg"></i>
                            </div>
                            <div>
                                <p class="text-[11px] text-neutral-500 font-medium">Pendaftaran Disetujui</p>
                                <div class="flex items-baseline gap-2">
                                    <p class="text-2xl font-black text-emerald-800" x-text="approvedCount">1</p>
                                    <span
                                        class="text-[10px] bg-emerald-100 text-emerald-800 px-2 py-0.5 rounded-full font-bold">Aktif</span>
                                </div>
                            </div>
                        </div>

                        <div
                            class="bg-white rounded-2xl p-4.5 border border-neutral-200/70 shadow-2xs flex items-center gap-4">
                            <div
                                class="w-11 h-11 rounded-2xl bg-[#FCDDD9] text-[#DE6657] flex items-center justify-center shrink-0">
                                <i class="fa-solid fa-users text-lg"></i>
                            </div>
                            <div>
                                <p class="text-[11px] text-neutral-500 font-medium">Total Konfirmasi</p>
                                <p class="text-2xl font-black text-neutral-900" x-text="verifications.length">4</p>
                            </div>
                        </div>
                    </div>

                    {{-- Table List Konfirmasi User --}}
                    <div class="bg-white rounded-3xl p-5 sm:p-6 border border-neutral-200/70 shadow-2xs space-y-4">

                        {{-- Filter Status Pills --}}
                        <div
                            class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-3 border-b border-neutral-100">
                            <div>
                                <h3 class="text-sm font-bold text-neutral-900">Daftar Konfirmasi Pembayaran Peserta
                                </h3>
                                <p class="text-[11px] text-neutral-500">Klik "Lihat Bukti" atau langsung "Setujui"
                                    untuk memberi akses kepada user.</p>
                            </div>

                            <div class="flex items-center gap-1.5 overflow-x-auto">
                                <button type="button" @click="approvalFilter = 'all'"
                                    :class="approvalFilter === 'all' ? 'bg-[#5F8C72] text-white font-bold' :
                                        'bg-[#FAF5F2] text-neutral-600 hover:bg-neutral-100'"
                                    class="px-3 py-1.5 rounded-full text-[11px] transition shrink-0 cursor-pointer">
                                    Semua (<span x-text="verifications.length"></span>)
                                </button>
                                <button type="button" @click="approvalFilter = 'pending'"
                                    :class="approvalFilter === 'pending' ? 'bg-[#5F8C72] text-white font-bold' :
                                        'bg-[#FAF5F2] text-neutral-600 hover:bg-neutral-100'"
                                    class="px-3 py-1.5 rounded-full text-[11px] transition shrink-0 cursor-pointer">
                                    Menunggu Verifikasi (<span x-text="pendingCount"></span>)
                                </button>
                                <button type="button" @click="approvalFilter = 'approved'"
                                    :class="approvalFilter === 'approved' ? 'bg-[#5F8C72] text-white font-bold' :
                                        'bg-[#FAF5F2] text-neutral-600 hover:bg-neutral-100'"
                                    class="px-3 py-1.5 rounded-full text-[11px] transition shrink-0 cursor-pointer">
                                    Disetujui / Selesai (<span x-text="approvedCount"></span>)
                                </button>
                            </div>
                        </div>

                        {{-- Table Area --}}
                        <div class="overflow-x-auto custom-scrollbar">
                            <table class="w-full text-left text-xs">
                                <thead>
                                    <tr class="text-neutral-500 font-semibold text-[11px] border-b border-neutral-100">
                                        <th class="py-3 px-3">Peserta & Kontak</th>
                                        <th class="py-3 px-3">Pelatihan yang Dipilih</th>
                                        <th class="py-3 px-3">Total Transfer</th>
                                        <th class="py-3 px-3">Waktu Upload</th>
                                        <th class="py-3 px-3">Status User</th>
                                        <th class="py-3 px-3 text-right">Aksi Approval</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-neutral-100">
                                    <template x-for="item in filteredVerifications" :key="item.id">
                                        <tr class="hover:bg-[#FAF5F2]/60 transition">
                                            {{-- Peserta --}}
                                            <td class="py-3.5 px-3">
                                                <div>
                                                    <p class="font-bold text-neutral-900" x-text="item.userName"></p>
                                                    <p class="text-[11px] text-neutral-500 font-mono"
                                                        x-text="item.userWhatsapp"></p>
                                                    <p class="text-[10px] text-neutral-400" x-text="item.userEmail">
                                                    </p>
                                                </div>
                                            </td>

                                            {{-- Pelatihan --}}
                                            <td class="py-3.5 px-3">
                                                <div>
                                                    <p class="font-semibold text-neutral-800" x-text="item.eventName">
                                                    </p>
                                                    <span
                                                        class="text-[10px] bg-[#FAF5F2] text-[#8C433C] px-2 py-0.5 rounded-full font-medium border border-[#DEAAA1]/40"
                                                        x-text="item.packageType"></span>
                                                </div>
                                            </td>

                                            {{-- Total --}}
                                            <td class="py-3.5 px-3 whitespace-nowrap">
                                                <span class="font-bold text-[#DE6657]" x-text="item.amount"></span>
                                            </td>

                                            {{-- Waktu --}}
                                            <td class="py-3.5 px-3 whitespace-nowrap text-neutral-600 text-[11px]"
                                                x-text="item.date"></td>

                                            {{-- Status Badge --}}
                                            <td class="py-3.5 px-3 whitespace-nowrap">
                                                <template x-if="item.status === 'pending'">
                                                    <span
                                                        class="inline-flex items-center gap-1.5 bg-[#FEF3C7] text-[#B45309] px-2.5 py-1 rounded-full text-[11px] font-bold">
                                                        <span
                                                            class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                                        Menunggu Verifikasi
                                                    </span>
                                                </template>
                                                <template x-if="item.status === 'approved'">
                                                    <span
                                                        class="inline-flex items-center gap-1.5 bg-[#E4F5E6] text-[#428E53] px-2.5 py-1 rounded-full text-[11px] font-bold">
                                                        <i class="fa-solid fa-check text-[10px]"></i>
                                                        Pendaftaran Diterima
                                                    </span>
                                                </template>
                                                <template x-if="item.status === 'rejected'">
                                                    <span
                                                        class="inline-flex items-center gap-1.5 bg-red-100 text-red-700 px-2.5 py-1 rounded-full text-[11px] font-bold">
                                                        <i class="fa-solid fa-xmark text-[10px]"></i>
                                                        Ditolak
                                                    </span>
                                                </template>
                                            </td>

                                            {{-- Aksi --}}
                                            <td class="py-3.5 px-3 whitespace-nowrap text-right">
                                                <div class="flex items-center justify-end gap-1.5">
                                                    {{-- Tombol Lihat Bukti --}}
                                                    <button type="button"
                                                        @click="selectedVerification = item; showProofModal = true"
                                                        class="bg-[#FAF5F2] hover:bg-[#F3E1DC] text-neutral-700 px-2.5 py-1.5 rounded-xl text-[11px] font-semibold transition flex items-center gap-1 cursor-pointer">
                                                        <i class="fa-regular fa-image text-xs text-[#B96A5C]"></i>
                                                        <span>Lihat Bukti</span>
                                                    </button>

                                                    {{-- Tombol Setujui / Approve --}}
                                                    <template x-if="item.status === 'pending'">
                                                        <button type="button" @click="approveVerification(item)"
                                                            class="bg-[#5F8C72] hover:bg-[#4f755e] text-white px-3 py-1.5 rounded-xl text-[11px] font-bold transition flex items-center gap-1 cursor-pointer shadow-2xs">
                                                            <i class="fa-solid fa-check text-xs"></i>
                                                            <span>Approve</span>
                                                        </button>
                                                    </template>

                                                    {{-- Tombol Tolak --}}
                                                    <template x-if="item.status === 'pending'">
                                                        <button type="button" @click="rejectVerification(item)"
                                                            class="bg-red-50 hover:bg-red-100 text-red-600 px-2 py-1.5 rounded-xl text-[11px] font-bold transition cursor-pointer"
                                                            title="Tolak Pendaftaran">
                                                            <i class="fa-solid fa-xmark text-xs"></i>
                                                        </button>
                                                    </template>
                                                </div>
                                            </td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- ═════════════════════════════════════════════════════════
                     TAB 2: MANAGE USERS
                ═════════════════════════════════════════════════════════ --}}
                <div x-show="activeTab === 'users'" class="space-y-6">
                    @if (session('status'))
                        <div
                            class="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-xs font-semibold text-emerald-800">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div
                        class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white rounded-3xl p-6 border border-neutral-200/70 shadow-2xs">
                        <div>
                            <h2 class="text-base font-bold text-neutral-900">Manage Users</h2>
                            <p class="text-xs text-neutral-500 mt-0.5">Review account activity, permissions, and user
                                details from one place.</p>
                        </div>
                        <div class="flex flex-wrap items-center gap-2">
                            <a href="{{ route('admin.users.deleted') }}"
                                class="border border-neutral-300 bg-white hover:bg-neutral-50 text-neutral-700 text-xs font-bold px-4 py-2.5 rounded-xl flex items-center gap-2 transition shrink-0">
                                <i class="fa-solid fa-trash-can text-red-500"></i>
                                <span>Deleted Users</span>
                            </a>
                            <a href="{{ route('admin.users.create') }}"
                                class="bg-[#5F8C72] hover:bg-[#4f755e] text-white text-xs font-bold px-4 py-2.5 rounded-xl flex items-center gap-2 transition shadow-xs shrink-0">
                                <i class="fa-solid fa-user-plus"></i>
                                <span>Add User</span>
                            </a>
                        </div>
                    </div>

                    <div class="bg-white rounded-3xl p-6 border border-neutral-200/70 shadow-2xs">
                        <div class="overflow-x-auto custom-scrollbar">
                            <table class="w-full text-left text-xs">
                                <thead>
                                    <tr class="text-neutral-500 font-semibold text-[11px] border-b border-neutral-100">
                                        <th class="py-3 px-3">User</th>
                                        <th class="py-3 px-3">Email</th>
                                        <th class="py-3 px-3">Role</th>
                                        <th class="py-3 px-3">Joined</th>
                                        <th class="py-3 px-3">Status</th>
                                        <th class="py-3 px-3 text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-neutral-100">
                                    <template x-for="user in filteredUsers" :key="user.id">
                                        <tr class="hover:bg-[#FAF5F2]/60 transition">
                                            <td class="py-3.5 px-3">
                                                <div class="flex items-center gap-3">
                                                    <img :src="user.profile_img" alt="User avatar"
                                                        class="w-10 h-10 rounded-full object-cover border border-neutral-200">
                                                    <div>
                                                        <p class="font-bold text-neutral-900" x-text="user.name"></p>
                                                        <p class="text-[10px] text-neutral-500"
                                                            x-text="user.id.substring(0, 8)"></p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="py-3.5 px-3 text-neutral-600" x-text="user.email"></td>
                                            <td class="py-3.5 px-3">
                                                <span
                                                    class="inline-flex rounded-full bg-[#E4F5E6] px-2.5 py-1 text-[10px] font-bold text-[#428E53] uppercase"
                                                    x-text="user.role"></span>
                                            </td>
                                            <td class="py-3.5 px-3 text-neutral-600" x-text="user.created_at"></td>
                                            <td class="py-3.5 px-3">
                                                <span
                                                    class="inline-flex rounded-full bg-[#E4F5E6] px-2.5 py-1 text-[10px] font-bold text-[#428E53]"
                                                    x-text="user.status"></span>
                                            </td>
                                            <td class="py-3.5 px-3 whitespace-nowrap text-right">
                                                <div class="flex items-center justify-end gap-2">
                                                    <a :href="'{{ url('/admin/users') }}/' + user.id + '/edit'"
                                                        class="bg-[#FAF5F2] hover:bg-[#F3E1DC] text-neutral-700 px-2.5 py-1.5 rounded-xl text-[11px] font-semibold transition cursor-pointer inline-flex items-center">
                                                        Edit
                                                    </a>
                                                    <form method="POST"
                                                        :action="'{{ url('/admin/users') }}/' + user.id"
                                                        onsubmit="return confirm('Move this account to deleted users?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="bg-red-50 hover:bg-red-100 text-red-600 px-2.5 py-1.5 rounded-xl text-[11px] font-semibold transition cursor-pointer">
                                                            Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- ═════════════════════════════════════════════════════════
                     TAB 3: UPLOAD & TULIS ARTIKEL KETIKAN
                ═════════════════════════════════════════════════════════ --}}
                <div x-show="activeTab === 'articles'" class="space-y-6">

                    {{-- Header Section & Tombol Buat Artikel --}}
                    <div
                        class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white rounded-3xl p-6 border border-neutral-200/70 shadow-2xs">
                        <div>
                            <h2 class="text-base font-bold text-neutral-900">Manajemen Artikel Edukasi & SEO</h2>
                            <p class="text-xs text-neutral-500 mt-0.5">Tulis artikel dalam bentuk teks/ketikan langsung
                                dengan link promosi seminar terkait di bagian akhir.</p>
                        </div>
                        <button type="button" @click="showArticleModal = true"
                            class="bg-[#B96A5C] hover:bg-[#a55c50] text-white text-xs font-bold px-4 py-2.5 rounded-xl flex items-center gap-2 transition shadow-xs shrink-0 cursor-pointer">
                            <i class="fa-solid fa-pen-nib"></i>
                            <span>Tulis Artikel Baru</span>
                        </button>
                    </div>

                    {{-- Form Tulis Artikel Ketikan (Inline Workspace) --}}
                    <div class="bg-white rounded-3xl p-6 border border-neutral-200/70 shadow-2xs space-y-5">
                        <div class="flex items-center justify-between pb-3 border-b border-neutral-100">
                            <h3 class="font-bold text-sm text-neutral-900 flex items-center gap-2">
                                <i class="fa-solid fa-feather-pointed text-[#B96A5C]"></i>
                                <span>Editor Penulisan Artikel Maternity</span>
                            </h3>
                            <span
                                class="text-[10px] bg-emerald-100 text-emerald-800 font-bold px-2 py-0.5 rounded-full">Ketikan
                                Langsung</span>
                        </div>

                        <form action="#" method="POST"
                            @submit.prevent="
                                if (!articleForm.title.trim()) { alert('Silakan isi judul artikel.'); return; }
                                articles.unshift({
                                    id: Date.now(),
                                    title: articleForm.title,
                                    category: articleForm.category,
                                    categoryColor: 'bg-[#FCEBE7] text-[#C97A70]',
                                    author: articleForm.author,
                                    publishedAt: 'Hari ini',
                                    views: '0',
                                    excerpt: articleForm.excerpt || articleForm.content.substring(0, 100) + '...',
                                    linkedEvent: articleForm.linkedEvent || null
                                });
                                alert('Artikel berhasil dipublikasikan!');
                                articleForm.title = '';
                                articleForm.content = '';
                                articleForm.excerpt = '';
                              "
                            class="space-y-4">

                            {{-- Grid Input Judul & Kategori --}}
                            <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                                <div class="md:col-span-8">
                                    <label class="block text-xs font-bold text-neutral-700 mb-1">Judul Artikel
                                        Edukasi</label>
                                    <input type="text" x-model="articleForm.title"
                                        placeholder="Contoh: 7 Makanan Sumber Asam Folat Tinggi untuk Ibu Hamil"
                                        class="w-full bg-[#FAF5F2] border border-neutral-300 rounded-xl px-4 py-2.5 text-xs text-neutral-800 focus:outline-none focus:ring-2 focus:ring-[#5F8C72] focus:bg-white font-medium">
                                </div>
                                <div class="md:col-span-4">
                                    <label class="block text-xs font-bold text-neutral-700 mb-1">Kategori Topik</label>
                                    <select x-model="articleForm.category"
                                        class="w-full bg-[#FAF5F2] border border-neutral-300 rounded-xl px-3 py-2.5 text-xs text-neutral-800 focus:outline-none focus:ring-2 focus:ring-[#5F8C72] focus:bg-white cursor-pointer font-medium">
                                        <option value="Nutrisi Ibu">Nutrisi Ibu & Janin</option>
                                        <option value="Kesehatan Wanita">Kesehatan Mental & Wanita</option>
                                        <option value="Perawatan Bayi">Perawatan Bayi Baru Lahir</option>
                                        <option value="Persalinan Sehat">Persalinan Alami & Gentle Birth</option>
                                    </select>
                                </div>
                            </div>

                            {{-- Penulis & Tautan Seminar --}}
                            <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                                <div class="md:col-span-6">
                                    <label class="block text-xs font-bold text-neutral-700 mb-1">Nama Penulis / Dokter
                                        Ahli</label>
                                    <input type="text" x-model="articleForm.author"
                                        placeholder="dr. Annisa Pratama, Sp.OG"
                                        class="w-full bg-[#FAF5F2] border border-neutral-300 rounded-xl px-4 py-2 text-xs text-neutral-800 focus:outline-none focus:ring-2 focus:ring-[#5F8C72] focus:bg-white">
                                </div>
                                <div class="md:col-span-6">
                                    <label class="block text-xs font-bold text-neutral-700 mb-1">Tautkan Promo Seminar
                                        di Akhir Artikel (SRS FR-19)</label>
                                    <select x-model="articleForm.linkedEvent"
                                        class="w-full bg-[#FAF5F2] border border-neutral-300 rounded-xl px-3 py-2 text-xs text-neutral-800 focus:outline-none focus:ring-2 focus:ring-[#5F8C72] focus:bg-white cursor-pointer">
                                        <option value="">-- Tanpa Tautan Seminar --</option>
                                        <option value="Seminar Mindful Motherhood (Solo)">Seminar Mindful Motherhood
                                            (Solo)</option>
                                        <option value="Seminar Gizi 1000 Hari Pertama (Jogja)">Seminar Gizi 1000 Hari
                                            Pertama (Jogja)</option>
                                        <option value="Kelas Gentle Birth & Hypnobirthing">Kelas Gentle Birth &
                                            Hypnobirthing</option>
                                    </select>
                                </div>
                            </div>

                            {{-- Ringkasan Singkat / Excerpt --}}
                            <div>
                                <label class="block text-xs font-bold text-neutral-700 mb-1">Ringkasan Singkat (Muncul
                                    di Halaman Depan Katalog Artikel)</label>
                                <input type="text" x-model="articleForm.excerpt"
                                    placeholder="Tulis ringkasan singkat 1-2 kalimat untuk menarik minat pembaca..."
                                    class="w-full bg-[#FAF5F2] border border-neutral-300 rounded-xl px-4 py-2 text-xs text-neutral-800 focus:outline-none focus:ring-2 focus:ring-[#5F8C72] focus:bg-white">
                            </div>

                            {{-- Area Ketikan Konten Artikel --}}
                            <div>
                                <label class="block text-xs font-bold text-neutral-700 mb-1">Isi Konten Artikel (Teks
                                    Lengkap)</label>
                                <div
                                    class="bg-[#FAF5F2] border border-neutral-300 rounded-2xl overflow-hidden focus-within:ring-2 focus-within:ring-[#5F8C72] focus-within:bg-white">
                                    {{-- Toolbar Simpel --}}
                                    <div
                                        class="flex items-center gap-1 p-2 border-b border-neutral-200/80 bg-white/70 text-neutral-600 text-xs">
                                        <button type="button" class="p-1.5 hover:bg-neutral-100 rounded"
                                            title="Tebal"><i class="fa-solid fa-bold"></i></button>
                                        <button type="button" class="p-1.5 hover:bg-neutral-100 rounded"
                                            title="Miring"><i class="fa-solid fa-italic"></i></button>
                                        <button type="button" class="p-1.5 hover:bg-neutral-100 rounded"
                                            title="List"><i class="fa-solid fa-list-ul"></i></button>
                                        <button type="button" class="p-1.5 hover:bg-neutral-100 rounded"
                                            title="Heading"><i class="fa-solid fa-heading"></i></button>
                                    </div>
                                    <textarea x-model="articleForm.content" rows="7"
                                        placeholder="Ketikkan materi dan isi artikel lengkap di sini... (Contoh: Menjaga asupan gizi seimbang saat hamil sangat penting untuk perkembangan janin...)"
                                        class="w-full p-4 bg-transparent text-xs text-neutral-800 focus:outline-none leading-relaxed"></textarea>
                                </div>
                            </div>

                            {{-- Tombol Publikasi --}}
                            <div class="flex items-center justify-end gap-3 pt-2">
                                <button type="submit"
                                    class="bg-[#5F8C72] hover:bg-[#4f755e] text-white font-bold py-2.5 px-6 rounded-xl text-xs flex items-center gap-2 transition shadow-xs cursor-pointer">
                                    <i class="fa-solid fa-paper-plane"></i>
                                    <span>Publikasikan Artikel ke Website</span>
                                </button>
                            </div>
                        </form>
                    </div>

                    {{-- Daftar Artikel yang Sudah Terbit --}}
                    <div class="bg-white rounded-3xl p-6 border border-neutral-200/70 shadow-2xs">
                        <h3 class="font-bold text-sm text-neutral-900 mb-4">Artikel yang Sudah Diterbitkan</h3>
                        <div class="divide-y divide-neutral-100">
                            <template x-for="art in articles" :key="art.id">
                                <div
                                    class="py-3.5 flex items-center justify-between gap-4 hover:bg-[#FAF5F2]/50 px-2 rounded-xl transition">
                                    <div class="min-w-0">
                                        <div class="flex items-center gap-2 mb-1">
                                            <span :class="art.categoryColor"
                                                class="text-[10px] font-bold px-2 py-0.5 rounded-full"
                                                x-text="art.category"></span>
                                            <span class="text-[10px] text-neutral-400"
                                                x-text="art.publishedAt"></span>
                                        </div>
                                        <p class="font-bold text-xs text-neutral-900 truncate" x-text="art.title"></p>
                                        <p class="text-[11px] text-neutral-500 truncate" x-text="art.excerpt"></p>
                                    </div>
                                    <div class="flex items-center gap-2 shrink-0">
                                        <a :href="'/articles/' + (art.id === 1 ? 'nutrisi-seimbang-untuk-ibu-hamil' :
                                            'cara-mengelola-stres-pada-ibu-hamil')"
                                            target="_blank"
                                            class="p-2 text-neutral-500 hover:text-[#5F8C72] hover:bg-emerald-50 rounded-xl transition"
                                            title="Lihat di Halaman User">
                                            <i class="fa-solid fa-arrow-up-right-from-square text-xs"></i>
                                        </a>
                                        <button type="button"
                                            @click="articles = articles.filter(a => a.id !== art.id)"
                                            class="p-2 text-neutral-500 hover:text-red-600 hover:bg-red-50 rounded-xl transition"
                                            title="Hapus Artikel">
                                            <i class="fa-solid fa-trash-can text-xs"></i>
                                        </button>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>

                </div>

                {{-- ═════════════════════════════════════════════════════════
                     TAB 4: JADWAL EVENT & PELATIHAN (EVENT LIBRARY)
                ═════════════════════════════════════════════════════════ --}}
                <div x-show="activeTab === 'events'" class="space-y-6">

                    {{-- Header Event Section --}}
                    <div
                        class="bg-white rounded-3xl p-6 border border-neutral-200/70 shadow-2xs flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div>
                            <h2 class="text-base font-bold text-neutral-900">Manajemen Jadwal Seminar & Pelatihan</h2>
                            <p class="text-xs text-neutral-500 mt-0.5">Upload event pelatihan baru, tentukan kuota
                                pendaftar, jadwal narasumber, dan harga tiket.</p>
                        </div>
                        <div class="flex items-center gap-3 flex-wrap">
                            <a href="{{ route('events') }}" target="_blank"
                                class="bg-[#FAF5F2] hover:bg-[#F3E1DC] text-neutral-700 text-xs font-bold px-4 py-2.5 rounded-xl flex items-center gap-2 transition border border-[#DEAAA1]/40">
                                <i class="fa-solid fa-eye text-[#B96A5C]"></i>
                                <span>Lihat Katalog Publik</span>
                            </a>
                            <a href="{{ route('admin.event.create') }}"
                                class="bg-[#5F8C72] hover:bg-[#4f755e] text-white text-xs font-bold px-4 py-2.5 rounded-xl flex items-center gap-2 transition shadow-xs cursor-pointer">
                                <i class="fa-solid fa-calendar-plus"></i>
                                <span>+ Upload Pelatihan Baru</span>
                            </a>
                        </div>
                    </div>

                    @if (false)
                        {{-- Form moved to /admin/event/add. --}}
                        <div x-show="showEventModal" x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 -translate-y-4"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            class="bg-white rounded-3xl p-6 sm:p-8 border-2 border-[#5F8C72]/40 shadow-md space-y-6 relative">

                            <div class="flex items-center justify-between pb-4 border-b border-neutral-100">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-10 h-10 rounded-2xl bg-[#E4F5E6] text-[#428E53] flex items-center justify-center">
                                        <i class="fa-solid fa-calendar-plus text-base"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-base text-neutral-900 font-serif-brand">Form Upload
                                            Pelatihan / Seminar Baru</h3>
                                        <p class="text-xs text-neutral-500">Isi detail lengkap untuk menerbitkan event
                                            ke
                                            halaman user</p>
                                    </div>
                                </div>
                                <button type="button" @click="showEventModal = false"
                                    class="text-neutral-400 hover:text-neutral-700 p-2">
                                    <i class="fa-solid fa-xmark text-lg"></i>
                                </button>
                            </div>

                            <form action="{{ route('admin.event.store') }}" method="POST" class="space-y-5">
                                @csrf

                                {{-- Baris 1: Judul & Kategori --}}
                                <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                                    <div class="md:col-span-8">
                                        <label class="block text-xs font-bold text-neutral-700 mb-1">Judul Seminar /
                                            Pelatihan <span class="text-red-500">*</span></label>
                                        <input type="text" name="title" x-model="eventForm.title"
                                            placeholder="Contoh: Workshop Yoga Prenatal & Manajemen Nafas Persalinan"
                                            class="w-full bg-[#FAF5F2] border border-neutral-300 rounded-xl px-4 py-2.5 text-xs text-neutral-900 focus:outline-none focus:ring-2 focus:ring-[#5F8C72] focus:bg-white font-medium">
                                    </div>
                                    <div class="md:col-span-4">
                                        <label class="block text-xs font-bold text-neutral-700 mb-1">Kategori
                                            Pelatihan</label>
                                        <select name="categories" x-model="eventForm.category"
                                            class="w-full bg-[#FAF5F2] border border-neutral-300 rounded-xl px-3 py-2.5 text-xs text-neutral-800 focus:outline-none focus:ring-2 focus:ring-[#5F8C72] focus:bg-white cursor-pointer font-medium">
                                            <template x-for="category in eventCategories" :key="category.id">
                                                <option :value="category.id" x-text="category.name"></option>
                                            </template>
                                        </select>
                                    </div>
                                </div>

                                {{-- Baris 2: Poster & Tanggal --}}
                                <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-start">

                                    {{-- Area Upload Poster / Gambar --}}
                                    <div class="md:col-span-6">
                                        <label class="block text-xs font-bold text-neutral-700 mb-1">Poster / Foto
                                            Banner
                                            Event</label>
                                        <label
                                            class="flex flex-col items-center justify-center border-2 border-dashed border-neutral-300 hover:border-[#5F8C72] rounded-2xl p-4 text-center cursor-pointer bg-[#FAF5F2] hover:bg-white transition h-40 relative overflow-hidden">
                                            <input type="file" accept="image/*" class="hidden"
                                                @change="handleEventPoster($event)">

                                            <template x-if="!eventPosterPreview">
                                                <div class="space-y-1">
                                                    <i class="fa-regular fa-image text-2xl text-neutral-400"></i>
                                                    <p class="text-xs font-bold text-neutral-800">Upload Poster
                                                        Pelatihan
                                                    </p>
                                                    <p class="text-[10px] text-neutral-500">Format JPG, PNG (Rasio 16:9
                                                        disarankan)</p>
                                                </div>
                                            </template>

                                            <template x-if="eventPosterPreview">
                                                <div class="w-full h-full relative">
                                                    <img :src="eventPosterPreview"
                                                        class="w-full h-full object-cover rounded-xl">
                                                    <span
                                                        class="absolute bottom-2 right-2 bg-neutral-900/70 text-white text-[10px] font-bold px-2 py-0.5 rounded-md">Ganti
                                                        Poster</span>
                                                </div>
                                            </template>
                                        </label>
                                    </div>

                                    {{-- Tanggal, Jam & Format --}}
                                    <div class="md:col-span-6 space-y-3">
                                        <div>
                                            <label class="block text-xs font-bold text-neutral-700 mb-1">Tanggal
                                                Pelaksanaan</label>
                                            <input type="date" name="event_date" x-model="eventForm.date"
                                                class="w-full bg-[#FAF5F2] border border-neutral-300 rounded-xl px-4 py-2 text-xs text-neutral-800 focus:outline-none focus:ring-2 focus:ring-[#5F8C72] focus:bg-white">
                                        </div>
                                        <div class="grid grid-cols-2 gap-3">
                                            <div>
                                                <label
                                                    class="block text-xs font-bold text-neutral-700 mb-1">Pendaftaran
                                                    Dibuka</label>
                                                <input type="date" name="open_registration_date"
                                                    x-model="eventForm.openDate"
                                                    class="w-full bg-[#FAF5F2] border border-neutral-300 rounded-xl px-3 py-2 text-xs text-neutral-800 focus:outline-none focus:ring-2 focus:ring-[#5F8C72] focus:bg-white">
                                            </div>
                                            <div>
                                                <label
                                                    class="block text-xs font-bold text-neutral-700 mb-1">Pendaftaran
                                                    Ditutup</label>
                                                <input type="date" name="close_registration_date"
                                                    x-model="eventForm.closeDate"
                                                    class="w-full bg-[#FAF5F2] border border-neutral-300 rounded-xl px-3 py-2 text-xs text-neutral-800 focus:outline-none focus:ring-2 focus:ring-[#5F8C72] focus:bg-white">
                                            </div>
                                        </div>
                                        <div>
                                            <label class="block text-xs font-bold text-neutral-700 mb-1">Lokasi / Venue
                                                Acara</label>
                                            <input type="text" name="location" x-model="eventForm.location"
                                                placeholder="Grand Mercure Solo / Hotel Tentrem Jogja / Zoom Cloud"
                                                class="w-full bg-[#FAF5F2] border border-neutral-300 rounded-xl px-4 py-2 text-xs text-neutral-800 focus:outline-none focus:ring-2 focus:ring-[#5F8C72] focus:bg-white">
                                        </div>
                                    </div>

                                </div>

                                {{-- Baris 3: Pemateri, Kuota & Harga --}}
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div>
                                        <label class="block text-xs font-bold text-neutral-700 mb-1">Nama Pemateri /
                                            Dokter
                                            Ahli</label>
                                        <input type="text" name="speaker" x-model="eventForm.speaker"
                                            placeholder="dr. Annisa Pratama, Sp.OG"
                                            class="w-full bg-[#FAF5F2] border border-neutral-300 rounded-xl px-3.5 py-2 text-xs text-neutral-800 focus:outline-none focus:ring-2 focus:ring-[#5F8C72] focus:bg-white">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-neutral-700 mb-1">Harga Tiket
                                            Pendaftaran (Rp)</label>
                                        <input type="number" name="fee" x-model="eventForm.price"
                                            placeholder="54000"
                                            class="w-full bg-[#FAF5F2] border border-neutral-300 rounded-xl px-3.5 py-2 text-xs text-neutral-800 focus:outline-none focus:ring-2 focus:ring-[#5F8C72] focus:bg-white">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-neutral-700 mb-1">Target Kuota
                                            Peserta</label>
                                        <input type="number" name="slot" x-model="eventForm.quota"
                                            placeholder="100"
                                            class="w-full bg-[#FAF5F2] border border-neutral-300 rounded-xl px-3.5 py-2 text-xs text-neutral-800 focus:outline-none focus:ring-2 focus:ring-[#5F8C72] focus:bg-white">
                                    </div>
                                </div>

                                {{-- Baris 4: Deskripsi & Tombol Aksi --}}
                                <div>
                                    <label class="block text-xs font-bold text-neutral-700 mb-1">Deskripsi Singkat &
                                        Materi
                                        Pembelajaran</label>
                                    <textarea name="description" x-model="eventForm.description" rows="3"
                                        placeholder="Tulis ringkasan topik yang akan dipelajari oleh peserta selama sesi pelatihan..."
                                        class="w-full bg-[#FAF5F2] border border-neutral-300 rounded-xl p-3.5 text-xs text-neutral-800 focus:outline-none focus:ring-2 focus:ring-[#5F8C72] focus:bg-white"></textarea>
                                </div>

                                <div class="flex items-center justify-end gap-3 pt-3 border-t border-neutral-100">
                                    <button type="button" @click="showEventModal = false"
                                        class="px-5 py-2.5 rounded-xl text-xs font-semibold text-neutral-600 hover:bg-neutral-100 transition cursor-pointer">
                                        Batal
                                    </button>
                                    <button type="submit"
                                        class="bg-[#5F8C72] hover:bg-[#4f755e] text-white font-bold py-2.5 px-6 rounded-xl text-xs flex items-center gap-2 transition shadow-sm cursor-pointer">
                                        <i class="fa-solid fa-cloud-arrow-up"></i>
                                        <span>Publikasikan Pelatihan ke Website</span>
                                    </button>
                                </div>

                            </form>
                        </div>
                    @endif

                    {{-- ── FILTER PER BULAN & ACTION BAR ── --}}
                    <div class="bg-white rounded-3xl p-5 sm:p-6 border border-neutral-200/70 shadow-2xs space-y-4">
                        <div
                            class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-neutral-100">
                            <div>
                                <h3 class="font-bold text-sm text-neutral-900">Daftar Jadwal Pelatihan & Seminar</h3>
                                <p class="text-[11px] text-neutral-500">
                                    Menampilkan <span class="font-bold text-neutral-800"
                                        x-text="filteredEvents.length"></span> jadwal kegiatan
                                </p>
                            </div>

                            {{-- Filter Per Bulan (Pills / Buttons) --}}
                            <div class="flex items-center gap-1.5 overflow-x-auto pb-1 sm:pb-0 custom-scrollbar">
                                <button type="button" @click="eventMonthFilter = 'all'"
                                    :class="eventMonthFilter === 'all' ? 'bg-[#5F8C72] text-white font-bold' :
                                        'bg-[#FAF5F2] text-neutral-600 hover:bg-neutral-100 font-medium'"
                                    class="px-3.5 py-1.5 rounded-full text-xs transition shrink-0 cursor-pointer">
                                    Semua Bulan (<span x-text="events.length"></span>)
                                </button>
                                <template x-for="month in @js($adminEventMonths ?? [])" :key="month.month">
                                    <button type="button" @click="eventMonthFilter = month.month"
                                        :class="eventMonthFilter === month.month ? 'bg-[#5F8C72] text-white font-bold' :
                                            'bg-[#FAF5F2] text-neutral-600 hover:bg-neutral-100 font-medium'"
                                        class="px-3.5 py-1.5 rounded-full text-xs transition shrink-0 cursor-pointer"
                                        x-text="month.monthLabel"></button>
                                </template>
                            </div>
                        </div>

                        {{-- ── TABEL LIST JADWAL PELATIHAN (COMPACT & MUDAH DIMANTENANSI) ── --}}
                        <div class="overflow-x-auto custom-scrollbar">
                            <table class="w-full text-left text-xs">
                                <thead>
                                    <tr class="text-neutral-500 font-semibold text-[11px] border-b border-neutral-100">
                                        <th class="py-3 px-3">Event / Pelatihan</th>
                                        <th class="py-3 px-3">Jadwal & Waktu</th>
                                        <th class="py-3 px-3">Pemateri & Lokasi</th>
                                        <th class="py-3 px-3">Tiket & Kuota</th>
                                        <th class="py-3 px-3">Status</th>
                                        <th class="py-3 px-3 text-right">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-neutral-100">
                                    <template x-for="ev in filteredEvents" :key="ev.id">
                                        <tr class="hover:bg-[#FAF5F2]/60 transition group">

                                            {{-- Kolom 1: Poster & Judul Pelatihan --}}
                                            <td class="py-3.5 px-3">
                                                <div class="flex items-center gap-3">
                                                    <img :src="ev.posterUrl" alt="Poster"
                                                        x-on:error="$event.target.src = '{{ asset('images/placeholder.jpg') }}'"
                                                        class="w-12 h-12 rounded-xl object-cover border border-neutral-200 shrink-0">
                                                    <div class="min-w-0">
                                                        <p class="font-bold text-neutral-900 group-hover:text-[#5F8C72] transition leading-snug"
                                                            x-text="ev.title"></p>
                                                        <div class="flex items-center gap-2 mt-1">
                                                            <span :class="ev.categoryColor"
                                                                class="text-[10px] font-bold px-2 py-0.5 rounded-full border border-[#DEAAA1]/30"
                                                                x-text="ev.category"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>

                                            {{-- Kolom 2: Jadwal & Jam --}}
                                            <td class="py-3.5 px-3 whitespace-nowrap">
                                                <div class="space-y-0.5">
                                                    <p
                                                        class="font-bold text-neutral-800 text-xs flex items-center gap-1.5">
                                                        <i class="fa-regular fa-calendar text-[#5F8C72]"></i>
                                                        <span x-text="ev.date"></span>
                                                    </p>
                                                    <p class="text-[11px] text-neutral-500 font-mono"
                                                        x-text="ev.registrationPeriod"></p>
                                                </div>
                                            </td>

                                            {{-- Kolom 3: Pemateri & Format Lokasi --}}
                                            <td class="py-3.5 px-3">
                                                <div class="space-y-0.5 max-w-xs">
                                                    <p
                                                        class="font-semibold text-neutral-800 text-xs flex items-center gap-1.5 truncate">
                                                        <i
                                                            class="fa-solid fa-user-doctor text-emerald-700 text-[11px]"></i>
                                                        <span x-text="ev.speaker"></span>
                                                    </p>
                                                    <p
                                                        class="text-[11px] text-neutral-500 flex items-center gap-1.5 truncate">
                                                        <i
                                                            class="fa-solid fa-location-dot text-[#DE6657] text-[11px]"></i>
                                                        <span x-text="ev.location"></span>
                                                    </p>
                                                </div>
                                            </td>

                                            {{-- Kolom 4: Tiket & Progress Kuota --}}
                                            <td class="py-3.5 px-3 whitespace-nowrap">
                                                <div>
                                                    <span class="font-extrabold text-sm text-[#DE6657]"
                                                        x-text="ev.price"></span>
                                                    <div class="flex items-center gap-2 mt-1">
                                                        <div
                                                            class="w-16 bg-neutral-200 rounded-full h-1.5 overflow-hidden">
                                                            <div class="bg-[#5F8C72] h-1.5 rounded-full"
                                                                :style="'width: ' + Math.min((ev.registered / ev.quota) * 100,
                                                                    100) + '%'">
                                                            </div>
                                                        </div>
                                                        <span class="text-[10px] text-neutral-500 font-mono"
                                                            x-text="ev.registered + '/' + ev.quota"></span>
                                                    </div>
                                                </div>
                                            </td>

                                            {{-- Kolom 5: Status Badge --}}
                                            <td class="py-3.5 px-3 whitespace-nowrap">
                                                <template x-if="ev.status === 'open'">
                                                    <span
                                                        class="inline-flex items-center gap-1 bg-emerald-100 text-emerald-800 font-bold px-2.5 py-1 rounded-full text-[10px]">
                                                        <span
                                                            class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                                        Buka
                                                    </span>
                                                </template>
                                                <template x-if="ev.status === 'closed'">
                                                    <span
                                                        class="inline-flex items-center gap-1 bg-neutral-100 text-neutral-600 font-bold px-2.5 py-1 rounded-full text-[10px]">
                                                        Selesai
                                                    </span>
                                                </template>
                                            </td>

                                            {{-- Kolom 6: Aksi Cepat --}}
                                            <td class="py-3.5 px-3 whitespace-nowrap text-right">
                                                <div class="flex items-center justify-end gap-1.5">
                                                    <a href="{{ route('events') }}" target="_blank"
                                                        class="p-1.5 text-neutral-500 hover:text-[#5F8C72] hover:bg-emerald-50 rounded-lg transition"
                                                        title="Preview Halaman Pelatihan">
                                                        <i class="fa-solid fa-arrow-up-right-from-square text-xs"></i>
                                                    </a>
                                                    <a :href="'{{ url('/admin/event') }}/' + ev.slug + '/edit'"
                                                        class="p-1.5 text-neutral-500 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition"
                                                        title="Edit Jadwal">
                                                        <i class="fa-solid fa-pen-to-square text-xs"></i>
                                                    </a>
                                                    <button type="button"
                                                        @click="events = events.filter(e => e.id !== ev.id)"
                                                        class="p-1.5 text-neutral-500 hover:text-red-600 hover:bg-red-50 rounded-lg transition"
                                                        title="Hapus Pelatihan">
                                                        <i class="fa-solid fa-trash-can text-xs"></i>
                                                    </button>
                                                </div>
                                            </td>

                                        </tr>
                                    </template>

                                    {{-- Empty State Jika Tidak Ada Event di Bulan Terpilih --}}
                                    <tr x-show="filteredEvents.length === 0">
                                        <td colspan="6" class="py-12 text-center text-neutral-400">
                                            <div
                                                class="w-12 h-12 rounded-2xl bg-neutral-100 flex items-center justify-center mx-auto mb-3 text-neutral-400">
                                                <i class="fa-regular fa-calendar-xmark text-xl"></i>
                                            </div>
                                            <p class="font-bold text-xs text-neutral-700">Tidak ada jadwal pelatihan di
                                                bulan ini</p>
                                            <p class="text-[11px] text-neutral-500 mt-0.5">Pilih bulan lain atau klik
                                                tombol "+ Upload Pelatihan Baru" di atas</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>

                {{-- ═════════════════════════════════════════════════════════
                     TAB 5: E-BOOK & KNOWLEDGE LIBRARY (PDF MODUL)
                ═════════════════════════════════════════════════════════ --}}
                <div x-show="activeTab === 'library'" class="space-y-6">
                    <div class="bg-white rounded-3xl p-6 border border-neutral-200/70 shadow-2xs space-y-5">
                        <div
                            class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-neutral-100">
                            <div>
                                <h2 class="text-base font-bold text-neutral-900">Repositori E-Book & Modul</h2>
                                <p class="text-xs text-neutral-500 mt-0.5">Daftar materi digital yang tersimpan di
                                    database.</p>
                            </div>
                            <a href="{{ route('admin.ebook.create') }}"
                                class="bg-[#5F8C72] hover:bg-[#4f755e] text-white text-xs font-bold px-4 py-2.5 rounded-xl flex items-center gap-2 transition shadow-xs">
                                <i class="fa-solid fa-plus"></i>
                                <span>Tambah E-Book</span>
                            </a>
                        </div>

                        <div class="overflow-x-auto custom-scrollbar">
                            <table class="w-full min-w-[1240px] text-left text-xs">
                                <thead>
                                    <tr class="text-neutral-500 font-semibold text-[11px] border-b border-neutral-100">
                                        <th class="py-3 px-3">E-Book / ID</th>
                                        <th class="py-3 px-3">Kategori</th>
                                        <th class="py-3 px-3">Deskripsi</th>
                                        <th class="py-3 px-3">File PDF</th>
                                        <th class="py-3 px-3">Uploader</th>
                                        <th class="py-3 px-3">Event Terkait</th>
                                        <th class="py-3 px-3">Dibuat / Diubah</th>
                                        <th class="py-3 px-3 text-right">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-neutral-100">
                                    @forelse (($adminMaterials ?? collect()) as $material)
                                        <tr class="hover:bg-[#FAF5F2]/60 transition align-top">
                                            <td class="py-4 px-3 max-w-[230px]">
                                                <div class="flex items-start gap-3">
                                                    <img src="{{ $material['imageUrl'] }}"
                                                        alt="{{ $material['title'] }}"
                                                        x-on:error="$event.target.src = '{{ asset('images/placeholder.jpg') }}'"
                                                        class="w-12 h-12 rounded-xl object-cover border border-neutral-200 shrink-0">
                                                    <div class="min-w-0">
                                                        <p class="font-bold text-neutral-900 leading-snug">
                                                            {{ $material['title'] }}</p>
                                                        <p
                                                            class="mt-1 text-[10px] text-neutral-500 font-mono break-all">
                                                            {{ $material['slug'] }}</p>
                                                        <p
                                                            class="mt-1 text-[9px] text-neutral-400 font-mono break-all">
                                                            ID: {{ $material['id'] }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="py-4 px-3 whitespace-nowrap">
                                                <span
                                                    class="inline-flex rounded-full bg-[#FAF5F2] px-2.5 py-1 text-[10px] font-bold text-[#8C433C]">{{ $material['category'] }}</span>
                                            </td>
                                            <td
                                                class="py-4 px-3 max-w-[240px] text-[11px] leading-relaxed text-neutral-600">
                                                {{ $material['description'] }}
                                            </td>
                                            <td class="py-4 px-3 max-w-[190px]">
                                                @if ($material['downloadUrl'])
                                                    <a href="{{ $material['downloadUrl'] }}"
                                                        class="inline-flex items-center gap-2 rounded-xl bg-[#FAF5F2] px-3 py-2 text-[10px] font-bold text-[#8C433C] hover:bg-[#F3E1DC]">
                                                        <i class="fa-solid fa-download"></i>
                                                        <span class="break-all">{{ $material['fileName'] }}</span>
                                                    </a>
                                                @else
                                                    <span class="text-[11px] text-neutral-400">Belum ada PDF</span>
                                                @endif
                                            </td>
                                            <td class="py-4 px-3 whitespace-nowrap">
                                                <p class="font-semibold text-neutral-800">{{ $material['uploader'] }}
                                                </p>
                                                <p class="mt-1 text-[10px] text-neutral-500">
                                                    {{ $material['uploaderEmail'] }}</p>
                                                <p class="mt-1 text-[9px] text-neutral-400 font-mono break-all">ID:
                                                    {{ $material['uploadedBy'] }}</p>
                                            </td>
                                            <td class="py-4 px-3 max-w-[200px]">
                                                @if (count($material['events']))
                                                    <div class="space-y-1">
                                                        @foreach ($material['events'] as $eventTitle)
                                                            <p class="text-[11px] text-neutral-600">
                                                                {{ $eventTitle }}</p>
                                                        @endforeach
                                                    </div>
                                                @else
                                                    <span class="text-[11px] text-neutral-400">Belum terhubung</span>
                                                @endif
                                            </td>
                                            <td class="py-4 px-3 whitespace-nowrap text-[10px] text-neutral-500">
                                                <p>{{ $material['createdAt'] }}</p>
                                                <p class="mt-1">{{ $material['updatedAt'] }}</p>
                                            </td>
                                            <td class="py-4 px-3 whitespace-nowrap text-right">
                                                <div class="inline-flex items-center gap-1">
                                                    <a href="{{ route('admin.ebook.edit', $material['id']) }}"
                                                        class="p-1.5 text-neutral-500 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition"
                                                        title="Edit E-Book">
                                                        <i class="fa-solid fa-pen-to-square text-xs"></i>
                                                    </a>
                                                    <form action="{{ route('admin.ebook.destroy', $material['id']) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Hapus e-book ini secara permanen beserta file PDF-nya?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="p-1.5 text-neutral-500 hover:text-red-600 hover:bg-red-50 rounded-lg transition"
                                                            title="Hapus E-Book">
                                                            <i class="fa-solid fa-trash-can text-xs"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="py-12 text-center text-neutral-400">
                                                <i class="fa-regular fa-folder-open text-2xl mb-2"></i>
                                                <p class="font-bold text-xs text-neutral-700">Belum ada e-book</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </main>
        </div>

    </div>

    {{-- ═════════════════════════════════════════════════════════
         MODAL LIHAT BUKTI TRANSFER & APPROVAL USER DETAIL
    ═════════════════════════════════════════════════════════ --}}
    <div x-show="showProofModal" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-neutral-900/60 backdrop-blur-xs">

        <div class="bg-white rounded-3xl p-6 sm:p-8 max-w-lg w-full shadow-2xl border border-neutral-100 space-y-5"
            @click.outside="showProofModal = false">

            {{-- Modal Header --}}
            <div class="flex items-center justify-between pb-3 border-b border-neutral-100">
                <div>
                    <h3 class="font-bold text-base text-neutral-900 font-serif-brand">Verifikasi Pembayaran Peserta
                    </h3>
                    <p class="text-xs text-neutral-500" x-text="'No. Transaksi: ' + selectedVerification?.id"></p>
                </div>
                <button @click="showProofModal = false" class="text-neutral-400 hover:text-neutral-700">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>

            {{-- Detail Data User --}}
            <div class="bg-[#FAF5F2] rounded-2xl p-4 space-y-2 border border-[#EFE8E3] text-xs">
                <div class="flex justify-between">
                    <span class="text-neutral-500">Nama Pendaftar:</span>
                    <strong class="text-neutral-900" x-text="selectedVerification?.userName"></strong>
                </div>
                <div class="flex justify-between">
                    <span class="text-neutral-500">WhatsApp:</span>
                    <strong class="text-neutral-900 font-mono" x-text="selectedVerification?.userWhatsapp"></strong>
                </div>
                <div class="flex justify-between">
                    <span class="text-neutral-500">Pelatihan:</span>
                    <strong class="text-neutral-900" x-text="selectedVerification?.eventName"></strong>
                </div>
                <div class="flex justify-between">
                    <span class="text-neutral-500">Total Dibayar:</span>
                    <strong class="text-[#DE6657] font-bold text-sm" x-text="selectedVerification?.amount"></strong>
                </div>
            </div>

            {{-- Preview Bukti Gambar Transfer --}}
            <div>
                <p class="text-xs font-bold text-neutral-700 mb-2">Foto / Bukti Transfer QRIS:</p>
                <div
                    class="w-full h-52 rounded-2xl bg-neutral-100 overflow-hidden border border-neutral-200 flex items-center justify-center">
                    <img :src="selectedVerification?.proofUrl" alt="Bukti Transfer"
                        class="w-full h-full object-cover">
                </div>
            </div>

            {{-- Tombol Aksi --}}
            <div class="flex items-center gap-3 pt-2">
                <button type="button" @click="rejectVerification(selectedVerification)"
                    class="flex-1 bg-red-50 hover:bg-red-100 text-red-600 font-bold py-2.5 px-4 rounded-xl text-xs transition cursor-pointer text-center">
                    Tolak Pembayaran
                </button>
                <button type="button" @click="approveVerification(selectedVerification)"
                    class="flex-1 bg-[#5F8C72] hover:bg-[#4f755e] text-white font-bold py-2.5 px-4 rounded-xl text-xs transition shadow-xs cursor-pointer text-center">
                    Setujui & Buka Akses User
                </button>
            </div>

        </div>
    </div>

</body>

</html>
