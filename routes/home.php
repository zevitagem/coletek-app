<?php

include_once '../bootstrap.php';

use app\pages\http\HomeController;
use app\libraries\Router;

$class = new HomeController();
$router = new Router($class);

$router->run();
