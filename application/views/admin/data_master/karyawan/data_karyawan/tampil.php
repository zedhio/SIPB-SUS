<section class="content">

  <h5>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url("admin/home"); ?>"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Data Master</li>
      <li class="active">Karyawan</li>
      <li class="active"><a href="<?php echo base_url("admin/data_master/karyawan/data_karyawan/karyawan"); ?>" style="color: #777;">Data Karyawan</a></li>
    </ol>
  </h5>

  <div class="row">
    <div class="col-xs-12">
      <div class="panel panel-heading">
        <div class="box-header">
          <h3 class="box-title fa fa-cube"> Data Karyawan</h3>
          <hr>
        </div>
        <div class="box-body">
          <table class="table table-bordered table-striped" id="example1"> 
            <thead style="background-color: #D3D3D3">
              <tr>
                <th class="text-center">No</th>
                <th class="text-center">NIK</th>
                <th class="text-center">Nama Karyawan</th>
                <th class="text-center">Bagian</th>
                <th class="text-center">Jabatan</th>
                <th class="text-center">Foto Karyawan</th>
                <th class="text-center"">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($karyawan as $key => $value): ?>
                <tr>
                  <td class="text-center"><?php echo $key+1; ?></td>
                  <td class="text-center"><?php echo $value['nik']; ?></td>
                  <td class="text-center"><?php echo $value['nama_karyawan']; ?></td>
                  <td class="text-center"><?php echo $value['bagian']; ?></td>
                  <td class="text-center"><?php echo $value['jabatan']; ?></td>
                  <td class="text-center">
                    <?php if (!empty($value['foto_karyawan'])): ?>
                      <img src="<?php echo base_url("assets/images/foto_karyawan/".$value['foto_karyawan']); ?>" class="profile-user-img img-thumbnail">
                    <?php elseif (empty($value['foto_karyawan'])): ?>
                      <img src="<?php echo base_url("assets/images/foto_karyawan/logo-user.png"); ?>" class="profile-user-img img-thumbnail">
                    <?php endif ?>
                  </td>
                  <td class="text-center">
                    <a href="<?php echo base_url("admin/data_master/karyawan/data_karyawan/karyawan/detail/$value[id_karyawan]"); ?>" class="btn btn-info btn-sm fa fa-info" title="Detail" data-content="Popover body content is set in this attribute."></a>
                    <a href="<?php echo base_url("admin/data_master/karyawan/data_karyawan/karyawan/ubah/$value[id_karyawan]"); ?>" class="btn btn-success btn-sm fa fa-pencil" title="Edit" data-content="Popover body content is set in this attribute." ></a>
                    <a href="<?php echo base_url("admin/data_master/karyawan/data_karyawan/karyawan/hapus/$value[id_karyawan]"); ?>" class="btn btn-danger btn-sm fa fa-trash" title="Hapus" data-content="Popover body content is set in this attribute." onclick="return confirm('Apakah anda yakin ?')"></a>
                  </td>
                </tr>
              <?php endforeach ?>
            </tbody>
          </table>
          <br>
          <a class="btn btn-primary btn-sm fa fa-plus" title="Tambah" data-content="Popover body content is set in this attribute."  href="<?php echo base_url("admin/data_master/karyawan/data_karyawan/karyawan/tambah") ?>">  Tambah</a>
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