<?php
/**
 * Load the ipvalidator as a controller class.
 */
return [
    "routes" => [
        [
            "info" => "REST Ip Validator",
            "mount" => "ip-json",
            "handler" => "\Patrik\IpValidator\IpValidatorJsonController",
        ],
    ]
];
