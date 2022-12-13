<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= $title ?>
            <small>Tambah produk</small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <?php $this->view('messages') ?>
        <div class="box">
            <div class="box-header text-center">
                <h3 class="box-title"><a href="<?= site_url('produk') ?>" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-refresh"></i> Kembali</a></h3>
            </div>
            <div class="box-body">
                <form action="<?= site_url('produk/proses') ?>" method="post">
                    <input type="hidden" name="id_produk" value="<?= $row->id_produk ?>">
                    <div class="row">
                        <div class="col-xs-12 col-md-3">
                            <div class="form-group <?= form_error('id_kategori') ? 'has-error' : null ?>">
                                <label for="id_brand">Pilih Brand & Kategori*</label>
                                <select name="id_kategori" class="form-control form-control-sm" required oninvalid="this.setCustomValidity('Brand kategori belum dipilih')" oninput="setCustomValidity('')">
                                    <option value="">--Pilih Kategori Produk--</option>
                                    <?php foreach ($brand->result() as $brd) : ?>
                                        <optgroup label="<?= ucfirst($brd->nama_brand); ?>">
                                            <?php
                                            $query = $this->db->query("select * from tb_kategori where id_brand='$brd->id_brand' order by id_kategori ASC");
                                            foreach ($query->result() as $cat) :
                                            ?>
                                                <option value="<?= $cat->id_kategori; ?>" <?= $row->id_kategori == $cat->id_kategori ? "selected" : null; ?>><?= ucfirst($cat->nama_kategori); ?></option>
                                            <?php endforeach ?>
                                        </optgroup>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-9">
                            <div class="form-group <?= form_error('judul') ? 'has-error' : null ?>">
                                <label for="judul">Judul Produk*</label>
                                <input type="text" name="judul" class="form-control form-control-sm" value="<?= $page == 'tambah' ? set_value('judul') : $row->judul ?>" autofocus>
                                <?= form_error('judul') ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group <?= form_error('deskripsi') ? 'has-error' : null ?>">
                        <label for="deskripsi">Deskripsi Produk*</label>
                        <textarea class="textarea" name="deskripsi" id="editor1" placeholder="Tuliskan deskripsi produk anda disini" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                          		<?= $page == 'tambah' ? set_value('deskripsi') : $row->deskripsi ?>
                          </textarea>
                        <?= form_error('deskripsi') ?>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-md-5">
                            <div class="form-group <?= form_error('harga') ? 'has-error' : null ?>">
                                <label for="harga">Harga*</label>
                                <small>(misal: 12000)</small>
                                <div class="input-group">
                                    <span class="input-group-addon">Rp.</span>
                                    <input type="number" name="harga" id="harga" class="form-control" value="<?= $page == 'tambah' ? set_value('harga') : $row->harga ?>">
                                    <span class="input-group-addon" style="font-size: 11px;">
                                        <select name="satuan" id="satuan" required oninvalid="this.setCustomValidity('Satuan belum dipilih')" oninput="setCustomValidity('')">
                                            <option value="">Pilih Satuan</option>
                                            <option value="Paket" <?= $row->satuan == 'Paket' ? "selected" : null; ?>>Paket</option>
                                            <option value="Unit" <?= $row->satuan == 'Unit' ? "selected" : null; ?>>Unit</option>
                                            <option value="Buah" <?= $row->satuan == 'Buah' ? "selected" : null; ?>>Buah</option>
                                        </select>
                                    </span>
                                </div>
                                <?= form_error('harga') ?>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-2">
                            <div class="form-group <?= form_error('stok') ? 'has-error' : null ?>">
                                <label for="harga">Stok*</label>
                                <div class="input-group">
                                    <input type="number" name="stok" id="stok" class="form-control" value="<?= $page == 'tambah' ? set_value('stok') : $row->stok ?>">
                                </div>
                                <?= form_error('stok') ?>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-5">
                            <div class="form-group <?= form_error('produk_status') ? 'has-error' : null ?>">
                                <label for="produk_status">Produk status</label>
                                <select name="produk_status" class="form-control">
                                    <option value="none">-Pilih-</option>
                                    <option value="Baru" <?= $row->produk_status == 'Baru' ? "selected" : null; ?>>Baru</option>
                                    <option value="Lama" <?= $row->produk_status == 'Lama' ? "selected" : null; ?>>Lama</option>
                                </select>
                                <?= form_error('produk_status') ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group <?= form_error('manfaat') ? 'has-error' : null ?>">
                                <label for="manfaat">Manfaat Produk*</label>
                                <textarea class="textarea" name="manfaat" id="editor1" placeholder="Jelaskan manfaat produk di sini" style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                          		<?= $page == 'tambah' ? set_value('manfaat') : $row->manfaat ?>
                          </textarea>
                                <?= form_error('manfaat') ?>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group <?= form_error('cara_penggunaan') ? 'has-error' : null ?>">
                                <label for="cara_penggunaan">Cara Penggunaan Produk*</label>
                                <textarea class="textarea" name="cara_penggunaan" id="editor1" placeholder="Jelaskan cara penggunaan produk di sini" style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                          		<?= $page == 'tambah' ? set_value('cara_penggunaan') : $row->cara_penggunaan ?>
                          </textarea>
                                <?= form_error('cara_penggunaan') ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group <?= form_error('keterangan') ? 'has-error' : null ?>">
                        <label for="judul">Keterangan</label>
                        <textarea name="keterangan" class="form-control" cols="30" placeholder="Tuliskan jika ada keterangan tambahan untuk produk disini"><?= $page == 'tambah' ? set_value('keterangan') : $row->keterangan ?></textarea>
                        <?= form_error('keterangan') ?>
                    </div>

                    <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                        <button type="reset" class="btn btn-outline-primary">Reset</button>
                        <button type="submit" name="<?= $page ?>" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->