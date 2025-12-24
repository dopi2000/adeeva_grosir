<?php

declare(strict_types=1);

namespace App\Drivers\Shipping;

use App\Data\CartDatas\CartData;
use App\Data\RegionData\RegionData;
use App\Data\Shipping\ShippingData;
use Spatie\LaravelData\DataCollection;
use App\Contract\ShippingDriverInterface;
use App\Data\Shipping\ShippingServiceData;
use App\Data\CustomerAddressData\CustomerAddressData;

class OfflineShippingDriver implements ShippingDriverInterface {

    public string $driver;

    public function __construct()
    {
        $this->driver = "offline";
    }

    /** @return DataCollection<ShippingServiceData> */
    public function getServices() : DataCollection {
        return ShippingServiceData::collect([
            [
                'driver' => $this->driver,
                'code' => 'offline-0',
                'courier' => 'Kurir Toko',
                'service' => 'Instant'
            ],
            [
                'driver' => $this->driver,
                'code' => 'offline-1',
                'courier' => 'Kurir Sendiri',
                'service'=> 'SameDay'
            ],
        ], DataCollection::class);
    }

    public function getRate(
        RegionData $origin,
        CustomerAddressData $destination,
        CartData $cart,
        ShippingServiceData $shipping_service
    ) : ?ShippingData {

        $data = null;
        
        switch ($shipping_service->code) {
            case 'offline-0':
                $data = ShippingData::from([
                    'driver' => $this->driver,
                    'courier' => $shipping_service->courier,
                    'service' => $shipping_service->service,
                    'estimated_delivery' => '1-2 Hari',
                    'cost' => 50000,
                    'weight' => $cart->total_weigt,
                    'origin' => $origin,
                    'destination' => $destination
                ]);
                break;
            case 'offline-1':
                $data = ShippingData::from([
                    'driver' => $this->driver,
                    'courier' => $shipping_service->courier,
                    'service' => $shipping_service->service,
                    'estimated_delivery' => '1-2 Hari',
                    'cost' => 0,
                    'weight' => $cart->total_weigt,
                    'origin' => $origin,
                    'destination' => $destination
                ]);
                break;
            
            default:
                $data = null;
                break;
        }

        return $data;
    }
}