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
      <li><a href="<?php echo base_url("admin/home"); ?>"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Data Master</li>
      <li class="active">Karyawan</li>
      <li class="active"><a href="<?php echo base_url("admin/data_master/karyawan/data_karyawan/karyawan"); ?>" style="color: #777;" onclick="return confirm('Anda yakin hendak meninggalkan halaman ini?')">Data Karyawan</a></li>
      <li class="active">Detail</li>
    </ol>
  </h5>

  <div class="row">

    <div class="col-xs-1"></div>

    <div class="col-xs-10">

      <!-- /.box-header -->
      <div class="box body-blue">
        <div class="box-header with-border">
          <h3 class="box-title fa fa-tags"> Detail Data Karyawan</h3>
          <button type="button" class="close hidden-print" data-dismiss="modal" onclick="history.back(-1)" title="Kembali" data-content="Popover body content is set in this attribute.">&times;</button>
        </div>
        <!-- /.box-header -->
        <div class="box-body" style="padding-top: 25px;">
          <!-- text input -->
          <div class="col-md-3">
            <div class="form-group">
              <div class="text-center">
                <div class="form-group">
                  <center>
                    <?php if (!empty($karyawan['foto_karyawan'])): ?>
                      <img class="profile-user-img img-thumbnail" style="width:200px; height: 150px;" src="<?php echo base_url("assets/images/foto_karyawan/".$karyawan['foto_karyawan']); ?>"  alt="Logo Karyawan" >
                    <?php elseif (empty($karyawan['foto_karyawan'])): ?>
                      <img class="profile-user-img img-thumbnail" style="width:200px; height: 150px;" src="<?php echo base_url("assets/images/foto_karyawan/logo-user.png"); ?>" class="profile-user-img img-thumbnail">
                    <?php endif ?>
                  </center>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-9">
              <table class="table table-striped" id="example1">
                <tr>
                  <th width="150">NIK</th>
                  <td>:</td>
                  <td style="text-align: left;"><?php echo $karyawan['nik']; ?></td>
                </tr>
                <tr>
                  <th width="150">Nama Karyawan</th>
                  <td>:</td>
                  <td style="text-align: left;"><?php echo $karyawan['nama_karyawan']; ?></td>
                </tr>
                <tr>
                  <th width="150">Bagian</th>
                  <td>:</td>
                  <td style="text-align: left;"><?php echo $karyawan['bagian']; ?></td>
                </tr>
                <tr>
                  <th width="150">Jabatan</th>
                  <td>:</td>
                  <td style="text-align: left;"><?php echo $karyawan['jabatan']; ?></td>
                </tr>
                <tr>
                  <th width="150">Tempat Lahir</th>
                  <td>:</td>
                  <td style="text-align: left;"><?php echo $karyawan['tmp_lhr']; ?></td>
                </tr>
                <tr>
                  <th width="150">Tanggal Lahir</th>
                  <td>:</td>
                  <td style="text-align: left;"><?php echo date('d-m-Y', strtotime($karyawan['tgl_lhr'])); ?></td>
                </tr>
                <tr>
                  <th width="150">Alamat</th>
                  <td>:</td>
                  <td style="text-align: left;"><?php echo strip_tags($karyawan['alamat']); ?></td>
                </tr>
              </table>
              <!-- <button class="btn btn-primary fa fa-print hidden-print" onclick="window.print()"> Cetak PDF</button> -->
            </div>
          </div>
        </div>
      </div>

      <div class="col-xs-1"></div>

    </div>
  </section>