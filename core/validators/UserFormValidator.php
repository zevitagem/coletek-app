<?php

namespace app\validators;

use app\validators\AbstractValidator;

class UserFormValidator extends AbstractValidator
{
    protected array $messages = [
        'name' => 'O campo nome deve ser preenchido',
        'email' => 'O campo email deve ser preenchido',
    ];

    public function store()
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
