<?php

use Core\App;

require_once __DIR__ . '/../bootstrap.php';

echo "Loading schema...";

$database = App::get('database');

$schemafile = __DIR__ . '/../database/schema.sql';
$sql = file_get_contents($schemafile);

try {
    $parts = explode(';', $sql);
    var_dump($parts);
    die;
} catch (PDOException $e) {
    throw new Exception("Unable to connect to DB");
}
