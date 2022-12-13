<!-- HERO SECTION-->
<div class="container">
    <section class="hero pb-3 bg-cover bg-center d-flex align-items-center" style="background: url(<?= base_url('assets/frontend') ?>/bg_msglow.png)">
        <div class="container py-5">
            <div class="row px-4 px-lg-5">
                <div class="col-lg-6">
                    <!-- <p class="text-muted small text-uppercase mb-2">New Inspiration 2020</p> -->
                    <!-- <h1 class="h2 text-uppercase mb-3">20% off on new season</h1><a class="btn btn-dark" href="shop.html">Browse collections</a> -->
                </div>
            </div>
        </div>
    </section>
    <!-- CATEGORIES SECTION-->
    <section class="pt-5 text-center">
        <header class="text-center">
            <p class="small text-muted small text-uppercase mb-1">Koleksi dari brand kami</p>
            <h2 class="h5 text-uppercase mb-4">Jelajahi kategori kami</h2>
        </header>
        <div class="row text-center gy-3">
            <?php foreach ($brands->result() as $brand) : ?>
                <div class="col-md-3">
                    <div class="card">
                        <div class=" card-header">Brand</div>
                        <div class="card-body">
                            <a href="<?= base_url('welcome/brands/' . $brand->id_brand); ?>" class="btn btn-dark">
                                <h6 class="text-uppercase mb-1"><strong class=""><?= $brand->nama_brand; ?></strong></h6>
                            </a>
                        </div>
                    </div>

                </div>
            <?php endforeach ?>
        </div>

    </section>
    <!-- TRENDING PRODUCTS-->
    <section class="py-5">
        <header>
            <h2 class="h5 text-uppercase mb-4">Daftar Produk</h2>
        </header>
        <div class="row">
            <!-- PRODUCT-->
            <?php foreach ($produk->result() as $produk) : ?>
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="product text-center">
                        <div class="position-relative mb-3">
                            <div class="badge text-white bg-"></div>
                            <a class="d-block" href="<?= base_url('pages/produk/' . $produk->id_produk); ?>">
                                <?php
                                $image = $this->db->query("select * from tb_image_produk where id_produk='$produk->id_produk' order by id_image LIMIT 1")->row();
                                if ($image->image) {
                                ?>
                                    <img class="img-fluid w-100 img-thumbnail" style="height: 280px;" src="<?= base_url('uploads/produk/' . $image->image); ?>">
                                <?php } else { ?>
                                    <img class="img-fluid w-100" src="<?= base_url('assets/frontend') ?>/img/product-1.jpg">
                                <?php } ?>
                            </a>
                            <div class="product-overlay">
                                <ul class="mb-0 list-inline">
                                    <!-- <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-outline-dark" href="#!"><i class="far fa-heart"></i></a></li> -->
                                    <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-dark" href="<?= base_url('pages/produk/' . $produk->id_produk); ?>"><?= ucfirst($produk->nama_kategori); ?></a></li>
                                    <li class="list-inline-item me-0"><a class="btn btn-sm btn-outline-dark" href="#productView<?= $produk->id_produk; ?>" data-bs-toggle="modal"><i class="fas fa-expand"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <h6> <a class="reset-anchor" href="<?= base_url('pages/produk/' . $produk->id_produk); ?>" title="Lihat Detail Produk"><?= ucfirst($produk->judul); ?></a></h6>
                        <p class="small text-muted"><?= $this->fungsi->nominal($produk->harga) ?></p>
                    </div>
                </div>

                <!--  Modal Produk View -->
                <div class="modal fade" id="productView<?= $produk->id_produk; ?>" tabindex="-1">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content overflow-hidden border-0">
                            <button class="btn-close p-4 position-absolute top-0 end-0 z-index-20 shadow-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                            <div class="modal-body p-0">
                                <div class="row align-items-stretch">
                                    <div class="col-lg-6 p-lg-0">
                                        <a class="glightbox product-view d-block h-100 bg-cover bg-center" style="background: url(<?= base_url('uploads/produk/' . $image->image); ?>" href="<?= base_url('uploads/produk/' . $image->image); ?>" data-gallery="gallery1<?= $produk->id_produk ?>" data-glightbox="<?= $produk->judul ?>"></a>
                                        <?php
                                        $image = $this->db->query("select * from tb_image_produk where id_produk='$produk->id_produk' order by id_image");
                                        foreach ($image->result() as $img) :
                                        ?>
                                            <a class="glightbox d-none" href="<?= base_url('uploads/produk/' . $img->image); ?>" data-gallery="gallery1<?= $img->id_produk ?>" data-glightbox="<?= $produk->judul ?>"></a>
                                        <?php endforeach ?>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="p-4 my-md-4">
                                            <!--  -->
                                            <h2 class="h4"><?= ucfirst($produk->judul); ?></h2>
                                            <p class="text-muted"><?= $this->fungsi->nominal($produk->harga) ?></p>
                                            <p class="text-sm mb-4"><?= ucfirst($produk->deskripsi); ?></p>
                                            <div class="row align-items-stretch mb-4 gx-0">
                                                <div class="col-sm-7">
                                                    <div class="border d-flex align-items-center justify-content-between py-1 px-3"><span class="small text-uppercase text-gray mr-4 no-select">Qyt</span>
                                                        <div class="quantity">
                                                            <button class="dec-btn p-0"><i class="fas fa-caret-left"></i></button>
                                                            <input class="form-control border-0 shadow-0 p-0" type="number" value="1" min="0" max="<?= $produk->stok; ?>">
                                                            <button class="inc-btn p-0"><i class="fas fa-caret-right"></i></button>
                                                            <small><?= $produk->stok; ?> tersisa</small>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-5"><a class="btn btn-dark btn-sm w-100 h-100 d-flex align-items-center justify-content-center px-0" href="<?= base_url('pages/produk/' . $produk->id_produk); ?>">Details</a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--  /Modal Produk View -->

            <?php endforeach ?>
            <!-- /PRODUCT-->

        </div>
    </section>
    <!-- SERVICES-->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row text-center gy-3">
                <div class="col-lg-4">
                    <div class="d-inline-block">
                        <div class="d-flex align-items-end">
                            <svg class="svg-icon svg-icon-big svg-icon-light">
                                <use xlink:href="#delivery-time-1"> </use>
                            </svg>
                            <div class="text-start ms-3">
                                <h6 class="text-uppercase mb-1">Free shipping</h6>
                                <p class="text-sm mb-0 text-muted">Free shipping worldwide</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="d-inline-block">
                        <div class="d-flex align-items-end">
                            <svg class="svg-icon svg-icon-big svg-icon-light">
                                <use xlink:href="#helpline-24h-1"> </use>
                            </svg>
                            <div class="text-start ms-3">
                                <h6 class="text-uppercase mb-1">24 x 7 service</h6>
                                <p class="text-sm mb-0 text-muted">Free shipping worldwide</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="d-inline-block">
                        <div class="d-flex align-items-end">
                            <svg class="svg-icon svg-icon-big svg-icon-light">
                                <use xlink:href="#label-tag-1"> </use>
                            </svg>
                            <div class="text-start ms-3">
                                <h6 class="text-uppercase mb-1">Festivaloffers</h6>
                                <p class="text-sm mb-0 text-muted">Free shipping worldwide</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- NEWSLETTER-->
    <section class="py-5">
        <div class="container p-0">
            <div class="row gy-3">
                <div class="col-lg-6">
                    <h5 class="text-uppercase">Let's be friends!</h5>
                    <p class="text-sm text-muted mb-0">Nisi nisi tempor consequat laboris nisi.</p>
                </div>
                <div class="col-lg-6">
                    <form action="#">
                        <div class="input-group">
                            <input class="form-control form-control-lg" type="email" placeholder="Enter your email address" aria-describedby="button-addon2">
                            <button class="btn btn-dark" id="button-addon2" type="submit">Subscribe</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>