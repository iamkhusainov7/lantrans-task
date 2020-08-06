<?php

namespace App\Helpers;

class ResultFilter
{

    /**
     * This function converts kelvin degree to celcius.
     *
     * @return int
     */
    public static function convertToCelsius($kelvin): int
    {
        return round($kelvin - 273.15);
    }

    /**
     * This function prepares proper array of values to be inserted in db.
     *
     * @return array
     */
    public static function filterData(array $object): array
    {
        $icon = $object["weather"][0]["icon"];
        return [
            "degree" => self::convertToCelsius($object["main"]["temp_max"]),
            "humidity" => $object["main"]["humidity"],
            "wind_speed" => $object["wind"]["speed"],
            "wind_direction" => self::convertToCompasDirection($object["wind"]["deg"]),
            "weather_description" => $object["weather"][0]["description"],
            "weather_condition" => $object["weather"][0]["main"],
            "weather_icon" => mb_substr($icon, 0, mb_strlen($icon) - 1) . 'd',
            "date" => date('Y-m-d'),
        ];
    }

    /**
     * This function converts degree to compas direction.
     *
     * @return string
     */
    public static function convertToCompasDirection($degree): string
    {
        $winddir = [
            "N", "NNE", "NE", "ENE",
            "E", "ESE", "SE", "SSE",
            "S", "SSW", "SW", "WSW",
            "W", "WNW", "NW", "NNW",
            "N"
        ];

        $directionIndex = round(($degree * 16) / 360);
        return $winddir[$directionIndex];
    }
}
