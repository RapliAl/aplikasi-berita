<?php

namespace App\Filament\Widgets;

use App\Models\Article;
use App\Models\Comment;
use App\Models\User;
use App\Models\Category;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $user = Auth::user();
        
        if ($user->hasRole('Admin')) {
            // Admin dapat melihat semua statistik
            return [
                Stat::make('Total Artikel', Article::count())
                    ->description('Semua artikel di sistem')
                    ->descriptionIcon('heroicon-m-document-text')
                    ->color('success'),
                    
                Stat::make('Total Pengguna', User::count())
                    ->description('Semua pengguna terdaftar')
                    ->descriptionIcon('heroicon-m-users')
                    ->color('info'),
                    
                Stat::make('Total Komentar', Comment::count())
                    ->description('Semua komentar')
                    ->descriptionIcon('heroicon-m-chat-bubble-left')
                    ->color('warning'),
                    
                Stat::make('Artikel Dipublikasi', Article::where('status', 'published')->count())
                    ->description('Artikel yang sudah published')
                    ->descriptionIcon('heroicon-m-eye')
                    ->color('primary'),
            ];
        } else {
            // Author hanya melihat statistik mereka sendiri
            return [
                Stat::make('Artikel Saya', Article::where('user_id', $user->id)->count())
                    ->description('Total artikel yang Anda tulis')
                    ->descriptionIcon('heroicon-m-document-text')
                    ->color('success'),
                    
                Stat::make('Artikel Published', Article::where('user_id', $user->id)->where('status', 'published')->count())
                    ->description('Artikel Anda yang sudah published')
                    ->descriptionIcon('heroicon-m-eye')
                    ->color('primary'),
                    
                Stat::make('Draft Artikel', Article::where('user_id', $user->id)->where('status', 'draft')->count())
                    ->description('Artikel dalam bentuk draft')
                    ->descriptionIcon('heroicon-m-pencil')
                    ->color('warning'),
                    
                Stat::make('Total Views', '0')
                    ->description('Total views artikel Anda')
                    ->descriptionIcon('heroicon-m-chart-bar')
                    ->color('info'),
            ];
        }
    }
}
