<?php

namespace Patrik\Models;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

class IpStack implements ContainerInjectableInterface
{

    use ContainerInjectableTrait;



    /**
     * IpAddress, API key
     * @var string
     */
    public $ipAddress;
    protected $accessKey;



    /**
     * Set ip address.
     * @method __construct
     * @param  string      $ipAddress
     */
    public function __construct($ipAddress, $key)
    {
        $this->ipAddress = $ipAddress;
        $this->accessKey = $key;
    }



    /**
     * Recieve values from ipstack API
     * @method getInformation
     * @return object
     */
    public function getInformation()
    {
        // Initialize CURL:
        $init = curl_init('http://api.ipstack.com/'.$this->ipAddress.'?access_key='.$this->accessKey.'');
        curl_setopt($init, CURLOPT_RETURNTRANSFER, true);

        // Store the data:
        $json = curl_exec($init);
        curl_close($init);

        // Decod JSON response:
        return json_decode($json, true);
    }
}
