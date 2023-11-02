<?php

namespace app\services;

use app\handlers\UserSetorHandler;
use app\validators\UserSetoresValidator;
use app\repositories\UserSetorRepository;

class UserSetoresService extends AbstractCrudService
{
    public function __construct()
    {
        parent::setRepository(new UserSetorRepository());
        parent::setValidator(new UserSetoresValidator());
        parent::setHandler(new UserSetorHandler());
    }

    public function storeBulk(array $relations, int $userId)
    {
        if (empty($relations)) {
            return;
        }

        $list = [];
        foreach ($relations as $key => $relation) {

            $data = [
                'posicao_visual_setor' => $key + 1,
                'user_id' => $userId,
                'setor_id' => $relation,
            ];

            parent::handle($data, 'store');
            parent::validate($data, 'store');

            $list[] = $data;
        }

        foreach ($list as $row) {
            $this->getRepository()->store($row);
        }
    }

    public function update(array $data, int $userId)
    {
        $data['primary_task_id'] = $relation->getId();

        parent::handle($data, 'update');
        parent::validate($data, 'update');

        $relation->fill([
            'secondary_task_id' => $data['secondary_task_id'],
            'relation_id' => $data['relation_id']
        ]);

        return $this->getRepository()->update($relation);
    }
}
