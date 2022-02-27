<?php

namespace App;

use App\ApiController;

define('APP_ROOT', dirname(__FILE__,2));

require_once(APP_ROOT . '/vendor/autoload.php');
require_once(APP_ROOT . '/src/config.php');
require_once(APP_ROOT . '/src/monolog.php');

$requestUri = strtok($_SERVER['REQUEST_URI'], '?');

ApiController::handle($requestUri);
