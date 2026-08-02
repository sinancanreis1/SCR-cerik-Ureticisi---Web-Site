<?php

namespace App\Filament\Resources\Products\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use App\Filament\Resources\Products\Pages\EditProduct;
use Illuminate\Database\Eloquent\Model;

class ProductsTable
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
                        ->extraImgAttributes([
                            'style' => 'width: 100%; height: 200px; object-fit: cover; border-radius: 12px 12px 0 0; max-width: 100%;',
                        ]),
                    Stack::make([
                        TextColumn::make('title')
                            ->weight('bold')
                            ->size('lg')
                            ->searchable(),
                        TextColumn::make('subtitle')
                            ->color('gray')
                            ->limit(50),
                        TextColumn::make('project_date')
                            ->icon('heroicon-m-calendar')
                            ->color('gray')
                            ->size('sm'),
                        TextColumn::make('project_link')
                            ->icon('heroicon-m-link')
                            ->color('primary')
                            ->size('sm')
                            ->limit(30)
                            ->url(fn ($record) => $record->project_link, true),
                    ])->space(1)->extraAttributes(['style' => 'padding: 16px;']),
                ])->space(0)
            ])
            ->recordUrl(
                fn (Model $record): string => EditProduct::getUrl(['record' => $record]),
            )
            ->filters([
                //
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
