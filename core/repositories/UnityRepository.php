<?php

namespace app\repositories;

use app\repositories\AbstractCrudRepository;
use app\models\Unity;

class UnityRepository extends AbstractCrudRepository
{
    public function __construct()
    {
        parent::setModel(new Unity());
    }

    public function getValidObjects()
    {
        $table = $this->getTable();

        $sql = "SELECT * FROM $table WHERE active = 1";
        $res = $this->getConnectionDB()->query($sql);

        return $res->fetchAll(\PDO::FETCH_CLASS, $this->getClassModel());
    }
}
