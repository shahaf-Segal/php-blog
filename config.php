<?php
return [
    "app" => [
        "name" => "My Blog",
        "debug" => true
    ],
    "database" => [
        "driver" => "sqlite",
        "path" => dirname(__DIR__) . "/database/blog.sqlite"
    ]
];
