<?php

namespace app\repositories;

use app\repositories\AbstractCrudRepository;
use app\models\People;

class PeopleRepository extends AbstractCrudRepository
{
    public function __construct()
    {
        parent::setModel(new People());
    }
}
