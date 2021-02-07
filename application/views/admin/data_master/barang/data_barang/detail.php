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
      <li class="active">Barang</li>
      <li class="active"><a href="<?php echo base_url("admin/data_master/barang/data_barang/barang"); ?>" style="color: #777;" onclick="return confirm('Anda yakin hendak meninggalkan halaman ini?')">Data Barang</a></li>
      <li class="active">Detail</li>
    </ol>
  </h5>

  <div class="row">

    <div class="col-xs-1"></div>

    <div class="col-xs-10">

      <!-- /.box-header -->
      <div class="box body-blue">
        <div class="box-header with-border">
          <h3 class="box-title fa fa-tags"> Detail Barang<!-- : <?php // echo $barang['kode_barang']; ?> --></h3>
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
                    <?php if (!empty($barang['foto_barang'])): ?>
                      <img class="profile-user-img img-thumbnail" style="width:200px; height: 150px;" src="<?php echo base_url("assets/images/foto_barang/".$barang['foto_barang']); ?>"  alt="Foto Barang" >
                    <?php elseif (empty($barang['foto_barang'])): ?>
                      <img class="profile-user-img img-thumbnail" style="width:200px; height: 150px;" src="<?php echo base_url("assets/images/foto_barang/no-image.png"); ?>" class="profile-user-img img-thumbnail">
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
                  <th width="150">Kode Barang</th>
                  <td>:</td>
                  <td style="text-align: left;"><?php echo $barang['kode_barang']; ?></td>
                </tr>
                <tr>
                  <th width="150">Jenis Barang</th>
                  <td>:</td>
                  <td style="text-align: left;"><?php echo $barang['jenis']; ?></td>
                </tr>
                <tr>
                  <th width="150">Sub Jenis Barang</th>
                  <td>:</td>
                  <td style="text-align: left;"><?php echo $barang['sub_jenis']; ?></td>
                </tr>
                <tr>
                  <th width="150">Nama Barang</th>
                  <td>:</td>
                  <td style="text-align: left;"><?php echo $barang['nama_barang']; ?></td>
                </tr>
                <tr>
                  <th width="150">Warna Barang</th>
                  <td>:</td>
                  <td style="text-align: left;">
                    <?php if (!empty($barang['warna'])): ?>
                      <?php echo $barang['warna']; ?>
                    <?php elseif (empty($barang['warna'])): ?>
                      <?php echo "-"; ?>
                    <?php endif ?>
                  </td>
                </tr>
                <tr>
                  <th width="150">Satuan Barang</th>
                  <td>:</td>
                  <td style="text-align: left;"><?php echo $barang['satuan']; ?></td>
                </tr>
                <tr>
                  <th width="150">Keterangan</th>
                  <td>:</td>
                  <td style="text-align: left;">
                    <?php if (!empty($barang['keterangan_barang'])): ?>
                      <?php echo strip_tags($barang['keterangan_barang']); ?>
                    <?php elseif (empty($barang['keterangan_barang'])): ?>
                      <?php echo "-"; ?>
                    <?php endif ?>
                  </td>
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