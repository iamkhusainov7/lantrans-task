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
        $cacheResult = Cache::get("warsaw_weather");
        if ($cacheResult) {
            return view('index', [
                "data" => json_decode($cacheResult->value),
                "lastUpdate" => $cacheResult->expiration - 3600,
                "lasWeekTemp" => Weather::getWeatherLastWeek()
            ]);
        }
        $todayWeather = new Weather();
        $todayWeather->getWeather()->saveInDB();
        $this->storeInCache($todayWeather->result);
        return view('index', [
            "data" => (object)$todayWeather->result,
            "lastUpdate" => $todayWeather->created_at,
            "lasWeekTemp" => Weather::getWeatherLastWeek()
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
}
