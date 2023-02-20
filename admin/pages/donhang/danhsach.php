<?php

$title = 'Hoá đơn';

require_once('layouts/header.php');
$stt = 1;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['duyet'])) {
        $mahoadon = isset($_POST['duyet']) ? $_POST['duyet'] : '';
        if ($id = '') {
            echo "<script>
                    alert('Không tìm thấy ID')
                    location.reload();
                </script>";
        } else {
            $stmt = $conn->prepare("UPDATE hoadon set trangthai = 1 where mahoadon = ?");
            $stmt->execute([$mahoadon]);
            $result = $stmt->rowCount();
            if ($result > 0) {
                echo "<script>
                    alert('Duyệt thành công đơn hàng')
                    location.reload();
                </script>";
            }
        }
    }

    if (isset($_POST['huy'])) {
        $mahoadon = isset($_POST['huy']) ? $_POST['huy'] : '';
        $stmt = $conn->prepare("UPDATE hoadon set trangthai = 2 where mahoadon = ?");
        $stmt->execute([$mahoadon]);
        $result = $stmt->rowCount();
        if ($result > 0) {
            echo "<script>
                alert('Đã huỷ đơn hàng đơn hàng')
                location.reload();
            </script>";
        }
    }
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Hoá đơn</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= BASE_URL ?>">Home</a></li>
                        <li class="breadcrumb-item active">Danh sách đơn hàng</li>
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
                            <h3 class="card-title">Danh sách các hoá đơn</h3>

                            <form action="#" method="POST" enctype="multipart/form" class="card-tools">
                                <div class="input-group input-group-sm" style="width: 295px;">
                                    <input type="text" name="table_search" class="form-control float-right" placeholder="Nhập mã đơn hàng để tìm kiếm...">

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
                                        <th>Mã hoá đơn</th>
                                        <th>Tổng tiền</th>
                                        <th>Phương thức thanh toán</th>
                                        <th>Trạng thái</th>
                                        <th>Ngày tạo</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($_POST['submit'])) {
                                        $table_search = isset($_POST['table_search']) ? $_POST['table_search'] : '';
                                        $stmt = $conn->prepare("SELECT * FROM hoadon where mahoadon like '%" . $table_search . "%'");
                                    } else {
                                        $stmt = $conn->prepare('SELECT * FROM hoadon order by ngaytao desc');
                                    }
                                    $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                    $stmt->execute();
                                    while ($row = $stmt->fetch()) :
                                    ?>
                                        <tr>
                                            <td><?= $stt++ ?></td>
                                            <td><a href="<?= HOME ?>/chitiethoadon/<?= $row['mahoadon'] ?>"><?= $row['mahoadon'] ?></a></td>
                                            <td><?= number_format($row['tongtien'], 0, ',', '.') ?> VNĐ</td>
                                            <td><?= $row['thanhtoan'] ?></td>
                                            <td>
                                                <?php
                                                if ($row['trangthai'] == 0) {
                                                    echo '<span style="color: #ff7600;">Chưa xác nhận</span>';
                                                } else if ($row['trangthai'] == 1) {
                                                    echo '<span style="color: #00a014;">Đã xác nhận</span>';
                                                } else {
                                                    echo '<span style="color: red;">Đã huỷ</span>';
                                                }
                                                ?>
                                            </td>
                                            <td><?= $row['ngaytao'] ?></td>
                                            <td>
                                                <form action="" method="post">
                                                    <input type="hidden" name="lydo" class="lydo">
                                                    <button type="submit" name="duyet" class="btn btn-primary" value="<?= $row['mahoadon'] ?>">Duyệt</button>
                                                    <button type="submit" name="huy" class="btn btn-danger" value="<?= $row['mahoadon'] ?>">Huỷ</button>
                                                </form>
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
<?php

require_once('layouts/footer.php');

?>