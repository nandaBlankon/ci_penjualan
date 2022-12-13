<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $this->config->item('nama_aplikasi'); ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- gLightbox gallery-->
    <link rel="stylesheet" href="<?= base_url('assets/frontend') ?>/vendor/glightbox/css/glightbox.min.css">
    <!-- Range slider-->
    <link rel="stylesheet" href="<?= base_url('assets/frontend') ?>/vendor/nouislider/nouislider.min.css">
    <!-- Choices CSS-->
    <link rel="stylesheet" href="<?= base_url('assets/frontend') ?>/vendor/choices.js/public/assets/styles/choices.min.css">
    <!-- Swiper slider-->
    <link rel="stylesheet" href="<?= base_url('assets/frontend') ?>/vendor/swiper/swiper-bundle.min.css">
    <!-- Google fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Libre+Franklin:wght@300;400;700&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Martel+Sans:wght@300;400;800&amp;display=swap">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="<?= base_url('assets/frontend') ?>/css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="<?= base_url('assets/frontend') ?>/css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="<?= base_url('assets/frontend') ?>/logoaplikasi.png">
</head>

<body>
    <div class="page-holder">
        <!-- navbar-->
        <header class="header bg-white">
            <div class="container px-lg-3">
                <nav class="navbar navbar-expand-lg navbar-light py-3 px-lg-0"><a class="navbar-brand" href="<?= base_url(''); ?>"><span class="fw-bold text-uppercase text-dark"><?php echo $this->config->item('nama_aplikasi'); ?></span></a>
                    <button class="navbar-toggler navbar-toggler-end" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto">
                            <li class="nav-item">
                                <a class="nav-link <?php if (isset($act_home)) {
                                                        echo $act_home;
                                                    } ?>" href="<?= base_url(''); ?>">Home</a>
                            </li>
                            <li class="nav-item dropdown <?php if (isset($act_brand)) {
                                                                echo $act_brand;
                                                            } ?>"><a class="nav-link dropdown-toggle" id="pagesDropdown" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Brands</a>
                                <div class="dropdown-menu mt-3 shadow-sm" aria-labelledby="pagesDropdown">
                                    <?php foreach ($brands->result() as $brand) : ?>
                                        <a class="dropdown-item border-0 transition-link " href="<?= base_url('welcome/brands/' . $brand->id_brand); ?>"><?= ucwords($brand->nama_brand); ?></a>
                                    <?php endforeach ?>
                                </div>
                            </li>
                            <li class="nav-item">
                                <!-- Link--><a class="nav-link" href="detail.html">Cara Pemesanan</a>
                            </li>
                        </ul>
                        <ul class="navbar-nav ms-auto">
                            <?php if ($this->session->userdata('user_id')) { ?>
                                <li class="nav-item"><a class="nav-link" href="<?= site_url('view-cart') ?>"> <i class="fas fa-dolly-flatbed me-1 text-gray"></i>Keranjang<small class="text-gray fw-normal">(<?= $this->cart->total_items(); ?>)</small></a></li>
                                <li class="nav-item "><a class="nav-link" href="<?= base_url('keluar'); ?>"> <i class="fas fa-user me-1 text-gray fw-normal"></i>Keluar</a></li>
                                <li class="nav-item"><a class="nav-link" href="<?= base_url('profil-saya'); ?>" title="Klik disini untuk lihat profil"> Hai, <?= $this->fungsi->user_login()->nama ?></a></li>
                            <?php } else { ?>
                                <li class="nav-item "><a class="nav-link <?php if (isset($act_login)) {
                                                                                echo $act_login;
                                                                            } ?>" href="<?= base_url('login'); ?>"> <i class="fas fa-user me-1 text-gray fw-normal"></i>Login</a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </nav>
            </div>
        </header>