<?php

namespace app\models;

use app\models\AbstractModel;

class People extends AbstractModel
{
    const TABLE = 'people';
    const COLUMN_DELETED_AT = 'deleted_at';

    private string $name;

    public function getName()
    {
        return $this->name;
    }
}
