<?php

namespace app\services;

use app\repositories\PeopleRepository;

class PeopleService extends AbstractCrudService
{
    public function __construct()
    {
        parent::setRepository(new PeopleRepository());
    }
}
