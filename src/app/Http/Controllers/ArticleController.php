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
        // Get all published articles from database, sorted by updated_at (latest first)
        $articlesQuery = Article::where('status', 'published')
            ->with(['author', 'categories'])
            ->orderBy('updated_at', 'desc');

        // Handle sorting
        $sort = $request->input('sort', 'latest');
        if ($sort === 'popular') {
            $articlesQuery->orderBy('views_count', 'desc');
        } else {
            $articlesQuery->orderBy('updated_at', 'desc');
        }

        // Handle category filter
        $categoryFilter = $request->input('category');
        if ($categoryFilter && $categoryFilter !== 'all') {
            $articlesQuery->whereHas('categories', function ($q) use ($categoryFilter) {
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
        $transformedArticles = $articles->map(function ($article) {
            return [
                'id' => $article->id,
                'slug' => $article->slug,
                'title' => $article->title,
                'category' => $article->categories->first()?->name ?? 'Umum',
                'category_slug' => $article->categories->first()?->slug ?? 'umum',
                'excerpt' => $article->short_description,
                'content' => $article->content,
                'author' => $article->author?->account?->name ?? 'Tim Medis Maternity.id',
                'author_role' => 'Praktisi Medis',
                'thumbnail_image' => $article->thumbnail_image,
                'read_time' => $article->author?->account?->name ?? 'Tim Medis Maternity.id',
                'published_at' => $article->updated_at->format('d M Y'),
                'views' => $article->views_count,
            ];
        })->toArray();

        // Featured article (first published article if no search/filter)
        $featuredArticle = null;
        if (empty($searchQuery) && (empty($categoryFilter) || $categoryFilter === 'all')) {
            $featuredArticleQuery = Article::where('status', 'published')
                ->with(['author', 'categories'])
                ->orderBy('updated_at', 'desc')
                ->first();
            
            if ($featuredArticleQuery) {
                $featuredArticle = [
                    'id' => $featuredArticleQuery->id,
                    'slug' => $featuredArticleQuery->slug,
                    'title' => $featuredArticleQuery->title,
                    'category' => $featuredArticleQuery->categories->first()?->name ?? 'Umum',
                    'category_slug' => $featuredArticleQuery->categories->first()?->slug ?? 'umum',
                    'excerpt' => $featuredArticleQuery->short_description,
                    'content' => $featuredArticleQuery->content,
                    'author' => $featuredArticleQuery->author?->account?->name ?? 'Tim Medis Maternity.id',
                    'thumbnail_image' => $featuredArticleQuery->thumbnail_image,
                    'read_time' => $featuredArticleQuery->author?->account?->name ?? 'Tim Medis Maternity.id',
                    'published_at' => $featuredArticleQuery->updated_at->format('d M Y'),
                    'views' => $featuredArticleQuery->views_count,
                ];
                // Remove featured article from main list
                $transformedArticles = array_filter($transformedArticles, function ($article) use ($featuredArticleQuery) {
                    return $article['id'] !== $featuredArticleQuery->id;
                });
            }
        }

        // Popular articles for sidebar
        $popularArticles = Article::where('status', 'published')
            ->with(['author', 'categories'])
            ->orderBy('views_count', 'desc')
            ->limit(3)
            ->get()
            ->map(function ($article) {
                return [
                    'slug' => $article->slug,
                    'title' => $article->title,
                    'read_time' => $article->author?->account?->name ?? 'Tim Medis Maternity.id',
                    'thumbnail_image' => $article->thumbnail_image,
                ];
            })->toArray();

        // Get all categories with count
        $categories = Category::withCount(['articles' => function ($q) {
            $q->where('status', 'published');
        }])->get()->map(function ($cat) {
            return [
                'slug' => $cat->slug,
                'name' => $cat->name,
                'count' => $cat->articles_count,
                'icon' => 'fa-solid fa-tag',
            ];
        })->toArray();

        // Add "All" category
        array_unshift($categories, [
            'slug' => 'all',
            'name' => 'Semua',
            'count' => Article::where('status', 'published')->count(),
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
        $article = Article::where('slug', $slug)
            ->where('status', 'published')
            ->with(['author', 'author.account', 'categories'])
            ->firstOrFail();

        // Transform article for view
        $formattedArticle = (object) [
            'id' => $article->id,
            'slug' => $article->slug,
            'title' => $article->title,
            'category' => $article->categories->first()?->name ?? 'Umum',
            'category_slug' => $article->categories->first()?->slug ?? 'umum',
            'excerpt' => $article->short_description,
            'content' => $article->content,
            'author' => (object) [
                'name' => $article->author?->account?->name ?? 'Tim Medis Maternity.id',
                'role' => 'Praktisi Medis',
                'avatar' => null,
            ],
            'image_url' => $article->thumbnail_image ?? 'https://images.unsplash.com/photo-1518611012118-696072aa579a?auto=format&fit=crop&w=1200&q=80',
            'thumbnail_image' => $article->thumbnail_image ?? 'https://images.unsplash.com/photo-1518611012118-696072aa579a?auto=format&fit=crop&w=1200&q=80',
            'views' => $article->views_count,
            'read_time' => $this->calculateReadTime($article->content),
            'published_at' => $article->updated_at,
            'tags' => array_filter(array_map('trim', explode(',', $article->keywords ?? ''))),
        ];

        // Get related articles (from same category, exclude current)
        $relatedArticles = Article::where('status', 'published')
            ->where('id', '!=', $article->id)
            ->whereHas('categories', function ($q) use ($article) {
                $q->whereIn('categories.id', $article->categories->pluck('id'));
            })
            ->with(['author', 'categories'])
            ->limit(4)
            ->get()
            ->map(function ($art) {
                return (object) [
                    'id' => $art->id,
                    'slug' => $art->slug,
                    'title' => $art->title,
                    'category' => $art->categories->first()?->name ?? 'Umum',
                    'category_slug' => $art->categories->first()?->slug ?? 'umum',
                    'excerpt' => $art->short_description,
                    'image_url' => $art->thumbnail_image ?? 'https://images.unsplash.com/photo-1518611012118-696072aa579a?auto=format&fit=crop&w=1200&q=80',
                    'thumbnail_image' => $art->thumbnail_image ?? 'https://images.unsplash.com/photo-1518611012118-696072aa579a?auto=format&fit=crop&w=1200&q=80',
                    'read_time' => $this->calculateReadTime($art->content),
                ];
            });

        return view('articles.show', [
            'article' => $formattedArticle,
            'relatedArticles' => $relatedArticles,
        ]);
    }
}
