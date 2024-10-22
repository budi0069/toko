<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title><?= $title; ?> </title>
    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?= base_url('foto/logo.webp') ?>" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="<?= base_url('assets/panel/') ?>/assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/panel/') ?>/assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="<?= base_url('assets/panel/') ?>/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="<?= base_url('assets/panel/') ?>/assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/panel/') ?>/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <link rel="stylesheet" href="<?= base_url('assets/panel/') ?>/assets/vendor/libs/apex-charts/apex-charts.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="<?= base_url('assets/panel/') ?>/assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../assets/js/config.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@8/dist/sweetalert2.min.css" rel=" stylesheet">
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <style>
        .form-group {
            margin-bottom: 15px;
        }
    </style>
</head>
<?php
if (session('level') == 'Pemilik Toko') {
    $tulisan = "Owner";
    $warna = "bg-primary";
} elseif (session('level') == 'Admin') {
    $tulisan = "Admin";
    $warna = "";
} elseif (session('level') == 'Pegawai') {
    $tulisan = "Pegawai";
    $warna = "bg-danger";
} else {
    $tulisan = "";
    $warna = "";
}
?>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme <?= $warna ?>">
                <div class="app-brand demo">
                    <a href="index.html" class="app-brand-link">
                        <span class="app-brand-logo demo">
                        </span>
                        <span class="app-brand-text demo menu-text fw-bolder ms-2"><?= $tulisan ?> Panel</span>
                    </a>

                    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                        <i class="bx bx-chevron-left bx-sm align-middle"></i>
                    </a>
                </div>

                <div class="menu-inner-shadow"></div>

                <ul class="menu-inner py-1">
                    <!-- Dashboard -->
                    <?php
                    if (session('level') == 'Pegawai') { ?>
                        <li class="menu-item">
                            <a href="<?= base_url('panel') ?>" class=" menu-link">
                                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                                <div data-i18n="Analytics">Dashboard</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="<?= base_url('panel/produk') ?>" class=" menu-link">
                                <i class="menu-icon tf-icons bx bx-table"></i>
                                <div data-i18n="Analytics">Produk</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class="menu-icon tf-icons bx bx-album"></i>
                                <div data-i18n="Authentications">Orderan Masuk</div>
                            </a>
                            <ul class="menu-sub">
                                <li class="menu-item">
                                    <a href="<?= base_url('panel/transaksipesanan') ?>" class="menu-link">
                                        <div data-i18n="Basic">Pesanan Masuk</div>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a href="<?= base_url('panel/transaksipengiriman') ?>" class="menu-link">
                                        <div data-i18n="Basic">Pengiriman</div>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a href="<?= base_url('panel/transaksiselesai') ?>" class="menu-link">
                                        <div data-i18n="Basic">Selesai</div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="menu-item">
                            <a href="<?= base_url('panel/produkmasukdaftar') ?>" class=" menu-link">
                                <i class="menu-icon tf-icons bx bx-aperture"></i>
                                <div data-i18n="Analytics">Produk Masuk</div>
                            </a>
                        </li>
                    <?php } ?>
                    <?php
                    if (session('level') == 'Admin') { ?>
                        <li class="menu-item">
                            <a href="<?= base_url('panel') ?>" class=" menu-link">
                                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                                <div data-i18n="Analytics">Dashboard</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="<?= base_url('panel/kategori') ?>" class=" menu-link">
                                <i class="menu-icon tf-icons bx bx-layout"></i>
                                <div data-i18n="Analytics">Kategori</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="<?= base_url('panel/produk') ?>" class=" menu-link">
                                <i class="menu-icon tf-icons bx bx-table"></i>
                                <div data-i18n="Analytics">Produk</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="<?= base_url('panel/kupon') ?>" class=" menu-link">
                                <i class="menu-icon tf-icons bx bx-table"></i>
                                <div data-i18n="Analytics">Kupon</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="<?= base_url('panel/pembelidaftar') ?>" class=" menu-link">
                                <i class="menu-icon tf-icons bx bx-user"></i>
                                <div data-i18n="Analytics">Akun Pembeli</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class="menu-icon tf-icons bx bx-album"></i>
                                <div data-i18n="Authentications">Orderan Masuk</div>
                            </a>
                            <ul class="menu-sub">
                                <li class="menu-item">
                                    <a href="<?= base_url('panel/transaksipesanan') ?>" class="menu-link">
                                        <div data-i18n="Basic">Pesanan Masuk</div>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a href="<?= base_url('panel/transaksipengiriman') ?>" class="menu-link">
                                        <div data-i18n="Basic">Pengiriman</div>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a href="<?= base_url('panel/transaksiselesai') ?>" class="menu-link">
                                        <div data-i18n="Basic">Selesai</div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    <?php } ?>
                    <?php
                    if (session('level') == 'Pemilik Toko') { ?>
                        <li class="menu-item">
                            <a href="<?= base_url('panel') ?>" class=" menu-link">
                                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                                <div data-i18n="Analytics">Dashboard</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="<?= base_url('panel/kategori') ?>" class=" menu-link">
                                <i class="menu-icon tf-icons bx bx-layout"></i>
                                <div data-i18n="Analytics">Kategori</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="<?= base_url('panel/produk') ?>" class=" menu-link">
                                <i class="menu-icon tf-icons bx bx-table"></i>
                                <div data-i18n="Analytics">Produk</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class="menu-icon tf-icons bx bx-album"></i>
                                <div data-i18n="Authentications">Laporan</div>
                            </a>
                            <ul class="menu-sub">
                                <li class="menu-item">
                                    <a href="<?= base_url('panel/laporanstokproduk') ?>" class="menu-link">
                                        <div data-i18n="Basic">Laporan Stok Produk</div>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a href="<?= base_url('panel/laporanpemesanan') ?>" class="menu-link">
                                        <div data-i18n="Basic">Laporan Penjualan</div>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a href="<?= base_url('panel/laporanpengiriman') ?>" class="menu-link">
                                        <div data-i18n="Basic">Laporan Pengiriman</div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="menu-item">
                            <a href="<?= base_url('panel/penggunadaftar') ?>" class=" menu-link">
                                <i class="menu-icon tf-icons bx bx-lock-open-alt"></i>
                                <div data-i18n="Analytics">Akun Internal</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="<?= base_url('panel/pembelidaftar') ?>" class=" menu-link">
                                <i class="menu-icon tf-icons bx bx-user"></i>
                                <div data-i18n="Analytics">Akun Pembeli</div>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </aside>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                            <i class="bx bx-menu bx-sm"></i>
                        </a>
                    </div>

                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                        <ul class="navbar-nav flex-row align-items-center ms-auto">
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                                    <div class="avatar avatar-online">
                                        <img src="<?= base_url('foto/user.png') ?>" alt class="w-px-40 h-auto rounded-circle" />
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="<?= base_url('panel/profiledit') ?>">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar avatar-online">
                                                        <img src="<?= base_url('foto/user.png') ?>" alt class="w-px-40 h-auto rounded-circle" />
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <span class="fw-semibold d-block"><?= session('nama') ?></span>
                                                    <small class="text-muted"><?= session('level') ?></small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="<?= base_url('panel/profiledit') ?>">
                                            <i class="bx bx-user me-2"></i>
                                            <span class="align-middle">Edit Profile</span>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="<?= base_url('panel/logout') ?>" onclick="return confirm('Apakah Anda Yakin Ingin Log Out ?')">
                                            <i class=" bx bx-power-off me-2"></i>
                                            <span class="align-middle">Log Out</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!--/ User -->
                        </ul>
                    </div>
                </nav>
                <div class="content-wrapper">
                    <?= $this->renderSection('page-content'); ?>
                </div>
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <script src="<?= base_url('assets/panel') ?>/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="<?= base_url('assets/panel') ?>/assets/vendor/libs/popper/popper.js"></script>
    <script src="<?= base_url('assets/panel') ?>/assets/vendor/js/bootstrap.js"></script>
    <script src="<?= base_url('assets/panel') ?>/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="<?= base_url('assets/panel') ?>/assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="<?= base_url('assets/panel') ?>/assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="<?= base_url('assets/panel') ?>/assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="<?= base_url('assets/panel') ?>/assets/js/dashboards-analytics.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <script>
        $(function() {
            <?php if (session()->has("success")) { ?>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '<?= session("success") ?>'
                })
            <?php } ?>
        });
        $(function() {
            <?php if (session()->has("error")) { ?>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: '<?= session("error") ?>'
                })
            <?php } ?>
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#tabel').DataTable();
        });
    </script>
</body>

</html>