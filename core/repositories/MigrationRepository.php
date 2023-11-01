<?php

namespace app\repositories;

use app\repositories\DatabaseRepository;
use app\models\Migration;

class MigrationRepository extends DatabaseRepository
{

    public function __construct()
    {
        parent::setModel(new Migration());
    }

}
