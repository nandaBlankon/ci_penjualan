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
                    <div class="card-header">
                        <a class="btn btn-primary btn-large disabled" href="#!">Masuk »</a>
                        <a class="btn btn-outline-primary btn-large float-end" href="<?= base_url('daftar'); ?>">Daftar »</a>
                    </div>
                    <div class="card-body">
                        <p class="text-center"><?php $this->view('messages') ?></p>
                        <form method="post" action="<?= site_url('login-proses') ?>">
                            <div class="mb-3">
                                <label class="form-label" for="exampleInputEmail1">Email address</label>
                                <?= form_error('username') ?>
                                <input class="form-control" type="text" name="username" placeholder="Email" value="<?= set_value('email') ?>">
                                <div class="form-text" id="emailHelp">Contoh: email@store.com.</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="exampleInputPassword1">Password</label>
                                <?= form_error('password') ?>
                                <input class="form-control" type="password" minlength="8" name="password" placeholder="Password" value="<?= set_value('password') ?>">
                                <div class="form-text">Minimal password 8 karakter</div>
                            </div>
                            <div class="d-grid gap-2">
                                <button class="btn btn-primary" type="submit">Masuk Sekarang</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>

</div>