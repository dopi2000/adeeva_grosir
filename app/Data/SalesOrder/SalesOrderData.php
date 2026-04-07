<?php

namespace App\Data\SalesOrder;

use App\Models\SalesOrder;
use Spatie\LaravelData\Data;
use Illuminate\Support\Carbon;
use Illuminate\Support\Number;
use App\Data\Customer\CustomerData;
use App\Data\RegionData\RegionData;
use Spatie\LaravelData\DataCollection;
use App\Data\SalesOrder\SalesOrderItemData;
use App\Data\SalesPayment\SalesPaymentData;
use Spatie\LaravelData\Attributes\Computed;
use App\Data\SalesShipping\SalesShippingData;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use App\Data\CustomerAddressData\CustomerAddressData;

class SalesOrderData extends Data
{

    #[Computed]
    public string $sub_total_formatted;

    #[Computed]
    public string $shipping_total_formatted;

    #[Computed]
    public string $total_formatted;

    #[Computed]
    public string $created_at_formatted;

    #[Computed]
    public string $due_date_at_formatted;

    public function __construct(
        public string $trx_id,
        public string $status,
        public CustomerData $customer,

        public RegionData $origin,
        public CustomerAddressData $destination,

        #[DataCollectionOf(SalesOrderItemData::class)]
        public DataCollection $items,

        public SalesShippingData $shipping,
        public SalesPaymentData $payment,

        public float $sub_total,
        public float $shipping_cost,
        public float $total,

        public Carbon $due_date_at,
        public Carbon $created_at,

        public string|null $status_label

    ) {
        $this->sub_total_formatted = Number::currency($sub_total, locale: 'id', precision: 0);
        $this->shipping_total_formatted = Number::currency($shipping_cost, locale: 'id', precision: 0);
        $this->total_formatted = Number::currency($total, locale: 'id', precision: 0);
        $this->created_at_formatted = $created_at->translatedFormat('d F Y, H:i');
        $this->due_date_at_formatted = $due_date_at->translatedFormat('d F Y, H:i');
    }

    public static function fromModel(SalesOrder $sales_order): self
    {
        return new self(
            trx_id: $sales_order->trx_id,
            status: $sales_order->status,
            customer: new CustomerData(
                name: $sales_order->customer_name,
                email: $sales_order->customer_email,
                phone: $sales_order->customer_phone,
            ),
            origin: new RegionData(
                code: $sales_order->origin_code,
                province: $sales_order->origin_province,
                city: $sales_order->origin_city,
                district: $sales_order->origin_district,
                village: $sales_order->origin_village,
                postal_code: $sales_order->origin_postal_code
            ),
            destination: new CustomerAddressData(
                street_name: $sales_order->destination_street_name,
                province: $sales_order->destination_province,
                city: $sales_order->destination_city,
                district: $sales_order->destination_district,
                village: $sales_order->destination_village,
                postal_code: $sales_order->destination_postal_code
            ),
            items: SalesOrderItemData::collect($sales_order->items->toArray(), DataCollection::class),
            shipping: new SalesShippingData(
                driver: $sales_order->shipping_driver,
                receipt_number: $sales_order->shipping_receipt_number,
                courier: $sales_order->shipping_courier,
                service: $sales_order->shipping_service,
                estimated_delivery: $sales_order->shipping_estimated_delivery,
                description: $sales_order->shipping_description,
                cost: $sales_order->shipping_cost,
                weight: $sales_order->shipping_weight
            ),
            payment: new SalesPaymentData(
                driver: $sales_order->payment_driver,
                method: $sales_order->payment_method,
                label: $sales_order->payment_label,
                payload: $sales_order->payment_payload,
                paid_at: Carbon::parse($sales_order->payment_paid_at)
            ),
            sub_total: $sales_order->sub_total,
            shipping_cost: $sales_order->shipping_total,
            total: $sales_order->total,
            due_date_at: Carbon::parse($sales_order->due_date_at),
            created_at: $sales_order->created_at,
            status_label: $sales_order->status->label()
        );
    }
}
