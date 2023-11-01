<?php

namespace app\repositories;

use app\models\AbstractModel;
use Throwable;

abstract class AbstractRepository
{
    protected AbstractModel $model;

    public function setModel(AbstractModel $model)
    {
        $this->model = $model;
    }

    public function getModel()
    {
        return $this->model;
    }

    public function getClassModel()
    {
        return get_class($this->model);
    }

    public function newException(Throwable $exc)
    {
        throw $exc;
    }
}
