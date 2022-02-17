<?php

require_once('../vendor/autoload.php');

use App\Api;
use App\Snake;

$snek = new Snake();

/**
 * Basic index.php router that checks the incoming REQUEST_URI and decides what response to send.
 *
 * Simple API response functions used here are located in api.php.
 *
 * Most of your snake implementation will need to happen in the "/move" command.
 */

// Get the requested URI without any query parameters on the end
$requestUri = strtok($_SERVER['REQUEST_URI'], '?');

if ($requestUri == '/')
{   //Index Section
    $apiversion = "1";
    $author     = "prikkprikkprikk";
    $color      = "#26428b";
    $head       = "fang";
    $tail       = "fat-rattle";

    Api::indexResponse($apiversion,$author,$color,$head, $tail);
}
elseif ($requestUri == '/start')
{
    // read the incoming request body stream and decode the JSON
    $data = json_decode(file_get_contents('php://input'));
    $snek->receiveState($data);

    // TODO - if you have a stateful snake, you could do initialization work here
    Api::startResponse();
}
elseif ($requestUri == '/move')
{   // Move Section
    // read the incoming request body stream
    $json_data = file_get_contents('php://input');
    $data = json_decode($json_data);

    error_log("Received move data: $json_data\n", 3, '/home/forge/bs.prikkprikkprikk.no/storage/log/log');

    $snek->receiveState($data);

    Api::moveResponse($snek->randomMove());
}
elseif ($requestUri == '/end')
{
     // read the incoming request body stream and decode the JSON
     $data = json_decode(file_get_contents('php://input'));

     // TODO - if you have a stateful snake, you could do finalize work here
     Api::endResponse();
}
else
{
    header($_SERVER['SERVER_PROTOCOL'].' 404 Not Found');
}
