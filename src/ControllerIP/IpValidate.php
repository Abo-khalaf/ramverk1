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




class IpValidate implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

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
}
