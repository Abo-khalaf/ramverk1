<?php
namespace Moody\Controller;

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


    // /**
    //  * @var string $db a sample member variable that gets initialised
    //  */
    // private $db = "not active";
    // public function initialize() : void
    // {
    //     // Use to initialise member variables.
    //     $this->db = "active";
    // }

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
        $title = "Ip validator";

        $page = $this->di->get("page");
        $request = $this->di->get("request");
        $this->ipAddress = $request->getGet("ip");

        $this->object = new IpValidate();
        $protocol = $this->result($this->ipAddress, $this->object);
        $host = $this->object->getDomain($this->ipAddress);

        // $page = $this->di->get("page");
        $data["protocol"] = $protocol;
        $data["host"] = $host;
        $page->add("id/index", $data);
        return $page->render([
            "title" => $title,
        ]);
    }
}
