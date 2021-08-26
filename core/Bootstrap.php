<?php

use App\Core\Http\Router;
use App\Core\Http\Request;
use App\Core\Maintenance;

/* ----------------------------
|
|  Bootstrap
|
|  Load dependencies.
|
|
| ----------------------------*/

require_once __DIR__.'/../vendor/autoload.php';
require __DIR__.'/../core/Functions.php';

Maintenance::check()->status();
Router::load('../routes/Routes.php')->dispatch(Request::uri(), Request::method());
