<?php

namespace Anax\Controller;

use Anax\DI\DIFactoryConfig;
use Anax\DI\DIMagic;
use PHPUnit\Framework\TestCase;
use Anax\Controller\IpTest;


/**
 * Test the SampleController.
 */
class IpTestTest extends TestCase
{

    /**
     * Test ip4-function
     */
    public function testIp4()
    {
        $iptest = new IpTest("216.58.211.142");
        $res = $iptest->ip4test();

        $this->assertTrue($res);
    }

    /**
     * Test ip6-function
     */
    public function testIp6()
    {
        $iptest = new IpTest("2001:0db8:85a3:0000:0000:8a2e:0370:7334");
        $res = $iptest->ip6test();

        $this->assertTrue($res);
    }
}
