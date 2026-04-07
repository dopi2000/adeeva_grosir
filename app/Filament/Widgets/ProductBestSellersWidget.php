<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Filament\Actions\BulkActionGroup;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;

class ProductBestSellersWidget extends TableWidget
{
    protected static ?string $heading = 'Produk Terlaris';

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(fn (): Builder => Product::query()->soldItem()->orderBy('total_terjual', 'desc'))
            ->defaultPaginationPageOption(5)
            ->columns([
                SpatieMediaLibraryImageColumn::make('image')
                ->label('Gambar')
                ->collection('cover')
                ->imageWidth(50)
                ->imageHeight(50)
                ->square()
                ->simpleLightbox(),
                TextColumn::make('name')
                ->label('Merek')
                ->limit(15)
                ->tooltip(fn(TextColumn $column) => $column->getState())
                ->sortable()
                ->searchable()
                ->copyable()
                ->copyMessage('Nama merek berhasil disalin')
                ->copyMessageDuration(1500),
                TextColumn::make('total_terjual')
                ->label('Total Terjual')
                ->suffix(' pcs')
                ->default(0)
                ->sortable(),
                TextColumn::make('stock')
                ->label('Stok')
                ->suffix(' pcs')

            ])
            ->filters([
                //
            ])
            ->headerActions([
                //
            ])
            ->recordActions([
                //
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    //
                ]),
            ]);
    }
}
