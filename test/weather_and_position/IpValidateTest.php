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


        $this->di = new DIFactoryConfig();
        $this->di->loadServices(ANAX_INSTALL_PATH . "/config/di");
        $di->get("cache")->setPath(ANAX_INSTALL_PATH . "/test/cache");
        $di = $this->di;

        // Setup the controller
        $this->controller = new IpValidate();
        $this->controller->setDI($this->di);
        //$this->controller->initialize();
    }

    public function testgetDetails()
    {
        $object = new IpValidate();
        $res = $this->controller->getDetails();
        $this->assertInternalType('string', $res);
    }

    public function testgetDomain()
    {
        $object = new IpValidate();
        $res = $this->controller->getDomain("193.11.187.229");
        $this->assertInternalType('string', $res);
    }



    public function testgetProtocoll()
    {
        $object = new IpValidate();
        $res = $this->controller->getProtocol("193.11.187.229");
        $this->assertContains("IPv4", $res);
    }


    public function testgetProtocoll2()
    {
        $object = new IpValidate();
        $res = $this->controller->getProtocol("2001:6b0:2a:c280:4c64:5ef8:f1da:a924");
        $this->assertContains("IPv6", $res);
    }

    public function testgetProtocolInput()
    {
        $test = "s";
        $res = $this->controller->getProtocol($test);
        $this->assertFalse($res);
    }




    public function testgetaddress()
    {
        $object = new IpValidate();
        $ipAddress = "193.11.187.229";
        $res = $this->controller->getaddress($ipAddress);
        $this->assertInternalType('array', $res);
    }



    
    public function testgetweather()
    {
        $object = new IpValidate();
        $res = $this->controller->getweather();
        $this->assertInternalType('string', $res);
    }


    public function testgetweather2()
    {
        $object = new IpValidate();
        $res = $this->controller->getweather2();
        $this->assertInternalType('array', $res);
    }

    public function testgetCurrentIp()
    {
        $object = new IpValidate();
        $res = $this->controller->getCurrentIp();
        $this->assertInternalType('string', $res);
    }




    
    public function testGetData()
    {
        $enteredIp = "193.11.187.229";
        $geoApi = "test";
        $geoUrl = "http://api.ipstack.com/". $enteredIp . "?access_key=" . $geoApi .
        '&hostname=1&security=1';
        $getData = $this->controller->getData($geoUrl);

        $this->assertInternalType("array", $getData);
    }

    public function testGetDataArray()
    {
        $enteredIp = "193.11.187.229";
        $geoApi = "test";
        $geoUrl = "http://api.ipstack.com/". $enteredIp . "?access_key=" . $geoApi .
        '&hostname=1&security=1';

        $geoUrlArray = [
            "res11" => $geoUrl,
            "res22" => $geoUrl,
            "res33" => $geoUrl,
        ];

        $getDataArray = $this->controller->getDataArray($geoUrlArray);

        $this->assertInternalType("array", $getDataArray);
    }


}
