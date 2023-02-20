<?php

$id = isset($_GET['id']) ? ($_GET['id']) : '';

if ($id != '') {
    $stmt = $conn->prepare('SELECT anh FROM sanpham WHERE id = ?');
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->execute([
        $id
    ]);
    $sanpham = $stmt->fetch();
    $anh = $sanpham['anh'];
    $path = '../assets/images/sanpham/';

    if (file_exists($path . $anh)) {
        unlink($path . $anh);
    }

    $stmt = $conn->prepare('DELETE FROM sanpham WHERE id = ?');
    $stmt->execute([
        $id
    ]);
    $result = $stmt->rowCount();
    if ($result > 0) {
        echo "<script>
                alert('Xoá thành công!');
                history.back();
            </script>";
    } else {
        $error = 'Xoá thất bại';
    }
}
