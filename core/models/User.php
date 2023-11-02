<?php

namespace app\models;

use app\models\AbstractModel;

class User extends AbstractModel
{
    const TABLE = 'users';

    protected string $name;
    protected string $email;

    public function getName()
    {
        return $this->name;
    }

    public function getEmail()
    {
        return $this->email;
    }
}
