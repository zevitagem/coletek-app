<?php

namespace app\requesters;

use app\adapters\request\GuzzleRequestAdapter;
use app\contracts\HttpVerbsContract;

class HttpRequester
{
    private HttpVerbsContract $adapter;

    public function __construct()
    {
        $this->adapter = new GuzzleRequestAdapter();
    }

    public function generateToken()
    {
        try {
            return $this->adapter->get(env('API_URL'), [
                'action' => 'authToken',
                'email' => env('API_EMAIL'),
                'senha' => env('API_PASSWORD'),
            ]);
        } catch (\Throwable $exc) {
            dd($exc);
        }
    }
}
