<?php
/**
 * Load the ipvalidator as a controller class.
 */
return [
    "routes" => [
        [
            "info" => "Geolocation",
            "mount" => "geolocation",
            "handler" => "\Patrik\Controllers\GeolocationController",
        ]
    ]
];
