<?php

namespace app\services;

use app\repositories\StatusRepository;

class StatusService extends AbstractCrudService
{
    public function __construct()
    {
        parent::setRepository(new StatusRepository());
    }
}
