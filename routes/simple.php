<?php

include_once '../bootstrap.php';

use app\pages\http\SimpleController;
use app\libraries\Router;

$class = new SimpleController();
$router = new Router($class);

$router->run();
