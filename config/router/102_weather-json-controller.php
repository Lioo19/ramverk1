<?php
/**
 * Load the ip-json as a controller class.
 */
return [
    "routes" => [
        [
            "info" => "WEATHER-JSON",
            "mount" => "weather-json",
            "handler" => "\Lioo19\Controller\WeatherJSONController",
        ],
    ]
];
