<?php
/**
 * Load the stylechooser as a controller class.
 */
return [
    "routes" => [
        [
            "info" => "weather_after",
            "mount" => "weather_after",
            "handler" => "Moody\weather_and_position\weather_after",
        ],
    ]
];
