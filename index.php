<?php

include('systems/config.php');

session_start();

$url = isset($_GET['url']) ? $_GET['url'] : '';
$url = rtrim($url, '/');
$url = explode('/', $url);

if (isset($url[1])) {
    $id = isset($url[1]) ? $url[1] : '';
    $filename = 'pages/' . $url[0] . '.php';
    if (file_exists($filename)) {
        require_once('pages/' . $url[0] . '.php');
    } else {
        require_once('pages/404.php');
    }
} else if ($url[0] != '') {
    $filename = 'pages/' . $url[0] . '.php';
    if (file_exists($filename)) {
        require_once('pages/' . $url[0] . '.php');
    } else {
        require_once('pages/404.php');
    }
} else {
    require_once('pages/index.php');
}
