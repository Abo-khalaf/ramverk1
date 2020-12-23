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
class IpControllerTest extends TestCase
{
    // use ContainerInjectableTrait;

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
        $this->controller = new IpController();
        $this->controller->setDI($this->di);
        //$this->controller->initialize();
    }



    /**
    *Call the Controller inedex action
    */
    public function testIndexAction()
    {
        $res = $this->controller->indexAction();
        $this->assertInternalType("object", $res);
    }




    public function testGetProtocolResultTrue()
    {
        $object = new IpValidate();
        $res = $this->controller->Result("186.151.62.176", $object);
        $this->assertInternalType("string", $res);
    }
}
