<?php

$timkiem = isset($_POST['timkiem']) ? $_POST['timkiem'] : '';
if ($timkiem != '') {
    $stmt1 = $conn->prepare("SELECT * FROM sanpham WHERE tensp like N'%" . $timkiem . "%'");
} else {
    $stmt1 = $conn->prepare("SELECT * FROM sanpham");
}

$stmt1->setFetchMode(PDO::FETCH_ASSOC);
$stmt1->execute();
$a = $stmt1->rowCount();

$title = $timkiem !=  '' ? $_POST['timkiem'] : 'Tất cả';


require_once('layouts/header.php');

?>

<div class="body-content outer-top-xs">
    <div class='container'>
        <div class='row'>
            <div class='col-md-12'>
                <h3>Tìm kiếm cho "<?= $timkiem ?>"</h3>
                <?php
                if ($a > 0) :
                ?>
                    <div class="search-result-container ">
                        <div id="myTabContent" class="tab-content category-list">
                            <div class="tab-pane active " id="grid-container">
                                <div class="category-product">
                                    <div class="row" style="display: flex; flex-wrap: wrap; justify-content: flex-start;">

                                        <?php

                                        while ($row_sanpham = $stmt1->fetch()) :

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
                        </div><!-- /.filters-container -->

                    </div><!-- /.search-result-container -->
                <?php
                else :
                    ?>
                    <div class="container">
                        <img src="/assets/images/kosanpham.png" alt="" class="kocosanpham">
                    </div>
                    <?php
                endif;
                ?>

            </div><!-- /.col -->
        </div><!-- /.row -->
        <!-- ============================================== BRANDS CAROUSEL ============================================== -->
       
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