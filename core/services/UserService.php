<?php

namespace app\services;

use app\services\AbstractDatabaseService;
use app\validators\UserValidator;
use app\repositories\UserRepository;
use app\repositories\SetoresRepository;
use app\repositories\UserSetorRepository;
use app\services\UserSetoresService;
use app\handlers\UserHandler;
use Throwable;
use app\contracts\CRUDServiceContract;

class UserService extends AbstractDatabaseService implements CRUDServiceContract
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

    public function getIndexData(array $data)
    {
        $this->handle($data, 'index');

        return [
            'rows' => $this->getByCondition($data),
            'setores' => $this->dependencies['setores_repository']->get()
        ];
    }

    public function getCreateData()
    {
        $setores = $this->dependencies['setores_repository']->get();
        $setores_adicionados = [];

        return compact('setores', 'setores_adicionados');
    }

    public function getShowData(int $id)
    {
        $row = $this->repository->getById($id);
        $this->validate(['row' => $row], 'show');

        $default = $this->getCreateData();
        $default['setores_adicionados'] = $this->dependencies['user_setor_repository']->getByUser($id);
        $default['row'] = $row;

        return $default;
    }

    public function update(array $data)
    {
        $this->repository->beginTransaction();

        try {
            $this->handle($data, __FUNCTION__);

            $row = $this->repository->getById($data['id']);
            $data['row'] = $row;

            $this->validate($data, __FUNCTION__);

            $this->repository->updateById($data['id'], [
                'name' => $data['name'],
                'email' => $data['email'],
            ]);

            $this->dependencies['user_setores_service']->updateBulk(
                $data['setores_adicionados'],
                $data['id']
            );

            $this->repository->commit();

            return true;
        } catch (Throwable $exc) {
            $this->repository->rollBack();
            throw $exc;
        }
    }

    public function destroy(int $id)
    {
        $this->repository->beginTransaction();

        try {
            $row = $this->repository->getById($id);
            $data['row'] = $row;

            $this->validate($data, __FUNCTION__);

            parent::deleteById($id);

            $this->dependencies['user_setor_repository']->deleteByUser($id);

            $this->repository->commit();

            return true;
        } catch (Throwable $exc) {
            $this->repository->rollBack();
            throw $exc;
        }
    }

    public function store(array $data)
    {
        $this->repository->beginTransaction();

        try {
            $this->handle($data, __FUNCTION__);
            $this->validate($data, __FUNCTION__);

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
