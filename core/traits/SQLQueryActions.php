<?php

namespace app\traits;

use PDO;

trait SQLQueryActions
{
    public function createHavingSQLForDateColumns(
        array &$filters,
        array &$toBind = []
    )
    {
        $conditions = [];
        $i = 0;
        $dateColumns = (defined($this->getModelClassName() . '::DATE_COLUMNS')) 
            ? $this->getModel()::DATE_COLUMNS 
            : [];

        foreach ($filters as $field => $value) {
            if (!in_array($field, $dateColumns)) {
                continue;
            }

            unset($filters[$field]);

            if ($this->isNullValue($value)) {
                $conditions[] = "$field IS NULL";
                continue;
            }

            $key = "having_{$field}_$i";
            $conditions[] = "DATE($field) = :$key";
            $toBind[$key] = $value;
            $i++;
        }

        if (empty($conditions)) {
            return '';
        }

        return 'HAVING ' . implode(' AND ', $conditions);
    }

    public function createWhereSQL(array &$filters, array &$toBind = [])
    {
        $conditions = [];
        $i = 0;

        foreach ($filters as $field => $value) {
            if ($this->isNullValue($value)) {
                $conditions[] = "$field IS NULL";
                continue;
            }

            $key = "where_{$field}_$i";
            $key = md5($key);
            
            $conditions[] = "$field = :$key";
            $toBind[$key] = $value;
            $i++;
        }

        if (!empty($conditions)) {
            return 'WHERE ' . implode(' AND ', $conditions);
        }

        return '';
    }

    public function bindValues($sth, array $toBindFilters, $prefix = 'where')
    {
        foreach ($toBindFilters as $key => $value) {

            if ($this->isNullValue($value)) {
                $param = PDO::PARAM_NULL;
            } elseif (is_int($value)) {
                $param = PDO::PARAM_INT;
            } elseif (is_bool($value)) {
                $param = PDO::PARAM_BOOL;
            } elseif (is_string($value)) {
                $param = PDO::PARAM_STR;
            } else {
                $param = FALSE;
            }

            $sth->bindValue($key, $value, $param);
        }
    }

    private function isNullValue($value)
    {
        return (is_null($value) || $value === 'NULL');
    }
}
