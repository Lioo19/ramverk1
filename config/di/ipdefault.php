<?php
/**
*
*/
return [
    "services" => [
        "ipdefault" => [
            "callback" => function () {
                $ipdefault = new \Lioo19\Models\IpDefault();
                return $ipdefault;
            }
        ]
    ]
];
