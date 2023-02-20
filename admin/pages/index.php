<?php

$title = 'Trang chủ';

require_once('layouts/header.php');
$stt = 1;
?>

<?php
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
                    alert('Đã duyệt đơn hàng')
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
                    <h1 class="m-0">Trang chủ</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= BASE_URL ?>">Home</a></li>
                        <li class="breadcrumb-item active">Trang chủ</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <?php
                        $stmt = $conn->prepare("SELECT sum(tongtien) as 'tong' from hoadon where trangthai = 1");
                        $stmt->setFetchMode(PDO::FETCH_ASSOC);
                        $stmt->execute();
                        $row_donhang = $stmt->fetch()
                        ?>
                        <div class="inner">
                            <h3><?= number_format($row_donhang['tong'], 0, ',', '.') ?></h3>

                            <p>Doanh thu</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-calculator"></i>
                        </div>
                        <a href="<?= BASE_URL ?>/donhang/danhsach" class="small-box-footer">Xem chi tiết <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <?php
                        $stmt = $conn->prepare("SELECT count(mahoadon) as 'sodon' from hoadon");
                        $stmt->setFetchMode(PDO::FETCH_ASSOC);
                        $stmt->execute();
                        $row_donhang = $stmt->fetch()
                        ?>
                        <div class="inner">
                            <h3><?= $row_donhang['sodon'] ?></h3>

                            <p>Đơn hàng đã tạo</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="<?= BASE_URL ?>/donhang/danhsach" class="small-box-footer">Xem chi tiết <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <?php
                        $stmt = $conn->prepare("SELECT count(id) as 'soUser' from user");
                        $stmt->setFetchMode(PDO::FETCH_ASSOC);
                        $stmt->execute();
                        $row_user = $stmt->fetch()
                        ?>
                        <div class="inner">
                            <h3><?= $row_user['soUser'] ?></h3>

                            <p>Người đã đăng kí tài khoản</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="<?= BASE_URL ?>/taikhoan/danhsach" class="small-box-footer">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <?php
                        $stmt = $conn->prepare("SELECT count(id) as 'sosanpham' from sanpham");
                        $stmt->setFetchMode(PDO::FETCH_ASSOC);
                        $stmt->execute();
                        $row_sp = $stmt->fetch()
                        ?>
                        <div class="inner">
                            <h3><?= $row_sp['sosanpham'] ?></h3>

                            <p>Mặt hàng</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-happy"></i>
                        </div>
                        <a href="<?= BASE_URL ?>/sanpham/danhsach" class="small-box-footer">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
    <!-- Đơn hàng chờ duyệt -->
    <div class="container-fluid my-5">
        <div class="row">
            <div class="col-md-12">
                <h3>Đơn hàng chờ xét duyệt</h3>
                <?php
                $stmt = $conn->prepare('SELECT * FROM hoadon where trangthai = 0 ORDER BY ngaytao ASC');
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $stmt->execute();
                $result = $stmt->rowCount();
                if ($result > 0) {
                ?>
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
                            while ($row = $stmt->fetch()) :
                            ?>
                                <tr>
                                    <td><?= $stt++ ?></td>
                                    <td><a href="<?= HOME ?>/chitiethoadon/<?= $row['mahoadon'] ?>"><?= $row['mahoadon'] ?></a></td>
                                    <td><?= number_format($row['tongtien'], 0, ',', '.') ?> VNĐ</td>
                                    <td><?= $row['thanhtoan'] ?></td>
                                    <td>
                                        <?php
                                            echo '<span style="color: #ff7600;">Chưa xác nhận</span>';
                                        ?>
                                    </td>
                                    <td><?= $row['ngaytao'] ?></td>
                                    <td>
                                        <form action="" method="post">
                                            <button type="submit" name="duyet" class="btn btn-primary" value="<?= $row['mahoadon'] ?>">Duyệt</button>
                                            <button type="submit" name="huy" class="btn btn-danger" value="<?= $row['mahoadon'] ?>" onclick="return confirm('Hủy đơn hàng này?')">Huỷ</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php
                            endwhile;
                            ?>
                        </tbody>
                    </table>
                <?php
                } else {
                ?>
                    <div class="alert alert-success my-4" role="alert">
                        <span>Không có đơn hàng chờ duyệt!!!</span>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>
<!-- /.content-wrapper -->
<?php

require_once('layouts/footer.php');

?>