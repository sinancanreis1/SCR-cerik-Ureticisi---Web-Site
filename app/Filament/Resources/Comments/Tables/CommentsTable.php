<?php

namespace App\Filament\Resources\Comments\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CommentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Kullanıcı')
                    ->sortable(),
                TextColumn::make('commentable_type')
                    ->label('Türü')
                    ->formatStateUsing(fn (string $state): string => match(class_basename($state)) {
                        'Blog' => 'Yazı',
                        'Product' => 'Proje',
                        default => class_basename($state),
                    })
                    ->searchable(),
                TextColumn::make('commentable.title')
                    ->label('İçerik Başlığı')
                    ->limit(30),
                TextColumn::make('content')
                    ->label('Yorum')
                    ->limit(50),
                IconColumn::make('is_approved')
                    ->label('Onaylı')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                Action::make('approve')
                    ->label(fn ($record) => $record->is_approved ? 'Onayı Kaldır' : 'Onayla')
                    ->icon(fn ($record) => $record->is_approved ? 'heroicon-o-x-circle' : 'heroicon-o-check-circle')
                    ->color(fn ($record) => $record->is_approved ? 'danger' : 'success')
                    ->action(fn ($record) => $record->update(['is_approved' => !$record->is_approved])),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
