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
                            <li class="breadcrumb-item"><a class="text-dark" href="<?= base_url('welcome/brands/' . $kategori->id_brand); ?>"><?= $kategori->nama_brand; ?></a></li>
                            <li class="breadcrumb-item active" aria-current="page"><?= $kategori->nama_kategori; ?></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container p-0">
            <div class="row">
                <!-- SHOP SIDEBAR-->
                <div class="col-lg-3 order-2 order-lg-1">
                    <!-- <h5 class="text-uppercase mb-4">Kategori Produk</h5> -->
                    <div class="py-2 px-4 bg-dark text-white mb-3"><strong class="small text-uppercase fw-bold">Kategori Lainnya</strong></div>
                    <ul class="list-unstyled small text-muted ps-lg-4 font-weight-normal bg-light">
                        <?php
                        $no = 1;
                        $cat = $this->db->query("select * from tb_kategori where id_brand='$kategori->id_brand' and id_kategori!='$kategori->id_kategori'");
                        foreach ($cat->result() as $kat) :
                        ?>
                            <li class="mb-2"><a class="reset-anchor" href="<?= base_url('welcome/cats/' . $kat->id_kategori); ?>"> <?= $no++; ?>. <?= ucfirst($kat->nama_kategori); ?></a></li>
                        <?php endforeach ?>
                    </ul>
                </div>
                <!-- SHOP LISTING-->
                <div class="col-lg-9 order-1 order-lg-2 mb-5 mb-lg-0">
                    <div class="col-lg-12 mb-2 mb-lg-0">
                        <div class="text-uppercase mb-3 py-2 px-4 bg-dark text-white"><strong class="small text-uppercase fw-bold">daftar Produk di kategori <?= ucfirst($kategori->nama_kategori); ?> Brand <?= ucfirst($kategori->nama_brand); ?></strong></div>
                    </div>
                    <div class="row">
                        <!-- PRODUCT-->
                        <?php
                        $pro = $this->db->query("select * from tb_produk where id_kategori='$kategori->id_kategori'");
                        foreach ($pro->result() as $produk) :
                        ?>
                            <div class="col-lg-4 col-sm-6">
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
                                                <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-dark" href="<?= base_url('pages/produk/' . $produk->id_produk); ?>"><?= ucfirst($kategori->nama_kategori); ?></a></li>
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
                    </div>
                    <!-- PAGINATION-->
                    <!-- <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center justify-content-lg-end">
                            <li class="page-item mx-1"><a class="page-link" href="#!" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
                            <li class="page-item mx-1 active"><a class="page-link" href="#!">1</a></li>
                            <li class="page-item mx-1"><a class="page-link" href="#!">2</a></li>
                            <li class="page-item mx-1"><a class="page-link" href="#!">3</a></li>
                            <li class="page-item ms-1"><a class="page-link" href="#!" aria-label="Next"><span aria-hidden="true">»</span></a></li>
                        </ul>
                    </nav> -->
                </div>
            </div>
        </div>
    </section>

</div>