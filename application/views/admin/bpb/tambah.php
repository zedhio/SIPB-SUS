<style type="text/css">
  .body-black {
    border: 1px solid black;
  }
</style>

<section class="content">

  <h5>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url("admin/home"); ?>"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Transaksi</li>
      <li class="active"><a href="<?php echo base_url("admin/bpb/bpb"); ?>" style="color: #777;" onclick="return confirm('Anda punya perubahan yang belum disimpan; Anda yakin hendak meninggalkan halaman ini?')">Bukti Pengeluaran Barang</a></li>
      <li class="active">Tambah</li>
    </ol>
  </h5>

  <div class="row">

    <div class="col-xs-1"></div>

    <div class="col-xs-10">

      <!-- /.box-header -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title fa fa-plus"> Form Tambah Bukti Pengeluaran Barang</h3>
          <button type="button" class="close" data-dismiss="modal" onclick="history.back(-1)" title="kembali" data-content="Popover body content is set in this attribute.">&times;</button>
        </div>

        <!-- /.box-header -->
        <div class="box-body">
          <form role="form" method="POST" >

            <!-- Form Untuk Tambah -->
            <div class="col-md-12">
              <div class="form-group">
                <div class="row">

                  <?php foreach ($po as $key => $value): ?>
                    <?php if (!empty($value['count']==3) AND !empty($value['konfirmasi']=="Valid")): ?>
                      <?php if (!empty($ambil_po)): ?>
                        <div class="col-xs-12">
                          <div class="alert" style="background-color: #FAEBD7;">

                            <h5 class="text-center" style="color: red">Anda tidak bisa melakukan transaksi bpb untuk production order <u><?php echo $ambil_po['nama_po']; ?></u> dengan no <?php echo $ambil_po['no_po']; ?> dikarenakan anda sudah melakukan transaksi bpb sebelumnya.</h5>
                          </div>
                        </div>
                      <?php endif ?>
                    <?php endif ?>
                  <?php endforeach ?>

                  <div class="col-xs-12">
                    <label>No.BPB</label>
                    <input type="text" class="form-control" name="no_bpb" value="<?php echo $kode_otomatis; ?>" readonly="readonly">
                  </div>
                  <div class="col-xs-12" style="padding-top: 15px;">
                    <label>Tanggal Dibuat</label>
                    <input type="text" class="form-control" name="tgl_dibuat" value="<?php echo date('Y-m-d'); ?>" readonly="readonly">
                  </div>
                  <div class="col-xs-12" style="padding-top: 15px;">
                    <label>Bagian</label>
                    <input type="text" class="form-control" name="bagian" value="Sewing" readonly="readonly">
                  </div>

                  <div class="col-xs-12" style="padding-top: 15px;">
                    <label>Untuk P.O</label>
                    <select class="form-control js-example-basic-single" name="id_po" onchange="submit()">
                      <option value="Kosong">------ Pilih -----</option>
                      <?php foreach ($po as $key => $value): ?>
                        <?php if (!empty($value['count']==3)): ?>
                          <option value="<?php echo $value['id_po']; ?>" <?php if($ambil_po['id_po']==$value['id_po']){echo "selected";} ?>><?php echo $value['nama_po']; ?></option>
                        <?php endif ?>
                      <?php endforeach ?>
                    </select>
                  </div>
                  <div class="col-xs-12" style="padding-top: 15px;">
                    <label>No P.O</label>
                    <input type="text" class="form-control" value="<?php echo $ambil_po['no_po']; ?>" readonly="readonly">
                  </div>
                  <div class="col-xs-12" style="padding-top: 15px;">
                    <label>Buyer</label>
                    <input type="text" class="form-control" value="<?php echo $ambil_po['nama_buyer']; ?>" readonly="readonly">
                  </div>
                  <div class="col-xs-12" style="padding-top: 15px;">
                    <label>Style Glove</label>
                    <input type="text" class="form-control" value="<?php echo $ambil_po['nama_style']; ?>" readonly="readonly">
                  </div>
                  <div class="col-xs-12" style="padding-top: 15px;">
                    <label>Qty</label>
                    <input type="text" class="form-control" value="<?php echo $ambil_po['qty']; ?> Pcs" readonly="readonly">
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="row">
                  <div class="box-header with-border">
                    <h5 class="box-title"> Detail Record</h5>
                  </div>
                  <br>
                  <div class="col-xs-12" style="padding-top: 10px;">
                    <table class="body-black">
                      <!-- Header -->
                      <tr style="background-color: #ddd;">
                        <th rowspan="2" class="text-center body-black" width="40"><h5 style="padding-top: 10px;"><b>No</b></h5></th>
                        <th rowspan="2" class="text-center body-black" width="250"><h5 style="padding-top: 10px;"><b>Nama Barang</b></h5></th>
                        <th rowspan="2" class="text-center body-black" width="200"><h5 style="padding-top: 10px;"><b>Jenis</b></h5></th>
                        <th rowspan="2" class="text-center body-black" width="200"><h5 style="padding-top: 10px;"><b>Sub Jenis</b></h5></th>
                        <th colspan="3" class="text-center body-black" height="30" style="font-size: 14px;"><b>Jumlah</b></th>
                      </tr>
                      <tr style="background-color: #ddd">
                        <td class="text-center body-black" width="150" height="30" style="font-size: 14px;"><b>Warna</b></td>
                        <td class="text-center body-black" width="150" style="font-size: 14px;"><b>Qty</b></td>
                        <td class="text-center body-black" width="150" style="font-size: 14px;"><b>Satuan</b></td>
                      </tr>
                      <!-- / Header -->
                      <?php foreach ($ambil_bon as $key => $value): ?>
                        <?php foreach ($value['kalkulasi_bon'] as $kunci => $isi): ?>
                          <?php if (empty($isi['remaks'])): ?>
                            <tr>
                              <td class="text-center body-black" height="30" style="font-size: 14px;"><?php echo $kunci+1; ?></td>
                              <td class="text-center body-black" style="font-size: 14px;">
                                <?php foreach ($isi['barang'] as $keys => $konten): ?>
                                  <?php $nama_barang['nama_barang'] = $konten['nama_barang']; ?>
                                  <?php echo $konten['nama_barang']; ?>
                                <?php endforeach ?>
                              </td>
                              <td class="text-center body-black" style="font-size: 14px;">
                                <?php foreach ($isi['barang'] as $keys => $konten): ?>
                                  <?php echo $konten['jenis']; ?>
                                <?php endforeach ?>
                              </td>
                              <td class="text-center body-black" style="font-size: 14px;">
                                <?php foreach ($isi['barang'] as $keys => $konten): ?>
                                  <?php echo $konten['sub_jenis']; ?>
                                <?php endforeach ?>
                              </td>
                              <td class="text-center body-black" style="font-size: 14px;">
                                <?php foreach ($isi['barang'] as $keys => $konten): ?>
                                  <?php if (!empty($konten['warna'])): ?>
                                    <?php echo $konten['warna']; ?>
                                  <?php elseif (empty($konten['warna'])): ?>
                                    <?php echo "-"; ?>
                                  <?php endif ?>
                                <?php endforeach ?>
                              </td>
                              <td class="text-center body-black" style="font-size: 14px;">
                                <?php $total = 0; ?>
                                <?php if ($nama_barang['nama_barang']==$ambil_reject['nama_barang']): ?>
                                  <?php echo $total = $isi['qty_bon']; ?> 
                                <?php else: ?>                        
                                  <?php echo $isi['qty_bon']; ?>                        
                                <?php endif ?>
                              </td>
                              <td class="text-center body-black" style="font-size: 14px;">
                                <?php foreach ($isi['barang'] as $keys => $konten): ?>
                                  <?php echo $konten['satuan']; ?>
                                <?php endforeach ?>
                              </td>
                            </tr>
                          <?php endif ?>
                        <?php endforeach ?>
                      <?php endforeach ?>
                      <!-- Record -->
                    </table>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="row">
                  <div class="col-xs-12">
                    <?php foreach ($po as $key => $value): ?>
                      <?php if (!empty($value['count']==3) AND !empty($value['konfirmasi']=="Valid")): ?>
                        <button class="btn btn-primary fa fa-save" name="simpan1" value="simpan1" title="Simpan Data" data-content="Popover body content is set in this attribute." disabled=""> Simpan Data</button>
                      <?php elseif (!empty($value['count']==3) AND empty($value['konfirmasi']=="Valid")): ?>
                        <button class="btn btn-primary fa fa-save" name="simpan1" value="simpan1" title="Simpan Data" data-content="Popover body content is set in this attribute."> Simpan Data</button>
                      <?php endif ?>
                    <?php endforeach ?>
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