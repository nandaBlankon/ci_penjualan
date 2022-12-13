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
			<div class="row">

				<div class="col-md-12">
					<?php $this->view('messages') ?>
				</div>
				<div class="col-md-4">
					<!-- Profile Image -->
					<div class="box box-primary">
						<div class="box-body box-profile">
							<?php if ($this->fungsi->user_login()->image == null) { ?>
								<img class="profile-user-img img-responsive img-circle" src="<?= base_url('uploads/user.png') ?>">
							<?php } else { ?>
								<img src="<?= base_url('uploads/profil/' . $this->fungsi->user_login()->image) ?>" class="profile-user-img img-responsive img-circle">
							<?php } ?>

							<h3 class="profile-username text-center"><?= $this->fungsi->user_login()->nama ?></h3>

							<p class="text-muted text-center"><?= $this->fungsi->user_login()->username ?></p>
							<form action="<?= base_url('dashboard/profilpicupdate'); ?>" method="POST" enctype="multipart/form-data">
								<input type="hidden" name="user_id" value="<?= $this->fungsi->user_login()->user_id ?>">
								<div class="form-group">
									<input type="file" name="image" class="form-control" required>
								</div>
								<button type="submit" class="btn btn-primary btn-block"><b>Ganti Foto Profil</b></button>
							</form>

						</div>
						<!-- /.box-body -->
					</div>
					<!-- /.box -->
				</div>

				<div class="col-md-8">
					<div class="box box-primary">
						<div class="box-header">
							<h3 class="box-title">Informasi Akun</h3>
							<hr>
						</div>
						<div class="box-body">

							<form action="<?= site_url('dashboard/profilakun') ?>" method="post">
								<div class="form-group">
									<label for="user_id">ID User*</label>
									<input type="text" name="user_id" class="form-control form-control-sm" value="<?= $this->fungsi->user_login()->user_id ?>" readonly>
								</div>
								<div class="form-group <?= form_error('nama') ? 'has-error' : null ?>">
									<label for="nama">Nama lengkap*</label>
									<input type="text" name="nama" id="nama" class="form-control form-control-sm" value="<?= $this->fungsi->user_login()->nama ?>">
									<?= form_error('nama') ?>
								</div>
								<div class="form-group <?= form_error('username') ? 'has-error' : null ?>">
									<label for="username">Username*</label>
									<input type="text" name="username" class="form-control form-control-sm" value="<?= $this->fungsi->user_login()->username ?>">
									<?= form_error('username') ?>
								</div>
								<div class="form-group <?= form_error('password') ? 'has-error' : null ?>">
									<label for="password">Password*</label>
									<small>(Kosongkan jika tidak ingin dirubah.)</small>
									<input type="password" name="password" class="form-control form-control-sm" value="<?= $this->input->post('password') ?>">
									<?= form_error('password') ?>
								</div>
								<div class="form-group <?= form_error('passconf') ? 'has-error' : null ?>">
									<label for="passconf">Ulangi Password*</label>
									<small>(Kosongkan jika Password diatas tidak dirubah.)</small>
									<input type="password" name="passconf" class="form-control" value="<?= $this->input->post('passconf') ?>">
									<?= form_error('passconf') ?>
								</div>

								<a href="<?= site_url('dashboard') ?>" class="btn btn-danger">Cancel</a>
								<button type="submit" class="btn btn-primary pull-right">Update</button>

							</form>
						</div>
					</div>
				</div>

			</div>
		</section>

	</div>
	<!-- /.content-wrapper -->