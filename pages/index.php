<?php

$title = "Trang chủ";

require_once('layouts/header.php');

?>

<div class="body-content outer-top-xs" id="top-banner-and-menu">
    <div class="container">
        <div class="row">

            <!-- ============================================== CONTENT ============================================== -->
            <div class="col-xs-12 col-sm-12 homebanner-holder">

                <!-- ============================================== INFO BOXES ============================================== -->
                <div class="info-boxes wow fadeInUp">
                    <div class="info-boxes-inner">
                        <div class="row">
                            <div class="col-md-6 col-sm-4 col-lg-4">
                                <div class="info-box">
                                    <div class="row">

                                        <div class="col-xs-12">
                                            <h4 class="info-box-heading green">Hoàn tiền</h4>
                                        </div>
                                    </div>
                                    <h6 class="text">Hoàn tiền tới 30 ngày</h6>
                                </div>
                            </div><!-- .col -->

                            <div class="hidden-md col-sm-4 col-lg-4">
                                <div class="info-box">
                                    <div class="row">

                                        <div class="col-xs-12">
                                            <h4 class="info-box-heading green">miễn phí vận chuyển</h4>
                                        </div>
                                    </div>
                                    <h6 class="text">Miễn phí vận chuyển đơn hàng từ 150.000đ</h6>
                                </div>
                            </div><!-- .col -->

                            <div class="col-md-6 col-sm-4 col-lg-4">
                                <div class="info-box">
                                    <div class="row">

                                        <div class="col-xs-12">
                                            <h4 class="info-box-heading green">Siêu khuyến mãi</h4>
                                        </div>
                                    </div>
                                    <h6 class="text">Giảm tới 90% các loại mặt hàng</h6>
                                </div>
                            </div><!-- .col -->
                        </div><!-- /.row -->
                    </div><!-- /.info-boxes-inner -->
                </div><!-- /.info-boxes -->
                <!-- ============================================== INFO BOXES : END ============================================== -->

                <!-- ============================================== SCROLL TABS ============================================== -->
                <?php
                $stmt_danhmuc = $conn->prepare("SELECT * FROM danhmuc");
                $stmt_danhmuc->setFetchMode(PDO::FETCH_ASSOC);
                $stmt_danhmuc->execute();
                $a = $stmt_danhmuc->rowCount();
                if ($a > 0) :
                    while ($row_danhmuc = $stmt_danhmuc->fetch()) :
                ?>
                        <div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp">
                            <div class="more-info-tab clearfix ">
                                <h3 class="new-product-title pull-left"><?= $row_danhmuc['tendanhmuc'] ?></h3>
                                <a href="<?= HOME ?>/danhmuc/<?= $row_danhmuc['id'] ?>">Xem thêm</a>
                            </div>
                            <div class="tab-content outer-top-xs">
                                <div class="tab-pane in active" id="all">
                                    <div class="product-slider">
                                        <div class="owl-carousel home-owl-carousel custom-carousel owl-theme" data-item="4" style="opacity: 1; display: block;">
                                            <div class="owl-wrapper-outer">
                                                <div class="owl-wrapper" style="width: 100%; left: 0px; display: flex; flex-wrap: wrap; justify-content: flex-start;">

                                                    <?php
                                                    $stmt_sanpham = $conn->prepare("SELECT * FROM sanpham WHERE danhmuc_id = '" . $row_danhmuc['id'] . "' order by sanpham.id DESC LIMIT 10");
                                                    $stmt_sanpham->setFetchMode(PDO::FETCH_ASSOC);
                                                    $stmt_sanpham->execute();
                                                    $b = $stmt_sanpham->rowCount();
                                                    if ($b > 0) :
                                                        while ($row_sanpham = $stmt_sanpham->fetch()) :
                                                    ?>
                                                            <div class="owl-item product-wrapper" style="width: 20%;">
                                                                <div class="item item-carousel">
                                                                    <div class="products">
                                                                        <div class="product">
                                                                            <div class="product-image">
                                                                                <div class="image">
                                                                                    <a href="<?= HOME ?>/sanpham/<?= $row_sanpham['id'] ?>">
                                                                                        <img src="<?= HOME ?>/assets/images/sanpham/<?= $row_sanpham['anh'] ?>" alt="">
                                                                                    </a>
                                                                                </div><!-- /.image -->

                                                                            </div><!-- /.product-image -->
                                                                            <div class="product-info text-center">
                                                                                <h3 class="name">
                                                                                    <a href="<?= HOME ?>/sanpham/<?= $row_sanpham['id'] ?>">
                                                                                        <?= $row_sanpham['tensp'] ?>
                                                                                    </a>
                                                                                </h3>
                                                                                    <div class="product-price">
                                                                                        <span class="price">
                                                                                            <?= number_format($row_sanpham['gia'], 0, ',', '.') ?> VND
                                                                                        </span>
                                                                                    </div><!-- /.product-price -->

                                                                            </div><!-- /.product-info -->
                                                                            <div class="cart clearfix animate-effect">
                                                                                <div class="action">
                                                                                    <a href="<?= HOME ?>/themgiohang/<?= $row_sanpham['id'] ?>">
                                                                                        <ul class="list-unstyled">
                                                                                            <li class="add-cart-button btn-group">
                                                                                                <button data-toggle="tooltip" class="btn btn-primary icon" type="button" title="" data-original-title="Thêm">
                                                                                                    <i class="fa fa-shopping-cart"></i>
                                                                                                </button>
                                                                                            </li>
                                                                                        </ul>
                                                                                    </a>
                                                                                </div><!-- /.action -->
                                                                            </div><!-- /.cart -->
                                                                        </div><!-- /.product -->
                                                                    </div><!-- /.products -->
                                                                </div>
                                                            </div>

                                                    <?php
                                                        endwhile;
                                                    endif;
                                                    ?>

                                                </div>
                                            </div>
                                        </div><!-- /.home-owl-carousel -->
                                    </div><!-- /.product-slider -->
                                </div><!-- /.tab-pane -->

                            </div><!-- /.tab-content -->
                        </div><!-- /.scroll-tabs -->
                <?php
                    endwhile;
                endif;
                ?>
                <!-- ============================================== SCROLL TABS : END ============================================== -->

            </div><!-- /.homebanner-holder -->
            <!-- ============================================== CONTENT : END ============================================== -->
        </div><!-- /.row -->
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
</div><!-- /#top-banner-and-menu -->




<?php

require_once('layouts/footer.php');

?>