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

    public static function getNavigationBadge(): ?string
    {
        return static::getEloquentQuery()->where('is_active', false)->count() ?: null;
    }

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
                        \Filament\Forms\Components\Toggle::make('is_rejected')
                            ->label('Reddedildi')
                            ->required(),
                    ])->columns(3)
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

                TextColumn::make('status')
                    ->label('Durum')
                    ->badge()
                    ->state(function (Blog $record): string {
                        if ($record->is_rejected) {
                            return 'Reddedildi';
                        }
                        return $record->is_active ? 'Onaylandı' : 'Onay Bekliyor';
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'Onaylandı' => 'success',
                        'Reddedildi' => 'danger',
                        'Onay Bekliyor' => 'warning',
                    }),

                TextColumn::make('created_at')
                    ->label('Gönderim Tarihi')
                    ->dateTime('d.m.Y H:i')
                    ->sortable(),
            ])
            ->filters([])
            ->recordActions([
                Action::make('approve')
                    ->label('Onayla')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn (Blog $record) => !$record->is_active)
                    ->action(fn (Blog $record) => $record->update(['is_active' => true, 'is_rejected' => false])),
                Action::make('reject')
                    ->label('Reddet')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->visible(fn (Blog $record) => !$record->is_rejected)
                    ->action(fn (Blog $record) => $record->update(['is_active' => false, 'is_rejected' => true])),
                Action::make('pending')
                    ->label('Beklemeye Al')
                    ->icon('heroicon-o-clock')
                    ->color('warning')
                    ->visible(fn (Blog $record) => $record->is_active || $record->is_rejected)
                    ->action(fn (Blog $record) => $record->update(['is_active' => false, 'is_rejected' => false])),
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
