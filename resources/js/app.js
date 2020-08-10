var firstRequestDone = false;

$(window).on('load', sendRequest);

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
                sendRequest();
                setInterval(sendRequest, 300000); //check for update every 5 minutes
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