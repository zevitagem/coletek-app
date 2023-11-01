<?php

namespace app\handlers;

use app\handlers\AbstractHandler;

class ProcessHandler extends AbstractHandler
{
    public function store()
    {
        $data = & $this->data;

        $data['people_id'] = $data['people'];
        $data['unity_id'] = $data['unity'];
    }
}
