<?php
/**
 * Load the darksky as a controller class.
 */
return [
    "routes" => [
        [
            "info" => "DarkSky",
            "mount" => "darksky",
            "handler" => "\Patrik\Controllers\DarkskyController",
        ]
    ]
];
