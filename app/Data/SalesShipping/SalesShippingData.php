<?php

namespace App\Data\SalesShipping;

use Spatie\LaravelData\Data;

class SalesShippingData extends Data
{
    public function __construct(
        public string $driver,
        public string|null $receipt_number,
        public string $courier,
        public string $service,
        public string $estimated_delivery,
        public string $description,
        public float $cost,
        public int $weight,

    ) {}
}
