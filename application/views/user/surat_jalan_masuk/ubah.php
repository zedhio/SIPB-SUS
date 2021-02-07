<section class="content">

  <h5>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url("user/home"); ?>"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Transaksi</li>
      <li class="active"><a href="<?php echo base_url("user/surat_jalan_masuk/surat_jalan_masuk"); ?>" style="color: #777;" onclick="return confirm('Anda punya perubahan yang belum disimpan; Anda yakin hendak meninggalkan halaman ini?')">Data Surat Jalan Masuk</a></li>
      <li class="active">ubah</li>
    </ol>
  </h5>

  <div class="row">

    <div class="col-xs-1"></div>

    <div class="col-xs-10">

      <!-- /.box-header -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title fa fa-plus"> Form Ubah Data Surat Jalan Masuk</h3>
          <button type="button" class="close" data-dismiss="modal" onclick="history.back(-1)" title="kembali" data-content="Popover body content is set in this attribute.">&times;</button>
        </div>
        <!-- /.box-header -->
        <div class="box-body">

          <!-- Bagian tampilan tambah Surat Jalan Masuk -->
          <form role="form" method="POST" >
            <div class="col-md-12">
              <div class="form-group">
                <div class="row">
                  <div class="box-header with-border">
                    <h3 class="box-title"> Input Data</h3>
                  </div>
                  
                  <!-- Data masuk ke tabel surat jalan masuk -->
                  <div class="box-body">
                    <div class="col-xs-3">
                      <label>No.Surat Jalan Masuk</label>
                      <input type="text" class="form-control" name="no_sjm" value="<?php echo $sjm['no_sjm']; ?>" readonly="readonly">  
                    </div>
                    <div class="col-xs-3">
                      <label>No.Kendaraan</label>
                      <input type="text" class="form-control" name="no_kendaraan" value="<?php echo $sjm['no_kendaraan']; ?>">  
                    </div>
                    <div class="col-xs-3">
                      <label>Tanggal Masuk</label>
                      <div class="input-group">
                        <input type="text" class="form-control" name="tgl_masuk" value="<?php echo date('d-m-Y',strtotime($sjm['tgl_masuk'])); ?>" readonly="readonly">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar-plus-o"></i>
                        </div>
                      </div>  
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
                  <div class="box-header with-border">
                    <h3 class="box-title"> Tambahkan Keterangan</h3>
                  </div>
                  <div class="box-body">
                    <div class="col-xs-12">
                      <label class="control-label">Keterangan</label>
                      <textarea class="ckeditor" id="ckeditor" name="keterangan"><?php echo $sjm['keterangan']; ?></textarea>
                    </div>
                  </div>
                  <!-- Data masuk ke tabel surat jalan masuk -->

                  <!-- Bagian tombol ke form ubah selanjutnya -->
                  <!-- <div class="box-body">
                    <div class="col-xs-1">
                      <button class="btn btn-primary fa fa-arrow-right" name="simpan_temp" value="simpan_temp" title="Simpan Temporary" data-content="Popover body content is set in this attribute."> Selanjutnya</button>
                    </div>
                  </div> -->
                  <!-- Bagian tombol ke form ubah selanjutnya -->

                </div>
              </div>
            </div>

            <!-- Patokan input barang -->
            <div class="col-md-12">
              <div class="form-group">
                <div class="row">

                  <div class="box-header with-border">
                    <h3 class="box-title"> Input Barang</h3>
                  </div>

                  <!-- Masuk tabel kalkulasi surat jalan masuk -->
                  <div class="box-body">
                    <div class="col-xs-2">
                      <label>Nama Barang</label>
                      <select class="form-control" name="nama_barang" id="barang"> 
                        <option value="Kosong">- Pilih -</option>
                        <?php foreach ($barang as $key => $value): ?>
                          <option value="<?php echo $value['nama_barang']; ?>"><?php echo $value['nama_barang']; ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>
                    <div class="col-xs-2">
                      <label>Jenis</label>
                      <input type="text" class="form-control jenis" id="jenis" name="jenis" value="" readonly>
                    </div>
                    <div class="col-xs-2">
                      <label>Sub Jenis</label>
                      <input type="text" class="form-control sub_jenis" id="sub_jenis" name="sub_jenis" value="" readonly>
                    </div>
                    <div class="col-xs-1">
                      <label>Qty</label>
                      <input type="number" class="form-control" id="qty_sjm" name="qty_sjm" placeholder="0">
                    </div>
                    <div class="col-xs-2">
                      <label>Satuan</label>
                      <input type="text" class="form-control satuan" id="satuan" name="satuan" value="" readonly>
                    </div>
                    <div class="col-xs-3">
                      <label>Ukuran</label>
                      <input type="text" name="ukuran" id="ukuran" class="form-control  ukuran" placeholder="500 x 400 x 25mm">
                    </div>

                    <!-- Patokan menampilkan id kalkulasi -->
                    <div class="col-xs-3 hidden">
                      <label>ID Kalkulasi</label>
                      <input type="number" name="id_kalkulasi_sjm" id="id_kalkulasi" class="form-control hidden">
                    </div>
                    <!-- Patokan menampilkan id kalkulasi -->

                  </div>
                  <!-- Masuk tabel kalkulasi surat jalan masuk -->

                  <!-- Bagian tombol ubah data -->
                  <div class="box-body">
                    <div class="col-xs-3">
                      <button class="btn btn-default fa fa-arrow-down" id="ubah" name="ubah" value="ubah" title="Ubah Record" data-content="Popover body content is set in this attribute." disabled="disabled"> Ubah Record</button>
                    </div>  
                  </div>
                  <!-- Bagian tombol ubah data -->

                </div>
              </div>
            </div>
            <!-- Patokan input barang -->

            <!-- Patokan Detail Record -->
            <div class="col-md-12">
              <div class="form-group">
                <div class="row">
                  <div class="box-header with-border">
                    <h3 class="box-title"> Detail Record</h3>
                  </div>
                  <div class="box-body">

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
                          <td class="text-center" width="100" style="font-size: 14px;"><b>Qty Barang</b></td>
                          <td class="text-center" width="100" style="font-size: 14px;"><b>Satuan</b></td>
                          <td class="text-center" width="300" style="font-size: 14px;"><b>Ukuran</b></td>
                        </tr>
                        <!-- / Header -->

                        <!-- Count Total Qty Barang -->
                        <?php 
                        $no = 1;
                        $total = 0;
                        ?>
                        <!-- Count Total Qty Barang -->

                        <?php foreach ($ambil_kalkulasi as $key => $value): ?>
                          <tr>
                            <td class="text-center" style="font-size: 14px;">
                              <input type="radio" id="sjm" data-id="<?php echo $value['id_kalkulasi_sjm']; ?>"> <?php echo $no++; ?>
                            </td>
                            <td class="text-center" style="font-size: 14px;"><?php echo $value['nama_barang']; ?></td>
                            <td class="text-center" style="font-size: 14px;"><?php echo $value['jenis']; ?></td>
                            <td class="text-center" style="font-size: 14px;"><?php echo $value['sub_jenis']; ?></td>
                            <td class="text-center" style="font-size: 14px;"><?php echo $value['qty_sjm']; ?></td>
                            <td class="text-center" style="font-size: 14px;"><?php echo $value['satuan']; ?></td>
                            <td class="text-center" style="font-size: 14px;">
                              <?php if (!empty($value['ukuran'])): ?>
                                <?php echo $value['ukuran']; ?>
                              <?php elseif (empty($value['ukuran'])): ?>
                              <?php echo "-" ?>
                            <?php endif ?>
                          </td>
                        </tr>

                        <!-- Count Total Qty Barang -->
                        <?php 
                        $total+=$value['qty_sjm']; 
                        ?>
                        <!-- Count Total Qty Barang -->

                      <?php endforeach ?>

                      <tr>
                        <td colspan="4" class="text-center" style="font-size: 14px;"><b>Qty Total</b></td>
                        <td colspan="3" class="text-center" style="font-size: 14px;"><?php echo $total; ?></td>
                      </tr>
                      <!-- Record -->
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Patokan Detail Record -->

          <!-- Bagian tombol ubah data -->
          <div class="col-md-12">
            <div class="form-group">
              <div class="row">
                <div class="box-body">
                  <div class="col-xs-6">
                    <button class="btn btn-success fa fa-pencil" name="ubah1" value="ubah1" title="Ubah Data" data-content="Popover body content is set in this attribute."> Ubah Data</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Bagian tombol ubah data -->

        </form>
        <!-- Bagian tampilan tambah Surat Jalan Masuk -->

      </div>
    </div>
  </div>

  <div class="col-xs-1"></div>

</div>
</section>