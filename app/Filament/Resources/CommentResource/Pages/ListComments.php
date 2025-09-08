<?php

namespace App\Filament\Resources\CommentResource\Pages;

use App\Filament\Resources\CommentResource;
use Filament\Actions;
use App\Models\Article;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;

class ListComments extends ListRecords
{
    protected static string $resource = CommentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        $tabs = ['all' => Tab::make('All')->badge($this->getModel()::count())];

        $articles = Article::orderBy('published_at', 'desc')
        ->withCount('comments')
        ->get();

        foreach ($articles as $article) {
            $name = $article->title;
            $slug = str($name)->slug()->toString();

            $tabs[$slug] = Tab::make($name)
                ->badge($article->comments_count)
                ->modifyQueryUsing(fn ($query) => $query->where('article_id', $article->tittle));
        }

        return $tabs;
    }
}
