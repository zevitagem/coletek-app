<?php

namespace app\services;

use app\repositories\MigrationRepository;
use PDOException;

class MigrationService extends AbstractService
{
    public function __construct()
    {
        parent::setRepository(new MigrationRepository());
    }

    public function canRun()
    {
        try {
            $can = false;
            $this->repository->countRows();
        } catch (PDOException $exc) {
            $code = $exc->getCode();
            $can = ($code == '42S02'); //Table 'migrations' doesn't exist
        }

        return $can;
    }
}
