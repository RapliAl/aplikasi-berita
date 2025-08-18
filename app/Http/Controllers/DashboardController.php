<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleView;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Like;
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
            'articles_read' => ArticleView::where('user_id', $user->id)->count(),
            'comments_made' => Comment::where('user_id', $user->id)->count(),
            'articles_liked' => Like::where('user_id', $user->id)->count(),
            'reading_streak' => $this->getReadingStreak($user),
        ];
        
        $recommendedArticles = Article::where('status', 'published')
            ->with(['user', 'category'])
            ->latest()
            ->take(6)
            ->get();
            
        $trendingArticles = Article::where('status', 'published')
            ->with(['user', 'category'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
            
        $recentComments = Comment::with(['user', 'article'])
            ->where('user_id', $user->id)
            ->latest()
            ->take(10)
            ->get();
            
        $favoriteCategories = $this->getFavoriteCategories($user);

        return view('dashboard.reader', compact(
            'userStats', 
            'recommendedArticles', 
            'trendingArticles', 
            'recentComments', 
            'favoriteCategories'
        ));
    }
    
    private function getReadingStreak($user)
    {
        // Calculate reading streak - how many consecutive days user has read articles
        $views = ArticleView::where('user_id', $user->id)
            ->select('viewed_at')
            ->orderBy('viewed_at', 'desc')
            ->get()
            ->groupBy(function($view) {
                return $view->viewed_at->format('Y-m-d');
            });

        if ($views->isEmpty()) {
            return 0;
        }

        $streak = 0;
        $currentDate = now()->startOfDay();
        
        foreach ($views->keys() as $date) {
            $viewDate = \Carbon\Carbon::parse($date)->startOfDay();
            
            if ($viewDate->eq($currentDate) || $viewDate->eq($currentDate->copy()->subDay())) {
                $streak++;
                $currentDate = $viewDate->copy()->subDay();
            } else {
                break;
            }
        }

        return $streak;
    }
    
    private function getFavoriteCategories($user)
    {
        // Get categories based on user reading history
        return Category::withCount(['articles as read_count' => function($query) use ($user) {
            $query->join('article_views', 'articles.id', '=', 'article_views.article_id')
                  ->where('article_views.user_id', $user->id);
        }])
        ->orderBy('read_count', 'desc')
        ->take(5)
        ->get();
    }
}
