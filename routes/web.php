<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;


Route::get('/', function () {
    return view('welcome');
});

Route::resource('products', ProductController::class);




Route::get('/weather/{city}', function ($city) {

    $apikey = env('OPENWEATHER_API_KEY');

    $response = Http::get('https://api.openweathermap.org/data/2.5/weather', [
        'q' => $city,
        'appid' => $apikey,
        'units' => 'metric',
       
       ]);

    if ($response->successful()) {
        return $response->json();
    } else {

        return response()->json([
            'error' => 'Api called failed',
            'status' => $response->status(),               
            'body' => $response->body(),


        ], 500);
        
    }


});