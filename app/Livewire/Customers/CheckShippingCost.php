<?php

namespace App\Livewire\Customers;

use App\Http\Controllers\Api\RajaOngkirApiContoller;
use Livewire\Component;

class CheckShippingCost extends Component
{
    public $data = [];

    public string $keyword = '';
    
    public function searchDestination() {
       $this->data[] =  RajaOngkirApiContoller::searchDestination(
        $this->keyword
       );
    }

    public function updateKeyword() {
        $this->searchDestination();
    }

    public function render()
    {
        return view('livewire.customers.check-shipping-cost');
    }
}

// [▼ // app\Livewire\Customers\CheckShippingCost.php:20
//   "id" => 77930
//   "label" => "BASTIONG KARANCE, TERNATE SELATAN (KOTA), TERNATE, MALUKU UTARA, 97713"
//   "province_name" => "MALUKU UTARA"
//   "city_name" => "TERNATE"
//   "district_name" => "TERNATE SELATAN (KOTA)"
//   "subdistrict_name" => "BASTIONG KARANCE"
//   "zip_code" => "97713"
// ]
