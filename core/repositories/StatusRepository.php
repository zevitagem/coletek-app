<?php

namespace app\repositories;

use app\repositories\AbstractCrudRepository;
use app\models\Status;

class StatusRepository extends AbstractCrudRepository
{
    public function __construct()
    {
        parent::setModel(new Status());
    }

    public function getValidObjects()
    {
        $table = $this->getTable();

        $sql = "SELECT * FROM $table WHERE active = 1";
        $res = $this->getConnectionDB()->query($sql);

        return $res->fetchAll(\PDO::FETCH_CLASS, $this->getClassModel());
    }
}
