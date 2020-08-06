<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use App\Helpers\ResultFilter;
use Illuminate\Support\Facades\DB;

class Weather extends Model
{
    
    /**
     * The link to forecast api.
     *
     * @var string
     */
    protected string $apiUrl = "https://api.openweathermap.org/data/2.5/weather?q=Warsaw&appid=142713817b9b0e01ef47b8f4f178f506";

    /**
     * API key.
     * @var string
     */
    private const API_KEY = "142713817b9b0e01ef47b8f4f178f506";

    /**
     * Target city.
     *
     * @var string
     */
    private const CITY = "Warsaw";

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
        'date',
    ];

    /**
     * This method sends request through API and retreives current weather
     * @return App\Weather
     */
    public function getWeather()
    {
        $result = Http::get($this->apiUrl, [
            'q' => self::CITY,
            'appid' => self::API_KEY,
        ])->json();

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
