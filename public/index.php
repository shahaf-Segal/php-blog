<?php

declare(strict_types=1);

require_once __DIR__ . '/../bootstrap.php';

session_start();

use Core\Router;
use Core\View;

$router = new Router();
require_once __DIR__ . '/../routes.php';
require_once __DIR__ . '/../helpers.php';

View::globalShare('user', 'guest');

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_SERVER['REQUEST_METHOD'];
echo $router->dispatch($uri, $method);
