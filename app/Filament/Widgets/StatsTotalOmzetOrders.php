<?php

namespace App\Filament\Widgets;

use App\Models\SalesOrder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Number;
use Illuminate\Support\Facades\DB;
use App\States\SalesOrder\Completed;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsTotalOmzetOrders extends StatsOverviewWidget
{
    protected ?string $heading = 'Ringkasan Total Pendapatan dan Transaksi ';
    protected ?string $description = 'Info dan Statistik Total Pendapatan dan Transaksi dari Seluruh Penjualan Online Dan Offline';
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
        
        $data = DB::table('sales_orders')->whereBetween('sales_orders.created_at', [$startDate, $endDate])
                ->leftJoin('sales_order_items', 'sales_orders.id', '=', 'sales_order_items.sales_order_id')
                ->leftJoin('products', 'sales_order_items.product_id', '=', 'products.id')
                ->select([
                    DB::raw("COUNT(DISTINCT CASE WHEN sales_orders.status = ? THEN sales_orders.id END) as total_transactions"),
                    DB::raw("COALESCE(SUM(CASE WHEN sales_orders.status = ? THEN sales_order_items.quantity * sales_order_items.price ELSE 0 END),0) as total_revenue"),
                    DB::raw("COALESCE(SUM(CASE WHEN sales_orders.status = ? THEN (sales_order_items.price - products.cost_price) * sales_order_items.quantity ELSE 0 END), 0) as total_profit")
                ])
                ->setBindings([
                    Completed::class,
                    Completed::class,
                    Completed::class,
                ], 'select')
                ->first();
                // dd($data);

        return [
            Stat::make('Jumlah Semua Transaksi', $data->total_transactions . " Transaksi")
            ->description('Jumlah Transaksi dari semua penjualan online dan offline')
            ->descriptionIcon('heroicon-s-credit-card')
            ->chart([7, 2, 10, 3, 15, 4, 17])
            ->color('info'),
            Stat::make('Total Semua Pendapatan', Number::currency($data->total_revenue, locale:'id', precision:0))
            ->description('Total Pendapatan dari semua penjualan online dan offline')
            ->descriptionIcon('heroicon-s-currency-dollar')
            ->chart([7, 2, 10, 3, 15, 4, 17])
            ->color('warning'),
            Stat::make('Total Semua Keuntungan', Number::currency($data->total_profit, locale:'id', precision:0))
            ->description('Total Keuntungan dari semua penjualan online dan offline')
            ->descriptionIcon('heroicon-o-presentation-chart-line')
            ->chart([7, 2, 10, 3, 15, 4, 17])
            ->color('success'),
        ];
    }
}
