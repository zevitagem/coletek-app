<?php

namespace app\pages\http;

use app\traits\AvailabilityWithService;

abstract class Controller
{
    use AvailabilityWithService;

    protected function getControllerName()
    {
        //$list = explode(DIRECTORY_SEPARATOR, get_class($this));
        $list = explode('\\', get_class($this));
        end($list);

        return strtolower(str_replace('Controller', '', current($list)));
    }
}
