<?php

namespace app\handlers;

use app\handlers\AbstractHandler;

class UserHandler extends AbstractHandler
{
    public function form()
    {
        $data = & $this->data;

        $data['name'] = (empty($data['name'])) ? null : $data['name'];
        $data['email'] = (empty($data['email'])) ? null : $data['email'];
        $data['setores_adicionados'] = (empty($data['setor-adicionado']) || !is_array($data['setor-adicionado'])) ? [] : $data['setor-adicionado'];

        if (isset($data['setor-adicionado'])) {
            unset($data['setor-adicionado']);
        }
        if (!empty($data['setores_adicionados'])) {
            $data['setores_adicionados'] = array_filter($data['setores_adicionados'], 'is_numeric');
            $data['setores_adicionados'] = array_unique($data['setores_adicionados']);
        }
    }
    
    public function index()
    {
        $data = & $this->data;
        
        $data['setor'] = (empty($data['setor'])) ? null : (int) $data['setor'];
    }

    public function store()
    {
        $this->form();
    }

    public function update()
    {
        $this->form();
    }
}
