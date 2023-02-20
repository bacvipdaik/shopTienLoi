<?php

$title = 'Danh sách khách hàng';

require_once('layouts/header.php');
$stt = 1;

$id = isset($_POST['id']) ? $_POST['id'] : '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST['block'])) {
        $stmt = $conn->prepare("DELETE from user where id = ".$id);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $result = $stmt->rowCount();
        if ($result > 0) {
            unset($_SESSION['id']);
            unset($_SESSION['dangnhap']);
            $succes = 'Chặn thành công!';
        } else {
            $error[] = 'Thất bại';
        }
    }
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row" style="margin-top: 20px;">
                <div class="col-md-12">
                    <?php
                        if (isset($error)){
                            echo '<div class="alert alert-danger" role="alert">';
                            foreach ($error as $a) :
                            ?>
                                <ul>
                                    <li><strong><?= $a ?></strong></li>
                                </ul>
                            <?php
                            endforeach;
                            echo '</div>';
                        }
                        else if (isset($success)){
                            echo '<div class="alert alert-success" role="alert">';
                            foreach ($success as $b) :
                            ?>
                                <ul>
                                    <li><strong><?= $b ?></strong></li>
                                </ul>
                            <?php
                            endforeach;
                            echo '</div>';
                        }
                        
                    ?>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Danh sách khách hàng</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= BASE_URL ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= BASE_URL ?>/danhmuc">Danh mục</a></li>
                        <li class="breadcrumb-item active">Danh sách khách hàng</li>
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
                            <h3 class="card-title">Danh sách các khách hàng</h3>

                            <form action="#" method="POST" enctype="multipart/form" class="card-tools">
                                <div class="input-group input-group-sm" style="width: 295px;">
                                    <input type="text" name="table_search" class="form-control float-right" placeholder="Nhập tên khách hàng để tìm kiếm...">

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
                                        <th>Tên đăng nhập</th>
                                        <th>Email</th>
                                        <th>Số điện thoại</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if(isset($_POST['submit'])){
                                        $table_search = isset($_POST['table_search']) ? $_POST['table_search'] : '';
                                        $stmt = $conn->prepare("SELECT * FROM user where name like '%".$table_search."%'");
                                    }
                                    else {
                                        $stmt = $conn->prepare('SELECT * FROM user');
                                    }
                                    $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                    $stmt->execute();
                                    while ($row = $stmt->fetch()) :
                                        ?>
                                        <form action="" method="post">
                                            <tr>
                                                <td><?= $stt++ ?></td>
                                                <td><?= $row['name'] ?></td>
                                                <td><?= $row['username'] ?></td>
                                                <td><?= $row['email'] ?></td>
                                                <td><?= $row['sdt'] ?></td>
                                                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                                <td>
                                                    <button type="submit" name="block" class="btn btn-danger" onclick="return confirm('Xoá khách hàng này?')">Xoá</button>
                                                </td>
                                            </tr>
                                        </form>
                                            
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