<section class="content">

  <h5>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url("user/home"); ?>"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Transaksi</li>
      <li class="active"><a href="<?php echo base_url("user/surat_jalan_masuk/surat_jalan_masuk"); unset($_SESSION['sjm1'], $_SESSION['barang_sjm']); ?>" style="color: #777;" onclick="return confirm('Anda punya perubahan yang belum disimpan; Anda yakin hendak meninggalkan halaman ini?')">Data Surat Jalan Masuk</a></li>
      <li class="active">Tambah</li>
    </ol>
  </h5>

  <div class="row">

    <div class="col-xs-1"></div>

    <div class="col-xs-10">

      <!-- /.box-header -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title fa fa-plus"> Form Tambah Data Surat Jalan Masuk</h3>
          <button type="button" class="close" data-dismiss="modal" onclick="history.back(-1)" title="kembali" data-content="Popover body content is set in this attribute.">&times;</button>
        </div>

        <!-- /.box-header -->
        <div class="box-body">
          <form role="form" method="POST" >


            <!-- Form Untuk Tambah -->
            <div class="col-md-12">
              <div class="form-group">
                <div class="row">
                  <div class="col-xs-3">
                    <label>No.Surat Jalan Masuk</label>
                    <input type="text" class="form-control" name="no_sjm" value="<?php echo $sjm['no_sjm']; ?>" placeholder="SJM-005">
                  </div>
                  <div class="col-xs-3">
                    <label>No.Kendaraan</label>
                    <input type="text" class="form-control" name="no_kendaraan" value="<?php echo $sjm['no_kendaraan']; ?>" placeholder="Contoh: 007 - 400">
                  </div>
                  <div class="col-xs-3">
                    <label>Tanggal Surat Jalan Masuk</label>
                    <input type="text" class="form-control" name="tgl_masuk" value="<?php echo date('d-m-Y'); ?>" readonly="readonly">
                  </div>
                  <div class="col-xs-3">
                    <label>Supplier</label>
                    <select class="form-control js-example-basic-single" name="id_supplier">
                      <option value="Kosong">----- Pilih -----</option>
                      <?php foreach ($supplier as $key => $value): ?>
                        <option value="<?php echo $value['id_supplier']; ?>" <?php if($sjm['id_supplier']==$value['id_supplier']){echo "selected";} ?>><?php echo $value['nama_supplier']; ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-xs-12">
                    <label class="control-label">Keterangan</label>
                    <textarea class="ckeditor" id="ckeditor" name="keterangan"><?php echo $sjm['keterangan']; ?></textarea>
                  </div>
                </div>
              </div>
            </div>
            <!-- Akhir Form Untuk Tambah -->

            <!-- Form Untuk Tambah -->
            <div class="col-md-12">
              <div class="form-group">
                <div class="row">

                  <div class="box-header with-border">
                    <h3 class="box-title"> Input Barang</h3>
                  </div>

                  <!-- Tabel Kalkulasi SJM -->
                  <div class="box-body">
                    <div class="col-xs-2">
                      <label>Nama Barang</label>
                      <select class="form-control js-example-basic-single" name="nama_barang" id="barang">
                        <option value="Kosong">- Pilih -</option>
                        <?php foreach ($barang as $key => $value): ?>
                          <option value="<?php echo $value['nama_barang']; ?>"><?php echo $value['nama_barang']; ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>
                    <div class="col-xs-2">
                      <label>Jenis</label>
                      <input type="text" class="form-control jenis" name="jenis" value="<?php echo $ambil['jenis']; ?>" readonly>
                    </div>
                    <div class="col-xs-2">
                      <label>Sub Jenis</label>
                      <input type="text" class="form-control subjenis" name="sub_jenis" value="<?php echo $ambil['sub_jenis']; ?>" readonly>
                    </div>
                    <div class="col-xs-2">
                      <label>Warna</label>
                      <input type="text" class="form-control warna" name="warna" value="<?php echo $ambil['warna']; ?>" readonly="readonly">
                    </div>
                    <div class="col-xs-1">
                      <label>Qty</label>
                      <input type="number" class="form-control" step="any" name="qty_sjm" placeholder="0">
                    </div>
                    <div class="col-xs-1">
                      <label>Satuan</label>
                      <input type="text" class="form-control satuan" name="satuan" value="<?php echo $ambil['satuan']; ?>" readonly>
                    </div>
                    <div class="col-xs-2">
                      <label>Ukuran</label>
                      <input type="text" name="ukuran" class="form-control" placeholder="500 x 400 x 25mm">
                    </div>
                  </div>
                  <!-- Tabel Kalkulasi SJM -->

                  <div class="box-body">
                    <div class="col-xs-3">
                      <?php if (empty($tbl_sjm)): ?>
                        <button class="btn btn-default fa fa-arrow-down" name="tambah" value="tambah" id="tambah" title="Tambah Record" data-content="Popover body content is set in this attribute."> Tambahkan</button>
                      <?php elseif (!empty($tbl_sjm)): ?>
                        <button class="btn btn-default fa fa-arrow-down" name="tambah" value="tambah" id="tambah" title="Tambah Record" data-content="Popover body content is set in this attribute."> Tambahkan</button>
                      <?php endif ?>
                    </div>  
                  </div>
                </div>
              </div>
            </div>
            <!-- Akhir Form Untuk Tambah -->

            <!-- Tabel Output Record -->
            <div class="col-md-12">
              <div class="form-group">
                <div class="row">
                  <div class="box-header with-border">
                    <h3 class="box-title"> Detail Record</h3>
                  </div>
                  <div class="box-body">
                    <div class="col-xs-12">
                      <?php if(empty($tbl_sjm)): ?>
                        <button name="delete_record" value="delete_record" id="hapus" class="btn btn-default btn-sm fa fa-minus-square" title="Kosongkan Record" data-content="Popover body content is set in this attribute." disabled="disabled"> Hapus Record</button>
                      <?php elseif(!empty($tbl_sjm)): ?>
                        <button name="delete_record" value="delete_record" id="hapus" class="btn btn-default btn-sm fa fa-minus-square" title="Kosongkan Record" data-content="Popover body content is set in this attribute."> Kosongkan Record</button>
                      <?php endif ?>
                    </div>

                    <!-- <?php 
                    //echo "<pre>";
                    //print_r($tbl_sjm);
                    //echo "</pre>";
                    ?> -->

                    <div class="col-xs-12" style="padding-top: 10px;">
                      <table class="table table-bordered">
                        <!-- Header -->
                        <tr align="center">
                          <th rowspan="2" class="text-center" width="30"><h5 style="padding-top: 10px;"><b>No</b></h5></th>
                          <th rowspan="2" class="text-center" width="250"><h5 style="padding-top: 10px;"><b>Nama Barang</b></h5></th>
                          <th rowspan="2" class="text-center" width="200"><h5 style="padding-top: 10px;"><b>Jenis</b></h5></th>
                          <th rowspan="2" class="text-center" width="200"><h5 style="padding-top: 10px;"><b>Sub Jenis</b></h5></th>
                          <th colspan="3" class="text-center" style="font-size: 14px;"><b>Jumlah</b></th>
                        </tr>
                        <tr>
                          <td class="text-center" width="100" style="font-size: 14px;"><b>Warna</b></td>
                          <td class="text-center" width="100" style="font-size: 14px;"><b>Qty Barang</b></td>
                          <td class="text-center" width="100" style="font-size: 14px;"><b>Satuan</b></td>
                          <td class="text-center" width="200" style="font-size: 14px;"><b>Ukuran</b></td>
                        </tr>
                        <!-- / Header -->

                        <!-- Record -->
                        <?php 
                        $no = 1;
                        $total = 0;
                        ?>

                        <?php foreach ($tbl_sjm as $key => $value): ?>
                          <tr>
                            <td class="text-center" style="font-size: 14px;"><?php echo $no++; ?></td>
                            <td class="text-center" style="font-size: 14px;"><?php echo $value['nama_barang']; ?></td>
                            <td class="text-center" style="font-size: 14px;"><?php echo $value['jenis']; ?></td>
                            <td class="text-center" style="font-size: 14px;"><?php echo $value['sub_jenis']; ?></td>
                            <td class="text-center" style="font-size: 14px;"><?php echo $value['warna']; ?></td>
                            <td class="text-center" style="font-size: 14px;"><?php echo $value['qty_sjm']; ?></td>
                            <td class="text-center" style="font-size: 14px;"><?php echo $value['satuan']; ?></td>
                            <td class="text-center" style="font-size: 14px;">
                              <?php if (!empty($value['ukuran'])): ?>  
                                <?php echo $value['ukuran']; ?>
                              <?php elseif (empty($value['ukuran'])): ?>  
                                <?php echo "-"; ?>
                              <?php endif ?>
                            </td>
                          </tr>

                          <?php 
                          $total+=$value['qty_sjm']; 
                          ?>

                        <?php endforeach ?>
                        <tr>
                          <td colspan="4" class="text-center" style="font-size: 14px;"><b>Qty Total</b></td>
                          <td colspan="4" class="text-center" style="font-size: 14px;"><?php echo number_format($total, 2); ?></td>
                        </tr>
                        <!-- Record -->
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <div class="row">
                  <div class="box-body">
                    <div class="col-xs-6">
                      <button class="btn btn-primary fa fa-save" name="simpan1" value="simpan1" title="Simpan Data" data-content="Popover body content is set in this attribute."> Simpan Data</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </form>
        </div>
        
      </div>
    </div>

    <div class="col-xs-1"></div>

  </div>
</section>