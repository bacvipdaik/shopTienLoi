<?php

$stmt = $conn->prepare("SELECT user.name, user.sdt, user.email, xa.ten as 'Xa', huyen.ten as 'Huyen', tinh.ten as 'Tinh', diachi, tongtien, mahoadon, xa.type as 'xa_type', huyen.type as 'huyen_type', tinh.type as 'tinh_type', trangthai
                        FROM hoadon 
                        JOIN user on hoadon.user_id = user.id 
                        JOIN xa on hoadon.xa_id = xa.id 
                        JOIN tinh on hoadon.tinh_id = tinh.id 
                        join huyen on hoadon.huyen_id = huyen.id where mahoadon = ?");
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute([
    $id
]);
$hoadon = $stmt->fetch();
$title = 'Chi tiết hoá đơn ' . $hoadon['mahoadon'];

require_once('layouts/header.php');

$stmt = $conn->prepare("SELECT * FROM ct_hoadon JOIN sanpham ON ct_hoadon.sanpham_id = sanpham.id WHERE mahoadon = ?");
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute([
    $id
]);
$result = $stmt->rowCount();

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

<div class="container">
    <div class="row">
        <div class="col-md-8 addres-container">
            <div class="address">
                <h3>Địa chỉ nhận hàng</h3>
                <p class="nguoinhan"><strong>Người nhận: <?=$hoadon['name']?></strong></p>
                <p>Số điện thoại: <?=$hoadon['sdt']?></p>
                <p>Email: <?=$hoadon['email']?></p>
                <p>Địa chỉ nhận hàng tại: <?=$hoadon['diachi']?></p>
                <p><?=$hoadon['tinh_type'].': '. $hoadon['Tinh']?>, <?=$hoadon['huyen_type'].': '. $hoadon['Huyen']?>, <?=$hoadon['xa_type'].': '.$hoadon['Xa']?></p>
            </div>
        </div>
        <div class="col-md-4 addres-container tinhtrang">
            <h3>Tình trạng đơn hàng</h3>
            <p>Mã hoá đơn: <?=$hoadon['mahoadon']?></p>
            <?php
            if($hoadon['trangthai'] == 0) {
                echo '<p><strong>Đơn hàng chưa được xác nhận</strong></p>';
            }
            else if($hoadon['trangthai'] == 1){
                echo '<p><strong>Đơn đã được xác nhận</strong></p>';
            }
            else {
                echo '<p><strong>Đơn hàng đã bị huỷ</strong></p>';
            }
            ?>
        </div>
    </div>
</div>

<div class="body-content outer-top-xs">
    <div class="container">
        <div class="row ">
            <div class="shopping-cart">
                <div class="shopping-cart-table ">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="cart-romove item">STT</th>
                                    <th class="cart-description item">Ảnh</th>
                                    <th class="cart-product-name item">Tên sản phẩm</th>
                                    <th class="cart-qty item">Số lượng</th>
                                    <th class="cart-sub-total item">Giá</th>
                                    <th class="cart-total last-item">Tổng</th>
                                </tr>
                            </thead><!-- /thead -->
                            <tbody>
                                <?php
                                if ($result > 0) :
                                    $stt = 0;
                                    while ($sanpham = $stmt->fetch()) :
                                        $thanhtien = $sanpham['gia'] * $sanpham['soluong'];
                                ?>
                                        <tr>
                                            <td class="romove-item"><?= ++$stt ?></td>
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
                                                    <h4><?= $sanpham['soluong'] ?></h4>
                                                </div>
                                            </td>
                                            <td class="cart-product-sub-total"><span class="cart-sub-total-price"><?= number_format($sanpham['gia'], 0, ',', '.') ?> VNĐ</span></td>
                                            <td class="cart-product-grand-total"><span class="cart-grand-total-price"><?= number_format($thanhtien, 0, ',', '.') ?> VNĐ</span></td>
                                        </tr>
                                <?php
                                    endwhile;
                                endif;
                                ?>
                            </tbody><!-- /tbody -->
                        </table><!-- /table -->
                    </div>
                </div><!-- /.shopping-cart-table -->
                <div class="col-md-4 col-sm-offset-8 col-sm-12 cart-shopping-total">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>
                                    <div class="cart-grand-total">
                                        Tổng<span class="inner-left-md"><?= number_format($hoadon['tongtien'], 0, ',', '.') ?> VNĐ</span>
                                    </div>
                                </th>
                            </tr>
                        </thead><!-- /thead -->
                    </table><!-- /table -->
                </div><!-- /.cart-shopping-total -->
            </div><!-- /.shopping-cart -->
        </div> <!-- /.row -->
        <!-- ============================================== BRANDS CAROUSEL ============================================== -->
        <div id="brands-carousel" class="logo-slider wow fadeInUp">

            <div class="logo-slider-inner">
                <div id="brand-slider" class="owl-carousel brand-slider custom-carousel owl-theme">
                    <div class="item m-t-15">
                        <a href="#" class="image">
                            <img data-echo="assets/images/brands/brand1.png" src="assets/images/blank.gif" alt="">
                        </a>
                    </div>
                    <!--/.item-->

                    <div class="item m-t-10">
                        <a href="#" class="image">
                            <img data-echo="assets/images/brands/brand2.png" src="assets/images/blank.gif" alt="">
                        </a>
                    </div>
                    <!--/.item-->

                    <div class="item">
                        <a href="#" class="image">
                            <img data-echo="assets/images/brands/brand3.png" src="assets/images/blank.gif" alt="">
                        </a>
                    </div>
                    <!--/.item-->

                    <div class="item">
                        <a href="#" class="image">
                            <img data-echo="assets/images/brands/brand4.png" src="assets/images/blank.gif" alt="">
                        </a>
                    </div>
                    <!--/.item-->

                    <div class="item">
                        <a href="#" class="image">
                            <img data-echo="assets/images/brands/brand5.png" src="assets/images/blank.gif" alt="">
                        </a>
                    </div>
                    <!--/.item-->

                    <div class="item">
                        <a href="#" class="image">
                            <img data-echo="assets/images/brands/brand6.png" src="assets/images/blank.gif" alt="">
                        </a>
                    </div>
                    <!--/.item-->

                    <div class="item">
                        <a href="#" class="image">
                            <img data-echo="assets/images/brands/brand2.png" src="assets/images/blank.gif" alt="">
                        </a>
                    </div>
                    <!--/.item-->

                    <div class="item">
                        <a href="#" class="image">
                            <img data-echo="assets/images/brands/brand4.png" src="assets/images/blank.gif" alt="">
                        </a>
                    </div>
                    <!--/.item-->

                    <div class="item">
                        <a href="#" class="image">
                            <img data-echo="assets/images/brands/brand1.png" src="assets/images/blank.gif" alt="">
                        </a>
                    </div>
                    <!--/.item-->

                    <div class="item">
                        <a href="#" class="image">
                            <img data-echo="assets/images/brands/brand5.png" src="assets/images/blank.gif" alt="">
                        </a>
                    </div>
                    <!--/.item-->
                </div><!-- /.owl-carousel #logo-slider -->
            </div><!-- /.logo-slider-inner -->

        </div><!-- /.logo-slider -->
        <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
    </div><!-- /.container -->
</div><!-- /.body-content -->

<?php

require_once('layouts/footer.php');

?>