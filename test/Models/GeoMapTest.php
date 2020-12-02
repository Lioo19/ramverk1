<?php

namespace Lioo19\Models;

use PHPUnit\Framework\TestCase;
use Lioo19\Models\GeoMap;

/**
 * Test the SampleController.
 */
class GeoMapTest extends TestCase
{

    /**
     * Test map success
     */
    public function testSuccessFetchMap()
    {
        $geoMap = new GeoMap();
        $res = $geoMap->fetchMap("17,17", "5,69");

        $this->assertIsString($res);
    }

    /**
     * Test fetch map, fail
     */
    public function testFailFetchMap()
    {
        $geoMap = new GeoMap();
        $res = $geoMap->fetchMap("17,17", null);

        $this->assertNull($res);
    }
}
