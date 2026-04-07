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
use App\Http\Controllers\Api\RajaOngkirApiContoller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

class OnlineShippingDriver implements ShippingDriverInterface {

    public string $driver;

    private static ?array $cachedApiResponse = null;
    private static array $resolvedIds = [];

    public function __construct()
    {
        $this->driver = "online";
        
    }

    /** @return DataCollection<ShippingServiceData> */
    public function getServices() : DataCollection {
        return ShippingServiceData::collect([
            [
                'driver' => $this->driver,
                'code' => 'lion',
                'courier' => 'Lion Parcel',
                'service' => 'BIGPACK',
                'description' => 'Big Package Service'
            ],
            [
                'driver' => $this->driver,
                'code' => 'lion',
                'courier' => 'Lion Parcel',
                'service' => 'BIGPACKFAST',
                'description' => 'Unknown Service'
            ],
            [
                'driver' => $this->driver,
                'code' => 'lion',
                'courier' => 'Lion Parcel',
                'service' => 'JAGOPACK',
                'description' => 'Economy Service'
            ],
            [
                'driver' => $this->driver,
                'code' => 'lion',
                'courier' => 'Lion Parcel',
                'service' => 'REGPACK',
                'description' => 'Regular Service'
            ],
            [
                'driver' => $this->driver,
                'code' => 'lion',
                'courier' => 'Lion Parcel',
                'service' => 'BOSSPACK',
                'description' => 'Priority Service'
            ],
            [
                'driver' => $this->driver,
                'code' => 'jne',
                'courier' => 'Jalur Nugraha Ekakurir (JNE)',
                'service' => 'JTR<130',
                'description' => 'JNE Trucking'
            ],
            [
                'driver' => $this->driver,
                'code' => 'jne',
                'courier' => 'Jalur Nugraha Ekakurir (JNE)',
                'service' => 'CTC',
                'description' => 'JNE City Courier'
            ],
            [
                'driver' => $this->driver,
                'code' => 'jne',
                'courier' => 'Jalur Nugraha Ekakurir (JNE)',
                'service' => 'JTR',
                'description' => 'JNE Trucking'
            ],
            [
                'driver' => $this->driver,
                'code' => 'jne',
                'courier' => 'Jalur Nugraha Ekakurir (JNE)',
                'service' => 'JTR>130',
                'description' => 'JNE Trucking'
            ],
            [
                'driver' => $this->driver,
                'code' => 'jne',
                'courier' => 'Jalur Nugraha Ekakurir (JNE)',
                'service' => 'JTR>200',
                'description' => 'JNE Trucking'
            ],
            [
                'driver' => $this->driver,
                'code' => 'tiki',
                'courier' => 'Citra Van Titipan Kilat (TIKI)',
                'service' => 'DAT',
                'description' => 'Tiki Daun'
            ],
            [
                'driver' => $this->driver,
                'code' => 'tiki',
                'courier' => 'Citra Van Titipan Kilat (TIKI)',
                'service' => 'REG',
                'description' => 'Reguler Service'
            ],
            [
                'driver' => $this->driver,
                'code' => 'tiki',
                'courier' => 'Citra Van Titipan Kilat (TIKI)',
                'service' => 'SRP',
                'description' => 'Tiki Sirip'
            ],
            [
                'driver' => $this->driver,
                'code' => 'tiki',
                'courier' => 'Citra Van Titipan Kilat (TIKI)',
                'service' => 'TRX',
                'description' => 'Tiki Tirex'
            ],
            [
                'driver' => $this->driver,
                'code' => 'jnt',
                'courier' => 'J&T Express',
                'service' => 'EZ',
                'description' => 'Reguler'
            ],
            [
                'driver' => $this->driver,
                'code' => 'pos',
                'courier' => 'POS Indonesia (POS)',
                'service' => 'Pos Reguler',
                'description' => '240'
            ],


        ], DataCollection::class);
    }

    public function getRate(
        RegionData $origin,
        CustomerAddressData $destination,
        CartData $cart,
        ShippingServiceData $shipping_service
    ) : ?ShippingData { 


        $origin_slug = str($origin->village)->slug();
        $destination_slug = str($destination->village)->slug();

        $origin_id = self::$resolvedIds['origin_' . $origin_slug ] ??= Cache::remember("origin_id_" . $origin_slug, Carbon::now()->addWeeks(2), fn() => data_get(RajaOngkirApiContoller::searchDestination($origin->village), '0.id'));

        $destination_id = self::$resolvedIds['destination_'. $origin_slug] ??=  Cache::remember("destination_id_" . $destination_slug, Carbon::now()->addWeeks(2), fn() => data_get(RajaOngkirApiContoller::searchDestination($destination->village), '0.id'));

        if(!$origin_id || !$destination_id) return null; 

        if(self::$cachedApiResponse === null) {
            self::$cachedApiResponse = RajaOngkirApiContoller::checkShippingCost(
                $origin_id, $destination_id, $cart->total_weight
            );
        }

        $shipping = self::$cachedApiResponse;

        if(empty($shipping)) {
            Cache::forget("origin_id_" . $origin_slug);
            Cache::forget('destination_id' . $destination_slug);
            return null;
        }
        
        
        $selectedShipping = collect($shipping)->first(function($item) use ($shipping_service) {
            return $item['code'] === $shipping_service->code &&
                   $item['service'] === $shipping_service->service;
        });

        if(!$selectedShipping) return null;

        return new ShippingData(
            $this->driver, 
            $shipping_service->courier,
            $shipping_service->service,
            (string) data_get($selectedShipping, 'etd', '-'),
            (float) data_get($selectedShipping, 'cost', 0),
            $cart->total_weight,
            $origin,
            $destination,
            $shipping_service->description,
            null
        );
    }
}