<?php

namespace app\libraries;

class Migrations
{
    private object $connection;
    private array $files = [
        PREFIX_ACCESS_FOLDER . 'migrations/tables.php',
        PREFIX_ACCESS_FOLDER . 'migrations/seeders.php',
    ];

    public function __construct(object $connection)
    {
        $this->connection = $connection;
    }

    public function run()
    {
        //$this->connection->beginTransaction();

        try {
            foreach ($this->files as $row) {
                include_once $row;

                //$queries are created in include
                foreach ($queries as $key => $query) {

                    $beginTime = microtime();
                    $this->connection->query($query);
                    $endTime = microtime();
                    $diffTime = (float) $endTime - (float) $beginTime;

                    echo "Query [$key] executed in {$diffTime} ms" . PHP_EOL;
                }
            }

            //$this->connection->commit();
        } catch (\Throwable $exc) {
            //$this->connection->rollBack();

            throw $exc;
        }
    }
}
