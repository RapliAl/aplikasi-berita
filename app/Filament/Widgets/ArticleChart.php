<?php

namespace App\Filament\Widgets;

use App\Models\Article;
use Filament\Widgets\DoughnutChartWidget;
use Illuminate\Support\Facades\Auth;

class ArticleChart extends DoughnutChartWidget
{
    protected static ?string $heading = 'Distribusi Status Artikel';
    
    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $user = Auth::user();
        
        if ($user->hasRole('Admin')) {
            // Admin melihat semua artikel
            $published = Article::where('status', 'published')->count();
            $draft = Article::where('status', 'draft')->count();
            $archived = Article::where('status', 'archived')->count();
        } else {
            // Author melihat artikel mereka sendiri
            $published = Article::where('user_id', $user->id)->where('status', 'published')->count();
            $draft = Article::where('user_id', $user->id)->where('status', 'draft')->count();
            $archived = Article::where('user_id', $user->id)->where('status', 'archived')->count();
        }

        return [
            'datasets' => [
                [
                    'label' => 'Artikel',
                    'data' => [$published, $draft, $archived],
                    'backgroundColor' => [
                        '#10B981', // Green untuk published
                        '#F59E0B', // Amber untuk draft
                        '#EF4444', // Red untuk archived
                    ],
                ],
            ],
            'labels' => ['Published', 'Draft', 'Archived'],
        ];
    }
}
