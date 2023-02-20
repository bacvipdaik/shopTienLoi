<?php

$title = 'Đăng nhập';

require_once('layouts/header.php');

?>

<?php
$id = isset($GET['id']) ? $GET['id'] : '';
$name = isset($_POST['name']) ? $_POST['name'] : '';
$username = isset($_POST['username']) ? $_POST['username'] : '';
$username_dk = isset($_POST['username_dk']) ? $_POST['username_dk'] : '';
$email_dk = isset($_POST['email_dk']) ? $_POST['email_dk'] : '';
$sdt = isset($_POST['sdt']) ? $_POST['sdt'] : '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['dangnhap'])) {
        $password = isset($_POST['password']) ? $_POST['password'] : '';

        $stmt = $conn->prepare('SELECT * FROM user WHERE username = ? AND password = ?');
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute([
            $username,
            $password
        ]);
        $result = $stmt->rowCount();
        $row_dangnhap = $stmt->fetch();
        if ($result > 0) {
            $_SESSION['dangnhap'] = '1';
            $_SESSION['username'] = $username;
            $_SESSION['id'] = $row_dangnhap['id'];

            echo '<script>window.location = "' . HOME . '"</script>';
        } else {
            $error[] = 'Thông tin tài khoản hoặc mật khẩu không chính xác.';
        }
    }


    if (isset($_POST['dangky'])) {

        $password_dk = isset($_POST['password_dk']) ? $_POST['password_dk'] : '';
        $stmt = $conn->prepare('SELECT * FROM user WHERE username = ? OR email = ? OR sdt = ?');
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute([
            $username,
            $email_dk,
            $sdt
        ]);
        $result = $stmt->rowCount();
        if ($result > 0) {
            $row = $stmt->fetch();
            if ($email_dk == $row['email']) {
                $error[] = 'Email đã được đăng kí!';
            }
            if ($sdt == $row['sdt']) {
                $error[] = 'Số điện thoại đã được đăng kí!';
            }
            if ($username_dk == $row['username']) {
                $error[] = 'Tài khoản đã được đăng kí!';
            }
        } else {
            $stmt = $conn->prepare('INSERT into user (name, username, password, email, sdt) values (?, ?, ?, ?, ?)');
            $stmt->execute([
                $name,
                $username_dk,
                $password_dk,
                $email_dk,
                $sdt,
            ]);
            $result = $stmt->rowCount();
            if ($result > 0) {
                $success = 'Đăng kí thành công!';
            } else {
                $error[] = 'Đăng ký thất bại.';
            }
        }
    }
}

?>

<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="home.html">Home</a></li>
                <li class='active'>Đăng nhập</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
    <div class="container">
        <div class="sign-in-page">
            <div class="row">
                <?php
                if (isset($error)) :
                    echo '<div class="alert alert-danger" role="alert">';
                    foreach ($error as $a) :
                ?>
                        <ul>
                            <li><strong><?= $a ?></strong></li>
                        </ul>
                <?php
                    endforeach;
                    echo '</div>';
                endif;
                if (isset($success)) :
                    echo '<div class="alert alert-success" role="alert">' . $success . '</div>';
                endif;
                ?>
            </div>
            <div class="row">
                <!-- Sign-in -->
                <div class="col-md-6 col-sm-6 sign-in">
                    <h4 class="">Đăng nhập</h4>
                    <p class="">Xin chào, Vui lòng đăng nhập tài khoản của bạn.</p>
                    <form class="register-form outer-top-xs" role="form" method="POST">
                        <div class="form-group">
                            <label class="info-title" for="username">Tên đăng nhập: <span>*</span></label>
                            <input type="text" class="form-control unicase-form-control text-input" id="username" value="<?= $username ?>" required="true" name="username">
                        </div>
                        <div class="form-group">
                            <label class="info-title" for="password">Mật khẩu:</label> <span>*</span></label>
                            <input type="password" class="form-control unicase-form-control text-input" id="password" name="password" required="true">
                        </div>

                        <button type="submit" class="btn-upper btn btn-primary checkout-page-button" name="dangnhap">Đăng nhập</button>
                    </form>
                </div>
                <!-- Sign-in -->

                <!-- create a new account -->
                <div class="col-md-6 col-sm-6 create-new-account">
                    <h4 class="checkout-subtitle">Đăng ký</h4>
                    <p class="text title-tag-line">Tạo tài khoản mới của bạn.</p>
                    <form class="register-form outer-top-xs" role="form" onsubmit="return validateForm();" method="POST">
                        <div class="form-group">
                            <label class="info-title" for="name">Họ tên <span>*</span></label>
                            <input type="text" class="form-control unicase-form-control text-input" id="name" name="name" value="<?= $name ?>" required="true">
                        </div>
                        <div class="form-group">
                            <label class="info-title" for="email_dk">Email <span>*</span></label>
                            <input type="email" class="form-control unicase-form-control text-input" id="email_dk" name="email_dk" value="<?= $email_dk ?>" required="true">
                        </div>
                        <div class="form-group">
                            <label class="info-title" for="sdt">Số điện thoại <span>*</span></label>
                            <input type="tel" class="form-control unicase-form-control text-input" id="sdt" required="true" name="sdt" value="<?= $sdt ?>" pattern="[0-9]{10}">
                        </div>
                        <div class="form-group">
                            <label class="info-title" for="username_dk">Tên đăng nhập <span>*</span></label>
                            <input type="text" class="form-control unicase-form-control text-input" id="username_dk" name="username_dk" value="<?= $username_dk ?>" required="true">
                        </div>
                        <div class="form-group">
                            <label class="info-title" for="password_dk">Mật khẩu <span>*</span></label>
                            <input type="password" class="form-control unicase-form-control text-input" id="password_dk" name="password_dk" required="true" minlength="6">
                        </div>
                        <div class="form-group">
                            <label class="info-title" for="repassword">Xác nhận lại mật khẩu <span>*</span></label>
                            <input type="password" class="form-control unicase-form-control text-input" id="repassword" minlength="6">
                        </div>
                        <button type="submit" class="btn-upper btn btn-primary checkout-page-button" name="dangky">Đăng ký</button>
                    </form>


                </div>
                <!-- create a new account -->
            </div><!-- /.row -->
        </div><!-- /.sigin-in-->
 
    </div><!-- /.container -->
</div><!-- /.body-content -->
<!-- ============================================================= FOOTER ============================================================= -->
<script type="text/javascript">
    function validateForm() {
        $password_dk = $('#password_dk').val();
        $repassword = $('#repassword').val();
        if ($password_dk != $repassword) {
            alert("Mật khẩu không khớp, vui lòng kiểm tra lại")
            return false;
        }
        return true;
    }
</script>
<?php

require_once('layouts/footer.php');

?>