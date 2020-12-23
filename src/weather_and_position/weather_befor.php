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
class weather_befor implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    protected $ipAddress;
    protected $object;



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
        // $address = null;
        // $latitude = null;
        // $longitude = null;

        $title = "Ip validator";
        $page = $this->di->get("page");
        $request = $this->di->get("request");
        $this->ipAddress = $request->getGet("ip");
        $ip = $this->ipAddress;

        $this->object = $this->di->get("IpValidate");


        $this->openWeatherMapModel = $this->di->get("openWeatherMap");


        foreach ($this->openWeatherMapModel as $key => $value) :
            $this->object->setMessage($value);
        endforeach;



        $protocol = $this->result($this->ipAddress, $this->object);
        $host = $this->object->getDomain($this->ipAddress);
        $address = $this->object->getAddress($this->ipAddress);
        $latitude =  $address["latitude"] ??null;
        $longitude = $address["longitude"] ??null;
        // var_dump($latitude);
        // var_dump($longitude);
        
        
        // $weatherSet = $this->object->setWeather($latitude, $longitude);
        $weatherSet2 = $this->object->setWeather2($latitude, $longitude);
        
        // $weatherGet = $this->object->getWeather();
        $weatherGet2 = $this->object->getWeather2();
        

        // $getData = $this->object->getData($weatherGet);
        $getDataArray = $this->object->getDataArray($weatherGet2);





        $ip = $this->object->getCurrentIp($this->ipAddress);
        $Domain = $this->object->getDomain($this->ipAddress);

        $json = $this->ipJson($this->ipAddress, $this->object);
        $data['json'] = $json;
        $data["ip"] = $ip;
        $data["protocol"] = $protocol;
        $data["host"] = $host;
        $data["address"] = $address;
        $data["Domain"] = $Domain;
        $data["latitude"] = $latitude;
        $data["longitude"] = $longitude;
        // $data["weatherSet"] = $weatherSet;
        $data["weatherSet2"] = $weatherSet2;
        // $data["getData"] = $getData;
        $data["getDataArray"] = $getDataArray;


        // var_dump($getDataArray);



        $page->add("weather/befor", $data);
        return $page->render([
            "title" => $title,
        ]);
    }



    public function ipJson($ipAddress, $object) : array
    {
        $json = [
            "ip" => $ipAddress,
            "Protocol" => $object->getProtocol($ipAddress) ?? null,
            "Domain" => $object->getDomain($ipAddress) ?? null,
            "address" => $object->getDataArray($this->object->getWeather2()) ?? null
        ];
        return [$json];
    }
}
