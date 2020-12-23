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
class IpValidateTest extends TestCase
{
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

        $di = $this->di;

        // Setup the controller
        $this->controller = new IpValidate();
        $this->controller->setDI($this->di);
        //$this->controller->initialize();
    }





    public function testgetProtocol()
    {
        $object = new IpValidate();
        $res = $this->controller->getProtocol("193.11.187.229");
        $this->assertContains("IPv4", $res);
    }


    public function testgetProtocol2()
    {
        $object = new IpValidate();
        $res = $this->controller->getProtocol("2001:6b0:2a:c280:4c64:5ef8:f1da:a924");
        $this->assertContains("IPv6", $res);
    }
}
