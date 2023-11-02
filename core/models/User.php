<?php

namespace app\models;

use app\models\AbstractModel;

class User extends AbstractModel
{
    const TABLE = 'users';

    private string $name;
    private string $email;

    public function getName()
    {
        return $this->name;
    }

    public function getEmail()
    {
        return $this->email;
    }
}
