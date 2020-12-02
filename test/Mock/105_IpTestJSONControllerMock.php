<?php
namespace Lioo19\Controller;

use Lioo19\Models\IpGeoMock;

/**
 * Class for mocking GeoController
 * Class only contain methods for checking
 *
 */
class IpTestJSONControllerMock extends IpTestJSONController
{
    /**
    * Class for mocking the results from ipgeo
    *
    */
    public function getGeo($userip)
    {
        $ipGeo = new IpGeoMock($userip);
        $data = $ipGeo->fetchGeo();
        return $data;
    }
}
