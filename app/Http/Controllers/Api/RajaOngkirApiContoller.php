<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RajaOngkirApiContoller extends Controller
{

    public static function searchDestination(string $search) {
        try {
            $response = Http::withHeaders([
                'key' => config('raja-ongkir.api_key')
            ])->timeout(30)
            ->get('https://rajaongkir.komerce.id/api/v1/destination/domestic-destination', [
                'search' => $search,
                'limit' => 100,
                'offsest' => 0
            ]);

            if($response->failed()) {
                return [];
            }

            return data_get($response->json(), 'data', []);

        } catch (Exception $e) {
            Log::error("Api Raja Ongkir Error: {$e->getMessage()}");
            return [];
        }

    }

    public static function checkShippingCost(int $origin_id, int $destination_id, int $weight) {
        try {
            $response = Http::withHeaders([
                'key' => config('raja-ongkir.api_key')
            ])->timeout(30)
            ->asForm()->post('https://rajaongkir.komerce.id/api/v1/calculate/domestic-cost', [
                'origin'      => $origin_id,  
                'destination' => $destination_id,
                'weight'      => $weight,
                'courier'     => 'jne:jnt:lion:pos:tiki',
                'price'       => 'lowest', 
            ]);

            if($response->failed()) {
                return [];
            }
            
            return data_get($response->json(), 'data', []);
            
        } catch(Exception $e) {
            Log::error("API Raja Ongkir Error : {$e->getMessage()}");
            return [];
        }
    }
}
