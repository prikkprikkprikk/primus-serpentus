<?php

namespace App;

require_once('../vendor/autoload.php');
require_once('../src/config.php');

use App\ApiController;

$requestUri = strtok($_SERVER['REQUEST_URI'], '?');

ApiController::handle($requestUri);
