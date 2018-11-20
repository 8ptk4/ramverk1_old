<?php

namespace Patrik\IpValidator;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

class IpValidatorController implements ContainerInjectableInterface
{

    use ContainerInjectableTrait;



    /**
     * Validatei if IP is IPV4 or IPV6
     * @method validateIp
     * @param  string     $ipAddress
     * @return string
     */
    public function validateIp($ipAddress)
    {
        if (filter_var($ipAddress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            return "IPV4";
        } else if (filter_var($ipAddress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            return "IPV6";
        } else {
            return null;
        }
    }



    /**
     * Return domain för IP.
     * @method getDomain
     * @param  string    $ipAddress
     * @return string
     */
    public function getDomain($ipAddress, $status)
    {
        if (!empty($ipAddress and $status != null)) {
            return gethostbyaddr($ipAddress);
        } else {
            return "Verkar inte vara en gilltig ip-adress";
        }
    }



    /**
     * Request post and setup page.
     * @method indexAction
     * @return array
     */
    public function indexAction() : object
    {
        $title = "Ip Validator";
        $ipAddress = htmlentities($this->di->get("request")->getPost("ipAddress"));
        $status = $this->validateIp($ipAddress);
        $domain = $this->getDomain($ipAddress, $status);

        $page = $this->di->get("page");

        $page->add("anax/ipvalidator/index", [
            "title" => $title,
            "ipAddress" => $ipAddress,
            "status" => $status,
            "domain" => $domain,
        ]);

        return $page->render([
            "title" => $title,
        ]);
    }
}
