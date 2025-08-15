<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Redirect based on role
        if ($user->hasRole('Admin') || $user->hasRole('Author')) {
            return redirect('/admin');
        }
        
        // Reader dashboard
        $userStats = [
            'articles_read' => $this->getArticlesReadCount($user),
            'comments_made' => Comment::where('user_id', $user->id)->count(),
            'favorite_categories' => $this->getFavoriteCategories($user),
            'reading_streak' => 0, // Placeholder
        ];
        
        $recommendedArticles = Article::where('status', 'published')
            ->with(['user'])
            ->latest()
            ->take(6)
            ->get();
            
        $trendingArticles = Article::where('status', 'published')
            ->with(['user'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
            
        $recentComments = Comment::with(['user', 'article'])
            ->latest()
            ->take(10)
            ->get();
            
        $favoriteCategories = Category::withCount('articles')
            ->orderBy('articles_count', 'desc')
            ->take(5)
            ->get();

        return view('dashboard.reader', compact(
            'userStats', 
            'recommendedArticles', 
            'trendingArticles', 
            'recentComments', 
            'favoriteCategories'
        ));
    }
    
    private function getArticlesReadCount($user)
    {
        // Placeholder - in real app, track user reading history
        return rand(15, 50);
    }
    
    private function getFavoriteCategories($user)
    {
        // Placeholder - get categories based on user reading history
        return Category::take(3)->get();
    }
}
