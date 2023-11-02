<?php

namespace app\models;

use app\models\AbstractModel;

class Setor extends AbstractModel
{
    const TABLE = 'setores';

    protected string $name;

    public function getName()
    {
        return $this->name;
    }
}
