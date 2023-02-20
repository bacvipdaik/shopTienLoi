<?php

$title = 'Thêm nhà cung cấp';



if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $tenncc = isset($_POST['tennhacungcap']) ? $_POST['tennhacungcap'] : '';
    $diachi = isset($_POST['diachi']) ? $_POST['diachi'] : '';

    if ($tenncc == '') {
        $error[] = 'Tên nhà cung cấp không được để trống.';
    }

    if ($diachi == '') {
        $error[] = 'Địa không được để trống.';
    }

    if (!isset($error)) {
        $stmt = $conn->prepare('INSERT INTO ncc (tenncc, diachi) VALUES (?, ?)');
        $stmt->execute([
            $tenncc,
            $diachi
        ]);
        $result = $stmt->rowCount();
        if ($result > 0) {
            $success = 'Thêm thành công';
        } else {
            $error = 'Thêm thất bại';
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
                    <h1 class="m-0">Thêm nhà cung cấp</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= BASE_URL ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= BASE_URL ?>/danhmuc">Danh mục</a></li>
                        <li class="breadcrumb-item active">Thêm nhà cung cấp</li>
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
                    ?>
                    <?php
                    if (isset($error)) :
                    ?>
                        <div class="alert alert-danger" role="alert">
                            <ul>
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
                            <h3 class="card-title">Thêm nhà cung cấp</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="" method="post">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="tennhacungcap">Tên nhà cung cấp</label>
                                    <input type="text" class="form-control" name="tennhacungcap" id="tennhacungcap" placeholder="Nhập tên nhà cung cấp">
                                </div>
                                <div class="form-group">
                                    <label for="diachi">Địa chỉ</label>
                                    <input type="text" class="form-control" name="diachi" id="diachi"  placeholder="Nhập địa chỉ">
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Thêm</button>
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