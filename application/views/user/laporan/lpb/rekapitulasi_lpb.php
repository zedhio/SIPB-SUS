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
      <li class="active"><a href="<?php echo base_url("user/laporan/lpb"); ?>" style="color: #777;">Laporan Penerimaan Barang</a></li>
      <li class="active"><a href="<?php echo base_url("user/laporan/lpb/rekapitulasi_lpb"); ?>" style="color: #777;">Rekapitulasi LPB</a></li>
    </ol>
  </h5>

  <div class="row">

    <div class="col-xs-12">

      <!-- /.box-header -->
      <div class="box body-blue">
        <!-- /.box-header -->
        <?php $bulann = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"); ?>

        <div class="box-body" style="padding-top: 25px;">
          <!-- text input -->
          <div class="form-group">
            <div class="col-md-12">
              <div>
                <h3><i><b>PT. SINAR UTAMA SEJAHTERA</b></i>
                  <?php if (!empty($bulan AND $rekap_lpb)): ?>
                    <button class="btn btn-info fa fa-print hidden-print pull-right" style="font-size: 12px;" title="Cetak LPB" data-content="Popover body content is set in this attribute." onclick="window.print()"> Cetak PDF</button>
                  <?php endif ?>
                </h3>
                <h3 class="text-center"><u><b>REKAPITULASI LAPORAN PENERIMAAN BARANG</b></u></h3>
                <h4 class="text-center">
                  <?php if (!empty($bulan)): ?>
                    <?php echo "Bulan : ".$bulann[$bulan-1] ." / Tahun : " .$tahun; ?>
                  <?php elseif (empty($bulan)): ?>
                    <?php echo "" ?>
                  <?php endif ?>
                </h4>
              </div>
              <br><br>
              <form method="post">
                <div class="col-xs-3 hidden-print">
                  <label>Bulan</label>
                  <select class="form-control js-example-basic-single" name="bulan" required="">
                    <option value="">----- Pilih -----</option>
                    <?php
                    $bulan = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
                    $jml_bln = count($bulan);
                    $nomer=0;
                    for($c=0; $c<$jml_bln; $c++)
                    {
                      $nomer+=1;
                      echo"<option value=$nomer> $bulan[$c] </option>";
                    }
                    ?>
                  </select>
                </div>
                <div class="col-xs-3 hidden-print">
                  <label>Tahun</label>
                  <select class="form-control js-example-basic-single" name="tahun" required="">
                    <option value="">- Pilih -</option>
                    <?php
                    $sekarang=2018;
                    for ($i=$sekarang; $i<=$sekarang +5 ; $i++)
                      echo "<option value=$i>$i<br>";
                    ?>
                  </select>
                </div>
                <div class="col-xs-3 hidden-print" style="padding-top: 27px;">
                  <button name="cari" value="cari" class="btn btn-primary fa fa-search" title="Cari" data-content="Popover body content is set in this attribute."> Cari</button>
                </div>
              </form>
              <div class="col-xs-12"><br>

                <table class="table table-bordered table-striped"> 

                  <tr>
                    <th class="text-center" width="30"><h5 style="padding-top: 10px;"><b>No</b></h5></th>
                    <th class="text-center"><h5 style="padding-top: 10px;"><b>Tanggal Dibuat</b></h5></th>
                    <th class="text-center"><h5 style="padding-top: 10px;"><b>Nama Barang</b></h5></th>
                    <th class="text-center"><h5 style="padding-top: 10px;"><b>Qty</b></h5></th>
                    <th class="text-center"><h5 style="padding-top: 10px;"><b>No.Purchase Order</b></h5></th>
                    <th class="text-center"><h5 style="padding-top: 10px;"><b>Supplier</b></h5></th>
                    <th class="text-center"><h5 style="padding-top: 10px;"><b>Keterangan</b></h5></th>
                    <th class="text-center"><h5 style="padding-top: 10px;"><b>No.LPB</b></h5></th>
                  </tr>

                  <?php if (!empty($rekap_lpb)): ?>
                    <?php foreach ($rekap_lpb as $key => $value): ?>
                      <?php if (!empty($value['status_pengajuan']=="Disetujui")): ?>
                        <tr>
                          <td class="text-center" style="font-size: 14px;"><?php echo $key+1; ?></td>
                          <td class="text-center" style="font-size: 14px;"><?php echo date('d-m-Y', strtotime($value['tgl_dibuat'])); ?></td>
                          <td class="text-center" style="font-size: 14px;">
                            <ul type="square">
                              <?php foreach ($value['validasi'] as $no => $isi): ?>
                                <li>
                                  <?php echo $isi['nama_barang']; ?>
                                </li>
                                <br>
                              <?php endforeach ?>
                            </ul>
                          </td>
                          <td class="text-center" style="font-size: 14px;">
                            <ul type="square">
                              <?php foreach ($value['validasi'] as $no => $isi): ?>
                                <li>
                                  <?php echo $isi['qty_sjm']; ?>
                                </li>
                                <br>
                              <?php endforeach ?>
                            </ul>
                          </td>
                          <td class="text-center" style="font-size: 14px;">
                            <ul type="square">
                              <?php foreach ($value['validasi'] as $no => $isi): ?>
                                <li>
                                  <?php echo $isi['no_purchase_order']; ?>
                                </li>
                                <br>
                              <?php endforeach ?>
                            </ul>
                          </td>
                          <td class="text-center" style="font-size: 14px;">
                            <ul type="square">
                              <?php foreach ($value['validasi'] as $no => $isi): ?>
                                <li>
                                  <?php echo $isi['nama_supplier']; ?>
                                </li>
                                <br>
                              <?php endforeach ?>
                            </ul>
                          </td>
                          <td class="text-center" style="font-size: 14px;">
                            <ul type="square">
                              <?php foreach ($value['validasi'] as $no => $isi): ?>
                                <li>
                                  <?php echo strip_tags($isi['keterangan']); ?>
                                </li>
                                <br>
                              <?php endforeach ?>
                            </ul>
                          </td>
                          <td class="text-center" style="font-size: 14px;">
                            <ul type="square">
                              <?php foreach ($value['validasi'] as $no => $isi): ?>
                                <li>
                                  <?php echo $isi['no_lpb']; ?>
                                </li>
                                <br>
                              <?php endforeach ?>
                            </ul>
                          </td>
                        </tr>
                      <?php endif ?>
                    <?php endforeach ?>
                  <?php elseif (empty($rekap_lpb)): ?>
                    <tr>
                    <td colspan="8" class="text-center">Belum ada / tidak ditemukan laporan</td>
                    </tr>
                  <?php endif ?>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>