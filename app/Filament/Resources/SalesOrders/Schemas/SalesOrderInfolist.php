<?php

namespace App\Filament\Resources\SalesOrders\Schemas;

use App\Models\SalesOrder;
use Filament\Actions\Action;
use Filament\Infolists\Components\ImageEntry;
use Filament\Schemas\Schema;
use Illuminate\Support\Carbon;
use Illuminate\Support\Number;
use Illuminate\Database\Eloquent\Model;
use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\RepeatableEntry;


class SalesOrderInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make("Informasi Umum Pesanan Penjualan")
                ->description("Meta dan Info Pelanggan")
                ->schema([
                    TextEntry::make('trx_id')->label('TRX ID')
                    ->inlineLabel(),
                    TextEntry::make('status')
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
                    })
                    ->label('Status')
                    ->inlineLabel(),
                    TextEntry::make('due_date_at')
                    ->label('Batas Pembayaran')
                    ->inlineLabel()
                    ->formatStateUsing(fn($state) => Carbon::parse($state)->translatedFormat('d F Y - H:i:s')),
                    TextEntry::make('customer_name')
                    ->label('Nama Pelanggan')
                    ->inlineLabel(),
                    TextEntry::make('customer_email')
                    ->label('Email Pelanggan')
                    ->inlineLabel(),
                    TextEntry::make('customer_phone')
                    ->label('Kontak Pelanggan')
                    ->inlineLabel(),
                    TextEntry::make('destination_street_name')
                    ->label("Alamat Tujuan")
                    ->inlineLabel()
                    ->getStateUsing(function (SalesOrder $record) {
                            return sprintf(
                                "%s, %s, %s, %s, %s %s",
                                $record->destination_street_name,
                                $record->destination_village,
                                $record->destination_district,
                                $record->destination_city,
                                $record->destination_province,
                                $record->destination_postal_code
                            );
                        })
                ])->columnSpanFull(),

                Section::make('Detail Metode Pengiriman')
                ->description('Meta dan Info Pengiriman')
                ->columnSpanFull()
                ->schema([
                    TextEntry::make('shipping_receipt_number')
                    ->label('Nomor Resi')
                    ->inlineLabel(),
                    TextEntry::make('shipping_driver')
                    ->label('Vendor')
                    ->formatStateUsing(fn($state) => ucfirst($state))
                    ->inlineLabel(),
                    TextEntry::make('shipping_courier')
                    ->label('Kurir')
                    ->inlineLabel(),
                    TextEntry::make('shipping_service')
                    ->label('Layanan') 
                    ->inlineLabel(),
                    TextEntry::make('shipping_estimated_delivery')
                    ->label('Estimasi Pengiriman')
                    ->inlineLabel(),
                    TextEntry::make('shipping_description')
                    ->label('Deskripsi')
                    ->inlineLabel(),
                    TextEntry::make('shipping_cost')
                    ->label('Biaya Pengiriman')
                    ->inlineLabel()
                    ->formatStateUsing(fn($state) => Number::currency($state, locale:'id', precision:0)),
                    TextEntry::make('shipping_weight')
                    ->label('Berat Barang')
                    ->inlineLabel()
                    ->suffix('gram')

                ]),

                Section::make('Detail Metode Pembayaran')
                ->description('Informasi Metode Pembayaran')
                ->schema([
                    TextEntry::make('payment_driver')
                    ->label('Vendor')
                    ->formatStateUsing(fn($state) => ucfirst($state))
                    ->inlineLabel(),
                    TextEntry::make('payment_label')
                    ->label('Metode Pembayaran')
                    ->inlineLabel(),
                    TextEntry::make('payment_paid_at')
                    ->formatStateUsing(fn($state) => Carbon::parse($state)->translatedFormat('d F Y - H:i:s'))
                    ->label('Waktu Pembayaran')
                    ->inlineLabel(),
                    TextEntry::make('sub_total')
                    ->label('Sub Total')
                    ->inlineLabel()
                    ->formatStateUsing(fn($state) => Number::currency($state, locale:'id', precision:0)),
                    TextEntry::make('total')
                    ->label('Total')
                    ->inlineLabel()
                    ->formatStateUsing(fn($state) => Number::currency($state, locale:'id', precision:0))
                    
                ])->columnSpanFull(),

                Section::make()
                ->columnSpanFull()
                ->collapsed()
                ->description('Daftar Item Pesanan')
                ->schema([
                    RepeatableEntry::make('items')
                    ->columnSpanFull()
                    ->columns(5)
                    ->schema([
                        ImageEntry::make('cover_url')
                        ->label('Gambar')
                        ->square()
                        ->imageSize(50),
                        TextEntry::make('name')
                        ->label('Nama Produk')
                        ->formatStateUsing(fn($state, Model $record) => $state ),
                        TextEntry::make('quantity')
                        ->label('Kuantitas'),
                        TextEntry::make('price')
                        ->label('Harga')
                        ->formatStateUsing(fn($state) => Number::currency($state, locale:'id', precision:0)),
                        TextEntry::make('total')
                        ->label('Total')
                        ->formatStateUsing(fn($state) => Number::currency($state, locale:'id', precision:0))
                    ])
                ])

            ]);
    }
}
