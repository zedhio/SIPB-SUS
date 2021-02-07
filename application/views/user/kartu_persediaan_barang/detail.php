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
      <li class="active">Laporan</li>
      <li class="active"><a href="<?php echo base_url("user/laporan/kartu_persediaan_barang"); ?>" style="color: #777;" onclick="return confirm('Anda yakin hendak meninggalkan halaman ini?')">Kartu Persediaan Barang</a></li>
      <li class="active"><?php echo $ambil_kpb['no_kpb']; ?></li>
    </ol>
  </h5>

  <div class="row">

    <div class="col-xs-1"></div>

    <div class="col-xs-10">

      <!-- /.box-header -->
      <div class="box body-blue">
        <!-- /.box-header -->

        <div class="box-body" style="padding-top: 25px;">
          <?php $bulann = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"); ?>

          <!-- text input -->
          <div class="form-group">
            <div class="col-md-12">
              <div>
                <h3><i><b>PT. SINAR UTAMA SEJAHTERA</b></i>
                  <?php if (!empty($bulan AND $ambil_bukti_kpb)): ?>
                    <button class="btn btn-info fa fa-print hidden-print pull-right" style="font-size: 12px;" title="Cetak KPB" data-content="Popover body content is set in this attribute." onclick="window.print()"> Cetak PDF</button>
                  <?php endif ?></h3>
                </h3>
                <h3 class="text-center"><u><b>KARTU PERSEDIAAN BARANG</b></u></h3>
                <h4 class="text-center">
                  <?php if (!empty($bulan)): ?>
                    <?php echo "Bulan : ".$bulann[$bulan-1] ." / Tahun : " .$tahun; ?>
                  <?php elseif (empty($bulan)): ?>
                    <?php echo "" ?>
                  <?php endif ?>
                </h4>
                <hr>
              </div>
              <br><br>
              <div class="col-xs-4">
                <table>
                  <tr>
                    <th width="95">No.Kartu</th>
                    <td>:</td>
                    <td>&nbsp;<?php echo $ambil_kpb['no_kpb']; ?></td>
                  </tr>
                </table>
              </div>
              <div class="col-xs-4">
                <table>
                  <tr>
                    <th width="120">Jenis Barang</th>
                    <td>:</td>
                    <td>&nbsp;<?php echo $ambil_kpb['jenis']; ?></td>
                  </tr>
                </table>
              </div>
              <div class="col-xs-4">
                <table>
                  <tr>
                    <th width="110">Warna Barang</th>
                    <td>:</td>
                    <td>&nbsp;<?php echo $ambil_kpb['warna']; ?></td>
                  </tr>
                </table>
              </div>
              <div class="col-xs-4">
                <table>
                  <tr>
                    <th width="95">Kode Barang</th>
                    <td>:</td>
                    <td>&nbsp;<?php echo $ambil_kpb['kode_barang']; ?></td>
                  </tr>
                </table>
              </div>
              <div class="col-xs-4">
                <table>
                  <tr>
                    <th width="120">Sub Jenis Barang</th>
                    <td>:</td>
                    <td>&nbsp;<?php echo $ambil_kpb['sub_jenis']; ?></td>
                  </tr>
                </table>
              </div>
              <div class="col-xs-4">
                <table>
                  <tr>
                    <th width="110">Ukuran Barang</th>
                    <td>:</td>
                    <td>&nbsp;
                      <?php if (!empty($ambil_kpb['ukuran'])): ?>
                        <?php echo $ambil_kpb['ukuran']; ?>
                      <?php elseif (empty($ambil_kpb['ukuran'])): ?>
                        <?php echo "-"; ?>
                      <?php endif ?>
                    </td>
                  </tr>
                </table>
              </div>
              <div class="col-xs-4">
                <table>
                  <tr>
                    <th width="95">Nama Barang</th>
                    <td>:</td>
                    <td>&nbsp;<?php echo $ambil_kpb['nama_barang']; ?></td>
                  </tr>
                </table>
              </div>
              <div class="col-xs-8">
                <table>
                  <tr>
                    <th width="120">Satuan Barang</th>
                    <td>:</td>
                    <td>&nbsp;<?php echo $ambil_kpb['satuan']; ?></td>
                  </tr>
                </table>
              </div>

              <form method="post">
                  <div class="col-xs-2 hidden-print" style="padding-top: 10px;">
                    <label>Bulan</label>
                    <select class="form-control js-example-basic-single" name="bulan" required="">
                      <option value="">- Pilih -</option>
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
                  <div class="col-xs-2 hidden-print" style="padding-top: 10px;">
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
                  <div class="col-xs-3 hidden-print" style="padding-top: 37px;">
                    <button name="cari" value="cari" class="btn btn-primary fa fa-search" title="Cari" data-content="Popover body content is set in this attribute."> Cari</button>
                  </div>
                </form>
                <br><br>

              <div class="col-xs-12"><br>
                <table class="body-black"> 
                  <!-- <thead> -->
                    <tr>
                      <th class="text-center body-black" width="45" height="30" style="background-color: #b8c7ce;"><h5 style="padding-top: 10px;"><b>No</b></h5></th>
                      <th class="text-center body-black" width="170" style="background-color: #b8c7ce;"><h5 style="padding-top: 10px;"><b>Tanggal</b></h5></th>
                      <th class="text-center body-black" width="170" style="background-color: #b8c7ce;"><h5 style="padding-top: 10px;"><b>Nomor Bukti</b></h5></th>
                      <th class="text-center body-black" width="260" style="background-color: #b8c7ce;"><h5 style="padding-top: 10px;"><b>Keterangan</b></h5></th>
                      <th class="text-center body-black" width="150" style="background-color: #b8c7ce;"><h5 style="padding-top: 10px;"><b>Qty Masuk</b></h5></th>
                      <th class="text-center body-black" width="150" style="background-color: #b8c7ce;"><h5 style="padding-top: 10px;"><b>Qty Keluar</b></h5></th>
                      <th class="text-center body-black" width="150" style="background-color: #b8c7ce;"><h5 style="padding-top: 10px;"><b>Saldo</b></h5></th>
                    </tr>
                  <!-- </thead> -->
                  <?php 
                  $no = 1;
                  ?>
                  <!-- <tbody> -->
                    <?php if (!empty($ambil_bukti_kpb)): ?>
                    <?php foreach ($ambil_bukti_kpb as $key => $value): ?>
                      <tr>
                        <td class="text-center body-black" height="30" style="font-size: 14px;"><?php echo $no++; ?></td>
                        <td class="text-center body-black" style="font-size: 14px;"><?php echo date('d-m-Y', strtotime($value['tgl_masuk'])); ?></td>
                        <td class="text-center body-black" style="font-size: 14px;">
                          <?php if(!empty($value['no_bukti'])): ?>
                            <?php echo $value['no_bukti']; ?>
                          <?php elseif(empty($value['no_bukti'])): ?>
                            <?php echo "-"; ?>
                          <?php endif ?>
                        </td>
                        <td class="text-center body-black" style="font-size: 14px;"><?php echo strip_tags($value['keterangan']); ?></td>
                        <td class="text-center body-black" style="font-size: 14px;">
                          <?php if(!empty($value['qty_masuk'])): ?>
                            <?php echo $value['qty_masuk']; ?>
                          <?php elseif(empty($value['qty_masuk'])): ?>
                            <?php echo "-"; ?>
                          <?php endif ?>
                        </td>
                        <td class="text-center body-black" style="font-size: 14px;">
                          <?php if(!empty($value['qty_keluar'])): ?>
                            <?php echo $value['qty_keluar']; ?>
                          <?php elseif(empty($value['qty_keluar'])): ?>
                            <?php echo "-"; ?>
                          <?php endif ?>
                        </td>
                        <td class="text-center body-black" style="font-size: 14px;"><?php echo number_format($value['saldo'], 0, ",", "."); ?></td>
                      </tr>
                    <?php endforeach ?>
                  <?php elseif (empty($ambil_bukti_kpb)): ?>
                    <tr>
                      <td colspan="7" class="text-center body-black" height="30">Belum ada / tidak ditemukan transaksi</td>
                    </tr>
                    <?php endif ?>
                  <!-- </tbody> -->
                </table><br>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>