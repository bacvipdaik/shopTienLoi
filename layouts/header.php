<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="MediaCenter, Template, eCommerce">
    <meta name="robots" content="all">

    <title><?= $title ?></title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="<?= HOME ?>/assets/css/bootstrap.min.css">

    <!-- Customizable CSS -->
    <link rel="stylesheet" href="<?= HOME ?>/assets/css/main.css">
    <link rel="stylesheet" href="<?= HOME ?>/assets/css/blue.css">
    <link rel="stylesheet" href="<?= HOME ?>/assets/css/owl.carousel.css">
    <link rel="stylesheet" href="<?= HOME ?>/assets/css/owl.transitions.css">
    <link rel="stylesheet" href="<?= HOME ?>/assets/css/animate.min.css">
    <link rel="stylesheet" href="<?= HOME ?>/assets/css/rateit.css">
    <link rel="stylesheet" href="<?= HOME ?>/assets/css/bootstrap-select.min.css">
    <link rel="shortcut icon" href="/assets/images/faviconhome.png" type="image/x-icon">



    <!-- Icons/Glyphs -->
    <link rel="stylesheet" href="<?= HOME ?>/assets/css/font-awesome.css">

    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>


</head>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['logout'])) {
        unset($_SESSION['id']);
        unset($_SESSION['dangnhap']);
        echo "<script>
                window.location = '" . HOME . "/dangnhap';
            </script>";
    }
}
?>

