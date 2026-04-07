<?php
declare(strict_types=1);

namespace App\Data\CartDatas;

use Spatie\LaravelData\Data;
use Illuminate\Support\Number;
use App\Data\CartDatas\CartItemData;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Attributes\Computed;
use Spatie\LaravelData\Attributes\DataCollectionOf;

class CartData extends Data
{
    #[Computed]
    public float $total_price;

    #[Computed]
    public int $total_weight;

    #[Computed]
    public int $total_quantity;

    #[Computed]
    public string $total_formatted_price;

    public function __construct(
        #[DataCollectionOf(CartItemData::class)]
        public DataCollection $items
    ) {
        $items = $items->toCollection();
        $this->total_price = $items->sum(fn(CartItemData $item) => $item->price * $item->quantity);
        $this->total_weight = $items->sum(fn(CartItemData $item) => $item->weight * $item->quantity ?? 0);
        $this->total_quantity = $items->sum(fn(CartItemData $item) => $item->quantity);
        $this->total_formatted_price = Number::currency($this->total_price, locale: 'id');
    }
}
