<?php

namespace App;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Formatter\LineFormatter;

// Create the logger
$logger = new Logger('logger');
$formatter = new LineFormatter(
    null,
    null,
    true,
    true
);

// Create a handler
$handler = new StreamHandler( APP_ROOT . '/storage/log/battlesnake.log', Logger::DEBUG);
$handler->setFormatter($formatter);

// Now add some handlers
$logger->pushHandler($handler);
