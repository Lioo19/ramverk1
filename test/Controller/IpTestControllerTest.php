<?php

namespace Lioo19\Controller;

use Anax\DI\DIFactoryConfig;
use Anax\DI\DIMagic;
use PHPUnit\Framework\TestCase;

/**
 * Test the SampleController.
 */
class IpTestControllerTest extends TestCase
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
        $this->controller = new IpTestControllerMock();

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
        $req->setPost("ipinput", "194.47.129.122");

        $res = $this->controller->validationActionPost();
        $req->setPost("ipinput", "216.58.");

        $res = $this->controller->validationActionPost();
        $this->assertIsObject($res);
    }
}
