<?php
namespace Lioo19\Controller;

use Lioo19\Models\WeatherMock;
use Lioo19\Models\IpGeoMock;

/**
 * Class for mocking GeoController
 * Class only contain methods for checking
 *
 */
class WeatherControllerMock extends WeatherController
{
    /**
    * Class for mocking the results from weather
    *
    */
    public function getWeather($which, $userlon, $userlat)
    {
        if ($which == "forecast") {
            $weather = new WeatherMock();
            $forweather = $weather->fetchForecastWeather($userlon, $userlat);
            return $forweather;
        } else {
            $weather = new WeatherMock();
            $histweather = $weather->fetchHistoricalWeather($userlon, $userlat);
            return $histweather;
        }
    }

    /**
    * Class for mocking the results from ipgeo
    *
    */
    public function getGeo($userip)
    {
        $ipGeo = new IpGeoMock();
        $data = $ipGeo->fetchGeo($userip);
        return $data;
    }
}
