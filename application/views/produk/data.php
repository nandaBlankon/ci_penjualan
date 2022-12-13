<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= $title ?>
            <small>Data kategori</small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <?php $this->view('messages') ?>
        <div class="box">
            <div class="box-header text-center">
                <h3 class="box-title"><a href="<?= site_url('produk-tambah') ?>" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> Tambah</a></h3>
            </div>
            <div class="box-body">
                <table id="table1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Foto Produk</th>
                            <th>No</th>
                            <th>Brand Kategori</th>
                            <th>Judul/Produk</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($row->result() as $data) : ?>
                            <tr>
                                <td>
                                    <!-- menampilkan foto produk berdasarkan id_produk -->
                                    <?php
                                    $query = $this->db->query("select * from tb_image_produk where id_produk='$data->id_produk' order by id_image ASC");
                                    ?>
                                    <!-- end menampilkan foto produk berdasarkan id_produk -->
                                    <?php if ($query->num_rows()) { ?>
                                        <!-- coding menampilkan foto produk disini -->
                                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                            <ol class="carousel-indicators">
                                                <?php foreach ($query->result() as $key => $image) : ?>
                                                    <li data-target="#carousel-example-generic" data-slide-to="<?= $key ?>" class="<?= $key == 0 ? "active" : null; ?>"></li>
                                                <?php endforeach ?>
                                            </ol>
                                            <div class="carousel-inner">
                                                <?php foreach ($query->result() as $key => $image) : ?>
                                                    <div class="item <?= $key == 0 ? "active" : null; ?>">
                                                        <img src="<?= base_url('uploads/produk/' . $image->image) ?>" style="height: 170px;" class="center-block">

                                                        <div class="carousel-caption">
                                                            <a href="<?= site_url('produk/editfoto/' . $image->id_image) ?>" class="btn btn-primary btn-xs btn-flat" title="Ganti Foto ini"><i class="fa fa-plus"></i></a>
                                                            <a href="<?= site_url('produk/hapusfoto/' . $image->id_image) ?>" class="btn btn-danger btn-xs btn-flat" title="Hapus Foto ini"><i class="fa fa-trash"></i></a>
                                                        </div>
                                                    </div>
                                                <?php endforeach ?>
                                            </div>
                                            <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                                                <span class="fa fa-angle-left"></span>
                                            </a>
                                            <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                                                <span class="fa fa-angle-right"></span>
                                            </a>
                                        </div>
                                        <a href="<?= base_url('produk/uploadFoto/' . $data->id_produk); ?>" class="btn btn-google btn-block btn-sm"><i class="fa fa-upload fa-fw"></i>
                                            Unggah Lagi Foto</a>
                                    <?php } else { ?>
                                        <a href="<?= base_url('produk/uploadFoto/' . $data->id_produk); ?>" class="btn btn-google btn-block btn-sm"><i class="fa fa-upload fa-fw"></i>
                                            Unggah Foto Produk</a>
                                    <?php } ?>
                                </td>
                                <td><?= $no++ ?></td>
                                <td>
                                    <?php
                                    $brand = $this->db->query("select * from tb_kategori,tb_brand where id_kategori='$data->id_kategori' order by id_kategori")->row();
                                    ?>
                                    <?= ucwords($brand->nama_brand); ?> <i class="fa fa-angle-double-right"></i>
                                    <?= ucwords($brand->nama_kategori); ?>
                                </td>
                                <td><?= ucwords($data->judul) ?></td>
                                <td><?= ucwords($data->harga) ?></td>
                                <td><?= ucwords($data->stok) ?></td>
                                <td>
                                    <a href="<?= base_url('produk/edit/' . $data->id_produk); ?>" class="btn btn-flat btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                    <a href="<?= base_url('produk/hapus/' . $data->id_produk); ?>" onclick="return confirm('Anda yakin ingin menghapus data ini?')" class="btn btn-flat btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                    <a href="" data-toggle="modal" data-target="#deskripsiModal<?= $data->id_produk ?>" class="btn btn-flat btn-success btn-sm" title="Detail Produk"><i class="fa fa-eye"></i></a>
                                </td>
                            </tr>

                            <!-- Start Deskripsi Modal-->
                            <div class="modal fade" id="deskripsiModal<?= $data->id_produk ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-bold" id="exampleModalLabel">Detail Produk</h5>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <ul class="list-group mb-4">
                                                        <li class="list-group-item active">Informasi Produk</li>
                                                        <li class="list-group-item">
                                                            <small>Kategori produk</small><br>
                                                            <?= ucwords($data->nama_kategori); ?>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <small>Judul/Nama produk</small><br>
                                                            <?= ucwords($data->judul); ?>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <small>Harga produk</small><br>
                                                            <?= $this->fungsi->nominal($data->harga); ?>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <small>Stok produk</small><br>
                                                            <?= $data->stok; ?> <?= ucwords($data->satuan); ?>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <small>Status produk</small><br>
                                                            <?= $data->produk_status == null ? '-' : ucwords($data->produk_status); ?>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-md-6">
                                                    <ul class="list-group mb-4">
                                                        <li class="list-group-item active">Foto Produk</li>
                                                        <li class="list-group-item">
                                                            <!-- menampilkan foto produk berdasarkan id_produk -->
                                                            <?php
                                                            $query = $this->db->query("select * from tb_image_produk where id_produk='$data->id_produk' order by id_image ASC");
                                                            ?>
                                                            <!-- end menampilkan foto produk berdasarkan id_produk -->
                                                            <?php if ($query->num_rows()) { ?>
                                                                <!-- coding menampilkan foto produk disini -->
                                                                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                                                    <ol class="carousel-indicators">
                                                                        <?php foreach ($query->result() as $key => $image) : ?>
                                                                            <li data-target="#carousel-example-generic" data-slide-to="<?= $key ?>" class="<?= $key == 0 ? "active" : null; ?>"></li>
                                                                        <?php endforeach ?>
                                                                    </ol>
                                                                    <div class="carousel-inner">
                                                                        <?php foreach ($query->result() as $key => $image) : ?>
                                                                            <div class="item <?= $key == 0 ? "active" : null; ?>">
                                                                                <img src="<?= base_url('uploads/produk/' . $image->image) ?>" style="height: 253px;" class="center-block img-responsive">

                                                                                <div class="carousel-caption">
                                                                                    <a href="<?= site_url('produk/editfoto/' . $image->id_image) ?>" class="btn btn-primary btn-xs btn-flat" title="Ganti Foto ini"><i class="fa fa-plus"></i></a>
                                                                                    <a href="<?= site_url('produk/hapusfoto/' . $image->id_image) ?>" class="btn btn-danger btn-xs btn-flat" title="Hapus Foto ini"><i class="fa fa-trash"></i></a>
                                                                                </div>
                                                                            </div>
                                                                        <?php endforeach ?>
                                                                    </div>
                                                                    <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                                                                        <span class="fa fa-angle-left"></span>
                                                                    </a>
                                                                    <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                                                                        <span class="fa fa-angle-right"></span>
                                                                    </a>
                                                                </div>
                                                                <a href="<?= base_url('produk/uploadFoto/' . $data->id_produk); ?>" class="btn btn-google btn-block btn-sm"><i class="fa fa-upload fa-fw"></i>
                                                                    Unggah Lagi Foto</a>
                                                            <?php } else { ?>
                                                                <a href="<?= base_url('produk/uploadFoto/' . $data->id_produk); ?>" class="btn btn-google btn-block btn-sm"><i class="fa fa-upload fa-fw"></i>
                                                                    Unggah Foto Produk</a>
                                                            <?php } ?>
                                                        </li>
                                                    </ul>
                                                </div>

                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="box box-danger">
                                                        <div class="box-header with-border">
                                                            <h3 class="box-title">Deskripsi Produk</h3>

                                                            <div class="box-tools pull-right">
                                                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                                                </button>
                                                            </div>
                                                            <!-- /.box-tools -->
                                                        </div>
                                                        <!-- /.box-header -->
                                                        <div class="box-body">
                                                            <?= ucfirst($data->deskripsi); ?>
                                                        </div>
                                                        <!-- /.box-body -->
                                                    </div>
                                                    <!-- /.box -->
                                                </div>
                                                <!-- /.col -->
                                                <div class="col-md-6">
                                                    <div class="box box-warning">
                                                        <div class="box-header with-border">
                                                            <h3 class="box-title">Manfaat Produk</h3>

                                                            <div class="box-tools pull-right">
                                                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                                                </button>
                                                            </div>
                                                            <!-- /.box-tools -->
                                                        </div>
                                                        <!-- /.box-header -->
                                                        <div class="box-body">
                                                            <?= ucfirst($data->manfaat); ?>
                                                        </div>
                                                        <!-- /.box-body -->
                                                    </div>
                                                    <!-- /.box -->
                                                </div>
                                                <!-- /.col -->
                                            </div>
                                            <div class="col-md-6">
                                                <div class="box box-danger">
                                                    <div class="box-header with-border">
                                                        <h3 class="box-title">Cara Penggunaan Produk</h3>

                                                        <div class="box-tools pull-right">
                                                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                                            </button>
                                                        </div>
                                                        <!-- /.box-tools -->
                                                    </div>
                                                    <!-- /.box-header -->
                                                    <div class="box-body">
                                                        <?= ucfirst($data->cara_penggunaan); ?>
                                                    </div>
                                                    <!-- /.box-body -->
                                                </div>
                                                <!-- /.box -->
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-md-6">
                                                <div class="box box-warning">
                                                    <div class="box-header with-border">
                                                        <h3 class="box-title">Keterangan Lainnya</h3>

                                                        <div class="box-tools pull-right">
                                                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                                            </button>
                                                        </div>
                                                        <!-- /.box-tools -->
                                                    </div>
                                                    <!-- /.box-header -->
                                                    <div class="box-body">
                                                        <?= ucfirst($data->keterangan); ?>
                                                    </div>
                                                    <!-- /.box-body -->
                                                </div>
                                                <!-- /.box -->
                                            </div>
                                            <!-- /.col -->

                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-danger" type="button" data-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Deskripsi Modal-->

                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->