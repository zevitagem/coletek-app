<?php

namespace app\services;

use app\validators\UserValidator;
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
        parent::setValidator(new UserValidator());
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
        $this->validate(['row' => $row], 'show');

        $default = $this->getDataToCreate();
        $default['setores_adicionados'] = $this->dependencies['user_setor_repository']->getByUser($id);
        $default['row'] = $row;

        return $default;
    }
    
    public function update(array $data)
    {
        try {
            $this->repository->beginTransaction();
            
            $row = $this->repository->getById($data['id']);
            $data['row'] = $row;

            $this->validate($data, __FUNCTION__);
            dd($data);
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

    public function store(array $data)
    {
        try {
            $this->validate($data, __FUNCTION__);
            
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
