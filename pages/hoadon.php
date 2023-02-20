<?php

$title = 'Hoá đơn';

require_once('layouts/header.php');
if(isset($_SESSION['dangnhap'])) {
    $stmt = $conn->prepare("SELECT * FROM hoadon WHERE user_id = ? ORDER BY ngaytao DESC");
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->execute([
        $_SESSION['id']
    ]);
    $result = $stmt->rowCount();
}
?>

<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="#">Home</a></li>
                <li class='active'>Hoá đơn</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content outer-top-xs">
    <div class="container">
    <?php
    if(isset($_SESSION['dangnhap'])){
        ?>
        <div class="row ">
            <div class="shopping-cart">
                <div class="shopping-cart-table ">
                    <div class="table-responsive">
                        <?php
                         if ($result > 0) :
                        ?>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="cart-romove item">STT</th>
                                    <th class="cart-description item">Mã hoá đơn</th>
                                    <th class="cart-product-name item">Thanh toán</th>
                                    <th class="cart-qty item">Tổng tiền</th>
                                    <th class="cart-product-sub-total item">Trạng thái</th>
                                    <th class="cart-total last-item">Ngày tạo</th>
                                </tr>
                            </thead><!-- /thead -->
                            <tbody>
                                <?php
                                    $stt = 0;
                                    while ($hoadon = $stmt->fetch()) :
                                ?>
                                        <tr>
                                            <td class="romove-item"><?= ++$stt ?></td>
                                            <td class="romove-item">
                                                <a href="<?= HOME ?>/chitiethoadon/<?= $hoadon['mahoadon'] ?>">
                                                    <?= $hoadon['mahoadon'] ?></a>
                                            </td>
                                            <td class="romove-item">
                                                <?= $hoadon['thanhtoan'] ?>
                                            </td>
                                            <td class="cart-product-quantity">
                                                <div class="quant-input">
                                                    <h5><?= number_format($hoadon['tongtien'], 0, ',', '.') ?> VNĐ</h5>
                                                </div>
                                            </td>
                                            <td class="cart-product-sub-total">
                                                <?php
                                                if($hoadon['trangthai'] == 0) {
                                                    echo '<span style="color: #ff7600;">Chưa xác nhận</span>';
                                                }
                                                else if($hoadon['trangthai'] == 1) {
                                                    echo '<span style="color: #00a014;">Đã xác nhận</span>';
                                                }
                                                else {
                                                    echo '<span style="color: red;">Đã huỷ</span>';
                                                }
                                                ?>
                                            </td>
                                            <td class="cart-product-grand-total"><?= $hoadon['ngaytao'] ?></td>
                                        </tr>
                                <?php
                                    endwhile;
                                else:
                                ?>
                                    <div class="alert alert-warning mb0">
                                        <strong>Hoá đơn trống!</strong> <a href="<?=HOME?>" style="text-decoration: underline;color: #3712cc;"> Tiếp tục mua sắm</a>
                                    </div>
                                <?php
                                endif;
                                ?>
                            </tbody><!-- /tbody -->
                        </table><!-- /table -->
                    </div>
                </div><!-- /.shopping-cart-table -->
            </div><!-- /.shopping-cart -->
        </div> <!-- /.row -->
    <?php 
    }
    else {
        ?>
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-danger" role="alert">
                    <strong>Vui lòng <a href="<?= HOME?>/dangnhap" class="link-login">đăng nhập</a> để xem hoá đơn!</strong>
                </div>
            </div>
        </div>
        <?php
    }
?>
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