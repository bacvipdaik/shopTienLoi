<?php

$title = 'Thông tin cá nhân';

require_once('layouts/header.php');

if (!isset($_SESSION['dangnhap']) && !isset($_SESSION['id'])) {
    $error[] = 'Có lỗi xảy ra!!!';
} else {
    $id = isset($_SESSION['id']) ? $_SESSION['id'] : '';
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $sdt = isset($_POST['sdt']) ? $_POST['sdt'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['update'])) {
            $stmt = $conn->prepare('SELECT * FROM user WHERE id != ? and (username = ? or email = ? or sdt = ?)');
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute([
                $id,
                $username,
                $email,
                $sdt
            ]);
            $result = $stmt->rowCount();
            if ($result > 0) {
                while ($row = $stmt->fetch()) {
                    if ($email == $row['email']) {
                        $error[] = 'Email đã được đăng kí!';
                    }
                    if ($sdt == $row['sdt']) {
                        $error[] = 'Số điện thoại đã được sử dụng!';
                    }
                    if ($username == $row['username']) {
                        $error[] = 'Tài khoản đã được đăng kí!';
                    }
                }
            } else {
                $stmt = $conn->prepare("UPDATE user set username = ?, password = ?, name = ?, email = ?, sdt = ? where id = ?");
                $stmt->execute([
                    $username,
                    $password,
                    $name,
                    $email,
                    $sdt,
                    $id
                ]);
                $result = $stmt->rowCount();
                if ($result > 0) {
                    $success[] = 'Sửa thành công';
                } else {
                    $error[] = 'Không có dữ liệu thay đổi.';
                }
            }
        } else if (isset($_POST['logout'])) {
            unset($_SESSION['id']);
            unset($_SESSION['dangnhap']);
            echo "<script>
                    alert('Đăng xuất thành công!');
                    window.location = '" . HOME . "/dangnhap';
                </script>";
        } else if (isset($_POST['delete'])) {
            $stmt = $conn->prepare("DELETE from user where id = " . $id);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            $result = $stmt->rowCount();
            if ($result > 0) {
                unset($_SESSION['id']);
                unset($_SESSION['dangnhap']);
                echo "<script>
                    alert('Bạn đã xoá tài khoản!');
                    window.location = '" . HOME . "';
                </script>";
            } else {
                $error[] = 'Xoá thất bại';
            }
        }
    }
}

?>

<div class="container">
    <div class="row" style="margin-top: 20px;">
        <div class="col-md-12">
            <?php
            if (isset($error)) {
                echo '<div class="alert alert-danger" role="alert">';
                foreach ($error as $a) :
            ?>
                    <ul>
                        <li><strong><?= $a ?></strong></li>
                    </ul>
                <?php
                endforeach;
                echo '</div>';
            } else if (isset($success)) {
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
    <div class="row">
        <div class="col-md-12">
            <div class="jumbotron">
                <?php
                if (isset($_SESSION['dangnhap']) && isset($_SESSION['id'])) :
                    $stmt = $conn->prepare("SELECT * FROM user where id = " . $id);
                    $stmt->setFetchMode(PDO::FETCH_ASSOC);
                    $stmt->execute();
                    while ($row = $stmt->fetch()) :
                ?>
                        <h3>Xin chào <?= $row['name'] ?></h3>
                        <p>Chỉnh sửa thông tin cá nhân của bạn.</p>

                        <form action="" method="POST">
                            <div class="form-group">
                                <label class="info-title" for="name">Họ tên </label>
                                <input type="text" class="form-control unicase-form-control text-input" id="name" name="name" value="<?= $row['name']; ?>" required="true" placeholder="Họ tên: ">
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="email">Email </label>
                                <input type="email" class="form-control unicase-form-control text-input" id="email" name="email" value="<?= $row['email']; ?>" required="true" placeholder="Email: ">
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="sdt">Số điện thoại </label>
                                <input type="tel" class="form-control unicase-form-control text-input" id="sdt" required="true" placeholder="Số điện thoại: " name="sdt" value="<?= $row['sdt']; ?>" pattern="[0-9]{10}">
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="username">Tên đăng nhập </label>
                                <input type="text" class="form-control unicase-form-control text-input" id="username" name="username" value="<?= $row['username']; ?>" required="true" placeholder="Tên đăng nhập: ">
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="password">Mật khẩu </label>
                                <input type="password" class="form-control unicase-form-control text-input" id="password" name="password" value="<?= $row['password']; ?>" required="true" placeholder="Mật khẩu: " minlength="6">
                            </div>
                            <div class="button-group">
                                <button type="submit" class="btn btn-success" name="update" title="Sửa">Sửa thông tin cá nhân</button>
                                <button type="submit" class="btn btn-danger" name="delete" title="Xoá" onclick="return confirm('Bạn chắc chắn muốn xoá tài khoản?')">Xoá tài khoản</button>
                                <button type="submit" class="btn btn-info" name="logout" title="Đăng xuất" onclick="return confirm('Bạn có muốn đăng xuất?')">Đăng xuất</button>

                            </div>

                        </form>
                <?php
                    endwhile;
                endif;
                ?>
            </div>
        </div>
    </div>
</div>




<?php

require_once('layouts/footer.php');

?>
<script>
    const writeBtn = document.querySelector('.write-btn');
</script>