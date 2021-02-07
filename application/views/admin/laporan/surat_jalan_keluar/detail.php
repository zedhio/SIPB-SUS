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
      <li><a href="<?php echo base_url("admin/home"); ?>"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Laporan</li>
      <li class="active"><a href="<?php echo base_url("admin/laporan/surat_jalan_keluar"); ?>" style="color: #777;" onclick="return confirm('Anda yakin hendak meninggalkan halaman ini?')">Laporan Surat Jalan Keluar</a></li>
      <li class="active">Detail</li>
    </ol>
  </h5>

  <div class="row">

    <div class="col-xs-1"></div>

    <div class="col-xs-10">

      <!-- /.box-header -->
      <div class="box body-blue">
        <div class="box-header with-border">
          <h3><i><b>PT. SINAR UTAMA SEJAHTERA</b></i></h3>
          <h3 class="text-center"><u><b>Laporan Surat Jalan Keluar</b></u></h3>
          <br>
        </div>
        <!-- /.box-header -->

        <div class="box-body" style="padding-top: 25px;">
          <!-- text input -->
          <div class="col-md-3">
            <div class="form-group">
              <div class="text-left">
                <div class="form-group">
                  <center>
                    <img class="profile-user-img img-thumbnail" style="width:200px; height: 150px;" src="<?php echo base_url("assets/images/logo/pt_sus.png"); ?>" class="profile-user-img img-thumbnail">
                  </center>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <div class="text-left">
                <div class="form-group">
                  <table class="table">
                    <tbody>
                      <tr>
                        <th width="173" style="border: 0; background-color: transparent;">No.Surat Jalan Keluar</th>
                        <td style="border: 0; background-color: transparent;">:</td>
                        <td style="text-align: left; border: 0; background-color: transparent;"><?php echo $ambil_sjk['no_sjk']; ?></td>
                      </tr>
                      <tr>
                        <th style="border: 0; background-color: transparent;">No.Pemeriksaan Barang</th>
                        <td style="border: 0; background-color: transparent;">:</td>
                        <td style="text-align: left; border: 0; background-color: transparent;"><?php echo $ambil_sjk['no_pemeriksaan_barang']; ?></td>
                      </tr>
                      <tr>
                        <th style="border: 0; background-color: transparent;">Tgl.Dibuat Surat</th>
                        <td style="border: 0; background-color: transparent;">:</td>
                        <td style="text-align: left; border: 0; background-color: transparent;"><?php echo $ambil_sjk['tgl_dibuat']; ?></td>
                      </tr>
                    </tbody>
                  </table>    
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <div class="text-left">
                <div class="form-group">
                  <table class="table">
                    <tbody>
                      <tr>
                        <th width="125" style="border: 0; background-color: transparent;">Ditujukan</th>
                        <td style="border: 0; background-color: transparent;">:</td>
                        <td style="text-align: left; border: 0; background-color: transparent;"><?php echo $detail['nama_supplier']; ?></td>
                      </tr>
                      <tr>
                        <th style="border: 0; background-color: transparent;">No.Kendaraan</th>
                        <td style="border: 0; background-color: transparent;">:</td>
                        <td style="text-align: left; border: 0; background-color: transparent;">
                          <?php if (!empty($ambil_sjk['no_kendaraan'])): ?>
                            <?php echo $ambil_sjk['no_kendaraan']; ?>
                          <?php elseif(empty($ambil_sjk['no_kendaraan'])): ?>
                            <?php echo "-"; ?>
                          <?php endif ?>
                        </td>
                      </tr>
                      <tr>
                        <th style="border: 0; background-color: transparent;">Keterangan</th>
                        <td style="border: 0; background-color: transparent;">:</td>
                        <td style="border: 0; background-color: transparent;"><?php echo $detail['tindakan']; ?></td>
                      </tr>   
                    </tbody>
                  </table>    
                </div>
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-12">
              <table class="body-black" style="margin-left: 30px; margin-right: 30px;">
                <!-- Header -->
                <tr style="background-color: #ddd;">
                  <th rowspan="2" class="text-center body-black" height="30" width="250"><h5 style="padding-top: 10px;"><b>Nama Barang</b></h5></th>
                  <th rowspan="2" class="text-center body-black" width="215"><h5 style="padding-top: 10px;"><b>Jenis</b></h5></th>
                  <th rowspan="2" class="text-center body-black" width="215"><h5 style="padding-top: 10px;"><b>Sub Jenis</b></h5></th>
                  <th colspan="3" class="text-center body-black" style="font-size: 14px;"><b>Jumlah</b></th>
                </tr>
                <tr style="background-color: #ddd;">
                  <td class="text-center body-black" height="30" width="100" style="font-size: 14px;"><b>Qty Barang</b></td>
                  <td class="text-center body-black" width="100" style="font-size: 14px;"><b>Satuan</b></td>
                  <td class="text-center body-black" width="300" style="font-size: 14px;"><b>Ukuran</b></td>
                </tr>
                <!-- / Header -->

                <!-- Record -->
                <?php foreach ($ambil_kalkulasi as $key => $value): ?>
                  <tr>
                    <td class="text-center body-black" height="30" style="font-size: 14px;"><?php echo $value['nama_barang']; ?></td>
                    <td class="text-center body-black" style="font-size: 14px;"><?php echo $value['jenis']; ?></td>
                    <td class="text-center body-black" style="font-size: 14px;"><?php echo $value['sub_jenis']; ?></td>
                    <td class="text-center body-black" style="font-size: 14px;"><?php echo $value['qty_sjk']; ?></td>
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
              </table>

              <!-- Kondisi menampilkan tanda terima pada detail surat jalan masuk -->
              <div class="col-xs-3" style="padding-top: 20px;">
                <div class="text-center hidden">
                  <label></label>
                  <div>
                    <img src="#" width="100">
                  </div>
                  <u></u>
                </div>
              </div>
              <div class="col-xs-3" style="padding-top: 20px;">
                <?php if (empty($validasi['status_pengajuan']) OR $validasi['status_pengajuan']=="Ditolak"): ?>
                  <div class="text-center">
                    <label>Diterima / Disetujui</label>
                    <div>
                      <img width="100">
                      <br><br><br><br><br>
                    </div>
                    <u>Kus Supriyadinata, SE</u>
                  </div>
                <?php elseif ($validasi['status_pengajuan']=="Disetujui"): ?>
                  <div class="text-center">
                    <label>Diterima / Disetujui</label>
                    <div>
                      <img src="<?php echo base_url("assets/images/ttd/ttd_okta.jpg"); ?>" width="100">
                    </div>
                    <u>Kus Supriyadinata, SE</u>
                  </div>
                <?php endif ?>
              </div>
              <div class="col-xs-3" style="padding-top: 20px;">
                <?php if (empty($ambil_sjk['konfirmasi'])): ?>
                  <div class="text-center">
                    <label>Pembuat</label>
                    <div>
                      <img width="100">
                      <br><br><br><br><br>
                    </div>
                    <u>Tia (Administrasi Gudang)</u>
                  </div>
                <?php elseif (!empty($ambil_sjk['konfirmasi'])): ?>
                  <div class="text-center">
                    <label>Pembuat</label>
                    <div>
                      <img src="<?php echo base_url("assets/images/ttd/ttd_okta.jpg"); ?>" width="100">
                    </div>
                    <u>Tia (Administrasi Gudang)</u>
                  </div>
                <?php endif ?>
              </div>
              <div class="col-xs-3" style="padding-top: 20px;">
                <div class="text-center hidden">
                  <label></label>
                  <div>
                    <img src="#" width="100">
                  </div>
                  <u></u>
                </div>
              </div>
              <!-- Kondisi menampilkan tanda terima pada detail surat jalan masuk -->

              <div class="col-xs-12" style="padding-top: 20px;">
              <?php if (!empty($ambil_sjk['konfirmasi']) && $validasi['status_pengajuan']=="Disetujui"): ?>
                  <!-- Tombol cetak data surat jalan masuk pdf -->
                  <!-- <button class="btn btn-primary fa fa-print hidden-print" onclick="window.print()"> Cetak PDF</button> -->
                  <!-- Tombol cetak data surat jalan masuk pdf -->
                <?php endif ?>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>