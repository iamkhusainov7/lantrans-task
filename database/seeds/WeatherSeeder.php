<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WeatherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('weathers')->insert([
            'humidity' => 50,
            'degree' => 23,
            'wind_speed' => 7.2,
            'weather_description' => 'Clear sky',
            'wind_direction' => 'W',
            'weather_condition' => "Clear",
            'weather_icon' => '01d',
            'date' =>  "2020-07-30",
        ]);

        DB::table('weathers')->insert([
            'humidity' => 58,
            'degree' => 25,
            'wind_speed' => 7.2,
            'weather_description' => 'Few clouds',
            'wind_direction' => 'W',
            'weather_condition' => "Clear",
            'weather_icon' => '02d',
            'date' =>  "2020-08-01",
        ]);

        DB::table('weathers')->insert([
            'humidity' => 60,
            'degree' => 18,
            'wind_speed' => 7.2,
            'weather_description' => 'Scattered clouds',
            'wind_direction' => 'W',
            'weather_condition' => "Clear",
            'weather_icon' => '03d',
            'date' =>  "2020-08-02",
        ]);

        DB::table('weathers')->insert([
            'humidity' => 48,
            'degree' => 20,
            'wind_speed' => 7.2,
            'weather_description' => 'Broken clouds',
            'wind_direction' => 'W',
            'weather_condition' => "Clear",
            'weather_icon' => '04d',
            'date' =>  "2020-08-3",
        ]);

        DB::table('weathers')->insert([
            'humidity' => 55,
            'degree' => 18,
            'wind_speed' => 7.2,
            'weather_description' => 'Shower rain',
            'wind_direction' => 'W',
            'weather_condition' => "Clear",
            'weather_icon' => '09d',
            'date' =>  "2020-08-04",
        ]);

        DB::table('weathers')->insert([
            'humidity' => 58,
            'degree' => 22,
            'wind_speed' => 7.2,
            'weather_description' => 'Raining',
            'wind_direction' => 'W',
            'weather_condition' => "Clear",
            'weather_icon' => '10d',
            'date' =>  "2020-08-05",
        ]);
    }
}
