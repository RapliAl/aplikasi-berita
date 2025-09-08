<?php

namespace App\Filament\Resources\ArticleResource\Pages;

use App\Filament\Resources\ArticleResource;
use Filament\Actions;
use App\Models\Comment;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Support\Facades\Auth;
class ListArticles extends ListRecords
{
    protected static string $resource = ArticleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    // public function getTabs(): array
    // {
    //     $tabs = ['all' => Tab::make('All')->badge($this->getModel()::count())];

    //     $comments = Comment::orderBy('created_at', 'desc')
    //     ->withCount('article')
    //     ->get();

    //     foreach ($comments as $comment) {
    //         $name = $comment->tittle;
    //         $slug = str($name)->slug()->toString();

    //         $tabs[$slug] = Tab::make($name)
    //             ->badge($comment->comments_content)
    //             ->label('Comments')
    //             ->modifyQueryUsing(fn ($query) => $query->where('user_id', $comment->user_id));
    //     }

    //     return $tabs;
    // }

    public function getTabs(): array 
    {
        return [
            Tab::make('All'),
                // ->badge($this->getModel()::count()),
            Tab::make('Comments')
                // ->badge(Comment::count())
                ->label('Comments')
                ->modifyQueryUsing(fn ($query) => $query->whereHas('comments', fn ($query) => $query->where('user_id', Auth::id()))),
        ];
    }
}
