<?php
namespace Lioo19\Controller;

use Lioo19\Models\IpGeoMock;

/**
 * Class for mocking GeoController
 * Class only contain methods for checking
 *
 */
class IpTestControllerMock extends IpTestController
{
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
