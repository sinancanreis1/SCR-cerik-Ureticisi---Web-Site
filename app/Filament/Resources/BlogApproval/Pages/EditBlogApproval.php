<?php

namespace App\Filament\Resources\BlogApproval\Pages;

use App\Filament\Resources\BlogApproval\BlogApprovalResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditBlogApproval extends EditRecord
{
    protected static string $resource = BlogApprovalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
