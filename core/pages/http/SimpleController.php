<?php

namespace app\pages\http;

use app\pages\http\Controller;

class SimpleController extends Controller
{
    public function index()
    {
        includeWithVariables(view('simple.php'));
    }

    public function error()
    {
        $message = (isset($_GET['e'])) ? base64_decode($_GET['e']) : '';

        includeWithVariables(view('components/error.php'), ['message' => $message]);
    }
}
