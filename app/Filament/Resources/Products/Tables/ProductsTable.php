<?php

namespace App\Filament\Resources\Products\Tables;

use Filament\Tables\Table;
use Illuminate\Support\Number;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\ActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\ExportAction;
use Filament\Actions\ImportAction;
use Filament\Tables\Filters\Filter;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use App\Filament\Exports\ProductExporter;
use App\Filament\Imports\ProductImporter;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
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
                ->square()
                ->simpleLightbox(),
                TextColumn::make('name')
                ->label('Merek Produk')
                ->limit(15)
                ->tooltip(fn(TextColumn $column) => $column->getState())
                ->sortable()
                ->searchable()
                ->copyable()
                ->copyMessage('Nama merek berhasil disalin')
                ->copyMessageDuration(1500),
                TextColumn::make('sku')
                ->label('SKU')
                ->sortable()
                ->searchable(),
                TextColumn::make('type')
                ->label('Tipe Harga')
                ->sortable()
                ->toggleable(isToggledHiddenByDefault:true),
                TextColumn::make('stock')
                ->label('Stok')
                ->searchable()
                ->sortable()
                ->suffix(' pcs'),
                TextColumn::make('total_terjual')
                ->label('Total Terjual')
                ->suffix(' pcs')
                ->default(0)
                ->sortable()
                ->toggleable(isToggledHiddenByDefault:true),
                TextColumn::make('cost_price')
                ->label('Harga Dasar')
                ->money(currency:'IDR', decimalPlaces:0)
                ->toggleable(isToggledHiddenByDefault:true)
                ->sortable(),
                TextColumn::make('price')
                ->money(currency:'IDR', decimalPlaces:0)
                ->label('Harga Jual')
                ->searchable()
                ->sortable()

            ])
            ->filters([
                SelectFilter::make('Filter')
                ->options([
                    'terbaru' => 'Terbaru',
                    'termurah' => 'Termurah',
                    'termahal' => 'Termahal',
                    'terlaris' => 'Terlaris'
                ])
                ->query(function($query, array $data)  {
                        if (! isset($data['value'])) {
                            return;
                        }
                   match($data['value']) {
                        'terbaru' => $query->latest('created_at'),
                        'termurah' => $query->orderBy('price','asc'),
                        'termahal' => $query->orderBy('price','desc'),
                        'terlaris' => $query->orderByDesc('total_terjual'),
                        default => null
                    };
                })
                ->native(false),
                Filter::make('created_at')
                    ->schema([
                        DatePicker::make('created_from')
                        ->label('Tanggal Awal'),
                        DatePicker::make('created_until')
                        ->label('Tanggal Akhir'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })
            ])
            ->recordActions([
                ActionGroup::make([
                    EditAction::make(),
                    DeleteAction::make(),
                    ViewAction::make(),
                ])
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ]),
            ])
            ->headerActions([
                ExportAction::make()
                ->label('Unduh Data')
                ->icon('heroicon-s-document-arrow-down')
                ->exporter(ProductExporter::class)
                ->color('success'),
                ImportAction::make()
                ->label('Unggah Data')
                ->color('info')
                ->icon('heroicon-s-document-arrow-up')
                ->importer(ProductImporter::class),
                CreateAction::make()
                ->icon('heroicon-s-plus')
                ->color('gray')
            ]);
    }
}
