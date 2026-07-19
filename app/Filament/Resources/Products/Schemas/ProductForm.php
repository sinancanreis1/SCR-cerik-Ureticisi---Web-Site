<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Schemas\Components\Section::make('Ürün Detayları')
                    ->description('Sitede sergilenecek ürünün temel bilgileri.')
                    ->icon('heroicon-o-information-circle')
                    ->schema([
                        \Filament\Forms\Components\TextInput::make('title')
                            ->label('Ürün Adı')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (string $operation, $state, $set) {
                                if ($operation !== 'create') {
                                    return;
                                }
                                $set('slug', \Illuminate\Support\Str::slug($state));
                            }),
                            
                        \Filament\Forms\Components\Select::make('category')
                            ->label('Kategori')
                            ->options(\App\Models\Category::pluck('name', 'name'))
                            ->searchable()
                            ->required(),
                            
                        \Filament\Forms\Components\TextInput::make('slug')
                            ->label('URL Bağlantısı')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                            
                        \Filament\Forms\Components\TextInput::make('subtitle')
                            ->label('Alt Başlık')
                            ->maxLength(255),
                            
                        \Filament\Forms\Components\TextInput::make('icon')
                            ->label('İkon Sınıfı (Örn: ri-ear-line)')
                            ->maxLength(255),
                            
                        \Filament\Forms\Components\Textarea::make('desc')
                            ->label('Kısa Açıklama')
                            ->rows(3)
                            ->columnSpanFull(),
                            
                        \Filament\Forms\Components\RichEditor::make('long_desc')
                            ->label('Detaylı Açıklama')
                            ->columnSpanFull(),
                    ])->columns(2),
                    
                \Filament\Schemas\Components\Section::make('Görsel & Özellikler')
                    ->icon('heroicon-o-photo')
                    ->schema([
                        \Filament\Forms\Components\FileUpload::make('image')
                            ->label('Ürün Görseli')
                            ->image()
                            ->disk('public')
                            ->directory('products')
                            ->columnSpanFull(),
                            
                        \Filament\Forms\Components\Repeater::make('features')
                            ->label('Öne Çıkan Özellikler')
                            ->simple(
                                \Filament\Forms\Components\TextInput::make('feature')->required(),
                            )
                            ->addActionLabel('Yeni Özellik Ekle')
                            ->columnSpanFull(),
                    ])
            ]);
    }
}
