<?php

namespace App\Filament\Widgets;

use App\Models\Article;
use App\Models\Comment;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Auth;

class RecentActivity extends Widget
{
    protected static string $view = 'filament.widgets.recent-activity';
    
    protected static ?int $sort = 3;
    
    protected function getViewData(): array
    {
        $user = Auth::user();
        
        if ($user->hasRole('Admin')) {
            // Admin melihat semua aktivitas
            $recentArticles = Article::with(['user'])
                ->latest()
                ->take(5)
                ->get();
            $recentComments = Comment::with(['user', 'article'])
                ->latest()
                ->take(5)
                ->get();
        } else {
            // Author melihat aktivitas mereka sendiri
            $recentArticles = Article::with(['user'])
                ->where('user_id', $user->id)
                ->latest()
                ->take(5)
                ->get();
            $recentComments = Comment::with(['user', 'article'])
                ->whereHas('article', function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                })
                ->latest()
                ->take(5)
                ->get();
        }
        
        return [
            'recentArticles' => $recentArticles,
            'recentComments' => $recentComments,
            'isAdmin' => $user->hasRole('Admin'),
        ];
    }
}
