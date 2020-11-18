<?php
namespace Lioo19\Models;

/**
 * Class for retriving weather data
 *
 */
class Weather
{

    /**
     * Constructor to assign user input and address to use
     *
     * @param null|string    $ipinp  User input
     */
    public function __construct(string $lon = "", $lat = "")
    {
        $this->lat = strval($lat);
        $this->lon = strval($lon);
        $this->curl = curl_init();
    }

    /**
    * Method for retriving the weather info, given coordinates
    * @return object With parts of valid JSON-repsonse
    * DONT UPLOAD THIS UNTIL KEY IS FIXED!!
    */
    public function fetchFutureWeather($url = "api.openweathermap.org/data/2.5/weather?lat=")
    {
        $apikey = require ANAX_INSTALL_PATH . "/config/apikeys.php";
        $apikey = $apikey["openweathermap"];
        //sets the url for curl to the correct one
        curl_setopt($this->curl, CURLOPT_URL, "$url" . $this->lat . "&lon=" . $this->lon . "&units=metric&APPID=" . $apikey);
        //returns a string
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, 1);
        //execute the started curl-session
        $output = curl_exec($this->curl);
        $exploded = json_decode($output, true);
        // $data = $exploded;
        $data = [
            "main" => $exploded["weather"][0]["main"],
            "description" => $exploded["weather"][0]["description"],
            "temp" => $exploded["main"]["temp"],
            "feels_like" => $exploded["main"]["feels_like"],
            "wind" => $exploded["wind"]["speed"],
            "lat" => $this->lat,
            "lon" => $this->lon,

        ];
        //close curl-session to free up space
        curl_close($this->curl);

        return $data;
    }

    /**
    * Method for retriving the weather info, given coordinates
    * @return object With parts of valid JSON-repsonse
    * Need to make five different API-calls, one for each day
    * how do I get the unix-time?
    */
    public function fetchHistoricalWeather($url = "https://api.openweathermap.org/data/2.5/onecall/timemachine?lat=")
    {
        $apikey = require ANAX_INSTALL_PATH . "/config/apikeys.php";
        $apikey = $apikey["openweathermap"];
        //sets the url for curl to the correct one
        curl_setopt($this->curl, CURLOPT_URL, "$url" . $this->lat . "&lon=" . $this->lon . "&units=metric&lang=se&APPID=" . $apikey);
        //returns a string
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, 1);
        //execute the started curl-session
        $output = curl_exec($this->curl);
        $exploded = json_decode($output, true);
        // $data = $exploded;
        $data = [
            "main" => $exploded["weather"][0]["main"],
            "description" => $exploded["weather"][0]["description"],
            "temp" => $exploded["main"]["temp"],
            "feels_like" => $exploded["main"]["feels_like"],
            "wind" => $exploded["wind"]["speed"],
            "lat" => $this->lat,
            "lon" => $this->lon,

        ];
        //close curl-session to free up space
        curl_close($this->curl);

        return $data;
    }

    /**
    * Method for retriving the weather info, given coordinates
    * @return object With parts of valid JSON-repsonse
    * how do I get the unix-time?
    */
    public function fetchOneHWeather($url = "https://api.openweathermap.org/data/2.5/onecall/timemachine?lat=")
    {
        $apikey = require ANAX_INSTALL_PATH . "/config/apikey.php";
        $apikey = $apikey["openweathermap"];

        //sets the url for curl to the correct one
        curl_setopt($this->curl, CURLOPT_URL, "$url" . $this->lat . "&lon=" . $this->lon . "&units=metric&lang=se&APPID=" . $apikey);
        //returns a string
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, 1);
        //execute the started curl-session
        $output = curl_exec($this->curl);
        $exploded = json_decode($output, true);
        // $data = $exploded;
        $data = [
            "main" => $exploded["weather"][0]["main"],
            "description" => $exploded["weather"][0]["description"],
            "temp" => $exploded["main"]["temp"],
            "feels_like" => $exploded["main"]["feels_like"],
            "wind" => $exploded["wind"]["speed"],
            "lat" => $this->lat,
            "lon" => $this->lon,

        ];
        //close curl-session to free up space
        curl_close($this->curl);

        return $data;
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

}
