<?php

namespace Lioo19\Models;

use PHPUnit\Framework\TestCase;
use Lioo19\Models\IpGeo;

/**
 * Test the SampleController.
 */
class IpGeoTest extends TestCase
{

    /**
     * Test setting ipinput
     */
    public function testSuccessInput()
    {
        $geo = new IpGeo();
        $geo->setInput("261.2345.2342.33");

        $this->assertIsString($geo->ipinput);
    }
}
