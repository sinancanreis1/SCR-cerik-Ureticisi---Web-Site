<?php

namespace App\Filament\Resources\BlogApproval;

use App\Filament\Resources\BlogApproval\Pages\ListBlogApprovals;
use App\Filament\Resources\BlogApproval\Pages\EditBlogApproval;
use App\Models\Blog;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Illuminate\Database\Eloquent\Builder;

class BlogApprovalResource extends Resource
{
    protected static ?string $model = Blog::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-check-badge';
    protected static ?string $navigationLabel = 'Yazı Onayları';
    protected static ?string $modelLabel = 'Üye Yazısı';
    protected static ?string $pluralModelLabel = 'Yazı Onayları';
    protected static \UnitEnum|string|null $navigationGroup = null;
    protected static ?int $navigationSort = 3;
    protected static ?string $slug = 'yazi-onaylari';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->whereNotNull('user_id')
            ->whereHas('user', function (Builder $query) {
                $query->whereDoesntHave('roles', function (Builder $qr) {
                    $qr->whereIn('name', ['admin', 'super_admin']);
                });
            });
    }

    public static function form(Schema $schema): Schema
    {
        // Reuse the BlogForm if possible, or build a simple schema
        return $schema
            ->columns(1)
            ->components([
                \Filament\Schemas\Components\Section::make('Yazı Detayları')
                    ->schema([
                        \Filament\Forms\Components\TextInput::make('title')
                            ->label('Başlık')
                            ->disabled(),
                        \Filament\Forms\Components\TextInput::make('category')
                            ->label('Kategori')
                            ->disabled(),
                        \Filament\Forms\Components\Textarea::make('excerpt')
                            ->label('Kısa Özet')
                            ->disabled()
                            ->columnSpanFull(),
                        \Filament\Forms\Components\RichEditor::make('content')
                            ->label('İçerik')
                            ->disabled()
                            ->columnSpanFull(),
                        \Filament\Forms\Components\Toggle::make('is_active')
                            ->label('Yayında / Onaylı')
                            ->required(),
                    ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image_path')
                    ->label('Kapak Görseli')
                    ->circular()
                    ->disk('public'),

                TextColumn::make('title')
                    ->label('Başlık')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('user.name')
                    ->label('Yazar (Üye)')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('category')
                    ->label('Kategori')
                    ->sortable(),

                IconColumn::make('is_active')
                    ->label('Durum')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-clock')
                    ->trueColor('success')
                    ->falseColor('warning'),

                TextColumn::make('created_at')
                    ->label('Gönderim Tarihi')
                    ->dateTime('d.m.Y H:i')
                    ->sortable(),
            ])
            ->filters([])
            ->recordActions([
                Action::make('approve')
                    ->label(fn (Blog $record) => $record->is_active ? 'Pasife Al' : 'Onayla')
                    ->icon(fn (Blog $record) => $record->is_active ? 'heroicon-o-x-circle' : 'heroicon-o-check-circle')
                    ->color(fn (Blog $record) => $record->is_active ? 'danger' : 'success')
                    ->action(fn (Blog $record) => $record->update(['is_active' => !$record->is_active])),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBlogApprovals::route('/'),
            'edit' => EditBlogApproval::route('/{record}/edit'),
        ];
    }
}
