<?php

namespace App\Filament\Resources\FooterLinkResource\Pages;

use App\Filament\Resources\FooterLinkResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

use Filament\Notifications\Notification;
use App\Models\FooterLink;

class CreateFooterLink extends CreateRecord
{
    protected static string $resource = FooterLinkResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $count = FooterLink::where('column', $data['column'])->count();
        if ($count >= 8) {
            Notification::make()
                ->warning()
                ->title('Maksimum sınır aşıldı')
                ->body('Bir sütuna en fazla 8 bağlantı ekleyebilirsiniz.')
                ->persistent()
                ->send();
            
            $this->halt();
        }

        return $data;
    }
}
