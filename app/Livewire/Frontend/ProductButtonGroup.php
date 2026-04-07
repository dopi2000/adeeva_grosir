<?php

namespace App\Livewire\Frontend;

use App\Contract\CartServiceInterface;
use App\Data\CartDatas\CartItemData;
use App\Data\ProductCatalogData;
use Livewire\Component;

class ProductButtonGroup extends Component
{
    public int $quantity;
    public string $name;
    public string $slug;
    public string $sku;
    public string $type;
    public float $price;
    public int $stock;
    public int $weight;


    public function mount(ProductCatalogData $product) {
        $this->sku = $product->sku;
        $this->name = $product->name;
        $this->slug = $product->slug;
        $this->type = $product->type->value;
        $this->price = $product->price;
        $this->stock = $product->stock;
        $this->weight = $product->weight;
        $this->quantity = $this->getQuantityDefaultByType();
    }

    public function rules() {
        return [
            'quantity' => ['required', 'integer', "min:{$this->getQuantityDefaultByType()}", "max:{$this->stock}"]
        ];
    }

    public function messages() {
        return [
            'quantity.required' => 'Jumlah produk yang dipesan wajib di isi',
            'quantity.min' => 'Produk yang di pesan minimal ' . $this->getQuantityDefaultByType(),
            'quantity.max' => 'Jumlah produk yang dipesan melebihi stok yang tersedia',
            'quantity.integer' => 'Kuantitas yang di inputkan harus berupa angka'
        ];
    }

    public function getQuantityDefaultByType() : int {

        return match ($this->type) {
            'Lusin' => 6,
            'Kodi'=> 5,
            default => 1
        };
    }

    public function decrement() {
        switch ($this->type) {
            case 'Lusin':
                $this->quantity -= $this->getQuantityDefaultByType();
                break;
            case 'Kodi':
                $this->quantity -= $this->getQuantityDefaultByType();
                break;
            
            default:
            $this->quantity--;
                break;
        }

        if($this->quantity < $this->getQuantityDefaultByType()) {
            $this->quantity = $this->getQuantityDefaultByType();
        }
    }
    public function increment() {
        switch ($this->type) {
            case 'Lusin':
                $this->quantity += $this->getQuantityDefaultByType();
                break;
            case 'Kodi':
                $this->quantity += $this->getQuantityDefaultByType();
                break;
            
            default:
            $this->quantity++;
                break;
        }
    }

    public function addToCart(CartServiceInterface $cart) {
        $this->validate();

        $cart->addOrUpdate(new CartItemData(
            sku: $this->sku,
            quantity: $this->quantity,
            price: $this->price,
            weight: $this->weight
        ));

        $this->quantity = $this->getQuantityDefaultByType();

        $this->dispatch('cart-count-updated');
        
       return redirect()->route('product.details', $this->slug)->with('status', "{$this->name} berhasil dimasukan keranjang belanja");
    }
    public function buyNowButton(CartServiceInterface $cart) {
        $this->validate();

        $cart->addOrUpdate(new CartItemData(
            sku: $this->sku,
            quantity: $this->quantity,
            price: $this->price,
            weight: $this->weight
        ));

        $this->quantity = $this->getQuantityDefaultByType();

        $this->dispatch('cart-count-updated');
        
       return redirect()->route('product.carts')->with('status', "{$this->name} berhasil dimasukan keranjang belanja");
    }

    public function render()
    {
        return view('livewire.frontend.product-button-group');
    }
}
