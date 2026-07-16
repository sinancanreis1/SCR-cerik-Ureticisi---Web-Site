<?php

namespace App\Filament\Resources\DynamicItems\Pages;

use App\Filament\Resources\DynamicItems\DynamicItemResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditDynamicItem extends EditRecord
{
    protected static string $resource = DynamicItemResource::class;

    public function getTitle(): string | \Illuminate\Contracts\Support\Htmlable
    {
        if ($this->record && $this->record->headerLink) {
            return $this->record->headerLink->label . ' Düzenle';
        }
        return parent::getTitle();
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        $headerLinkId = $this->record->header_link_id ?? request()->query('header_link_id');
        return $this->getResource()::getUrl('index', [
            'header_link_id' => $headerLinkId,
            'tableFilters' => ['header_link_id' => ['value' => $headerLinkId]]
        ]);
    }
}
