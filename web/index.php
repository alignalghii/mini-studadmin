<?php

/** The front `controller' (not a real controller in the strict sense, two layers lower) */

require '../autoload.php';

$request = new Request($_SERVER, $_GET, $_POST);
$router  = new Router(Routes::$CONFIG, $request); // PHP7: Routes::CONFIG
$router->routeOrReport();
