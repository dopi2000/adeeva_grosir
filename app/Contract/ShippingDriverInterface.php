<?php

declare(strict_types=1);

namespace App\Contract;

use App\Data\CartDatas\CartData;
use App\Data\RegionData\RegionData;
use App\Data\Shipping\ShippingData;
use Spatie\LaravelData\DataCollection;
use App\Data\Shipping\ShippingServiceData;
use App\Data\CustomerAddressData\CustomerAddressData;

interface ShippingDriverInterface {

    /** @return DataCollection<ShippingServiceData> */
    public function getServices() : DataCollection;

    public function getRate(
        RegionData $origin,
        CustomerAddressData $destination,
        CartData $cart,
        ShippingServiceData $shipping_service
    ) : ?ShippingData;
}