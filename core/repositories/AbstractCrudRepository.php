<?php

namespace app\repositories;

use app\repositories\DatabaseRepository;
use app\exceptions\CrudException;
use app\traits\SQLQueryActions;
use Throwable;

abstract class AbstractCrudRepository extends DatabaseRepository
{
    use SQLQueryActions;
    public function newException(Throwable $exc)
    {
        throw new CrudException($exc->getMessage());
    }

    protected function getWithCondition(string $sql, array $filters = [])
    {
        $table = $this->getTable();
        $havingToBind = $whereToBind = [];

        $sql = str_replace('%having', $this->createHavingSQLForDateColumns($filters, $havingToBind), $sql);
        $sql = str_replace('%where', $this->createWhereSQL($filters, $whereToBind), $sql);

        $sth = $this->getConnectionDB()->prepare($sql);

        $this->bindValues($sth, $havingToBind, 'having');
        $this->bindValues($sth, $whereToBind, 'where');

        parent::execute($sth);

        return $sth->fetchAll(\PDO::FETCH_CLASS, $this->getClassModel());
    }

    public function getValidObjects()
    {
        $sql = "SELECT * FROM " . $this->getTable() . " WHERE " . $this->getDeletedAtColumn() . " IS NULL";
        $res = $this->getConnectionDB()->query($sql);

        return $res->fetchAll(\PDO::FETCH_CLASS, $this->getClassModel());
    }

    public function getById(int $id)
    {
        $sql = "SELECT * FROM " . $this->getTable() . " "
            . " WHERE " . $this->getPrimaryKey() . " = $id "
            . " LIMIT 1";

        $res = $this->query($this->getConnectionDB(), $sql);

        return $res->fetchObject($this->getClassModel());
    }

    public function deleteById(int $id)
    {
        $sql = "DELETE FROM " . $this->getTable() . " "
            . " WHERE " . $this->getPrimaryKey() . " = $id "
            . " LIMIT 1";

        $sth = $this->getConnectionDB()->prepare($sql);

        parent::execute($sth);

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

        parent::execute($sth);

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

        return parent::execute($sth);
    }
}
