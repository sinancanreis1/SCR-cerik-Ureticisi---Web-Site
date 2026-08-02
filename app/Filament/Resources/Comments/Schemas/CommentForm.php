<?php

namespace App\Filament\Resources\Comments\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class CommentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->label('Kullanıcı')
                    ->required(),
                TextInput::make('commentable_type')
                    ->label('İçerik Türü')
                    ->disabled()
                    ->required(),
                TextInput::make('commentable_id')
                    ->label('İçerik ID')
                    ->disabled()
                    ->required(),
                Textarea::make('content')
                    ->label('Yorum')
                    ->required()
                    ->columnSpanFull(),
                Toggle::make('is_approved')
                    ->label('Onaylı')
                    ->default(true)
                    ->required(),
            ]);
    }
}
