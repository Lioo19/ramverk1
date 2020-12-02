<?php

namespace Lioo19\Controller;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Test the SampleJsonController.
 */
class IpTestJSONControllerTest extends TestCase
{

    // Create the di container.
    protected $di;
    protected $controller;

    /**
     * Prepare before each test.
     */
    protected function setUp()
    {
        global $di;

        $di = $this->di;

        // Setup di
        $di = new DIFactoryConfig();
        $di->loadServices(ANAX_INSTALL_PATH . "/config/di");
        $di->loadServices(ANAX_INSTALL_PATH . "/test/config_/di");

        //set a test-cache for tests
        $di->get("cache")->setPath(ANAX_INSTALL_PATH . "/test/cache");

        // Setup the controller
        $this->controller = new IpTestJSONControllerMock();
        $this->controller->setDI($di);
    }



    /**
     * Test the route "index".
     */
    public function testIndexAction()
    {
        $res = $this->controller->indexActionGet();
        $this->assertIsArray($res);
        $this->assertInternalType("array", $res);

        $json = $res[0];
        $exp = "Ej";
        $this->assertContains($exp, $json["host"]);
    }

    /**
     * Test the route "index".
     */
    public function testIndexActionGetReq()
    {
        global $di;

        $req = $di->get("request");
        $req->setGet("ip", "216.58.211.142");

        $res = $this->controller->indexActionGet();

        $this->assertInternalType("array", $res);
    }
}
