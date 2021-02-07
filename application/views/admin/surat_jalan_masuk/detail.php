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
      <li><a href="<?php echo base_url("admin/home"); ?>"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Transaksi</li>
      <li class="active"><a href="<?php echo base_url("admin/surat_jalan_masuk/surat_jalan_masuk"); ?>" style="color: #777;" onclick="return confirm('Anda yakin hendak meninggalkan halaman ini?')">Surat Jalan Masuk</a></li>
      <li class="active">Detail</li>
    </ol>
  </h5>

  <div class="row">

    <div class="col-xs-1"></div>

    <div class="col-xs-10">

      <!-- /.box-header -->
      <div class="box body-blue">
        <!-- /.box-header -->

        <!-- Bagian tampilan detail surat jalan masuk -->
        <div class="box-body" style="padding-top: 25px;">
          <!-- text input -->
          <div class="col-md-12">
            <div>
              <h3><i><b>PT. SINAR UTAMA SEJAHTERA</b></i></h3>
              <h3 class="text-center"><u><b>SURAT JALAN MASUK</b></u></h3>
              <br>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <div class="text-left">
                <div class="form-group">

                  <center>
                    <?php if (!empty($ambil_sjm['logo_supplier'])): ?>
                      <img class="profile-user-img img-thumbnail body-black" style="width:250px; height: 150px;" src="<?php echo base_url("assets/images/logo_supplier/".$ambil_sjm['logo_supplier']); ?>"  alt="Logo Supplier" >
                    <?php elseif (empty($ambil_sjm['logo_supplier'])): ?>
                      <img class="profile-user-img img-thumbnail body-black" style="width:200px; height: 150px;" src="<?php echo base_url("assets/images/logo_supplier/no-image.png"); ?>" class="profile-user-img img-thumbnail">
                    <?php endif ?>
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
                        <th width="164" style="border: 0px; background-color: transparent;">No.Surat Jalan Masuk</th>
                        <td style="border: 0px; background-color: transparent;">:</td>
                        <td style="text-align: left; border: 0px; background-color: transparent;">
                          <?php if (!empty($ambil_sjm['no_sjm'])): ?>
                            <?php echo $ambil_sjm['no_sjm']; ?>
                          <?php elseif (empty($ambil_sjm['no_sjm'])): ?>
                            <?php echo "-"; ?>
                          <?php endif ?>
                        </td>
                      </tr>
                      <tr>
                        <th style="border: 0px; background-color: transparent;">Tgl.Masuk Surat</th>
                        <td style="border: 0px; background-color: transparent;">:</td>
                        <td style="text-align: left; border: 0px; background-color: transparent;"><?php echo date('d-m-Y', strtotime($ambil_sjm['tgl_masuk'])); ?></td>
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
                        <th width="15" style="border: 0px; background-color: transparent;">Supplier</th>
                        <td style="border: 0px; background-color: transparent;">:</td>
                        <td style="border: 0px; background-color: transparent;"><?php echo $ambil_sjm['nama_supplier']; ?></td>
                      </tr>
                      <tr>
                        <th style="border: 0px; background-color: transparent;">No.Kendaraan</th>
                        <td style="border: 0px; background-color: transparent;">:</td>
                        <td style="text-align: left; border: 0px; background-color: transparent;">
                          <?php if (!empty($ambil_sjm['no_kendaraan'])): ?>
                            <?php echo $ambil_sjm['no_kendaraan']; ?>
                          <?php elseif (empty($ambil_sjm['no_kendaraan'])): ?>
                            <?php echo "-"; ?>
                          <?php endif ?>
                        </td>
                      </tr>   
                    </tbody>
                  </table>    
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-8" style="position: absolute; padding-top: 190px; padding-left: 300px;">
            <div class="form-group">
              <div class="text-left">
                <div class="form-group">
                  <table class="table">
                    <tbody>
                      <tr>
                        <th width="164" style="border: 0px; background-color: transparent;">Keterangan</th>
                        <td style="border: 0px; background-color: transparent;">:</td>
                        <td style="border: 0px; background-color: transparent; padding-left: 0px;"><?php echo strip_tags($ambil_sjm['keterangan']); ?></td>
                      </tr>   
                    </tbody>
                  </table>    
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-12" style="padding-bottom: 25px;">
            <div class="form-group">
              <table style="margin-left: 28px; margin-right: 28px;">
                <!-- Header -->
                <tr align="center">
                  <th rowspan="2" class="text-center body-black" width="30" style="background-color: #ddd"><h5 style="padding-top: 10px;"><b>No</b></h5></th>
                  <th rowspan="2" class="text-center body-black" width="250" style="background-color: #ddd"><h5 style="padding-top: 10px;"><b>Nama Barang</b></h5></th>
                  <th rowspan="2" class="text-center body-black" width="200" style="background-color: #ddd"><h5 style="padding-top: 10px;"><b>Jenis</b></h5></th>
                  <th rowspan="2" class="text-center body-black" width="200" style="background-color: #ddd"><h5 style="padding-top: 10px;"><b>Sub Jenis</b></h5></th>
                  <th colspan="3" class="text-center body-black" height="30" style="font-size: 14px; background-color: #ddd;"><b>Jumlah</b></th>
                </tr>
                <tr>
                  <td class="text-center body-black" width="100" height="30" style="font-size: 14px; background-color: #ddd;"><b>Qty Barang</b></td>
                  <td class="text-center body-black" width="100" style="font-size: 14px; background-color: #ddd;"><b>Satuan</b></td>
                  <td class="text-center body-black" width="300" style="font-size: 14px; background-color: #ddd;"><b>Ukuran</b></td>
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
                  <td colspan="3" class="text-center body-black" style="font-size: 14px;"><?php echo $ambil_total['qty_total']; ?></td>
                </tr>
                <!-- Record -->
              </table>

              <div class="col-xs-4" style="padding-top: 20px;">
                <div class="text-center hidden">
                  <label></label>
                  <div>
                    <img src="#" width="100">
                  </div>
                  <u></u>
                </div>
              </div>

              <div class="col-xs-4" style="padding-top: 20px;">
                <div class="text-center hidden">
                  <label></label>
                  <div>
                    <img src="#" width="100">
                  </div>
                  <u></u>
                </div>
              </div>

              <div class="col-xs-4" style="padding-top: 20px;">

                <?php if (empty($ambil_sjm['konfirmasi'])): ?>
                  <div class="text-center">
                    <label>Diterima / Disetujui</label>
                    <div>
                      <img width="100">
                      <br><br><br><br><br>
                    </div>
                    <u>Oktavia</u>
                  </div>

                <?php elseif (!empty($ambil_sjm['konfirmasi'])): ?>
                  <div class="text-center">
                    <label>Diterima / Disetujui</label>
                    <div>
                      <img src="<?php echo base_url("assets/images/ttd/ttd_okta.jpg"); ?>" width="100">
                    </div>
                    <u>Oktavia</u>
                  </div>
                <?php endif ?>

              </div>

              <!-- <br>
              <?php //if (!empty($ambil_sjm['konfirmasi'])): ?>
                <button class="btn btn-primary fa fa-print hidden-print" onclick="window.print()"> Cetak PDF</button>
                <?php //endif ?> -->

              </div>
            </div>
          </div>

        </div>
      </div>

    </div>
  </section>