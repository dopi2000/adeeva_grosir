<?php

namespace App\Filament\Widgets;

use App\Models\SalesOrder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Number;
use App\States\SalesOrder\Pending;
use App\States\SalesOrder\Progress;
use App\States\SalesOrder\Completed;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\Concerns\InteractsWithPageFilters;

class StatsSalesOrder extends StatsOverviewWidget
{
     use InteractsWithPageFilters;
    // protected static ?string $pollingInterval = '15s';

    protected static ?int $sort = -2;
    protected ?string $heading = 'Ringkasan Penjualan Online';
    protected ?string $description = 'Info dan Statistik dari Penjualan dan Transaksi Via Online';
    protected ?string $pollingInterval = '3600s';

    protected function getStats(): array
    {
        $period = $this->pageFilters['period'] ?? 'today';
        $startDate = now()->startOfDay();
        $endDate = now()->endOfDay();

        match ($period) {
            'today' => [
                $startDate = now()->startOfDay(),
                $endDate = now()->endOfDay(),
            ],
            'yesterday' => [
                $startDate = now()->subDay()->startOfDay(),
                $endDate = now()->subDay()->endOfDay(),
            ],
            'this_month' => [
                $startDate = now()->startOfMonth(),
                $endDate = now()->endOfMonth(),
            ],
            'last_month' => [
                $startDate = now()->subMonth()->startOfMonth(),
                $endDate = now()->subMonth()->endOfMonth(),
            ],
            'this_year' => [
                $startDate = now()->startOfYear(),
                $endDate = now()->endOfYear(),
            ],
            'custom' => [
                $startDate = ! is_null($this->pageFilters['startDate'] ?? null) ? Carbon::parse($this->pageFilters['startDate']) :now()->startOfDay(),
                $endDate = ! is_null($this->pageFilters['endDate'] ?? null) ? Carbon::parse($this->pageFilters['endDate']) : now()->endOfDay()
            ],
            default => [
                $startDate = now()->startOfDay(),
                $endDate = now()->endOfDay(),
            ],
        };
    
        $data = SalesOrder::query()
                ->whereBetween('created_at', [$startDate, $endDate])
                ->selectRaw("
                COUNT(CASE WHEN status = ? THEN 1 END) as pending,
                COUNT(CASE WHEN status = ? THEN 1 END) as progress,
                COUNT(CASE WHEN status = ? THEN 1 END) as completed,
                SUM(CASE WHEN status = ? THEN sub_total ELSE 0 END) as revenue
            ", [
                Pending::class, 
                Progress::class, 
                Completed::class,
                Completed::class
            ])
            ->first();
        return [
            Stat::make('Status Pending', $data->pending . " Transaksi")
                    ->description('Status pesanan sedang pending')
                    ->descriptionIcon('heroicon-s-clock')
                    ->color('warning'),
            Stat::make('Status Proses', $data->progress . " Transaksi")
                    ->description('Status pesanan sedang diproses')
                    ->descriptionIcon('heroicon-s-arrow-path')
                    ->color('info'),
            Stat::make('Status Selesai', $data->completed . " Transaksi")
                    ->description('Status pesanan sudah selesai')
                    ->descriptionIcon('heroicon-s-check-badge')
                    ->color('success'),
            Stat::make('Total Penjualan Online', Number::currency($data->revenue ?? 0, locale:'id', precision:0))
                    ->description('Total pendapatan dari penjualan online')
                    ->descriptionIcon('heroicon-s-arrow-trending-up')
                    ->color('success')
        ];
    }

}
