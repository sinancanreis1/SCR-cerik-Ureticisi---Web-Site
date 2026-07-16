<?php

namespace App\Filament\Widgets;

use App\Models\PageVisit;
use Filament\Widgets\ChartWidget;
use Carbon\Carbon;

class TrafficChartWidget extends ChartWidget
{
    protected ?string $heading = 'Son 7 Günlük Site Trafiği';
    protected static ?int $sort = 4;
    protected int | string | array $columnSpan = 'full';

    public static function canView(): bool
    {
        return auth()->user()?->hasRole('super_admin') ?? false;
    }

    protected function getData(): array
    {
        $data = [];
        $labels = [];

        // Son 7 günü hesapla
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $labels[] = $date->format('d M'); // Örn: 15 Tem
            
            $count = PageVisit::whereDate('created_at', $date)->count();
            $data[] = $count;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Sayfa Görüntülemeleri',
                    'data' => $data,
                    'backgroundColor' => 'rgba(54, 162, 235, 0.2)',
                    'borderColor' => 'rgba(54, 162, 235, 1)',
                    'borderWidth' => 2,
                    'fill' => true,
                    'tension' => 0.3,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
