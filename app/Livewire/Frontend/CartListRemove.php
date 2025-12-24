<?php

namespace App\Livewire\Frontend;

use App\Contract\CartServiceInterface;
use Livewire\Component;
use App\Data\ProductCatalogData;

class CartListRemove extends Component
{
    public $sku;
    public $name;

    public function mount(ProductCatalogData $product) {
        $this->sku = $product->sku;
        $this->name = $product->name;
    }

    public function remove(CartServiceInterface $cart) {
        $cart->remove($this->sku);

        $this->dispatch('cart-count-updated');

        return redirect()->route('product.carts')->with('status', "Produk {$this->name} berhasil dihapus");
    }
    public function render()
    {
        return view('livewire.frontend.cart-list-remove');
    }
}
