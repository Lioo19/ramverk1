<?php
/**
* config file for DI container
*
*/
return [
    //services to add to container
    "services" => [
        "iptest" => [
            "callback" => function () {
                $iptest = new \Lioo19\Models\IpTest();
                return $iptest;
            }
        ]
    ]
];
