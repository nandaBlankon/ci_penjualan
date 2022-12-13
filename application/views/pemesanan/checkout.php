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
                            <li class="breadcrumb-item"><a class="text-dark" href="<?= base_url('view-cart'); ?>">keranjang</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <section class="py-5">
        <!-- BILLING ADDRESS-->
        <h2 class="h5 text-uppercase mb-4">RINCIAN PENAGIHAN</h2>
        <form action="<?= site_url('welcome/prosescheckout') ?>" method="POST">
            <div class="row">
                <div class="col-lg-6">
                    <div class="row gy-3">
                        <div class="col-lg-6">
                            <label class="form-label text-sm text-uppercase" for="firstName">user id </label>
                            <input class="form-control form-control-lg" type="text" name="id_pembeli" value="<?= $this->fungsi->user_login()->user_id; ?>" readonly>
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label text-sm text-uppercase" for="firstName">Nama lengkap </label>
                            <input class="form-control form-control-lg" type="text" value="<?= $this->fungsi->user_login()->nama; ?>" readonly>
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label text-sm text-uppercase" for="firstName">Email </label>
                            <input class="form-control form-control-lg" type="email" value="<?= $this->fungsi->user_login()->username; ?>" readonly>
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label text-sm text-uppercase" for="phone">Nomor Telp/wa </label>
                            <input class="form-control form-control-lg" type="number" name="telp" placeholder="e.g. +02 245354745">
                        </div>
                        <div class="col-lg-12">
                            <label class="form-label text-sm text-uppercase" for="address">Alamat lengkap </label>
                            <input class="form-control form-control-lg text-uppercase" type="text" name="alamat" placeholder="Nomor rumah, nama jalan, dan nama desa">
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label text-sm text-uppercase" for="city">Kecamatan </label>
                            <input class="form-control form-control-lg text-uppercase" type="text" name="kec">
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label text-sm text-uppercase" for="state">Kabupaten/kota </label>
                            <input class="form-control form-control-lg text-uppercase" type="text" name="kab">
                        </div>

                        <div class="col-lg-12 form-group">
                            <button class="btn btn-dark text-uppercase" type="submit">proses pemesanan</button>
                        </div>
                    </div>
                </div>
                <!-- ORDER SUMMARY-->
                <div class="col-lg-6">
                    <div class="card border-0 rounded-0 p-lg-4 bg-light">
                        <div class="card-body">
                            <h5 class="text-uppercase mb-4">pesanan anda</h5>
                            <ul class="list-unstyled mb-0">
                                <?php
                                $cart = $this->cart->contents();
                                $grand_total = 0;
                                foreach ($cart as $item) :
                                    $grand_total = $grand_total + $item['subtotal'];

                                    $ci = get_instance(); // Memanggil object utama 
                                    $ci->load->model(['model_produk', 'model_user']); // Memanggil model yang terdapat pada model

                                    $produk = $ci->model_produk->get($item['id'])->result_array(); // Menampilkan data produk berdasarkan id 
                                    $idproduk  = $produk[0]['id_produk'];
                                ?>
                                    <li class="d-flex align-items-center justify-content-between">
                                        <img class=" img-fluid img-thumbnail" src="<?= base_url('uploads/produk/' . $item['image']) ?>" width="50px" />
                                        <?= $item['qty']; ?> qty |
                                        <strong class="small fw-bold"><?= ucwords(str_replace('-', ' ', $item['name'])); ?></strong>
                                        <span class="text-muted small"><?= number_format($item['subtotal'], 0, ",", ".") ?></span>
                                    </li>
                                    <li class="border-bottom my-2"></li>
                                <?php endforeach ?>
                                <li class="d-flex align-items-center justify-content-between"><strong class="text-uppercase small fw-bold">Total</strong><span><?= number_format($this->cart->total(), 0, ",", "."); ?></span></li>
                                <input type="hidden" name="grand_total" value="<?= $grand_total ?>">
                                <input type="hidden" name="id_produk" value="<?= $idproduk ?>">
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
</div>