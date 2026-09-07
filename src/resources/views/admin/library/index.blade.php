<x-layout title="Knowledge Library — Admin Portal Maternity.id">
    <x-slot name="head">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <style>
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
    </x-slot>

    {{-- Main Container with Admin Sidebar & Dashboard --}}
    <div x-data="{ 
            searchQuery: '',
            selectedCategory: 'all',
            mobileSidebar: false,
            uploadedFile: null,
            fileName: '',
            fileSize: '',
            uploadProgress: 0,
            isDragging: false,
            resources: [
                {
                    id: 1,
                    title: 'Nutritional Guide for Expectant Mothers v2.pdf',
                    slug: 'nutritional-guide-v2',
                    type: 'Nutrisi',
                    categoryColor: 'bg-[#FCEBE7] text-[#C97A70]',
                    size: '4.8 MB',
                    date: '12 Okt 2024',
                    uploader: 'Sarah Admin',
                    uploaderAvatar: 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=100&h=100&fit=crop',
                    views: 450,
                    downloads: 120,
                    linkedEvent: 'Seminar Gizi 1000 Hari Pertama'
                },
                {
                    id: 2,
                    title: 'Prenatal Yoga & Breathing Techniques.pdf',
                    slug: 'prenatal-yoga-breathing',
                    type: 'Yoga',
                    categoryColor: 'bg-[#E4F5E6] text-[#428E53]',
                    size: '7.2 MB',
                    date: '08 Okt 2024',
                    uploader: 'Bidan Ratna',
                    uploaderAvatar: 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=100&h=100&fit=crop',
                    views: 320,
                    downloads: 98,
                    linkedEvent: 'Mindful Motherhood Workshop'
                },
                {
                    id: 3,
                    title: 'Persiapan Persalinan Nyaman & Tenang.pdf',
                    slug: 'persiapan-persalinan-nyaman',
                    type: 'Persalinan',
                    categoryColor: 'bg-[#EDE9FE] text-[#6D28D9]',
                    size: '5.1 MB',
                    date: '28 Sep 2024',
                    uploader: 'dr. Anita Sp.OG',
                    uploaderAvatar: 'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=100&h=100&fit=crop',
                    views: 180,
                    downloads: 65,
                    linkedEvent: 'Kelas Persalinan Alami & Gentle Birth'
                },
                {
                    id: 4,
                    title: 'Panduan Praktis Menyusui & Manajemen ASI.pdf',
                    slug: 'panduan-menyusui-asi',
                    type: 'Laktasi',
                    categoryColor: 'bg-[#FEF3C7] text-[#B45309]',
                    size: '3.9 MB',
                    date: '15 Sep 2024',
                    uploader: 'Sarah Admin',
                    uploaderAvatar: 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=100&h=100&fit=crop',
                    views: 90,
                    downloads: 42,
                    linkedEvent: null
                }
            ],
            handleFileSelect(e) {
                const file = e.target.files?.[0] || (e.dataTransfer && e.dataTransfer.files[0]);
                if (file) {
                    this.uploadedFile = file;
                    this.fileName = file.name;
                    this.fileSize = (file.size / (1024 * 1024)).toFixed(2) + ' MB';
                }
            },
            removeFile() {
                this.uploadedFile = null;
                this.fileName = '';
                this.fileSize = '';
                if (this.$refs.fileInput) this.$refs.fileInput.value = '';
            },
            get filteredResources() {
                return this.resources.filter(item => {
                    const matchCategory = (this.selectedCategory === 'all' || item.type.toLowerCase() === this.selectedCategory.toLowerCase());
                    const matchQuery = item.title.toLowerCase().includes(this.searchQuery.toLowerCase()) || 
                                       item.uploader.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                                       (item.linkedEvent && item.linkedEvent.toLowerCase().includes(this.searchQuery.toLowerCase()));
                    return matchCategory && matchQuery;
                });
            }
         }" 
         class="min-h-screen bg-[#FAF5F2] text-neutral-800 flex font-sans -mx-4 sm:-mx-6 lg:-mx-8 -my-8 rounded-3xl overflow-hidden shadow-xs border border-[#EFE8E3]">

        {{-- ── 1. SIDEBAR NAVIGASI (DESKTOP & MOBILE DRAWER) ── --}}
        
        {{-- Mobile Overlay --}}
        <div x-show="mobileSidebar" 
             x-transition:enter="transition-opacity ease-linear duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-linear duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click="mobileSidebar = false" 
             class="fixed inset-0 bg-neutral-900/40 z-40 md:hidden"></div>

        <aside :class="mobileSidebar ? 'translate-x-0' : '-translate-x-full md:translate-x-0'"
               class="fixed md:static inset-y-0 left-0 z-50 w-64 bg-white min-h-screen p-6 border-r border-[#EFE8E3] flex flex-col justify-between shrink-0 transition-transform duration-300 ease-in-out">
            <div>
                {{-- Brand Header & Close Button (Mobile) --}}
                <div class="flex items-center justify-between mb-8">
                    <div class="flex items-center gap-2">
                        <span class="w-8 h-8 rounded-xl bg-[#5F8C72] text-white flex items-center justify-center font-bold text-sm shadow-xs">
                            M
                        </span>
                        <div>
                            <span class="font-extrabold text-sm text-[#8C433C] tracking-tight">Maternity<span class="text-[#5F8C72]">.id</span></span>
                            <span class="block text-[10px] text-neutral-400 font-medium -mt-0.5">Admin Workspace</span>
                        </div>
                    </div>
                    <button @click="mobileSidebar = false" class="md:hidden text-neutral-400 hover:text-neutral-700">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                {{-- Profil Admin Card --}}
                <div class="bg-[#FAF5F2] rounded-2xl p-3.5 flex items-center gap-3 mb-6 border border-[#EFE8E3]">
                    <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=100&h=100&fit=crop" 
                         alt="Admin Profile" class="w-10 h-10 rounded-full object-cover border-2 border-white shadow-xs shrink-0">
                    <div class="min-w-0">
                        <h4 class="text-xs font-bold text-neutral-900 truncate">Sarah Admin</h4>
                        <div class="flex items-center gap-1.5 mt-0.5">
                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                            <p class="text-[10px] text-neutral-500 font-medium truncate">Super Admin</p>
                        </div>
                    </div>
                </div>

                {{-- Menu Navigasi --}}
                <div class="space-y-1">
                    <p class="text-[10px] font-bold text-neutral-400 uppercase tracking-wider px-3 mb-2">Main Menu</p>
                    
                    <a href="{{ route('home') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-neutral-600 hover:bg-[#FAF5F2] hover:text-neutral-900 transition text-xs font-medium">
                        <svg class="w-4 h-4 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                        </svg>
                        <span>Dashboard</span>
                    </a>

                    <a href="#" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-neutral-600 hover:bg-[#FAF5F2] hover:text-neutral-900 transition text-xs font-medium">
                        <svg class="w-4 h-4 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        <span>User Management</span>
                    </a>

                    <a href="{{ route('events') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-neutral-600 hover:bg-[#FAF5F2] hover:text-neutral-900 transition text-xs font-medium">
                        <svg class="w-4 h-4 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span>Event Library</span>
                    </a>

                    {{-- Menu Aktif: Knowledge / Content Library --}}
                    <a href="#" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl bg-[#B8E6B8] text-neutral-900 transition text-xs font-bold shadow-xs">
                        <div class="flex items-center gap-3">
                            <svg class="w-4 h-4 text-emerald-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <span>Content Library</span>
                        </div>
                        <span class="text-[10px] bg-white/70 text-emerald-900 font-bold px-2 py-0.5 rounded-full">10</span>
                    </a>

                    <a href="{{ route('articles.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-neutral-600 hover:bg-[#FAF5F2] hover:text-neutral-900 transition text-xs font-medium">
                        <svg class="w-4 h-4 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H15"/>
                        </svg>
                        <span>Artikel & SEO</span>
                    </a>
                </div>
            </div>

            {{-- Sidebar Footer --}}
            <div class="pt-6 border-t border-neutral-100 space-y-2">
                <a href="{{ route('library') }}" target="_blank" class="flex items-center justify-between px-3.5 py-2 rounded-xl text-neutral-500 hover:bg-[#FAF5F2] hover:text-neutral-800 transition text-xs font-medium">
                    <span class="flex items-center gap-2">
                        <i class="fa-solid fa-arrow-up-right-from-square text-[11px]"></i>
                        <span>Lihat Publik Library</span>
                    </span>
                </a>
                <a href="{{ route('admin.login') }}" class="flex items-center gap-2 px-3.5 py-2 rounded-xl text-red-600 hover:bg-red-50 transition text-xs font-semibold">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    <span>Keluar Portal</span>
                </a>
            </div>
        </aside>

        {{-- ── 2. MAIN CONTENT AREA ── --}}
        <main class="flex-1 min-w-0 p-4 sm:p-6 md:p-8 lg:p-10 overflow-y-auto">
            
            {{-- Mobile Top Bar Toggle --}}
            <div class="flex items-center justify-between md:hidden mb-6">
                <button @click="mobileSidebar = true" class="p-2 rounded-xl bg-white border border-neutral-200 text-neutral-700 shadow-2xs">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
                <span class="font-bold text-sm text-neutral-800">Admin Portal</span>
                <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=100&h=100&fit=crop" 
                     alt="Profile" class="w-8 h-8 rounded-full object-cover">
            </div>

            {{-- Header Bar: Judul, Search & Add Resource Button --}}
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 mb-8">
                <div>
                    <h1 class="text-2xl sm:text-3xl font-bold text-neutral-900 tracking-tight" style="font-family: 'DM Serif Display', serif;">
                        Knowledge Library
                    </h1>
                    <p class="text-xs text-neutral-500 mt-1">
                        Kelola repositori dokumen digital, modul PDF, dan panduan edukasi materi seminar.
                    </p>
                </div>

                <div class="flex items-center gap-3 flex-wrap sm:flex-nowrap">
                    {{-- Search Bar --}}
                    <div class="relative w-full sm:w-64 md:w-72">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-neutral-400 pointer-events-none">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </span>
                        <input type="text" 
                               x-model="searchQuery" 
                               placeholder="Cari judul, uploader, seminar..." 
                               class="w-full bg-white border border-neutral-300/80 rounded-full pl-9 pr-8 py-2.5 text-xs focus:outline-none focus:ring-2 focus:ring-[#B96A5C] text-neutral-800 placeholder-neutral-400 shadow-2xs">
                        <button x-show="searchQuery.length > 0" 
                                @click="searchQuery = ''" 
                                class="absolute inset-y-0 right-0 flex items-center pr-3 text-neutral-400 hover:text-neutral-700">
                            <i class="fa-solid fa-circle-xmark text-xs"></i>
                        </button>
                    </div>

                    {{-- Add New Resource Button --}}
                    <button type="button" 
                            @click="document.getElementById('upload-panel-section').scrollIntoView({ behavior: 'smooth' }); document.getElementById('input-title')?.focus()"
                            class="bg-[#B96A5C] hover:bg-[#a3594c] text-white text-xs font-semibold px-4 py-2.5 rounded-full flex items-center gap-2 transition shadow-xs shrink-0 cursor-pointer">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                        </svg>
                        <span>Add New Resource</span>
                    </button>
                </div>
            </div>

            {{-- Grid Area: Metric Cards, Table & Upload Panel --}}
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8 items-start">
                
                {{-- ── 2A. KOLOM KIRI (8 COLS): METRIC CARDS & DATA TABLE ── --}}
                <div class="lg:col-span-8 space-y-6">
                    
                    {{-- 3 Metric Cards --}}
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        
                        {{-- Total Resource --}}
                        <div class="bg-white rounded-2xl p-4.5 flex items-center gap-4 border border-neutral-200/70 shadow-2xs hover:shadow-xs transition">
                            <div class="w-11 h-11 rounded-2xl bg-[#FCDDD9] flex items-center justify-center text-[#DE6657] shrink-0 shadow-2xs">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-[11px] text-neutral-500 font-medium leading-tight">Total Resource</p>
                                <div class="flex items-baseline gap-1.5 mt-0.5">
                                    <p class="text-xl font-extrabold text-neutral-900" x-text="resources.length">10</p>
                                    <span class="text-[10px] text-emerald-600 font-semibold">+2 baru</span>
                                </div>
                            </div>
                        </div>

                        {{-- Total Views --}}
                        <div class="bg-white rounded-2xl p-4.5 flex items-center gap-4 border border-neutral-200/70 shadow-2xs hover:shadow-xs transition">
                            <div class="w-11 h-11 rounded-2xl bg-[#E4F5E6] flex items-center justify-center text-[#55A967] shrink-0 shadow-2xs">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-[11px] text-neutral-500 font-medium leading-tight">Total Views</p>
                                <div class="flex items-baseline gap-1.5 mt-0.5">
                                    <p class="text-xl font-extrabold text-neutral-900">1,040</p>
                                    <span class="text-[10px] text-emerald-600 font-semibold">↑ 18%</span>
                                </div>
                            </div>
                        </div>

                        {{-- Total Downloads --}}
                        <div class="bg-white rounded-2xl p-4.5 flex items-center gap-4 border border-neutral-200/70 shadow-2xs hover:shadow-xs transition">
                            <div class="w-11 h-11 rounded-2xl bg-[#EDEDED] flex items-center justify-center text-neutral-600 shrink-0 shadow-2xs">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-[11px] text-neutral-500 font-medium leading-tight">Downloads</p>
                                <div class="flex items-baseline gap-1.5 mt-0.5">
                                    <p class="text-xl font-extrabold text-neutral-900">325</p>
                                    <span class="text-[10px] text-neutral-500 font-medium">file</span>
                                </div>
                            </div>
                        </div>

                    </div>

                    {{-- Table Card: All PDF Resources --}}
                    <div class="bg-white rounded-3xl p-5 sm:p-6 border border-neutral-200/70 shadow-2xs">
                        
                        {{-- Table Header & Category Filter Pills --}}
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-neutral-100">
                            <div>
                                <h2 class="text-base font-bold text-neutral-900">All PDF Resources</h2>
                                <p class="text-[11px] text-neutral-500 mt-0.5">
                                    Menampilkan <span class="font-bold text-neutral-800" x-text="filteredResources.length"></span> dari <span class="font-bold" x-text="resources.length"></span> dokumen
                                </p>
                            </div>

                            {{-- Filter Kategori Pills --}}
                            <div class="flex items-center gap-1.5 overflow-x-auto pb-1 sm:pb-0">
                                <button type="button" 
                                        @click="selectedCategory = 'all'" 
                                        :class="selectedCategory === 'all' ? 'bg-[#5F8C72] text-white font-bold' : 'bg-[#FAF5F2] text-neutral-600 hover:bg-neutral-100 font-medium'"
                                        class="px-3 py-1.5 rounded-full text-[11px] transition shrink-0 cursor-pointer">
                                    Semua
                                </button>
                                <button type="button" 
                                        @click="selectedCategory = 'yoga'" 
                                        :class="selectedCategory === 'yoga' ? 'bg-[#5F8C72] text-white font-bold' : 'bg-[#FAF5F2] text-neutral-600 hover:bg-neutral-100 font-medium'"
                                        class="px-3 py-1.5 rounded-full text-[11px] transition shrink-0 cursor-pointer">
                                    Yoga
                                </button>
                                <button type="button" 
                                        @click="selectedCategory = 'nutrisi'" 
                                        :class="selectedCategory === 'nutrisi' ? 'bg-[#5F8C72] text-white font-bold' : 'bg-[#FAF5F2] text-neutral-600 hover:bg-neutral-100 font-medium'"
                                        class="px-3 py-1.5 rounded-full text-[11px] transition shrink-0 cursor-pointer">
                                    Nutrisi
                                </button>
                                <button type="button" 
                                        @click="selectedCategory = 'persalinan'" 
                                        :class="selectedCategory === 'persalinan' ? 'bg-[#5F8C72] text-white font-bold' : 'bg-[#FAF5F2] text-neutral-600 hover:bg-neutral-100 font-medium'"
                                        class="px-3 py-1.5 rounded-full text-[11px] transition shrink-0 cursor-pointer">
                                    Persalinan
                                </button>
                            </div>
                        </div>

                        {{-- Table Responsive Area --}}
                        <div class="overflow-x-auto custom-scrollbar pt-2">
                            <table class="w-full text-left text-xs">
                                <thead>
                                    <tr class="text-neutral-500 font-semibold text-[11px] border-b border-neutral-100">
                                        <th class="py-3 px-2 font-semibold">Dokumen / Judul</th>
                                        <th class="py-3 px-2 font-semibold">Tipe</th>
                                        <th class="py-3 px-2 font-semibold">Tanggal</th>
                                        <th class="py-3 px-2 font-semibold">Uploader</th>
                                        <th class="py-3 px-2 font-semibold text-right">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-neutral-50">
                                    <template x-for="item in filteredResources" :key="item.id">
                                        <tr class="hover:bg-[#FAF5F2]/60 transition-colors group">
                                            {{-- Kolom Judul & Detail File --}}
                                            <td class="py-3.5 px-2">
                                                <div class="flex items-start gap-3">
                                                    <div class="w-8 h-8 rounded-xl bg-red-50 text-red-600 flex items-center justify-center shrink-0 mt-0.5 border border-red-100">
                                                        <i class="fa-solid fa-file-pdf text-sm"></i>
                                                    </div>
                                                    <div class="min-w-0">
                                                        <p class="font-bold text-neutral-900 leading-snug group-hover:text-[#B96A5C] transition-colors" x-text="item.title"></p>
                                                        <div class="flex items-center gap-2 mt-1 flex-wrap text-[10px] text-neutral-500">
                                                            <span class="font-mono bg-neutral-100 px-1.5 py-0.5 rounded text-neutral-600" x-text="item.size"></span>
                                                            <span class="flex items-center gap-1">
                                                                <i class="fa-regular fa-eye text-[9px]"></i>
                                                                <span x-text="item.views"></span> views
                                                            </span>
                                                            <template x-if="item.linkedEvent">
                                                                <span class="bg-[#FAF5F2] text-[#8C433C] px-2 py-0.5 rounded-full border border-[#DEAAA1]/40 font-medium">
                                                                    🔗 <span x-text="item.linkedEvent"></span>
                                                                </span>
                                                            </template>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>

                                            {{-- Kolom Tipe Badge --}}
                                            <td class="py-3.5 px-2 whitespace-nowrap">
                                                <span :class="item.categoryColor" 
                                                      class="text-[11px] font-bold px-3 py-1 rounded-full inline-block" 
                                                      x-text="item.type">
                                                    Yoga
                                                </span>
                                            </td>

                                            {{-- Kolom Tanggal --}}
                                            <td class="py-3.5 px-2 whitespace-nowrap text-neutral-600 text-[11px]" x-text="item.date">
                                                Oct 12, 2024
                                            </td>

                                            {{-- Kolom Uploader --}}
                                            <td class="py-3.5 px-2 whitespace-nowrap">
                                                <div class="flex items-center gap-2">
                                                    <img :src="item.uploaderAvatar" alt="Avatar" class="w-6 h-6 rounded-full object-cover border border-neutral-200">
                                                    <span class="text-neutral-700 text-[11px] font-medium" x-text="item.uploader">Sarah</span>
                                                </div>
                                            </td>

                                            {{-- Kolom Aksi Cepat --}}
                                            <td class="py-3.5 px-2 whitespace-nowrap text-right">
                                                <div class="flex items-center justify-end gap-1.5">
                                                    <button type="button" 
                                                            title="Lihat / Download" 
                                                            class="p-1.5 text-neutral-500 hover:text-emerald-700 hover:bg-emerald-50 rounded-lg transition">
                                                        <i class="fa-solid fa-download text-xs"></i>
                                                    </button>
                                                    <button type="button" 
                                                            title="Edit Dokumen" 
                                                            class="p-1.5 text-neutral-500 hover:text-blue-700 hover:bg-blue-50 rounded-lg transition">
                                                        <i class="fa-solid fa-pen-to-square text-xs"></i>
                                                    </button>
                                                    <button type="button" 
                                                            @click="resources = resources.filter(r => r.id !== item.id)"
                                                            title="Hapus Dokumen" 
                                                            class="p-1.5 text-neutral-500 hover:text-red-700 hover:bg-red-50 rounded-lg transition">
                                                        <i class="fa-solid fa-trash-can text-xs"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    </template>

                                    {{-- Empty State jika tidak ada hasil --}}
                                    <tr x-show="filteredResources.length === 0">
                                        <td colspan="5" class="py-12 text-center text-neutral-400">
                                            <div class="w-12 h-12 rounded-2xl bg-neutral-100 flex items-center justify-center mx-auto mb-3 text-neutral-400">
                                                <i class="fa-solid fa-folder-open text-xl"></i>
                                            </div>
                                            <p class="font-bold text-xs text-neutral-700">Tidak ada dokumen ditemukan</p>
                                            <p class="text-[11px] text-neutral-500 mt-0.5">Coba kata kunci lain atau ubah filter kategori</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        {{-- Pagination / Table Footer --}}
                        <div class="flex flex-col sm:flex-row items-center justify-between gap-3 pt-4 border-t border-neutral-100 text-[11px] text-neutral-500 mt-2">
                            <span>Menampilkan 1 hingga <span x-text="filteredResources.length"></span> dari <span x-text="resources.length"></span> entri</span>
                            <div class="flex items-center gap-1">
                                <button type="button" class="px-2.5 py-1 rounded-lg border border-neutral-200 text-neutral-600 hover:bg-neutral-50 disabled:opacity-40" disabled>
                                    Previous
                                </button>
                                <span class="px-3 py-1 bg-[#5F8C72] text-white font-bold rounded-lg text-xs">1</span>
                                <button type="button" class="px-2.5 py-1 rounded-lg border border-neutral-200 text-neutral-600 hover:bg-neutral-50">
                                    Next
                                </button>
                            </div>
                        </div>

                    </div>

                </div>

                {{-- ── 2B. KOLOM KANAN (4 COLS): UPLOAD RESOURCE PANEL (STICKY & ERGONOMIC) ── --}}
                <div id="upload-panel-section" class="lg:col-span-4 lg:sticky lg:top-6">
                    <div class="bg-white rounded-3xl p-6 border border-neutral-200/70 shadow-2xs space-y-5">
                        
                        {{-- Panel Header --}}
                        <div class="flex items-center justify-between pb-3 border-b border-neutral-100">
                            <div class="flex items-center gap-2.5">
                                <div class="w-8 h-8 rounded-xl bg-[#FCDDD9] text-[#DE6657] flex items-center justify-center">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                    </svg>
                                </div>
                                <h3 class="font-bold text-neutral-900 text-sm">Upload Resource</h3>
                            </div>
                            <span class="text-[10px] bg-neutral-100 text-neutral-500 font-semibold px-2 py-0.5 rounded-full">PDF Form</span>
                        </div>

                        {{-- Form Upload --}}
                        <form action="#" method="POST" enctype="multipart/form-data" 
                              @submit.prevent="
                                if (!uploadedFile) { alert('Silakan pilih file PDF terlebih dahulu.'); return; }
                                const newTitle = $event.target.title.value || fileName;
                                const newType = $event.target.type.value || 'Umum';
                                const newUploader = $event.target.uploader.value || 'Sarah Admin';
                                resources.unshift({
                                    id: Date.now(),
                                    title: newTitle,
                                    slug: 'doc-' + Date.now(),
                                    type: newType,
                                    categoryColor: newType === 'Yoga' ? 'bg-[#E4F5E6] text-[#428E53]' : (newType === 'Nutrisi' ? 'bg-[#FCEBE7] text-[#C97A70]' : 'bg-[#B8E6B8] text-neutral-800'),
                                    size: fileSize || '2.5 MB',
                                    date: 'Hari ini',
                                    uploader: newUploader,
                                    uploaderAvatar: 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=100&h=100&fit=crop',
                                    views: 0,
                                    downloads: 0,
                                    linkedEvent: $event.target.linked_event?.value || null
                                });
                                $event.target.reset();
                                removeFile();
                                alert('Dokumen berhasil diunggah ke Knowledge Library!');
                              " 
                              class="space-y-4">
                            @csrf

                            {{-- Drop Area Interaktif --}}
                            <div @dragover.prevent="isDragging = true"
                                 @dragleave.prevent="isDragging = false"
                                 @drop.prevent="isDragging = false; handleFileSelect($event)">
                                
                                <template x-if="!uploadedFile">
                                    <label class="flex flex-col items-center justify-center border-2 border-dashed rounded-2xl p-6 text-center cursor-pointer transition-all duration-200"
                                           :class="isDragging ? 'border-[#B96A5C] bg-[#FDF5F2]' : 'border-neutral-300 hover:border-[#B96A5C] hover:bg-[#FAF5F2]'">
                                        <input type="file" 
                                               x-ref="fileInput"
                                               name="pdf_file" 
                                               accept=".pdf" 
                                               class="hidden" 
                                               @change="handleFileSelect($event)">
                                        
                                        <div class="w-12 h-12 rounded-full bg-[#F3D5CF] flex items-center justify-center text-[#B96A5C] mb-3 shadow-2xs">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                            </svg>
                                        </div>

                                        <p class="text-xs font-bold text-neutral-800 mb-0.5">Drop PDF file di sini</p>
                                        <p class="text-[10px] text-neutral-500 mb-3">atau klik untuk telusuri dari komputer</p>
                                        <span class="text-[9px] text-neutral-400 font-bold tracking-wider uppercase bg-neutral-100 px-2 py-0.5 rounded-full">
                                            Format .PDF Maks. 50 MB
                                        </span>
                                    </label>
                                </template>

                                {{-- State File Terpilih --}}
                                <template x-if="uploadedFile">
                                    <div class="border border-emerald-200 bg-emerald-50/60 rounded-2xl p-4 flex items-center justify-between gap-3">
                                        <div class="flex items-center gap-3 min-w-0">
                                            <div class="w-10 h-10 rounded-xl bg-red-100 text-red-600 flex items-center justify-center shrink-0">
                                                <i class="fa-solid fa-file-pdf text-lg"></i>
                                            </div>
                                            <div class="min-w-0">
                                                <p class="text-xs font-bold text-neutral-800 truncate" x-text="fileName"></p>
                                                <p class="text-[10px] text-emerald-700 font-semibold mt-0.5" x-text="fileSize"></p>
                                            </div>
                                        </div>
                                        <button type="button" @click="removeFile()" class="text-neutral-400 hover:text-red-600 p-1">
                                            <i class="fa-solid fa-xmark text-sm"></i>
                                        </button>
                                    </div>
                                </template>
                            </div>

                            {{-- Judul Ebook / Resource --}}
                            <div>
                                <label class="block text-xs font-semibold text-neutral-700 mb-1">Judul Resource / E-Book</label>
                                <input type="text" 
                                       id="input-title"
                                       name="title" 
                                       placeholder="Contoh: Panduan Nutrisi Trimester 1.pdf"
                                       class="w-full bg-[#FAF5F2] border border-neutral-300 rounded-xl px-3.5 py-2.5 text-xs text-neutral-800 focus:outline-none focus:ring-2 focus:ring-[#B96A5C] focus:bg-white placeholder-neutral-400 transition">
                            </div>

                            {{-- Kategori / Type Selector --}}
                            <div>
                                <label class="block text-xs font-semibold text-neutral-700 mb-1">Kategori / Topik</label>
                                <select name="type" 
                                        class="w-full bg-[#FAF5F2] border border-neutral-300 rounded-xl px-3.5 py-2.5 text-xs text-neutral-800 focus:outline-none focus:ring-2 focus:ring-[#B96A5C] focus:bg-white transition cursor-pointer">
                                    <option value="Nutrisi">Nutrisi & Gizi Ibu Hamil</option>
                                    <option value="Yoga">Prenatal Yoga & Senam Hamil</option>
                                    <option value="Persalinan">Persalinan Nyaman & Gentle Birth</option>
                                    <option value="Laktasi">Laktasi & Manajemen ASI</option>
                                    <option value="Parenting">Parenting & Perawatan Bayi</option>
                                </select>
                            </div>

                            {{-- Tautkan ke Seminar / Event (Sesuai SRS FR-15) --}}
                            <div>
                                <label class="block text-xs font-semibold text-neutral-700 mb-1">Tautkan ke Seminar (Opsional)</label>
                                <select name="linked_event" 
                                        class="w-full bg-[#FAF5F2] border border-neutral-300 rounded-xl px-3.5 py-2.5 text-xs text-neutral-800 focus:outline-none focus:ring-2 focus:ring-[#B96A5C] focus:bg-white transition cursor-pointer">
                                    <option value="">-- Tanpa Tautan Seminar --</option>
                                    <option value="Mindful Motherhood Workshop">Seminar Mindful Motherhood (Solo)</option>
                                    <option value="Seminar Gizi 1000 Hari Pertama">Seminar Gizi 1000 Hari Pertama (Jogja)</option>
                                    <option value="Kelas Persalinan Alami & Gentle Birth">Kelas Gentle Birth & Hypnobirthing</option>
                                </select>
                            </div>

                            {{-- Uploader Input --}}
                            <div>
                                <label class="block text-xs font-semibold text-neutral-700 mb-1">Nama Uploader</label>
                                <input type="text" 
                                       name="uploader" 
                                       value="Sarah Admin"
                                       class="w-full bg-[#FAF5F2] border border-neutral-300 rounded-xl px-3.5 py-2.5 text-xs text-neutral-800 focus:outline-none focus:ring-2 focus:ring-[#B96A5C] focus:bg-white transition">
                            </div>

                            {{-- Submit Button --}}
                            <div class="pt-2">
                                <button type="submit" 
                                        class="w-full bg-[#5F8C72] hover:bg-[#4f755e] text-white font-semibold py-3 px-4 rounded-xl text-xs flex items-center justify-center gap-2 transition shadow-xs cursor-pointer">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                    </svg>
                                    <span>Unggah ke Knowledge Library</span>
                                </button>
                            </div>
                        </form>

                    </div>
                </div>

            </div>

        </main>

    </div>
</x-layout>
