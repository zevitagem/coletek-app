<?php

function base_url()
{
    return dirname(dirname(__FILE__));
}

function asset($path)
{
    $prefix = PREFIX_ACCESS_FOLDER;

    return $prefix . 'assets/' . $path;
}

function shared($file)
{
    $prefix = PREFIX_ACCESS_FOLDER;

    return $prefix . 'shared/' . $file;
}

function view($path)
{
    $prefix = PREFIX_ACCESS_FOLDER;

    return $prefix . 'resources/views/' . $path;
}

function libraryPath($libraryName, $file)
{
    $prefix = PREFIX_ACCESS_FOLDER;

    return $prefix . 'app/libraries/' . $libraryName . '/' . $file;
}

function template($path)
{
    $prefix = PREFIX_ACCESS_FOLDER;

    return $prefix . 'resources/views/templates/' . $path;
}

function route($path)
{
    $prefix = PREFIX_ACCESS_FOLDER;

    return $prefix . 'routes/' . $path;
}

function filepath($path, $file, string $prefix = '')
{
    if (empty($prefix)) {
        $prefix = PREFIX_ACCESS_FOLDER;
    }

    return $prefix . 'assets/files/' . $path . '/' . $file;
}

function hasPrintDebug()
{
    return (
        isset($_SERVER['HTTP_REFERER']) &&
        strpos($_SERVER['HTTP_REFERER'], 'printDebug=1')
    );
}

function dd($data, $print = false, $exit = true)
{
    echo '<pre>';
    ($print) ? print_r($data) : var_dump($data);
    echo '</pre>';

    if ($exit) {
        exit;
    }
}

function editCrudRoute(string $context, int $id)
{
    return route($context . '.php?action=edit&id=' . $id);
}

function createCrudRoute(string $context)
{
    return route($context . '.php?action=create');
}

function deleteCrudRoute(string $context, int $id)
{
    return route($context . '.php?action=delete&id=' . $id);
}

function indexCrudRoute(string $context)
{
    return route($context . '.php?action=index');
}

function isAjax()
{
    return (strtolower($_SERVER['HTTP_X_REQUESTED_WITH'] ?? '') == 'xmlhttprequest');
}

function printSession($exit = true)
{
    echo '<pre>';
    print_r($_SESSION, true);
    echo '</pre>';

    if ($exit) {
        exit;
    }
}

function formatTimestampToDatetime($timestamp, $mili = false)
{
    return date('Y-m-d H:i:s', $timestamp / ($mili ? 1000 : 1));
}

function formatDatetimeToBR($datetime = null)
{
    if (empty($datetime)) {
        return ' - ';
    }

    $time = strtotime($datetime);
    return date('d/m/Y H:i:s', $time);
}

function formatBRDateToAmerican($datetime = null)
{
    if (empty($datetime)) {
        return ' - ';
    }

    list($d, $m, $y) = explode('/', $datetime);

    return date('Y-m-d', strtotime($y . '-' . $m . '-' . $d));
}

function formatTimeToSeconds($time = '00:00:00')
{
    list($hour, $minute, $second) = explode(':', $time);

    return ($hour * 60 * 60) + ($minute * 60) + $second;
}

function printQuery($sth)
{
    dd($sth->debugDumpParams());
}

function includeWithVariables($filePath, $variables = array(), $print = true)
{
    if (!file_exists($filePath)) {
        return;
    }

    extract($variables);

    ob_start();

    include $filePath;

    $output = ob_get_clean();

    if ($print) {
        echo $output;
    }

    return $output;
}

function connectMYSQL()
{
    return \app\libraries\PDOConnection\PDOConnector::connect(OPTION_TYPE_DB_MYSQL);
}

function connectSQLSERVER()
{
    return \app\libraries\PDOConnection\PDOConnector::connect(OPTION_TYPE_DB_SQLSERVER);
}

function env($key, string $prefixAccessFolder = '../')
{
    $prefix = (!empty($prefixAccessFolder)) ? $prefixAccessFolder : PREFIX_ACCESS_FOLDER;
    $envs = parse_ini_file($prefix . '.env');

    return $envs[$key] ?? null;
}

function extractJsonFromRequester(Psr\Http\Message\ResponseInterface $requester)
{
    $content = $requester->getBody()->getContents();
    $json = json_decode($content, true);

    return $json ?? ['message' => $content, 'status' => false];
}
