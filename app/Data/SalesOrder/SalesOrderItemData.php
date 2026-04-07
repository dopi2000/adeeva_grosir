<?php

namespace App\Data\SalesOrder;

use Spatie\LaravelData\Data;
use Illuminate\Support\Number;
use Spatie\LaravelData\Attributes\Computed;

class SalesOrderItemData extends Data
{
    #[Computed]
    public string $price_formatted;

    #[Computed]
    public string $total_formatted;

    public function __construct(
        public string $name,
        public string $short_desc,
        public string $sku,
        public string $slug,
        public string|null $description,
        public string $cover_url,
        public int $quantity,
        public float $price,
        public float $total,
        public int $weight
    ) {
        $this->price_formatted = Number::currency($price, locale:'id', precision:0);
        $this->total_formatted = Number::currency($total, locale:'id', precision:0);
    }
}
