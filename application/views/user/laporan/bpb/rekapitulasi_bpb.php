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
      <li class="active"><a href="<?php echo base_url("user/laporan/bpb"); ?>" style="color: #777;">Laporan Bukti Pengeluaran Barang</a></li>
      <li class="active"><a href="<?php echo base_url("user/laporan/bpb/rekapitulasi_bpb"); ?>" style="color: #777;">Rekapitulasi Laporan Bukti Pengeluaran Barang</a></li>
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
                  <?php if (!empty($bulan AND $rekap_bpb)): ?>
                    <button class="btn btn-info fa fa-print hidden-print pull-right" title="Cetak Rekapitulasi Laporan Bukti Pengeluaran Barang" data-content="Popover body content is set in this attribute." onclick="window.print()"> Cetak PDF</button>
                  <?php endif ?>
                </h3>
                <h3 class="text-center"><u><b>REKAPITULASI LAPORAN BUKTI PENGELUARAN BARANG</b></u></h3>
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
                <table class="table table-bordered table-striped"> 
                  <tr>
                    <th class="text-center" width="30"><h5 style="padding-top: 10px;"><b>No</b></h5></th>
                    <th class="text-center"><h5 style="padding-top: 10px;"><b>Tanggal Dibuat</b></h5></th>
                    <th class="text-center"><h5 style="padding-top: 10px;"><b>Nama Barang</b></h5></th>
                    <th class="text-center"><h5 style="padding-top: 10px;"><b>Qty</b></h5></th>
                    <th class="text-center"><h5 style="padding-top: 10px;"><b>No.PO</b></h5></th>
                    <th class="text-center"><h5 style="padding-top: 10px;"><b>Nama PO</b></h5></th>
                    <th class="text-center"><h5 style="padding-top: 10px;"><b>Order</b></h5></th>
                    <th class="text-center"><h5 style="padding-top: 10px;"><b>Buyer</b></h5></th>
                    <th class="text-center"><h5 style="padding-top: 10px;"><b>Style</b></h5></th>
                    <th class="text-center"><h5 style="padding-top: 10px;"><b>No.BPB</b></h5></th>
                  </tr>

                  <?php if (!empty($rekap_bpb)): ?>
                    <?php foreach ($rekap_bpb as $key => $value): ?>
                      <?php if (!empty($value['count_agree']=3)): ?>
                        <tr>
                          <td class="text-center" style="font-size: 14px;"><?php echo $key+1; ?></td>
                          <td class="text-center" style="font-size: 14px;"><?php echo $value['tgl_dibuat']; ?></td>
                          <td class="text-center" style="font-size: 14px;">
                            <ul type="square">
                              <?php foreach ($value['kalkulasi'] as $no => $isi): ?>
                                <li>
                                  <?php echo $isi['nama_barang']; ?>
                                </li>
                                <br>
                              <?php endforeach ?>
                            </ul>
                          </td>
                          <td class="text-center" style="font-size: 14px;">
                            <ul type="square">
                              <?php foreach ($value['kalkulasi'] as $no => $isi): ?>
                                <li>
                                  <?php echo $isi['qty_bpb']; ?>
                                </li>
                                <br>
                              <?php endforeach ?>
                            </ul>
                          </td>
                          <td class="text-center" style="font-size: 14px;">
                            <ul type="square">
                              <?php foreach ($value['kalkulasi'] as $no => $isi): ?>
                                <li>
                                  <?php echo $isi['no_po']; ?>
                                </li>
                                <br>
                              <?php endforeach ?>
                            </ul>
                          </td>
                          <td class="text-center" style="font-size: 14px;">
                            <ul type="square">
                              <?php foreach ($value['kalkulasi'] as $no => $isi): ?>
                                <li>
                                  <?php echo $isi['nama_po']; ?>
                                </li>
                                <br>
                              <?php endforeach ?>
                            </ul>
                          </td>
                          <td class="text-center" style="font-size: 14px;">
                            <ul type="square">
                              <?php foreach ($value['kalkulasi'] as $no => $isi): ?>
                                <li>
                                  <?php echo $isi['qty']; ?>
                                </li>
                                <br>
                              <?php endforeach ?>
                            </ul>
                          </td>
                          <td class="text-center" style="font-size: 14px;">
                            <ul type="square">
                              <?php foreach ($value['kalkulasi'] as $no => $isi): ?>
                                <li>
                                  <?php echo $isi['nama_buyer']; ?>
                                </li>
                                <br>
                              <?php endforeach ?>
                            </ul>
                          </td>
                          <td class="text-center" style="font-size: 14px;">
                            <ul type="square">
                              <?php foreach ($value['kalkulasi'] as $no => $isi): ?>
                                <li>
                                  <?php echo $isi['nama_style']; ?>
                                </li>
                                <br>
                              <?php endforeach ?>
                            </ul>
                          </td>
                          <td class="text-center" style="font-size: 14px;">
                            <ul type="square">
                              <?php foreach ($value['kalkulasi'] as $no => $isi): ?>
                                <li>
                                  <?php echo $isi['no_bpb']; ?>
                                </li>
                                <br>
                              <?php endforeach ?>
                            </ul>
                          </td>
                        </tr>
                      <?php endif ?>
                    <?php endforeach ?>
                  <?php elseif (empty($rekap_bpb)): ?>
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