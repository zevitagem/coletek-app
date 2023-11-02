<?php

namespace app\repositories;

use app\repositories\AbstractRepository;
use app\libraries\PDOConnection\PDOConnector;
use app\traits\SQLQueryActions;

abstract class AbstractDatabaseRepository extends AbstractRepository
{
    public function getDeletedAtColumn()
    {
        return $this->model::COLUMN_DELETED_AT;
    }

    public function getConnectionDB()
    {
        return PDOConnector::getCon(PDOConnector::getType());
    }

    public function getTables()
    {
        $sql = "SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES ORDER BY TABLE_NAME ASC";
        $res = $this->getConnectionDB()->query($sql);

        return $res->fetchAll(\PDO::FETCH_COLUMN);
    }

    public function getTable()
    {
        return $this->model::getTable();
    }

    public function getPrimaryKey()
    {
        return $this->model::getPrimaryKey();
    }

    public function beginTransaction()
    {
        $this->getConnectionDB()->beginTransaction();
    }

    public function rollBack()
    {
        $this->getConnectionDB()->rollBack();
    }

    public function commit()
    {
        $this->getConnectionDB()->commit();
    }

    public function get()
    {
        $sql = "SELECT * FROM " . $this->getTable();

        $sth = $this->getConnectionDB()->prepare($sql);

        $this->execute($sth);

        return $sth->fetchAll(\PDO::FETCH_CLASS, $this->getModelClassName());
    }

    public function getAll()
    {
        $sql = "SELECT * FROM " . $this->getTable();

        $sth = $this->getConnectionDB()->prepare($sql);

        $this->execute($sth);

        return $sth->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function countRows()
    {
        $sql = "SELECT COUNT(*) FROM " . $this->getTable();
        $res = $this->getConnectionDB()->query($sql);

        return $res->fetchColumn();
    }
    use SQLQueryActions;

    public function getById(int $id)
    {
        $sql = "SELECT * FROM " . $this->getTable() . " "
            . " WHERE " . $this->getPrimaryKey() . " = $id "
            . " LIMIT 1";

        $res = $this->query($this->getConnectionDB(), $sql);

        return $res->fetchObject($this->getModelClassName());
    }

    public function deleteByCondition(array $condition)
    {
        $sql = "DELETE FROM " . $this->getTable() . " "
            . " %where ";

        $whereToBind = [];
        $sql = str_replace('%where', $this->createWhereSQL(
                $condition,
                $whereToBind
            ), $sql);

        $sth = $this->getConnectionDB()->prepare($sql);

        $this->bindValues($sth, $whereToBind, 'where');

        $this->execute($sth);

        return ($sth->rowCount() > 0);
    }

    public function deleteById(int $id)
    {
        $sql = "DELETE FROM " . $this->getTable() . " "
            . " WHERE " . $this->getPrimaryKey() . " = $id "
            . " LIMIT 1";

        $sth = $this->getConnectionDB()->prepare($sql);

        $this->execute($sth);

        return ($sth->rowCount() > 0);
    }

    public function save(array $data)
    {
        $primary = $this->model->getPrimaryKey();
        $isUpdate = false;

        if (!empty($data[$primary])) {
            $id = $data[$primary];
            $isUpdate = true;
        }

        if (array_key_exists($primary, $data)) {
            unset($data[$primary]);
        }

        return ($isUpdate) ? $this->updateById($id, $data) : $this->store($data);
    }

    public function store(array $data)
    {
        $keys = array_keys($data);

        $columnsBinds = [];
        foreach ($keys as $key) {
            $columnsBinds[$key] = ":$key";
        }

        $sql = "INSERT INTO " . $this->getTable() . " (" . implode(',', $keys) . ") "
            . "VALUES (" . implode(',', $columnsBinds) . ")";

        $sth = $this->getConnectionDB()->prepare($sql);

        foreach ($keys as $key) {
            $sth->bindParam($columnsBinds[$key], $data[$key]);
        }

        $this->execute($sth);

        return ($sth->rowCount() > 0) ? $this->getConnectionDB()->lastInsertId() : false;
    }

    public function updateById(int $id, array $data)
    {
        $keys = array_keys($data);

        $columnsBinds = [];
        foreach ($keys as $key) {
            $columnsBinds[] = "$key = :$key";
        }

        $sql = "UPDATE " . $this->getTable() . " "
            . "SET " . implode(',', $columnsBinds) . " "
            . "WHERE " . $this->getPrimaryKey() . " = $id";

        $sth = $this->getConnectionDB()->prepare($sql);
        foreach ($keys as $key) {
            $sth->bindParam(":$key", $data[$key]);
        }

        return $this->execute($sth);
    }

    protected function getByConditionFromSQL(string $sql, array $filters = [])
    {
        $table = $this->getTable();
        $havingToBind = $whereToBind = [];

        $sql = str_replace('%having', $this->createHavingSQLForDateColumns($filters, $havingToBind), $sql);
        $sql = str_replace('%where', $this->createWhereSQL($filters, $whereToBind), $sql);

        $sth = $this->getConnectionDB()->prepare($sql);

        $this->bindValues($sth, $havingToBind, 'having');
        $this->bindValues($sth, $whereToBind, 'where');

        $this->execute($sth);

        return $sth->fetchAll(\PDO::FETCH_CLASS, $this->getModelClassName());
    }

    protected function query(object $connection, string $sql)
    {
        return $connection->query($sql);
    }

    protected function execute(object $sth, array $params = [])
    {
        $exe = (!empty($params)) ? $sth->execute($params) : $sth->execute();
        if (!$exe && hasPrintDebug()) {
            dd([
                'exe' => $exe,
                'error_info' => $sth->errorInfo(),
                'debug' => $sth->debugDumpParams()
            ]);
        }

        return true;
    }
}
