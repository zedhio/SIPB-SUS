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

      <?php if($_SESSION['user']['level']=="Staff PPIC"): ?>
        <li><a href="<?php echo base_url("user/home"); ?>"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Transaksi</li>
        <li class="active"><a href="<?php echo base_url("user/production_order/production_order"); ?>" style="color: #777;">Production Order</a></li>
        <li class="active"><a href="<?php echo base_url("user/rekapitulasi_production_order/rekapitulasi_production_order"); ?>" style="color: #777;">Rekapitulasi</a></li>

      <?php elseif($_SESSION['user']['level']=="Staff Unit Sewing" OR $_SESSION['user']['level']=="Kepala Unit Sewing" OR $_SESSION['user']['level']=="Kepala Divisi EXIM" OR $_SESSION['user']['level']=="Kepala Divisi Accounting" OR $_SESSION['user']['level']=="Kepala Divisi Hutang Dagang" OR $_SESSION['user']['level']=="Kepala Divisi Purchase Order" OR $_SESSION['user']['level']=="Direktur" OR $_SESSION['user']['level']=="Kepala Divisi Production Manager" OR $_SESSION['user']['level']=="Kepala Gudang "): ?>
        <li><a href="<?php echo base_url("user/home"); ?>"><i class="fa fa-home"></i> Home</a></li>
        <li class="active"><a href="<?php echo base_url("user/rekapitulasi_production_order/rekapitulasi_production_order"); ?>" style="color: #777;">Rekap.PO</a></li>

      <?php endif ?>

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
                </h3>
                <h3 class="text-center"><u><b>REKAPITULASI PRODUCTION ORDER</b></u></h3>
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
                <div class="col-xs-2 hidden-print">
                  <label>Bulan</label>
                  <select class="form-control js-example-basic-single" name="bulan" required="">
                    <option value="">- Pilih -</option>
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
                <div class="col-xs-2 hidden-print">
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
                <div class="col-xs-5 hidden-print" style="padding-top: 27px; padding-left: 477px;">
                  <?php if (!empty($bulan) AND !empty($tahun)): ?>
                    <button class="btn btn-info fa fa-print hidden-print" style="font-size: 12px;" title="Cetak Rekapitulasi Production Order" data-content="Popover body content is set in this attribute." onclick="window.print();"> Cetak</button>
                  <?php endif ?>
                </div>

              </form>

              <div class="col-xs-12"><br>

                <table class="body-black">
                  <tr>
                    <th class="text-center body-black" width="45" style="background-color: #B8C7CE"><h5 style="padding-top: 10px;"><b>No</b></h5></th>
                    <th class="text-center body-black" width="250" style="background-color: #B8C7CE"><h5 style="padding-top: 10px;"><b>Arrival Order</b></h5></th>
                    <th class="text-center body-black" width="150" style="background-color: #B8C7CE"><h5 style="padding-top: 10px;"><b>Tanggal</b></h5></th>
                    <th class="text-center body-black" width="250" style="background-color: #B8C7CE"><h5 style="padding-top: 10px;"><b>Style</b></h5></th>
                    <th class="text-center body-black" width="100" style="background-color: #B8C7CE"><h5 style="padding-top: 10px;"><b>Qty</b></h5></th>
                    <th class="text-center body-black" width="380" style="background-color: #B8C7CE"><h5 style="padding-top: 10px;"><b>Keterangan</b></h5></th>
                    <th class="text-center body-black" width="150" style="background-color: #B8C7CE"><h5 style="padding-top: 10px;"><b>Ship Date</b></h5></th>
                  </tr>

                  <?php $no = 1; ?>

                  <?php foreach ($rekap_po as $key => $value): ?>
                    <?php foreach ($value['po'] as $number => $content): ?>
                      <?php if ($content['jml_disetujui']==3): ?>
                        <tr>
                          <td rowspan="2" class="body-black text-center"><?php echo $no++; ?></td>
                          <td rowspan="2" class="body-black text-center"><?php echo $value['nama_buyer']; ?></td>
                          <td class="body-black text-center" height="30">
                            <!-- <ul type="square"> -->
                            <?php foreach ($value['po'] as $no => $isi): ?>
                              <?php if ($isi['jml_disetujui']==3): ?>
                                <!-- <li> -->
                                <?php echo $isi['tgl_order']; ?>
                                <!-- </li> -->
                                <br>
                              <?php endif ?>
                            <?php endforeach ?>
                            <!-- </ul> -->
                          </td>
                          <td class="body-black text-center">
                            <!-- <ul type="square"> -->
                            <?php foreach ($value['po'] as $no => $isi): ?>
                              <?php if ($isi['jml_disetujui']==3): ?>
                                <!-- <li> -->
                                <?php echo $isi['nama_style']; ?>
                                <!-- </li> -->
                                <br>
                              <?php endif ?>
                            <?php endforeach ?>
                          </ul>
                        </td>
                        <td class="body-black text-center">
                          <!-- <ul type="square"> -->
                          <?php foreach ($value['po'] as $no => $isi): ?>
                            <?php if ($isi['jml_disetujui']==3): ?>
                              <!-- <li> -->
                              <?php echo $isi['qty']; ?>
                              <!-- </li> -->
                              <br>
                            <?php endif ?>
                          <?php endforeach ?>
                          <!-- </ul> -->
                        </td>
                        <td class="body-black text-center">
                          <!-- <ul type="square"> -->
                          <?php foreach ($value['po'] as $no => $isi): ?>
                            <?php if ($isi['jml_disetujui']==3): ?>
                              <!-- <li> -->
                              -
                              <!-- </li> -->
                            <?php endif ?>
                          <?php endforeach ?>
                          <!-- </ul> -->
                        </td>
                        <td class="body-black text-center">
                          <!-- <ul type="square"> -->
                          <?php foreach ($value['po'] as $no => $isi): ?>
                            <?php if ($isi['jml_disetujui']==3): ?>
                              <!-- <li> -->
                              <?php echo $isi['tgl_kirim']; ?>
                              <!-- </li> -->
                            <?php endif ?>
                          <?php endforeach ?>
                          <!-- </ul> -->
                        </td>
                      </tr>

                      <tr>
                        <td colspan="2" height="30" class="body-black text-center">Qty Total</td>
                        <td class="text-center body-black">
                          <?php 
                          $total = 0;
                          ?>
                          <?php foreach ($value['po'] as $no => $isi): ?>
                            <?php if ($isi['jml_disetujui']==3): ?>
                              <?php 
                              $total+=$isi['qty']; 
                              ?>
                            <?php endif ?>
                          <?php endforeach ?>
                          <?php echo $total; ?>
                        </td>
                        <td colspan="2" class="body-black"></td>
                      </tr>
                    <?php endif ?>
                  <?php endforeach ?>
                <?php endforeach ?>
              </table><br>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
</section>