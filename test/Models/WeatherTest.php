<?php

namespace Lioo19\Models;

use PHPUnit\Framework\TestCase;
use Lioo19\Models\Weather;

/**
 * Test the SampleController.
 */
class WeatherTest extends TestCase
{

    /**
     * Test setting ipinput
     */
    public function testSuccessGetDate()
    {
        $weather = new Weather();
        $res = $weather->getDate();

        $this->assertIsArray($res);
    }
}
