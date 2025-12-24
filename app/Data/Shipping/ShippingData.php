<?php

namespace App\Data\Shipping;

use Spatie\LaravelData\Data;
use Illuminate\Support\Number;
use App\Data\RegionData\RegionData;
use Spatie\LaravelData\Attributes\Computed;
use App\Data\CustomerAddressData\CustomerAddressData;

class ShippingData extends Data
{

    #[Computed]
    public string $label;

    #[Computed]
    public string $cost_formatted;

    #[Computed]
    public string $hash;

    public function __construct(
        public string $driver,
        public string $courier,
        public string $service,
        public string $estimated_delivery,
        public float $cost,
        public int $weight,
        public RegionData $origin,
        public CustomerAddressData $destination,
        public string|null $logo_url
    ) {
        $this->cost_formatted = Number::currency($cost, locale: 'id', precision: 0);
        $courier_label = ucfirst($courier);
        $this->label = "$courier_label ($estimated_delivery)";
        $this->hash = md5("$origin->code-$destination->postal_code-$driver-$courier-$service-$estimated_delivery-$cost");
    }
}
