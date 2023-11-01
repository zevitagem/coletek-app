<?php

include_once 'vendor/autoload.php';

setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');

if (env('APP_ENVIROMENT') == 'local') {
    error_reporting(E_ALL ^ E_NOTICE);
    ini_set('display_errors', 1);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
}

define('OPTION_TYPE_DB_SQLSERVER', 'SQLSERVER');
define('OPTION_TYPE_DB_MYSQL', 'MYSQL');
define('TYPE_DB', OPTION_TYPE_DB_MYSQL);
define('PREFIX_ACCESS_FOLDER', '../');

register_shutdown_function(function () {

    $error = error_get_last();

    if (is_array($error) && $error['type'] === E_ERROR) {

        $data = ['POST' => $_POST, 'GET' => $_GET, 'ERROR' => $error];

        if (isAjax()) {
            echo json_encode($data['ERROR']);
        } else {
            header('Location: ' . route('simple.php?action=error&e=' . base64_encode($error['message'])));
        }
    }
});
