<?php
$brand = $this->db->query("select * from tb_kategori,tb_brand where id_kategori='$row->id_kategori' order by id_kategori")->row();
?>
<section class="py-5">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-6">
                <!-- PRODUCT SLIDER-->
                <div class="row m-sm-0">
                    <div class="col-sm-2 p-sm-0 order-2 order-sm-1 mt-2 mt-sm-0 px-xl-2">
                        <div class="swiper product-slider-thumbs">
                            <div class="swiper-wrapper">
                                <?php
                                $image = $this->db->query("select * from tb_image_produk where id_produk='$row->id_produk' order by id_image");
                                if ($image->row()) {
                                    foreach ($image->result() as $img) :
                                ?>
                                        <div class="swiper-slide h-auto swiper-thumb-item mb-3"><img class="w-100" src="<?= base_url('uploads/produk/' . $img->image); ?>"></div>
                                    <?php endforeach ?>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-10 order-1 order-sm-2">
                        <div class="swiper product-slider">
                            <div class="swiper-wrapper">
                                <?php
                                $image = $this->db->query("select * from tb_image_produk where id_produk='$row->id_produk' order by id_image");
                                if ($image->row()) {
                                    foreach ($image->result() as $img) :
                                ?>
                                        <div class="swiper-slide"><a class="glightbox product-view" href="<?= base_url('uploads/produk/' . $img->image); ?>" data-gallery="gallery2" data-glightbox="Product item 1"><img class="img-fluid img-responsive img-thumbnail" src="<?= base_url('uploads/produk/' . $img->image); ?>" style="width: 100%; height:300px"></a></div>
                                    <?php endforeach ?>
                                <?php } else { ?>
                                    <div class="swiper-slide h-auto"><a class="glightbox product-view" href="img/product-detail-2.jpg" data-gallery="gallery2" data-glightbox="Product item 2"><img class="img-fluid" src="img/product-detail-2.jpg" alt="..."></a></div>
                                <?php } ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- PRODUCT DETAILS-->
            <div class="col-lg-6">

                <form action="<?= site_url('welcome/tambah') ?>" method="POST">
                    <input type="hidden" name="id" value="<?= $row->id_produk ?>">
                    <h1><?= ucfirst($row->judul); ?></h1>
                    <p class="text-muted lead"><?= $this->fungsi->nominal($row->harga) ?></p>
                    <p class="text-sm mb-4"><?= ucfirst($row->deskripsi); ?></p>
                    <div class="row align-items-stretch mb-4">
                        <div class="col-sm-5 pr-sm-0">
                            <div class="border d-flex align-items-center justify-content-between py-1 px-3 bg-white border-white"><span class="small text-uppercase text-gray mr-4 no-select">Qyt</span>
                                <div class="quantity">
                                    <input class="form-control border-0 shadow-0 p-0" name="qty" type="number" value="1" min="0" max="<?= $row->stok; ?>">
                                    <small><?= $row->stok; ?> tersisa</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-5 pl-sm-0">
                            <?php if ($this->session->userdata('user_id')) { ?>
                                <button type="submit" class="btn btn-dark btn-sm btn-block h-100 d-flex align-items-center justify-content-center">Tambah Ke Keranjang</button>
                            <?php } else { ?>
                                <a class="btn btn-dark btn-sm btn-block h-100 d-flex align-items-center justify-content-center px-0" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Tambah Ke Keranjang</a>
                            <?php } ?>
                        </div>
                    </div>
                    <ul class="list-unstyled small d-inline-block">
                        <li class="px-3 py-2 mb-1 bg-white"><strong class="text-uppercase">Brand:</strong><span class="ms-2 text-muted"><?= ucfirst($brand->nama_brand); ?></span></li>
                        <li class="px-3 py-2 mb-1 bg-white"><strong class="text-uppercase">Kategori:</strong><span class="ms-2 text-muted"><?= ucfirst($row->nama_kategori); ?></span></li>
                        <li class="px-3 py-2 mb-1 bg-white"><strong class="text-uppercase">Produk:</strong><span class="ms-2 text-muted"><?= $row->produk_status; ?></span></li>
                    </ul>
                </form>
            </div>
        </div>
        <!-- DETAILS TABS-->
        <ul class="nav nav-tabs border-0" id="myTab" role="tablist">
            <li class="nav-item"><a class="nav-link text-uppercase active" id="description-tab" data-bs-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="true">Manfaat</a></li>
            <li class="nav-item"><a class="nav-link text-uppercase" id="reviews-tab" data-bs-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">Cara Penggunaan</a></li>
            <li class="nav-item"><a class="nav-link text-uppercase" id="reviews-tab" data-bs-toggle="tab" href="#keterangan" role="tab" aria-controls="keterangan" aria-selected="false">Keterangan</a></li>
        </ul>
        <div class="tab-content mb-5" id="myTabContent">
            <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                <div class="p-4 p-lg-5 bg-white">
                    <h6 class="text-uppercase">Manfaat Produk </h6>
                    <p class="text-muted text-sm mb-0"><?= ucfirst($row->manfaat); ?></p>
                </div>
            </div>
            <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                <div class="p-4 p-lg-5 bg-white">
                    <h6 class="text-uppercase">Cara Penggunaan Produk </h6>
                    <p class="text-muted text-sm mb-0"><?= ucfirst($row->cara_penggunaan); ?></p>
                </div>
            </div>
            <div class="tab-pane fade" id="keterangan" role="tabpanel" aria-labelledby="keterangan-tab">
                <div class="p-4 p-lg-5 bg-white">
                    <h6 class="text-uppercase">Keterangan Lainnya </h6>
                    <p class="text-muted text-sm mb-0"><?= ucfirst($row->keterangan); ?></p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Pemberitahuan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Hai, terima kasih sudah mengunjungi situs kami.
                Namun untuk melakukan Transaksi, anda harus login terlebih dahulu!!
                <p>
                <div class="btn-group" role="group">
                    <a href="<?= site_url('login') ?>" class="btn btn-primary">Masuk</a>
                    <a href="<?= site_url('daftar') ?>" class="btn btn-danger">Daftar</a>
                </div>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Keluar</button>
            </div>
        </div>
    </div>
</div>