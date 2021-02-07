<section class="content">

  <h5>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url("admin/home"); ?>"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Pengaturan</li>
      <li class="active"><a href="<?php echo base_url("admin/pengaturan/user/user"); ?>" style="color: #777;">Data User</a></li>
    </ol>
  </h5>

  <div class="row">
    <div class="col-xs-12">
      <div class="panel panel-heading">
        <div class="box-header">
          <h3 class="box-title fa fa-user"> Data User</h3>
          <hr>
        </div>
        <div class="box-body">
          <table class="table table-bordered table-striped" id="example1"> 
            <thead style="background-color: #D3D3D3">
              <tr>
                <th class="text-center" width="20">No</th>
                <th class="text-center">NIK</th>
                <th class="text-center">Nama Karyawan</th>
                <th class="text-center">Level</th>
                <th class="text-center">Tanggal Revisi</th>
                <th class="text-center"">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($user as $key => $value): ?>
                <tr>
                  <td class="text-center"><?php echo $key+1; ?></td>
                  <td class="text-center"><?php echo $value['nik']; ?></td>
                  <td class="text-center"><?php echo $value['nama_karyawan']; ?></td>
                  <td class="text-center"><?php echo $value['level']; ?></td>
                  <td class="text-center">
                    <?php if (!empty($value['tgl_revisi']=="0000-00-00")): ?>
                      <?php echo "-" ?>
                    <?php elseif (!empty($value['tgl_revisi'])): ?>
                      <?php echo date('d-m-Y', strtotime($value['tgl_revisi'])); ?>
                    <?php endif ?>
                  </td>
                  <td class="text-center">
                    <a href="<?php echo base_url("admin/pengaturan/user/user/ubah/$value[id_user]"); ?>" class="btn btn-success btn-sm fa fa-pencil" title="Edit" data-content="Popover body content is set in this attribute." ></a>
                    <a href="<?php echo base_url("admin/pengaturan/user/user/hapus/$value[id_user]"); ?>" class="btn btn-danger btn-sm fa fa-trash" title="Hapus" data-content="Popover body content is set in this attribute." onclick="return confirm('Apakah anda yakin ?')"></a>
                  </td>
                </tr>
              <?php endforeach ?>
            </tbody>
          </table>
          <br>
          <a class="btn btn-primary btn-sm fa fa-plus" title="Tambah" data-content="Popover body content is set in this attribute."  href="<?php echo base_url("admin/pengaturan/user/user/tambah") ?>">  Tambah</a>
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