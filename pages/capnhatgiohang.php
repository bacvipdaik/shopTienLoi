<?php
$soluong = isset($_POST['soluong']) ? $_POST['soluong'] : '';
foreach ($soluong as $id => $soluong) {
    foreach ($_SESSION['giohang'] as $sanpham => $value) {
        if ($value['id'] == $id) {
            $_SESSION['giohang'][$sanpham]['soluong'] = $soluong;
        }
    }
}
header('Location: ' . HOME . '/giohang');
