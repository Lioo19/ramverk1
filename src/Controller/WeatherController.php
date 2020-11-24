<?php

namespace Lioo19\Controller;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Lioo19\Models\GeoMap;
use Lioo19\Models\Weather;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class WeatherController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function indexAction() : object
    {
        $page = $this->di->get("page");
        $request = $this->di->get("request");
        $ipDefault = $this->di->get("ipdefault");
        $usersIp = $ipDefault->getDefaultIp($request);

        $data = [
            "defaultIp" => $usersIp,
        ];

        //MAPPEN inte url
        $page->add("weather/weather", $data);

        return $page->render([
            "title" => __METHOD__,
        ]);
    }

    /**
     * Post for redirecting to final page of Weather, picking up given values
     * Sends the ip-adress with post and redirects
     *
     * @return object
     */
    public function validationActionPost() : object
    {
        $request = $this->di->get("request");
        $page = $this->di->get("page");
        $title = "Vädret";
        //request to get the posted information
        $userip = $request->getPost("ipinput", null);
        $userlon = $request->getPost("lon", null);
        $userlat = $request->getPost("lat", null);

        if ($userip) {
            $data = $this->getIpData($userip);

            if (count($data) < 2) {
                $page->add("weather/validationfail", $data);
            } else {
                //data for map
                $data2 = [
                    "lon" => $data["geoInfo"]["longitude"],
                    "lat" => $data["geoInfo"]["latitude"],
                ];

                $page->add("weather/validationip", $data);
                $page->add("weather/map", $data2);
            }
        } elseif ($userlon && $userlat) {
            $data = $this->getPosData($userlon, $userlat);

            if (count($data) < 2) {
                $page->add("weather/validationfail", $data);
            } else {
                $data2 = [
                    "lon" => $userlon,
                    "lat" => $userlat,
                ];

                $page->add("weather/validationpos", $data);
                $page->add("weather/map", $data2);
            }
        } else {
            $datafail = [
                "message" => "Gå tillbaka och försök igen"
                ];
            $page->add("weather/validationfail", $datafail);
        }
        return $page->render([
            "title" => $title,
        ]);
    }

    private function getIPData($userip)
    {
        $validation = $this->di->get("iptest");
        $validation->setInput($userip);

        $ip4 = $validation->ip4test();
        $ip6 = $validation->ip6test();

        if ($ip6 || $ip4) {
            $hostname = gethostbyaddr($userip);
            $geoInfo = $this->getGeo($userip);
            $lon = $geoInfo["longitude"];
            $lat = $geoInfo["latitude"];
            $map = new GeoMap($lon, $lat);
            $forweather = $this->getWeather("forecast", $lon, $lat);
            $histweather = $this->getWeather("historical", $lon, $lat);
        } else {
            $data = [
                "message" => "Inkorrekt IP, försök igen",
            ];

            return $data;
        }

        $data = [
            "ip" => $userip,
            "hostname" => $hostname,
            "geoInfo" => $geoInfo,
            "map" => $map,
            "forweather" => $forweather,
            "histweather" => $histweather,
        ];

        return $data;
    }

    private function getPosData($userlon, $userlat)
    {
        //check that lon/lat are valid floats
        if (floatval($userlon) != 0 && floatval($userlat) != 0) {
            $map = new GeoMap($userlon, $userlat);
            $forweather = $this->getWeather("forecast", $userlon, $userlat);
            $histweather = $this->getWeather("historical", $userlon, $userlat);
            if (is_array($forweather)) {
                $data = [
                    "map" => $map,
                    "forweather" => $forweather,
                    "histweather" => $histweather,
                    "lon" => $userlon,
                    "lat" => $userlat
                ];

                return $data;
            }
        }
        $data = [
            "message" => "Inkorrekt position, försök igen",
        ];

        return $data;
    }

    public function getGeo($userip)
    {
        $geo = $this->di->get("ipgeo");
        $geo->setInput($userip);
        $geoInfo = $geo->fetchGeo();

        return $geoInfo;
    }

    public function getWeather($which, $userlon, $userlat)
    {
        if ($which == "forecast") {
            $weather = new Weather();
            $forweather = $weather->fetchForecastWeather($userlon, $userlat);
            return $forweather;
        } else {
            $weather = new Weather();
            $histweather = $weather->fetchHistoricalWeather($userlon, $userlat);
            return $histweather;
        }
    }
}
