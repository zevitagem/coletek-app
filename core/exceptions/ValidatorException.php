<?php

namespace app\exceptions;

use app\validators\AbstractValidator;

class ValidatorException extends \Exception
{
    private AbstractValidator $validator;

    public function setValidator(AbstractValidator $validator)
    {
        $this->validator = $validator;
    }
    
    public function getValidatorErrors()
    {
        return $this->validator->getErrors();
    }
}
