<style type="text/css">
  .body-black {
    border: 1px solid black;
  }
</style>

<section class="content">

  <h5>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url("admin/home"); ?>"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Data Master</li>
      <li class="active"><a href="<?php echo base_url("admin/pemeriksaan_barang/pemeriksaan_barang"); ?>" style="color: #777;" onclick="return confirm('Anda punya perubahan yang belum disimpan; Anda yakin hendak meninggalkan halaman ini?')">Pemeriksaan Barang</a></li>
      <li class="active">Tambah</li>
    </ol>
  </h5>

  <div class="row">

    <div class="col-xs-1"></div>

    <div class="col-xs-10">

      <!-- /.box-header -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title fa fa-plus"> Form Tambah Pemeriksaan Barang</h3>
          <button type="button" class="close" data-dismiss="modal" onclick="history.back(-1)" title="kembali" data-content="Popover body content is set in this attribute.">&times;</button>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <form role="form" method="POST">
            <!-- text input -->
            <div class="col-md-12">
              <div class="form-group">
                <div class="row">


                  <div class="col-xs-12">
                    <h3 class="box-title" style="font-size: 16px;"> Pilih No.LPB Untuk Detail Barang</h3>
                  </div>

                  <div class="box-body">
                    <div class="col-xs-12">
                      <br>
                      <table>
                        <thead>
                          <tr>
                            <th>No.LPB</th>
                            <th style="padding-left: 10px;" width="200">
                              <select class="form-control js-example-basic-single" name="id_lpb" onchange="submit()">
                                <option value="Kosong">- Pilih -</option>
                                <?php foreach ($lpb as $key => $value): ?>
                                  <option value="<?php echo $value['id_lpb']; ?>" <?php if($id_lpb==$value['id_lpb']){echo "selected";} ?>><?php echo $value['no_lpb']; ?></option>
                                <?php endforeach ?>
                              </select>
                            </th>
                          </tr>
                        </thead>
                      </table>
                      <br>
                    </div>

                    <div class="col-xs-12">

                      <?php if (!empty($ambil['inspection_acceptable'])): ?>
                        <div class="alert alert-block alert" style="background-color: #FAEBD7;">
                          <button type="button" class="close" data-dismiss="alert">
                            <i class="ace-icon fa fa-times"></i>
                          </button>

                          <p class="text-center" style="color: red">Anda tidak bisa menambahkan pemeriksaan barang dengan nomor <?php echo $ambil['no_lpb']; ?> ini lagi dikarenakan sebelumnya anda sudah menambahkan. Pengecualian jika barang menunjukkan lebih dari satu barang yang tertampil di list barang, maka anda bisa menambahkan lagi dengan pilih nama barang.</p>
                        </div>

                      <?php endif ?>

                    </div>

                    <div class="col-xs-12" style="padding-top: 10px;">
                      <table class="body-black">
                        <!-- Header -->
                        <tr align="center">
                          <?php if (count($sjm)!==1): ?>
                            <th rowspan="2" class="text-center body-black" width="40" style="background-color: #b8c7ce"><h5 style="padding-top: 10px;"><b>No</b></h5></th>
                          <?php endif ?>
                          <th rowspan="2" class="text-center body-black" height="30" width="250" style="background-color: #b8c7ce"><h5 style="padding-top: 10px;"><b>Nama Barang</b></h5></th>
                          <th rowspan="2" class="text-center body-black" width="200" style="background-color: #b8c7ce"><h5 style="padding-top: 10px;"><b>Jenis</b></h5></th>
                          <th rowspan="2" class="text-center body-black" width="200" style="background-color: #b8c7ce"><h5 style="padding-top: 10px;"><b>Sub Jenis</b></h5></th>
                          <th colspan="3" class="text-center body-black" height="30" style="font-size: 14px; background-color: #b8c7ce""><b>Jumlah</b></th>
                        </tr>
                        <tr>
                          <td class="text-center body-black" width="100" height="30" style="font-size: 14px; background-color: #b8c7ce""><b>Qty Barang</b></td>
                          <td class="text-center body-black" width="100" style="font-size: 14px; background-color: #b8c7ce""><b>Satuan</b></td>
                          <td class="text-center body-black" width="300" style="font-size: 14px; background-color: #b8c7ce""><b>Ukuran</b></td>
                        </tr>
                        <!-- / Header -->

                        <?php $no = 1; ?>

                        <!-- Record -->
                        <?php foreach ($sjm as $key => $value): ?>
                          <tr>
                            <?php if (count($sjm)!==1): ?>
                              <td class="text-center body-black" height="30" style="font-size: 14px;"><?php echo $no++; ?></td>
                            <?php endif ?>
                            <td class="text-center body-black" height="30" style="font-size: 14px;"><?php echo $value['nama_barang']; ?></td>
                            <td class="text-center body-black" style="font-size: 14px;"><?php echo $value['jenis']; ?></td>
                            <td class="text-center body-black" style="font-size: 14px;"><?php echo $value['sub_jenis']; ?></td>
                            <td class="text-center body-black" style="font-size: 14px;"><?php echo $value['qty_sjm']; ?></td>
                            <td class="text-center body-black" style="font-size: 14px;"><?php echo $value['satuan']; ?></td>
                            <td class="text-center body-black" style="font-size: 14px;">
                              <?php if(!empty($value['ukuran'])): ?>
                                <?php echo $value['ukuran']; ?>
                              <?php else: ?>
                                <?php echo "-"; ?>
                              <?php endif ?>
                            </td>
                          </tr>
                        <?php endforeach ?>
                        <tr>
                          <td colspan="4" class="text-center body-black" height="30" style="font-size: 14px;"><b>Qty Total</b></td>
                          <td colspan="3" class="text-center body-black" style="font-size: 14px;">
                            <?php if (!empty($value['qty_total'])): ?>
                              <?php echo $value['qty_total']; ?>
                            <?php elseif (empty($value['qty_total'])): ?>
                              <?php echo ""; ?>
                            <?php endif ?>
                          </td>
                        </tr>
                        <!-- Record -->
                      </table>
                    </div>
                  </div>
                  <!-- Tabel Kalkulasi SJM -->

                  <div class="col-xs-12">
                    <h3 class="box-title" style="font-size: 16px;"> Input Data</h3>
                  </div>

                  <div class="col-xs-12">

                    <?php if (!empty($ambil1['nama_barang']=$ambil3['nama_barang'])): ?>
                      <div class="alert alert-block alert" style="background-color: #FAEBD7;">
                        <button type="button" class="close" data-dismiss="alert">
                          <i class="ace-icon fa fa-times"></i>
                        </button>

                        <p class="text-center" style="color: red">Anda tidak bisa menambahkan barang <?php echo $ambil1['nama_barang']; ?> lagi. </p>
                      </div>

                    <?php endif ?>

                  </div>

                  <div class="box-body">
                    <div class="col-xs-3">
                      <br>
                      <label>No.Pemeriksaan Barang</label>
                      <input type="text" name="no_periksa" class="form-control" value="<?php echo $kode_otomatis; ?>" readonly="readonly">
                    </div>
                    <div class="col-xs-3">
                      <br>
                      <label>Tanggal Pemeriksaan</label>
                      <input type="text" name="tgl_periksa" class="form-control" value="<?php echo date('Y-m-d'); ?>" readonly="readonly">
                    </div>
                    <?php if (count($sjm)!==1): ?>
                      <div class="col-xs-3">
                        <br>
                        <label>Nama Barang</label>
                        <th style="padding-left: 10px;" width="200">
                          <select class="form-control" name="nama_barang" onchange="submit()" required>
                            <option value="Kosong">- Pilih -</option>
                            <?php foreach ($sjm as $key => $value): ?>
                              <option value="<?php echo $value['nama_barang']; ?>" <?php if($nama_barang==$value['nama_barang']){echo "selected";} ?>><?php echo $value['nama_barang']; ?></option>
                            <?php endforeach ?>
                          </select>
                        </th>
                      </div>
                    <?php endif ?>
                    <div class="col-xs-3">
                      <br>
                      <label>Qty Reject</label>
                      <input type="number" class="form-control" step="any" name="qty_reject" required>
                    </div>
                    <div class="col-xs-3">
                      <br>
                      <label>Tindakan</label>
                      <select required class="form-control" name="tindakan">
                        <option value="Tidak Ada">- Pilih -</option>
                        <option value="Return Barang">Return Barang</option>
                        <option value="Dimusnahkan">Dimusnahkan</option>
                      </select>
                    </div>
                    <div class="col-xs-12">
                      <br>
                      <label>Hasil Pemeriksaan</label>  
                      <textarea class="ckeditor" id="ckeditor" name="hasil_periksa" row="5" required></textarea>
                    </div>
                    <div class="col-xs-12">
                      <br>
                      <?php if (empty($ambil) OR empty($ambil1['nama_barang']=$ambil3['nama_barang']) ): ?>
                        <button class="btn btn-primary fa fa-save" name="tambah" value="tambah" title="Simpan Data" data-content="Popover body content is set in this attribute."> Simpan Data</button>
                      <?php elseif($ambil['inspection_acceptable']=="Valid"): ?>
                        <button class="btn btn-primary fa fa-save" disabled="disabled" title="Simpan Data" data-content="Popover body content is set in this attribute."> Simpan Data</button>
                      <?php endif ?>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="col-xs-1"></div>

</div>
</section>