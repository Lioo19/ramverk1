<?php

namespace Lioo19\Controller;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Test the SampleController.
 */
class GeoControllerTest extends TestCase
{

    /**
     * Setup the controller, before each testcase, just like the router
     * would set it up.
     */
    protected function setUp(): void
    {
        global $di;

        // Init service container $di to contain $app as a service
        $di = new DIFactoryConfig();
        $di->loadServices(ANAX_INSTALL_PATH . "/config/di");
        $di->loadServices(ANAX_INSTALL_PATH . "/test/config_/di");

        //set a test-cache for tests
        $di->get("cache")->setPath(ANAX_INSTALL_PATH . "/test/cache");

        // Create and initiate the controller
        $this->controller = new GeoControllerMock();

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
    public function testValidationActionPost()
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
}
