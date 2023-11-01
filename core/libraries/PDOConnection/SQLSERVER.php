<?php

namespace app\libraries\PDOConnection;

class SQLSERVER
{
    public function getConfig()
    {
        return [
            'DATABASE' => '',
            'USER' => 'root',
            'PASSWORD' => '',
            'HOST' => '',
            'PORT' => 0
        ];
    }

    public function connect(array $config)
    {
        $odbc = "sqlsrv:Server=" . $config['HOST'] . "," . $config['PORT'] .
            ";Database=" . $config['DATABASE'] .
            ";ConnectionPooling=false";

        return new \PDO($odbc, $config['USER'], $config['PASSWORD'], array(
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
        ));
    }
}
