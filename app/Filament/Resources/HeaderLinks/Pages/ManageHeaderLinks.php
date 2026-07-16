<?php

namespace App\Filament\Resources\HeaderLinks\Pages;

use App\Filament\Resources\HeaderLinks\HeaderLinkResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageHeaderLinks extends ManageRecords
{
    protected static string $resource = HeaderLinkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Yeni Bağlantı Ekle')
                ->icon('heroicon-o-plus'),
        ];
    }
}
