<!-- ======================================== css ======================================== -->
<style>
  @media print{
    .col-md-3
    {
      width: 30%;
      float: left;
    }
    .col-md-9
    {
      width: 70%;
      float: left;
    }
  }
</style>

<style type="text/css">
  .body-blue {
    border: 1px solid #3c8dbc;
  }
</style>

<style type="text/css">
  .body-black {
    border: 1px solid black;
  }
</style>
<!-- ======================================== css ======================================== -->

<section class="content">

<!-- ======================================== Penanda Halaman ======================================== -->
  <h5 class="hidden-print">
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url("user/home"); ?>"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Transaksi</li>
      <li class="active"><a href="<?php echo base_url("admin/bon/bon"); ?>" style="color: #777;" onclick="return confirm('Anda yakin hendak meninggalkan halaman ini?')">BON Pengeluaran Barang</a></li>
      <li class="active">Detail</li>
    </ol>
  </h5>
  <!-- ======================================== Penanda Halaman ======================================== -->

  <div class="row">

    <div class="col-xs-1"></div>

    <div class="col-xs-10">

      <!-- /.box-header -->
      <div class="box body-blue">
        <!-- /.box-header -->

        <div class="box-body" style="padding-top: 25px;">
          <!-- text input -->
          <div class="form-group">
            <div class="col-md-12">
              <div>
                <h3><i><b>PT. SINAR UTAMA SEJAHTERA</b></i></h3>
                <h3 class="text-center"><u><b>BON PENGELUARAN BARANG</b></u></h3>
                <hr>
              </div>
              <br><br>
              <div class="col-xs-12" style="padding-left: 450px;">
                <table>
                  <tr>
                    <th width="85" style="font-size: 15px;">Style Glove</th>
                    <td>:</td>
                    <td style="font-size: 15px;">&nbsp; <?php echo $ambil_bon['nama_style']; ?></td>
                  </tr>
                </table>
              </div>
              <div class="col-xs-12" style="padding-left: 450px;">
                <table>
                  <tr>
                    <th width="85" style="font-size: 15px;">Qty</th>
                    <td>:</td>
                    <td style="font-size: 15px;">&nbsp; <?php echo $ambil_bon['qty']; ?></td>
                  </tr>
                </table>
              </div>
              <div class="col-xs-3" style="padding-top: 40px;padding-left: 40px;">
                <table>
                  <tr>
                    <th width="50">Bagian</th>
                    <td>:</td>
                    <td>&nbsp; Unit Sewing</td>
                  </tr>
                </table>
              </div>
              <div class="col-xs-3" style="padding-top: 40px;padding-left: 20px;">
                <table>
                  <tr>
                    <th width="50">Buyer</th>
                    <td>:</td>
                    <td>&nbsp; <?php echo $ambil_bon['nama_buyer']; ?></td>
                  </tr>
                </table>
              </div>
              <div class="col-xs-3" style="padding-top: 40px;padding-left: 0px;">
                <table>
                  <tr>
                    <th width="30">P.O</th>
                    <td>:</td>
                    <td>&nbsp; <?php echo $ambil_bon['nama_po']; ?></td>
                  </tr>
                </table>
              </div>
              <div class="col-xs-3" style="padding-top: 40px;padding-left: 50px;">
                <table>
                  <tr>
                    <th width="110">Tanggal Dibuat</th>
                    <td>:</td>
                    <td>&nbsp; <?php echo $ambil_bon['tgl_dibuat']; ?></td>
                  </tr>
                </table>
              </div>

              <div class="col-xs-12"><br>
                <table class="body-black">
                  <!-- Header -->
                  <tr>
                    <th rowspan="2" class="text-center body-black" width="40" style="background-color: #ddd;"><h5 style="padding-top: 10px;"><b>No</b></h5></th>
                    <th rowspan="2" class="text-center body-black" width="250" style="background-color: #ddd;"><h5 style="padding-top: 10px;"><b>Nama Barang</b></h5></th>
                    <th rowspan="2" class="text-center body-black" width="180" style="background-color: #ddd;"><h5 style="padding-top: 10px;"><b>Jenis</b></h5></th>
                    <th rowspan="2" class="text-center body-black" width="180" style="background-color: #ddd;"><h5 style="padding-top: 10px;"><b>Sub Jenis</b></h5></th>
                    <th colspan="3" class="text-center body-black" height="30" style="font-size: 14px; background-color: #ddd;"><b>Jumlah</b></th>
                  </tr>
                  <tr>
                    <td class="text-center body-black" width="100" height="30" style="font-size: 14px; background-color: #ddd;"><b>Qty Bon</b></td>
                    <td class="text-center body-black" width="100" style="font-size: 14px; background-color: #ddd;"><b>Satuan</b></td>
                    <td class="text-center body-black" width="300" style="font-size: 14px; background-color: #ddd;"><b>Remaks</b></td>
                  </tr>
                  <!-- / Header -->

                  <!-- Record -->
                  <?php foreach ($ambil_kalkulasi as $key => $value): ?>
                    <tr>
                      <td class="text-center body-black" height="30" style="font-size: 14px;"><?php echo $key+1; ?></td>
                      <td class="text-center body-black" style="font-size: 14px;">
                        <?php foreach ($value['barang'] as $no => $content): ?>
                          <?php echo $content['nama_barang']; ?>
                        <?php endforeach ?>
                      </td>
                      <td class="text-center body-black" style="font-size: 14px;">
                        <?php foreach ($value['barang'] as $no => $content): ?>
                          <?php echo $content['jenis']; ?>
                        <?php endforeach ?>
                      </td>
                      <td class="text-center body-black" style="font-size: 14px;">
                        <?php foreach ($value['barang'] as $no => $content): ?>
                          <?php echo $content['sub_jenis']; ?>
                        <?php endforeach ?>
                      </td>
                      <td class="text-center body-black" style="font-size: 14px;"><?php echo $value['qty_bon']; ?></td>
                      <td class="text-center body-black" style="font-size: 14px;">
                        <?php foreach ($value['barang'] as $no => $content): ?>
                          <?php echo $content['satuan']; ?>
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

                <!-- Ttd -->
                <div class="col-xs-4" style="padding-top: 20px;">
                  <div class="text-center hidden">
                    <label>Mengetahui</label>
                    <div>
                      <img width="100">
                      <br><br><br><br><br>
                    </div>
                    <u>Ribut</u>
                  </div>
                </div>
                <div class="col-xs-4" style="padding-top: 20px;">
                  <div class="text-center hidden">
                    <label>Mengetahui</label>
                    <div>
                      <img src="" width="100">
                    </div>
                    <u>Ribut</u>
                  </div>
                </div>
                <div class="col-xs-4" style="padding-top: 20px;">
                  <?php if (empty($ambil_bon['konfirmasi_ttd'])): ?>
                    <div class="text-center">
                      <label>Yang Meminta</label>
                      <div>
                        <img width="100">
                        <br><br><br><br><br>
                      </div>
                      <u>Sulistyawati</u>
                    </div>
                  <?php elseif (!empty($ambil_bon['konfirmasi_ttd'])): ?>
                    <div class="text-center">
                      <label>Yang Meminta</label>
                      <div>
                        <img src="<?php echo base_url("assets/images/ttd/ttd_rolisa.jpg"); ?>" width="100">
                      </div>
                      <u>Sulistyawati</u>
                    </div><br>
                  <?php endif ?>
                </div>
                <!-- Ttd -->

                <!-- <div class="col-xs-12" style="padding-top: 30px;">
                  <button class="btn btn-primary fa fa-print hidden-print" onclick="window.print()"> Cetak PDF</button>
                </div> -->
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
</section>