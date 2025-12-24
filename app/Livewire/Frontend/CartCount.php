<?php

namespace App\Livewire\Frontend;

use App\Contract\CartServiceInterface;
use Livewire\Attributes\On;
use Livewire\Component;

class CartCount extends Component
{
    public int $count;

    public function mount(CartServiceInterface $cart) {
        $this->count = $cart->all()->total_quantity;
    }

    #[On('cart-count-updated')]
    public function updateCount(CartServiceInterface $cart) {
        $this->count = $cart->all()->total_quantity;
    }

    public function render()
    {
        return view('livewire.frontend.cart-count');
    }
}
