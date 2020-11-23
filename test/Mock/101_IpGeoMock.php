<?php
namespace Lioo19\Models;

/**
 * Class for mocking IpGeo
 * Class only contain methods for checking
 *
 */
class IpGeoMock extends IpGeo
{
    /**
    * Class for mocking request to IPstack
    *
    */
    public function fetchGeo($url = "khrfkjn")
    {
        $data = [
            "country" => "Sweden",
            "city" => "Karlskrona",
            "latitude" => "56.16122055053711",
            "longitude" => "15.586899757385254",
        ];

        return $data;
    }
}
