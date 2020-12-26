<?php

namespace Moody\ControllerIP;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * A sample controller to show how a controller class can be implemented.
 * The controller will be injected with $di if implementing the interface
 * ContainerInjectableInterface, like this sample class does.
 * The controller is mounted on a particular route and can then handle all
 * requests for that mount point.
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class JsonIpValidatorController1Test extends TestCase
{
    protected $di;
    protected $controller;


    /**
     * Prepare before each test.
     */
    protected function setUp()
    {
        global $di;


        $this->di = new DIFactoryConfig();
        $this->di->loadServices(ANAX_INSTALL_PATH . "/config/di");
        $di->get("cache")->setPath(ANAX_INSTALL_PATH . "/test/cache");
        $di = $this->di;

        // Setup the controller
        $this->controller = new JsonIpValidatorController1();
        $this->controller->setDI($this->di);
        //$this->controller->initialize();
    }


    public function testResult()
    {
        $res = $this->controller->indexAction();
        $this->assertInternalType("array", $res);
    }




    public function testResult2()
    {
        $res = $this->controller->jsonIpActionGet();
        $this->assertInternalType("array", $res);
    }


    public function testipJson()
    {
        $object = new IpValidate();
        $res = $this->controller->ipToJson("193.11.187.229", $object);
        $this->assertInternalType("array", $res);

    }

}
