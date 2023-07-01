<?php

namespace App\Console\Commands;

use App\Models\Weather;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class UpdateWeather extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'weather:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update weather data in the database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $key = 'bccfd20f5d287171c897ed6459558adb';

        $coordinates = [
            ['lat' => 28.6139, 'lon' => 77.2090],
            ['lat' => -33.9249, 'lon' => 18.4241],
            ['lat' => -26.195246, 'lon' => 28.034088]
        ];
        $weatherData = [];

        foreach ($coordinates as $coordinate) {
            $url = "https://api.openweathermap.org/data/2.5/weather?lat={$coordinate['lat']}&lon={$coordinate['lon']}&appid={$key}";
            $response = Http::get($url);
            $weatherData[] = $response->json();
        }

        // Update the weather data in the database
        foreach ($weatherData as $data) {
            Weather::updateOrCreate(
                ['city' => $data['name']],
                [
                    'coordinates' => $data['coord']['lat'] . ', ' . $data['coord']['lon'],
                    'condition' => $data['weather'][0]['main'],
                    'temperature' => $data['main']['temp'],
                    'feels_like' => $data['main']['feels_like'],
                    'humidity' => $data['main']['humidity'],
                    'wind_speed' => $data['wind']['speed']
                ]
            );
        }

        $this->info('Weather data has been updated successfully!');
    }
}


