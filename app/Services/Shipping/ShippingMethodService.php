<?php

declare(strict_types=1);

namespace App\Services\Shipping;

use App\Data\CartDatas\CartData;
use App\Data\RegionData\RegionData;
use App\Contract\ShippingDriverInterface;
use App\Data\Shipping\ShippingServiceData;
use App\Drivers\Shipping\OfflineShippingDriver;
use App\Data\CustomerAddressData\CustomerAddressData;
use App\Data\Shipping\ShippingData;
use Spatie\LaravelData\DataCollection;

class ShippingMethodService {

    public array $drivers;

    public function __construct() {
        $this->drivers = [
            new OfflineShippingDriver
        ];
    }

    public function getDriver(ShippingServiceData $service) : ShippingDriverInterface
    {
        return collect($this->drivers)
        ->first(fn(ShippingDriverInterface $shipping_driver) => $shipping_driver->driver === $service->driver);
    }

    /** @return DataCollection<ShippingServiceData */
    public function getShippingServices() : DataCollection
    {
        return collect($this->drivers)
        ->flatMap(fn(ShippingDriverInterface $driver) => $driver->getServices()->toCollection())
        ->pipe(fn($items) => ShippingServiceData::collect($items, DataCollection::class));
    }

    /** @return DataCollection<ShippingData> */
    public function getShippingMethods(
        RegionData $origin,
        CustomerAddressData $destination,
        CartData $cart
    ) : DataCollection
    {
      return $this->getShippingServices()
      ->toCollection()->map(function(ShippingServiceData $shipping_service) use ($origin, $destination, $cart) {

        $shipping_data = $this->getDriver($shipping_service)->getRate($origin, $destination, $cart, $shipping_service);

        if($shipping_data === null) {
            return;
        }

        return $shipping_data;

      })
      ->reject(fn($item) => $item === null)
      ->pipe(fn($items) => ShippingData::collect($items, DataCollection::class));
    } 
}