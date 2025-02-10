<?php
return [
    "app" => [
        "name" => "My Blog",
        "debug" => true
    ],
    "database" => [
        "driver" => "sqlite",
        "dbname" => dirname(__DIR__) . "/database/blog.sqlite"
    ]
];
