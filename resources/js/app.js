var firstRequestDone = false;
var months = [
    'Jan', 'Feb', 'Mar',
    'Apr', 'May', 'Jun',
    'Jul', 'Aug', 'Sep',
    'Oct', 'Nov', 'Dec'
];

$(window).on('load', sendRequest);

$(document).ready(() => {
    setInterval(sendRequest, 300000); //check for update every 5 minutes
    getPastWeek();
});

function sendRequest() {
    $.ajax({
        type: "GET",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: `/get-current-wheater/Warsaw`,
        success: function (data) {
            $('#page-header').text(`${data.city} forecast - last updated time ${data.lastUpdate}`);
            $('#city-name').text(data.city);
            $('#degree').text(data.data.degree);
            $('#wheather-icon').attr({
                src: `./img/${data.data.weather_icon}.svg`,
                title: data.data.weather_description
            });
            $('#wind-speed').html(`<img src="./img/icon-wind.png" alt=""> ${data.data.wind_speed}m/c`);
            $('#wind-direction').html(`<img src="./img/icon-compass.png" alt="">${data.data.wind_direction}`);
            $('#humidity').html(`<img src="./img/icon-hum.png" alt="">${data.data.humidity}%`);

            if (!firstRequestDone) {
                $('body').delay(50).css({ 'overflow': 'visible' });
                $('#preloader').delay(500).fadeOut();
                firstRequestDone = true;
            }
        },
        error: function (e) {
            alert(e.responseJSON.message);
        }
    });
}

function getPastWeek() {
    $.ajax({
        type: "GET",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: `/get-pastweek-wheater/Warsaw`,
        success: function (data) {
            $.each(data.data, (index,value) => {
                $('#weather-result').append(
                    renderWeatherContainer(value)
                );
            })
        },
        error: function (e) {
            alert(e.responseJSON.message);
        }
    });
}

function renderWeatherContainer(data) {
    let day = new Date(data.date);
    return `<div class="forecast__item">
                <header class="forecast__header">
                    <h5 class="location">${data.city}</h5>
                    <h6 class="day-of-week">${day.getDate()} ${months[day.getMonth()]}</h6>
                </header>
                <div class="forecast__content">
                    <div class="degree">
                        <div class="degree__display">${data.degree}<span class="cel">&#8451</span></div>
                        <div class="forecast-icon">
                            <img title="${data.weather_description}" src="./img/${data.weather_icon}.svg" alt="" width="90">
                        </div>
                    </div>
                    <div class="additional-info">
                        <span><img src="./img/icon-wind.png" alt="">${data.wind_speed}m/c</span>
                        <span><img src="./img/icon-compass.png" alt="">${data.wind_direction}</span>
                        <span><img src="./img/icon-hum.png" alt="">${data.humidity}%</span>
                    </div>
                </div>
            </div>`;
}

