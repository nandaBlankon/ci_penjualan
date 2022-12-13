<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?= $title ?>
			<small>Tambah Kategori</small>
		</h1>
	</section>

	<!-- Main content -->
	<section class="content">
		<?php $this->view('messages') ?>
		<div class="box">
			<div class="box-header text-center">
				<h3 class="box-title"><a href="<?= site_url('kategori') ?>" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-refresh"></i> Kembali</a></h3>
			</div>
			<div class="box-body">
				<form action="<?= site_url('kategori/proses') ?>" method="post">
					<div class="form-group">
						<label for="id_kategori">ID Kategori*</label>
						<input type="text" name="id_kategori" id="id_kategori" class="form-control form-control-sm" value="<?= $page == 'tambah' ? $idkategori : $row->id_kategori ?>" readonly>
					</div>
					<div class="form-group <?= form_error('id_brand') ? 'has-error' : null ?>">
						<label for="id_brand">Nama Brand*</label>
						<?php echo form_dropdown('id_brand', $brand, $selectedbrand, ['class' => 'form-control form-control-sm', 'id' => 'id_brand']); ?>
					</div>
					<div class="form-group <?= form_error('nama_kategori') ? 'has-error' : null ?>">
						<label for="nama_kategori">Nama Kategori*</label>
						<input type="text" name="nama_kategori" id="nama_kategori" class="form-control form-control-sm" value="<?= $page == 'tambah' ? set_value('nama_kategori') : $row->nama_kategori ?>" autofocus style="text-transform: uppercase;">
						<?= form_error('nama_kategori') ?>
					</div>
					<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
						<button type="reset" class="btn btn-outline-primary">Reset</button>
						<button type="submit" name="<?= $page ?>" class="btn btn-primary">Simpan</button>
					</div>
				</form>
			</div>
		</div>

	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->