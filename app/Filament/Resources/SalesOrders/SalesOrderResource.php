<?php

namespace App\Filament\Resources\SalesOrders;

use BackedEnum;
use App\Models\SalesOrder;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use App\Filament\Resources\SalesOrders\Pages\EditSalesOrder;
use App\Filament\Resources\SalesOrders\Pages\ViewSalesOrder;
use App\Filament\Resources\SalesOrders\Pages\ListSalesOrders;
use App\Filament\Resources\SalesOrders\Pages\CreateSalesOrder;
use App\Filament\Resources\SalesOrders\Schemas\SalesOrderForm;
use App\Filament\Resources\SalesOrders\Tables\SalesOrdersTable;
use App\Filament\Resources\SalesOrders\Schemas\SalesOrderInfolist;
use UnitEnum;

class SalesOrderResource extends Resource
{
    protected static ?string $model = SalesOrder::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::ShoppingBag;

    protected static string|UnitEnum|null $navigationGroup = 'Transaksi Penjualan';

    protected static ?string $recordTitleAttribute = 'trx_id';

    protected static ?string $modelLabel = 'Daftar Pesanan';

    protected static ?string $navigationLabel = 'Pesanan';

    public static function form(Schema $schema): Schema
    {
        return SalesOrderForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return SalesOrderInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SalesOrdersTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSalesOrders::route('/'),
            'view' => ViewSalesOrder::route('/{record}'),
            // 'edit' => EditSalesOrder::route('/{record}/edit'),
            // 'create' => CreateSalesOrder::route('/create'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeTooltip(): ?string
    {
        return 'Total Daftar Item';
    }
}
