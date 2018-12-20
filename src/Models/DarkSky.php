<?php

namespace Patrik\Models;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

class DarkSky implements ContainerInjectableInterface
{

    use ContainerInjectableTrait;



    /**
     * IpAddress, API key
     * @var string
     */
    protected $accessKey;



    /**
     * Set ip address.
     * @method __construct
     * @param  string      $ipAddress
     */
    public function __construct($key)
    {
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
        $init = curl_init('https://api.darksky.net/forecast/' . $this->accessKey . '/42.3601,-71.0589');
        curl_setopt($init, CURLOPT_RETURNTRANSFER, true);

        // Store the data:
        $json = curl_exec($init);
        curl_close($init);

        // Decod JSON response:
        return json_decode($json, true);
    }
}
