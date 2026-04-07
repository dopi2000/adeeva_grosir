<?php

namespace App\Filament\Resources\SalesOrders\Pages;

use App\Data\SalesOrder\SalesOrderData;
use App\Filament\Resources\SalesOrders\SalesOrderResource;
use App\Services\Order\SalesOrderService;
use App\States\SalesOrder\Completed;
use App\States\SalesOrder\Pending;
use App\States\SalesOrder\Progress;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\ViewRecord;

class ViewSalesOrder extends ViewRecord
{
    protected static string $resource = SalesOrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // EditAction::make(),
            Action::make('Proses Pesanan')
            ->icon('heroicon-s-arrow-path-rounded-square')
            ->modalWidth('sm')
            ->visible(fn() => in_array(get_class($this->record->status), [
                Pending::class, 
                Progress::class
            ]))
            ->schema(function() {

              $transition = $this->record->status->transitionableStates();
              $options = collect($transition)->mapWithKeys(fn($class) => [
                $class => (new $class($this->record))->label()
              ])->toArray(); 

              return [
                Radio::make('status')
                ->label('Status')
                ->options($options)
                ->required()
                ->inline()
              ];

            })->action(function(array $data) {
                $this->record->status->transitionTo(data_get($data, 'status'));
            }),

            Action::make('Input Resi Pengiriman')
            ->icon('heroicon-s-truck')
            ->modalWidth('sm')
            ->modalHeading('Input Nomor Resi')
            ->visible(function() {
              $status = get_class($this->record->status);

              $valid_status = [
                Progress::class,
                Completed::class
              ];

              return in_array($status, $valid_status) && empty($this->record->shipping_receipt_number);
            })->schema([
              TextInput::make('shipping_receipt_number')
              ->label('Nomor Resi')
              ->required()
            ])->action(function(array $data) {
              app(SalesOrderService::class)->updatedShippingReceiptNumber(
                SalesOrderData::fromModel($this->record),
                data_get($data, 'shipping_receipt_number')
              );
            })
        ];
    }
}
