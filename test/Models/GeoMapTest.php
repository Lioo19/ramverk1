<?php

namespace Lioo19\Models;

use Anax\DI\DIFactoryConfig;
use Anax\DI\DIMagic;
use PHPUnit\Framework\TestCase;
use Lioo19\Models\GeoMap;

/**
 * Test the SampleController.
 */
class GeoMapTest extends TestCase
{

    /**
     * Test ip4-function
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
        $res = $geoMap->fetchMap("17,17", "");

        $this->assertNull($res);
    }
}
