<?php

namespace App\Filament\Resources\Categories\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\Layout\Stack;
use App\Filament\Resources\Categories\Pages\EditCategory;
use Illuminate\Database\Eloquent\Model;

class CategoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->contentGrid([
                'md' => 2,
                'xl' => 3,
            ])
            ->columns([
                Stack::make([
                    ImageColumn::make('image')
                        ->disk('public')
                        ->height('200px')
                        ->width('100%')
                        ->extraImgAttributes(['style' => 'object-fit: cover; border-radius: 12px 12px 0 0;']),
                    Stack::make([
                        TextColumn::make('name')
                            ->weight('bold')
                            ->size('lg')
                            ->searchable()
                            ->sortable(),
                    ])->space(1)->extraAttributes(['style' => 'padding: 16px;']),
                ])->space(0)
            ])
            ->recordUrl(
                fn (Model $record): string => EditCategory::getUrl(['record' => $record]),
            )
            ->defaultSort('name')
            ->filters([
                // Filtrelere gerek kalmadı çünkü sadece ana kategoriler listeleniyor
            ])
            ->recordActions([
                EditAction::make()->button(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
