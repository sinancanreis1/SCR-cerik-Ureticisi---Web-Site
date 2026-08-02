<?php

namespace App\Filament\Resources\Users;

use App\Filament\Resources\Users\Pages\ListUsers;
use App\Models\User;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\BulkActionGroup;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'Kullanıcılar';
    protected static ?string $modelLabel = 'Kullanıcı';
    protected static ?string $pluralModelLabel = 'Kullanıcılar';
    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('avatar_url')
                    ->label('Avatar')
                    ->disk('public')
                    ->circular()
                    ->defaultImageUrl(fn ($record) => 'https://ui-avatars.com/api/?name=' . urlencode($record->name) . '&background=661414&color=fff'),

                TextColumn::make('name')
                    ->label('Ad Soyad')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('email')
                    ->label('E-Posta')
                    ->searchable(),

                TextColumn::make('roles.name')
                    ->label('Rol')
                    ->badge(),

                IconColumn::make('is_banned')
                    ->label('Banlı')
                    ->boolean()
                    ->trueIcon('heroicon-o-no-symbol')
                    ->falseIcon('heroicon-o-check-circle')
                    ->trueColor('danger')
                    ->falseColor('success'),

                TextColumn::make('created_at')
                    ->label('Kayıt Tarihi')
                    ->dateTime('d.m.Y')
                    ->sortable(),
            ])
            ->filters([])
            ->recordActions([
                \Filament\Actions\Action::make('ban')
                    ->label(fn (User $record) => $record->is_banned ? 'Banı Kaldır' : 'Banla')
                    ->icon(fn (User $record) => $record->is_banned ? 'heroicon-o-check-circle' : 'heroicon-o-no-symbol')
                    ->color(fn (User $record) => $record->is_banned ? 'success' : 'warning')
                    ->requiresConfirmation()
                    ->modalHeading(fn (User $record) => $record->is_banned ? 'Banı Kaldır' : 'Kullanıcıyı Banla')
                    ->modalDescription(fn (User $record) => $record->is_banned
                        ? 'Bu kullanıcının banını kaldırmak istediğinizden emin misiniz?'
                        : 'Bu kullanıcıyı banlamak istediğinizden emin misiniz? Kullanıcı siteye giriş yapamayacak.')
                    ->action(fn (User $record) => $record->update(['is_banned' => !$record->is_banned])),

                DeleteAction::make()
                    ->label('Sil'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()->label('Seçilenleri Sil'),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListUsers::route('/'),
        ];
    }
}
