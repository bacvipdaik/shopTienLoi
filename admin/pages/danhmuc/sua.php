<?php

$title = 'Sửa danh mục';
$id = isset($_GET['id']) ? intval($_GET['id']) : '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tendanhmuc = isset($_POST['tendanhmuc']) ? $_POST['tendanhmuc'] : '';

    if ($tendanhmuc == '') {
        $error = 'Tên danh mục không được để trống.';
    } else {
        $stmt = $conn->prepare('UPDATE danhmuc SET tendanhmuc = ? WHERE id = ?');
        $result = $stmt->execute([
            $tendanhmuc,
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
                    <h1 class="m-0">Sửa danh mục</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= BASE_URL ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= BASE_URL ?>/danhmuc">Danh mục</a></li>
                        <li class="breadcrumb-item active">Sửa danh mục</li>
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
                            <h3 class="card-title">Thêm danh mục</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="" method="post">
                            <div class="card-body">
                                <div class="form-group">
                                    <?php
                                    $stmt = $conn->prepare("SELECT * FROM danhmuc WHERE id = ?");
                                    $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                    $stmt->execute([
                                        $id
                                    ]);
                                    while ($row = $stmt->fetch()) :
                                    ?>
                                        <label for="tendanhmuc">Tên danh mục</label>
                                        <input type="text" class="form-control" name="tendanhmuc" id="tendanhmuc" value="<?= $row['tendanhmuc'] ?>" placeholder="Nhập tên danh mục">
                                    <?php
                                    endwhile;
                                    ?>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Sửa</button>
                                <a href="<?= BASE_URL ?>/danhmuc/danhsach" class="btn btn-primary">Danh sách</a>
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