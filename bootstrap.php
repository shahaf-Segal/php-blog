<?php

declare(strict_types=1);
require_once __DIR__ . '/vendor/autoload.php';

$config = require __DIR__ . '/config.php';

use Core\App;

App::bind('config', $config);
