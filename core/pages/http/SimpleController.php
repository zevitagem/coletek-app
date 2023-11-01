<?php

namespace app\pages\http;

class SimpleController
{
    public function index()
    {
        includeWithVariables(view('simple.php'));
    }

    public function error()
    {
        $message = base64_decode($_GET['e']);

        includeWithVariables(view('error.php'), ['message' => $message]);
    }
}
