<?php

namespace app\validators;

use app\validators\AbstractValidator;

class UserSetoresValidator extends AbstractValidator
{
    public function __construct()
    {
        $this->messages = array_merge($this->messages, [
            'setor' => 'O setor na posição [%s] precisa ser válido',
            'user' => 'Um usuário válido deve ser selecionado',
        ]);
    }

    public function form()
    {
        $data = $this->getData();

        if (!$this->isValidForeignValue($data['setor_id'])) {
            $this->addError('setor', [$data['posicao_visual_setor']]);
        }
        if (!$this->isValidForeignValue($data['user_id'])) {
            $this->addError('user');
        }
    }

    private function isValidForeignValue($value)
    {
        return (is_numeric($value) && $value > 0);
    }
}
