<?php

namespace app\models;

use app\models\AbstractModel;

class Process extends AbstractModel
{
    const TABLE = 'registers';
    const COLUMN_DELETED_AT = 'deleted_at';
    const DATE_COLUMNS = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    private string $name;

    public function getName()
    {
        return $this->name;
    }
}
