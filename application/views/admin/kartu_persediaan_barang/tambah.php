

<section class="content">

  <h5>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url("admin/home"); ?>"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Transaksi</li>
      <li class="active"><a href="<?php echo base_url("admin/kartu_persediaan_barang/kartu_persediaan_barang"); ?>" style="color: #777;" onclick="return confirm('Anda punya perubahan yang belum disimpan; Anda yakin hendak meninggalkan halaman ini?')">Data Kartu Persediaan Barang</a></li>
      <li class="active">Tambah</li>
    </ol>
  </h5>

  <div class="row">

    <div class="col-xs-1"></div>

    <div class="col-xs-10">

      <!-- /.box-header -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title fa fa-plus"> Form Tambah Data Kartu Persediaan Barang</h3>
          <button type="button" class="close" data-dismiss="modal" onclick="history.back(-1)" title="kembali" data-content="Popover body content is set in this attribute.">&times;</button>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <form role="form" method="POST" >

            <!-- Form Untuk Tambah -->
            <div class="col-md-12">
              <div class="form-group">
                <div class="row">
                  <div class="col-xs-12">
                    <label>No.Kartu Persediaan Barang</label>
                    <?php if(!empty($ambil)): ?>
                      <input type="text" name="no_kpb" class="form-control" value="<?php echo $ambil['kode_jenis']; ?>/<?php echo $ambil['kode_subjenis']; ?><?php echo $kode_otomatis; ?>" readonly="readonly">
                    <?php elseif(empty($ambil)): ?>
                      <input type="text" readonly="readonly" class="form-control">
                    <?php endif ?>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-xs-12">
                    <label>Nama Barang</label>
                    <select class="form-control js-example-basic-single" name="id_barang" id="barang" onchange="submit()">
                      <option value="Kosong">- Pilih -</option>
                      <?php foreach ($barang as $key => $value): ?>
                        <option value="<?php echo $value['id_barang']; ?>" <?php if($ambil['id_barang']==$value['id_barang']){echo "selected";} ?>><?php echo $value['nama_barang']; ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-xs-12">
                    <label>Jenis</label>
                    <input type="text" class="form-control jenis" value="<?php echo $ambil['jenis']; ?>" readonly="readonly">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-xs-12">
                    <label>Sub Jenis</label>
                    <input type="text" class="form-control subjenis" value="<?php echo $ambil['sub_jenis']; ?>" readonly="readonly">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-xs-12">
                    <label>Satuan</label>
                    <input type="text" class="form-control satuan" value="<?php echo $ambil['satuan']; ?>" readonly="readonly">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-xs-12">
                    <label>Warna</label>
                    <input type="text" class="form-control warna" value="<?php if (!empty($ambil['warna'])): ?> <?php echo $ambil['warna']; ?> <?php elseif (empty($ambil['warna'])): ?> <?php echo "-"; ?> <?php endif ?> " readonly="readonly">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-xs-12">
                    <label>Ukuran</label>
                    <input type="text" class="form-control" name="ukuran" placeholder="Contoh: 200x300x40mm">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-xs-4">
                    <label>Tanggal</label>
                    <input type="text" class="form-control" name="tgl_masuk" value="<?php echo date('Y-m-d'); ?>" readonly="readonly">
                  </div>
                  <div class="col-xs-4">
                    <label>Pilih Keterangan</label>
                    <div class="radio">
                      <label><input type="radio" name="keterangan" alt="Radio" value="Stok" required>Stok</label>&nbsp;&nbsp;&nbsp;
                      <label><input type="radio" name="keterangan" alt="Radio" value="Pemindahan Saldo">Pemindahan Saldo</label>
                    </div>
                  </div>
                  <div class="col-xs-4">
                    <label>Saldo</label>
                    <input type="number" name="saldo" value="<?php echo $ambil['stok']; ?>" class="form-control" readonly>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                  <button class="btn btn-primary fa fa-save" name="simpan" value="simpan" title="Simpan Data" data-content="Popover body content is set in this attribute."> Simpan Data</button>
                  </div>
                </div>
              </div>
            </div>
            <!-- Akhir Form Untuk Tambah -->
          </form>
        </div>
      </div>
    </div>

    <div class="col-xs-1"></div>

  </div>
</section>