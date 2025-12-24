<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\SpatieTagsInput;
use Filament\Schemas\Components\Section;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()->schema([
                    SpatieMediaLibraryFileUpload::make('cover')
                    ->collection('cover'),

                    SpatieMediaLibraryFileUpload::make('gallery')
                    ->collection('gallery')
                    ->multiple(),

                    TextInput::make('name')
                    ->label('Merek')
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
                    ->label('Tipe')
                    ->options([
                        'Lusin' => 'Lusin',
                        'Kodi' => 'Kodi',
                        'Pcs' => 'Pcs'
                    ]),

                    TextInput::make('stock')
                    ->required()
                    ->label('Stok')
                    ->placeholder('Masukan Stock Produk')
                    ->integer(),

                    TextInput::make('price')
                    ->required()
                    ->label('Harga')
                    ->placeholder('Masukan Harga Produk')
                    ->numeric()
                    ->prefix('Rp.'),

                    TextInput::make('weight')
                    ->label('Berat')
                    ->numeric()
                    ->default(0)
                    ->placeholder('Masukan Berat Produk')
                    ->suffix('Kg')
                    ->required(),
                    
                    MarkdownEditor::make('description')
                    ->label('Deskripsi')
                    ->nullable()
                    ])
                    ->columns(1)
                    ->maxWidth('4xl')
                    ->columnSpanFull()
            ]);
    }
}
