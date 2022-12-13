<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?= $title ?></title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.7 -->
	<link rel="stylesheet" href="<?= base_url('assets/backend') ?>/bower_components/bootstrap/dist/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?= base_url('assets/backend') ?>/bower_components/font-awesome/css/font-awesome.min.css">
	<!-- datatables -->
	<link rel="stylesheet" href="<?= base_url('assets/backend') ?>/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
	<!-- Ionicons -->
	<!-- <link rel="stylesheet" href="/pos/asset/bower_components/Ionicons/css/ionicons.min.css"> -->
	<!-- bootstrap datepicker -->
	<link rel="stylesheet" href="<?= base_url('assets/backend') ?>/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?= base_url('assets/backend') ?>/dist/css/AdminLTE.min.css">
	<!-- AdminLTE Skins. Choose a skin from the css/skins
		folder instead of downloading all of them to reduce the load. -->
	<link rel="stylesheet" href="<?= base_url('assets/backend') ?>/dist/css/skins/_all-skins.min.css">
	<!-- Select2 -->
	<link rel="stylesheet" href="<?= base_url('assets/backend') ?>/bower_components/select2/dist/css/select2.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/backend/css/bootstrap-select.css'); ?>">
	<!-- bootstrap wysihtml5 - text editor -->
	<link rel="stylesheet" href="<?= base_url('assets/backend') ?>/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">


</head>

<body class="hold-transition skin-blue sidebar-mini">

	<!-- Site wrapper -->
	<div class="wrapper">

		<header class="main-header">
			<!-- Logo -->
			<a href="<?= site_url('dashboard') ?>" class="logo">
				<!-- mini logo for sidebar mini 50x50 pixels -->
				<!-- <span class="logo-mini"><b>D</b>T</span> -->
				<!-- logo for regular state and mobile devices -->
				<span class="logo-lg">
					<?php if ($this->fungsi->user_login()->level == 1) { ?>
						<b>Administrator</b>
					<?php } elseif ($this->fungsi->user_login()->level == 2) { ?>
						<b><?= $title ?></b>
					<?php } ?>
				</span>
			</a>
			<!-- Header Navbar: style can be found in header.less -->
			<nav class="navbar navbar-static-top">
				<!-- Sidebar toggle button-->
				<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>

				<div class="navbar-custom-menu">
					<ul class="nav navbar-nav">

						<!-- Notifications: style can be found in dropdown.less -->
						<li class="dropdown notifications-menu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="fa fa-bell-o"></i>
								<span class="label label-warning">10</span>
							</a>
							<ul class="dropdown-menu">
								<li class="header"><i class="fa fa-cart-plus text-aqua"></i> Anda memiliki 10 transaksi baru</li>

								<li class="footer"><a href="#">Tampilkan Semua</a></li>
							</ul>
						</li>

						<!-- User Account: style can be found in dropdown.less -->
						<li class="dropdown user user-menu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<?php if ($this->fungsi->user_login()->image == null) { ?>
									<img src="<?= base_url('uploads/user.png') ?>" class="user-image" alt="User Image">
								<?php } else { ?>
									<img src="<?= base_url('uploads/profil/' . $this->fungsi->user_login()->image) ?>" class="user-image" alt="User Image">
								<?php } ?>
								<span class="hidden-xs"><?= ucfirst($this->fungsi->user_login()->nama) ?></span>
							</a>
							<ul class="dropdown-menu">
								<!-- User image -->
								<li class="user-header">
									<?php if ($this->fungsi->user_login()->image == null) { ?>
										<img src="<?= base_url('uploads/user.png') ?>" class="img-circle" alt="User Image">
									<?php } else { ?>
										<img src="<?= base_url('uploads/profil/' . $this->fungsi->user_login()->image) ?>" class="img-circle" alt="User Image">
									<?php } ?>

									<p>
										<?= ucfirst($this->fungsi->user_login()->nama) ?>
										<?php if ($this->fungsi->user_login()->level == 1) { ?>
											<small>Administrator</small>
										<?php } elseif ($this->fungsi->user_login()->level == 2) { ?>
											<small><?php echo $this->config->item('nama_aplikasi'); ?></small>
										<?php } ?>
									</p>
								</li>
								<!-- Menu Body -->
								<li class="user-body">
									<!-- /.row -->
								</li>
								<!-- Menu Footer-->
								<li class="user-footer">
									<div class="pull-left">
										<a href="<?= site_url('') ?>" class="btn btn-primary btn-flat">Kunjungi E-Commerce</a>
									</div>
									<div class="pull-right">
										<a href="<?= site_url('keluar') ?>" class="btn btn-danger btn-flat">Keluar</a>
									</div>
								</li>
							</ul>
						</li>

					</ul>
				</div>
			</nav>
		</header>