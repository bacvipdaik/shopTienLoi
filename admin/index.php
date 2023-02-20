<?php

include('../systems/config.php');
include('config/config.php');

session_start();

if (isset($_SESSION['dangnhap_admin'])) {
    $url = isset($_GET['url']) ? $_GET['url'] : '';
    if ($url != '') {
        $filename = 'pages/' . $url . '.php';
        if (file_exists($filename)) {
            require_once('pages/' . $url . '.php');
        } else {
            require_once('pages/404.php');
        }
    } else {
        require_once('pages/index.php');
    }
} else {
    require_once('pages/dangnhap.php');
}
