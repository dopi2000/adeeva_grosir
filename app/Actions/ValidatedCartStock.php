<?php

namespace App\Actions;

use App\Data\ProductCatalogData;
use App\Contract\CartServiceInterface;
use Lorisleiva\Actions\Concerns\AsAction;
use Illuminate\Validation\ValidationException;

class ValidatedCartStock
{
    use AsAction;

    public function __construct(
        public CartServiceInterface $cart
    )
    {
        
    }

    public function handle()
    {
        $insufficient = [];
        $items_on_cart = $this->cart->all()->items->items();

        if(empty($items_on_cart)) {
            throw ValidationException::withMessages([
                'cart' => 'Keranjang Belanja Anda Kosong.',
            ]);
        }

        foreach($this->cart->all()->items as $item) {
            /** @var ProductCatalogData $product */
            $product = $item->product(); 

            if(!$product || $product->stock < $item->quantity) {
                $insufficient[] = [
                    'sku' => $product->sku,
                    'name' => $product->name ?? "Produk Tidak dikenal",
                    'requested' => $item->quantity,
                    'available' => $product?->stock ?? 0
                ];
            }

        }

        if($insufficient) {
            throw ValidationException::withMessages([
                'cart' => 'Beberapa produk, stoknya tidak mencukupi',
                'details' => $insufficient
            ]);
        }


    }
}
