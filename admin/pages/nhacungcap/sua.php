<?php

$title = 'Sửa nhà cung cấp';
$id = isset($_GET['id']) ? intval($_GET['id']) : '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tenncc = isset($_POST['tenncc']) ? $_POST['tenncc'] : '';
    $diachi = isset($_POST['diachi']) ? $_POST['diachi'] : '';

    if (!$tenncc || !$diachi) {
        $error = 'Tên nhà cung cấp hoặc địa chỉ không được để trống.';
    } else {
        $stmt = $conn->prepare('UPDATE ncc SET tenncc = ?, diachi = ? WHERE id = ?');
        $result = $stmt->execute([
            $tenncc,
            $diachi,
            $id
        ]);
        if ($result) {
            $success = 'Sửa thành công';
        } else {
            $error = 'Sửa thất bại';
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
                    <h1 class="m-0">Sửa nhà cung cấp</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= BASE_URL ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= BASE_URL ?>/danhmuc">Danh mục</a></li>
                        <li class="breadcrumb-item active">Sửa nhà cung cấp</li>
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
                    if (isset($error)) {
                        echo '<div class="alert alert-danger" role="alert">
                        ' . $error . '
                        </div>';
                    }

                    ?>

                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Sửa nhà cung cấp</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="" method="post">
                            <div class="card-body">
                                <div class="form-group">
                                    <?php
                                    $stmt = $conn->prepare("SELECT * FROM ncc WHERE id = ?");
                                    $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                    $stmt->execute([
                                        $id
                                    ]);
                                    while ($row = $stmt->fetch()) :
                                    ?>
                                        <label for="tenncc">Tên nhà cung cấp</label>
                                        <input type="text" class="form-control" name="tenncc" id="tenncc" value="<?= $row['tenncc'] ?>" placeholder="Nhập tên nhà cung cấp">
                                        <label for="diachi" class="mt-4">Địa chỉ</label>
                                        <input type="text" class="form-control" name="diachi" id="diachi" value="<?= $row['diachi'] ?>" placeholder="Nhập địa chỉ nhà cung cấp">
                                    <?php
                                    endwhile;
                                    ?>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Sửa</button>
                                <a href="<?= BASE_URL ?>/nhacungcap/danhsach" class="btn btn-primary">Danh sách</a>
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
<?php

require_once('layouts/footer.php');

?>