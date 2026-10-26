<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Tampilkan Halaman Katalog Artikel
     */
    public function index(Request $request)
    {
        $fallbackImage = config('app.fallback_image_url');
        
        // Get all published articles from database, sorted by updated_at (latest first)
        $articlesQuery = Article::with(['author'])
            ->orderBy('updated_at', 'desc');

        // Handle sorting
        $sort = $request->input('sort', 'latest');
        if ($sort === 'popular') {
            $articlesQuery->orderBy('views_count', 'desc');
        } else {
            $articlesQuery->orderBy('updated_at', 'desc');
        }

        // Handle category filter - articles have single category FK
        $categoryFilter = $request->input('category');
        if ($categoryFilter && $categoryFilter !== 'all') {
            $articlesQuery->whereHas('category', function ($q) use ($categoryFilter) {
                $q->where('slug', $categoryFilter);
            });
        }

        // Handle search
        $searchQuery = $request->input('q');
        if ($searchQuery) {
            $articlesQuery->where(function ($q) use ($searchQuery) {
                $q->where('title', 'like', "%{$searchQuery}%")
                  ->orWhere('short_description', 'like', "%{$searchQuery}%")
                  ->orWhere('keywords', 'like', "%{$searchQuery}%");
            });
        }

        $articles = $articlesQuery->paginate(12);

        // Transform articles for view
        $transformedArticles = $articles->map(function ($article) use ($fallbackImage) {
            return [
                'id' => $article->id,
                'slug' => $article->slug,
                'title' => $article->title,
                'category' => $article->category?->name ?? 'Umum',
                'category_slug' => $article->category?->slug ?? 'umum',
                'excerpt' => $article->short_description,
                'content' => $article->content,
                'author' => $article->author?->name ?? 'Tim Medis Maternity.id',
                'author_role' => 'Praktisi Medis',
                'thumbnail_image' => $article->image_url ?? $fallbackImage,
                'read_time' => ceil(str_word_count(strip_tags($article->content)) / 200) . ' menit membaca',
                'published_at' => $article->updated_at->format('d M Y'),
                'views' => 0,
            ];
        })->toArray();

        // Featured article (first published article if no search/filter)
        $featuredArticle = null;
        if (empty($searchQuery) && (empty($categoryFilter) || $categoryFilter === 'all')) {
            $featuredArticleQuery = Article::with(['author'])
                ->orderBy('updated_at', 'desc')
                ->first();
            
            if ($featuredArticleQuery) {
                $featuredArticle = [
                    'id' => $featuredArticleQuery->id,
                    'slug' => $featuredArticleQuery->slug,
                    'title' => $featuredArticleQuery->title,
                    'category' => $featuredArticleQuery->category?->name ?? 'Umum',
                    'category_slug' => $featuredArticleQuery->category?->slug ?? 'umum',
                    'excerpt' => $featuredArticleQuery->short_description,
                    'content' => $featuredArticleQuery->content,
                    'author' => $featuredArticleQuery->author?->name ?? 'Tim Medis Maternity.id',
                    'thumbnail_image' => $featuredArticleQuery->image_url ?? $fallbackImage,
                    'read_time' => ceil(str_word_count(strip_tags($featuredArticleQuery->content)) / 200) . ' menit membaca',
                    'published_at' => $featuredArticleQuery->updated_at->format('d M Y'),
                    'views' => 0,
                ];
                // Remove featured article from main list
                $transformedArticles = array_filter($transformedArticles, function ($article) use ($featuredArticleQuery) {
                    return $article['id'] !== $featuredArticleQuery->id;
                });
            }
        }

        // Popular articles for sidebar
        $popularArticles = Article::with(['author'])
            ->orderBy('updated_at', 'desc')
            ->limit(3)
            ->get()
            ->map(function ($article) use ($fallbackImage) {
                return [
                    'slug' => $article->slug,
                    'title' => $article->title,
                    'read_time' => ceil(str_word_count(strip_tags($article->content)) / 200) . ' menit membaca',
                    'thumbnail_image' => $article->image_url ?? $fallbackImage,
                ];
            })->toArray();

        // Get all categories with count
        $categories = Category::get()->map(function ($cat) {
            $count = Article::where('categories', $cat->id)->count();
            return [
                'slug' => $cat->slug,
                'name' => $cat->name,
                'count' => $count,
                'icon' => 'fa-solid fa-tag',
            ];
        })->toArray();

        // Add "All" category
        array_unshift($categories, [
            'slug' => 'all',
            'name' => 'Semua',
            'count' => Article::count(),
            'icon' => 'fa-solid fa-shapes',
        ]);

        return view('articles.index', [
            'articles' => $transformedArticles,
            'featuredArticle' => $featuredArticle,
            'popularArticles' => $popularArticles,
            'categories' => $categories,
            'currentCategory' => $categoryFilter ?? 'all',
            'searchQuery' => $searchQuery ?? '',
            'currentSort' => $sort,
        ]);
    }


    /**
     * Calculate reading time based on content
     */
    private function calculateReadTime($content)
    {
        // Rough estimate: 200 words per minute
        $wordCount = str_word_count(strip_tags($content));
        $minutes = ceil($wordCount / 200);
        return $minutes . ' menit membaca';
    }

    /**
     * Tampilkan Detail Artikel
     */
    public function show($slug)
    {
        $fallbackImage = config('app.fallback_image_url');
        
        $article = Article::where('slug', $slug)
            ->with(['author', 'category'])
            ->firstOrFail();

        // Transform article for view
        $formattedArticle = (object) [
            'id' => $article->id,
            'slug' => $article->slug,
            'title' => $article->title,
            'categories' => $article->category ? [(object) [
                'name' => $article->category->name,
                'slug' => $article->category->slug,
            ]] : [(object) ['name' => 'Umum', 'slug' => 'umum']],
            'excerpt' => $article->short_description,
            'content' => $article->content,
            'author' => (object) [
                'name' => $article->author?->name ?? 'Tim Medis Maternity.id',
                'role' => 'Praktisi Medis',
                'avatar' => null,
            ],
            'image_url' => $article->image_url ?? $fallbackImage,
            'thumbnail_image' => $article->image_url ?? $fallbackImage,
            'views' => 0,
            'published_at' => $article->updated_at,
            'tags' => array_filter(array_map('trim', explode(',', $article->keywords ?? ''))),
        ];

        // Get related articles (from same category, exclude current)
        $relatedArticles = Article::where('id', '!=', $article->id)
            ->when($article->categories, function ($q) use ($article) {
                $q->where('categories', $article->categories);
            })
            ->with(['author'])
            ->limit(4)
            ->get()
            ->map(function ($art) use ($fallbackImage) {
                return (object) [
                    'id' => $art->id,
                    'slug' => $art->slug,
                    'title' => $art->title,
                    'excerpt' => $art->short_description,
                    'image_url' => $art->image_url ?? $fallbackImage,
                    'thumbnail_image' => $art->image_url ?? $fallbackImage,
                    'author' => (object) [
                        'name' => $art->author?->name ?? 'Tim Medis Maternity.id',
                    ],
                ];
            });

        return view('articles.show', [
            'article' => $formattedArticle,
            'relatedArticles' => $relatedArticles,
        ]);
    }
}
