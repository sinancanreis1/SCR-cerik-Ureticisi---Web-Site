<?php

namespace App\Filament\Resources\BlogApproval\Pages;

use App\Filament\Resources\BlogApproval\BlogApprovalResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListBlogApprovals extends ListRecords
{
    protected static string $resource = BlogApprovalResource::class;

    protected function getHeaderActions(): array
    {
        return []; // Users submit from frontend, admin only approves
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('Tümü')
                ->icon('heroicon-m-list-bullet'),
            'pending' => Tab::make('Onay Bekleyenler')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('is_active', false))
                ->icon('heroicon-m-clock')
                ->badge(fn () => $this->getModel()::whereNotNull('user_id')
                    ->whereHas('user', function ($query) {
                        $query->whereDoesntHave('roles', function ($qr) {
                            $qr->whereIn('name', ['admin', 'super_admin']);
                        });
                    })
                    ->where('is_active', false)
                    ->count()
                )
                ->badgeColor('warning'),
            'approved' => Tab::make('Onaylananlar')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('is_active', true))
                ->icon('heroicon-m-check-circle')
                ->badge(fn () => $this->getModel()::whereNotNull('user_id')
                    ->whereHas('user', function ($query) {
                        $query->whereDoesntHave('roles', function ($qr) {
                            $qr->whereIn('name', ['admin', 'super_admin']);
                        });
                    })
                    ->where('is_active', true)
                    ->count()
                )
                ->badgeColor('success'),
        ];
    }
}
