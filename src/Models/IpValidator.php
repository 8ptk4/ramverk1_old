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
    public $input;
    public $status;
    public $domain;



    /**
     * Set ip address.
     * @method __construct
     * @param  string      $ipAddress
     */
    public function __construct($input)
    {
        $this->validate($input);     
    }



    /**
     * Validate input if it is IPV4, IPV6 or latidude;longitude
     * @method validateIp
     * @param  string     $ipAddress
     * @return string
     */
    public function validate($input)
    {
        if (filter_var($input, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            $this->status = "IPV4";
            $this->domain = gethostbyaddr($input);
        } else if (filter_var($input, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            $this->status = "IPV6";
            $this->domain = gethostbyaddr($input);
        } else if (preg_match('/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?);[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/', $input)) {
            $this->status = explode( ';', $input );
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
        return $this->domain;
    }


    public function getStatus()
    {
        return $this->status;
    }
}
