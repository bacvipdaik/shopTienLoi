<?php

if (isset($_SESSION['giohang'])) {
    foreach ($_SESSION['giohang'] as $sanpham => $value) {
        if ($value['id'] == $id) {
            unset($_SESSION['giohang'][$sanpham]);
        }
    }
    if(count($_SESSION['giohang']) == 0){
    	unset($_SESSION['giohang']);
    }
    header('Location: ' . HOME . '/giohang');
}
