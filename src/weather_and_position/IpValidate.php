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




class IpValidate implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;
    protected $weatherAPI_next = "";
    protected $weatherApiArr = [];
    public $message= "193.11.187.229";


    /**
     * Sets the api from the config file
     * into the controller.
     *
     */
    public function setMessage($message) : void
    {
        $this->message = $message;
    }





 /**
     * returns the api from the config file "ipstackcfg"
     *
     */
    public function getDetails() : string
    {
        return $this->message;
    }







    /**
     * Check if IP is valid or not.
     * GET ip
     *
     * @return string
     */

    public function getProtocol($ipAddress)
    {
        if (filter_var($ipAddress, FILTER_VALIDATE_IP)) {
            if (filter_var($ipAddress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
                return "IPv4";
            }
            if (filter_var($ipAddress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
                return "IPv6";
            }
        }
        return false;
    }
        /**
    * Check if IP is valid or not.
    * GET  domain
    *
    * @return string
    */
    public function getDomain($ipAddress)
    {
        if (filter_var($ipAddress, FILTER_VALIDATE_IP)) {
            return gethostbyaddr($ipAddress);
        }
        return "Not valid";
    }


    public function getCurrentIp()
    {
        return $_SERVER["193.11.187.229"] ?? '193.11.187.229';
    }



    public function getAddress($ipAddress)
    {
        $the_access_key = "9ffbd83fca588b355bff399b8da7526f";
        $theUrl  = "http://api.ipstack.com/";
        $req = curl_init($theUrl . $ipAddress . "?access_key=" . $the_access_key . '');
        curl_setopt($req, CURLOPT_RETURNTRANSFER, true);
        $json = curl_exec($req);
        curl_close($req);
        $result = json_decode($json, 'JAON_PRETTY_PRINT');
        return $result;
    }

    public function setWeather($latitude, $longitude) : void
    {
        $options = '&exclude=current,minutely,hourly,alerts&units=metric&lang=en';
        $baseUrl = 'https://api.openweathermap.org/data/2.5/onecall?';
        $the_access_key = "7baa582f6085fc9b4bcfbaceac7ff994";

        $this->weatherAPI_next = $baseUrl . 'lat=' . $latitude . '&lon=' .
            $longitude . $options .  '&appid=' . $this->message;
    }

    public function getWeather()
    {
        return  $this->weatherAPI_next;
    }




    /**
     * Gets the Geo Location info in
     * Gets the Geo Location info in
     * an array
     *
     */
    public function getData(String $weatherApi)
    {
        // create & initialize a curl session
        $curl = curl_init($weatherApi);

        // set our url with curl_setopt()
        curl_setopt($curl, CURLOPT_URL, $weatherApi);

        // return the transfer as a string, also with setopt()
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        // curl_exec() executes the started curl session
        // $output contains the output string
        $output = curl_exec($curl);

        // close curl resource to free up system resources
        // (deletes the variable made by curl_init)
        curl_close($curl);

        $apiResult = json_decode($output, true);
        return $apiResult;
    }





     /**
     * Sets the api from the config file
     * into the controller.
     *
     */
    public function setWeather2($latitude, $longitude) : void
    {
        $the_access_key = "7baa582f6085fc9b4bcfbaceac7ff994";


        $options = '&exclude=minutely,hourly,alerts&units=metric&lang=en';
        $baseUrl = 'http://api.openweathermap.org/data/2.5/onecall/timemachine?';
        for ($i = -5; $i <= -1; $i++) {
            $datePrevious = strtotime("$i days");
            array_push($this->weatherApiArr, $baseUrl . 'lat=' . $latitude . '&lon=' .
                $longitude . '&dt=' . $datePrevious . $options . '&appid=' . $this->message);
        }
    }


    public function getWeather2()
    {
        return  $this->weatherApiArr;
    }

    public function getDataArray(array $urls)
    {

        $options = [
            CURLOPT_RETURNTRANSFER => true,
        ];

        // Add all curl handlers and remember them
        // Initiate the multi curl handler
        $multiCurl = curl_multi_init();
        $chAll = [];
        foreach ($urls as $url) {
            $ch = curl_init("$url");
            curl_setopt_array($ch, $options);
            curl_multi_add_handle($multiCurl, $ch);
            $chAll[] = $ch;
        }

        // Execute all queries simultaneously,
        // and continue when all are complete
        $running = null;
        do {
            curl_multi_exec($multiCurl, $running);
        } while ($running);

        // Close the handles
        foreach ($chAll as $ch) {
            curl_multi_remove_handle($multiCurl, $ch);
        }


        curl_multi_close($multiCurl);

        // All of our requests are done, we can now access the results
        $response = [];
        foreach ($chAll as $ch) {
            $data = curl_multi_getcontent($ch);
            $response[] = json_decode($data, true);
        }
        return $response;
    }
}
