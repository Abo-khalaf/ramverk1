<?php
/**
 * Load the stylechooser as a controller class.
 */
return [
    "routes" => [
        [
            "info" => "weather",
            "mount" => "weather",
            "handler" => "Moody\weather_and_position\indexs",
        ],
    ]
];
