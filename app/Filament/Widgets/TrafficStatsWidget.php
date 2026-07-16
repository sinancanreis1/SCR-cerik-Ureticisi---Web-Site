<?php

namespace App\Filament\Widgets;

use App\Models\PageVisit;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Carbon\Carbon;

class TrafficStatsWidget extends BaseWidget
{
    protected static ?int $sort = 3;
    protected int | string | array $columnSpan = 'full';
    protected ?string $pollingInterval = '30s';

    public static function canView(): bool
    {
        return auth()->user()?->hasRole('super_admin') ?? false;
    }

    protected function getStats(): array
    {
        $todayVisits = PageVisit::whereDate('created_at', Carbon::today())->count();
        $weekVisits = PageVisit::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
        $totalVisits = PageVisit::count();

        // Benzersiz (Unique) ziyaretçiler (IP bazlı)
        $todayUnique = PageVisit::whereDate('created_at', Carbon::today())->distinct('ip_address')->count('ip_address');

        return [
            Stat::make('Bugünkü Toplam Tıklama', $todayVisits)
                ->description('Tekil Ziyaretçi: ' . $todayUnique)
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),
            
            Stat::make('Bu Haftaki Tıklama', $weekVisits)
                ->description('Bu haftanın toplam organik trafiği')
                ->descriptionIcon('heroicon-m-calendar-days')
                ->color('info'),
                
            Stat::make('Toplam Ziyaret (Tüm Zamanlar)', $totalVisits)
                ->description('Sitenin açılışından beri')
                ->descriptionIcon('heroicon-m-globe-alt')
                ->color('primary'),
        ];
    }
}
