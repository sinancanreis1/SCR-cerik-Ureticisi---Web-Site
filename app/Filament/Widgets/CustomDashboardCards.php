<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class CustomDashboardCards extends Widget
{
    protected string $view = 'filament.widgets.custom-dashboard-cards';
    protected int | string | array $columnSpan = 'full';
    protected static ?int $sort = 1;
}
