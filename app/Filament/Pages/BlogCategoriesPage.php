<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class BlogCategoriesPage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static string $view = 'filament.pages.blog-categories-page';

    protected static string|\UnitEnum|null $navigationGroup = 'Site İçeriği';

    protected static ?string $navigationLabel = 'İçerikler';
    
    protected static ?string $slug = 'icerikler';

    protected static ?string $title = 'İçerikler Kategorileri';
    
    protected static ?int $navigationSort = 2;
}
