<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use Illuminate\Support\Number;
use App\Data\CartDatas\CartData;
use App\Rules\ValidShippingHash;
use Illuminate\Support\Collection;
use App\Data\Checkout\CheckoutData;
use App\Data\Customer\CustomerData;
use App\Data\Shipping\ShippingData;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Rules\ValidPaymentMethodHash;
use App\Contract\CartServiceInterface;
use Spatie\LaravelData\DataCollection;
use App\Services\Region\RegionQueryService;
use App\Services\Shipping\ShippingMethodService;
use App\Services\Payment\PaymentMethodQueryService;
use App\Data\CustomerAddressData\CustomerAddressData;
use App\Services\Checkout\CheckoutService;

class Checkout extends Component
{
    public array $data = [
        'name' => null,
        'email' => null,
        'phone' => null,
        'street_name' => null,
        'province' => null,
        'regency' => null,
        'district' => null,
        'village' => null,
        'postal_code' => null,
        'shipping_hash' => null,
        'payment_hash' => null

    ];

    public array $summaries = [
        'sub_total' => 0,
        'sub_total_formatted' => '-',
        'shipping_total' => 0,
        'shipping_total_formatted' => '_',
        'grant_total' => 0,
        'grant_total_formatted' => '_'
    ];

    public array $shipping_selector = [
        'shipping_method' => null
    ];

    public array $payment_method_selector = [
        'payment_method_selected' => null
    ];

    public function mount() {

        if(!Gate::inspect('is_stock_available')->allowed())  {
            return redirect()->route('product.carts');
        }

        if(empty($this->user)) {
            return redirect()->route('product.carts')->with('error', 'Anda belum login. Silahkan masuk ke akun anda terlebih dahulu atau buat akun baru jika belum memiliki akun');
        }


        if(empty($this->user->address)) {
            return redirect()->route('product.carts')->with('error', 'Alamat pengiriman tidak tersedia, mohon lengkapi alamat anda terlebih dahulu');
        }

        $this->calculateTotal();
        $this->customerDetail();
        
    }

    protected function rules() {
        return [
            'data.name' => ['required', 'max:255', 'exists:users,name'],
            'data.email' => ['required', 'max:255', 'exists:users,email'],
            'data.phone' => ['required', 'min:5', 'max:12', 'exists:users,phone'],
            'data.street_name' => ['required', 'min:3', 'max:255', 'exists:user_addresses,street_name'],
            'data.province' => ['required', 'min:3', 'max:255', 'exists:regions,name'],
            'data.regency' => ['required', 'min:3', 'max:255', 'exists:regions,name'],
            'data.district' => ['required', 'min:3'],
            'data.postal_code' => ['required', 'exists:regions,postal_code'],
            'data.shipping_hash' => ['required', new ValidShippingHash()],
            'data.payment_hash' => ['required', new ValidPaymentMethodHash()]
        ];
    }
    protected function messages() {
        return [
            'data.shipping_hash.required' => 'Metode Pengiriman Belum Dipilih',
            'data.payment_hash.required' => 'Metode Pembayaran Belum Dipilih'
        ];
    }

    public function calculateTotal() {
        
        data_set($this->summaries, 'sub_total', $this->cart->total_price);
        data_set($this->summaries, 'sub_total_formatted', $this->cart->total_formatted_price);
        
        $shipping_cost = $this->shippingMethod?->cost ?? 0;
        data_set($this->summaries, 'shipping_total', $shipping_cost);
        data_set($this->summaries, 'shipping_total_formatted', Number::currency($shipping_cost, locale:'id'));
        
        $grand_total = $this->cart->total_price + $shipping_cost;
        data_set($this->summaries, 'grant_total', $grand_total);
        data_set($this->summaries, 'grant_total_formatted', Number::currency($grand_total, locale:'id'));

    }

    public function customerDetail() {
        $address = CustomerAddressData::formModel($this->user->address);
        data_set($this->data, 'name', $this->user->name);
        data_set($this->data, 'email', $this->user->email);
        data_set($this->data, 'phone', $this->user->phone);
        data_set($this->data, 'street_name', $address->street_name);
        data_set($this->data, 'province',  $address->province);
        data_set($this->data, 'regency',  $address->city);
        data_set($this->data, 'district', $address->district);
        data_set($this->data, 'village', $address->village);
        data_set($this->data, 'postal_code', $address->postal_code);

    }

    public function getUserProperty() {
        return Auth::user();
    }

    public function getCartProperty(CartServiceInterface $cart) : CartData {
        return $cart->all();
    }

    /** @return DataCollection<ShippingData */
    public function getShippingMethodsProperty(
        RegionQueryService $region,
        ShippingMethodService $shipping_service
    ) : DataCollection|Collection {

        $data = $shipping_service->getShippingMethods(
            $region->searchRegionByCode(
                config('origin-code.origin_code')
            ),
            CustomerAddressData::formModel($this->user->address),
            $this->cart
        )->toCollection()->groupBy('courier');
        
        return $data;
    }

    public function getShippingMethodProperty(
        ShippingMethodService $shipping_service
    ) : ?ShippingData {

        if(
            empty(data_get($this->data, 'shipping_hash')) ||
            empty($this->user->address)
        ) {
            return null;
        }

        $data = $shipping_service->getShippingMethod(
            data_get($this->data, 'shipping_hash')
        );

        if($data == null) {
            $this->addError('shipping_hash', 'Waktu sesi telah hangus');
            redirect()->route('product.carts');
        }

        return $data;
    }

    public function updatedShippingSelectorShippingMethod($value) {
        data_set($this->data, 'shipping_hash', $value);
        $this->calculateTotal();
    }
    
    public function getPaymentMethodsProperty(
        PaymentMethodQueryService $query_service
    ) : DataCollection {

        return $query_service->getPaymentMethods();
    }

    public function updatedPaymentMethodSelectorPaymentMethodSelected($value) {
        data_set($this->data, 'payment_hash', $value);
    }

    public function placeAnOrder(
        CartServiceInterface $cart
    ) {
        $validated = $this->validate();
        $shipping_method = app(ShippingMethodService::class)->getShippingMethod(
            data_get($validated, 'data.shipping_hash')
        );
        $payment_method = app(PaymentMethodQueryService::class)->getPaymentMethodByHash(
            data_get($validated, 'data.payment_hash')
        );
        $checkout = CheckoutData::from([
            'customer' => CustomerData::from(data_get($validated, 'data')),
            'origin' => $shipping_method->origin,
            'destination' => $shipping_method->destination,
            'cart' => $this->cart,
            'shipping' => $shipping_method,
            'payment' => $payment_method
        ]);

        $service = app(CheckoutService::class);
        $sales_order = $service->makeAnOrder($checkout);
        $cart->clear();

        return redirect()->route('order.confirmed', $sales_order->trx_id);
    }



    public function render()
    {
        return view('livewire.frontend.checkout');
    }
}
