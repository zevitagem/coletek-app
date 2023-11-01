<?php

namespace app\repositories;

use app\repositories\AbstractRepository;
use app\libraries\PDOConnection\PDOConnector;

class DatabaseRepository extends AbstractRepository
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

    public function queryAll(string $query, array $params = [])
    {
        $sth = $this->getConnectionDB()->prepare($query);

        $this->execute($sth, $params);

        return $sth->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getAll()
    {
        $sql = "SELECT * FROM " . $this->getTable();

        return $this->queryAll($sql);
    }

    public function countRows()
    {
        $sql = "SELECT COUNT(*) FROM " . $this->getTable();
        $res = $this->getConnectionDB()->query($sql);

        return $res->fetchColumn();
    }

    protected function query(object $connection, string $sql)
    {
        try {
            return $connection->query($sql);
        } catch (\PDOException $exc) {
            $this->newException($exc);
        } catch (\Throwable $exc) {
            $this->newException($exc);
        }
    }

    protected function execute($sth, array $params = [])
    {
        try {
            $exe = (!empty($params)) ? $sth->execute($params) : $sth->execute();
            if (!$exe) {
                dd($exe);
                //dd($sth->errorInfo());
            }

            if (hasPrintDebug()) {
                dd($sth->debugDumpParams());
            }
        } catch (\PDOException $exc) {
            $this->newException($exc);
        }

        return true;
    }
}
