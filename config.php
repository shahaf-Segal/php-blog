<?php
return [
    "app" => [
        "name" => "My Blog",
        "debug" => true,
        "error_log" => __DIR__ . "/logs/error.log"
    ],
    "database" => [
        "driver" => "sqlite",
        "dbname" => __DIR__ . "/database/blog.sqlite"
    ]
];
