<?php

include_once '../bootstrap.php';

use app\pages\http\UserController;
use app\libraries\Router;

$class = new UserController();
$router = new Router($class);

$router->run();
