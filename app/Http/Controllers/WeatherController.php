<?php

namespace App\Http\Controllers;

use App\Weather;
use App\Cache;

class WeatherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index', [
            "lasWeekTemp" => Weather::getWeatherLastWeek(),
        ]);
    }

    /**
     * Store a newly created resource in cache.
     *
     * @param  array $data - the data that should be stored in cache
     * @return void
     */
    public function storeInCache(array $data)
    {
        Cache::put("warsaw_weather", $data, 3600);
    }

    /**
     * This method is for ajax requests.
     * @param string $cityName the name of city
     * @return Illuminate\Contracts\Routing\ResponseFactory::json
     */
    public function retreiveWheather(string $cityName)
    {
        $cacheResult = Cache::get("warsaw_weather");
        if ($cacheResult) {
            return response()
                ->json([
                    "data" => json_decode($cacheResult->value),
                    "lastUpdate" => date("j M, H:i", $cacheResult->expiration - 3600),
                    "city" => $cityName,
                ]);
        }
        $todayWeather = new Weather();
        try {
            $todayWeather->setCity($cityName)
                ->getWeather()
                ->saveInDB();
        } catch (\Exception $e) {
            return response()
                ->json([
                    "message" => $e->getMessage(),
                ], 500);
        }

        $this->storeInCache($todayWeather->result);
        return response()
            ->json([
                "data" => (object)$todayWeather->result,
                "lastUpdate" => date("j M, H:i"),
                "city" => $cityName,
            ]);
    }
}
