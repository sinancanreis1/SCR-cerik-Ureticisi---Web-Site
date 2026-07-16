<?php

namespace App\Filament\Resources\Sliders\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\ToggleColumn;

class SlidersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image_path')
                    ->label('Görsel')
                    ->circular()
                    ->size(40),
                TextColumn::make('title')
                    ->label('Başlık')
                    ->searchable(),
                TextColumn::make('order')
                    ->label('Sıra')
                    ->sortable(),
                ToggleColumn::make('is_active')
                    ->label('Aktif Mi?'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('order', 'asc');
    }
}
