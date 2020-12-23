<?php
/**
 * Configuration file for DI container.
 */
return [

    // Services to add to the container.
    "services" => [
        "IpValidate" => [
            "shared" => true,
            //"callback" => "\Anax\Response\Response",
            "callback" => function () {
                $ipValidate = new \Moody\weather_and_position\IpValidate();
                return $ipValidate;
            }
        ],
    ],
];
