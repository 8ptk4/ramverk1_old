<?php

namespace Patrik\Controllers;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Patrik\Models\Ipstack;
use Patrik\Models\IpValidator;

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

        $page->add("anax/darksky/index", [
            "title" => $title,
        ]);

        return $page->render([
            "title" => $title,
        ]);
    }
}
