<?php

namespace app\repositories;

use app\repositories\AbstractDatabaseRepository;
use app\models\User;
use app\models\UserSetor;

class UserRepository extends AbstractDatabaseRepository
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

    public function getByCondition(array $condition = [])
    {
        $table = $this->getTable();
        $userSetores = UserSetor::TABLE;

        $finalCondition = [];
        if (is_int($condition['setor']) && $condition['setor'] > 0) {
            $finalCondition[$userSetores . '.setor_id'] = $condition['setor'];
        }

        $sql = "SELECT "
            . " $table.id AS {$table}_id,"
            . " $table.name AS {$table}_name,"
            . " $table.email AS {$table}_email,"
            . " COUNT($userSetores.user_id) as total_setores "
            . " FROM $table"
            . " LEFT JOIN $userSetores ON ($table.id = $userSetores.user_id)"
            . " %where "
            . " GROUP BY $table.id";

        return parent::getByConditionFromSQL($sql, $finalCondition);
    }
}