<body class="cnt-home">
    <!-- ============================================== HEADER ============================================== -->
    <header class="header-style-1">

        <!-- ============================================== TOP MENU ============================================== -->
        <div class="top-bar animate-dropdown">
            <div class="container">
                <div class="header-top-inner">
                    <div class="cnt-account">
                        <ul class="list-unstyled">
                            <?php
                            if (isset($_SESSION['dangnhap'])) :
                            ?>
                                <li><a href="<?= HOME ?>/taikhoan"><i class="icon fa fa-user"></i>Tài khoản</a></li>
                                <li><a href="<?= HOME ?>/giohang"><i class="icon fa fa-shopping-cart"></i>Giỏ hàng</a></li>
                                <li><a href="<?= HOME ?>/hoadon"><i class="icon fa fa-list-alt"></i>Hoá đơn</a></li>
                                <li>
                                    <form action="" method="POST">
                                        <input type="submit" name="logout" class="btn" value="Đăng xuất" style="background-color: transparent; color: rgba(255,255,255,0.8); font-size: 12px"></input>
                                    </form>
                                </li>
                            <?php
                            else :
                            ?>
                                <li><a href="<?= HOME ?>/giohang"><i class="icon fa fa-shopping-cart"></i>Giỏ hàng</a></li>
                                <li><a href=""><i class="icon fa fa-check"></i>Thanh toán</a></li>
                                <li><a href="<?= HOME ?>/dangnhap"><i class="icon fa fa-lock"></i>Đăng nhập</a></li>
                            <?php
                            endif;
                            ?>
                        </ul>
                    </div><!-- /.cnt-account -->


                    <div class="clearfix"></div>
                </div><!-- /.header-top-inner -->
            </div><!-- /.container -->
        </div><!-- /.header-top -->
        <!-- ============================================== TOP MENU : END ============================================== -->
        <div class="main-header">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-1 logo-holder">
                        <!-- ============================================================= LOGO ============================================================= -->
                        <div class="logo">
                            <a href="<?= HOME ?>">

                                <img src="<?= HOME ?>/assets/images/shop-icon-png-6.jpg" alt="" width="70%">

                            </a>
                        </div><!-- /.logo -->
                        <!-- ============================================================= LOGO : END ============================================================= -->
                    </div><!-- /.logo-holder -->

                    <div class="col-xs-12 col-sm-12 col-md-9 top-search-holder">
                        <!-- /.contact-row -->
                        <!-- ============================================================= SEARCH AREA ============================================================= -->
                        <div class="search-area">
                            <form method="POST" action="<?= HOME ?>/timkiem">
                                <div class="control-group">

                                    <ul class="categories-filter animate-dropdown">
                                        <li class="dropdown">

                                            <a class="dropdown-toggle" data-toggle="dropdown" href="category.html">Tìm kiếm</a>
                                        </li>
                                    </ul>

                                    <input class="search-field" name="timkiem" placeholder="Nhập tên sản phẩm để tìm kiếm..." />
                                    <button type="submit" name="search-btn" class="search-button" href="#"></button>

                                </div>
                            </form>
                        </div><!-- /.search-area -->
                        <!-- ============================================================= SEARCH AREA : END ============================================================= -->
                    </div><!-- /.top-search-holder -->

                    <div class="col-xs-12 col-sm-12 col-md-2 animate-dropdown top-cart-row" padding-right="0">
                        <!-- ============================================================= SHOPPING CART DROPDOWN ============================================================= -->

                        <div class="dropdown dropdown-cart ">
                            <a href="#" class="dropdown-toggle lnk-cart" data-toggle="dropdown">
                                <div class="items-cart-inner">
                                    <div class="basket">
                                        <i class="glyphicon glyphicon-shopping-cart"></i>
                                    </div>
                                    <div class="basket-item-count"><span class="count"><?= isset($_SESSION['giohang']) ? count($_SESSION['giohang']) : 0 ?></span></div>
                                    <div class="total-price-basket">
                                        <span class="lbl">Giỏ hàng</span>
                                    </div>


                                </div>
                            </a>
                            <ul class="dropdown-menu">
                                <li>

                                    <?php
                                    if (isset($_SESSION['giohang'])) :
                                        $tongtien = 0;
                                        foreach ($_SESSION['giohang'] as $sanpham) :
                                            $thanhtien = $sanpham['gia'] * $sanpham['soluong'];
                                            $tongtien += $thanhtien;
                                    ?>
                                            <div class="cart-item product-summary">
                                                <div class="row">
                                                    <div class="col-xs-4">
                                                        <div class="image">
                                                            <a href="<?= HOME ?>/sanpham/<?= $sanpham['id'] ?>"><img src="<?= HOME ?>/assets/images/sanpham/<?= $sanpham['anh'] ?>" alt=""></a>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-7">

                                                        <h3 class="name">
                                                            <a href="<?= HOME ?>/sanpham/<?= $sanpham['id'] ?>">
                                                                <?= $sanpham['tensp'] ?> <br>x <?= $sanpham['soluong'] ?>
                                                            </a>
                                                        </h3>
                                                        <div class="price"><?= number_format($sanpham['gia'], 0, ',', '.') ?> VNĐ</div>
                                                    </div>
                                                    <div class="col-xs-1 action">
                                                        <a href="<?= HOME ?>/xoagiohang/<?= $sanpham['id'] ?>"><i class="fa fa-trash"></i></a>
                                                    </div>
                                                </div>
                                            </div><!-- /.cart-item -->
                                            <div class="clearfix"></div>
                                            <hr>

                                    <?php
                                        endforeach;
                                    endif;
                                    ?>

                                    <div class="clearfix cart-total">
                                        <div class="pull-right">

                                            <span class="text">Tổng :</span><?php echo isset($tongtien) ? number_format($tongtien, 0, ',', '.') : '0' ?> VNĐ </span>

                                        </div>
                                        <div class="clearfix"></div>

                                        <a href="<?= HOME ?>/giohang" class="btn btn-upper btn-primary btn-block m-t-20">Thanh toán</a>
                                    </div><!-- /.cart-total-->


                                </li>
                            </ul><!-- /.dropdown-menu-->
                        </div><!-- /.dropdown-cart -->

                        <!-- ============================================================= SHOPPING CART DROPDOWN : END============================================================= -->
                    </div><!-- /.top-cart-row -->
                </div><!-- /.row -->

            </div><!-- /.container -->

        </div><!-- /.main-header -->

        <!-- ============================================== NAVBAR ============================================== -->
        <div class="header-nav animate-dropdown">
            <div class="container">
                <div class="yamm navbar navbar-default" role="navigation">
                    <div class="navbar-header">
                        <button data-target="#mc-horizontal-menu-collapse" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="nav-bg-class">
                        <div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
                            <div class="nav-outer">
                                <ul class="nav navbar-nav">
                                    <li class="dropdown yamm-fw <?php echo !isset($id) ? 'active' : '' ?>">
                                        <a href="<?= HOME ?>">Home</a>
                                    </li>
                                    <?php
                                    $stmt = $conn->prepare("SELECT * FROM danhmuc");
                                    $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                    $stmt->execute();
                                    while ($row = $stmt->fetch()) :
                                    ?>
                                        <li class="dropdown yamm-fw <?php echo isset($id) && $id == $row['id'] ? 'active' : '' ?>">
                                            <a href="<?= HOME ?>/danhmuc/<?= $row['id'] ?>"><?= $row['tendanhmuc'] ?></a>
                                        </li>
                                    <?php
                                    endwhile;
                                    ?>

                                </ul><!-- /.navbar-nav -->
                                <div class="clearfix"></div>
                            </div><!-- /.nav-outer -->
                        </div><!-- /.navbar-collapse -->


                    </div><!-- /.nav-bg-class -->
                </div><!-- /.navbar-default -->
            </div><!-- /.container-class -->

        </div><!-- /.header-nav -->
        <!-- ============================================== NAVBAR : END ============================================== -->

    </header>

    <!-- ============================================== HEADER : END ============================================== -->