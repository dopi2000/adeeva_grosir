<?php

namespace App\Livewire\Frontend;

use App\Models\Product;
use Livewire\Component;
use App\Data\ProductCatalogData;

class ProductsRecomendedSection extends Component
{
    public function render()
    {
        $newest_product = ProductCatalogData::collect(Product::query()->latest()->limit(5)->get());
        $best_seller_product = ProductCatalogData::collect(Product::query()->inRandomOrder()->limit(5)->get());

        return view('livewire.frontend.products-recomended-section', compact('newest_product', 'best_seller_product'));
    }
}
