<!doctype html>
<html lang="zxx">
<?php
$this->db = db_connect();
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $title ?></title>
    <link rel="icon" href="<?= base_url('foto/logo.webp') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/home/') ?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/home/') ?>css/animate.css">
    <link rel="stylesheet" href="<?= base_url('assets/home/') ?>css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/home/') ?>css/all.css">
    <link rel="stylesheet" href="<?= base_url('assets/home/') ?>css/flaticon.css">
    <link rel="stylesheet" href="<?= base_url('assets/home/') ?>css/themify-icons.css">
    <link rel="stylesheet" href="<?= base_url('assets/home/') ?>css/magnific-popup.css">
    <link rel="stylesheet" href="<?= base_url('assets/home/') ?>css/slick.css">
    <link rel="stylesheet" href="<?= base_url('assets/home/') ?>css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@8/dist/sweetalert2.min.css" rel=" stylesheet">
</head>

<body>
    <header class="main_menu home_menu">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <a class="navbar-brand" href="<?= base_url('home') ?>"> <img src="<?= base_url('foto/logo.webp') ?>" width="50px" alt="logo"> </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="menu_icon"><i class="fas fa-bars"></i></span>
                        </button>

                        <div class="collapse navbar-collapse main-menu-item" id="navbarSupportedContent">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= base_url('home/') ?>">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= base_url('home/produkdaftar') ?>">Produk</a>
                                </li>
                                <?php
                                $datakategori = $this->db->table('kategori')->get()->getResult()
                                ?>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown_1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Kategori
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown_1">
                                        <?php
                                        foreach ($datakategori as $kategori) { ?>
                                            <a class="dropdown-item" href="<?= base_url('home/kategoridaftar/' . $kategori->idkategori) ?>"> <?= $kategori->namakategori ?></a>
                                        <?php } ?>
                                    </div>
                                </li>
                                <?php
                                if (session('level') == 'Pembeli') {
                                    $nama = session('nama');
                                    $namaArray = explode(" ", $nama);
                                    $namaawal = $namaArray[0];
                                ?>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="<?= base_url('assets/home/') ?>blog.html" id="navbarDropdown_2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Halo <b><?= $namaawal ?></b>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown_2">
                                            <a class="dropdown-item" href="<?= base_url('home/profil/') ?>">Profil</a>
                                            <a class="dropdown-item" href="<?= base_url('home/keranjang/') ?>">Keranjang</a>
                                            <a class="dropdown-item" href="<?= base_url('home/transaksiriwayat/') ?>">Riwayat Transaksi</a>
                                            <a class="dropdown-item" href="<?= base_url('chat'); ?>">Chat</a>
                                            <a class="dropdown-item" href="<?= base_url('home/logout/') ?>" onclick="return confirm('Apakah Anda Yakin Ingin Log Out ?')">Logout</a>
                                        </div>
                                    </li>
                                <?php } else { ?>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="<?= base_url('assets/home/') ?>blog.html" id="navbarDropdown_2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Akun
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown_2">
                                            <a class="dropdown-item" href="<?= base_url('home/daftar/') ?>">Daftar</a>
                                            <a class="dropdown-item" href="<?= base_url('home/login/') ?>">Login</a>
                                        </div>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
