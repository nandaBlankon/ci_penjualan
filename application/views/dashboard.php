<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?= $title ?>
			<small>Control Panel</small>
		</h1>
	</section>

	<!-- Main content -->
	<section class="content">
		<!-- Small boxes (Stat box) -->
		<div class="row">

			<?php if ($this->fungsi->user_login()->level == 1) { ?>

				<div class="col-lg-3 col-xs-6">
					<!-- small box -->
					<div class="small-box bg-red">
						<div class="inner">
							<h3><?= $transaksi->num_rows(); ?></h3>

							<p>TRANSAKSI</p>
						</div>
						<div class="icon">
							<i class="ion ion-stats-bars"></i>
						</div>
						<a href="<?= base_url('transaksi/laptransaksi'); ?>" class="small-box-footer">Lihat detail <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->

				<div class="col-lg-3 col-xs-6">
					<!-- small box -->
					<div class="small-box bg-yellow">
						<div class="inner">
							<h3><?= $brand->num_rows(); ?></h3>

							<p>BRANDS</p>
						</div>
						<div class="icon">
							<i class="ion ion-stats-bars"></i>
						</div>
						<a href="<?= base_url('brand'); ?>" class="small-box-footer">Lihat detail <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->

				<div class="col-lg-3 col-xs-6">
					<!-- small box -->
					<div class="small-box bg-green">
						<div class="inner">
							<h3><?= $kategori->num_rows(); ?></h3>

							<p>KATEGORI</p>
						</div>
						<div class="icon">
							<i class="ion ion-stats-bars"></i>
						</div>
						<a href="<?= base_url('kategori'); ?>" class="small-box-footer">Lihat detail <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->

				<div class="col-lg-3 col-xs-6">
					<!-- small box -->
					<div class="small-box bg-aqua">
						<div class="inner">
							<h3><?= $produk->num_rows(); ?></h3>

							<p>PRODUK</p>
						</div>
						<div class="icon">
							<i class="ion ion-stats-bars"></i>
						</div>
						<a href="<?= base_url('produk'); ?>" class="small-box-footer">Lihat detail <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->

			<?php } ?>

			<div class="col-lg-12 col-xs-12 col-md-12">
				<div class="box box-info text-center">
					<div class="box-header">
						<h3 class="box-title">SELAMAT DATANG DI HALAMAN DASHBOARD <?php echo $this->config->item('nama_aplikasi'); ?></h3>
					</div>
					<div class="box-body">
						<p>Hai <?= $this->fungsi->user_login()->nama ?></p>
						<p>
							<?php if ($this->fungsi->user_login()->level == 1) {
								echo "Anda login sebagai Super Admin";
							} else if ($this->fungsi->user_login()->level == 2) {
								echo "Anda login sebagai Penjual";
							} else if ($this->fungsi->user_login()->level == 3) {
								echo "Anda login sebagai Pembeli";
							} ?>
						</p>
					</div>
				</div>
			</div>

			<?php if ($this->fungsi->user_login()->level == 1) { ?>
				<div class="col-lg-12 col-xs-12 col-md-12">
					<div class="box box-info">
						<div class="box-header with-border">
							<h3 class="box-title">LAPORAN TRANSAKSI BERDASARKAN PERIODE TANGGAL</h3>
						</div>
						<div class="box-body">
							<form method="get" action="<?php echo base_url('dashboard') ?>">
								<div class="row">
									<div class="col-sm-6 col-md-4">
										<div class="form-group">
											<label>Filter Tanggal</label>
											<div class="input-group">
												<span class="input-group-addon" style="background-color: gray; color:white;">Tanggal Awal</span>
												<input type="date" name="tgl_awal" value="<?= @$_GET['tgl_awal'] ?>" class="form-control tgl_awal" placeholder="Tanggal Awal" autocomplete="off" required>
												<span class="input-group-addon" style="background-color: #222222; color:white">s/d</span>
												<span class="input-group-addon" style="background-color: gray; color:white;">Tanggal Akhir</span>
												<input type="date" name="tgl_akhir" value="<?= @$_GET['tgl_akhir'] ?>" class="form-control tgl_akhir" placeholder="Tanggal Akhir" autocomplete="off" required>
											</div>
										</div>
									</div>
								</div>
								<button type="submit" name="filter" value="true" class="btn btn-primary btn-flat">TAMPILKAN</button>
								<?php
								if (isset($_GET['filter'])) // Jika user mengisi filter tanggal, maka munculkan tombol untuk reset filter
									echo '<a href="' . base_url('dashboard') . '" class="btn btn-danger btn-flat">RESET</a>';
								?>
							</form>
							<hr>
							<table class="table">
								<tr>
									<th>NO</th>
									<th>ID ORDER</th>
								</tr>
								<?php
								if (empty($order)) { // Jika data tidak ada
									echo "<tr><td colspan='2'>Data tidak ada</td></tr>";
								} else { // Jika jumlah data lebih dari 0 (Berarti jika data ada)
									$no = 1;
									foreach ($order as $data) : ?>
										<tr>
											<td><?= $no++; ?></td>
											<td><?= $data->id_order; ?></td>
										</tr>
									<?php endforeach ?>
								<?php } ?>
							</table>
						</div>
					</div>
				</div>
			<?php } ?>

		</div>
	</section>

</div>
<!-- /.content-wrapper -->