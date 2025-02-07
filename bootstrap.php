<?php

declare(strict_types=1);

require_once __DIR__ . '/error_handling.php';

ini_set('display_errors', '0');
error_reporting(E_ALL);
set_exception_handler('errorHandler');

const INCLUDES_DIR = __DIR__ . '/includes';
const ROUTES_DIR = __DIR__ . '/routes';
const STYLES_DIR = __DIR__ . '/styles';
const TEMPLATES_DIR = __DIR__ . '/templates';
const DB_DIR = __DIR__ . '/db';

require_once INCLUDES_DIR . '/router.php';
require_once INCLUDES_DIR . '/db.php';
