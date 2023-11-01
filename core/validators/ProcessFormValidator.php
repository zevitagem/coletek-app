<?php

namespace app\validators;

use app\validators\AbstractValidator;

class ProcessFormValidator extends AbstractValidator
{
    protected array $messages = [
        'name' => 'O campo nome deve ser preenchido',
        'people' => 'Uma pessoa deve ser selecionada',
        'status' => 'Um status deve ser selecionado',
        'unity' => 'Uma unidade deve ser selecionada',
    ];

    public function store()
    {
        $data = $this->getData();

        if (empty($data['name'])) {
            $this->addError('name');
        }
        if (!$this->isValidForeignValue($data['people'])) {
            $this->addError('people');
        }
        if (!$this->isValidForeignValue($data['status'])) {
            $this->addError('status');
        }
        if (!$this->isValidForeignValue($data['unity'])) {
            $this->addError('unity');
        }
    }

    private function isValidForeignValue($data)
    {
        return (is_numeric($data) && $data > 0);
    }
}
