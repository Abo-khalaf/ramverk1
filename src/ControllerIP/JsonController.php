<?php

namespace Moody\ControllerIP;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

/**
 * A sample controller to show how a controller class can be implemented.
 * The controller will be injected with $di if implementing the interface
 * ContainerInjectableInterface, like this sample class does.
 * The controller is mounted on a particular route and can then handle all
 * requests for that mount point.
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class JsonController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    private $ipAddress;
    private $object;


    public function indexAction() : object
    {
        $title = "Check IP with (JSON)";

        $page = $this->di->get("page");
        $request = $this->di->get("request");
        $json = null;
        $this->ipAddress = $request->getGet("ip");
        $this->object = new IpValidate();
        
        $ip = $this->ipAddress;
        $ip = $this->object->getCurrentIp($this->ipAddress);
        $Domain = $this->object->getDomain($this->ipAddress);



        $json = $this->ipJson($this->ipAddress, $this->object);
        $data['json'] = $json;
        $data["ip"] = $ip;
        $data["Domain"] = $Domain;

        $page->add("id/json", $data);
        return $page->render([
            "title" => $title,
        ]);
    }


    public function ipJson($ipAddress, $object) : array
    {
        $json = [
            "ip" => $ipAddress,
            // "ip" => $ip,

            "Protocol" => $object->getProtocol($ipAddress) ?? null,
            "Domain" => $object->getDomain($ipAddress) ?? null,
            "address" => $object->getAddress($ipAddress) ?? null,
        ];
        return [$json];
    }
}
