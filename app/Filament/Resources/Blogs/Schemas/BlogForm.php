<?php

namespace App\Filament\Resources\Blogs\Schemas;

use Filament\Schemas\Schema;

class BlogForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                \Filament\Schemas\Components\Section::make('Blog İçeriği')
                    ->schema([
                        \Filament\Forms\Components\TextInput::make('title')
                            ->label('Başlık')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (string $operation, $state, $set) {
                                if ($operation !== 'create') {
                                    return;
                                }
                                $set('slug', \Illuminate\Support\Str::slug($state));
                            }),
                            
                        \Filament\Forms\Components\TextInput::make('slug')
                            ->label('URL Uzantısı')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                            
                        \Filament\Forms\Components\Textarea::make('excerpt')
                            ->label('Kısa Özet (Ana sayfada görünür)')
                            ->rows(3)
                            ->columnSpanFull(),
                            
                        \Filament\Forms\Components\RichEditor::make('content')
                            ->label('Blog İçeriği')
                            ->required()
                            ->columnSpanFull(),
                            
                        \Filament\Forms\Components\FileUpload::make('image_path')
                            ->label('Kapak Görseli')
                            ->image()
                            ->disk('public')
                            ->directory('blogs')
                            ->columnSpanFull(),
                    ])->columns(2)
            ]);
    }
}
