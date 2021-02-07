<style type="text/css">
  .body-black {
    border: 1px solid black;
  }
</style>

<section class="content">

  <h5>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url("user/home"); ?>"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Transaksi</li>
      <li class="active"><a href="<?php echo base_url("user/reject_barang_produksi/reject_barang_produksi"); ?>" style="color: #777;" onclick="return confirm('Anda punya perubahan yang belum disimpan; Anda yakin hendak meninggalkan halaman ini?')">Reject Barang Produksi</a></li>
      <li class="active">Tambah</li>
    </ol>
  </h5>

  <div class="row">

    <div class="col-xs-1"></div>

    <div class="col-xs-10">

      <!-- /.box-header -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title fa fa-plus"> Form Tambah Reject Barang Produksi</h3>
          <button type="button" class="close" data-dismiss="modal" onclick="history.back(-1)" title="kembali" data-content="Popover body content is set in this attribute.">&times;</button>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <form role="form" method="POST">
            <!-- text input -->
            <div class="col-md-12">
              <div class="form-group">
                <div class="row">

                  <div class="box-body">
                    <div class="col-xs-12">
                      <label>No.Reject Barang Produksi</label>
                      <input type="text" class="form-control" name="no_reject" value="<?php echo $kode_otomatis; ?>" readonly="readonly">
                    </div>
                    <div class="col-xs-12" style="padding-top: 15px;">
                      <label>Tanggal Reject</label>
                      <input type="text" class="form-control" name="tgl_reject" value="<?php echo date('Y-m-d'); ?>" readonly="readonly">
                    </div>
                    <div class="col-xs-12" style="padding-top: 15px;">
                      <label>Untuk P.O</label>
                      <select class="form-control js-example-basic-single" required="" name="id_po" onchange="submit()">
                        <option value="Kosong">------ Pilih -----</option>
                        <?php foreach ($po as $key => $value): ?>
                          <?php if (!empty($value['count']==3) AND $value['konfirmasi']=="Valid"): ?>
                            <option value="<?php echo $value['id_po']; ?>" <?php if($id_po==$value['id_po']){echo "selected";} ?>><?php echo $value['nama_po']; ?></option>
                          <?php endif ?>
                        <?php endforeach ?>
                      </select>
                    </div>
                    <div class="col-xs-12" style="padding-top: 15px;">
                      <label>Buyer</label>
                      <input type="text" class="form-control" value="<?php if (!empty($ambil_po)): ?> <?php echo $ambil_po[0]['nama_buyer']; ?> <?php endif ?>" readonly="readonly">
                    </div>
                    <div class="col-xs-12" style="padding-top: 15px;">
                      <label>Style Glove</label>
                      <input type="text" class="form-control" value="<?php if (!empty($ambil_po)): ?> <?php echo $ambil_po[0]['nama_style']; ?> <?php endif ?>" readonly="readonly">
                    </div>
                    <div class="col-xs-12" style="padding-top: 15px;">
                      <label>Qty</label>
                      <input type="text" class="form-control" value="<?php if (!empty($ambil_po)): ?> <?php echo $ambil_po[0]['qty']; ?> <?php endif ?>" readonly="readonly">
                    </div>

                    <div class="col-xs-12" style="padding-top: 10px;"><br>
                      <table class="body-black">
                        <!-- Header -->
                        <tr style="background-color: #ddd;">
                          <th rowspan="2" class="text-center body-black" width="120"><h5 style="padding-top: 10px;"><b>No.BON</b></h5></th>
                          <th rowspan="2" class="text-center body-black" width="120"><h5 style="padding-top: 10px;"><b>Tgl.Dibuat</b></h5></th>
                          <th rowspan="2" class="text-center body-black" width="250"><h5 style="padding-top: 10px;"><b>Nama Barang</b></h5></th>
                          <th rowspan="2" class="text-center body-black" width="200"><h5 style="padding-top: 10px;"><b>Jenis</b></h5></th>
                          <th rowspan="2" class="text-center body-black" width="200"><h5 style="padding-top: 10px;"><b>Sub Jenis</b></h5></th>
                          <th colspan="2" class="text-center body-black" height="30" style="font-size: 14px;"><b>Jumlah</b></th>
                        </tr>
                        <tr style="background-color: #ddd;">
                          <td class="text-center body-black" height="30" width="100" style="font-size: 14px;"><b>Qty Bon</b></td>
                          <td class="text-center body-black" width="100" style="font-size: 14px;"><b>Satuan</b></td>
                        </tr>
                        <!-- / Header -->

                        <!-- Record -->
                        <?php foreach ($ambil_po as $key => $value): ?>
                          <?php if (!empty($value['konfirmasi_ttd'])): ?>
                            <tr>
                              <td class="text-center body-black" height="30" style="font-size: 14px;"><?php echo $value['no_bon']; ?></td>
                              <td class="text-center body-black" style="font-size: 14px;" width="100"><?php echo $value['tgl_dibuat']; ?></td>
                              <td class="text-center body-black" style="font-size: 14px; padding-top: 25px;">
                                <ul type="square">
                                  <?php foreach ($value['kalkulasi'] as $no => $content): ?>
                                    <?php foreach ($content['barang'] as $number => $konten): ?>
                                      <li><?php echo $konten['nama_barang']; ?></li>
                                      
                                    <?php endforeach ?>
                                  <?php endforeach ?>
                                </ul>
                              </td>
                              <td class="text-center body-black" style="font-size: 14px; padding-top: 25px;">
                                <ul type="square">
                                  <?php foreach ($value['kalkulasi'] as $no => $content): ?>
                                    <?php foreach ($content['barang'] as $number => $konten): ?>
                                      <li><?php echo $konten['jenis']; ?></li>
                                      
                                    <?php endforeach ?>
                                  <?php endforeach ?>
                                </ul>
                              </td>
                              <td class="text-center body-black" style="font-size: 14px; padding-top: 25px;">
                                <ul type="square">
                                  <?php foreach ($value['kalkulasi'] as $no => $content): ?>
                                    <?php foreach ($content['barang'] as $number => $konten): ?>
                                      <li><?php echo $konten['sub_jenis']; ?></li>
                                      
                                    <?php endforeach ?>
                                  <?php endforeach ?>
                                </ul>
                              </td>
                              <td class="text-center body-black" style="font-size: 14px; padding-top: 25px;">
                                <ul type="square">
                                  <?php foreach ($value['kalkulasi'] as $no => $content): ?>
                                    <li><?php echo $content['qty_bon']; ?></li>
                                    
                                  <?php endforeach ?>
                                </ul>
                              </td>
                              <td class="text-center body-black" style="font-size: 14px; padding-top: 25px;">
                                <ul type="square">
                                  <?php foreach ($value['kalkulasi'] as $no => $content): ?>
                                    <?php foreach ($content['barang'] as $number => $konten): ?>
                                      <li><?php echo $konten['satuan']; ?></li>
                                      
                                    <?php endforeach ?>
                                  <?php endforeach ?>
                                </ul>
                              </td>
                            </tr>

                          <?php endif ?>
                        <?php endforeach ?>

                        <!-- Record -->
                      </table>
                    </div>
                  </div>
                  <!-- Tabel Kalkulasi SJM -->

                  <div class="col-xs-12">
                    <h3 class="box-title" style="font-size: 16px;"> Input Data</h3>
                  </div>

                  <div class="box-body">
                    <div class="col-xs-3">
                      <label>Nama Barang</label>
                      <select class="form-control js-example-basic-single" name="nama_barang">
                        <option value="Kosong">- Pilih -</option>
                        <?php foreach ($barang as $key => $value): ?>
                          <option value="<?php echo $value['nama_barang']; ?>"><?php echo $value['nama_barang']; ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>
                    <div class="col-xs-2">
                      <label>Qty Reject</label>
                      <input type="number" class="form-control" name="qty_reject" placeholder="0">
                    </div>
                    <div class="col-xs-12">
                      <br>
                      <label>Alasan Reject</label>  
                      <textarea class="ckeditor" id="ckeditor" name="alasan_reject" row="5"></textarea>
                    </div>
                    <div class="col-xs-12">
                      <br>
                      <button class="btn btn-primary fa fa-save" name="tambah" value="tambah" title="Simpan Data" data-content="Popover body content is set in this attribute."> Simpan Data</button>
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