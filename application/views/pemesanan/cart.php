<div class="container">
    <!-- HERO SECTION-->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
                <div class="col-lg-6">
                    <h1 class="h2 text-uppercase mb-0">Keranjang</h1>
                </div>
                <div class="col-lg-6 text-lg-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-lg-end mb-0 px-0 bg-light">
                            <li class="breadcrumb-item"><a class="text-dark" href="<?= base_url(''); ?>">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Keranjang</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <section class="py-5">
        <h2 class="h5 text-uppercase mb-4">keranjang belanja</h2>
        <div class="row">
            <?php
            $cart = $this->cart->contents();
            if (empty($cart)) {
            ?>
                <div class="col-lg-12">
                    <div class="card border-0 rounded-0 p-lg-4 bg-light">
                        <div class="card-body">
                            <h5 class="text-uppercase mb-4 text-center">keranjang belanja anda masih kosong</h5>
                            <h5 class="text-uppercase mb-4 text-center">anda belum menambahkan produk apapun ke keranjang anda.</h5>
                            <a href="<?= base_url(''); ?>" class="btn btn-dark btn-sm w-100"> <i class="fas fa-gift me-2"></i>Belanja Sekarang</a>
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <div class="col-lg-12 mb-4 mb-lg-0">
                    <!-- CART TABLE-->
                    <div class="table-responsive mb-4">
                        <table class="table text-nowrap">
                            <thead class="bg-light">
                                <tr>
                                    <th class="border-0 p-3" scope="col"> <strong class="text-sm text-uppercase">Produk</strong></th>
                                    <th class="border-0 p-3" scope="col"> <strong class="text-sm text-uppercase">harga</strong></th>
                                    <th class="border-0 p-3" scope="col"> <strong class="text-sm text-uppercase">Quantity</strong></th>
                                    <th class="border-0 p-3" scope="col"> <strong class="text-sm text-uppercase">sub-total</strong></th>
                                    <th class="border-0 p-3" scope="col"> <strong class="text-sm text-uppercase">aksi</strong></th>
                                </tr>
                            </thead>
                            <tbody class="border-0">
                                <?php
                                $no = 1;
                                $grand_total = 0;
                                foreach ($cart as $item) :
                                    $grand_total += $item['subtotal'];
                                ?>
                                    <tr>
                                        <th class="ps-0 py-3 border-light" scope="row">
                                            <div class="d-flex align-items-center"><a class="reset-anchor d-block animsition-link" href=""><img src="<?= base_url('uploads/produk/' . $item['image']) ?>" width="70" /></a>
                                                <div class="ms-3"><strong class="h6"><a class="reset-anchor animsition-link" href=""><?= ucwords(str_replace('-', ' ', $item['name'])); ?></a></strong></div>
                                            </div>
                                        </th>
                                        <td class="p-3 align-middle border-light">
                                            <p class="mb-0 small"><?= number_format($item['price'], 0, ",", ".") ?></p>
                                        </td>
                                        <td class="p-3 align-middle border-light">
                                            <form action="<?= site_url('welcome/update') ?>" method="POST">
                                                <input type="hidden" name="rowid" value="<?= $item['rowid']; ?>">
                                                <div class="border d-flex align-items-center justify-content-between px-3"><span class="small text-uppercase text-gray headings-font-family">Qyt</span>
                                                    <div class="quantity">
                                                        <button class="dec-btn p-0"><i class="fas fa-caret-left"></i></button>
                                                        <input class="form-control form-control-sm border-0 shadow-0 p-0" name="qty" type="text" value="<?= $item['qty']; ?>" />
                                                        <button class="inc-btn p-0"><i class="fas fa-caret-right"></i></button>
                                                    </div>
                                                </div>
                                            </form>
                                        </td>
                                        <td class="p-3 align-middle border-light">
                                            <p class="mb-0 small"><?= number_format($item['subtotal'], 0, ",", ".") ?></p>
                                        </td>
                                        <td class="p-3 align-middle border-light"><a class="reset-anchor" href="<?= site_url('welcome/hapus/' . $item['rowid']) ?>"><i class="fas fa-trash-alt small text-muted"></i></a></td>
                                    </tr>
                                <?php endforeach ?>
                                <thead class="bg-light">
                                    <tr>
                                        <th colspan="3" class="border-0 p-3" scope="col"> <strong class="text-sm text-uppercase text-center">total</strong></th>
                                        <th class="border-0 p-3" scope="col"> <strong class="text-sm text-uppercase"><b><?= number_format($this->cart->total(), 0, ",", "."); ?></b></strong></th>
                                        <th class="border-0 p-3" scope="col"> <strong class="text-sm text-uppercase"></strong></th>
                                    </tr>
                                </thead>

                            </tbody>
                        </table>
                    </div>
                    <!-- CART NAV-->
                    <div class="bg-light px-4 py-3">
                        <div class="row align-items-center text-center">
                            <div class="col-md-6 mb-3 mb-md-0 text-md-start"><a class="btn btn-link p-0 text-dark btn-sm" href="<?= site_url('') ?>"><i class="fas fa-long-arrow-alt-left me-2"> </i>Lanjutkan Belanja</a></div>
                            <div class="col-md-6 text-md-end"><a class="btn btn-outline-dark btn-sm" href="<?= site_url('checkout') ?>">Procceed to checkout<i class="fas fa-long-arrow-alt-right ms-2"></i></a></div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>
</div>