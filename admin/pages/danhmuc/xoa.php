<?php

$id = isset($_GET['id']) ? ($_GET['id']) : '';

if($id != '') {
    $stmt = $conn->prepare('SELECT * FROM sanpham WHERE danhmuc_id = ?');
    $stmt->execute([
        $id
    ]);
    $result = $stmt->rowCount();

    if($result > 0) {
        echo "<script>
            alert('Vui lòng xoá hết sản phẩm trong danh mục!');
            history.back();
        </script>";
    } else {
        $stmt = $conn->prepare('DELETE FROM danhmuc WHERE id = ?');
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
            $error = 'Sửa thất bại';
        }
    }
}
