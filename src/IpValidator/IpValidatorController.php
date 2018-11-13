<?php

namespace Patrik\IpValidator;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

class IpValidatorController implements ContainerInjectableInterface
{

    use ContainerInjectableTrait;

    /**
     * Page title.
     * @var $title
     */
    public $title = "Ip Validator";
    /**
     * IpAdress to be used gather information from.
     * @var $ipAdress
     */
    public $ipAdress;
    /**
     * Domain if there are any, base on ipAdress.
     * @var $domain
     */
    public $domain;
    /**
     * Holds the information about if IP is valid or not.
     * @var $status
     */
    public $status;



    /**
     * Validate IP to check whether its IPV4, IPV6 or none.
     * @method validateIp
     * @return string     valid ipv4, ipv6 information.
     */
    public function validateIp()
    {
        if (filter_var($this->ipAdress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            $this->setDomain();
            $this->status = $this->ipAdress . " is a valid IPV4 address.";
        } else if (filter_var($this->ipAdress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            $this->setDomain();
            $this->status = $this->ipAdress . " is a valid IPV6 address.";
        } else {
            $this->status = $this->ipAdress . " is not a valid IP address.";
        }
    }



    /**
     * Get the ip.
     * @method getIp
     * @return string with ip.
     */
    public function getIp()
    {
        return $this->ipAdress;
    }



    /**
     * Set ip.
     * @method setIp
     * @param  string $ipAdress IP from form.
     */
    public function setIp($ipAdress)
    {
        $this->ipAdress = $ipAdress;
    }



    /**
     * Set the domain of the ip.
     * @method setDomain
     * @return string    set $this->domain with domain information.
     */
    public function setDomain()
    {
        $domain = gethostbyaddr($this->getIp());

        if ($domain == $this->getIp()) {
            $this->domain = "No name of the Internet host.";
        } else {
            $this->domain = "$domain is the name of the Internet host.";
        }
    }



    /**
     * Request post and setup page.
     * @method indexAction
     * @return array
     */
    public function indexAction() : object
    {
        $page = $this->di->get("page");

        $newIp = $this->di->get("request")->getPost("ipAdress");
        $this->ipAdress = htmlentities($newIp);
        $this->validateIp($this->ipAdress);

        $page->add("anax/ipvalidator/index", [
            "title" => $this->title,
            "ipAdress" => $this->ipAdress,
            "status" => $this->status,
            "domain" => $this->domain,
        ]);

        return $page->render([
            "title" => $this->title,
        ]);
    }
}
