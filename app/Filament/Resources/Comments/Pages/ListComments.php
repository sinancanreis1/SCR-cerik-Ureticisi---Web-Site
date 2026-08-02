<?php

namespace App\Filament\Resources\Comments\Pages;

use App\Filament\Resources\Comments\CommentResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListComments extends ListRecords
{
    protected static string $resource = CommentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('Tümü')
                ->icon('heroicon-m-chat-bubble-left-right'),
            'blogs' => Tab::make('Yazı Yorumları')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('commentable_type', 'App\Models\Blog'))
                ->icon('heroicon-m-document-text')
                ->badge(fn () => $this->getModel()::where('commentable_type', 'App\Models\Blog')->count())
                ->badgeColor('info'),
            'products' => Tab::make('Proje Yorumları')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('commentable_type', 'App\Models\Product'))
                ->icon('heroicon-m-briefcase')
                ->badge(fn () => $this->getModel()::where('commentable_type', 'App\Models\Product')->count())
                ->badgeColor('success'),
        ];
    }
}
