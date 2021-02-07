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
      <li class="active"><a href="<?php echo base_url("admin/pemeriksaan_barang/pemeriksaan_barang"); ?>" style="color: #777;" onclick="return confirm('Anda yakin hendak meninggalkan halaman ini?')">Pemeriksaan Barang</a></li>
      <li class="active">Stiker</li>
    </ol>
  </h5>

  <div class="row">

    <div class="col-xs-2"></div>

    <div class="col-xs-8">

      <!-- /.box-header -->
      <div class="box body-blue">
        <!-- /.box-header -->

        <div class="box-body" style="padding-top: 25px;">
          <!-- text input -->
          <div class="form-group">
            <div class="col-md-12">
              <div class="col-xs-12">
                <table class="table table-bordered body-black" style="border: 0px; background-color: transparent;">
                  <!-- Record -->
                  <tr>
                    <td colspan="2" style="border: 0px; background-color: transparent;">
                      <div class="col-md-3">
                        <img class="profile-user-img img-circle" style="width:180px; height: 100px;" src="<?php echo base_url("assets/images/logo/pt_sus.png"); ?>" class="profile-user-img img-circle">  
                      </div>
                      <div class="col-md-9 text-center">
                        <h5 style="padding-top: 40px;font-size: 20px;"><b>PT.SINAR UTAMA SEJAHTERA</b></h5>  
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2" style="border: 0px; background-color: transparent;">
                      <div class="col-md-2"><b>No.Pemeriksaan</b></div>
                      <div class="col-md-10"><b>:</b> <?php echo $ambil_pemeriksaan['no_pemeriksaan_barang']; ?></div>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2" style="border: 0px; background-color: transparent;">
                      <div class="col-md-2"><b>No.LPB</b></div>
                      <div class="col-md-10"><b>:</b> <?php echo $ambil_periksa['no_lpb']; ?></div>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2" style="border: 0px; background-color: transparent;">
                      <div class="col-md-2"><b>Supplier</b></div>
                      <div class="col-md-10"><b>:</b> <?php echo $ambil_periksa['nama_supplier']; ?></div>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2" style="border: 0px; background-color: transparent;">
                      <div class="col-md-2"><b>Tanggal Pemeriksaan</b></div>
                      <div class="col-md-10"><b>:</b> <?php echo date('d-m-Y', strtotime($ambil_pemeriksaan['tgl_periksa'])); ?></div>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2" style="border: 0px; background-color: transparent;">
                      <div class="col-md-2"><b>Nama Barang</b></div>
                      <div class="col-md-10"><b>:</b> 
                        <?php if (!empty($ambil_pemeriksaan['nama_barang']=="-")): ?>
                          <?php echo $ambil_periksa['nama_barang']; ?>
                        <?php elseif (!empty($ambil_pemeriksaan['nama_barang']!=="-")): ?>
                          <?php echo $ambil_pemeriksaan['nama_barang']; ?>
                        <?php endif ?>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2" style="border: 0px; background-color: transparent;">
                      <div class="col-md-2"><b>Warna</b></div>
                      <div class="col-md-10"><b>:</b> <?php echo $ambil_periksa['warna']; ?></div>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2" style="border: 0px; background-color: transparent;">
                      <div class="col-md-2"><b>Qty</b></div>
                      <div class="col-md-10"><b>:</b> <?php echo $ambil_periksa['qty_sjm']; ?></div>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2" style="border: 0px; background-color: transparent;">
                      <div class="col-md-2" style="padding-top: 10px;"><b>Qty Reject</b></div>
                      <div class="col-md-10 checkbox"><b>:</b> 
                        <?php if (!empty($ambil_pemeriksaan['tindakan']=="Dimusnahkan" OR $ambil_pemeriksaan['tindakan']=="Return Barang")): ?>
                          <?php echo $ambil_pemeriksaan['qty_reject']; ?>
                        <?php elseif (!empty($ambil_pemeriksaan['tindakan']=="Kosong")): ?>
                          <?php echo "Passed Inpection"; ?>
                        <?php endif ?>
                        <?php if (!empty($ambil_pemeriksaan['tindakan']=="Kosong")): ?>
                          <label class="pull-right"><span class="fa fa-square-o">Dimusnahkan</span></label>
                          <label class="pull-right"><span class="fa fa-square-o">Return &nbsp;&nbsp;&nbsp;</span></label>
                        <?php endif ?>
                        <?php if (!empty($ambil_pemeriksaan['tindakan']=="Dimusnahkan")): ?>
                          <label class="pull-right"><span class="fa fa-check-square-o"> Dimusnahkan</span></label>
                          <label class="pull-right"><span class="fa fa-square-o"> Return &nbsp;&nbsp;&nbsp;</span></label>
                        <?php endif ?>
                        <?php if (!empty($ambil_pemeriksaan['tindakan']=="Return Barang")): ?>
                          <label class="pull-right"><span class="fa fa-square-o"> Dimusnahkan</span></label>
                          <label class="pull-right"><span class="fa fa-check-square-o"> Return &nbsp;&nbsp;&nbsp;</span></label>
                        <?php endif ?>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2" style="border: 0px; background-color: transparent;">
                      <div class="col-md-9">
                        <label>*Note :</label>
                        <ol type="1">
                          <li>Pemeriksaan Barang harus membuat <b>Material Swatch</b> & <b>Pengecekan Kualitas</b> barang.</li>
                          <li>Perhatikan ketentuan masa berlaku untuk pelaksana <i>Return</i> tiap - tiap suplier.</li>
                        </ol>
                      </div>
                      <div class="col-md-3">
                        <div class="text-center">
                          <label style="font-size: 16px;">Inspection Acceptable</label>
                        </div>
                        <div class="text-center">
                          <?php if (!empty($ambil_pemeriksaan['inspection_acceptable'])): ?>
                            <img src="<?php echo base_url("assets/images/ttd/ttd_okta.jpg"); ?>" width="100">
                          <?php else: ?>
                            <img width="100"><br><br><br><br><br>
                          <?php endif ?>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <!-- Record -->
                </table>
                <br>
                <!-- Tombol cetak data surat jalan masuk pdf -->
                <a href="<?php echo base_url("admin/pemeriksaan_barang/pemeriksaan_barang/cetak_stiker/$ambil_pemeriksaan[id_pemeriksaan_barang]"); ?>" class="btn btn-primary fa fa-print hidden-print"> Cetak Stiker</a><br><br>
                <!-- Tombol cetak data surat jalan masuk pdf -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xs-2"></div>

  </div>
</section>