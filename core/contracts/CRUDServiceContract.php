<?php

namespace app\contracts;

interface CRUDServiceContract
{
    public function getIndexData();

    public function getCreateData();

    public function getShowData(int $id);

    public function update(array $data);

    public function destroy(int $id);

    public function store(array $data);
}
