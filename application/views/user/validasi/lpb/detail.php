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

<section class="content">

  <h5 class="hidden-print">
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url("user/home"); ?>"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Validasi</li>
      <li class="active"><a href="<?php echo base_url("user/validasi/lpb"); ?>" style="color: #777;" onclick="return confirm('Anda yakin hendak meninggalkan halaman ini?')">Laporan Penerimaan Barang</a></li>
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
                <h3 class="text-center"><u><b>LAPORAN PENERIMAAN BARANG</b></u></h3>
                <hr>
              </div>
              <br><br>
              <div class="col-xs-4" style="padding-left: 50px;">
                <table>
                  <tr>
                    <th width="150">No.LPB</th>
                    <td>:</td>
                    <td>&nbsp;<?php echo $ambil_lpb['no_lpb']; ?></td>
                  </tr>
                </table>
              </div>
              <div class="col-xs-4" style="padding-left: 50px;">
                <table>
                  <tr>
                    <th width="130">Tanggal Dibuat</th>
                    <td>:</td>
                    <td>&nbsp;<?php echo $ambil_lpb['tgl_dibuat']; ?></td>
                  </tr>
                </table>
              </div>
              <div class="col-xs-4" style="padding-left: 50px;">
                <table>
                  <tr>
                    <th width="130">No.Purchase Order</th>
                    <td>:</td>
                    <td>&nbsp;
                      <?php if (!empty($ambil_lpb['no_purchase_order'])): ?>
                        <?php echo $ambil_lpb['no_purchase_order']; ?>
                      <?php elseif (empty($ambil_lpb['no_purchase_order'])): ?>
                        <?php echo "<button class='btn btn-default'>Mohon Diisi</button>"; ?>
                      <?php endif ?>
                    </td>
                  </tr>
                </table>
              </div>
              <div class="col-xs-4" style="padding-left: 50px;">
                <table>
                  <tr>
                    <th width="150">No.Surat Jalan Masuk</th>
                    <td>:</td>
                    <td>&nbsp;
                      <?php if (!empty($ambil_lpb['no_sjm'])): ?>
                        <?php echo $ambil_lpb['no_sjm']; ?>
                      <?php elseif (empty($ambil_lpb['no_sjm'])): ?>
                        <?php echo "-"; ?>
                      <?php endif ?>
                    </td>
                  </tr>
                </table>
              </div>
              <div class="col-xs-4" style="padding-left: 50px;">
                <table>
                  <tr>
                    <th width="130">Supplier</th>
                    <td>:</td>
                    <td>&nbsp;<?php echo $ambil_lpb['nama_supplier']; ?></td>
                  </tr>
                </table>
              </div>
              <div class="col-xs-4" style="padding-left: 50px;">
                <table>
                  <tr>
                    <th width="130">No.Kendaraan</th>
                    <td>:</td>
                    <td>&nbsp;
                      <?php if (!empty($ambil_lpb['no_kendaraan'])): ?>
                        <?php echo $ambil_lpb['no_kendaraan']; ?>
                      <?php elseif (empty($ambil_lpb['no_kendaraan'])): ?>
                        <?php echo "-"; ?>
                      <?php endif ?>
                    </td>
                  </tr>
                </table>
              </div>
              <div class="col-xs-12" style="padding-left: 50px;">
                <table>
                  <tr>
                    <th width="150">Keterangan</th>
                    <td>:</td>
                    <td style="padding-left: 5px;padding-bottom: 9px;">&nbsp;<?php echo strip_tags($ambil_lpb['keterangan']); ?></td>
                  </tr>
                </table>
              </div>

              <?php if (!empty($detail['alasan'])): ?>
              <div class="col-xs-12" style="padding-left: 50px; padding-top: 30px; color: red;">
                <table>
                  <tr>
                    <td style="color: red;"><span class="fa fa-warning"></span> Hasil Pengajuan Ditolak Kepala Divisi Purchase Order dengan alasan <?php echo $detail['alasan']; ?></td>
                  </tr>
                </table>
              </div>
              <?php endif ?>

              <div class="col-xs-12" style="padding-bottom: 25px;"><br>
                <table style="margin-left: 35px; margin-right: 35px;">
                  <!-- Header -->
                  <tr align="center">
                    <th rowspan="2" class="text-center body-black" width="30"><h5 style="padding-top: 10px;"><b>No</b></h5></th>
                    <th rowspan="2" class="text-center body-black" width="250"><h5 style="padding-top: 10px;"><b>Nama Barang</b></h5></th>
                    <th rowspan="2" class="text-center body-black" width="200"><h5 style="padding-top: 10px;"><b>Jenis</b></h5></th>
                    <th rowspan="2" class="text-center body-black" width="200"><h5 style="padding-top: 10px;"><b>Sub Jenis</b></h5></th>
                    <th colspan="3" class="text-center body-black" height="30" style="font-size: 14px;"><b>Jumlah</b></th>
                  </tr>
                  <tr>
                    <td class="text-center body-black" width="100" height="30" style="font-size: 14px;"><b>Qty Barang</b></td>
                    <td class="text-center body-black" width="100" style="font-size: 14px;"><b>Satuan</b></td>
                    <td class="text-center body-black" width="300" style="font-size: 14px;"><b>Ukuran</b></td>
                  </tr>
                  <!-- / Header -->

                  <!-- Record -->
                  <?php foreach ($ambil_kalkulasi as $key => $value): ?>
                    <tr>
                      <td class="text-center body-black" height="30" style="font-size: 14px;"><?php echo $key+1; ?></td>
                      <td class="text-center body-black" style="font-size: 14px;"><?php echo $value['nama_barang']; ?></td>
                      <td class="text-center body-black" style="font-size: 14px;"><?php echo $value['jenis']; ?></td>
                      <td class="text-center body-black" style="font-size: 14px;"><?php echo $value['sub_jenis']; ?></td>
                      <td class="text-center body-black" style="font-size: 14px;"><?php echo $value['qty_sjm']; ?></td>
                      <td class="text-center body-black" style="font-size: 14px;"><?php echo $value['satuan']; ?></td>
                      <td class="text-center body-black" style="font-size: 14px;">
                        <?php if (!empty($value['ukuran'])): ?>
                          <?php echo $value['ukuran']; ?>
                        <?php elseif (empty($value['ukuran'])): ?>
                          <?php echo "-"; ?>
                        <?php endif ?>
                      </td>
                    </tr>
                  <?php endforeach ?>
                  <tr>
                    <td colspan="4" class="text-center body-black" height="30" style="font-size: 14px;"><b>Qty Total</b></td>
                    <td colspan="3" class="text-center body-black" style="font-size: 14px;"><?php echo $value['qty_total']; ?></td>
                  </tr>
                  <!-- Record -->
                </table>
                <div class="col-xs-6" style="padding-top: 20px;">
                  <?php if (empty($ambil_lpb['konfirmasi_ttd'])): ?>
                    <div class="text-center">
                      <label>Mengetahui</label>
                      <div>
                        <img width="100">
                        <br><br><br><br><br>
                      </div>
                      <u>Okta</u>
                    </div>
                  <?php elseif (!empty($ambil_lpb['konfirmasi_ttd'])): ?>
                    <div class="text-center">
                      <label>Mengetahui</label>
                      <div>
                        <img src="<?php echo base_url("assets/images/ttd/ttd_okta.jpg"); ?>" width="100">
                      </div>
                      <u>Okta</u>
                    </div>
                  <?php endif ?>
                </div>
                <div class="col-xs-6" style="padding-top: 20px;">
                  <?php if (empty($detail['status_pengajuan']) OR $detail['status_pengajuan']=="Ditolak"): ?>
                    <div class="text-center">
                      <label>Diterima / Disetujui</label>
                      <div>
                        <img width="100">
                        <br><br><br><br><br>
                      </div>
                      <u>Rolisa Sutanti</u>
                    </div>
                  <?php elseif (!empty($detail['status_pengajuan']=="Disetujui")): ?>
                    <div class="text-center">
                      <label>Diterima / Disetujui</label>
                      <div>
                        <img src="<?php echo base_url("assets/images/ttd/ttd_rolisa.jpg"); ?>" width="100">
                      </div>
                      <u>Rolisa Sutanti</u>
                    </div>
                  <?php endif ?>
                </div>
                <!-- <?php //if (!empty($ambil_lpb['konfirmasi']) AND $detail['status_pengajuan']=="Disetujui"): ?>
                  <div class="col-xs-12" style="padding-top: 30px;">
                    <button class="btn btn-primary fa fa-print hidden-print" onclick="window.print()"> Cetak PDF</button>
                  </div>
                // <?php //endif ?> -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>