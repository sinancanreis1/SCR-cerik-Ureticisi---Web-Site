<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class BlogCategoriesPage extends Page
{
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-document-text';

    protected string $view = 'filament.pages.blog-categories-page';

    protected static string|\UnitEnum|null $navigationGroup = 'Site İçeriği';

    protected static ?string $navigationLabel = 'Yazılar';
    
    protected static ?string $slug = 'icerikler';

    protected static ?string $title = 'Yazılar Kategorileri';
    
    protected static ?int $navigationSort = 2;
}
