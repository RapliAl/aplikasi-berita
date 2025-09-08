<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleView;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Comment;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    /**
     * Display a listing of published articles.
     */
    public function index()
    {
        $articles = Article::with(['user', 'category', 'tags'])
            ->where('status', 'published')
            ->latest()
            ->paginate(12);

        $categories = Category::withCount('articles')->get();
        $tags = Tag::withCount('articles')->get();

        return view('frontend.articles.index', compact('articles', 'categories', 'tags'));
    }

    /**
     * Display the specified article.
     */
    public function show(Article $article)
    {
        // Only show published articles
        if ($article->status !== 'published') {
            abort(404);
        }

        $article->load(['user', 'category', 'tags', 'comments.user']);
        
        // Track article view for authenticated users
        if (Auth::check()) {
            ArticleView::firstOrCreate([
                'user_id' => Auth::id(),
                'article_id' => $article->id,
            ], [
                'viewed_at' => now(),
            ]);
        }
        
        // Get related articles
        $relatedArticles = Article::where('category_id', $article->category_id)
            ->where('id', '!=', $article->id)
            ->where('status', 'published')
            ->take(3)
            ->get();

        $userLiked = false;
        if (Auth::check()) {
            $userLiked = Like::where('article_id', $article->id)
                ->where('user_id', Auth::id())
                ->exists();
        }

        $likesCount = Like::where('article_id', $article->id)->count();
        $viewsCount = ArticleView::where('article_id', $article->id)->count();

        return view('frontend.articles.show', compact('article', 'relatedArticles', 'userLiked', 'likesCount', 'viewsCount'));
    }

    /**
     * Store a comment for the article.
     */
    public function storeComment(Request $request, Article $article)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to comment.');
        }

        if (!Auth::user()->can('create_comment')) {
            abort(403, 'You do not have permission to create comments.');
        }

        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        Comment::create([
            'article_id' => $article->id,
            'user_id' => Auth::id(),
            'content' => $request->input('content'),
        ]);

        return redirect()->back()->with('success', 'Comment added successfully!');
    }

    /**
     * Toggle like for the article.
     */
    public function toggleLike(Request $request, Article $article)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'You must be logged in to like.'], 401);
        }

        if (!Auth::user()->can('create_like')) {
            return response()->json(['error' => 'You do not have permission to like articles.'], 403);
        }

        $like = Like::where('article_id', $article->id)
            ->where('user_id', Auth::id())
            ->first();

        if ($like) {
            $like->delete();
            $liked = false;
        } else {
            Like::create([
                'article_id' => $article->id,
                'user_id' => Auth::id(),
            ]);
            $liked = true;
        }

        $likesCount = Like::where('article_id', $article->id)->count();

        return response()->json([
            'success' => true,
            'liked' => $liked,
            'likes_count' => $likesCount
        ]);
    }

    /**
     * Display articles by category.
     */
    public function byCategory(Category $category)
    {
        $articles = Article::with(['user', 'category', 'tags'])
            ->where('category_id', $category->id)
            ->where('status', 'published')
            ->latest()
            ->paginate(12);

        $otherCategories = Category::withCount('articles')
            ->where('id', '!=', $category->id)
            ->get();

        return view('frontend.articles.category', compact('articles', 'category', 'otherCategories'));
    }

    /**
     * Display articles by tag.
     */
    public function byTag(Tag $tag)
    {
        $articles = $tag->articles()
            ->with(['user', 'category', 'tags'])
            ->where('status', 'published')
            ->latest()
            ->paginate(12);

        $popularTags = Tag::withCount('articles')
            ->orderBy('articles_count', 'desc')
            ->limit(10)
            ->get();

        return view('frontend.articles.tag', compact('articles', 'tag', 'popularTags'));
    }
}
