<?php

namespace app\validators;

abstract class AbstractValidator
{
    protected string $method;
    protected bool $withHTML = true;
    protected array $errors = [];
    protected array $data;
    protected array $messages = [
        'id_invalid' => 'O ID é inválido',
        'row_not_found' => 'O registro não foi encontrado',
        'register_must_exists' => 'O registro em questão deve existir',
        'only_owner_can_manipulate' => 'Somente o proprietário pode manipular o registro',
    ];

    public function setData(array $data)
    {
        $this->data = $data;
    }

    public function setWithHTML(bool $value)
    {
        $this->withHTML = $value;
    }

    public function addError(string $key, array $data = [])
    {
        $this->errors[] = vsprintf($this->messages[$key], $data);
    }

    public function setMethod(string $method)
    {
        $this->method = $method;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function hasErrors()
    {
        return (!empty($this->getErrors()));
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getData()
    {
        return $this->data;
    }

    public function run(string $method = '')
    {
        if (!method_exists($this, $method)) {
            return;
        }

        $this->setMethod($method);
        $this->{$method}();

        return (empty($this->errors));
    }

    public function translate()
    {
        if (!$this->withHTML) {
            return $this->errors;
        }

        return includeWithVariables(
            view('components/validator-messages.php'),
            ['messages' => $this->errors],
            false
        );
    }
}
