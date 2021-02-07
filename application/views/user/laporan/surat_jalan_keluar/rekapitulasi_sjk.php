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
  .body-black {
    border: 1px solid black;
  }
</style>

<section class="content">

  <h5 class="hidden-print">
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url("user/home"); ?>"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Laporan</li>
      <li class="active"><a href="<?php echo base_url("user/laporan/surat_jalan_keluar"); ?>" style="color: #777;">Laporan Surat Jalan Keluar</a></li>
      <li class="active"><a href="<?php echo base_url("user/laporan/surat_jalan_keluar/rekapitulasi_sjk"); ?>" style="color: #777;">Rekapitulasi Laporan Surat Jalan Keluar</a></li>
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
                  <?php if (!empty($bulan AND $rekap_sjk)): ?>
                    <button class="btn btn-info fa fa-print hidden-print pull-right" title="Cetak Rekapitulasi Laporan Surat Jalan Keluar" data-content="Popover body content is set in this attribute." onclick="window.print()" style="font-size: 14px;"> Cetak PDF</button>
                  <?php endif ?>
                </h3>
                <h3 class="text-center"><u><b>REKAPITULASI LAPORAN SURAT JALAN KELUAR</b></u></h3>
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
                  <select class="form-control js-example-basic-single" name="bulan">
                    <option>----- Pilih -----</option>
                    <?php
                    $jml_bln = count($bulann);
                    $nomer=0;
                    for($c=0; $c<$jml_bln; $c++)
                    {
                      $nomer+=1;
                      echo"<option value=$nomer> $bulann[$c] </option>";
                    }
                    ?>
                  </select>
                </div>
                <div class="col-xs-3 hidden-print">
                  <label>Tahun</label>
                  <select class="form-control js-example-basic-single" name="tahun">
                    <option>- Pilih -</option>
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
                <table class="body-black"> 

                  <tr style="background-color: #ddd;">
                    <th class="text-center body-black" width="40"><h5 style="padding-top: 10px;"><b>No</b></h5></th>
                    <th class="text-center body-black" width="200"><h5 style="padding-top: 10px;"><b>No.Surat Jalan Keluar</b></h5></th>
                    <th class="text-center body-black" width="200"><h5 style="padding-top: 10px;"><b>No.Pemeriksaan Barang</b></h5></th>
                    <th class="text-center body-black" width="150"><h5 style="padding-top: 10px;"><b>Tanggal Dibuat</b></h5></th>
                    <th class="text-center body-black" width="250"><h5 style="padding-top: 10px;"><b>Nama Barang</b></h5></th>
                    <th class="text-center body-black" width="100"><h5 style="padding-top: 10px;"><b>Qty</b></h5></th>
                    <th class="text-center body-black" width="200"><h5 style="padding-top: 10px;"><b>Keterangan</b></h5></th>
                    <th class="text-center body-black" width="200"><h5 style="padding-top: 10px;"><b>Ditujukan</b></h5></th>
                  </tr>

                  <?php if (!empty($rekap_sjk)): ?>
                  <?php foreach ($rekap_sjk as $key => $value): ?>
                    <?php if (!empty($value['status_pengajuan']=="Disetujui")): ?>
                      <tr>
                        <td class="text-center body-black" height="30" style="font-size: 14px;"><?php echo $key+1; ?></td>
                        <td class="text-center body-black" style="font-size: 14px;"><?php echo $value['no_sjk']; ?></td>
                        <td class="text-center body-black" style="font-size: 14px;"><?php echo $value['no_pemeriksaan_barang']; ?></td>
                        <td class="text-center body-black" style="font-size: 14px;"><?php echo $value['tgl_dibuat']; ?></td>
                        <td class="text-center body-black" style="font-size: 14px;"><?php echo $value['nama_barang']; ?></td>
                        <td class="text-center body-black" style="font-size: 14px;"><?php echo $value['qty_sjk']; ?></td>
                        <td class="text-center body-black" style="font-size: 14px;"><?php echo $value['tindakan']; ?></td>
                        <td class="text-center body-black" style="font-size: 14px;"><?php echo $value['validasi'][0]['nama_supplier']; ?></td>
                      </tr>
                    <?php endif ?>
                  <?php endforeach ?>
                  <?php elseif (empty($rekap_sjk)): ?>
                    <tr>
                      <td colspan="10" class="text-center">Belum ada / tidak ditemukan laporan</td>
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