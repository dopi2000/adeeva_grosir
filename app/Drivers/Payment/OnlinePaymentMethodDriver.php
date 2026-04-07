<?php

declare(strict_types=1);

namespace App\Drivers\Payment;

use App\Data\Payment\PaymentData;
use App\Contract\PaymentDriverInterface;
use App\Data\SalesOrder\SalesOrderData;
use App\Data\SalesOrder\SalesOrderItemData;
use App\Models\SalesOrder;
use App\Models\SalesOrderItem;
use App\Services\Order\SalesOrderService;
use Illuminate\Support\Facades\Http;
use Spatie\LaravelData\DataCollection;

class OnlinePaymentMethodDriver implements PaymentDriverInterface {

    public readonly string $driver;

    public function __construct()
    {
        $this->driver = 'online';
    }

    /** @return DataCollection<PaymentData> */
    public function getMethods() : DataCollection {
        return PaymentData::collect([
            PaymentData::from([
                'driver' => $this->driver,
                'method' => 'moota-bni-bank-transfer',
                'label' => '(Moota) Bank Transfer BNI',
                'payload' => [
                    'account_id' => '1Z6zK9DLWJD',
                ]
                ]),
            PaymentData::from([
                'driver' => $this->driver,
                'method' => 'moota-bca-bank-transfer',
                'label' => '(Moota) Bank Transfer BCA',
                'payload' => [
                    'account_id' => 'ZExj7128k59',
                ]
            ])
        ], DataCollection::class);
    }

    public function process(SalesOrderData $sales_order){ 

    $response =  Http::withToken(
            config('moota-access-token.api_token')
        )->post('https://api.moota.co/api/v2/create-transaction', [
            'order_id' => $sales_order->trx_id,
            'account_id' => data_get($sales_order->payment->payload, 'account_id'),
            'customers' => [
                'name' => $sales_order->customer->name,
                'email' => $sales_order->customer->email,
                'phone' => $sales_order->customer->phone
            ],
            'items' => $sales_order->items->toCollection()->map(function(SalesOrderItemData $item) {
                return [
                    'name' => $item->name,
                    'description' => $item->short_desc,
                    'qty' => $item->quantity,
                    'price' => $item->price
                ];
            })->merge([
                [
                    'name' => $sales_order->shipping->courier,
                    'description' => $sales_order->shipping->estimated_delivery,
                    'qty' => 1,
                    'price' => $sales_order->shipping_cost
                ]
            ])->toArray(),
            'description' => '',
            'note' => '',
            'redirect_url' => route('order.confirmed', $sales_order->trx_id),
            'total' => $sales_order->total
        ]);

        

       return app(SalesOrderService::class)->updateShippingPayload($sales_order, [
            'moota_payload' => $response->json('data')
        ]);

    }

    public function shouldPayNowButton(SalesOrderData $sales_order) : bool {
        return true;
    }

    public function getRedirectUrl(SalesOrderData $sales_order) : ?string {
        return data_get($sales_order->payment->payload, 'moota_payload.payment_url');
    }

}