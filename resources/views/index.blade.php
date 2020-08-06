<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forecast - Warsaw</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/app.css">
</head>

<body>
    <header class="page-header">
        <h1>Warsaw forecast - last updated time <?= is_int($lastUpdate) ? date("j M, H:i", $lastUpdate) : date("j M, H:i", strtotime($lastUpdate))?></h1>
    </header>
    <section class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="forecast">
                        <div class="forecast__item forecast--today">
                            <header class="forecast__header">
                                <h5 class="location">Warsaw forecast</h5>
                                <h6 class="day-of-week"><?= date('j M')?></h6>
                            </header>
                            <div class="forecast__content">
                                <div class="degree">
                                    <div class="degree__display">{{$data->degree}}<span class="cel">&#8451</span></div>
                                    <div class="forecast-icon">
                                        <img title="{{$data->weather_description}}" src="./img/{{$data->weather_icon}}.svg" alt="" width="90">
                                    </div>
                                </div>
                                <div class="additional-info">
                                    <span><img src="./img/icon-wind.png" alt="">{{$data->wind_speed}}m/c</span>
                                    <span><img src="./img/icon-compass.png" alt="">{{$data->wind_direction}}</span>
                                    <span><img src="./img/icon-hum.png" alt="">{{$data->humidity}}%</span>
                                </div>
                            </div>
                        </div>
                        @foreach($lasWeekTemp as $weather)
                        <div class="forecast__item">
                            <header class="forecast__header">
                                <h5 class="location">Warsaw forecast</h5>
                                <h6 class="day-of-week"><?= date('j M', strtotime($weather->date))?></h6>
                            </header>
                            <div class="forecast__content">
                                <div class="degree">
                                    <div class="degree__display">{{$weather->degree}}<span class="cel">&#8451</span></div>
                                    <div class="forecast-icon">
                                        <img title="{{$weather->weather_description}}" src="./img/{{$weather->weather_icon}}.svg" alt="" width="90">
                                    </div>
                                </div>
                                <div class="additional-info">
                                    <span><img src="./img/icon-wind.png" alt="">{{$weather->wind_speed}}m/c</span>
                                    <span><img src="./img/icon-compass.png" alt="">{{$weather->wind_direction}}</span>
                                    <span><img src="./img/icon-hum.png" alt="">{{$weather->humidity}}%</span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>