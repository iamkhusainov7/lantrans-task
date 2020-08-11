<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forecast - Warsaw</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/app.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body style="overflow: hidden;">
    <div id="preloader" class="preloader"> 
        <div id="preloader-status" class="preloader-status"></div>
    </div> 

    <header class="page-header">
        <h1 id="page-header"></h1>
    </header>
    <section class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div id="weather-result" class="forecast">
                        <div class="forecast__item forecast--today">
                            <header class="forecast__header">
                                <h5 class="location" id="city-name"></h5>
                                <h6 class="day-of-week" id="date"><?= date('j M') ?></h6>
                            </header>
                            <div class="forecast__content">
                                <div class="degree">
                                    <div class="degree__display"><span id="degree"></span><span class="cel">&#8451</span></div>
                                    <div class="forecast-icon">
                                        <img title="" id="wheather-icon" src="" alt="" width="90">
                                    </div>
                                </div>
                                <div class="additional-info">
                                    <span id="wind-speed"></span>
                                    <span id="wind-direction"></span>
                                    <span id="humidity"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="./js/app.js"></script>
</html>