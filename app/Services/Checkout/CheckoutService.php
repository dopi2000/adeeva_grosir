<?php

declare(strict_types=1);

namespace App\Services\Checkout;

use App\Models\Product;
use App\Models\SalesOrder;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use App\States\SalesOrder\Pending;
use Illuminate\Support\Facades\DB;
use App\Data\Checkout\CheckoutData;
use Illuminate\Support\Facades\Auth;
use App\Events\SalesOrderCreatedEvent;
use App\Data\SalesOrder\SalesOrderData;

class CheckoutService {
    public function makeAnOrder(CheckoutData $checkout_data) : SalesOrderData {

        $sales_order = DB::transaction(function() use ($checkout_data) {
            $date = Carbon::now()->format('Ymd');
            $random = strtoupper(Str::random(5));
            $items = collect([]);

           $sales_order = Auth::user()->salesOrder()->create([
                'trx_id' => "TRX-{$date}-{$random}",
                'status' => Pending::class,

                'customer_name' => $checkout_data->customer->name,
                'customer_email' => $checkout_data->customer->email,
                'customer_phone' => $checkout_data->customer->phone,

                'origin_code' => $checkout_data->origin->code,
                'origin_province' => $checkout_data->origin->province,
                'origin_city' => $checkout_data->origin->city,
                'origin_district' => $checkout_data->origin->district,
                'origin_village' => $checkout_data->origin->village,
                'origin_postal_code' => $checkout_data->origin->postal_code,
                
                'destination_street_name' => $checkout_data->destination->street_name,
                'destination_province' => $checkout_data->destination->province,
                'destination_city' => $checkout_data->destination->city,
                'destination_district' => $checkout_data->destination->district,
                'destination_village' => $checkout_data->destination->village,
                'destination_postal_code' => $checkout_data->destination->postal_code,

                'shipping_driver' => $checkout_data->shipping->driver,
                'shipping_receipt_number' => '',
                'shipping_courier' => $checkout_data->shipping->courier,
                'shipping_service' => $checkout_data->shipping->service,
                'shipping_estimated_delivery' => $checkout_data->shipping->estimated_delivery,
                'shipping_description' => $checkout_data->shipping->description,
                'shipping_cost' => $checkout_data->shipping->cost,
                'shipping_weight' => $checkout_data->shipping->weight,

                'payment_driver' => $checkout_data->payment->driver,
                'payment_method' => $checkout_data->payment->method,
                'payment_label' => $checkout_data->payment->label,
                'payment_payload' => $checkout_data->payment->payload,

                'sub_total' => $checkout_data->sub_total,
                'shipping_total' => $checkout_data->shipping_cost,
                'total' => $checkout_data->grand_total,

                'due_date_at' => Carbon::now()->addHours(24)
            ]);

            /** @var CartItemData $item  */
            foreach($checkout_data->cart->items as $item) {
                $product = Product::where('sku', $item->sku)->lockForUpdate()->firstOrFail();

                if($product->stock < $item->quantity) {
                    throw new \Exception("Stok produk tidak tersedia");
                }

                $product->stock -= $item->quantity;
                $product->save();

                $items->push([
                    'product_id' => $item->product()->product_id,
                    'name' => $item->product()->name,
                    'short_desc' => $item->product()->category ?? '_',
                    'sku' => $item->product()->sku,
                    'slug' => $item->product()->slug,
                    'description' => $item->product()->description ?? '',
                    'cover_url' => $item->product()->cover_url,
                    'quantity' => $item->quantity,
                    'price' => $item->product()->price,
                    'total' => $item->price * $item->quantity,
                    'weight' => $item->weight,
                ]);
            }

            $sales_order->items()->createMany($items);

            return $sales_order;

        });

        $data = SalesOrderData::fromModel($sales_order);
        
        event(new SalesOrderCreatedEvent($data));

        return $data;
        
    }
}