<?php

<<<<<<< HEAD
=======
use Illuminate\Foundation\Application;
>>>>>>> 5ac067b5ff45b7df29d47f50329f194f0bdc45ce
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
<<<<<<< HEAD
(require_once __DIR__.'/../bootstrap/app.php')
    ->handleRequest(Request::capture());
=======
/** @var Application $app */
$app = require_once __DIR__.'/../bootstrap/app.php';

$app->handleRequest(Request::capture());
>>>>>>> 5ac067b5ff45b7df29d47f50329f194f0bdc45ce
