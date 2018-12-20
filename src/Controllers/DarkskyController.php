<?php

namespace Patrik\Controllers;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Patrik\Models\Ipstack;
use Patrik\Models\IpValidator;
use Patrik\Models\DarkSky;

class DarkskyController implements ContainerInjectableInterface
{

    use ContainerInjectableTrait;



    /**
     * Request post and setup page.
     * @method indexAction
     * @return array
     */
    public function indexAction() : object
    {
        $title = "Darksky";

        $page = $this->di->get("page");

        $test = new DarkSky($this->di->get("darkSky"));

        $page->add("anax/darksky/index", [
            "title" => $title,
            "test" => $test->getInformation(),
        ]);

        return $page->render([
            "title" => $title,
        ]);
    }
}
