<?php

$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 12;

$stmt = $conn->prepare('SELECT * FROM danhmuc WHERE id = ?');
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute([
    $id
]);
$row_danhmuc = $stmt->fetch();

$title = $row_danhmuc['tendanhmuc'];
require_once('layouts/header.php');

$stmt = $conn->prepare('SELECT COUNT(sanpham.id) AS Tong FROM sanpham WHERE danhmuc_id = ?');
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute([
    $id
]);
$row_tong = $stmt->fetch();
$tong = $row_tong['Tong'];
$total_page = ceil($tong / $limit);

if ($current_page > $total_page) {
    $current_page = $total_page;
} else if ($current_page < 1) {
    $current_page = 1;
}

$start = ($current_page - 1) * $limit;

?>
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="<?= HOME ?>">Home</a></li>
                <li class='active'><?= $title ?></li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->
<div class="body-content outer-top-xs">
    <div class='container'>
        <div class='row'>

            <div class='col-md-12'>
                <div class="search-result-container ">
                    <div id="myTabContent" class="tab-content category-list">
                        <div class="tab-pane active " id="grid-container">
                            <div class="category-product">
                                <div class="row" style="display: flex; flex-wrap: wrap; justify-content: flex-start;">

                                    <?php
                                    $stmt = $conn->prepare("SELECT * FROM sanpham WHERE danhmuc_id = ? LIMIT $start, $limit");
                                    $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                    $stmt->execute([
                                        $id
                                    ]);
                                    while ($row_sanpham = $stmt->fetch()) :
                                    ?>
                                        <div class="col-sm-6 col-md-3 wow fadeInUp">
                                            <div class="products">
                                                <div class="product">
                                                    <div class="product-image">
                                                        <div class="image">
                                                            <a href="<?= HOME ?>/sanpham/<?= $row_sanpham['id'] ?>"><img src="<?= HOME ?>/assets/images/sanpham/<?= $row_sanpham['anh'] ?>" alt="" class="images"></a>
                                                        </div><!-- /.image -->
                                                    </div><!-- /.product-image -->
                                                    <div class="product-info text-left">
                                                        <h3 class="name"><a href="<?= HOME ?>/sanpham/<?= $row_sanpham['id'] ?>"><?= $row_sanpham['tensp'] ?></a></h3>
                                                        <div class="rating rateit-small"></div>
                                                        <div class="description"></div>

                                                        <div class="product-price">
                                                            <span class="price">
                                                                <?= number_format($row_sanpham['gia'], 0, ',', '.') ?> VND
                                                            </span>

                                                        </div><!-- /.product-price -->

                                                    </div><!-- /.product-info -->
                                                    <div class="cart clearfix animate-effect cart_danhmuc">
                                                        <div class="action">
                                                            <a href="<?= HOME ?>/themgiohang/<?= $row_sanpham['id'] ?>">
                                                                <ul class="list-unstyled">
                                                                    <li class="add-cart-button btn-group">
                                                                        <button class="btn btn-primary icon" type="button">
                                                                            <i class="fa fa-shopping-cart"></i>
                                                                        </button>
                                                                        <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                                                                    </li>
                                                                </ul>
                                                            </a>
                                                        </div><!-- /.action -->
                                                    </div><!-- /.cart -->
                                                </div><!-- /.product -->

                                            </div><!-- /.products -->
                                        </div><!-- /.item -->
                                    <?php
                                    endwhile;
                                    ?>

                                </div><!-- /.row -->
                            </div><!-- /.category-product -->

                        </div><!-- /.tab-pane -->

                    </div><!-- /.tab-content -->
                    <div class="clearfix filters-container">

                        <div class="text-right">
                            <div class="pagination-container">
                                <ul class="list-inline list-unstyled">
                                    <?php
                                    if ($current_page > 1 && $total_page > 1) :
                                    ?>
                                        <li class="prev"><a href="?page=<?= ($current_page - 1) ?>"><i class="fa fa-angle-left"></i></a></li>
                                        <?php
                                    endif;
                                    for ($i = 1; $i <= $total_page; $i++) :
                                        if ($i == $current_page) :
                                        ?>
                                            <li class="active"><?= $current_page ?></li>
                                        <?php
                                        else :
                                        ?>
                                            <li><a href="?page=<?= $i ?>"><?= $i ?></a></li>
                                        <?php
                                        endif;
                                    endfor;
                                    if ($current_page < $total_page && $total_page > 1) :
                                        ?>
                                        <li class="next"><a href="#"><i class="fa fa-angle-right"></i></a></li>
                                    <?php
                                    endif;
                                    ?>
                                </ul><!-- /.list-inline -->
                            </div><!-- /.pagination-container -->
                        </div><!-- /.text-right -->

                    </div><!-- /.filters-container -->

                </div><!-- /.search-result-container -->

            </div><!-- /.col -->
        </div><!-- /.row -->
        <!-- ============================================== BRANDS CAROUSEL ============================================== -->
        <div id="brands-carousel" class="logo-slider wow fadeInUp">


            <div class="logo-slider-inner">
                <div id="brand-slider" class="owl-carousel brand-slider custom-carousel owl-theme">
                    <div class="item m-t-15">
                        <a href="#" class="image">
                            <img data-echo="<?= HOME ?>/assets/images/brands/brand1.png" src="<?= HOME ?>/assets/images/blank.gif" alt="">
                        </a>
                    </div>
                    <!--/.item-->

                    <div class="item m-t-10">
                        <a href="#" class="image">
                            <img data-echo="<?= HOME ?>/assets/images/brands/brand2.png" src="<?= HOME ?>/assets/images/blank.gif" alt="">
                        </a>
                    </div>
                    <!--/.item-->

                    <div class="item">
                        <a href="#" class="image">
                            <img data-echo="<?= HOME ?>/assets/images/brands/brand3.png" src="<?= HOME ?>/assets/images/blank.gif" alt="">
                        </a>
                    </div>
                    <!--/.item-->

                    <div class="item">
                        <a href="#" class="image">
                            <img data-echo="<?= HOME ?>/assets/images/brands/brand4.png" src="<?= HOME ?>/assets/images/blank.gif" alt="">
                        </a>
                    </div>
                    <!--/.item-->

                    <div class="item">
                        <a href="#" class="image">
                            <img data-echo="<?= HOME ?>/assets/images/brands/brand5.png" src="<?= HOME ?>/assets/images/blank.gif" alt="">
                        </a>
                    </div>
                    <!--/.item-->

                    <div class="item">
                        <a href="#" class="image">
                            <img data-echo="<?= HOME ?>/assets/images/brands/brand6.png" src="<?= HOME ?>/assets/images/blank.gif" alt="">
                        </a>
                    </div>
                    <!--/.item-->

                    <div class="item">
                        <a href="#" class="image">
                            <img data-echo="<?= HOME ?>/assets/images/brands/brand2.png" src="<?= HOME ?>/assets/images/blank.gif" alt="">
                        </a>
                    </div>
                    <!--/.item-->

                    <div class="item">
                        <a href="#" class="image">
                            <img data-echo="<?= HOME ?>/assets/images/brands/brand4.png" src="<?= HOME ?>/assets/images/blank.gif" alt="">
                        </a>
                    </div>
                    <!--/.item-->

                    <div class="item">
                        <a href="#" class="image">
                            <img data-echo="<?= HOME ?>/assets/images/brands/brand1.png" src="<?= HOME ?>/assets/images/blank.gif" alt="">
                        </a>
                    </div>
                    <!--/.item-->

                    <div class="item">
                        <a href="#" class="image">
                            <img data-echo="<?= HOME ?>/assets/images/brands/brand5.png" src="<?= HOME ?>/assets/images/blank.gif" alt="">
                        </a>
                    </div>
                    <!--/.item-->
                </div><!-- /.owl-carousel #logo-slider -->
            </div><!-- /.logo-slider-inner -->

        </div><!-- /.logo-slider -->
        <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
    </div><!-- /.container -->

</div><!-- /.body-content -->
<style>
    .images {
        min-height: 250px;
        object-fit: contain;
    }
</style>
<?php

require_once('layouts/footer.php');

?>