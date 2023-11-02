<?php

namespace app\repositories;

use app\models\AbstractModel;

abstract class AbstractRepository
{
    protected AbstractModel $model;

    public function getModel()
    {
        return $this->model;
    }

    public function getModelClassName()
    {
        return get_class($this->model);
    }

    protected function setModel(AbstractModel $model)
    {
        $this->model = $model;
    }
}
