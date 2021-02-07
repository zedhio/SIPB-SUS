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
      <li class="active">Laporan</li>
      <li class="active"><a href="<?php echo base_url("user/laporan/lpb"); ?>" style="color: #777;" onclick="return confirm('Anda yakin hendak meninggalkan halaman ini?')">Laporan Penerimaan Barang</a></li>
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
                <h3><i><b>PT. SINAR UTAMA SEJAHTERA</b></i>
                  <?php if (!empty($ambil_lpb['konfirmasi_ttd']) AND $detail['status_pengajuan']=="Disetujui"): ?>
                    <button class="btn btn-info fa fa-print hidden-print pull-right" style="font-size: 12px;" title="Cetak KPB" data-content="Popover body content is set in this attribute." onclick="window.print()"> Cetak PDF</button>
                  <?php endif ?>
                </h3>
                <h3 class="text-center"><u><b>LAPORAN PENERIMAAN BARANG</b></u></h3>
                <hr>
              </div>
              <br><br>
              <div class="col-xs-4">
                <table>
                  <tr>
                    <th width="150">No.LPB</th>
                    <td>:</td>
                    <td>&nbsp;<?php echo $ambil_lpb['no_lpb']; ?></td>
                  </tr>
                </table>
              </div>
              <div class="col-xs-4">
                <table>
                  <tr>
                    <th width="130">Tanggal Dibuat</th>
                    <td>:</td>
                    <td>&nbsp;<?php echo date('d-m-Y', strtotime($ambil_lpb['tgl_dibuat'])); ?></td>
                  </tr>
                </table>
              </div>
              <div class="col-xs-4">
                <table>
                  <tr>
                    <th width="130">No.Purchase Order</th>
                    <td>:</td>
                    <td>&nbsp;<?php echo $ambil_lpb['no_purchase_order']; ?></td>
                  </tr>
                </table>
              </div>
              <div class="col-xs-4">
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
              <div class="col-xs-4">
                <table>
                  <tr>
                    <th width="130">Supplier</th>
                    <td>:</td>
                    <td>&nbsp;<?php echo $ambil_lpb['nama_supplier']; ?></td>
                  </tr>
                </table>
              </div>
              <div class="col-xs-4">
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
              <div class="col-xs-12">
                <table>
                  <tr>
                    <th width="150">Keterangan</th>
                    <td>:</td>
                    <td style="padding-left: 5px;padding-bottom: 9px;">&nbsp;<?php echo strip_tags($ambil_lpb['keterangan']); ?></td>
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
                    <td class="text-center" width="100" style="font-size: 14px;"><b>Qty Barang</b></td>
                    <td class="text-center" width="100" style="font-size: 14px;"><b>Satuan</b></td>
                    <td class="text-center" width="300" style="font-size: 14px;"><b>Ukuran</b></td>
                  </tr>
                  <!-- / Header -->

                  <!-- Record -->
                  <?php foreach ($ambil_kalkulasi as $key => $value): ?>
                    <tr>
                      <td class="text-center" style="font-size: 14px;"><?php echo $key+1; ?></td>
                      <td class="text-center" style="font-size: 14px;"><?php echo $value['nama_barang']; ?></td>
                      <td class="text-center" style="font-size: 14px;"><?php echo $value['jenis']; ?></td>
                      <td class="text-center" style="font-size: 14px;"><?php echo $value['sub_jenis']; ?></td>
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
                  <?php endforeach ?>
                  <tr>
                    <td colspan="4" class="text-center" style="font-size: 14px;"><b>Qty Total</b></td>
                    <td colspan="3" class="text-center" style="font-size: 14px;"><?php echo $value['qty_total']; ?></td>
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
                        <img src="<?php echo base_url("assets/images/ttd/ttd_okta.png"); ?>" width="100">
                      </div>
                      <u>Okta</u>
                    </div>
                  <?php endif ?>
                </div>
                <div class="col-xs-6" style="padding-top: 20px;">
                  <?php if (empty($detail['status_pengajuan'])): ?>
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
                        <img src="<?php echo base_url("assets/images/ttd/ttd_rolisa.png"); ?>" width="100">
                      </div>
                      <u>Rolisa Sutanti</u>
                    </div>
                  <?php endif ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>