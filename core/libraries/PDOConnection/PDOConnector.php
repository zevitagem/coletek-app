<?php

namespace app\libraries\PDOConnection;

class PDOConnector
{
    private static array $connection = [];
    private static string $type = '';

    public static function connect(string $type = '')
    {
        if (empty($type)) {
            $type = TYPE_DB;
        }

        self::setType($type);

        if (!empty(self::$connection[$type])) {
            return self::getCon($type);
        }

        try {
            $path = 'app\\libraries\\PDOConnection\\' . $type;
            $class = new $path();

            $config = $class->getConfig();
            $connection = $class->connect($config);

            self::$connection[$type] = $connection;
            return $connection;
        } catch (\Throwable $e) {

            print "PDOConnector ERROR: " . $e->getMessage() . "<br/>";

            self::$connection[$type] = self::$type = null;
            die();
        }
    }

    public static function setType(string $type)
    {
        self::$type = $type;
    }

    public static function getType()
    {
        return self::$type;
    }

    public static function getCon(string $type)
    {
        return self::$connection[$type];
    }
}
