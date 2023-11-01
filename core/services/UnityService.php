<?php

namespace app\services;

use app\repositories\UnityRepository;

class UnityService extends AbstractCrudService
{
    public function __construct()
    {
        parent::setRepository(new UnityRepository());
    }
}
