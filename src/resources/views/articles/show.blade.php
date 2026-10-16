<x-layout title="{{ $article->title ?? 'Artikel Maternitas' }} — Maternity.id" metaDescription="{{ $article->excerpt ?? 'Informasi dan panduan kesehatan ibu hamil dan nifas terpercaya di Maternity.id' }}">
    <x-slot name="head">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <style>
            .article-body h2, .article-body h3 {
                font-family: 'DM Serif Display', serif;
                font-weight: 700;
                color: #2A1614;
                margin-top: 1.75rem;
                margin-bottom: 0.75rem;
            }
            .article-body p {
                line-height: 1.85;
                margin-bottom: 1.25rem;
            }
            .article-body ul {
                list-style-type: disc;
                padding-left: 1.5rem;
                margin-bottom: 1.25rem;
            }
            .article-body li {
                margin-bottom: 0.5rem;
            }
        </style>
    </x-slot>

    {{-- Reading Progress Bar --}}
    <div id="reading-progress" class="fixed top-0 left-0 h-1.5 bg-gradient-to-r from-[#8C433C] via-[#DEA69E] to-[#7A9E7E] z-50 transition-all duration-150" style="width: 0%;"></div>

    {{-- Main Wrapper with Comfortable Left and Right Margins --}}
    <div class="min-h-screen py-4 sm:py-10 px-3 sm:px-8 md:px-12 lg:px-14 xl:px-16 text-slate-800 font-sans antialiased w-full">
        <div class="max-w-7xl mx-auto">
            
            {{-- Top Navigation & Breadcrumb with Generous Margin --}}
            <div class="flex flex-wrap items-center justify-between gap-4 mb-6 sm:mb-8 pl-0 lg:pl-16">
                <nav class="flex items-center space-x-2 text-xs sm:text-sm font-semibold text-slate-500">
                    <a href="{{ route('home') }}" class="hover:text-[#8C433C] transition">Home</a>
                    <span class="text-slate-300">/</span>
                    <a href="{{ route('articles.index') }}" class="hover:text-[#8C433C] transition">Artikel</a>
                    <span class="text-slate-300">/</span>
                    <span class="text-[#8C433C] font-bold truncate max-w-[200px] sm:max-w-xs">{{ $article->category ?? 'Kesehatan' }}</span>
                </nav>

                <a href="{{ url()->previous() != url()->current() ? url()->previous() : route('articles.index') }}" 
                   class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-semibold bg-white border border-[#DEA69E]/70 text-[#8C433C] shadow-xs hover:bg-[#8C433C] hover:text-white hover:border-[#8C433C] transition-all duration-200">
                    <i class="fa-solid fa-chevron-left text-[10px]"></i>
                    <span>Kembali</span>
                </a>
            </div>

            {{-- Main Layout Grid with Left Sticky Social Column --}}
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 items-start relative">
                
                {{-- ── LEFT FLOATING SOCIAL SHARE BAR (WA & IG) ── --}}
                <aside class="hidden lg:flex flex-col items-center gap-3.5 sticky top-32 lg:col-span-1 py-2 z-20">
                    {{-- WhatsApp Icon Button --}}
                    <a href="https://api.whatsapp.com/send?text={{ urlencode(($article->title ?? 'Artikel') . ' ' . url()->current()) }}" 
                       target="_blank" 
                       rel="noopener noreferrer" 
                       class="w-11 h-11 rounded-2xl bg-[#25D366] text-white shadow-sm flex items-center justify-center hover:scale-115 hover:shadow-md transition-all duration-200" 
                       title="Bagikan ke WhatsApp">
                        <i class="fa-brands fa-whatsapp text-xl"></i>
                    </a>
                    
                    {{-- Instagram Icon Button --}}
                    <button type="button" 
                            onclick="copyCurrentUrl()" 
                            class="w-11 h-11 rounded-2xl bg-gradient-to-tr from-[#f09433] via-[#dc2743] to-[#bc1888] text-white shadow-sm flex items-center justify-center hover:scale-115 hover:shadow-md transition-all duration-200" 
                            title="Bagikan ke Instagram / Salin Tautan">
                        <i class="fa-brands fa-instagram text-xl"></i>
                    </button>
                </aside>

                {{-- ── MAIN ARTICLE CONTENT CARD ── --}}
                <main class="lg:col-span-7 xl:col-span-7 bg-white rounded-2xl sm:rounded-3xl p-4 sm:p-10 shadow-[0_4px_25px_rgba(0,0,0,0.03)] border border-[#DEA69E]/30 space-y-5 sm:space-y-6">
                    
                    {{-- Category & Meta Pill --}}
                    <div class="flex flex-wrap items-center gap-3">
                        @forelse($article->categories as $cat)
                            <a href="{{ route('articles.index', ['category' => $cat->slug ?? 'all']) }}" 
                               class="px-3.5 py-1 bg-[#FAF0EE] text-[#8C433C] text-xs font-bold rounded-full border border-[#DEA69E]/50 hover:bg-[#8C433C] hover:text-white transition">
                                {{ $cat->name }}
                            </a>
                        @empty
                            <a href="{{ route('articles.index', ['category' => 'all']) }}" 
                               class="px-3.5 py-1 bg-[#FAF0EE] text-[#8C433C] text-xs font-bold rounded-full border border-[#DEA69E]/50 hover:bg-[#8C433C] hover:text-white transition">
                                Kesehatan
                            </a>
                        @endforelse
                        <span class="text-slate-300">•</span>
                        <span class="flex items-center gap-1.5 text-xs font-medium text-slate-500">
                            <i class="fa-regular fa-user text-slate-400 text-xs"></i>
                            <span>{{ $article->author->name ?? 'Tim Medis Maternity.id' }}</span>
                        </span>
                        <span class="text-slate-300">•</span>
                        <span class="flex items-center gap-1.5 text-xs font-medium text-slate-500">
                            <i class="fa-regular fa-calendar text-slate-400 text-xs"></i>
                            <span>{{ $article->published_at instanceof \Carbon\Carbon ? $article->published_at->translatedFormat('d F Y') : ($article->published_at ?? '15 Agustus 2026') }}</span>
                        </span>
                    </div>

                    {{-- Article Title --}}
                    <h1 class="text-2xl sm:text-4xl font-extrabold text-[#2A1614] leading-tight tracking-tight" style="font-family: 'DM Serif Display', serif;">
                        {{ $article->title ?? 'Tips Hidup Sehat: Menjaga Kebugaran di Tengah Rutinitas Padat' }}
                    </h1>

                    {{-- Author & Quick Action Header (Author info + Bagikan button) --}}
                    <div class="flex flex-wrap items-center justify-between gap-4 pb-6 border-b border-slate-100">
                        <div class="flex items-center gap-3">
                            @if(!empty($article->author->avatar))
                                <img src="{{ $article->author->avatar }}" alt="{{ $article->author->name ?? 'Author' }}" class="w-11 h-11 rounded-full object-cover border-2 border-[#DEA69E]">
                            @else
                                <div class="w-11 h-11 rounded-full bg-[#FAF0EE] border border-[#DEA69E] flex items-center justify-center font-bold text-[#8C433C] text-sm shadow-inner">
                                    {{ substr($article->author->name ?? ($article->author ?? 'Admin'), 0, 2) }}
                                </div>
                            @endif
                            <div>
                                <div class="flex items-center gap-1.5">
                                    <p class="text-xs sm:text-sm font-bold text-slate-900">{{ $article->author->name ?? ($article->author ?? 'Tim Editorial') }}</p>
                                    <i class="fa-solid fa-circle-check text-blue-500 text-[11px]" title="Terverifikasi Medis"></i>
                                </div>
                                <p class="text-[11px] text-slate-400">{{ $article->author->role ?? ($article->author_role ?? 'Verifikator Medis') }}</p>
                            </div>
                        </div>

                        {{-- Social Share Group on Header (Mobile & Desktop) --}}
                        <div class="flex items-center gap-2">
                            {{-- Mobile WA & IG icons --}}
                            <a href="https://api.whatsapp.com/send?text={{ urlencode(($article->title ?? 'Artikel') . ' ' . url()->current()) }}" 
                               target="_blank" 
                               rel="noopener noreferrer" 
                               class="lg:hidden w-8 h-8 rounded-full bg-[#25D366] text-white flex items-center justify-center shadow-xs hover:scale-110 transition" 
                               title="Bagikan ke WhatsApp">
                                <i class="fa-brands fa-whatsapp text-sm"></i>
                            </a>
                            <button type="button" 
                                    onclick="copyCurrentUrl()" 
                                    class="lg:hidden w-8 h-8 rounded-full bg-gradient-to-tr from-[#f09433] via-[#dc2743] to-[#bc1888] text-white flex items-center justify-center shadow-xs hover:scale-110 transition" 
                                    title="Bagikan ke Instagram / Salin Link">
                                <i class="fa-brands fa-instagram text-sm"></i>
                            </button>

                            {{-- Tombol Bagikan --}}
                            <button type="button" 
                                    onclick="copyCurrentUrl()" 
                                    class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-xl border border-[#8C433C]/70 text-xs font-bold text-[#8C433C] hover:bg-[#8C433C] hover:text-white transition shadow-2xs">
                                <i class="fa-solid fa-share-nodes text-xs"></i>
                                <span>Bagikan</span>
                            </button>
                        </div>
                    </div>

                    {{-- Featured Image with subtle zoom --}}
                    <div class="relative rounded-2xl overflow-hidden shadow-sm group bg-neutral-100">
                        <img 
                            src="{{ $article->image_url ?? ($article->thumbnail_image ?? 'https://images.unsplash.com/photo-1518611012118-696072aa579a?auto=format&fit=crop&w=1200&q=80') }}" 
                            alt="{{ $article->title ?? 'Foto Artikel' }}" 
                            class="w-full h-[280px] sm:h-[400px] object-cover group-hover:scale-105 transition-transform duration-500 ease-out"
                        >
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>

                    {{-- Content Body --}}
                    <article class="prose prose-slate max-w-none text-slate-700 leading-relaxed font-normal text-base sm:text-lg article-body pt-2">
                        {!! $article->content ?? '
                            <p class="font-medium text-slate-900 leading-relaxed mb-4">Memulai gaya hidup sehat tidak harus rumit atau membutuhkan perubahan drastis dalam satu malam. Cukup dengan konsistensi kecil setiap hari untuk hasil jangka panjang.</p>
                            <p class="mb-4">Menjaga pola makan seimbang, hidrasi cukup, dan aktivitas fisik ringan seperti jalan kaki di pagi hari sangat ampuh mengembalikan energi tubuh serta fokus kognitif.</p>
                        ' !!}
                    </article>

                    {{-- Tags Section --}}
                    @if(!empty($article->tags))
                        <div class="pt-6 border-t border-slate-100">
                            <p class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-3">Topik Terkait</p>
                            <div class="flex flex-wrap gap-2">
                                @foreach($article->tags as $tag)
                                    <a href="{{ route('articles.index', ['q' => $tag]) }}" 
                                       class="px-3.5 py-1.5 text-xs font-semibold rounded-xl bg-[#FAF0EE] text-[#8C433C] hover:bg-[#8C433C] hover:text-white transition duration-200 border border-[#DEA69E]/40">
                                        #{{ $tag }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- Medical Review Disclaimer --}}
                    <div class="bg-[#FAF0EE]/60 rounded-2xl p-4 sm:p-5 border border-[#DEA69E]/30 text-xs text-neutral-600 flex items-start gap-3.5">
                        <i class="fa-solid fa-shield-heart text-[#8C433C] text-lg mt-0.5 shrink-0"></i>
                        <p class="leading-relaxed">
                            <strong>Ditinjau secara medis:</strong> Informasi dalam artikel ini telah disusun dan diverifikasi oleh tenaga kesehatan profesional untuk tujuan edukasi. Selalu konsultasikan dengan dokter kandungan atau bidan Anda untuk pemeriksaan kondisi individual kehamilan Anda.
                        </p>
                    </div>

                </main>

                {{-- ── RIGHT SIDEBAR (Search, Categories, Related, CTA) ── --}}
                <aside class="lg:col-span-4 xl:col-span-4 space-y-6">
                    
                    {{-- Search Bar --}}
                    <div class="bg-white p-3.5 rounded-3xl shadow-sm border border-[#DEA69E]/30">
                        <form action="{{ route('articles.index') }}" method="GET" class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-[#8C433C]">
                                <i class="fa-solid fa-magnifying-glass text-xs"></i>
                            </span>
                            <input 
                                type="text" 
                                name="q" 
                                placeholder="Cari artikel lain..." 
                                class="w-full pl-10 pr-4 py-2.5 text-xs sm:text-sm bg-slate-50 border-0 rounded-2xl placeholder-slate-400 focus:bg-white focus:ring-2 focus:ring-[#8C433C]/20 focus:outline-none transition"
                            >
                        </form>
                    </div>

                    {{-- Categories Section --}}
                    <div class="bg-white p-5 sm:p-6 rounded-3xl shadow-sm border border-[#DEA69E]/30">
                        <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-3.5">Kategori Artikel</h3>
                        <div class="flex flex-wrap gap-2">
                            @forelse($article->categories as $cat)
                                <a href="{{ route('articles.index', ['category' => $cat->slug]) }}" 
                                   class="px-3.5 py-1.5 text-xs font-semibold rounded-xl transition duration-200 bg-[#8C433C] text-white shadow-xs">
                                    {{ $cat->name }}
                                </a>
                            @empty
                                <p class="text-xs text-slate-500">Tidak ada kategori</p>
                            @endforelse
                        </div>
                    </div>

                    {{-- Related Articles (Artikel Lain) --}}
                    <div class="bg-white rounded-3xl p-5 sm:p-6 shadow-sm border border-[#DEA69E]/30 space-y-4">
                        <div class="flex items-center justify-between">
                            <h2 class="text-base sm:text-lg font-bold text-[#2A1614]" style="font-family: 'DM Serif Display', serif;">Artikel Lain</h2>
                            <a href="{{ route('articles.index') }}" class="text-xs font-semibold text-[#8C433C] hover:underline">Lihat Semua</a>
                        </div>

                        <div class="space-y-4">
                            @forelse($relatedArticles ?? [] as $item)
                                @php
                                    $itemSlug = is_object($item) ? $item->slug : $item['slug'];
                                    $itemTitle = is_object($item) ? $item->title : $item['title'];
                                    $itemImage = is_object($item) ? ($item->image_url ?? $item->thumbnail_image) : ($item['thumbnail_image'] ?? '');
                                    $itemAuthor = is_object($item) && isset($item->author) ? (is_object($item->author) ? $item->author->name : $item->author) : 'Tim Medis';
                                @endphp
                                <a href="{{ route('articles.show', $itemSlug) }}" class="flex items-start gap-3.5 group p-2 -mx-2 rounded-2xl hover:bg-[#FAF0EE]/60 transition">
                                    <div class="w-20 h-16 sm:w-22 sm:h-16 flex-shrink-0 rounded-2xl overflow-hidden bg-slate-100 relative">
                                        <img 
                                            src="{{ $itemImage }}" 
                                            alt="{{ $itemTitle }}" 
                                            class="w-full h-full object-cover group-hover:scale-105 transition duration-300"
                                        >
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h3 class="text-xs sm:text-sm font-bold text-[#2A1614] group-hover:text-[#8C433C] transition line-clamp-2 leading-snug">
                                            {{ $itemTitle }}
                                        </h3>
                                        <div class="flex items-center gap-1.5 text-[11px] text-slate-400 mt-1.5">
                                            <i class="fa-regular fa-user text-slate-400 text-xs"></i>
                                            <span>{{ $itemAuthor }}</span>
                                        </div>
                                    </div>
                                </a>
                            @empty
                                <p class="text-xs text-slate-400 py-2">Belum ada artikel terkait.</p>
                            @endforelse
                        </div>
                    </div>

                    {{-- Workshop Promo CTA Widget --}}
                    <div class="bg-gradient-to-br from-[#8C433C] to-[#6A2B24] rounded-3xl p-6 text-white shadow-md space-y-3">
                        <span class="inline-block bg-white/20 text-white text-[10px] font-bold px-2.5 py-0.5 rounded-full uppercase tracking-wider">
                            Kelas Interaktif
                        </span>
                        <h4 class="text-lg font-bold leading-tight" style="font-family: 'DM Serif Display', serif;">
                            Ikuti Webinar Maternitas & Gentle Birth
                        </h4>
                        <p class="text-xs text-white/80 leading-relaxed">
                            Dapatkan sesi tanya jawab langsung bersama dokter spesialis dan bidan terpercaya.
                        </p>
                        <a href="{{ route('events') }}" class="inline-flex items-center gap-2 bg-white text-[#782819] font-bold text-xs px-4 py-2.5 rounded-full hover:bg-[#FAF0EE] transition shadow-xs">
                            <i class="fa-regular fa-calendar-check"></i>
                            <span>Daftar Sekarang</span>
                        </a>
                    </div>

                </aside>
            </div>
        </div>
    </div>

    {{-- Toast Notification Script & Reading Progress --}}
    <script>
        // Reading Progress Bar
        window.addEventListener('scroll', () => {
            const winScroll = document.documentElement.scrollTop || document.body.scrollTop;
            const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            if (height > 0) {
                const scrolled = (winScroll / height) * 100;
                const progressBar = document.getElementById('reading-progress');
                if (progressBar) {
                    progressBar.style.width = scrolled + '%';
                }
            }
        });

        // Copy URL Helper
        function copyCurrentUrl() {
            navigator.clipboard.writeText(window.location.href);
            alert('Tautan artikel berhasil disalin!');
        }
    </script>
</x-layout>
