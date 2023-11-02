<?php

namespace app\models;

use app\models\AbstractModel;

class UserSetor extends AbstractModel
{
    const TABLE = 'user_setores';

    private int $user_id;
    private int $setor_id;

    public function getUserId()
    {
        return $this->user_id;
    }

    public function getSetord()
    {
        return $this->setor_id;
    }
}
