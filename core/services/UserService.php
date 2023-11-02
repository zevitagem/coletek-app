<?php

namespace app\services;

use app\validators\UserFormValidator;
use app\repositories\UserRepository;
use app\repositories\SetoresRepository;
use app\repositories\UserSetorRepository;
use app\services\UserSetoresService;
use app\handlers\UserHandler;
use Throwable;

class UserService extends AbstractCrudService
{
    public function __construct()
    {
        parent::setRepository(new UserRepository());
        parent::setValidator(new UserFormValidator());
        parent::setHandler(new UserHandler());

        $this->setDependencie('setores_repository', new SetoresRepository());
        $this->setDependencie('user_setor_repository', new UserSetorRepository());
        $this->setDependencie('user_setores_service', new UserSetoresService());
    }

    public function getDataToCreate()
    {
        $setores = $this->dependencies['setores_repository']->getValidObjects();
        $setores_adicionados = [];

        return compact('setores', 'setores_adicionados');
    }

    public function getDataToShow(int $id)
    {
        $row = $this->repository->getById($id);
        $default = $this->getDataToCreate();

        if (empty($row)) {
            return [];
        }

        return array_merge(
            compact('row'),
            $default
        );
    }

    public function store(array $data)
    {
        try {
            $this->repository->beginTransaction();

            $userId = $this->repository->store([
                'name' => $data['name'],
                'email' => $data['email'],
            ]);

            $this->dependencies['user_setores_service']->storeBulk(
                $data['setores_adicionados'],
                $userId
            );

            $this->repository->commit();

            return true;
        } catch (Throwable $exc) {
            $this->repository->rollBack();
            throw $exc;
        }
    }
}
