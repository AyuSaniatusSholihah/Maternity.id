<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the products table.
     */
    public function run(): void
    {
        $admin = Admin::first();
        $categories = Category::all();

        if (!$admin) {
            return;
        }

        $products = [
            [
                'name' => 'Buku Panduan Kehamilan Sehat',
                'description' => 'Buku lengkap tentang kehamilan dari persiapan hingga postpartum.',
                'price' => 85000,
                'category' => 'Nutrisi & Gizi',
                'tiktok_url' => 'https://tiktok.com/@maternity_id/video/1',
                'tokopedia_url' => 'https://tokopedia.com/maternity-id/buku-panduan',
                'shopee_url' => 'https://shopee.co.id/maternity-id/buku-panduan',
                'whatsapp_url' => 'https://wa.me/628123456789',
            ],
            [
                'name' => 'Vitamin Prenatal Premium',
                'description' => 'Suplemen vitamin lengkap untuk ibu hamil dengan formula khusus.',
                'price' => 250000,
                'category' => 'Nutrisi & Gizi',
                'tiktok_url' => 'https://tiktok.com/@maternity_id/video/2',
                'tokopedia_url' => 'https://tokopedia.com/maternity-id/vitamin-prenatal',
                'shopee_url' => 'https://shopee.co.id/maternity-id/vitamin-prenatal',
                'whatsapp_url' => 'https://wa.me/628123456789',
            ],
            [
                'name' => 'Bantal Ibu Hamil Ergonomis',
                'description' => 'Bantal khusus ibu hamil untuk kenyamanan tidur maksimal.',
                'price' => 350000,
                'category' => 'Perawatan Bayi',
                'tiktok_url' => 'https://tiktok.com/@maternity_id/video/3',
                'tokopedia_url' => 'https://tokopedia.com/maternity-id/bantal-ibu-hamil',
                'shopee_url' => 'https://shopee.co.id/maternity-id/bantal-ibu-hamil',
                'whatsapp_url' => 'https://wa.me/628123456789',
            ],
            [
                'name' => 'Paket Perlengkapan Bayi Newborn',
                'description' => 'Paket lengkap perlengkapan bayi baru lahir (baju, popok, selimut).',
                'price' => 450000,
                'category' => 'Perawatan Bayi',
                'tiktok_url' => 'https://tiktok.com/@maternity_id/video/4',
                'tokopedia_url' => 'https://tokopedia.com/maternity-id/paket-perlengkapan-bayi',
                'shopee_url' => 'https://shopee.co.id/maternity-id/paket-perlengkapan-bayi',
                'whatsapp_url' => 'https://wa.me/628123456789',
            ],
            [
                'name' => 'Stroller Modern Lightweight',
                'description' => 'Kereta dorong bayi ringan dengan desain modern dan fungsional.',
                'price' => 1200000,
                'category' => 'Perawatan Bayi',
                'tiktok_url' => 'https://tiktok.com/@maternity_id/video/5',
                'tokopedia_url' => 'https://tokopedia.com/maternity-id/stroller-modern',
                'shopee_url' => 'https://shopee.co.id/maternity-id/stroller-modern',
                'whatsapp_url' => 'https://wa.me/628123456789',
            ],
            [
                'name' => 'Pompa ASI Elektrik Double',
                'description' => 'Pompa ASI elektrik dengan fungsi double untuk efisiensi waktu.',
                'price' => 800000,
                'category' => 'Perawatan Bayi',
                'tiktok_url' => 'https://tiktok.com/@maternity_id/video/6',
                'tokopedia_url' => 'https://tokopedia.com/maternity-id/pompa-asi-elektrik',
                'shopee_url' => 'https://shopee.co.id/maternity-id/pompa-asi-elektrik',
                'whatsapp_url' => 'https://wa.me/628123456789',
            ],
            [
                'name' => 'Matras Yoga Ibu Hamil',
                'description' => 'Matras yoga anti slip khusus untuk latihan ibu hamil.',
                'price' => 150000,
                'category' => 'Olahraga & Kebugaran',
                'tiktok_url' => 'https://tiktok.com/@maternity_id/video/7',
                'tokopedia_url' => 'https://tokopedia.com/maternity-id/matras-yoga',
                'shopee_url' => 'https://shopee.co.id/maternity-id/matras-yoga',
                'whatsapp_url' => 'https://wa.me/628123456789',
            ],
            [
                'name' => 'Paket Makanan Sehat untuk Ibu Hamil',
                'description' => 'Menu makanan bergizi khusus disiapkan untuk ibu hamil.',
                'price' => 200000,
                'category' => 'Nutrisi & Gizi',
                'tiktok_url' => 'https://tiktok.com/@maternity_id/video/8',
                'tokopedia_url' => 'https://tokopedia.com/maternity-id/paket-makanan-sehat',
                'shopee_url' => 'https://shopee.co.id/maternity-id/paket-makanan-sehat',
                'whatsapp_url' => 'https://wa.me/628123456789',
            ],
        ];

        foreach ($products as $product) {
            $category = $categories->where('name', $product['category'])->first();
            
            Product::create([
                'id' => Str::uuid(),
                'name' => $product['name'],
                'slug' => Str::slug($product['name']),
                'description' => $product['description'],
                'price' => $product['price'],
                'thumbnail_img' => null,
                'click_count' => 0,
                'tiktok_url' => $product['tiktok_url'],
                'tokopedia_url' => $product['tokopedia_url'],
                'shopee_url' => $product['shopee_url'],
                'whatsapp_url' => $product['whatsapp_url'],
                'created_by' => $admin->account_id,
                'categories' => $category?->id,
            ]);
        }
    }
}
