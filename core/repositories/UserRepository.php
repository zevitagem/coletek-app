<?php

namespace app\repositories;

use app\repositories\AbstractCrudRepository;
use app\models\User;
use app\models\UserSetor;

class UserRepository extends AbstractCrudRepository
{
    public function __construct()
    {
        parent::setModel(new User());
    }

    public function store(array $data)
    {
        return parent::store([
            'name' => $data['name'],
            'email' => $data['email'],
        ]);
    }
    
    public function getValidObjects()
    {
        $table = $this->getTable();
        $userSetores = UserSetor::TABLE;

        $sql = "SELECT "
            . " $table.id AS {$table}_id,"
            . " $table.name AS {$table}_name,"
            . " $table.email AS {$table}_email,"
            . " COUNT($userSetores.user_id) as total_setores "
            . " FROM $table"
            . " LEFT JOIN $userSetores ON ($table.id = $userSetores.user_id)"
            . " GROUP BY $table.id";

        $res = $this->getConnectionDB()->query($sql);

        return $res->fetchAll(\PDO::FETCH_CLASS, $this->getClassModel());
    }
}
