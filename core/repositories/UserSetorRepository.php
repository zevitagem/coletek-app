<?php

namespace app\repositories;

use app\repositories\AbstractDatabaseRepository;
use app\models\Setor;
use app\models\UserSetor;

class UserSetorRepository extends AbstractDatabaseRepository
{
    public function __construct()
    {
        parent::setModel(new UserSetor());
    }

    public function store(array $data)
    {
        return parent::store([
            'user_id' => $data['user_id'],
            'setor_id' => $data['setor_id'],
        ]);
    }

    public function deleteByUser(int $userId)
    {
        return parent::deleteByCondition([
            'user_id' => $userId
        ]);
    }

    public function getByUser(int $id)
    {
        $table = $this->getTable();
        $setoresTable = Setor::TABLE;

        $sql = "SELECT "
            . " $table.setor_id,"
            . " $setoresTable.name AS setor_name"
            . " FROM $table"
            . " INNER JOIN $setoresTable ON ($table.setor_id = $setoresTable.id)"
            . " WHERE $table.user_id = $id";

        $sth = $this->getConnectionDB()->prepare($sql);

        parent::execute($sth);

        return $sth->fetchAll(\PDO::FETCH_CLASS, $this->getModelClassName());
    }
}
