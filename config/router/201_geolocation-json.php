<?php
/**
 * Load the ipvalidator as a controller class.
 */
return [
    "routes" => [
        [
            "info" => "Geolocation JSON",
            "mount" => "geo",
            "handler" => "\Patrik\Controllers\GeolocationJsonController",
        ],
    ]
];
