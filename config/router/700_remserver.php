<?php
/**
 * Controller for the REM server.
 */
return [
    "mount" => "remserver",
    "routes" => [
        [
            "info" => "Get a dataset from the REM server.",
            "method" => "get",
            "path" => "{dataset:alphanum}",
            "handler" => ["\Anax\RemServer\RemServerController", "getDataset"],
        ],
        [
            "info" => "Get an item from the REM server.",
            "method" => "get",
            "path" => "{dataset:alphanum}/{id:digit}",
            "handler" => ["\Anax\RemServer\RemServerController", "getItem"],
        ],
        [
            "info" => "Post/add an item in the REM server.",
            "method" => "post",
            "path" => "{dataset:alphanum}",
            "handler" => ["\Anax\RemServer\RemServerController", "postItem"],
        ],
        [
            "info" => "Upsert/replace an item in the REM server.",
            "method" => "put",
            "path" => "{dataset:alphanum}/{id:digit}",
            "handler" => ["\Anax\RemServer\RemServerController", "putItem"],
        ],
        [
            "info" => "Delete an item in the REM server.",
            "method" => "delete",
            "path" => "{dataset:alphanum}/{id:digit}",
            "handler" => ["\Anax\RemServer\RemServerController", "deleteItem"],
        ],
        [
            "info" => "REM server with REST JSON API.",
            "handler" => "\Anax\RemServer\RemServerController",
        ],
    ]
];
