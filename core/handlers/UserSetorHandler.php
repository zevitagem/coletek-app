<?php

namespace app\handlers;

use app\handlers\AbstractHandler;

class UserSetorHandler extends AbstractHandler
{
    public function store()
    {
        $data = & $this->data;

        $data['setor_id'] = (int) $data['setor_id'];
        $data['user_id'] = (int) $data['user_id'];
    }
}
