<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\ProductBestSellersWidget;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Section;
use App\Filament\Widgets\StatsSalesOrder;
use App\Filament\Widgets\StatsTotalOmzetOrders;
use Filament\Forms\Components\DatePicker;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Pages\Dashboard\Concerns\HasFiltersForm;

class Dashboard extends BaseDashboard
{
    use HasFiltersForm;

    protected static ?string $title = 'Beranda';

    public function getWidgets(): array
    {
        return [
            StatsSalesOrder::class,
            StatsTotalOmzetOrders::class,
            ProductBestSellersWidget::class,
        ];
    }

    public function filtersForm(Schema $schema): Schema
    {
        return $schema
        ->components([
             Section::make()
                    ->label('Filter Tanggal')
                    ->schema([
                        DatePicker::make('startDate')
                            ->label('Dari Tanggal')
                            ->native(false)
                            ->default(now())
                            ->placeholder('Pilih Tanggal')
                            ->displayFormat('d-M-Y')
                            ->disabled(fn (Get $get) => $get('period') !== 'custom')
                            ->dehydrated(fn ($state) => filled($state))
                            ->maxDate(fn (Get $get) => $get('endDate') ?: now()),
                        DatePicker::make('endDate')
                            ->label('Sampai Tanggal')
                            ->native(false)
                            ->default(now())
                            ->placeholder('Pilih Tanggal')
                            ->displayFormat('d-M-Y')
                            ->disabled(fn (Get $get) => $get('period') !== 'custom')
                            ->dehydrated(fn ($state) => filled($state))
                            ->minDate(fn (Get $get) => $get('startDate') ?: now())
                            ->maxDate(now()),
                        Select::make('period')
                        ->label('Rentang Waktu')
                        ->native(false)
                        ->placeholder('Pilih Rentang Waktu')
                        ->options([
                            'today' => 'Penjualan Hari Ini',
                            'yesterday' => 'Penjualan Kemarin',
                            'this_month' => 'Penjualan Bulan Ini',
                            'last_month' => 'Penjualan Bulan Lalu',
                            'this_year' => 'Penjualan Tahun Ini',
                            'custom' => 'Pilih Tanggal Kustom',
                        ])
                        ->default('today')
                        ->afterStateUpdated(function (Set $set, $state) {
                            if ($state !== 'custom') {
                                $set('startDate', null);
                                $set('endDate', null);  
                            } else {
                                $set('startDate', now()->format('Y-m-d'));
                                $set('endDate', now()->format('Y-m-d'));
                            }
                        })
                        ->live(),
                    ])
                    ->columns(3)
                    ->columnSpanFull(),
        ]);
    }

    
}