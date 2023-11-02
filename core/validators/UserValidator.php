<?php

namespace app\validators;

use app\validators\AbstractValidator;
use app\traits\CrudValidator;

class UserValidator extends AbstractValidator
{
    use CrudValidator;

    public function __construct()
    {
        $this->messages = array_merge($this->messages, [
            'name' => 'O campo nome deve ser preenchido',
            'email' => 'O campo email deve ser preenchido',
        ]);
    }

    public function form()
    {
        $data = $this->getData();

        if (empty($data['name'])) {
            $this->addError('name');
        }
        if (empty($data['email'])) {
            $this->addError('email');
        }
    }
}
