<?php

namespace App\Filament\Resources\SalesOrders\Pages;

use App\Filament\Resources\SalesOrders\SalesOrderResource;
use App\States\SalesOrder\Cancel;
use App\States\SalesOrder\Completed;
use App\States\SalesOrder\Pending;
use App\States\SalesOrder\Progress;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListSalesOrders extends ListRecords
{
    protected static string $resource = SalesOrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // CreateAction::make(),
        ];
    }

    public function getTabs() : array {
        $counts = $this->getModel()::query()
        ->selectRaw("
            count(*) as total,
            count(case when status = ? then 1 end) as pending,
            count(case when status = ? then 1 end) as progress,
            count(case when status = ? then 1 end) as cancelled,
            count(case when status = ? then 1 end) as completed
        ", [
            Pending::class,
            Progress::class,
            Cancel::class,
            Completed::class
        ])
        ->first();
        
        return [
            'all' => Tab::make('Semua')
                    ->badge($counts->total)
                    ->icon('heroicon-s-list-bullet'),
            'pending' =>  Tab::make('Pending')
                        ->badgeColor('warning')
                        ->badge($counts->pending)
                        ->badgeIcon('heroicon-o-clock')
                        ->modifyQueryUsing(fn(Builder $query) => $query->where('status', Pending::class)),
            'progress' => Tab::make('Proses')
                        ->badge($counts->progress)
                        ->badgeColor('info')
                        ->badgeIcon('heroicon-o-arrow-path-rounded-square')
                        ->modifyQueryUsing(fn(Builder $query) => $query->where('status', Progress::class)),
            'cancelled' => Tab::make('Batal')
                        ->badge($counts->cancelled)
                        ->badgeColor('danger')
                        ->badgeIcon('heroicon-o-x-circle')
                        ->modifyQueryUsing(fn(Builder $query) => $query->where('status', Cancel::class)),
            'completed' => Tab::make('Selesai')
                        ->badgeColor('success')
                        ->badge($counts->completed)
                        ->badgeIcon('heroicon-o-check-circle')
                        ->modifyQueryUsing(fn(Builder $query) => $query->where('status', Completed::class)),
        ];
    }
}
