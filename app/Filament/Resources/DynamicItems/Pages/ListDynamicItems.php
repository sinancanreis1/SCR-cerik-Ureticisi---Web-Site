<?php

namespace App\Filament\Resources\DynamicItems\Pages;

use App\Filament\Resources\DynamicItems\DynamicItemResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDynamicItems extends ListRecords
{
    protected static string $resource = DynamicItemResource::class;

    public function getTitle(): string | \Illuminate\Contracts\Support\Htmlable
    {
        $headerLinkId = request()->query('tableFilters')['header_link_id']['value'] ?? null;
        if ($headerLinkId && $headerLink = \App\Models\HeaderLink::find($headerLinkId)) {
            return $headerLink->label;
        }
        return parent::getTitle();
    }

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make()
                ->url(fn (): string => \App\Filament\Resources\DynamicItems\DynamicItemResource::getUrl('create', [
                    'header_link_id' => request()->query('tableFilters')['header_link_id']['value'] ?? null
                ])),
        ];
    }
}
