<?php

namespace App\Filament\Widgets;

use App\Models\PageVisit;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\DB;

class PageVisitsTableWidget extends BaseWidget
{
    protected static ?int $sort = 5;
    protected int | string | array $columnSpan = 'full';
    protected static ?string $heading = 'Sayfa Bazlı Tıklamalar (Hangi Sayfa Kaç Kez Gezildi?)';

    public static function canView(): bool
    {
        return auth()->user()?->hasRole('super_admin') ?? false;
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(
                PageVisit::query()
                    ->select('url', DB::raw('count(*) as visit_count'), DB::raw('MAX(id) as id'))
                    ->groupBy('url')
            )
            ->columns([
                Tables\Columns\TextColumn::make('url')
                    ->label('Sayfa (URL)')
                    ->searchable()
                    ->sortable()
                    ->formatStateUsing(fn (string $state): string => $state === '/' ? 'Ana Sayfa (/)' : '/' . ltrim($state, '/')),
                    
                Tables\Columns\TextColumn::make('visit_count')
                    ->label('Toplam Tıklama')
                    ->sortable()
                    ->badge()
                    ->color('primary'),
            ])
            ->defaultSort('visit_count', 'desc');
    }
}
