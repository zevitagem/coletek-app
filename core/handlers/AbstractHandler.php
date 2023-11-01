<?php

namespace app\handlers;

abstract class AbstractHandler
{
    protected array $data;

    public function setData(array &$data)
    {
        $this->data = & $data;
    }

    public function run(string $method = '')
    {
        $this->{$method}();
    }

    public function store()
    {
        //nothing implemented here ...
    }
}
