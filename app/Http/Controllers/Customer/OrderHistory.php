<?php

namespace App\Http\Controllers\Customer;

use App\Data\SalesOrder\SalesOrderData;
use App\Http\Controllers\Controller;
use App\Models\SalesOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderHistory extends Controller
{
    public function index() {

        $title = 'Riwayat Pesanan | Adeeva Grosir';
        $order_history_data = SalesOrderData::collect(
            Auth::user()->salesOrder()
            ->with('items')
            ->latest()
            ->paginate(1,'*', 'orders')
        );
        return view('customers.dashboard.order-history', compact('title', 'order_history_data'));
    }
}
