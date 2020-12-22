<?php
/**
 * Load the stylechooser as a controller class.
 */
return [
    "routes" => [
        [
            "info" => "weather_befor",
            "mount" => "weather_befor",
            "handler" => "Moody\weather_and_position\weather_befor",
        ],
    ]
];
