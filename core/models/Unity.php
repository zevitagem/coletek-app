<?php

namespace app\models;

use app\models\AbstractModel;

class Unity extends AbstractModel
{
    const TABLE = 'unities';

    private string $description;

    public function getDescription()
    {
        return $this->description;
    }
}
