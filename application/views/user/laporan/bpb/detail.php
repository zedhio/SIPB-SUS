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
      <li class="active"><a href="<?php echo base_url("user/laporan/bpb"); ?>" style="color: #777;" onclick="return confirm('Anda yakin hendak meninggalkan halaman ini?')">Laporan Bukti Pengeluaran Barang</a></li>
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
                <h3 class="text-center"><u><b>LAPORAN BUKTI PENGELUARAN BARANG</b></u></h3>
                <hr>
              </div>
              <br><br>
              <div class="col-xs-12" style="padding-left: 450px;">
                <table>
                  <tr>
                    <th width="82" style="font-size: 15px;">No.BPB</th>
                    <td>:</td>
                    <td style="font-size: 15px;">&nbsp; <?php echo $ambil_bpb['no_bpb']; ?></td>
                  </tr>
                </table>
              </div>
              <div class="col-xs-12" style="padding-left: 450px;">
                <table>
                  <tr>
                    <th width="82" style="font-size: 15px;">Tanggal</th>
                    <td>:</td>
                    <td style="font-size: 15px;">&nbsp; <?php echo date('d-M-Y',strtotime($ambil_bpb['tgl_dibuat'])); ?></td>
                  </tr>
                </table>
              </div>
              <div class="col-xs-12" style="padding-left: 450px;">
                <table>
                  <tr>
                    <th width="82" style="font-size: 15px;">Bagian</th>
                    <td>:</td>
                    <td style="font-size: 15px;">&nbsp; <?php echo $ambil_bpb['bagian']; ?></td>
                  </tr>
                </table>
              </div>
              <div class="col-xs-4" style="padding-top: 40px;padding-left: 80px;">
                <table>
                  <tr>
                    <th width="30">P.O</th>
                    <td>:</td>
                    <td>&nbsp; <?php echo $ambil_bpb['nama_po']." (".$ambil_bpb['no_po'].") "; ?></td>
                  </tr>
                </table>
              </div>
              <div class="col-xs-2" style="padding-top: 40px;">
                <table>
                  <tr>
                    <th width="50">Order</th>
                    <td>:</td>
                    <td>&nbsp; <?php echo $ambil_bpb['qty']; ?></td>
                  </tr>
                </table>
              </div>
              <div class="col-xs-2" style="padding-top: 40px;padding-left: 20px;">
                <table>
                  <tr>
                    <th width="50">Buyer</th>
                    <td>:</td>
                    <td>&nbsp; <?php echo $ambil_bpb['nama_buyer']; ?></td>
                  </tr>
                </table>
              </div>
              <div class="col-xs-4" style="padding-top: 40px;">
                <table>
                  <tr>
                    <th width="87">Style Glove</th>
                    <td>:</td>
                    <td>&nbsp; <?php echo $ambil_bpb['nama_style']; ?></td>
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
                    <td class="text-center" width="300" style="font-size: 14px;"><b>Warna</b></td>
                    <td class="text-center" width="100" style="font-size: 14px;"><b>Qty</b></td>
                    <td class="text-center" width="100" style="font-size: 14px;"><b>Satuan</b></td>
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
                      <td class="text-center" style="font-size: 14px;">
                        <?php if (!empty($value['warna'])): ?>
                          <?php echo $value['warna']; ?>
                        <?php elseif (empty($value['warna'])): ?>
                          <?php echo "-"; ?>
                        <?php endif ?>
                      </td>
                      <td class="text-center" style="font-size: 14px;"><?php echo $value['qty_bpb']; ?></td>
                      <td class="text-center" style="font-size: 14px;"><?php echo $value['satuan']; ?></td>
                    </tr>
                  <?php endforeach ?>
                  <!-- Record -->
                </table>

                <div class="col-xs-4" style="padding-top: 20px;">
                  <?php if (!empty($ambil_bpb['validasi'])): ?>
                    <?php if (!empty($ambil_bpb['validasi'][0]['tujuan']="Kepala Unit Sewing")): ?>
                      <?php if ($ambil_bpb['validasi'][0]['status_pengajuan']=="Disetujui"): ?>
                        <div class="text-center">
                          <label>Yang Meminta</label>
                          <div>
                            <img src="<?php echo base_url("assets/images/ttd/ttd_okta.png"); ?>" width="100">
                          </div>
                          <u>Daryuti</u>
                        </div>
                      <?php endif ?>
                    <?php endif ?>
                  <?php endif ?>

                  <?php if (empty($ambil_bpb['validasi']) OR !empty($ambil_bpb['validasi'][0]['tujuan']="Kepala Unit Sewing")): ?>
                    <?php if (empty($ambil_bpb['validasi'][0]['status_pengajuan']) OR $ambil_bpb['validasi'][0]['status_pengajuan']=="Ditolak"): ?>
                      <div class="text-center">
                        <label>Yang Meminta</label>
                        <div>
                          <img width="100">
                          <br><br><br><br><br>
                        </div>
                        <u>Daryuti</u>
                      </div>
                    <?php endif ?>
                  <?php endif ?>                 

                </div>
                <div class="col-xs-4" style="padding-top: 20px;">
                  <?php if (!empty($ambil_bpb['validasi'])): ?>
                    <?php if (!empty($ambil_bpb['validasi'][1]['tujuan']="Kepala Gudang")): ?>
                      <?php if ($ambil_bpb['validasi'][1]['status_pengajuan']=="Disetujui"): ?>
                        <div class="text-center">
                          <label>Yang Menyerahkan</label>
                          <div>
                            <img src="<?php echo base_url("assets/images/ttd/ttd_okta.png"); ?>" width="100">
                          </div>
                          <u>Okta</u>
                        </div>
                      <?php endif ?>
                    <?php endif ?>
                  <?php endif ?>

                  <?php if (empty($ambil_bpb['validasi']) OR !empty($ambil_bpb['validasi'][1]['tujuan']="Kepala Gudang")): ?>
                    <?php if (empty($ambil_bpb['validasi'][1]['status_pengajuan']) OR $ambil_bpb['validasi'][1]['status_pengajuan']=="Ditolak"): ?>
                      <div class="text-center">
                        <label>Yang Menyerahkan</label>
                        <div>
                          <img width="100">
                          <br><br><br><br><br>
                        </div>
                        <u>Okta</u>
                      </div>
                    <?php endif ?>
                  <?php endif ?>
                </div>
                <div class="col-xs-4" style="padding-top: 20px;">
                  <?php if (!empty($ambil_bpb['validasi'])): ?>
                    <?php if (!empty($ambil_bpb['validasi'][2]['tujuan']="Kepala Divisi Production Manager")): ?>
                      <?php if ($ambil_bpb['validasi'][2]['status_pengajuan']=="Disetujui"): ?>
                        <div class="text-center">
                          <label>Disetujui</label>
                          <div>
                            <img src="<?php echo base_url("assets/images/ttd/ttd_okta.png"); ?>" width="100">
                          </div>
                          <u>Ribut</u>
                        </div>
                      <?php endif ?>
                    <?php endif ?>
                  <?php endif ?>

                  <?php if (empty($ambil_bpb['validasi']) OR !empty($ambil_bpb['validasi'][2]['tujuan']="Kepala Divisi Production Manager")): ?>
                    <?php if (empty($ambil_bpb['validasi'][2]['status_pengajuan']) OR $ambil_bpb['validasi'][2]['status_pengajuan']=="Ditolak"): ?>
                      <div class="text-center">
                        <label>Disetujui</label>
                        <div>
                          <img width="100">
                          <br><br><br><br><br>
                        </div>
                        <u>Ribut</u>
                      </div>
                    <?php endif ?>
                  <?php endif ?>
                </div>
                <?php if (!empty($ambil_bpb['validasi'])): ?>
                  <?php if ($ambil_bpb['validasi'][0]['status_pengajuan']=="Disetujui" AND $ambil_bpb['validasi'][1]['status_pengajuan']=="Disetujui" AND $ambil_bpb['validasi'][2]['status_pengajuan']=="Disetujui"): ?>
                    <div class="col-xs-12" style="padding-top: 30px;">
                      <button class="btn btn-primary fa fa-print hidden-print" onclick="window.print()"> Cetak PDF</button>
                    </div>
                  <?php endif ?>
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