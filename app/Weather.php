<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use App\Helpers\ResultFilter;
use Illuminate\Support\Facades\DB;
use Throwable;

class Weather extends Model
{
    /**
     * Target city.
     *
     * @var string
     */
    private string $city;

    /**
     * Turning default timestamp.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Table name in db.
     *
     * @var string
     */
    protected $table = "weathers";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'humidity', 'degree', 'wind_speed', 'wind_direction',
        'weather_description', 'weather_condition', 'weather_icon',
        'date', 'city'
    ];

    /**
     * This method sets the city, which wheather should be retreived
     */
    public function setCity(string $city)
    {
        $this->city = $city;
        return $this;
    }

    /**
     * This method sends request through API and retreives current weather
     * @return App\Weather
     */
    public function getWeather()
    {
        $apiLink = env('API_RESOURCE', false);

        if (!$apiLink) {
            throw new \Exception('Api link is not specified');
        } 

        $apiKey = env('API_KEY', false);

        if (!$apiKey) {
            throw new \Exception('Api key is not specified');
        }

        $result = Http::get($apiLink, [
            'q' => $this->city,
            'appid' => $apiKey,
            'units' => 'metric'
        ])->json();
        if ($result['cod'] !== 200) {
            throw new \Exception($result['message']);
        }
        $this->result = ResultFilter::filterData($result);
        return $this;
    }

     /**
     * This function retreives the data for past week.
     *
     * @return array App\Weather
     */
    public static function getWeatherLastWeek()
    {
        $date = date('Y-m-d');
        $groupedResult = self::select(DB::raw('MIN(id) as id,MAX(degree) as degree, date'))
            ->where('date', '<', "$date")
            ->groupBy(['date'])
            ->orderBy('date');
        $result = self::joinSub($groupedResult, 'result', function ($join) {
            $join->on('weathers.id', '=', 'result.id');
        })->get();
        return $result;
    }

    /**
     * This function stores data in DB.
     *
     * @return void
     */
    public function saveInDB()
    {
        self::create($this->result);
    }
}
