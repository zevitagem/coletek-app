<?php

namespace app\models;

use app\models\AbstractModel;

class UserSetor extends AbstractModel
{
    const TABLE = 'user_setores';

    protected int $user_id;
    protected int $setor_id;

    public function getUserId()
    {
        return $this->user_id;
    }

    public function getSetorId()
    {
        return $this->setor_id;
    }
}
