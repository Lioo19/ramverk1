<?php

namespace Lioo19\Controller;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Test the SampleJsonController.
 */
class WeatherJSONControllerTest extends TestCase
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
        $this->controller = new WeatherJSONControllerMock();
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
        $exp = "Inkorrekt";
        $this->assertContains($exp, $json["message"]);
    }

    /**
     * Test the route "index" with IP-get
     */
    public function testIndexActionGetReqWithIp()
    {
        global $di;

        $req = $di->get("request");
        $testip = "216.58.211.142";
        $req->setGet("ip", $testip);

        $res = $this->controller->indexActionGet();

        $this->assertInternalType("array", $res);

        $json = $res[0];
        $this->assertContains($testip, $json["ip"]);
    }

    /**
     * Test the route "index" with lon/lat
     */
    public function testIndexActionGetReqWithPos()
    {
        global $di;

        $req = $di->get("request");
        $lon = "17.70";
        $req->setGet("lon", $lon);
        $req->setGet("lat", "5.69");

        $res = $this->controller->indexActionGet();

        $this->assertInternalType("array", $res);

        $json = $res[0];
        $this->assertContains($lon, $json["lon"]);
    }


    /**
     * Test the route "index" with IP-get, failing
     */
    public function testIndexActionGetReqWithIpFail()
    {
        global $di;

        $req = $di->get("request");
        $req->setGet("ip", "216.hjkl");

        $res = $this->controller->indexActionGet();

        $this->assertInternalType("array", $res);


        $json = $res[0];
        $exp = "Inkorrekt IP";
        $this->assertContains($exp, $json["message"]);
    }


    /**
     * Test the route "index" with lon/lat
     */
    public function testIndexActionGetReqWithPosFail()
    {
        global $di;

        $req = $di->get("request");
        $req->setGet("lon", "");
        $req->setGet("lat", "5.69");

        $res = $this->controller->indexActionGet();

        $this->assertInternalType("array", $res);

        $exp = "Inkorrekt";
        $this->assertContains($exp, $res[0]["message"]);
    }

    /**
     * Test the route "index" with lon/lat
     */
    public function testIndexActionGetReqWithPosFail2()
    {
        global $di;

        $req = $di->get("request");
        $req->setGet("lon", "sdfghjkl");
        $req->setGet("lat", "dfghjkl");

        $res = $this->controller->indexActionGet();

        $this->assertInternalType("array", $res);

        $exp = "Inkorrekt";
        $this->assertContains($exp, $res[0]["message"]);
    }
}
