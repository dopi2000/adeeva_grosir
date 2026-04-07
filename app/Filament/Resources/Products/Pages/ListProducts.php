<?php

namespace App\Filament\Resources\Products\Pages;

use App\Filament\Resources\Products\ProductResource;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListProducts extends ListRecords
{
    protected static string $resource = ProductResource::class;

    // protected function getHeaderActions(): array
    // {
    //     return [
    //         CreateAction::make()
    //         ->icon('heroicon-s-plus'),
    //     ];
    // }

    public function getTabs(): array
    {
        return [
            'all_stock' => Tab::make('Semua Stok')
                        ->badge($this->getModel()::all()->count()),
            'available_stock' => Tab::make('Stok Banyak')
                     ->modifyQueryUsing(fn(Builder $query) => $query->where('stock', '>', 12))
                     ->badge($this->getModel()::where('stock', '>', 18)->count())
                     ->badgeColor('info')
                     ->badgeIcon('heroicon-s-information-circle'),
            'stock_is_running_low' => Tab::make('Stok Menipis')
                     ->modifyQueryUsing(fn(Builder $query) => $query->whereBetween('stock', [1,12]))
                     ->badge($this->getModel()::whereBetween('stock', [1,12])->count())
                     ->badgeColor('warning')
                     ->badgeIcon('heroicon-s-exclamation-triangle'),
            'out_of_stock' => Tab::make('Stok Habis')
                     ->modifyQueryUsing(fn(Builder $query) => $query->where('stock', '=', 0))
                     ->badge($this->getModel()::where('stock', '<=', 0)->count())
                     ->BadgeColor('danger')
                     ->badgeIcon('heroicon-s-x-circle'),
        ];
    }
}
