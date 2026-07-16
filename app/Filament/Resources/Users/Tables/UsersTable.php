<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('avatar_url')
                    ->label('Profil')
                    ->disk('public')
                    ->circular(),
                TextColumn::make('name')
                    ->label('Kullanıcı Adı')
                    ->searchable(),
                TextColumn::make('first_name')
                    ->label('İsim')
                    ->searchable(),
                TextColumn::make('last_name')
                    ->label('Soyisim')
                    ->searchable(),
                TextColumn::make('title')
                    ->label('Ünvan')
                    ->searchable(),
                TextColumn::make('roles.name')
                    ->label('Roller')
                    ->badge(),
                TextColumn::make('email')
                    ->label('E-posta Adresi')
                    ->searchable(),
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
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
