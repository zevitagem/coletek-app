<?php

namespace app\validators;

use app\services\AbstractService;

abstract class AbstractValidator
{
    protected AbstractService $service;
    protected array $data;
    protected array $messages = [];

    /** -- * */
    private string $method;
    private bool $withHTML = true;
    private array $errors = [];
    private $textSeparator = PHP_EOL;

    public function setData(array $data)
    {
        $this->data = $data;
    }

    public function setService(AbstractService $service)
    {
        $this->service = $service;
    }

    public function setWithHTML(bool $value)
    {
        $this->withHTML = $value;
    }

    public function addError(string $key, array $data = [])
    {
        $this->errors[] = vsprintf($this->messages[$key], $data);
    }

    private function setMethod(string $method)
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

    public function getService()
    {
        return $this->service;
    }

    public function getTextSeparator()
    {
        return $this->textSeparator;
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
            return implode($this->getTextSeparator(), $this->errors);
        }

        return includeWithVariables(
            view('components/validator-messages.php'),
            ['messages' => $this->errors],
            false
        );
    }
}
