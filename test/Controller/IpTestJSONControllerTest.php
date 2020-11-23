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

        // Setup di
        $this->di = new DIFactoryConfig();
        $this->di->loadServices(ANAX_INSTALL_PATH . "/config/di");

        // Use a different cache dir for unit test
        $this->di->get("cache")->setPath(ANAX_INSTALL_PATH . "/test/cache");

        // View helpers uses the global $di so it needs its value
        $di = $this->di;

        // Setup the controller
        $this->controller = new IpTestJSONControllerMock();
        $this->controller->setDI($this->di);
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
