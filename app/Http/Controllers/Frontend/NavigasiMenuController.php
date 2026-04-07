<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Data\ProductCatalogData;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class NavigasiMenuController extends Controller
{
    public function home() {
        $title = 'Beranda | Adeeva Grosir';
        return view('customers.frontend.home', ['title' => $title]);
    }

    public function products() {
        $title = "Katalog Produk | Adeeva Grosir";
        return view('customers.frontend.products', ['title' => $title]);
    }

    public function productDetails(Product $product) {
        $product = ProductCatalogData::fromModel($product, true);
        $title = 'Detail Produk | Adeeva Grosir';
        return view('customers.frontend.product-details', compact('product', 'title'));
    }

    public function carts() {
        $title = 'Keranjang Belanja | Adeeva Grosir';
        return view('customers.frontend.product-carts', compact('title'));
    }

    public function checkout() {
        $title = 'Proses Pembayaran dan Pengiriman | Adeeva Grosir';
        return view('customers.frontend.checkout', compact('title'));
    }
}
