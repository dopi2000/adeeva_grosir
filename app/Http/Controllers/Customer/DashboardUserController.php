<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardUserController extends Controller
{
    public function index() {
        $title = "Dashboard Pengguna | Adeeva Grosir";
        return view('components.layouts.layout-customer-backend');
    }
}
