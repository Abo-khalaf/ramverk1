<?php
/**
 * Load the stylechooser as a controller class.
 */
return [
    "routes" => [
        [
            "info" => "Ip controller(JSON).",
            "mount" => "ip",
            "handler" => "Moody\ControllerIP\JsonController",
        ],
    ]
];
