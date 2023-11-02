<?php

namespace app\pages\http;

use app\pages\http\AbstractUiController;

class HomeController extends AbstractUiController
{
    public function __construct()
    {
        parent::__construct([
            'has_auth' => false
        ]);
    }

    public function index()
    {
        $this->addIndexAssets();

        parent::view('home.php', []);
    }
}
