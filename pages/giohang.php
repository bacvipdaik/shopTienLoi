<?php

if (isset($_SESSION['dangnhap'])) :

    $title = 'Giỏ hàng';

    require_once('layouts/header.php');

?>

    <?php

    $tinh_id = isset($_POST['tinh']) ? $_POST['tinh'] : '';
    $huyen_id = isset($_POST['huyen']) ? $_POST['huyen'] : '';
    $xa_id = isset($_POST['xa']) ? $_POST['xa'] : '';
    $diachi = isset($_POST['diachi']) ? $_POST['diachi'] : '';
    $thanhtoan = isset($_POST['thanhtoan']) ? $_POST['thanhtoan'] : '';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        if ($tinh_id == '') {
            $error[] = 'Chưa chọn tỉnh.';
        }
        if ($huyen_id == '') {
            $error[] = 'Chưa chọn huyện.';
        }
        if ($xa_id == '') {
            $error[] = 'Chưa chọn xã.';
        }
        if ($diachi == '') {
            $error[] = 'Chưa nhập địa chỉ.';
        }

        $mahoadon = rand(0, 9999);
        $user_id = isset($_SESSION['id']) ? $_SESSION['id'] : '';
        $ngaytao = date('Y-m-d');

        if ($user_id == '') {
            $error[] = 'Không thấy ID khách hàng.';
        }

        if (!isset($error)) {

            $tongtien = 0;
            foreach ($_SESSION['giohang'] as $sanpham) {
                $tongtien += $sanpham['gia'] * $sanpham['soluong'];
            }

            $stmt = $conn->prepare("INSERT INTO hoadon (mahoadon, user_id, diachi, xa_id, huyen_id, tinh_id, thanhtoan, trangthai, tongtien, ngaytao) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([
                $mahoadon,
                $user_id,
                $diachi,
                $xa_id,
                $huyen_id,
                $tinh_id,
                $thanhtoan,
                '0',
                $tongtien,
                $ngaytao
            ]);

            $result = $stmt->rowCount();

            foreach ($_SESSION['giohang'] as $sanpham => $value) {
                $stmt = $conn->prepare("INSERT INTO ct_hoadon (mahoadon, sanpham_id, soluong) VALUES (?, ?, ?)");
                $stmt->execute([
                    $mahoadon,
                    $value['id'],
                    $value['soluong']
                ]);
            }

            if ($result > 0) {
                echo "<script>
                    alert('Đặt hàng thành công.');
                    window.location = '" . HOME . "/hoadon';
                </script>";
                unset($_SESSION['giohang']);
            }
        }
    }

    ?>

    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="#">Home</a></li>
                    <li class='active'>Shopping Cart</li>
                </ul>
            </div><!-- /.breadcrumb-inner -->
        </div><!-- /.container -->
    </div><!-- /.breadcrumb -->

    <div class="body-content outer-top-xs">
        <div class="container">
            <div class="row ">
                <div class="shopping-cart">
                    <div class="shopping-cart-table ">
                        <div class="table-responsive">
                            <?php
                            if (!isset($_SESSION['giohang']) || count($_SESSION['giohang']) == 0) :
                            ?>
                                <div class="col-md-12">
                                    <h3 class="cart-empty-tittle">Giỏ hàng trống! Tiếp tục mua hàng thôi nào!!!</h3>
                                    <div class="img-cart-wrapper">
                                        <img src="/assets/images/empty-cart.png" alt="">
                                    </div>
                                </div>
                            <?php
                            else :
                            ?>
                                <form action="<?= HOME ?>/capnhatgiohang" method="post">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="cart-romove item">Xoá</th>
                                                <th class="cart-description item">Ảnh</th>
                                                <th class="cart-product-name item">Tên sản phẩm</th>
                                                <th class="cart-qty item">Số lượng</th>
                                                <th>Đơn vị</th>
                                                <th class="cart-sub-total item">Giá</th>
                                                <th class="cart-total last-item">Tổng</th>
                                            </tr>
                                        </thead><!-- /thead -->
                                        <tbody>
                                            <?php
                                            if (isset($_SESSION['giohang'])) :
                                                $tongtien = 0;
                                                foreach ($_SESSION['giohang'] as $sanpham) :
                                                    $thanhtien = $sanpham['gia'] * $sanpham['soluong'];
                                                    $tongtien += $thanhtien;
                                            ?>
                                                    <tr>
                                                        <td class="romove-item"><a href="<?= HOME ?>/xoagiohang/<?= $sanpham['id'] ?>" title="Xoá" class="icon"><i class="fa fa-trash-o"></i></a></td>
                                                        <td class="cart-image">
                                                            <a class="entry-thumbnail" href="<?= HOME ?>/sanpham/<?= $sanpham['id'] ?>">
                                                                <img src="<?= HOME ?>/assets/images/sanpham/<?= $sanpham['anh'] ?>" alt="">
                                                            </a>
                                                        </td>
                                                        <td class="cart-product-name-info">
                                                            <h4 class='cart-product-description'><a href="<?= HOME ?>/sanpham/<?= $sanpham['id'] ?>"><b><?= $sanpham['tensp'] ?></b></a></h4>
                                                        </td>
                                                        <td class="cart-product-quantity">
                                                            <div class="quant-input">

                                                                <input type="number" name="soluong[<?= $sanpham['id'] ?>]" value="<?= $sanpham['soluong'] ?>" min="1">
                                                            </div>
                                                        </td>
                                                        <td><?= $sanpham['donvi'] ?></td>
                                                        <td class="cart-product-sub-total"><span class="cart-sub-total-price"><?= number_format($sanpham['gia'], 0, ',', '.') ?> VNĐ</span></td>
                                                        <td class="cart-product-grand-total"><span class="cart-grand-total-price"><?= number_format($thanhtien, 0, ',', '.') ?> VNĐ</span></td>
                                                    </tr>
                                            <?php
                                                endforeach;
                                            endif;
                                            ?>
                                        </tbody><!-- /tbody -->
                                        <tfoot>
                                            <tr>
                                                <td colspan="7">
                                                    <div class="shopping-cart-btn">
                                                        <span class="">
                                                            <a href="javascript:history.go(-1)" class="btn btn-upper btn-primary outer-left-xs">Tiếp tục mua sắm</a>
                                                            <button type="submit" class="btn btn-upper btn-primary pull-right outer-right-xs">Cập nhật giỏ hàng</button>
                                                        </span>
                                                    </div><!-- /.shopping-cart-btn -->
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table><!-- /table -->
                                </form>
                            <?php
                            endif;
                            ?>
                        </div>
                    </div><!-- /.shopping-cart-table -->
                    <form action="" method="post" name="frmdiachi">
                        <?php
                        if (isset($_SESSION['dangnhap'])) :
                            if (isset($_SESSION['giohang']) && count($_SESSION['giohang']) > 0) :
                        ?>
                                <div class="col-md-8 address-form">
                                    <h5>Vui lòng chọn địa chỉ giao hàng.</h5>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="tinh">Tỉnh</label>
                                            <select id="tinh" class="form-control" name="tinh" onchange="frmdiachi.submit()">
                                                <option selected>Chọn tỉnh.</option>
                                                <?php
                                                $tinh = $conn->prepare("SELECT * FROM tinh ORDER BY ten ASC");
                                                $tinh->setFetchMode(PDO::FETCH_ASSOC);
                                                $tinh->execute();
                                                while ($row_tinh = $tinh->fetch()) :
                                                ?>
                                                    <option value="<?php echo $row_tinh['id'] ?>" <?php echo $row_tinh['id'] == $tinh_id ? 'selected' : '' ?>><?php echo $row_tinh['ten'] ?></option>
                                                <?php
                                                endwhile;
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="huyen">Huyện</label>
                                            <select id="huyen" class="form-control" name="huyen" onchange="frmdiachi.submit()">
                                                <option selected>Chọn huyện.</option>
                                                <?php
                                                $huyen = $conn->prepare("SELECT * FROM huyen WHERE tinh_id = ? ORDER BY ten ASC");
                                                $huyen->setFetchMode(PDO::FETCH_ASSOC);
                                                $huyen->execute([
                                                    $tinh_id
                                                ]);
                                                while ($row_huyen = $huyen->fetch()) :
                                                ?>
                                                    <option value="<?php echo $row_huyen['id'] ?>" <?php echo $row_huyen['id'] == $huyen_id ? 'selected' : '' ?>><?php echo $row_huyen['ten'] ?></option>
                                                <?php
                                                endwhile;
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="xa">Xã</label>
                                            <select id="xa" class="form-control" name="xa">
                                                <option selected>Chọn xã.</option>
                                                <?php
                                                $xa = $conn->prepare("SELECT * FROM xa WHERE huyen_id = ? ORDER BY ten ASC");
                                                $xa->setFetchMode(PDO::FETCH_ASSOC);
                                                $xa->execute([
                                                    $huyen_id
                                                ]);
                                                while ($row_xa = $xa->fetch()) :
                                                ?>
                                                    <option value="<?php echo $row_xa['id'] ?>" <?php echo $row_xa['id'] == $xa_id ? 'selected' : '' ?>><?php echo $row_xa['ten'] ?></option>
                                                <?php
                                                endwhile;
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="xa-phuong:">Địa chỉ nhận mong muốn: </label>
                                        <input type="text" class="form-control" name="diachi" value="<?= $diachi ?>" placeholder="VD: số nhà 3 ...">
                                    </div>
                                    <div class="form-group">
                                        <label for="thanhtoan">Phương thức thanh toán</label>
                                        <select id="thanhtoan" class="form-control" name="thanhtoan">
                                            <option value="Chuyển khoản">Chuyển khoản</option>
                                            <option value="Tiền mặt">Tiền mặt</option>
                                        </select>
                                    </div>
                                </div>
                            <?php
                            endif;
                        endif;
                        if (isset($_SESSION['giohang']) && count($_SESSION['giohang']) > 0) :
                            ?>
                            <div class="col-md-4 col-sm-12 cart-shopping-total">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>
                                                <div class="cart-grand-total">
                                                    Tổng<span class="inner-left-md"><?php echo isset($tongtien) ? number_format($tongtien, 0, ',', '.') : '0' ?> VNĐ</span>
                                                </div>
                                            </th>
                                        </tr>
                                    </thead><!-- /thead -->
                                    <tbody>
                                        <?php
                                        if (isset($_SESSION['dangnhap'])) :
                                        ?>
                                            <tr>
                                                <td>
                                                    <div class="cart-checkout-btn pull-right">
                                                        <button type="submit" class="btn btn-primary checkout-btn">Đặt hàng</button>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php
                                        endif;
                                        ?>
                                    </tbody><!-- /tbody -->
                                </table><!-- /table -->
                            <?php
                        endif;
                            ?>
                    </form>
                </div><!-- /.cart-shopping-total -->
            </div><!-- /.shopping-cart -->
        </div> <!-- /.row -->

    </div><!-- /.container -->
    </div><!-- /.body-content -->
<?php

    require_once('layouts/footer.php');
else :
    header('location:dangnhap');
endif;
?>