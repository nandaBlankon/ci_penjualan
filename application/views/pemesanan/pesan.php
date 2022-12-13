<div class="container">
    <!-- HERO SECTION-->
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
                            <li class="breadcrumb-item">keranjang</li>
                            <li class="breadcrumb-item">Checkout</li>
                            <li class="breadcrumb-item active" aria-current="page">Pesan</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <h2 class="h5 text-uppercase mb-4">Proses Pemesanan berhasil</h2>
        <div class="row">

            <div class="col-lg-12">
                <div class="card border-0 rounded-0 p-lg-4 bg-light">
                    <div class="card-body">
                        <h5 class="text-uppercase mb-4 text-center"><?php $this->view('messages') ?></h5>
                        <ul>
                            <li>- Selanjutnya silakan upload struk pembayaran anda sebagai bukti bahwa anda sudah melakukan pembayaran.</li>
                            <li>- Kunjungi dashboard anda, pilih menu <a href="<?= site_url('transaksi') ?>" title="Upload Struk">Transaksi</a> untuk meng-upload struk pembayarannya.</li>
                        </ul>
                        <p></p>
                        <p>Terima Kasih Sudah Berbelanja di website kami.</p>
                    </div>
                </div>
            </div>

        </div>
    </section>

</div>