<?php

$title = 'Trang chủ';

require_once('layouts/header.php');

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Danh sách</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= BASE_URL ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= BASE_URL ?>/danhmuc">Danh mục</a></li>
                        <li class="breadcrumb-item active">Danh sách</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Danh sách các nhà cung cấp</h3>

                            <form action="#" method="POST" enctype="multipart/form" class="card-tools">
                                <div class="input-group input-group-sm" style="width: 295px;">
                                    <input type="text" name="table_search" class="form-control float-right" placeholder="Nhập tên nhà cung cấp để tìm kiếm...">

                                    <div class="input-group-append">
                                        <input type="submit" name="submit" value="Search" class="btn btn-default">
                                        <!-- <i class="fas fa-search"></i> -->
                                        </input>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên</th>
                                        <th>Địa chỉ</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($_POST['submit'])) {
                                        $table_search = isset($_POST['table_search']) ? $_POST['table_search'] : '';
                                        $stmt = $conn->prepare("SELECT * FROM ncc where tenncc like '%" . $table_search . "%'");
                                    } else {
                                        $stmt = $conn->prepare('SELECT * FROM ncc');
                                    }
                                    $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                    $stmt->execute();
                                    $stt = 1;
                                    while ($row = $stmt->fetch()) :
                                    ?>
                                        <tr>
                                            <td><?= $stt++ ?></td>
                                            <td class="tenncc-diachi"><?= $row['tenncc'] ?></td>
                                            <td class="tenncc-diachi"><?= $row['diachi'] ?></td>
                                            <td>
                                                <a href="<?= BASE_URL ?>/nhacungcap/sua?id=<?= $row['id'] ?>" class="btn btn-primary">Sửa</a>
                                                <a href="<?= BASE_URL ?>/nhacungcap/xoa?id=<?= $row['id'] ?>" class="btn btn-danger" onclick="return confirm('Xoá nhà cung cấp này?')">Xoá</a>
                                            </td>
                                        </tr>
                                    <?php
                                    endwhile;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<style>
    .tenncc-diachi {
        max-width: 500px;
        text-overflow: ellipsis;
        white-space: nowrap;
        overflow: hidden;
    }
</style>

<?php

require_once('layouts/footer.php');

?>