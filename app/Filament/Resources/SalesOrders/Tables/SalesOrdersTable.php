<?php

namespace App\Filament\Resources\SalesOrders\Tables;

use App\Models\SalesOrder;
use Carbon\Carbon;
use Filament\Tables\Table;
use Illuminate\Support\Number;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Filters\Filter;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;

class SalesOrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('trx_id')->label('TRX ID')
                ->searchable(),
                TextColumn::make('customer_name')->label('Nama Pelanggan')
                ->searchable(),
                TextColumn::make('status')
                ->formatStateUsing(fn($state) => $state->label())
                ->badge()
                ->color(fn ($state): string => match ($state->label()) {
                    'Selesai', 'selesai' => 'success',
                    'Menunggu Pembayaran' => 'warning',
                    'Proses', 'proses' => 'info',
                    'Batal', 'batal' => 'danger',
                    default => 'gray',
                })
                ->icon(fn ($state): string => match ($state->label()) {
                   'Selesai', 'selesai' => 'heroicon-s-check-circle',
                    'Menunggu Pembayaran', 'menunggu-pembayaran' => 'heroicon-s-clock',
                    'Proses', 'proses' => 'heroicon-s-arrow-path',
                   'Batal', 'batal' => 'heroicon-s-x-circle',
                    default => 'heroicon-m-question-mark-circle',
                }),
                TextColumn::make('created_at')
                ->label('Tanggal Pembelian')
                ->formatStateUsing(fn($state) => Carbon::parse($state)->translatedFormat('d M Y H:i:s')),
                TextColumn::make('total')
                ->formatStateUsing(fn($state) => Number::currency($state, locale:'id', precision:0)),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('status')
                ->label('Status Pesanan')
                ->options(function () {
                    $states = SalesOrder::getStatesFor('status');
                    
                    
                    $options = [];
                    foreach ($states as $stateClass) {
                        try {
                            $instance = new $stateClass(null, new SalesOrder());
                            $options[$stateClass] = $instance->label();
                        } catch (\Exception $e) {
                            $options[$stateClass] = class_basename($stateClass);
                        }
                    }
                    
                    return $options;
                })
            ])
            ->recordActions([
                    ViewAction::make(),
                    // EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
