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

<section class="content">

  <h5 class="hidden-print">
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url("user/home"); ?>"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Transaksi</li>
      <li class="active"><a href="<?php echo base_url("user/bon/bon"); ?>" style="color: #777;" onclick="return confirm('Anda yakin hendak meninggalkan halaman ini?')">BON Pengeluaran Barang</a></li>
      <li class="active">Detail</li>
    </ol>
  </h5>

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
                    <td>&nbsp; <?php echo $bagian['bagian']; ?></td>
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
              <div class="col-xs-3" style="padding-top: 40px;padding-left: 20px;">
                <table>
                  <tr>
                    <th width="30">P.O</th>
                    <td>:</td>
                    <td>&nbsp; <?php echo $ambil_bon['nama_po']; ?></td>
                  </tr>
                </table>
              </div>
              <div class="col-xs-3" style="padding-top: 40px;padding-left: 10px;">
                <table>
                  <tr>
                    <th width="140">Tanggal Dibuat BON</th>
                    <td>:</td>
                    <td>&nbsp; <?php echo $ambil_bon['tgl_dibuat']; ?></td>
                  </tr>
                </table>
              </div>

              <div class="col-xs-12"><br>
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
                    <td class="text-center" width="100" style="font-size: 14px;"><b>Qty Bon</b></td>
                    <td class="text-center" width="100" style="font-size: 14px;"><b>Satuan</b></td>
                    <td class="text-center" width="300" style="font-size: 14px;"><b>Remaks</b></td>
                  </tr>
                  <!-- / Header -->

                  <!-- <pre>
                    <?php //print_r($ambil_lpb); ?>
                  </pre> -->

                  <!-- Record -->
                  <?php foreach ($ambil_kalkulasi as $key => $value): ?>
                    <tr>
                      <td class="text-center" style="font-size: 14px;"><?php echo $key+1; ?></td>
                      <td class="text-center" style="font-size: 14px;"><?php echo $value['nama_barang']; ?></td>
                      <td class="text-center" style="font-size: 14px;"><?php echo $value['jenis']; ?></td>
                      <td class="text-center" style="font-size: 14px;"><?php echo $value['sub_jenis']; ?></td>
                      <td class="text-center" style="font-size: 14px;"><?php echo $value['qty_bon']; ?></td>
                      <td class="text-center" style="font-size: 14px;"><?php echo $value['satuan']; ?></td>
                      <td class="text-center" style="font-size: 14px;">
                        <?php if (!empty($value['remaks'])): ?>
                          <?php echo $value['remaks']; ?>
                        <?php elseif (empty($value['remaks'])): ?>
                          <?php echo "-"; ?>
                        <?php endif ?>
                      </td>
                    </tr>
                  <?php endforeach ?>
                  <tr>
                    <td colspan="4" class="text-center" style="font-size: 14px;"><b>Qty Total</b></td>
                    <td colspan="3" class="text-center" style="font-size: 14px;"><?php echo $ambil_total['qty_total']; ?></td>
                  </tr>
                  <!-- Record -->
                </table>

                <div class="col-xs-4" style="padding-top: 20px;">
                  <?php if (!empty($acc[0]['tujuan']="Kepala Divisi Purchase Order")): ?>
                    <?php if ($acc[0]['status_pengajuan']=="Disetujui"): ?>
                      <div class="text-center">
                        <label>Mengetahui</label>
                        <div>
                          <img src="<?php echo base_url("assets/images/ttd/ttd_okta.png"); ?>" width="100">
                        </div>
                        <u>Ribut</u>
                      </div>
                    <?php elseif ($acc[0]['status_pengajuan']=="Ditolak" OR empty($acc[0]['status_pengajuan'])): ?>
                      <div class="text-center">
                        <label>Mengetahui</label>
                        <div>
                          <img width="100">
                          <br><br><br><br><br>
                        </div>
                        <u>Ribut</u>
                      </div>
                    <?php endif ?>
                  <?php endif ?>
                </div>
                <div class="col-xs-4" style="padding-top: 20px;">
                  <?php if (!empty($acc[1]['tujuan']="Kepala Gudang")): ?>
                    <?php if ($acc[1]['status_pengajuan']=="Ditolak" OR empty($acc[1]['status_pengajuan'])): ?>
                      <div class="text-center">
                        <label>Kepala Gudang</label>
                        <div>
                          <img width="100">
                          <br><br><br><br><br>
                        </div>
                        <u>Oktavia</u>
                      </div>
                    <?php elseif ($acc[1]['status_pengajuan']=="Disetujui"): ?>
                      <div class="text-center">
                        <label>Kepala Gudang</label>
                        <div>
                          <img src="<?php echo base_url("assets/images/ttd/ttd_rolisa.png"); ?>" width="100">
                        </div>
                        <u>Oktavia</u>
                      </div>
                    <?php endif ?>
                  <?php endif ?>
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
                        <img src="<?php echo base_url("assets/images/ttd/ttd_rolisa.png"); ?>" width="100">
                      </div>
                      <u>Sulistyawati</u>
                    </div>
                  <?php endif ?>
                </div>
                <?php if ($acc[0]['status_pengajuan']=="Disetujui" AND $acc[1]['status_pengajuan']=="Disetujui"): ?>
                  <div class="col-xs-12" style="padding-top: 30px;">
                    <button class="btn btn-primary fa fa-print hidden-print" onclick="window.print()"> Cetak PDF</button>
                  </div>
                <?php endif ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>