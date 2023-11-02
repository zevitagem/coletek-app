<?php

namespace app\repositories;

use app\repositories\AbstractDatabaseRepository;
use app\models\Migration;

class MigrationRepository extends AbstractDatabaseRepository
{
    public function __construct()
    {
        parent::setModel(new Migration());
    }
}
