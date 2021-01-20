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
class weather_after implements ContainerInjectableInterface
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
        $arrIconNext = [];
        $dateArrayNext = [];
        $wrStatusArrayNext = [];
        $weatherStatus = [];
        $tempArrayNext = [];
        $title = "Ip validator";
        $page = $this->di->get("page");
        $request = $this->di->get("request");
        $this->ipAddress = $request->getGet("ip");

        $ip = $this->ipAddress;

        $this->object = $this->di->get("IpValidate");
        $this->openWeatherMapModel = $this->di->get("openWeatherMap");
        $this->object->getDetails();
        
        foreach ($this->openWeatherMapModel as $key => $value) :
            $this->object->setMessage($value);
        endforeach;


        $protocol = $this->result($this->ipAddress, $this->object);
        $host = $this->object->getDomain($this->ipAddress);
        $address = $this->object->getAddress($this->ipAddress);
        $latitude =  $address["latitude"] ??null;
        $longitude = $address["longitude"] ??null;
        
        
        $weatherSet = $this->object->setWeather($latitude, $longitude);
        // $weatherSet2 = $this->object->setWeather2($latitude, $longitude);
        
        $weatherGet = $this->object->getWeather();
        // $weatherGet2 = $this->object->getWeather2();
        $getData = $this->object->getData($weatherGet);
        // $getDataArray = $this->object->getDataArray($weatherGet2);

        $getInfoDaily = $getData["daily"] ?? null;

        if (is_array($getInfoDaily) || is_object($getInfoDaily)) {
            foreach ($getInfoDaily as $value1) {
                $weatherStatus = $value1["weather"][0]["main"] ?? null;
                array_push($wrStatusArrayNext, $weatherStatus);

                $date = date("d/m", $value1["dt"] ?? null);
                array_push($dateArrayNext, $date);

                $icon = $value1["weather"][0]["icon"] ?? null;
                array_push($arrIconNext, $icon);

                array_push($tempArrayNext, round($value1["temp"]["day"] ?? null, 0));
            }
        }
        // var_dump($arrIconNext);

        // var_dump($arrIconNext);

        $ip = $this->object->getCurrentIp($this->ipAddress);
        $Domain = $this->object->getDomain($this->ipAddress);

        $json = $this->ipJson($this->ipAddress, $this->object);
        $data['json'] = $json;
        $data['arrIconNext'] = $arrIconNext;
        $data['dateArrayNext'] = $dateArrayNext;

        

        $data["ip"] = $ip;
        $data["protocol"] = $protocol;
        $data["host"] = $host;
        $data["address"] = $address;
        $data["Domain"] = $Domain;
        $data["latitude"] = $latitude;
        $data["longitude"] = $longitude;
        $data["weatherSet"] = $weatherSet;
        // $data["weatherSet2"] = $weatherSet2;
        $data["getData"] = $getData;
        // $data["getDataArray"] = $getDataArray;


        // var_dump($getData);



        $page->add("weather/after", $data);
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
            "address" => $object->getData($this->object->getWeather()) ?? null
        ];
        return [$json];
    }
}
