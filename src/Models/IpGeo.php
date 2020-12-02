<?php
namespace Lioo19\Models;

/**
 * Class for findning coordinates and place with ip
 *
 */
class IpGeo
{
    /**
    * @var string $ipinput   userinputted ip
    * @var string $curl      curl-object
    */
    public $ipinput;
    private $curl;

    /**
     * Constructor to assign user input and address to use
     *
     * @param null|string    $ipinp  User input
     */
    public function setInput(string $ipinp = "")
    {
        $this->ipinput = $ipinp;
    }

    /**
    * Method for retriving the geo-coordinates for given ip-address
    * @return object With parts of valid JSON-repsonse
    */
    public function fetchGeo($url = "http://api.ipstack.com/")
    {
        $this->curl = curl_init();
        $apikey = require ANAX_INSTALL_PATH . "/config/apikeys.php";
        $accesskey = $apikey["ipstack"];
        //sets the url for curl to the correct one
        curl_setopt($this->curl, CURLOPT_URL, "$url" . $this->ipinput . "?access_key=" . $accesskey);
        //returns a string
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, 1);
        //execute the started curl-session
        $output = curl_exec($this->curl);
        $exploded = json_decode($output, true);
        $data = [
            "country" => $exploded["country_name"],
            "city" => $exploded["city"],
            "latitude" => $exploded["latitude"],
            "longitude" => $exploded["longitude"],
        ];
        //close curl-session to free up space
        curl_close($this->curl);

        return $data;
    }
}
