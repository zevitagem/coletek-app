<?php

namespace app\repositories;

use app\repositories\AbstractCrudRepository;
use app\models\Process;
use app\models\Status;
use app\models\Unity;
use app\models\People;

class ProcessRepository extends AbstractCrudRepository
{
    public function __construct()
    {
        parent::setModel(new Process());
    }

    public function store(array $data)
    {
        return parent::store([
            'people_id' => $data['people_id'],
            'unity_id' => $data['unity_id'],
            'status' => $data['status'],
            'name' => $data['name'],
        ]);
    }

    public function getValidObjects()
    {
        $table = $this->getTable();
        $peopleTable = People::TABLE;
        $unityTable = Unity::TABLE;
        $statusTable = Status::TABLE;

        $sql = "    SELECT $table.*,"
            . " $peopleTable.name AS people_name,"
            . " $unityTable.description AS unity_description,"
            . " $statusTable.description AS status_description "
            . " FROM $table"
            . " INNER JOIN $peopleTable ON ($peopleTable.id = $table.people_id)"
            . " INNER JOIN $unityTable ON ($unityTable.id = $table.unity_id)"
            . " INNER JOIN $statusTable ON ($statusTable.id = $table.status)"
            . " WHERE $table.{$this->getDeletedAtColumn()} IS NULL";
        $res = $this->getConnectionDB()->query($sql);

        return $res->fetchAll(\PDO::FETCH_CLASS, $this->getClassModel());
    }
}
