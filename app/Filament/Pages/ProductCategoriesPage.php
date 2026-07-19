<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class ProductCategoriesPage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    protected static string $view = 'filament.pages.product-categories-page';

    protected static string|\UnitEnum|null $navigationGroup = 'Site İçeriği';

    protected static ?string $navigationLabel = 'Projelerim';
    
    protected static ?string $slug = 'projelerim';

    protected static ?string $title = 'Projeler Kategorileri';
    
    protected static ?int $navigationSort = 3;
}
