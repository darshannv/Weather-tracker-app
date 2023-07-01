<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class WeatherController extends Controller
{
    
    public function getData() {

        // used  - Open weather Api key from -https://openweathermap.org/
        
        $key = 'bccfd20f5d287171c897ed6459558adb';

    $coordinates = [
        ['lat' => 28.6139, 'lon' => 77.2090],
        ['lat' => -33.9249, 'lon' => 18.4241],
        ['lat' => -26.195246, 'lon' => 28.034088]
    ];
    $data = [];

    foreach ($coordinates as $coordinate) {
        $cacheKey = "weather_{$coordinate['lat']}_{$coordinate['lon']}";
        $weather = Cache::get($cacheKey);

        if (!$weather) {
            $url = "https://api.openweathermap.org/data/2.5/weather?lat={$coordinate['lat']}&lon={$coordinate['lon']}&appid={$key}";
            $response = Http::get($url);
            $weather = $response->json();

            // Store weather data in the cache for 10 minutes
            Cache::put($cacheKey, $weather, 10 * 60);
        }
        $data[] = $weather;
    }

    return $data;
    }

    public function fetchWeather(){

     $datas = $this->getData();
    //dd($datas);

    return view('welcome', compact('datas'));
}



    public function dashboard() {

        $datas = $this->getData();

        //dd($datas);
        $users = User::latest()->get();

        return view('dashboard', compact('datas', 'users'));
    }
}