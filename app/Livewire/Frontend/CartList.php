<?php

namespace App\Livewire\Frontend;

use App\Actions\ValidatedCartStock;
use Livewire\Component;
use Illuminate\Support\Collection;
use App\Contract\CartServiceInterface;
use App\Data\CartDatas\CartItemData;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\On;

class CartList extends Component
{

    public string $sub_total;
    public string $total;

    public int $quantity;

    public function mount(CartServiceInterface $cart) {

        $all = $cart->all();
        $this->sub_total = $all->total_formatted_price;
        $this->total = $this->sub_total;
        
    }

    #[On('cart-count-updated')]
    public function updatedTotalPrice(CartServiceInterface $cart) {

        $all = $cart->all();
        $this->sub_total = $all->total_formatted_price;
        $this->total = $this->sub_total;
    }

    public function getQuantityDefaultByType($type) : int {

        return match ($type) {
            'Lusin' => 6,
            'Kodi'=> 5,
            default => 1
        };
    }

    public function increment(string $sku, CartServiceInterface $cart) {
        $price = $cart->getItemBySku($sku)->price;
        $weight = $cart->getItemBySku($sku)->weight;
        $type = $cart->getItemBySku($sku)->product()->type->value;
        $quantity = $cart->getItemBySku($sku)->quantity;

        switch ($type) {
            case 'Lusin':
                if($quantity < $cart->getItemBySku($sku)->product()->stock) {
                    $quantity += $this->getQuantityDefaultByType($type);
                    $cart->addOrUpdate( new CartItemData(
                        sku: $sku,
                        quantity: $quantity,
                        price: $price,
                        weight: $weight
                    ));
                }
                break;
            case 'Kodi':
                if($quantity < $cart->getItemBySku($sku)->product()->stock) {
                    $quantity += $this->getQuantityDefaultByType($type);
                    $cart->addOrUpdate( new CartItemData(
                        sku: $sku,
                        quantity: $quantity,
                        price: $price,
                        weight: $weight
                    ));
                }
                break;
            
            default:
                if($quantity < $cart->getItemBySku($sku)->product()->stock) {
                    $quantity += $this->getQuantityDefaultByType($type);
                    $cart->addOrUpdate( new CartItemData(
                        sku: $sku,
                        quantity: $quantity,
                        price: $price,
                        weight: $weight
                    ));
                }
                break;
        }
        $this->dispatch('cart-count-updated');
    }

    public function decrement(string $sku, CartServiceInterface $cart) {

        $price = $cart->getItemBySku($sku)->price;
        $weight = $cart->getItemBySku($sku)->weight;
        $type = $cart->getItemBySku($sku)->product()->type->value;
        $quantity = $cart->getItemBySku($sku)->quantity;

        switch ($type) {
            case 'Lusin':
                $quantity -= $this->getQuantityDefaultByType($type);
                if($quantity < $this->getQuantityDefaultByType($type)) {
                    $quantity = $this->getQuantityDefaultByType($type);
                }
                $cart->addOrUpdate( new CartItemData(
                    sku: $sku,
                    quantity: $quantity,
                    price: $price,
                    weight: $weight
                ));
                break;
            case 'Kodi':
                $quantity -= $this->getQuantityDefaultByType($type);
                if($quantity < $this->getQuantityDefaultByType($type)) {
                    $quantity = $this->getQuantityDefaultByType($type);
                }
                $cart->addOrUpdate( new CartItemData(
                    sku: $sku,
                    quantity: $quantity,
                    price: $price,
                    weight: $weight
                ));
                break;
            
            default:
              $quantity--;
                if($quantity < $this->getQuantityDefaultByType($type)) {
                    $quantity = $this->getQuantityDefaultByType($type);
                }
              $cart->addOrUpdate( new CartItemData(
                  sku: $sku,
                  quantity: $quantity,
                  price: $price,
                  weight: $weight
                ));
                break;
        }


        $this->dispatch('cart-count-updated');
    }

    public function getItemsProperty(CartServiceInterface $cart) : Collection {
        return $cart->all()->items->toCollection();
    } 

    public function checkout() {
        return redirect()->route('checkout');
    }

    public function render()
    {
        return view('livewire.frontend.cart-list', [
            'items' => $this->items
        ]);
    }
}
