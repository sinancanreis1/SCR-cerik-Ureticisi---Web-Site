<?php

namespace App\Filament\Resources\DynamicItems\Pages;

use App\Filament\Resources\DynamicItems\DynamicItemResource;
use Filament\Resources\Pages\CreateRecord;

class CreateDynamicItem extends CreateRecord
{
    protected static string $resource = DynamicItemResource::class;

    public function getTitle(): string | \Illuminate\Contracts\Support\Htmlable
    {
        $headerLinkId = request()->query('header_link_id');
        if ($headerLinkId && $headerLink = \App\Models\HeaderLink::find($headerLinkId)) {
            return $headerLink->label . ' Ekle';
        }
        return parent::getTitle();
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
