<?php
        include "../config/config.php";

        $sql = mysqli_query($connection, "SELECT * FROM tbl_users WHERE id_user='$_SESSION[id]'");
        $data = mysqli_fetch_array($sql);
     ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard | beriTA</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="../assets/css/be/fontawesome-free/css/all.min.css">
    <!-- IonIcons -->
    <link rel="stylesheet" href="../assets/css/ionicons.min.css">
    <!-- Main CSS -->
    <link rel="stylesheet" href="../assets/css/be/adminlte.min.css">

    <style>
    .table tr td {
        width: 20px;
    }

    #sidenav {
        position: fixed;
        top: 0;
        height: 100vh;
        overflow-y: hidden;
    }

    .content-wrapper {
        position: relative;
        top: 0;
        z-index: 1;
    }

    .modal-backdrop {
        z-index: 10;
    }
    </style>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand sticky-top" style="backdrop-filter: blur(2px); height: 64px;">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
            <ul class="ml-auto mt-auto">
                <ol class="breadcrumb float-right bg-transparent">
                    <li class="breadcrumb-item "><a href="index.php?page=home">Dashboard</a></li>
                    <li class="breadcrumb-item active"><?= $_GET['page'] ?></li>
                </ol>
            </ul>

        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-light-dark elevation-4" id="sidenav">

            <!-- Bootstrap Modal for halaman spk Confirmation -->
            <div class="modal fade" id="spkModal" tabindex="-1" role="dialog" aria-labelledby="spkModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="spkModalLabel">Dashboard | beriTA</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h6 class="text-center">Apakah Anda yakin ingin meninggalkan halaman ini, dan beralih ke
                                halaman SPK | SAW?</h6>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Batal</button>
                            <a href="http://localhost/saw/?page=welcome" class="btn btn-outline-danger">Lanjutkan</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bootstrap Modal for Logout Confirmation -->
            <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="logoutModalLabel">Konfirmasi Logout</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Apakah Anda yakin ingin keluar?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Batal</button>
                            <a href="logout.php" class="btn btn-outline-danger">Log Out</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Brand Logo -->
            <a href="#" class="brand-link" style="height: 64px;">
                <h1 class="navbar-brand text-primary ">beri<b class="text-primary"
                        style="font-weight: 900; font-size: 24px;">.</b><b class="text-danger fw-bolder">TA</b></h1>
            </a>


            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="../assets/img/<?= $data['img'] ?>" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"><?= $_SESSION['pengguna'] ?></a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                        <?php if ($_SESSION['lvluser'] == 1) { ?>
                        <li class="nav-item <?php echo ($_GET['page'] == 'home') ? 'menu-open' : ''; ?>">
                            <a href="index.php?page=home"
                                class="nav-link <?php echo ($_GET['page'] == 'home') ? 'active' : ''; ?>">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="index.php?page=data-berita"
                                class="nav-link <?php echo ($_GET['page'] == 'data-berita') ? 'active' : ''; ?>">
                                <i class="nav-icon fas fa-clipboard"></i>
                                <p>Data Berita</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="index.php?page=tambah-berita"
                                class="nav-link <?php echo ($_GET['page'] == 'tambah-berita') ? 'active' : ''; ?>">
                                <i class="nav-icon fas fa-plus"></i>
                                <p>Tambah Berita</p>
                            </a>
                        </li>
                        <?php } elseif ($_SESSION['lvluser'] == 2) { ?>
                        <li class="nav-item <?php echo ($_GET['page'] == 'home') ? 'menu-open' : ''; ?>">
                            <a href="index.php?page=home"
                                class="nav-link <?php echo ($_GET['page'] == 'home') ? 'active' : ''; ?>">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="index.php?page=data-berita"
                                class="nav-link <?php echo ($_GET['page'] == 'data-berita') ? 'active' : ''; ?>">
                                <i class="nav-icon fas fa-clipboard"></i>
                                <p>Data Berita</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="index.php?page=tambah-berita"
                                class="nav-link <?php echo ($_GET['page'] == 'tambah-berita') ? 'active' : ''; ?>">
                                <i class="nav-icon fas fa-plus"></i>
                                <p>Tambah Berita</p>
                            </a>
                        </li>
                        <?php } ?>
                        <li class="nav-item">
                            <a href="index.php?page=user"
                                class="nav-link <?php echo ($_GET['page'] == 'user') ? 'active' : ''; ?>">
                                <i class="nav-icon fas fa-user"></i>
                                <p>Akun</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <!-- <a class="nav-link" href="http://localhost/saw/?page=welcome" target="_blank">
                                <i class="nav-icon fas fa-code"></i>
                                <p>SPK | SAW</p>
                            </a> -->
                            <!-- sebelum beralih halaman muncul alert dulu -->
                            <a href="#" class="nav-link" data-toggle="modal" data-target="#spkModal">
                                <i class="nav-icon fas fa-code"></i>
                                <p>SPK | SAW</p>
                            </a>
                        </li>
                        <li class="nav-item" style="margin-top: 9rem;">
                            <a href="#" class="nav-link" data-toggle="modal" data-target="#logoutModal">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p><b>Log Out</b></p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->


</body>

</html>
