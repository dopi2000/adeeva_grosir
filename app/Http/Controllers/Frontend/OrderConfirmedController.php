<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\SalesOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderConfirmedController extends Controller
{
    public function index(SalesOrder $sales_order) {
        if($sales_order->customer_email !== Auth::user()->email) return abort('404', "Nomor Transaksi Anda Tidak di Temukan");

        $title = 'Konfirmasi Pembayaran | Adeeva Grosir';
        $sales_order = $sales_order;
        return view('customers.frontend.order-confirmed', compact('title', 'sales_order'));
    }
}
