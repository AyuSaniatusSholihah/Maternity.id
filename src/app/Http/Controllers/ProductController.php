<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Tampilkan Halaman Katalog Produk
     */
    public function index(Request $request)
    {
        $category = $request->input('category', 'all');
        $query = $request->input('q');

        $productsQuery = Product::with('category')->latest();

        if ($category && $category !== 'all') {
            $productsQuery->whereHas('category', function ($categoryQuery) use ($category) {
                $categoryQuery->where('slug', $category);
            });
        }

        if ($query) {
            $productsQuery->where(function ($productQuery) use ($query) {
                $productQuery
                    ->where('name', 'like', '%' . $query . '%')
                    ->orWhere('description', 'like', '%' . $query . '%');
            });
        }

        $products = $productsQuery->paginate(12)->withQueryString();
        $products->getCollection()->transform(function (Product $product) {
            return [
                'id' => $product->id,
                'title' => $product->name,
                'tag' => $product->category?->name ?? 'Produk',
                'tag_slug' => $product->category?->slug ?? 'produk',
                'image' => $product->thumbnail_img,
                'location' => 'Maternity.id',
                'price' => 'Rp ' . number_format($product->price, 0, ',', '.'),
                'tiktok_url' => $product->tiktok_url ?: ($product->whatsapp_url ?: '#'),
                'sold' => '',
            ];
        });

        $categories = [
            ['slug' => 'all', 'name' => 'Semua', 'icon' => 'fa-solid fa-shapes'],
            ['slug' => 'perlengkapan-nakes', 'name' => 'Perlengkapan Nakes', 'icon' => 'fa-solid fa-user-nurse'],
            ['slug' => 'kebutuhan-wanita', 'name' => 'Kebutuhan Wanita', 'icon' => 'fa-solid fa-person-dress'],
            ['slug' => 'perawatan-ibu-bayi', 'name' => 'Perawatan Ibu & Bayi', 'icon' => 'fa-solid fa-baby'],
            ['slug' => 'nutrisi-suplemen', 'name' => 'Nutrisi & Suplemen', 'icon' => 'fa-solid fa-apple-whole'],
        ];

        return view('product.index', [
            'products' => $products,
            'categories' => $categories,
            'currentCategory' => $category,
            'searchQuery' => $query ?? '',
        ]);
    }
}
