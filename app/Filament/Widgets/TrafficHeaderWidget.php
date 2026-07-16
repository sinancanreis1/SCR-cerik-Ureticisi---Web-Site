<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class TrafficHeaderWidget extends Widget
{
    protected static ?int $sort = 2;
    protected int | string | array $columnSpan = 'full';
    protected string $view = 'filament.widgets.traffic-header-widget';

    public static function canView(): bool
    {
        return auth()->user()?->hasRole('super_admin') ?? false;
    }
}
