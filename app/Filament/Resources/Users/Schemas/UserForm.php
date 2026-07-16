<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('avatar_url')
                    ->label('Profil Resmi')
                    ->image()
                    ->directory('avatars')
                    ->disk('public')
                    ->columnSpanFull(),
                TextInput::make('name')
                    ->label('Kullanıcı Adı')
                    ->required(),
                TextInput::make('first_name')
                    ->label('İsim'),
                TextInput::make('last_name')
                    ->label('Soyisim'),
                TextInput::make('title')
                    ->label('Ünvan'),
                TextInput::make('email')
                    ->label('E-posta Adresi')
                    ->email()
                    ->unique(ignoreRecord: true)
                    ->required(),
                TextInput::make('password')
                    ->label('Şifre')
                    ->password()
                    ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                    ->dehydrated(fn ($state) => filled($state))
                    ->required(fn (string $operation): bool => $operation === 'create'),
                Select::make('roles')
                    ->label('Yetkiler (Roller)')
                    ->relationship('roles', 'name', fn ($query) => $query->where('name', '!=', 'super_admin'))
                    ->multiple()
                    ->preload()
                    ->searchable()
                    ->columnSpanFull(),
                Textarea::make('description')
                    ->label('Hakkında / Açıklama')
                    ->rows(3)
                    ->columnSpanFull(),
            ]);
    }
}
