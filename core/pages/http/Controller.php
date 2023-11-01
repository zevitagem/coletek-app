<?php

namespace app\pages\http;

use app\services\AbstractService;

abstract class Controller
{

    protected AbstractService $service;
    protected string $classService;

    public function getControllerName()
    {
        //$list = explode(DIRECTORY_SEPARATOR, get_class($this));
        $list = explode('\\', get_class($this));
        end($list);

        return strtolower(str_replace('Controller', '', current($list)));
    }

    public function setMainService(AbstractService $service)
    {
        $this->service = $service;
    }

    public function getMainService()
    {
        return $this->service;
    }

    public function connectSQLSERVER()
    {
        connectSQLSERVER();

        if (empty($this->service)) {
            return;
        }

        $this->service->configure();
    }

    public function connectMYSQL()
    {
        connectMYSQL();

        if (empty($this->service)) {
            return;
        }

        $this->service->configure();
    }

}
