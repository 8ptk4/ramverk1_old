<?php

namespace Patrik\Controllers;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Patrik\Models\Ipstack;
use Patrik\Models\IpValidator;

class GeolocationController implements ContainerInjectableInterface
{

    use ContainerInjectableTrait;



    /**
     * Request post and setup page.
     * @method indexAction
     * @return array
     */
    public function indexAction() : object
    {
        $title = "Geolocation";
        $ipPost = htmlentities($this->di->get("request")->getPost("ipAddress"));
        $ipUser = htmlentities($this->di->get("request")->getServer("REMOTE_ADDR"));

        $ipStack = new IpStack($ipPost);
        $validator = new IpValidator($ipPost);

        $page = $this->di->get("page");

        $page->add("anax/geolocation/index", [
            "title" => $title,
            "data" => $ipStack->getInformation(),
            "ipAddress" => $ipPost,
            "status" => $validator->validateIp(),
            "domain" => $validator->getDomain(),
            "userIp" => $ipUser,
        ]);

        return $page->render([
            "title" => $title,
        ]);
    }
}
