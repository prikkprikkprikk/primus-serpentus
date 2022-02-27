<?php

namespace App;

use App\ApiController;

require_once('../vendor/autoload.php');
require_once('../src/config.php');

define('APP_ROOT', dirname(__FILE__,2));

$requestUri = strtok($_SERVER['REQUEST_URI'], '?');

ApiController::handle($requestUri);
