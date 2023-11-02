<?php

namespace app\services;

use app\services\AbstractService;

abstract class AbstractDatabaseService extends AbstractService
{
    public function configure()
    {
        connectMYSQL();

        parent::configure();
    }

    protected function getById(int $id)
    {
        return $this->repository->getById($id);
    }

    protected function updateById(int $id, array $data)
    {
        unset($data['id']);

        return $this->repository->updateById($id, $data);
    }

    protected function deleteById(int $id)
    {
        return $this->repository->deleteById($id);
    }

    protected function store(array $data)
    {
        unset($data['id']);

        return $this->repository->store($data);
    }

    protected function deleteByCondition(array $condition)
    {
        return $this->repository->deleteByCondition($condition);
    }

    protected function getByCondition(array $condition)
    {
        return $this->repository->getByCondition($condition);
    }

    protected function save(array $data)
    {
        return $this->repository->save($data);
    }

    protected function get()
    {
        return $this->repository->get();
    }
}
