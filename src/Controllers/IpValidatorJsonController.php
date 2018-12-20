<?php

namespace Patrik\Controllers;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Patrik\Models\IpValidator;

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
        $ipAddress = htmlentities($this->di->get("request")->getGet("ipAddress"));
        $ipValidator = new IpValidator($ipAddress);

        $json = [
            "ipAddress" => $ipAddress,
            "status" => $ipValidator->getStatus(),
            "domain" => $ipValidator->getDomain(),
        ];

        return [$json];
    }
}
