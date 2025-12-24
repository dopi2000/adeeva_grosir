<?php

namespace App\Livewire\Frontend;

use App\Models\Region;
use Livewire\Component;
use Illuminate\Support\Number;
use App\Data\CartDatas\CartData;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Contract\CartServiceInterface;
use Spatie\LaravelData\DataCollection;
use App\Services\Region\RegionQueryService;
use App\Data\CustomerAddressData\CustomerAddressData;
use App\Data\Shipping\ShippingData;
use App\Services\Shipping\ShippingMethodService;

class Checkout extends Component
{
    public array $data = [
        'name' => null,
        'phone' => null,
        'street_name' => null,
        'province' => null,
        'city' => null,
        'district' => null,
        'village' => null,
        'postal_code' => null

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

    public function mount() {

        if(!Gate::inspect('is_stock_available')->allowed())  {
            return redirect()->route('product.carts');
        }

        if(!$this->user->address()->first()) {
            return redirect()->route('product.carts')->with('error', 'Alamat pengiriman tidak tersedia, mohon lengkapi alamat anda terlebih ');
        }

        $this->calculateTotal();
        $this->customerDetail();
        
    }

    protected function rules() {
        return [
            'data.name' => ['required', 'max:255', 'exists:users,name'],
            'date.phone' => ['required', 'min:6', 'max:12', 'exists:users:phone'],
            'data.street_name' => ['required', 'min:5', 'max:255', 'exists:user_addresses,street_name'],
            'data.province' => ['required', 'min:10', 'max:255', 'exists:regions,name'],
            'data.city' => ['required', 'min:10', 'max:255', 'exists:regions,name'],
            'data.district' => ['required', 'min:10']
        ];
    }

    public function calculateTotal() {
        
        data_set($this->summaries, 'sub_total', $this->cart->total_price);
        data_set($this->summaries, 'sub_total_formatted', $this->cart->total_formatted_price);
        
        $shipping_cost = 0;
        data_set($this->summaries, 'shipping_total', $shipping_cost);
        data_set($this->summaries, 'shipping_total_formatted', Number::currency($shipping_cost, locale:'id'));
        
        $grand_total = $this->cart->total_price + $shipping_cost;
        data_set($this->summaries, 'grant_total', $grand_total);
        data_set($this->summaries, 'grant_total_formatted', Number::currency($grand_total, locale:'id'));

    }

    public function customerDetail() {
        $address = CustomerAddressData::formModel($this->user->address()->first());
        data_set($this->data, 'name', $this->user->name);
        data_set($this->data, 'phone', $this->user->phone);
        data_set($this->data, 'street_name', $address->street_name);
        data_set($this->data, 'province',  $address->province);
        data_set($this->data, 'city',  $address->city);
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

        return $shipping_service->getShippingMethods(
            $region->searchRegionByCode('82.71.06.1009'),
            CustomerAddressData::formModel(Auth::user()->address()->first()),
            $this->cart
        )->toCollection()->groupBy('service');
    }

    public function placeAnOrder() {
        dd($this->shipping_selector, $this->data, $this->shipping_methods);
    }


    public function render()
    {
        return view('livewire.frontend.checkout');
    }
}
