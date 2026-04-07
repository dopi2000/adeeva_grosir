<?php

namespace App\Data\Checkout;

use App\Data\CartDatas\CartData;
use App\Data\Customer\CustomerData;
use App\Data\CustomerAddressData\CustomerAddressData;
use App\Data\Payment\PaymentData;
use App\Data\RegionData\RegionData;
use App\Data\Shipping\ShippingData;
use Spatie\LaravelData\Attributes\Computed;
use Spatie\LaravelData\Data;

class CheckoutData extends Data
{

    #[Computed]
    public float $sub_total;

    #[Computed]
    public float $shipping_cost;

    #[Computed]
    public float $grand_total;

    public function __construct(
        public CustomerData $customer,
        public RegionData $origin,
        public CustomerAddressData $destination,
        public CartData $cart,
        public ShippingData $shipping,
        public PaymentData $payment,

    ) {
        $this->sub_total = $cart->total_price;
        $this->shipping_cost = $shipping->cost;
        $this->grand_total = $this->sub_total + $this->shipping_cost;
    }
}
