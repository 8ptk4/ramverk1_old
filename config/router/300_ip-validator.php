<?php
/**
 * Load the ipvalidator as a controller class.
 */
return [
    "routes" => [
        [
            "info" => "Ip Validator",
            "mount" => "ipvalidator",
            "handler" => "\Patrik\Controllers\IpValidatorController",
        ]
    ]
];
