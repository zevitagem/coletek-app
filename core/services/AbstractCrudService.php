<?php

namespace app\services;

use app\services\AbstractService;

abstract class AbstractCrudService extends AbstractService
{
    public function getTable()
    {
        return $this->repository->getTable();
    }

    public function getById(int $id)
    {
        return $this->repository->getById($id);
    }

    public function updateById(int $id, array $data)
    {
        unset($data['id']);

        return $this->repository->updateById($id, $data);
    }

    public function store(array $data)
    {
        unset($data['id']);

        return $this->repository->store($data);
    }

    public function getValidObjects()
    {
        return $this->repository->getValidObjects();
    }

    public function deleteById(int $id)
    {
        return $this->repository->deleteById($id);
    }

    public function getDataToCreate()
    {
        return [];
    }
}
