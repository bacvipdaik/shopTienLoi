<?php

// Thêm giỏ hàng
if ($id != '') {
    $soluong = isset($_POST['soluong']) ? $_POST['soluong'] : '1';
    $stmt = $conn->prepare("SELECT * FROM sanpham WHERE id = ?");
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->execute([
        $id
    ]);
    $row = $stmt->fetch();
    if ($row) {
        $sanphammoi[] = array(
            'id' => $id,
            'tensp' => $row['tensp'],
            'anh' => $row['anh'],
            'gia' => $row['gia'],
            'donvi' => $row['donvi'],
            'soluong' => $soluong
        );
    }
    if (isset($_SESSION['giohang'])) {
        $found = false;
        foreach ($_SESSION['giohang'] as $sanpham) {
            if ($sanpham['id'] == $id) {
                $a[] = array(
                    'id' => $sanpham['id'],
                    'tensp' => $sanpham['tensp'],
                    'anh' => $sanpham['anh'],
                    'gia' => $sanpham['gia'],
                    'donvi' => $sanpham['donvi'],
                    'soluong' => $sanpham['soluong'] + $soluong
                );
                $found = true;
            } else {
                $a[] = array(
                    'id' => $sanpham['id'],
                    'tensp' => $sanpham['tensp'],
                    'anh' => $sanpham['anh'],
                    'gia' => $sanpham['gia'],
                    'donvi' => $sanpham['donvi'],
                    'soluong' => $sanpham['soluong']
                );
            }
        }
        if ($found == false) {
            $_SESSION['giohang'] = array_merge($a, $sanphammoi);
        } else {
            $_SESSION['giohang'] = $a;
        }
    } else {
        $_SESSION['giohang'] = $sanphammoi;
    }
}
header('Location: ' . $_SERVER['HTTP_REFERER']);
