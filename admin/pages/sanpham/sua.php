<?php

$title = 'Cập nhật sản phẩm';
$id = isset($_GET['id']) ? intval($_GET['id']) : '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tensp = isset($_POST['tensp']) ? $_POST['tensp'] : '';
    $anh = isset($_FILES['anh']["name"]) ? $_FILES['anh']["name"] : '';
    $anhcu = isset($_POST['anhcu']) ? $_POST['anhcu'] : '';
    $mota = isset($_POST['mota']) ? $_POST['mota'] : '';
    $gia = isset($_POST['gia']) ? $_POST['gia'] : '';
    $hdsd = isset($_POST['hdsd']) ? $_POST['hdsd'] : '';
    $trangthai = isset($_POST['trangthai']) ? $_POST['trangthai'] : '';
    $donvi = isset($_POST['donvi']) ? $_POST['donvi'] : '';
    $danhmuc = isset($_POST['danhmuc']) ? $_POST['danhmuc'] : '';
    $ncc = isset($_POST['ncc']) ? $_POST['ncc'] : '';

    if ($tensp == '') {
        $error[] = 'Tên sản phẩm không được để trống.';
    }
    if ($mota == '') {
        $error[] = 'Mô tả không được để trống.';
    }
    if ($hdsd == '') {
        $error[] = 'Hướng dẫn sử dụng không được để trống.';
    }
    if ($gia == '') {
        $error[] = 'Giá không được để trống.';
    } else if (is_numeric($mota)) {
        $error[] = 'Giá sai định dạng.';
    }

    if ($anh != '') {
        // Nếu file upload không bị lỗi,
        // Tức là thuộc tính error > 0

        // Upload file

        $filename = current(explode(".", $_FILES["anh"]["name"]));
        $imageFileType = pathinfo($_FILES["anh"]["name"], PATHINFO_EXTENSION);
        $anh = $filename . '_' . rand(0, 1000) . '.' . $imageFileType;
        $path = '../assets/images/sanpham/';
        // Allow certain file formats
        if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
            $error[] = 'Chỉ được upload ảnh có đuôi .jpg, .png, .jpeg, .gif.';
        }
        if (file_exists($path . $anhcu)) {
            unlink($path . $anhcu);
        }
        move_uploaded_file($_FILES['anh']['tmp_name'], $path . $anh);
    } else {
        $anh = $anhcu;
    }

    if (!isset($error)) {
        $stmt = $conn->prepare('UPDATE sanpham set tensp = ?, anh = ?, mota = ?, hdsd = ?, trangthai = ?, gia = ?, donvi = ?, danhmuc_id = ?, ncc_id = ? where id = ?');
        $result = $stmt->execute([
            $tensp,
            $anh,
            $mota,
            $hdsd,
            $trangthai,
            $gia,
            $donvi,
            $danhmuc,
            $ncc,
            $id
        ]);
        if ($result) {
            $success = 'Sửa thành công.';
        } else {
            $error[] = 'Sửa thất bại.';
        }
    }
}

