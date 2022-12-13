<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?= $title ?>
			<small>Laporan Transaksi Kostumer</small>
		</h1>
	</section>

	<!-- Main content -->
	<section class="content">
		<?php $this->view('messages') ?>
		<div class="box">
			<div class="box-header text-center">

			</div>
			<div class="box-body">

				<table id="table1" class="table table-bordered table-striped">
					<thead>
						<th>NO</th>
						<th>ID ORDER</th>
						<th>PEMBELI</th>
						<th>TANGGAL ORDER/TRANSAKSI</th>
						<th>TOTAL BAYAR</th>
						<th>KETERANGAN</th>
						<th>OPSI</th>
					</thead>
					<tbody>

						<?php
						$no = 1;
						foreach ($row->result() as $data) :
							$pembeli = $this->db->query("select * from tb_user where user_id ='$data->id_pembeli'")->row();
							$detailProduk = $this->db->query("select * from tb_detail_order,tb_produk where tb_detail_order.id_produk=tb_produk.id_produk and tb_detail_order.id_do='$data->id_do'");
						?>
							<tr>
								<td><?= $no++; ?></td>
								<td><?= $data->id_order; ?></td>
								<td><?= ucfirst($pembeli->nama); ?></td>
								<td><?= $data->tanggal; ?></td>
								<td class="pull-right">Rp. <?= number_format($data->grand_total, 0, ",", "."); ?></td>
								<td>
									<?php
									// Jika bukti pembayaran belum di upload
									if ($data->bukti_pembayaran == null) {
										echo "<span class='badge badge-light text-xs'>Menunggu Pembayaran</span>";
										// jika bukti pembayaran sudah di upload
									} else if ($data->bukti_pembayaran != null) {
										// maka tampilkan tombol konfirmasi pembayaran
										if ($data->status_order == 1) {
											echo "
										<a href='' class='btn btn-success btn-xs' title='Klik untuk mengkonfirmasi pembayaran' data-toggle='modal' data-target='#konfirmasiPembayaran$data->id_order'>
										Konfirmasi Pembayaran
										</a>
										";
											// jika konfirmasi pembayaran sudah dilakukan 
										} else if ($data->status_order == 2) {
											echo "<span class='bg-aqua'><small class=''>Pembayaran Lunas</small></span> <br>";
											// maka tampilkan tombol kirim barang
											if ($data->status == 0) {
												echo "<a href='" . base_url('transaksi/kirimbarang/' . $data->id_do) . "' class='btn btn-info btn-xs'>Kirim barang</a>";
												// jika kirim barang sudah dilakukan, maka tampilkan pesan barang sudah dikirim 
											} else if ($data->status == 1) {
												echo "<span class='bg-aqua'><small>Barang sudah dikirim</small></span>";
											} else if ($data->status == 2) { // jika barang sudah diterima oleh pembeli
												echo "<span class='bg-aqua'><small>Barang sudah diterima</small></span>"; // maka tampilkan pesan barang sudah di terima
											}
										}
									}
									?>
								</td>
								<td>
									<a href="" class='btn btn-success btn-xs' data-toggle='modal' data-target='#detailOrder<?= $data->id_order; ?>'>Detail Order</a>
								</td>
							</tr>

							<!-- modal konfirmasi pembayaran -->
							<div class="modal fade" id="konfirmasiPembayaran<?= $data->id_order ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-lg">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4 class="modal-title">Konfirmasi Pembayaran ID Order <?= $data->id_order; ?></h4>
										</div>
										<div class="modal-body">
											<div class="row">
												<div class="col-md-12 mb-3">
													<div class="text-muted well well-sm no-shadow"><span class="pl-3">Bukti pembayaran sudah di upload oleh si pembeli, jika nominal total pembayaran nya sesuai silakan tekan tombol konfirmasi pembayaran. Jika nominal pembayaran tidak sesuai tekan tombol batalkan order.</span></div>
												</div>
												<div class="col-md-4">
													<img src="<?= base_url('uploads/struk/' . $data->bukti_pembayaran); ?>" class="img-fluid img-thumbnail">
												</div>
												<div class="col-md-7">
													<div class="box box-info text-center">
														<div class="box-header with-border">
															<h3 class="box-title">TOTAL BAYAR Rp. <?= number_format($data->grand_total, 0, ",", "."); ?></h3>
														</div>
														<div class="box-body">
															<a href="<?= base_url('transaksi/konfirmasiPembayaran/' . $data->id_order); ?>" class="btn btn-primary btn-flat"><i class="fa fa-save"></i> Konfirmasi Pembayaran</a>
															<a href="" class="btn btn-danger btn-flat"><i class="fa fa-trash"></i> Batalkan Order</a>
															<button type="button" class="btn btn-warning btn-flat" data-dismiss="modal"><i class="fa fa-close"></i> Keluar</button>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- /modal konfirmasi pembayaran -->

							<div class="modal fade" id="detailOrder<?= $data->id_order ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<!-- modal detail order -->
								<div class="modal-dialog modal-lg">

									<!-- Modal content-->
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4 class="modal-title">Detail Order dari ID Order <?= $data->id_order; ?></h4>
										</div>
										<div class="modal-body">
											<p>
											<div class="row">
												<?php
												foreach ($detailProduk->result() as $produk) :
													$kategori = $this->db->query("select * from tb_kategori where id_kategori='$produk->id_kategori'")->row();
													$foto = $this->db->query("select * from tb_image_produk where id_produk='$produk->id_produk'")->row();
												?>
													<div class="col-md-6">
														<!-- Widget: user widget style 1 -->
														<div class="box box-widget widget-user-2">
															<!-- Add the bg color to the header using any of the bg-* classes -->
															<div class="widget-user-header bg-yellow">
																<div class="widget-user-image">
																	<img class="img-circle" src="<?= base_url('uploads/produk/' . $foto->image); ?>">
																</div>
																<!-- /.widget-user-image -->
																<h3 class="widget-user-username"><?= ucfirst($produk->judul); ?></h3>
																<h5 class="widget-user-desc"><?= ucfirst($kategori->nama_kategori); ?></h5>
															</div>
															<div class="box-footer no-padding">
																<ul class="nav nav-stacked">
																	<li><a href="#">Tanggal Order <span class="pull-right badge bg-green"><?= $data->tanggal; ?></span></a></li>
																	<li><a href="#">Harga Satuan <span class="pull-right badge bg-aqua"><?= number_format($produk->harga, 0, ",", "."); ?></span></a></li>
																	<li><a href="#">Jumlah Beli <span class="pull-right badge bg-blue"><?= $produk->qty; ?> <?= $produk->satuan; ?></span></a></li>
																	<li><a href="#">Total Bayar <span class="pull-right badge bg-green"><?= number_format($produk->total_harga, 0, ",", "."); ?></span></a></li>
																</ul>
															</div>
														</div>
														<!-- /.widget-user -->
													</div>
												<?php endforeach ?>
											</div>
											</p>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										</div>
									</div>

								</div>
							</div>

						<?php endforeach ?>

					</tbody>
				</table>

			</div>
		</div>

	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->