<?php

$stmt = $conn->prepare("SELECT sanpham.*, tendanhmuc FROM sanpham INNER JOIN danhmuc ON sanpham.danhmuc_id = danhmuc.id WHERE sanpham.id = ?");
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute([
    $id
]);

$sanpham_a = $stmt->fetch();
$title = $sanpham_a['tensp'];
$id = $sanpham_a['danhmuc_id'];

require_once('layouts/header.php');

?>

<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="<?= HOME ?>">Home</a></li>
                <li><a href="<?= HOME ?>/danhmuc/<?= $sanpham_a['danhmuc_id'] ?>"><?= $sanpham_a['tendanhmuc'] ?></a></li>
                <li class='active'><?= $sanpham_a['tensp'] ?></li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->
<div class="body-content outer-top-xs">
    <div class='container'>
        <div class='row single-product'>
            <div class='col-md-12'>
                <div class="detail-block">
                    <div class="row wow fadeInUp">

                        <div class="col-xs-12 col-sm-6 col-md-5 gallery-holder">
                            <div class="product-item-holder size-big single-product-gallery small-gallery">

                                <div id="owl-single-product">
                                    <div class="single-product-gallery-item" id="slide1">
                                        <img class="img-responsive" alt="" src="<?= HOME ?>/assets/images/sanpham/<?= $sanpham_a['anh'] ?>" />
                                    </div><!-- /.single-product-gallery-item -->

                                </div><!-- /.single-product-slider -->

                            </div><!-- /.single-product-gallery -->
                        </div><!-- /.gallery-holder -->
                        <div class='col-sm-6 col-md-7 product-info-block'>
                            <div class="product-info">
                                <h1 class="name"><?= $sanpham_a['tensp'] ?></h1>

                                <div class="rating-reviews m-t-20">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="rating rateit-small"></div>
                                        </div>
                                    </div><!-- /.row -->
                                </div><!-- /.rating-reviews -->

                                <div class="stock-container info-container m-t-10">
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <div class="stock-box">
                                                <span class="label">Tình trạng :</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="stock-box">
                                                <span class="value"><?= $sanpham_a['trangthai'] == 1 ? 'Còn hàng' : 'Hết hàng' ?></span>
                                            </div>
                                        </div>
                                    </div><!-- /.row -->
                                </div><!-- /.stock-container -->
                                <div class="price-container info-container m-t-20">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="price-box">
                                                <span class="price"><?= number_format($sanpham_a['gia'], 0, ',', '.') ?> VND</span>
                                            </div>
                                        </div>

                                    </div><!-- /.row -->
                                </div><!-- /.price-container -->

                                <form action="<?=HOME?>/themgiohang/<?= $sanpham_a['id'] ?>" method="post">
                                    <div class="quantity-container info-container">
                                        <div class="row quantity-container_wrapper">
                                            <div class="col-sm-2">
                                                <span class="label">Qty :</span>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="cart-quantity">
                                                    <input class="soluong_input" type="number" name="soluong" value="1" min="1">
                                                </div>
                                            </div>
                                            <div class="col-sm-7">
                                                <b><?= $sanpham_a['donvi'] ?></b>
                                            </div>
                                        </div><!-- /.row -->

                                        <div class="row mt15">
                                            <div class="col-12">
                                                <button class="btn btn-primary"><i class="fa fa-shopping-cart inner-right-vs"></i> Thêm vào giỏ</button>
                                            </div>
                                        </div>
                                    </div><!-- /.quantity-container -->
                                </form>
                            </div><!-- /.product-info -->
                        </div><!-- /.col-sm-7 -->
                    </div><!-- /.row -->
                </div>

                <div class="product-tabs inner-bottom-xs  wow fadeInUp">
                    <div class="row">
                        <div class="col-sm-3">
                            <ul id="product-tabs" class="nav nav-tabs nav-tab-cell">
                                <li class="active"><a data-toggle="tab" href="#description">Mô tả</a></li>
                                <li><a data-toggle="tab" href="#review">Hướng dẫn sử dụng</a></li>
                            </ul><!-- /.nav-tabs #product-tabs -->
                        </div>
                        <div class="col-sm-9">

                            <div class="tab-content">

                                <div id="description" class="tab-pane in active">
                                    <div class="product-tab">
                                        <p class="text"><?= $sanpham_a['mota'] ?></p>
                                    </div>
                                </div><!-- /.tab-pane -->

                                <div id="review" class="tab-pane">
                                    <div class="product-tab">

                                        <div class="product-reviews">
                                            <p class="text"><?= $sanpham_a['hdsd'] ?></p>
                                        </div><!-- /.product-HDSD -->
                                    </div><!-- /.product-tab -->
                                </div><!-- /.tab-pane -->
                            </div><!-- /.tab-content -->
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.product-tabs -->

            </div><!-- /.col -->
            <div class="clearfix"></div>
        </div><!-- /.row -->
    </div><!-- /.container -->
</div><!-- /.body-content -->


<?php

require_once('layouts/footer.php');

?>