<?php

namespace app\repositories;

use app\models\Setor;
use app\repositories\AbstractDatabaseRepository;

class SetoresRepository extends AbstractDatabaseRepository
{
    public function __construct()
    {
        parent::setModel(new Setor());
    }
}
