<?php
/**
* config file for DI container
*
*/
return [
    //services to add to container
    "services" => [
        "ipgeo" => [
            "callback" => function () {
                $ipgeo = new \Lioo19\Models\IpGeo();
                return $ipgeo;
            }
        ]
    ]
];
