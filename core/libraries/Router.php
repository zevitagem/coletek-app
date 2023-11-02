<?php

namespace app\libraries;

use app\pages\http\Controller;
use Throwable;
use InvalidArgumentException;

class Router
{
    private Controller $controller;

    public function __construct(Controller $controller = null)
    {
        $this->setController($controller);
    }

    public function run()
    {
        $this->handle();
    }

    private function setController(Controller $controller)
    {
        $this->controller = $controller;
    }

    private function handle()
    {
        $action = $_GET['action'] ?? '';

        if (empty($this->controller)) {
            throw new InvalidArgumentException('The controller must be setted before executing the action');
        }

        if (empty($action)) {
            return $this->controller->index();
        }

        if (!method_exists($this->controller, $action)) {
            throw new InvalidArgumentException('Please, create a method to resolve request in controller class based on "action" parameter');
        }

        try {
            $this->controller->{$action}();
        } catch (Throwable $exc) {
            dd($exc);
        }
    }
}
