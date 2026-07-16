<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Illuminate\Support\Str;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('Ana Kategori Bilgileri')
                    ->description('Kategorinin adını ve görselini belirleyin. (İçerikler alt kategorilere eklenecektir)')
                    ->schema([
                        Grid::make(1)->schema([
                            TextInput::make('name')
                                ->label('Kategori Adı')
                                ->placeholder('Örn: İşitme Cihazları')
                                ->required()
                                ->live(onBlur: true)
                                ->afterStateUpdated(fn (string $operation, $state, $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),
                            
                            TextInput::make('slug')
                                ->label('Sayfa Linki (URL)')
                                ->required()
                                ->unique(ignoreRecord: true)
                                ->prefix('site.com/hizmetler/')
                                ->hint('Otomatik oluşur, çakışma durumunda elle değiştirebilirsiniz.'),
                        ]),
                    ]),

                Section::make('Görsel')
                    ->description('Kategoriye ait temsil edici görseli yükleyin.')
                    ->schema([
                        FileUpload::make('image')
                            ->label('Kategori Görseli')
                            ->disk('public')
                            ->directory('categories')
                            ->image()
                            ->imageEditor()
                            ->panelLayout('integrated')
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
