<?php
namespace Lioo19\Models;

/**
 * Class for retriving weather data
 *
 */
class Weather
{
    private function getApikey()
    {
        $apikey = require ANAX_INSTALL_PATH . "/config/apikeys.php";
        $apikey = $apikey["openweathermap"];
        return $apikey;
    }

    /**
    * Method for retriving the current date, and the five previous days
    * @return object with the different dates given in unix
    *
    */
    private function getDate() {
        $days = [];
        for ($i = 0; $i > -5; $i--) {
            $days[] = strtotime("$i days");
        }

        return $days;
    }

    /**
    * Method for retriving the weather info, given coordinates
    * @return object With parts of valid JSON-repsonse
    *
    */
    public function fetchCurrentWeather(string $lon, string $lat, $url = "api.openweathermap.org/data/2.5/weather?lat=")
    {
        $curl = curl_init();
        $apikey = $this->getApikey();

        //sets the url for curl to the correct one
        curl_setopt($curl, CURLOPT_URL, "$url" . $lat . "&lon=" . $lon . "&lang=se&units=metric&APPID=" . $apikey);
        //returns a string
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        //execute the started curl-session
        $output = curl_exec($curl);
        $exploded = json_decode($output, true);
        // $data = $exploded;
        $data = [
            "main" => $exploded["weather"][0]["main"],
            "description" => $exploded["weather"][0]["description"],
            "temp" => $exploded["main"]["temp"],
            "feels_like" => $exploded["main"]["feels_like"],
            "wind" => $exploded["wind"]["speed"],
        ];
        //close curl-session to free up space
        curl_close($curl);

        return $data;
    }

    /**
    * Method for retriving the weather info, given coordinates
    * @return object With parts of valid JSON-repsonse
    * Need to make five different API-calls, one for each day
    * how do I get the unix-time?
    */
    public function fetchHistoricalWeather(string $lon, string $lat)
    {
        $apikey = $this->getApikey();
        $url = "https://api.openweathermap.org/data/2.5/onecall/timemachine?lat="
                . $lat . "&lon=" . $lon . "&lang=se&units=metric&dt=";
        $urlcont = "&APPID=" . $apikey;
        $days = $this->getDate();

        //sets the url for curl to the correct one
        $multi = curl_multi_init();
        $all = [];
        foreach ($days as $day) {
            $c = curl_init($url . $day . $urlcont);
            curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
            curl_multi_add_handle($multi, $c);
            $all[] = $c;
        }

        $run = null;

        do {
            curl_multi_exec($multi, $run);
        } while ($run);

        //remove handles
        foreach ($all as $c) {
            curl_multi_remove_handle($multi, $c);
        }
        //close curl sessions
        curl_multi_close($multi);

        $res = [];
        // $res = $days;


        foreach ($all as $c) {
            $output = curl_multi_getcontent($c);
            $exploded = json_decode($output, true);
            $exploded = $exploded["current"];

            $res[] = $exploded;
        }

        return $res;
    }
}
