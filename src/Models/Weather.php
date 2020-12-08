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
    * @return array with the different dates given in unix
    *
    */
    public function getDate()
    {
        $days = [];
        for ($i = 0; $i > -5; $i--) {
            $days[] = strtotime("$i days");
        }

        return $days;
    }

    /**
    * Method for retriving the weather info, given coordinates
    *
    */
    public function fetchForecastWeather($lon, $lat, $url = "api.openweathermap.org/data/2.5/onecall?lat=")
    {
        $curl = curl_init();
        $apikey = $this->getApikey();
        if (strlen($lon) > 0 && strlen($lat) > 0) {
            //sets the url for curl to the correct one
            curl_setopt($curl, CURLOPT_URL, "$url" . $lat . "&lon=" . $lon .
                        "&exclude=minutely,hourly&lang=se&units=metric&APPID=" . $apikey);
            //returns a string
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            //execute the started curl-session
            $output = curl_exec($curl);
            $exploded = json_decode($output, true);

            // $data = $exploded;
            if (array_key_exists("message", $exploded)) {
                $data = [
                    "message" => $exploded["message"]
                ];
                return $data;
            }
            $data = $exploded;
            //close curl-session to free up space
            curl_close($curl);

            return $data;
        } else {
            return "Not a valid lon/lat";
        }
    }

    /**
    * Method for retriving the weather info, given coordinates
    * @return object With parts of valid JSON-repsonse
    * Need to make five different API-calls, one for each day
    *
    */
    public function fetchHistoricalWeather($lon, $lat)
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
            if (array_key_exists("message", $exploded)) {
                $data = [
                    "message" => $exploded["message"]
                ];
                return $data;
            } else {
                $exploded = $exploded["current"];
            }

            $res[] = $exploded;
        }

        return $res;
    }
}
