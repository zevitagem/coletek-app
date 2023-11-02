<?php

namespace app\models;

abstract class AbstractModel
{
    const TABLE = '';
    const PRIMARY_KEY = 'id';

    public function hydrate(array $attributes)
    {
        foreach ($attributes as $attr => $value) {
            $this->{$attr} = $value;
        }
    }

    public static function getTable()
    {
        return static::TABLE;
    }

    public static function getPrimaryKey()
    {
        return static::PRIMARY_KEY;
    }

    public function getPrimaryValue()
    {
        return $this->{self::getPrimaryKey()};
    }

    public function getAttribute($key)
    {
        return $this->$key ?? null;
    }
}
