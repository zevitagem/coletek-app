<?php

namespace app\models;

use app\models\AbstractModel;

class Setor extends AbstractModel
{
    const TABLE = 'setores';

    private string $name;

    public function getName()
    {
        return $this->name;
    }
}
