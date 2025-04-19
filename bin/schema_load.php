<?php

use Core\App;

require_once __DIR__ . '/../bootstrap.php';

$database = App::get('database');

$schemafile = __DIR__ . '/../database/schema.sql';
$sql = file_get_contents($schemafile);

echo "Loading schema...\n";
try {
    $parts = array_filter(explode(';', $sql));
    foreach ($parts as $part) {
        $database->query($part);
    }
    echo "db schema loaded\n";
} catch (PDOException $e) {
    throw new Exception("Unable to connect to DB");
}
