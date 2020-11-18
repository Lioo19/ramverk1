<?php
/**
*
*/
return [
    "services" => [
        "validator" => [
            "shared" => true,
            "callback" => function() {
                $object = new \Anax\Models\IPDefault();
                $object->setDi($this);
                return $object;
            }
        ]
    ]
]
 ?>
