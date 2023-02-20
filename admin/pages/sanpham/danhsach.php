<?php

$title = 'Trang chủ';

require_once('layouts/header.php');
$stt = 1;
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
                        <li class="breadcrumb-item"><a href="<?= BASE_URL ?>danhmuc">Danh mục</a></li>
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
                        <div class="card-header d-flex justify-content-between align-items-center">

                            <form action="#" method="post" enctype="multipart/form" class="card-tools d-flex">
                                <select class="custom-select mr-3" id="danhmuc" name="danhmuc">
                                    <option value="">Tất cả</option>
                                    <?php
                                    $stmt = $conn->prepare("SELECT * FROM danhmuc");
                                    $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                    $stmt->execute();
                                    while ($row_danhmuc = $stmt->fetch()) :
                                    ?>
                                        <option value="<?= $row_danhmuc['id'] ?>"><?= $row_danhmuc['tendanhmuc'] ?></option>
                                    <?php
                                    endwhile;
                                    ?>
                                </select>
                                <input type="submit" value="Lọc theo danh mục" name="danhmuc_filter" class="btn btn-primary">
                            </form>

                            <form action="#" method="post" enctype="multipart/form" class="card-tools d-flex">
                                <select class="custom-select mr-3" id="ncc" name="ncc" style="max-width: 200px;">
                                    <option value="">Tất cả</option>
                                    <?php
                                    $stmt = $conn->prepare("SELECT * FROM ncc");
                                    $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                    $stmt->execute();
                                    while ($row_nhacungcap = $stmt->fetch()) :
                                    ?>
                                        <option value="<?= $row_nhacungcap['id'] ?>"><?= $row_nhacungcap['tenncc'] ?></option>
                                    <?php
                                    endwhile;
                                    ?>

                                </select>
                                <input type="submit" value="Lọc theo nhà cung cấp" name="ncc_filter" class="btn btn-primary">
                            </form>

                            <form action="#" method="post" enctype="multipart/form" class="card-tools">
                                <div class="input-group input-group-sm" style="width: 280px;">
                                    <input type="text" name="table_search" class="form-control float-right" placeholder="Nhập tên sản phẩm để tìm kiếm...">
                                    <div class="input-group-append">
                                        <input type="submit" name="search" value="Search" class="btn btn-default">
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
                                        <th>Tên sản phẩm</th>
                                        <th>Hình ảnh</th>
                                        <th>Giá</th>
                                        <th>Trạng thái</th>
                                        <th>Đơn vị</th>
                                        <th>Danh mục</th>
                                        <th>Nhà cung cấp</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Tìm kiếm
                                    $table_search = isset($_POST['table_search']) ? $_POST['table_search'] : '';
                                    $ncc = isset($_POST['ncc']) ? $_POST['ncc'] : '';
                                    $danhmuc = isset($_POST['danhmuc']) ? $_POST['danhmuc'] : '';

                                    if ($table_search != '') {
                                        $stmt = $conn->prepare("SELECT sanpham.id, tensp, anh, mota, gia, donvi, tenncc, tendanhmuc, trangthai 
                                        FROM (sanpham INNER JOIN danhmuc on danhmuc.id = sanpham.danhmuc_id) INNER JOIN ncc on sanpham.ncc_id = ncc.id 
                                        where tensp like '%" . $table_search . "%'");
                                    }
                                    // Lọc theo ncc
                                    else if ($ncc != '') {
                                        $stmt = $conn->prepare("SELECT sanpham.id, tensp, anh, mota, gia, donvi, tenncc, tendanhmuc, trangthai 
                                        FROM (sanpham INNER JOIN danhmuc on danhmuc.id = sanpham.danhmuc_id) INNER JOIN ncc on sanpham.ncc_id = ncc.id 
                                        where ncc.id = $ncc");
                                    }
                                    // Lọc theo danh mục
                                    else if ($danhmuc != '') {
                                        $stmt = $conn->prepare("SELECT sanpham.id, tensp, anh, mota, gia, donvi, tenncc, tendanhmuc, trangthai 
                                        FROM (sanpham INNER JOIN danhmuc on danhmuc.id = sanpham.danhmuc_id) INNER JOIN ncc on sanpham.ncc_id = ncc.id 
                                        where danhmuc.id = $danhmuc");
                                    } else {
                                        $stmt = $conn->prepare('SELECT sanpham.id, tensp, anh, mota, gia, donvi, tenncc, tendanhmuc, trangthai 
                                        FROM (sanpham INNER JOIN danhmuc on danhmuc.id = sanpham.danhmuc_id) INNER JOIN ncc on sanpham.ncc_id = ncc.id');
                                    }
                                    $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                    $stmt->execute();
                                    while ($row = $stmt->fetch()) :
                                    ?>
                                        <tr>
                                            <td><?= $stt++ ?></td>
                                            <td><?= $row['tensp'] ?></td>
                                            <td><img src="<?= HOME ?>/assets/images/sanpham/<?= $row['anh'] ?>" alt="" width="150px"></td>
                                            <td><?= number_format($row['gia'], 0, ',', '.') ?></td>
                                            <td><?= $row['trangthai'] == 1 ? 'Còn hàng' : 'Hết hàng' ?></td>
                                            <td><?= $row['donvi'] ?></td>
                                            <td><?= $row['tendanhmuc'] ?></td>
                                            <td><?= $row['tenncc'] ?></td>
                                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                            <td>
                                                <a href="<?= BASE_URL ?>/sanpham/sua?id=<?= $row['id'] ?>" class="btn btn-primary">Sửa</a>
                                                <a href="<?= BASE_URL ?>/sanpham/xoa?id=<?= $row['id'] ?>" class="btn btn-danger" onclick="return confirm('Xoá sản phẩm này?')">Xoá</a>
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
    td {
        max-width: 220px;
        text-overflow: ellipsis;
        white-space: nowrap;
        overflow: hidden;
    }
</style>

<?php

require_once('layouts/footer.php');

?>