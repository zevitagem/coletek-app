<?php

namespace app\validators;

use app\validators\AbstractValidator;
use app\traits\CrudValidator;

class UserValidator extends AbstractValidator
{
    const MAX_SIZE = 100;

    use CrudValidator;

    public function __construct()
    {
        $this->messages = array_merge($this->messages, [
            'name.empty' => 'O campo nome deve ser preenchido',
            'name.max_size' => 'O campo nome deve possuir no máximo 100 caracteres',
            'email.max_size' => 'O campo email deve possuir no máximo 100 caracteres',
            'email.empty' => 'O campo email deve ser preenchido',
        ]);
    }

    public function form()
    {
        $data = $this->getData();

        if (empty($data['name'])) {
            $this->addError('name.empty');
        }
        if (empty($data['email'])) {
            $this->addError('email.empty');
        }
        if ($this->hasErrors()) {
            return;
        }
        if (strlen($data['name']) > self::MAX_SIZE) {
            $this->addError('name.max_size');
        }
        if (strlen($data['email']) > self::MAX_SIZE) {
            $this->addError('email.max_size');
        }
    }
}
