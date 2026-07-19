<?php

namespace App\Filament\Resources\Blogs;

use App\Filament\Resources\Blogs\Pages\CreateBlog;
use App\Filament\Resources\Blogs\Pages\EditBlog;
use App\Filament\Resources\Blogs\Pages\ListBlogs;
use App\Filament\Resources\Blogs\Schemas\BlogForm;
use App\Filament\Resources\Blogs\Tables\BlogsTable;
use App\Models\Blog;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class BlogResource extends Resource
{
    protected static \UnitEnum|string|null $navigationGroup = 'Site İçeriği';
    protected static ?string $model = \App\Models\Blog::class;

    protected static bool $shouldRegisterNavigation = false;
    protected static ?string $recordTitleAttribute = 'title';

    protected static ?string $modelLabel = 'Blog Yazısı';
    protected static ?string $pluralModelLabel = 'Blog Yazıları';
    protected static ?string $navigationLabel = 'Blog Yönetimi';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-document-text';
    protected static ?int $navigationSort = 4;
    protected static ?string $slug = 'icerikler/liste';

    public static function form(Schema $schema): Schema
    {
        return BlogForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BlogsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBlogs::route('/'),
            'create' => CreateBlog::route('/create'),
            'edit' => EditBlog::route('/{record}/edit'),
        ];
    }
}
