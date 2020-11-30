<?php
namespace Moody\ControllerIP;

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
class IpController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    private $ipAddress;
    private $object;


    public function result($ipAddress, $object) : string
    {
        if ($object->getProtocol($ipAddress)) {
            return "The IP $ipAddress is a valid " . $object->getProtocol($ipAddress) ." address." ;
        }
        return "The IP $ipAddress is not a valid ip-Address.";
    }

    public function indexAction() : object
    {
        // Deal with the action and return a response.
        $protocol =  null;
        $host = null;
        $address = null;

        $title = "Ip validator";
        $page = $this->di->get("page");
        $request = $this->di->get("request");
        $this->ipAddress = $request->getGet("ip");
        $ip = $this->ipAddress;

        $this->object = new IpValidate();
        $protocol = $this->result($this->ipAddress, $this->object);
        $host = $this->object->getDomain($this->ipAddress);
        $address = $this->object->getAddress($this->ipAddress);
        $ip = $this->object->getCurrentIp($this->ipAddress);
        $Domain = $this->object->getDomain($this->ipAddress);


        $data["ip"] = $ip;
        $data["protocol"] = $protocol;
        $data["host"] = $host;
        $data["address"] = $address;
        $data["Domain"] = $Domain;


        $page->add("id/index", $data);
        return $page->render([
            "title" => $title,
        ]);
    }
}
