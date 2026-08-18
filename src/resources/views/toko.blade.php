<x-layout title="Toko Affiliate Pilihan">
    <x-slot name="head">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <style>
            .tab-btn.active {
                background-color: #C47366;
                color: white;
                box-shadow: 0 4px 6px -1px rgba(196, 115, 102, 0.2), 0 2px 4px -1px rgba(196, 115, 102, 0.1);
            }
        </style>
    </x-slot>

    @php
        $products = [
            [
                'id' => 1,
                'name' => 'Blackmores Pregnancy & Breast-Feeding Gold',
                'category' => 'kesehatan',
                'category_label' => 'Kesehatan Ibu',
                'price' => 'Rp 258.000',
                'image' => 'https://images.unsplash.com/photo-1616679911721-eff6eec18fcd?auto=format&fit=crop&q=80&w=400',
                'desc' => 'Suplemen multivitamin esensial untuk kesehatan ibu hamil dan menyusui.',
                'link' => 'https://www.tiktok.com'
            ],
            [
                'id' => 2,
                'name' => 'Prenagen Mommy Coklat 400g',
                'category' => 'kesehatan',
                'category_label' => 'Kesehatan Ibu',
                'price' => 'Rp 79.000',
                'image' => 'https://images.unsplash.com/photo-1571175432290-ef7131340f1a?auto=format&fit=crop&q=80&w=400',
                'desc' => 'Nutrisi lengkap ibu hamil untuk mendukung perkembangan janin sehat.',
                'link' => 'https://www.tiktok.com'
            ],
            [
                'id' => 3,
                'name' => 'Set Pakaian Bayi Katun Organik',
                'category' => 'perlengkapan',
                'category_label' => 'Perlengkapan Bayi',
                'price' => 'Rp 95.000',
                'image' => 'https://images.unsplash.com/photo-1515488042361-404e9250afef?auto=format&fit=crop&q=80&w=400',
                'desc' => 'Bahan 100% katun organik yang sangat lembut dan aman untuk kulit sensitif bayi.',
                'link' => 'https://www.tiktok.com'
            ],
            [
                'id' => 4,
                'name' => 'Minyak Telon My Baby Plus 150ml',
                'category' => 'perlengkapan',
                'category_label' => 'Perlengkapan Bayi',
                'price' => 'Rp 38.500',
                'image' => 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?auto=format&fit=crop&q=80&w=400',
                'desc' => 'Menghangatkan tubuh bayi dan melindunginya dari gigitan nyamuk hingga 8 jam.',
                'link' => 'https://www.tiktok.com'
            ],
            [
                'id' => 5,
                'name' => 'Vitamin D3 1000 IU Healthy Care',
                'category' => 'kesehatan',
                'category_label' => 'Kesehatan Ibu',
                'price' => 'Rp 120.000',
                'image' => 'https://images.unsplash.com/photo-1584017911766-d451b3d0e843?auto=format&fit=crop&q=80&w=400',
                'desc' => 'Membantu penyerapan kalsium maksimal selama masa kehamilan.',
                'link' => 'https://www.tiktok.com'
            ],
            [
                'id' => 6,
                'name' => 'Travel Stroller Lipat Ringan',
                'category' => 'perlengkapan',
                'category_label' => 'Perlengkapan Bayi',
                'price' => 'Rp 890.000',
                'image' => 'https://images.unsplash.com/photo-1591811802094-1a3b118b1d96?auto=format&fit=crop&q=80&w=400',
                'desc' => 'Stroller praktis kabin-size yang mudah dilipat untuk mobilitas ibu dan bayi.',
                'link' => 'https://www.tiktok.com'
            ],
            [
                'id' => 7,
                'name' => 'Double Breastpump Elektrik Wireless',
                'category' => 'perlengkapan',
                'category_label' => 'Perlengkapan Bayi',
                'price' => 'Rp 350.000',
                'image' => 'https://images.unsplash.com/photo-1519689680058-324335c77eba?auto=format&fit=crop&q=80&w=400',
                'desc' => 'Pompa ASI elektrik tanpa kabel dengan mode pijat untuk mempermudah pumping.',
                'link' => 'https://www.tiktok.com'
            ],
            [
                'id' => 8,
                'name' => 'Mama\'s Choice Stretch Mark Cream',
                'category' => 'kesehatan',
                'category_label' => 'Kesehatan Ibu',
                'price' => 'Rp 129.000',
                'image' => 'https://images.unsplash.com/photo-1608248597279-f99d160bfcbc?auto=format&fit=crop&q=80&w=400',
                'desc' => 'Formula aman bersertifikasi halal untuk mencegah dan menyamarkan selulit kehamilan.',
                'link' => 'https://www.tiktok.com'
            ]
        ];
    @endphp

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 w-full">
        <!-- HEADER KANAL -->
        <div class="text-center max-w-2xl mx-auto mb-12">
            <span class="text-xs font-bold uppercase tracking-wider text-[#C47366] bg-[#FAF0EE] px-3.5 py-1.5 rounded-full">Katalog Pilihan</span>
            <h1 class="text-4xl sm:text-5xl font-semibold text-[#3D2B2B] tracking-tight leading-tight mt-4 mb-3" style="font-family: 'Lexend', sans-serif;">
                Toko Affiliate Maternity
            </h1>
            <p class="text-gray-600 text-sm sm:text-base leading-relaxed font-medium">
                Temukan rekomendasi produk kesehatan dan perlengkapan bayi pilihan kami. Setiap produk mengarah langsung ke TikTok Shop resmi mitra kami dengan penawaran terbaik.
            </p>
        </div>

        <!-- FILTER TAB -->
        <div class="flex items-center justify-center gap-3 mb-10 overflow-x-auto pb-2">
            <button onclick="filterCategory('all')" id="btn-all" class="tab-btn active bg-white hover:bg-gray-50 text-[#3D2B2B] font-semibold px-5 py-2.5 rounded-xl border border-gray-200 transition text-sm whitespace-nowrap">
                Semua Produk
            </button>
            <button onclick="filterCategory('kesehatan')" id="btn-kesehatan" class="tab-btn bg-white hover:bg-gray-50 text-[#3D2B2B] font-semibold px-5 py-2.5 rounded-xl border border-gray-200 transition text-sm whitespace-nowrap">
                <i class="fa-solid fa-heart-pulse mr-1 text-[#C47366]"></i> Kesehatan Ibu
            </button>
            <button onclick="filterCategory('perlengkapan')" id="btn-perlengkapan" class="tab-btn bg-white hover:bg-gray-50 text-[#3D2B2B] font-semibold px-5 py-2.5 rounded-xl border border-gray-200 transition text-sm whitespace-nowrap">
                <i class="fa-solid fa-baby mr-1 text-[#5F8A6E]"></i> Perlengkapan Bayi
            </button>
        </div>

        <!-- PRODUCTS GRID -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8" id="products-grid">
            @foreach ($products as $product)
                <div class="product-card bg-white rounded-3xl p-5 shadow-sm border border-[#EEE0DC]/60 hover:shadow-md transition duration-300 flex flex-col justify-between" data-category="{{ $product['category'] }}">
                    <div>
                        <!-- Image Container -->
                        <div class="relative rounded-2xl overflow-hidden h-48 bg-gray-50 mb-5">
                            <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" class="w-full h-full object-cover">
                            
                            <!-- Category Badge -->
                            <span class="absolute top-3 left-3 text-[10px] font-bold px-3 py-1 rounded-full shadow-sm {{ $product['category'] === 'kesehatan' ? 'bg-[#FAF0EE] text-[#C47366]' : 'bg-[#EEF4F0] text-[#5F8A6E]' }}">
                                {{ $product['category_label'] }}
                            </span>
                        </div>

                        <!-- Product Info -->
                        <h3 class="font-bold text-[#3D2B2B] text-base leading-snug line-clamp-2 min-h-[3rem] mb-2" style="font-family: 'Lexend', sans-serif;">
                            {{ $product['name'] }}
                        </h3>
                        <p class="text-xs text-gray-500 line-clamp-2 leading-relaxed mb-4">
                            {{ $product['desc'] }}
                        </p>
                    </div>

                    <!-- Price and CTA -->
                    <div class="mt-4 border-t border-gray-100 pt-4">
                        <div class="flex items-baseline justify-between mb-4">
                            <span class="text-xs text-gray-400 font-semibold uppercase">Perkiraan Harga</span>
                            <span class="text-lg font-extrabold text-[#5F8A6E]">{{ $product['price'] }}</span>
                        </div>
                        
                        <a href="{{ $product['link'] }}" target="_blank" class="w-full bg-[#2A1614] hover:bg-[#3D2B2B] text-white font-semibold py-3 rounded-2xl text-sm transition flex items-center justify-center gap-2 shadow-sm">
                            <i class="fa-brands fa-tiktok"></i>
                            <span>Beli di TikTok Shop</span>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- JAVASCRIPT UNTUK FILTER DYNAMIC -->
    <script>
        function filterCategory(category) {
            // Update Active Tab Button styling
            const buttons = document.querySelectorAll('.tab-btn');
            buttons.forEach(btn => btn.classList.remove('active'));

            const activeBtn = document.getElementById(`btn-${category}`);
            if (activeBtn) {
                activeBtn.classList.add('active');
            }

            // Filter Product Cards
            const cards = document.querySelectorAll('.product-card');
            cards.forEach(card => {
                const cardCategory = card.getAttribute('data-category');
                if (category === 'all' || cardCategory === category) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        }
    </script>
</x-layout>
