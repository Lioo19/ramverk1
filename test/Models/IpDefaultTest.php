<?php

namespace Lioo19\Models;

use Anax\DI\DIFactoryConfig;
use Anax\DI\DIMagic;
use PHPUnit\Framework\TestCase;
use Lioo19\Models\IpDefault;

/**
 * Test the IpDefault Model
 */
class IpDefaultTest extends TestCase
{
    /**
     * Setup before each testcase just like the router
     * would set it up.
     */
    protected function setUp(): void
    {
        global $di;

        // Init service container $di to contain $app as a service
        $di = new DIMagic();
        $di->loadServices(ANAX_INSTALL_PATH . "/config/di");

        // Create and initiate the controller
        $this->class = new IpDefault();
    }

    /**
     * Test defaultIp-method Failure
     */
    public function testGetDefaultIPFailure()
    {
        global $di;

        $req = $di->get("request");
        $usersIp = $this->class->getDefaultIp($req);
        $this->assertEquals($usersIp, "");
    }

    /**
     * Test defaultIp-method success
     */
    public function testGetDefaultIP()
    {
        global $di;

        $req = $di->get("request");
        $testip = "194.47.129.126";
        $req->setServer("REMOTE_ADDR", $testip);
        $usersIp = $this->class->getDefaultIp($req);
        $this->assertEquals($usersIp, $testip);
    }
}
