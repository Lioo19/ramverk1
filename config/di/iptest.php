<?php
/**
*
*/
return [
    "services" => [
        "validator" => [
            "shared" => true,
            "callback" => function() {
                $object = new \Anax\Models\IPTest();
                $object->setDi($this);
                return $object;
            }
        ]
    ]
]
 ?>
