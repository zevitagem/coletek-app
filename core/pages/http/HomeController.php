<?php

namespace app\pages\http;

use app\pages\http\BaseUiController;

class HomeController extends BaseUiController
{
    public function __construct()
    {
        parent::__construct([
            'has_auth' => false,
            'assets' => [
                'css' => [
                    'app/home/index.css'
                ],
                'js' => [
                    'app/home/index.js'
                ]
            ]
        ]);
    }

    public function index()
    {
        parent::view('home.php', []);
    }
}
