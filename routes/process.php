<?php

include_once '../bootstrap.php';

use app\pages\http\ProcessController;
use app\libraries\Router;

$class = new ProcessController();
$router = new Router($class);

$router->run();
