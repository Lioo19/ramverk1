<?php
namespace Lioo19\Models;

/**
 * Class for findnin coordinates and place with ip
 *
 */
class GeoMap
{
    /**
    * Function for retriving openStreetMap url
    *
    * @var float $lon Longitude
    * @var float $lat Latitude
    *
    * @return string|void
    *
    */
    public function fetchMap($lon, $lat)
    {
        if (!empty($lon) && !empty($lat)) {
            $map = "https://www.openstreetmap.org/#map=13/$lat/$lon";
            return $map;
        }
    }
}
