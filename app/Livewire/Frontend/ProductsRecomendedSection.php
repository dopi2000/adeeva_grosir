<?php

namespace App\Livewire\Frontend;

use App\Models\Product;
use Livewire\Component;
use App\Data\ProductCatalogData;

class ProductsRecomendedSection extends Component
{
    public function render()
    {
        $newest_product = ProductCatalogData::collect(

            Product::query()
            ->soldItem()
            ->with(['media','tags'])
            ->latest()->limit(7)->get()
            );

        $best_seller_product = ProductCatalogData::collect(

            Product::query()->soldItem()->with(['media','tags'])
            ->orderByDesc('total_terjual')->limit(7)->get()

            );

        return view('livewire.frontend.products-recomended-section', compact('newest_product', 'best_seller_product'));
    }
}
