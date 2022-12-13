<div class="container">
    <!-- HERO SECTION-->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
                <div class="col-lg-6">
                    <h1 class="h2 text-uppercase mb-0"><?= $brand->nama_brand; ?></h1>
                </div>
                <div class="col-lg-6 text-lg-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-lg-end mb-0 px-0 bg-light">
                            <li class="breadcrumb-item"><a class="text-dark" href="<?= base_url(''); ?>">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Brand</li>
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
                    <div class="py-2 px-4 bg-dark text-white mb-3"><strong class="small text-uppercase fw-bold">Brand Lainnya</strong></div>
                    <ul class="list-unstyled small text-muted ps-lg-4 font-weight-normal bg-light">
                        <?php
                        $no = 1;
                        $br = $this->db->query("select * from tb_brand where id_brand !='$brand->id_brand'");
                        foreach ($br->result() as $key) :
                        ?>
                            <li class="mb-2"><a class="reset-anchor" href="<?= base_url('welcome/brands/' . $key->id_brand); ?>"> <?= $no++; ?>. <?= ucfirst($key->nama_brand); ?></a></li>
                        <?php endforeach ?>
                    </ul>
                </div>
                <!-- SHOP LISTING-->
                <div class="col-lg-9 order-1 order-lg-2 mb-5 mb-lg-0">
                    <div class="col-lg-12 mb-2 mb-lg-0">
                        <div class="text-uppercase mb-3 py-2 px-4 bg-dark text-white"><strong class="small text-uppercase fw-bold">Kategori produk di Brand <?= ucfirst($brand->nama_brand); ?></strong></div>
                    </div>
                    <div class="row">
                        <!-- PRODUCT-->
                        <?php
                        $cat = $this->db->query("select * from tb_kategori where id_brand='$brand->id_brand'");
                        foreach ($cat->result() as $kat) :
                        ?>
                            <div class="col-lg-4 col-sm-6">
                                <div class="product text-center">
                                    <div class="mb-3 position-relative">
                                        <div class="badge text-white bg-"></div><a class="d-block" href="<?= base_url('welcome/cats/' . $kat->id_kategori); ?>"><img class="img-fluid w-100" src="<?= base_url("assets/frontend/img/favicon.png"); ?>"></a>
                                        <div class="product-overlay">
                                            <ul class="mb-0 list-inline">
                                                <!-- <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-outline-dark" href="#!"><i class="far fa-heart"></i></a></li> -->
                                                <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-dark" href="<?= base_url('welcome/cats/' . $kat->id_kategori); ?>">Brand Kategori</a></li>
                                                <!-- <li class="list-inline-item mr-0"><a class="btn btn-sm btn-outline-dark" href="#productView" data-bs-toggle="modal"><i class="fas fa-expand"></i></a></li> -->
                                            </ul>
                                        </div>
                                    </div>
                                    <h6> <a class="reset-anchor" href="<?= base_url('welcome/cats/' . $kat->id_kategori); ?>"><?= ucfirst($kat->nama_kategori); ?></a></h6>
                                    <p class="small text-muted"><?= ucfirst($brand->nama_brand); ?></p>
                                </div>
                            </div>
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