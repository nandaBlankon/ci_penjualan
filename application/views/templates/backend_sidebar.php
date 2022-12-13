<!-- =============================================== -->

<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
		<!-- Sidebar user panel -->
		<div class="user-panel">
			<div class="pull-left image">
				<?php if ($this->fungsi->user_login()->image == null) { ?>
					<img src="<?= base_url('uploads/user.png') ?>" class="img-circle" alt="User Image">
				<?php } else { ?>
					<img src="<?= base_url('uploads/profil/' . $this->fungsi->user_login()->image) ?>" class="img-circle" alt="User Image">
				<?php } ?>
			</div>
			<div class="pull-left info">
				<p><?= ucfirst($this->fungsi->user_login()->nama) ?></p>
				<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
			</div>
		</div>
		<!-- search form -->

		<!-- /.search form -->
		<!-- sidebar menu: : style can be found in sidebar.less -->
		<ul class="sidebar-menu" data-widget="tree">
			<li class="header">MAIN NAVIGATION</li>
			<li class="<?php if (isset($act_dashboard)) {
							echo $act_dashboard;
						} ?>">
				<a href="<?= site_url('dashboard') ?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
			</li>
			<li class="<?php if (isset($act_profil)) {
							echo $act_profil;
						} ?>">
				<a href="<?= site_url('profil-saya') ?>"><i class="fa fa-user"></i> <span>Kelola Profil Saya</span></a>
			</li>
			<li class="header">MENU UTAMA</li>
			<!-- menu level login admin -->
			<?php if ($this->fungsi->user_login()->level == 1) { ?>

				<li class="treeview <?php if (isset($act_brand)) {
										echo $act_brand;
									} ?>">
					<a href="#">
						<i class="fa fa-dashcube"></i> <span>Brand</span>
						<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
						<li class="<?php if (isset($act_brand1)) {
										echo $act_brand1;
									} ?>">
							<a href="<?= site_url('brand') ?>"><i class="fa fa-circle-o"></i> Data Brand</a>
						</li>
						<li class="<?php if (isset($act_brand2)) {
										echo $act_brand2;
									} ?>">
							<a href="<?= ('brand/tambah') ?>"><i class="fa fa-circle-o"></i> Tambah Brand</a>
						</li>
					</ul>
				</li>

				<li class="treeview <?php if (isset($act_kategori)) {
										echo $act_kategori;
									} ?>">
					<a href="#">
						<i class="fa fa-th-large"></i> <span>Kategori</span>
						<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
						<li class="<?php if (isset($act_kategori1)) {
										echo $act_kategori1;
									} ?>">
							<a href="<?= site_url('kategori') ?>"><i class="fa fa-circle-o"></i> Data Kategori</a>
						</li>
						<li class="<?php if (isset($act_kategori2)) {
										echo $act_kategori2;
									} ?>">
							<a href="<?= ('kategori/tambah') ?>"><i class="fa fa-circle-o"></i> Tambah Kategori</a>
						</li>
					</ul>
				</li>

				<li class="treeview <?php if (isset($act_produk)) {
										echo $act_produk;
									} ?>">
					<a href="#">
						<i class="fa fa-opencart"></i> <span>Produk</span>
						<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
						<li class="<?php if (isset($act_produk1)) {
										echo $act_produk1;
									} ?>">
							<a href="<?= site_url('produk') ?>"><i class="fa fa-circle-o"></i> Data Produk</a>
						</li>
						<li class="<?php if (isset($act_produk2)) {
										echo $act_produk2;
									} ?>">
							<a href="<?= ('produk-tambah') ?>"><i class="fa fa-circle-o"></i> Tambah Produk</a>
						</li>
					</ul>
				</li>

				<li class="<?php if (isset($act_transaksi)) {
								echo $act_transaksi;
							} ?>">
					<a href="<?= site_url('transaksi/laptransaksi') ?>"><i class="fa fa-credit-card"></i> <span>Laporan Transaksi</span></a>
				</li>

				<li class="<?php if (isset($act_user)) {
								echo $act_user;
							} ?>">
					<a href="<?= site_url('user') ?>"><i class="fa fa-users"></i> <span>Kustomer</span></a>
				</li>

				<!-- akhir menu level login admin -->
			<?php }
			// menu level login pembeli
			if ($this->fungsi->user_login()->level == 2) { ?>

				<li class="<?php if (isset($act_transaksisaya)) {
								echo $act_transaksisaya;
							} ?>">
					<a href="<?= site_url('transaksi/transaksisaya') ?>"><i class="fa fa-exchange"></i> <span>Transaksi Saya</span></a>
				</li>

			<?php } elseif ($this->fungsi->user_login()->level == 3) { ?>

				<li class="<?php if (isset($act_transaksi)) {
								echo $act_transaksi;
							} ?>">
					<a href="<?= site_url('mytransaksi') ?>"><i class="fa fa-exchange"></i> <span>Transaksi</span></a>
				</li>

				<li class="<?php if (isset($act_home)) {
								echo $act_home;
							} ?>">
					<a href="<?= site_url('') ?>"><i class="fa fa-shopping-cart"></i> <span>Belanja</span></a>
				</li>

			<?php } ?>
			<li class="header">LAINNYA</li>
			<!-- <li>
					<a href="<?= site_url('user') ?>"><i class="fa fa-user"></i> <span>Users</span></a>
				</li> -->
			<li>
				<a href="#" data-toggle="modal" data-target="#logoutModal"><i class="fa fa-sign-out"></i> <span>Keluar</span></a>
			</li>
		</ul>
	</section>
	<!-- /.sidebar -->
</aside>

<!-- =============================================== -->

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Alert..!</h5>
			</div>
			<div class="modal-body text-bold"><?= ucfirst($this->fungsi->user_login()->nama) ?>, apakah anda yakin ingin keluar..?</div>
			<div class="modal-footer">
				<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
				<a class="btn btn-primary" href="<?= base_url('welcome/logout') ?>">Ya, Keluar!</a>
			</div>
		</div>
	</div>
</div>