require_once('layouts/header.php');

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Cập nhật sản phẩm</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= BASE_URL ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= BASE_URL ?>/danhmuc">Danh mục</a></li>
                        <li class="breadcrumb-item active">Cập nhật sản phẩm</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->

            <!-- general form elements -->
            <div class="d-flex justify-content-center">
                <div class="col-md-6">
                    <?php
                    if (isset($success)) {
                        echo '<div class="alert alert-success" role="alert">
                        ' . $success . '
                        </div>';
                    }
                    if (isset($error)) :
                    ?>
                        <div class="alert alert-danger" role="alert">
                            <ul class="pl-3 m-0">
                                <?php
                                foreach ($error as $a) {
                                    echo '<li>' . $a . '</li>';
                                }
                                ?>
                            </ul>
                        </div>
                    <?php
                    endif;

                    ?>

                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Cập nhật sản phẩm</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <?php
                                    $stmt = $conn->prepare('SELECT * from sanpham where id = ?');
                                    $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                    $stmt->execute([
                                        $id
                                    ]);
                                    while ($row = $stmt->fetch()) :
                                    ?>
                                        <div class="card-body">
                                            <div class="form-group mt-1">
                                                <label for="tensp">Tên sản phẩm</label>
                                                <input type="text" class="form-control" name="tensp" id="tensp" placeholder="Nhập tên sản phẩm" value="<?= $row['tensp'] ?>">
                                            </div>
                                            <div class="form-group mt-1">
                                                <label for="anh">Hình ảnh</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" name="anh" id="anh">
                                                        <label class="custom-file-label" for="anh">Chọn hình ảnh</label>
                                                    </div>
                                                </div>
                                                <img src="../../assets/images/sanpham/<?= $row['anh'] ?>" alt="" width="150px" class="my-2">
                                                <input type="hidden" name="anhcu" value="<?= $row['anh'] ?>">
                                            </div>
                                            <div class="form-group mt-1">
                                                <label for="mota">Mô tả</label>
                                                <textarea class="form-control" name="mota" id="mota"><?= $row['mota'] ?></textarea>
                                            </div>
                                            <div class="form-group mt-1">
                                                <label for="hdsd">Hướng dẫn sử dụng</label>
                                                <textarea class="form-control" name="hdsd" id="hdsd"><?= $row['hdsd'] ?></textarea>
                                            </div>
                                            <div class="form-group mt-1">
                                                <label for="gia">Giá</label>
                                                <input type="number" class="form-control" name="gia" id="gia" value="<?= $row['gia'] ?>" min="1" placeholder="Giá sản phẩm">
                                            </div>
                                            <div class="form-group mt-1">
                                                <label for="trangthai">Trạng thái</label>
                                                <select class="custom-select" id="trangthai" name="trangthai">
                                                    <option value="1" <?php echo $row['trangthai'] == '1' ? 'selected' : '' ?>>Còn hàng</option>
                                                    <option value="0" <?php echo $row['trangthai'] == '0' ? 'selected' : '' ?>>Hết hàng</option>
                                                </select>
                                            </div>
                                            <div class="form-group mt-1">
                                                <label for="donvi">Đơn vị</label>
                                                <select class="custom-select" id="donvi" name="donvi">
                                                    <option value="Cái" <?php echo $row['donvi'] == 'Cái' ? 'selected' : '' ?>>Cái</option>
                                                    <option value="Chiếc" <?php echo $row['donvi'] == 'Chiếc' ? 'selected' : '' ?>>Chiếc</option>
                                                    <option value="ml" <?php echo $row['donvi'] == 'ml' ? 'selected' : '' ?>>ml</option>
                                                    <option value="KG" <?php echo $row['donvi'] == 'KG' ? 'selected' : '' ?>>KG</option>
                                                    <option value="Lon" <?php echo $row['donvi'] == 'Lon' ? 'selected' : '' ?>>Lon</option>
                                                    <option value="Hộp" <?php echo $row['donvi'] == 'Hộp' ? 'selected' : '' ?>>Hộp</option>
                                                    <option value="Thùng" <?php echo $row['donvi'] == 'Thùng' ? 'selected' : '' ?>>Thùng</option>
                                                    <option value="Chai" <?php echo $row['donvi'] == 'Chai' ? 'selected' : '' ?>>Chai</option>
                                                </select>
                                            </div>
                                            <div class="form-group mt-1">
                                                <label for="danhmuc">Danh mục</label>
                                                <select class="custom-select" id="danhmuc" name="danhmuc">
                                                    <?php
                                                    $stmt = $conn->prepare("SELECT * FROM danhmuc");
                                                    $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                                    $stmt->execute([]);
                                                    while ($row_danhmuc = $stmt->fetch()) :
                                                    ?>
                                                        <option value="<?= $row_danhmuc['id'] ?>" <?php echo $row['danhmuc_id'] == $row_danhmuc['id'] ? 'selected' : '' ?>><?= $row_danhmuc['tendanhmuc'] ?></option>
                                                    <?php
                                                    endwhile;
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group mt-1">
                                                <label for="ncc">Nhà cung cấp</label>
                                                <select class="custom-select" id="ncc" name="ncc">
                                                    <?php
                                                    $stmt = $conn->prepare("SELECT * FROM ncc");
                                                    $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                                    $stmt->execute();
                                                    while ($row_nhacungcap = $stmt->fetch()) :
                                                    ?>
                                                        <option value="<?= $row_nhacungcap['id'] ?>" <?php echo $row['ncc_id'] == $row_nhacungcap['id'] ? 'selected' : '' ?>><?= $row_nhacungcap['tenncc'] ?></option>
                                                    <?php
                                                    endwhile;
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                                            <a href="<?= BASE_URL ?>/sanpham/danhsach" class="btn btn-primary">Danh sách</a>
                                        </div>
                                    <?php
                                    endwhile;
                                    ?>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">

            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script src="//cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
    $('input[type="file"]').change(function(e) {
        var fileName = e.target.files[0].name;
        $('.custom-file-label').html(fileName);
    });
    CKEDITOR.replace('mota');
</script>

<?php

require_once('layouts/footer.php');

?>