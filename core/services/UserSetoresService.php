<?php

namespace app\services;

use app\handlers\UserSetorHandler;
use app\validators\UserSetoresValidator;
use app\repositories\UserSetorRepository;
use app\services\AbstractDatabaseService;

class UserSetoresService extends AbstractDatabaseService
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

    public function updateBulk(array $relations, int $userId)
    {
        $this->getRepository()->deleteByUser($userId);
        
        if (empty($relations)) {
            return;
        }
        
        return $this->storeBulk($relations, $userId);
    }
}
