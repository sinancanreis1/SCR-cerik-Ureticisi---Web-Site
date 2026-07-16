<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Auth\Pages\EditProfile as BaseEditProfile;

class CustomEditProfile extends BaseEditProfile
{
    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('avatar_url')
                    ->label('Profil Resmi')
                    ->image()
                    ->directory('avatars')
                    ->disk('public')
                    ->columnSpanFull(),
                $this->getNameFormComponent()->label('Kullanıcı Adı'),
                $this->getEmailFormComponent()->label('E-posta Adresi'),
                $this->getPasswordFormComponent()->label('Şifre (Değiştirmek isterseniz girin)'),
                $this->getPasswordConfirmationFormComponent()->label('Şifre Tekrar'),
            ]);
    }
}
