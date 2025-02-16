<?php

declare(strict_types=1);
require_once __DIR__ . '/vendor/autoload.php';
$config = require_once __DIR__ . '/config.php';

use Core\App;
use Core\DataBase;
use Core\ErrorHandler;

set_exception_handler([ErrorHandler::class, 'handleException']);
set_error_handler([ErrorHandler::class, 'handleError']);

App::bind('config', $config);
App::bind('database', new DataBase($config['database']));
