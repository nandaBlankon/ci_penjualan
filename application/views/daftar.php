<div class="container">
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
                <div class="col-lg-6">
                    <h1 class="h2 text-uppercase mb-0"><?= $title; ?></h1>
                </div>
                <div class="col-lg-6 text-lg-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-lg-end mb-0 px-0 bg-light">
                            <li class="breadcrumb-item"><a class="text-dark" href="<?= base_url(''); ?>">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <section class="py-3">
        <div class="row">
            <div class="col-lg-6">
                <img src="<?= base_url('assets/frontend/logoaplikasi.png'); ?>" class="img-fluid">
            </div>
            <div class="col-lg-6">
                <div class="card mb-4" id="headings">
                    <div class="card-header text-center">
                        <h4>Daftar Sekarang</h4>
                    </div>
                    <div class="card-body">
                        <h6 class="text-center">Sudah punya akun? <a href="<?= base_url('login'); ?>">Masuk</a></h6>
                        <form action="<?= site_url('daftar') ?>" method="POST">
                            <input class="input" type="hidden" name="kodeunik" value="<?= $kodeunik ?>">
                            <div class="mb-3">
                                <label class="form-label" for="nama">Nama Lengkap</label>
                                <?= form_error('nama') ?>
                                <input class="form-control" type="text" name="nama" value="<?= set_value('nama') ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="nama">Alamat Email</label>
                                <?= form_error('email') ?>
                                <input class="form-control" type="email" name="email" value="<?= set_value('email') ?>">
                                <div class="form-text" id="">Contoh: email@store.com.</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="exampleInputPassword1">Password</label>
                                <?= form_error('password') ?>
                                <input class="form-control" type="password" minlength="8" name="password" value="<?= set_value('password') ?>">
                                <div class="form-text">Minimal password 8 karakter</div>
                            </div>
                            <div class="d-grid gap-2">
                                <button class="btn btn-primary" type="submit">Daftar</button>
                            </div>
                        </form>
                        <div class="text-center py-3 form-text">
                            Dengan mendaftar, saya menyetujui <br>
                            <a href="#"> Syarat dan Ketentuan</a> serta <a href="#"> Kebijakan Privasi</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>