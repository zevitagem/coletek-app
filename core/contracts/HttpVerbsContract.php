<?php

namespace app\contracts;

interface HttpVerbsContract
{
    public function get(string $url, array $params);
}
