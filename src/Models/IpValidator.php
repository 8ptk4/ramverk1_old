<?php

namespace Patrik\Models;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

class IpValidator implements ContainerInjectableInterface
{

    use ContainerInjectableTrait;



    /**
     * IpAddress, Status, Domain
     * @var string
     */
    public $ipAddress;
    public $status;
    public $domain;



    /**
     * Set ip address.
     * @method __construct
     * @param  string      $ipAddress
     */
    public function __construct($ipAddress)
    {
        $this->ipAddress = $ipAddress;
    }



    /**
     * Validate if IP is IPV4 or IPV6
     * @method validateIp
     * @param  string     $ipAddress
     * @return string
     */
    public function validateIp()
    {
        if (filter_var($this->ipAddress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            $this->status = "IPV4";
        } else if (filter_var($this->ipAddress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            $this->status = "IPV6";
        } else {
            $this->status = null;
        }

        return $this->status;
    }



    /**
     * Return domain för IP.
     * @method getDomain
     * @param  string    $ipAddress
     * @return string
     */
    public function getDomain()
    {
        if (!empty($this->ipAddress and $this->status != null)) {
            $this->domain = gethostbyaddr($this->ipAddress);
        } else {
            $this->domain = "Verkar inte vara en gilltig ip-adress";
        }

        return $this->domain;
    }
}
