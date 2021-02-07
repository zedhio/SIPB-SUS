<section class="content">

  <h5>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url("admin/home"); ?>"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Data Master</li>
      <li class="active">Barang</li>
      <li class="active"><a href="<?php echo base_url("admin/data_master/barang/data_barang/barang"); ?>" style="color: #777;">Data Barang</a></li>
    </ol>
  </h5>

  <div class="row">
    <div class="col-xs-12">
      <div class="panel panel-heading">
        <div class="box-header">
          <h3 class="box-title fa fa-cube"> Data Barang</h3>
          <hr>
        </div>
        <div class="box-body">
          <table class="table table-bordered table-striped" id="example1"> 
            <thead style="background-color: #D3D3D3">
              <tr>
                <th class="text-center">No</th>
                <th class="text-center">Kode Barang</th>
                <th class="text-center">Nama Barang</th>
                <th class="text-center">Warna Barang</th>
                <th class="text-center">Stok</th>
                <th class="text-center">Foto Barang</th>
                <th class="text-center"">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($barang as $key => $value): ?>
                <tr>
                  <td class="text-center"><?php echo $key+1; ?></td>
                  <td class="text-center"><?php echo $value['kode_barang']; ?></td>
                  <td class="text-center"><?php echo $value['nama_barang']; ?></td>
                  <td class="text-center">
                    <?php if (!empty($value['warna'])): ?>
                      <?php echo $value['warna']; ?>
                    <?php elseif (empty($value['warna'])): ?>
                      <?php echo "-"; ?>
                    <?php endif ?>
                  </td>
                  <td class="text-center">
                    <?php echo number_format($value['stok'], 2); ?> <?php echo $value['satuan']; ?>
                    <?php if ($value['stok']<=50.00): ?>
                      &nbsp;&nbsp;<a class="btn-warning btn-sm" title="Silahkan hubungi K.Div Purchase Order untuk pengadaan stok" data-content="Popover body content is set in this attribute."><i class="fa fa-warning"></i></a>
                    <?php endif ?>
                  </td>
                  <td class="text-center">
                    <?php if (!empty($value['foto_barang'])): ?>
                      <img src="<?php echo base_url("assets/images/foto_barang/".$value['foto_barang']); ?>" class="profile-user-img img-thumbnail">
                    <?php elseif (empty($value['foto_barang'])): ?>
                      <img src="<?php echo base_url("assets/images/foto_barang/no-image.png"); ?>" class="profile-user-img img-thumbnail">
                    <?php endif ?>
                  </td>
                  <td class="text-center">
                    <a href="<?php echo base_url("admin/data_master/barang/data_barang/barang/detail/$value[id_barang]"); ?>" class="btn btn-info btn-sm fa fa-info hidden-print" title="Detail" data-content="Popover body content is set in this attribute."></a>
                    <a href="<?php echo base_url("admin/data_master/barang/data_barang/barang/ubah/$value[id_barang]"); ?>" class="btn btn-success btn-sm fa fa-pencil" title="Edit" data-content="Popover body content is set in this attribute." ></a>
                    <a href="<?php echo base_url("admin/data_master/barang/data_barang/barang/hapus/$value[id_barang]"); ?>" class="btn btn-danger btn-sm fa fa-trash" title="Hapus" data-content="Popover body content is set in this attribute." onclick="return confirm('Apakah anda yakin ?')"></a>
                  </td>
                </tr>
              <?php endforeach ?>
            </tbody>
          </table>
          <br>
          <a class="btn btn-primary btn-sm fa fa-plus" title="Tambah" data-content="Popover body content is set in this attribute."  href="<?php echo base_url("admin/data_master/barang/data_barang/barang/tambah") ?>">  Tambah</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Modal Detail-->
<!-- <div id="detail" class="modal fade" role="dialog">
  <div class="modal-dialog"> -->

    <!-- Modal content-->
    <!-- <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Detail Waktu</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
        <label>Dibuat Oleh</label>
          <input type="text" class="form-control" value="">
        </div>
        <div class="form-group">
          <label>Dibuat Tanggal</label>
          <input type="text" class="form-control" value="#">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div> -->

<!-- Tambah Stok -->
<!--   <div id="beri_stok" class="modal fade" role="dialog">
    <div class="modal-dialog body-blue">

      <form method="POST">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title fa fa-cube"> <label>Tambah Stok</label></h4>
          </div>
          <div class="modal-body">
            <input type="text" name="id_barang" class="hidden">
            <div class="form-group">
              <label>Stok</label>
              <input type="number" class="form-control" step="any" value="<?php //echo number_format($value['stok'], 2); ?>" name="stok">
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-primary fa fa-save" name="tambah" value="tambah" title="Beri No.Purchase Order" data-content="Popover body content is set in this attribute."> Tambah</button>
          </div>
        </div>
      </form>

    </div>
  </div> -->
  <!-- Beri No Purchase Order -->