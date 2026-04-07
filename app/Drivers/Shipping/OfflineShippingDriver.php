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
                'code' => 'offline_cod',
                'courier' => 'Kurir Toko',
                'service' => 'Cash On Delivery',
                'description' => 'Pengiriman dan pembayaran di tempat. Untuk alamat diluar kota Ternate belum tersedia layanan COD'
            ],
            [
                'driver' => $this->driver,
                'code' => 'offline_pick_up',
                'courier' => 'Kurir Sendiri',
                'service'=> 'Penjemputan di Toko',
                'description' => 'Pesanan bisa langsung jemput ditoko. Untuk lokasi penjemputan di dalam terminal gamalama, samping ruang tunggu.'
            ],
            [
                'driver' => $this->driver,
                'code' => 'offline_antar_ke_pelabuhan',
                'courier' => 'Kurir Toko',
                'service' => 'Pengantaran Ke Pelabuhan',
                'description' => 'Pengantaran ke pelabuhan kapal dan speed boat. Informasi pengiriman akan dikontak melalui WA untuk konfirmasi nomor penitipan barang.'
            ],
            [
                'driver' => $this->driver,
                'code' => 'offline_jastip_ekspedisi',
                'courier' => 'Kurir Toko',
                'service' => 'Pengantaran Ke Jasa Titip atau Ekspedisi Lokal',
                'description' => 'Pengantaran ke jasa titip atau ekspedisi  pengiriman barang atau bisa informasikan ke toko untuk jasa ekspedisi barang yang anda gunakan. '
            ]

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
            case 'offline_cod':
                $data = ShippingData::from([
                    'driver' => $this->driver,
                    'courier' => $shipping_service->courier,
                    'service' => $shipping_service->service,
                    'estimated_delivery' => '1-2 Jam',
                    'cost' => 20000,
                    'weight' => $cart->total_weight,
                    'origin' => $origin,
                    'destination' => $destination,
                    'description' => $shipping_service->description
                ]);
                break;
            case 'offline_pick_up':
                $data = ShippingData::from([
                    'driver' => $this->driver,
                    'courier' => $shipping_service->courier,
                    'service' => $shipping_service->service,
                    'estimated_delivery' => '-',
                    'cost' => 0,
                    'weight' => $cart->total_weight,
                    'origin' => $origin,
                    'destination' => $destination,
                    'description' => $shipping_service->description
                ]);
                break;
            case 'offline_antar_ke_pelabuhan':
                $data = ShippingData::from([
                    'driver' => $this->driver,
                    'courier' => $shipping_service->courier,
                    'service' => $shipping_service->service,
                    'estimated_delivery' => '1-2 Jam',
                    'cost' => 30000,
                    'weight' => $cart->total_weight,
                    'origin' => $origin,
                    'destination' => $destination,
                    'description' => $shipping_service->description
                ]);
                break;
            case 'offline_jastip_ekspedisi':
                $data = ShippingData::from([
                    'driver' => $this->driver,
                    'courier' => $shipping_service->courier,
                    'service' => $shipping_service->service,
                    'estimated_delivery' => '1-2 Jam',
                    'cost' => 25000,
                    'weight' => $cart->total_weight,
                    'origin' => $origin,
                    'destination' => $destination,
                    'description' => $shipping_service->description
                ]);
                break;
            default:
                $data = null;
                break;
        }

        return $data;
    }
}