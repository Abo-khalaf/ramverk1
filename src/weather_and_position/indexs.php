<?php

namespace Moody\weather_and_position;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;



/**
 * A sample controller to show how a controller class can be implemented.
 * The controller will be injected with $di if implementing the interface
 * ContainerInjectableInterface, like this sample class does.
 * The controller is mounted on a particular route and can then handle all
 * requests for that mount point.
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class indexs implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    protected $ipAddress;
    protected $object;


    public function indexAction() : object
    {
        $host = null;
        $title = "Ip validator";
        $page = $this->di->get("page");
        $request = $this->di->get("request");
        $this->object = new IpValidate();

        $this->openWeatherMapModel = $this->di->get("openWeatherMap");
        $host = $this->object->getDomain($this->ipAddress);
        $data["host"] = $host;

        $page->add("weather/index", $data);
        return $page->render([
            "title" => $title,
        ]);
    }
}
