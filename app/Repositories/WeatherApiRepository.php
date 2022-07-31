<?php

namespace App\Repositories;

require_once 'vendor/autoload.php';

use App\Models\WeatherAsset;
use App\Models\WeatherAssetFuture;
use GuzzleHttp\Client;

class WeatherApiRepository
{

    public function getWeather()
    {
        $client = new Client([
            'base_uri' => $_ENV['WEATHER_API_URL']
        ]);

        $path = 'forecast.json?key=';
        $key = $_ENV["WEATHER_API_KEY"];
        $place = '&q=Riga';
        $days = '&days=7';

        $response = json_decode(
            $client->get($path . $key . $place . $days)->getBody()->getContents()
        );

        $weatherToday = new WeatherAsset(
            (string)$response->current->temp_c,
            (string)$response->current->condition->icon,
        );

        $weatherFuture = [];
        $i = 0;

        foreach ($response->forecast->forecastday as $data) {
            if ($i != 0) {
                $weatherFuture[] = new WeatherAssetFuture(
                    (string)$data->day->condition->icon,
                );
            }
            $i++;
        }

        $weather = [$weatherToday, $weatherFuture];

        return ($weather);
    }
}