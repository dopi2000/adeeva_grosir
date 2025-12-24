<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;


class CustomerAddressController extends Controller
{
    public function index() {
        $title = 'Informasi Alamat | Adeeva Grosir';
        return view('customers.dashboard.customer-address', ['title' => $title]);
    }
}
