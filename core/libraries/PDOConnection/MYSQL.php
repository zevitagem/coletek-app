<?php

namespace app\libraries\PDOConnection;

class MYSQL
{
    public function getConfig()
    {
        return [
            'HOST' => env('DB_HOST'),
            'DATABASE' => env('DB_DATABASE'),
            'USER' => env('DB_USERNAME'),
            'PASSWORD' => env('DB_PASSWORD'),
            'PORT' => env('DB_PORT')
        ];
    }

    public function connect(array $config)
    {
        return new \PDO('mysql:host=' . $config['HOST'] . ';'
            . 'port=' . $config['PORT'] . ';'
            . 'dbname=' . $config['DATABASE'],
            $config['USER'],
            $config['PASSWORD'], array(
            \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
        ));
    }
}
