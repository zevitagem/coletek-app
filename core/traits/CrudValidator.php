<?php

namespace app\traits;

use app\models\AbstractModel;

trait CrudValidator
{
    public function store()
    {
        $this->form();
        $this->validateOwnership(__FUNCTION__);
        $this->validateUserType(__FUNCTION__);
    }

    public function update()
    {
        $this->form();
        $this->validateRow(__FUNCTION__);
        $this->validateOwnership(__FUNCTION__);
        $this->validateUserType(__FUNCTION__);
    }

    public function destroy()
    {
        $this->validateRow(__FUNCTION__);
        $this->validateOwnership(__FUNCTION__);
        $this->validateUserType(__FUNCTION__);
    }

    public function show()
    {
        $this->validateRow(__FUNCTION__);
        $this->validateOwnership(__FUNCTION__);
        $this->validateUserType(__FUNCTION__);
    }

    protected function validateRow(string $context)
    {
        $data = $this->getData();
        if (!($data['row'] instanceof AbstractModel)) {
            $this->addError('row_not_found');
        }
    }

    public function validateOwnership(string $context)
    {
        //
    }

    public function validateUserType(string $context)
    {
        //
    }
}
