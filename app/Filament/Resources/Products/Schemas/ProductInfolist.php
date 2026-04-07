<?php

namespace App\Filament\Resources\Products\Schemas;

use Dom\Text;
use Filament\Infolists\Components\SpatieMediaLibraryImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ProductInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                ->columnSpanFull()
                ->schema([
                    Section::make('Deskripsi Produk')
                    ->schema([
                        TextEntry::make('name')
                        ->label('Merek ')
                        ->inlineLabel(),
                        TextEntry::make('sku')
                        ->label('Kode')
                        ->inlineLabel(),
                        TextEntry::make('type')
                        ->label('Tipe Harga')
                        ->inlineLabel(),
                        TextEntry::make('description')
                        ->label('Deskripsi')
                        ->inlineLabel(),
                        TextEntry::make('stock')
                        ->label('Stok')
                        ->numeric()
                        ->suffix(' pcs')
                        ->inlineLabel(),
                        TextEntry::make('total_terjual')
                        ->inlineLabel()
                        ->suffix(' pcs')
                        ->default(0),
                        TextEntry::make('cost_price')
                        ->label('Harga Dasar')
                        ->money('IDR')
                        ->inlineLabel(),
                        TextEntry::make('price')
                        ->label('Harga Jual')
                        ->money('IDR')
                        ->inlineLabel(),
                        TextEntry::make('weight')
                        ->label('Berat')
                        ->numeric(decimalPlaces:0)
                        ->suffix(' gram')
                        ->inlineLabel(),
                        TextEntry::make('created_at')
                        ->label('Tanggal di Tambahkan')
                        ->inlineLabel()
                        ->dateTime(),
                        TextEntry::make('updated_at')
                        ->label('Tanggal di Perbaharui')
                        ->inlineLabel()
                        ->dateTime(),

                        Fieldset::make('Gambar')
                        ->schema([
                            SpatieMediaLibraryImageEntry::make('cover')
                            ->label('Cover')
                            ->collection('cover')
                            ->simpleLightbox(),
                            SpatieMediaLibraryImageEntry::make('gallery')
                            ->collection('gallery')
                            ->simpleLightbox()
                        ])
                    ])
                ])
            ]);
    }
}
