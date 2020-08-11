<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', "WeatherController@index");
Route::group(['middleware' => ['web']], function(){
    Route::get('/get-current-wheater/{cityName}', "WeatherController@retreiveWheather");
    Route::get('/get-pastweek-wheater/{cityName}', "WeatherController@retreivePastWeekWheather");
});

