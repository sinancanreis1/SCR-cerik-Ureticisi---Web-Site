<?php

namespace App\Filament\Resources\Blogs\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;

class BlogsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\ImageColumn::make('image_path')
                    ->label('Kapak Görseli')
                    ->circular()
                    ->disk('public'),
                \Filament\Tables\Columns\TextColumn::make('title')
                    ->label('Başlık')
                    ->searchable()
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('views')
                    ->label('Okunma')
                    ->sortable()
                    ->badge(),
                \Filament\Tables\Columns\TextColumn::make('created_at')
                    ->label('Yayın Tarihi')
                    ->dateTime('d.m.Y H:i')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make()->iconButton(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
