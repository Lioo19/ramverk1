<?php
/**
 * Load the ip-json as a controller class.
 */
return [
    "routes" => [
        [
            "info" => "IP-JSON",
            "mount" => "ip-json",
            "handler" => "\Lioo19\Controller\IpTestJSONController",
        ],
    ]
];
