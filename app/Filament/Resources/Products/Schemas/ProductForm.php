<?php

namespace App\Filament\Resources\Products\Schemas;

use App\Enums\PriceType;
use Illuminate\Support\Str;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Fieldset;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\SpatieTagsInput;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                 Section::make()->schema([
                    Section::make('Masukan Detail Produk')
                    ->schema([
                        TextInput::make('name')
                        ->label('Merek')
                        ->live(onBlur:true)
                        ->afterStateUpdated(fn(Set $set, $state) => $set('slug', Str::slug($state)))
                        ->placeholder('Masukan Merek Produk')
                        ->required()
                        ->minLength(5)
                        ->maxLength(255),

                        TextInput::make('sku')
                        ->label('SKU')
                        ->placeholder('Masukan SKU Produk')
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->minLength(5)
                        ->maxLength(255),

                        TextInput::make('slug')
                        ->label('Slug')
                        ->placeholder('Masukan Slug Produk')
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->minLength(5)
                        ->maxLength(255),

                        SpatieTagsInput::make('tags')
                        ->type('collection')
                        ->label('Kategori'),

                        Select::make('type')
                        ->required()
                        ->label('Tipe Harga')
                        ->options([
                            'Lusin' => 'Lusin',
                            'Kodi' => 'Kodi',
                            'Pcs' => 'Pcs'
                        ])
                        ->native(false),

                        TextInput::make('stock')
                        ->required()
                        ->label('Stok')
                        ->placeholder('Masukan Stock Produk')
                        ->integer()
                        ->minValue(0),

                        TextInput::make('cost_price')
                        ->label('Harga Dasar')
                        ->required()
                        ->placeholder('Masukan Harga Dasar Produk')
                        ->numeric()
                        ->prefix('Rp.')
                        ->minValue(0),

                        TextInput::make('price')
                        ->required()
                        ->label('Harga Jual')
                        ->placeholder('Masukan Harga Produk')
                        ->numeric()
                        ->prefix('Rp.')
                        ->minValue(0),

                        TextInput::make('weight')
                        ->label('Berat')
                        ->numeric()
                        ->placeholder('Masukan Berat Produk')
                        ->suffix('Gram')
                        ->required()
                        ->minValue(0),
                        
                        MarkdownEditor::make('description')
                        ->label('Deskripsi')
                        ->nullable(),

                        Fieldset::make('Masukan Gambar Produk')
                        ->schema([
                            SpatieMediaLibraryFileUpload::make('cover')
                            ->collection('cover'),

                            SpatieMediaLibraryFileUpload::make('gallery')
                            ->collection('gallery')
                            ->multiple(),
                                ]) // filed
                        ]), // section dua
                            
                    ]) // section satu
                    ->columnSpanFull()
            ]);
    }
}
