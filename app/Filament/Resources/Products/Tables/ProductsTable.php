<?php

namespace App\Filament\Resources\Products\Tables;

use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('image')
                ->label('Gambar')
                ->collection('cover')
                ->imageWidth(100)
                ->imageHeight(100)
                ->square(),
                TextColumn::make('name')
                ->label('Merek Produk')
                ->sortable()
                ->searchable(),
                TextColumn::make('sku')
                ->label('SKU')
                ->sortable()
                ->searchable(),
                TextColumn::make('type')
                ->label('Tipe Harga')
                ->sortable(),
                TextColumn::make('stock')
                ->label('Stok')
                ->searchable()
                ->sortable(),
                TextColumn::make('price')
                ->label('Harga')
                ->searchable()
                ->sortable()

            ])
            ->filters([
                SelectFilter::make('Filter')
                ->options([
                    'terbaru' => 'Terbaru',
                    'termurah' => 'Termurah',
                    'termahal' => 'Termahal'
                ])
                ->query(function($query, array $data)  {
                        if (! isset($data['value'])) {
                            return;
                        }
                   match($data['value']) {
                        'terbaru' => $query->latest('created_at'),
                        'termurah' => $query->orderBy('price','asc'),
                        'termahal' => $query->orderBy('price','desc'),
                        default => null
                    };
                })
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
                // ViewAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
