<section class="content">

  <h5>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url("admin/home"); ?>"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Pengaturan</li>
      <li class="active"><a href="<?php echo base_url("admin/pengaturan/user/user"); ?>" style="color: #777;" onclick="return confirm('Anda punya perubahan yang belum disimpan; Anda yakin hendak meninggalkan halaman ini?')">Data User</a></li>
      <li class="active">Tambah</li>
    </ol>
  </h5>

  <div class="row">

    <div class="col-xs-1"></div>

    <div class="col-xs-10">

      <!-- /.box-header -->
      <div class="box box-warning">
        <div class="box-header with-border">
          <h3 class="box-title fa fa-plus"> Form Tambah Data User</h3>
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
                    <select class="form-control" name="id_karyawan" onchange="submit()">
                    <option>- Pilih NIK -</option>
                      <?php foreach ($karyawan as $key => $value): ?>
                        <option value="<?php echo $value['id_karyawan']; ?>" <?php if($ambil['id_karyawan']==$value['id_karyawan']){echo "selected";} ?>><?php echo $value['nik']; ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-xs-12">
                    <label>Nama Karyawan</label>
                    <input type="text" class="form-control" value="<?php echo $ambil['nama_karyawan']; ?>" readonly>  
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-xs-12">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Minimal 6 karakter">  
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-xs-12">
                    <label>Level</label>
                    <select class="form-control" name="level">
                      <?php foreach ($jabatan as $key => $value): ?>
                        <option value="<?php echo $value['jabatan']; ?>"><?php echo $value['jabatan']; ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <div class="row">
                  <div class="col-xs-1">
                    <button class="btn btn-primary fa fa-save" name="simpan" value="simpan" title="Simpan" data-content="Popover body content is set in this attribute."> Simpan</button>
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