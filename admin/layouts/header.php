<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title; ?></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?php echo BASE_URL ?>/plugins/fontawesome-free/css/all.min.css">
    <!-- IonIcons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo BASE_URL ?>/dist/css/adminlte.min.css">

    <link rel="shortcut icon" href="<?php echo BASE_URL ?>/plugins/favicon/favicon.ico" type="image/x-icon">

    <!-- jQuery -->
    <script src="<?php echo BASE_URL ?>/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo BASE_URL ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE -->
    <script src="<?php echo BASE_URL ?>/dist/js/adminlte.js"></script>

</head>
<!--
`body` tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-mini
-->

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="<?= BASE_URL ?>" class="nav-link">Home</a>
                </li>
            </ul>

        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="<?= BASE_URL ?>" class="brand-link">
                <img src="<?= BASE_URL ?>/dist/img/pngtree-store-icon-image_1128274.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Quản lý bán hàng</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex justify-content-around">
                    <div class="info">
                        <span class="d-block" style="color: #fff;text-transform: uppercase;"><?php echo $_SESSION['username_admin'] ?></span>
                    </div>
                    <div class=" dangxuat">
                            <a href="<?= BASE_URL ?>/dangxuat" class="btn btn-primary btn-sm text-white">Đăng xuất</a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-list-alt"></i>
                                <p>
                                    Sản phẩm
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview pl-2">
                                <li class="nav-item">
                                    <a href="<?= BASE_URL ?>/sanpham/them" class="nav-link">
                                        <i class="fas fa-plus nav-icon"></i>
                                        <p>Thêm</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= BASE_URL ?>/sanpham/danhsach" class="nav-link">
                                        <i class="fas fa-clipboard-list nav-icon"></i>
                                        <p>Danh sách</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-list-alt"></i>
                                <p>
                                    Danh mục
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview pl-2">
                                <li class="nav-item">
                                    <a href="<?= BASE_URL ?>/danhmuc/them" class="nav-link">
                                        <i class="fas fa-plus nav-icon"></i>
                                        <p>Thêm</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= BASE_URL ?>/danhmuc/danhsach" class="nav-link">
                                        <i class="fas fa-clipboard-list nav-icon"></i>
                                        <p>Danh sách</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-list-alt"></i>
                                <p>
                                    Nhà cung cấp
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview pl-2">
                                <li class="nav-item">
                                    <a href="<?= BASE_URL ?>/nhacungcap/them" class="nav-link">
                                        <i class="fas fa-plus nav-icon"></i>
                                        <p>Thêm</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= BASE_URL ?>/nhacungcap/danhsach" class="nav-link">
                                        <i class="fas fa-clipboard-list nav-icon"></i>
                                        <p>Danh sách</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-list-alt"></i>
                                <p>
                                    Quản lý tài khoản
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview pl-2">
                                <li class="nav-item">
                                    <a href="<?= BASE_URL ?>/taikhoan/danhsach" class="nav-link">
                                        <i class="fas fa-clipboard-list nav-icon"></i>
                                        <p>Danh sách</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-list-alt"></i>
                                <p>
                                    Quản lý đơn hàng
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview pl-2">
                                <li class="nav-item">
                                    <a href="<?= BASE_URL ?>/donhang/danhsach" class="nav-link">
                                        <i class="fas fa-clipboard-list nav-icon"></i>
                                        <p>Xem danh sách</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>