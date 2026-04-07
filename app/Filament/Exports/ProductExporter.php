<?php

namespace App\Filament\Exports;

use App\Models\Product;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Carbon;
use Illuminate\Support\Number;

class ProductExporter extends Exporter
{
    protected static ?string $model = Product::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('name')
            ->label('Merek'),
            ExportColumn::make('sku')
            ->label('SKU'),
            ExportColumn::make('type')
            ->label('Tipe Harga'),
            ExportColumn::make('description')
            ->label('Deskripsi'),
            ExportColumn::make('stock')
            ->label('Stok'),
            ExportColumn::make('total_terjual')
            ->label('Total Terjual'),
            ExportColumn::make('cost_price')
            ->label('Harga Dasar'),
            ExportColumn::make('price')
            ->label('Harga Jual'),
            ExportColumn::make('weight')
            ->label('Berat'),
            ExportColumn::make('created_at')
            ->label('Tanggal Dibuat')
            ->formatStateUsing(fn($state) => Carbon::parse($state)->translatedFormat('d F Y - H:i:s')),
            ExportColumn::make('updated_at')
            ->label('Tanggal di Perbaharui')
            ->formatStateUsing(fn($state) => Carbon::parse($state)->translatedFormat('d F Y - H:i:s')),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your product export has completed and ' . Number::format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
