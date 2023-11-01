<?php

namespace app\services;

use app\services\PeopleService;
use app\validators\ProcessFormValidator;
use app\repositories\ProcessRepository;
use app\services\StatusService;
use app\services\UnityService;
use app\handlers\ProcessHandler;

class ProcessService extends AbstractCrudService
{
    public function __construct()
    {
        parent::setRepository(new ProcessRepository());
        parent::setValidator(new ProcessFormValidator());
        parent::setHandler(new ProcessHandler());

        $this->setDependencie('people_service', new PeopleService());
        $this->setDependencie('status_service', new StatusService());
        $this->setDependencie('unity_service', new UnityService());
    }

    public function getDataToCreate()
    {
        $people = $this->dependencies['people_service']->getValidObjects();
        $status = $this->dependencies['status_service']->getValidObjects();
        $unities = $this->dependencies['unity_service']->getValidObjects();

        return compact('people', 'status', 'unities');
    }

    public function getDataToShow(int $id)
    {
        $process = $this->repository->getById($id);
        $default = $this->getDataToCreate();

        if (empty($process)) {
            return [];
        }

        return array_merge(
            compact('process'),
            $default
        );
    }

    public function store(array $data)
    {
        return $this->repository->store($data);
    }
}
