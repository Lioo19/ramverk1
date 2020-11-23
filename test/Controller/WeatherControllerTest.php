<?php

namespace Lioo19\Controller;

use Anax\DI\DIFactoryConfig;
use Anax\DI\DIMagic;
use PHPUnit\Framework\TestCase;

/**
 * Test the SampleController.
 */
class WeatherControllerTest extends TestCase
{

    /**
     * Setup the controller, before each testcase, just like the router
     * would set it up.
     */
    protected function setUp(): void
    {
        global $di;

        // Init service container $di to contain $app as a service
        $di = new DIMagic();
        $di->loadServices(ANAX_INSTALL_PATH . "/config/di");

        // Create and initiate the controller
        $this->controller = new WeatherControllerMock();

        $this->controller->setDi($di);
    }

    /**
     * Test the route "index".
     */
    public function testIndexAction()
    {
        $res = $this->controller->indexAction();
        $this->assertIsObject($res);
    }

    /**
     * Test the route "vaildationActionPost".
     * success
     */
    public function testValidationActionIpPost()
    {
        global $di;

        $req = $di->get("request");
        $req->setPost("ipinput", "216.58.211.142");

        $res = $this->controller->validationActionPost();
        $this->assertIsObject($res);

        $req->setPost("ipinput", "216.58.");

        $res = $this->controller->validationActionPost();
        $this->assertIsObject($res);
    }

    /**
     * Test the route "vaildationActionPost".
     * success
     */
    public function testValidationActionPosPost()
    {
        global $di;

        $req = $di->get("request");
        $req->setPost("lon", "17.79");
        $req->setPost("lat", "5.69");

        $res = $this->controller->validationActionPost();
        $this->assertIsObject($res);

        $req->setPost("lon", "vbn");

        $res2 = $this->controller->validationActionPost();
        $this->assertIsObject($res2);
    }

    /**
     * Test the route "vaildationActionPost".
     * success
     */
    public function testValidationActionPosPostFail()
    {
        global $di;

        $req = $di->get("request");
        $req->setPost("lon", "17.79");
        $req->setPost("lat", "");

        $res = $this->controller->validationActionPost();
        $this->assertIsObject($res);
    }
}
