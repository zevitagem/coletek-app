<?php

namespace app\repositories;

use app\repositories\AbstractCrudRepository;
use app\models\Setor;

class SetoresRepository extends AbstractCrudRepository
{
    public function __construct()
    {
        parent::setModel(new Setor());
    }
}
