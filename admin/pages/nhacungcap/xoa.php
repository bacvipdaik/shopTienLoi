<?php

$id = isset($_GET['id']) ? ($_GET['id']) : '';

if ($id != '') {

    $stmt = $conn->prepare('SELECT * FROM sanpham WHERE ncc_id = ?');
    $stmt->execute([
        $id
    ]);
    $result = $stmt->rowCount();

    if ($result > 0) {
        echo "<script>
            alert('Vui lòng xoá hết sản phẩm liên quan tới nhà cung cấp này!');
            history.back();
        </script>";
    } else {
        $stmt = $conn->prepare('DELETE FROM ncc WHERE id = ?');
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
}
