<?php

namespace app\models;

use app\models\AbstractModel;

class Status extends AbstractModel
{
    const TABLE = 'status';

    private string $description;

    public function getDescription()
    {
        return $this->description;
    }
}
