<?php

include '../bootstrap.php';

$pdoConnector = new \app\libraries\PDOConnection\PDOConnector();
$connection = $pdoConnector->connect();

$migrationService = new \app\services\MigrationService();
$migrationService->configure();

if (!$migrationService->canRun()) {
    throw new Exception('This script has already been executed, check your database.');
}

$migrations = new app\libraries\Migrations($connection);
$migrations->run();
