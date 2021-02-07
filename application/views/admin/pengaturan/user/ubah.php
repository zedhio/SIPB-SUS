<section class="content">

  <h5>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url("admin/home"); ?>"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Pengaturan</li>
      <li class="active"><a href="<?php echo base_url("admin/pengaturan/user/user"); ?>" style="color: #777;" onclick="return confirm('Anda punya perubahan yang belum disimpan; Anda yakin hendak meninggalkan halaman ini?')">Data User</a></li>
      <li class="active">Ubah</li>
    </ol>
  </h5>

  <div class="row">

    <div class="col-xs-1"></div>

    <div class="col-xs-10">

      <!-- /.box-header -->
      <div class="box box-warning">
        <div class="box-header with-border">
          <h3 class="box-title fa fa-plus"> Form Ubah Data User</h3>
          <button type="button" class="close" data-dismiss="modal" onclick="history.back(-1)" title="kembali" data-content="Popover body content is set in this attribute.">&times;</button>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <form role="form" method="POST" enctype="multipart/form-data">
            <!-- text input -->
            <div class="col-md-12">
              <div class="form-group">
                <div class="row">
                  <div class="col-xs-12">
                    <label>Nomor Induk Karyawan (NIK)</label>
                    <select class="form-control" name="id_karyawan" onchange="submit()" disabled="">
                      <?php foreach ($karyawan as $key => $value): ?>
                        <option value="<?php echo $value['id_karyawan']; ?>" <?php if($user['id_karyawan']==$value['id_karyawan']){echo "selected";} ?>><?php echo $value['nik']; ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-xs-12">
                    <label>Nama Karyawan</label>
                    <input type="text" class="form-control" value="<?php echo $user['nama_karyawan']; ?>" disabled>  
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-xs-12">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Kosongkan input jika tidak diubah">  
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-xs-12">
                    <label>Level</label>
                    <select class="form-control" name="level">
                      <option><?php echo $user['level']; ?></option>
                      <?php foreach ($jabatan as $key => $value): ?>
                        <option value="<?php echo $value['jabatan']; ?>"><?php echo $value['jabatan']; ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-xs-12">
                    <label>Tanggal Revisi</label>
                    <input type="text" class="form-control" name="tgl_revisi" value="<?php echo date('d-m-Y'); ?>" readonly>  
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <div class="row">
                  <div class="col-xs-1">
                    <button class="btn btn-primary fa fa-pencil" title="Simpan" data-content="Popover body content is set in this attribute."> Ubah</button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>

      <div class="col-xs-1"></div>

    </div>
  </section>