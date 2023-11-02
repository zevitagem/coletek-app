<?php

namespace app\repositories;

use app\repositories\AbstractCrudRepository;
use app\models\UserSetor;

class UserSetorRepository extends AbstractCrudRepository
{
    public function __construct()
    {
        parent::setModel(new UserSetor());
    }

    public function store(array $data)
    {
        return parent::store([
            'user_id' => $data['user_id'],
            'setor_id' => $data['setor_id'],
        ]);
    }
}
