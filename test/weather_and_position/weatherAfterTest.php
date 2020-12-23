<?php

namespace Moody\weather_and_position;

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
class weather_afterTest extends TestCase
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
        $this->controller = new weather_after();
        $this->controller->setDI($this->di);
        //$this->controller->initialize();
    }

    public function testResult()
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
