<?php

namespace App\Filament\Resources\FooterLinkResource\Pages;

use App\Filament\Resources\FooterLinkResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

use Filament\Notifications\Notification;
use App\Models\FooterLink;

class EditFooterLink extends EditRecord
{
    protected static string $resource = FooterLinkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if ($this->record->column !== $data['column']) {
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
        }
        return $data;
    }
}
