<?php
declare(strict_types=1);

namespace App\Livewire\Frontend;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Data\ProductCatalogData;
use App\Data\CartDatas\CartItemData;
use Illuminate\Support\Facades\Auth;
use App\Contract\CartServiceInterface;
use RealRashid\SweetAlert\Facades\Alert;

class CartButtons extends Component
{
    public int $quantity;
    public string $name;
    public string $sku;
    public string $type;
    public float $price;
    public int $stock;
    public int $weight;

    public function mount(ProductCatalogData $product) {
        $this->name = $product->name;
        $this->sku = $product->sku;
        $this->price = $product->price;
        $this->stock = $product->stock;
        $this->weight = $product->weight;
        $this->quantity = $this->getQuantityDefaultByType();
    }

    protected function rules() {
        return [
            'quantity' => ['required', 'integer', "min:{$this->getQuantityDefaultByType()}", "max:{$this->stock}" ]
        ];
    }
    
    protected function messages() {
        return [
            'quantity.required' => 'Kuantitas produk wajib di isi',
            'quantity.integer' => 'Kuantitas produk berupa angka',
            'quantity.min' => "Jumlah produk yang dipesan minimal {$this->getQuantityDefaultByType()}",
            'quantity.max' => "Jumlah produk yang dipesan melebihi stok yang tersedia"
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
        $cart->addOrUpdate( new CartItemData(
            sku: $this->sku,
            quantity: $this->quantity,
            price: $this->price,
            weight: $this->weight
        ));

        $this->quantity = $this->getQuantityDefaultByType();

        $this->dispatch('cart-count-updated');
        
        toast("{$this->name} berhasil ditambahkan keranjang belanja.",'success','top-right')->showCloseButton()->autoClose(10000);

        return redirect(request()->header('Referer'));
        // ->with('status', "Produk {$this->name} berhasil masuk keranjang belanja.");
    }

    public function buyNowButton(CartServiceInterface $cart) {
        $this->validate();
        $cart->addOrUpdate( new CartItemData(
            sku: $this->sku,
            quantity: $this->quantity,
            price: $this->price,
            weight: $this->weight
        ));

        $this->quantity = $this->getQuantityDefaultByType();

        $this->dispatch('cart-count-updated');
        

        return redirect()->route('product.carts')->with('status', "Produk {$this->name} berhasil masuk keranjang belanja.");
    }
    
    public function render()
    {
        return view('livewire.frontend.cart-buttons');
    }
}
