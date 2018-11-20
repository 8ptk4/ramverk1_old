<?php

namespace Patrik\IpValidator;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

class IpValidatorJsonController implements ContainerInjectableInterface
{

    use ContainerInjectableTrait;

    /**
     * Request get and setup json array.
     * @method indexAction
     * @return array
     */
    public function indexActionGet() : array
    {
        $controller = new IpValidatorController();

        $ipAddress = htmlentities($this->di->get("request")->getGet("ipAddress"));
        $status = $controller->validateIp($ipAddress);
        $domain = $controller->getDomain($ipAddress, $status);

        $json = [
            "ipAddress" => $ipAddress,
            "status" => $status,
            "domain" => $domain,
        ];

        return [$json];
    }
}
