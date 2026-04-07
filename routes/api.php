<?php

use App\Http\Controllers\Api\RajaOngkirApiContoller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::group(['prefix' => 'rajaongkir'], function() {

    Route::get('/search-destination', [RajaOngkirApiContoller::class, 'searchDestination']);
    Route::post('/check-shipping-cost', [RajaOngkirApiContoller::class, 'checkShippingCost']);

});
