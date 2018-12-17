<?php
/**
 * Configuration file for DI container.
 */
return [

    // Services to add to the container.
    "services" => [
        "apikeys" => [
            "callback" => function () {
                $obj = [
                    "ipStack" => "hashdahsd",
                    "darkSky" => "muahhahasdasda",
                ];

                return $obj;
            }
        ],
    ],
];
