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
      <li class="active"><a href="<?php echo base_url("user/bon/bon"); ?>" style="color: #777;" onclick="return confirm('Anda punya perubahan yang belum disimpan; Anda yakin hendak meninggalkan halaman ini?')">BON Pengeluaran Barang</a></li>
      <li class="active">Ubah</li>
    </ol>
  </h5>

  <div class="row">

    <div class="col-xs-1"></div>

    <div class="col-xs-10">

      <!-- /.box-header -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title fa fa-pencil"> Form Ubah BON Pengeluaran Barang</h3>
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
                    <label>No.BON</label>
                    <input type="text" class="form-control" name="no_bon" value="<?php echo $ambil_bon['no_bon']; ?>" readonly="readonly">
                  </div>
                  <div class="col-xs-12" style="padding-top: 15px;">
                    <label>Tanggal Dibuat</label>
                    <input type="text" class="form-control" name="tgl_dibuat" value="<?php echo $ambil_bon['no_bon']; ?>" readonly="readonly">
                  </div>
                  <div class="col-xs-12" style="padding-top: 15px;">
                    <label>Untuk P.O</label>
                    <select class="form-control js-example-basic-single" name="id_po" onchange="submit()">
                      <option value="Kosong">----- Pilih -----</option>
                      <?php foreach ($po as $key => $value): ?>
                        <option value="<?php echo $value['id_po']; ?>" <?php if($id_po==$value['id_po']){echo "selected";} ?>><?php echo $value['nama_po']; ?></option>
                      <?php endforeach ?>
                    </select>
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
                    <input type="text" class="form-control" value="<?php echo $ambil_po['qty']; ?>" readonly="readonly">
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="row">
                  <div class="box-header with-border">
                    <h5 class="box-title"> Input Barang</h5>
                  </div>
                  <br>
                  <div class="col-xs-2">
                    <label>Nama Barang</label>
                    <select class="form-control" name="nama_barang" id="barang" disabled="True">
                      <option value="Kosong">- Pilih -</option>
                      <?php foreach ($barang as $key => $value): ?>
                        <option value="<?php echo $value['nama_barang']; ?>"><?php echo $value['nama_barang']; ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                  <div class="col-xs-2">
                    <label>Jenis</label>
                    <input type="text" class="form-control jenis" id="jenis" name="jenis" readonly>
                  </div>
                  <div class="col-xs-2">
                    <label>Sub Jenis</label>
                    <input type="text" class="form-control subjenis" id="sub_jenis" name="sub_jenis" readonly>
                  </div>
                  <div class="col-xs-2">
                    <label>Warna</label>
                    <input type="text" class="form-control warna" id="warna" name="warna" readonly="readonly">
                  </div>
                  <div class="col-xs-2">
                    <label>Qty Yang Diminta</label>
                    <input type="number" class="form-control" id="qty_bon" name="qty_bon" readonly="readonly">
                  </div>
                  <div class="col-xs-2">
                    <label>Satuan</label>
                    <input type="text" class="form-control satuan" id="satuan" name="satuan" readonly>
                  </div>

                  <!-- Patokan menampilkan id kalkulasi -->
                  <div class="col-xs-3 hidden">
                    <label>ID Kalkulasi</label>
                    <input type="number" name="id_kalkulasi_bon" id="id_kalkulasi" class="form-control">
                  </div>
                  <!-- Patokan menampilkan id kalkulasi -->

                </div>
              </div>

              <div class="form-group">
                <div class="row">
                  <div class="col-xs-6">
                    <label>Remaks</label>
                    <input type="text" name="remaks" id="remaks" class="form-control" readonly="true">
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="row">
                  <div class="col-xs-12">
                    <button class="btn btn-default fa fa-arrow-down" id="ubah" name="ubah" value="ubah" title="Ubah Record" data-content="Popover body content is set in this attribute." disabled="disabled"> Ubah Record</button>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="row">
                  <div class="box-header with-border">
                    <h5 class="box-title"> Detail Record</h5>
                  </div>
                  <div class="col-xs-12">
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
                        <th colspan="4" class="text-center body-black" height="30" style="font-size: 14px;"><b>Jumlah</b></th>
                      </tr>
                      <tr style="background-color: #ddd;">
                        <td class="text-center body-black" width="100" height="30" style="font-size: 14px;"><b>Warna</b></td>
                        <td class="text-center body-black" width="100" style="font-size: 14px;"><b>Qty Bon</b></td>
                        <td class="text-center body-black" width="100" style="font-size: 14px;"><b>Satuan</b></td>
                        <td class="text-center body-black" width="200" style="font-size: 14px;"><b>Remaks</b></td>
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
                            <input type="radio" id="bon" data-id="<?php echo $value['id_kalkulasi_bon']; ?>"> <?php echo $no++; ?>
                          </td>
                          <td class="text-center body-black" style="font-size: 14px;">
                            <?php foreach ($value['barang'] as $kunci => $nilai): ?>
                              <?php echo $nilai['nama_barang']; ?>
                            <?php endforeach ?>
                          </td>
                          <td class="text-center body-black" style="font-size: 14px;">
                            <?php foreach ($value['barang'] as $kunci => $nilai): ?>
                              <?php echo $nilai['jenis']; ?>
                            <?php endforeach ?>
                          </td>
                          <td class="text-center body-black" style="font-size: 14px;">
                            <?php foreach ($value['barang'] as $kunci => $nilai): ?>
                              <?php echo $nilai['sub_jenis']; ?>
                            <?php endforeach ?>
                          </td>
                          <td class="text-center body-black" style="font-size: 14px;">
                            <?php foreach ($value['barang'] as $kunci => $nilai): ?>
                              <?php if (!empty($nilai['warna'])): ?>
                                <?php echo $nilai['warna']; ?>
                              <?php elseif (empty($nilai['warna'])): ?>
                                <?php echo "-"; ?>
                              <?php endif ?>
                            <?php endforeach ?>
                          </td>
                          <td class="text-center body-black" style="font-size: 14px;"><?php echo $value['qty_bon']; ?></td>
                          <td class="text-center body-black" style="font-size: 14px;">
                            <?php foreach ($value['barang'] as $kunci => $nilai): ?>
                              <?php echo $nilai['satuan']; ?>
                            <?php endforeach ?>
                          </td>
                          <td class="text-center body-black" style="font-size: 14px;">
                            <?php if (!empty($value['remaks'])): ?>
                              <?php echo $value['remaks']; ?>
                            <?php elseif (empty($value['remaks'])): ?>
                              <?php echo "-"; ?>
                            <?php endif ?>
                          </td>
                        </tr>

                      <?php endforeach ?>
                      <!-- Record -->
                    </table>
                  </div>
                </div>
              </div>
              
              <div class="form-group">
                <div class="row">
                  <div class="col-xs-12">
                    <button class="btn btn-success fa fa-pencil" name="ubah1" value="ubah1" title="Ubah Data" data-content="Popover body content is set in this attribute."> Ubah Data</button>
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