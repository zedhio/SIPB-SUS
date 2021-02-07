<section class="content">

  <h5>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url("admin/home"); ?>"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Data Master</li>
      <li class="active">Karyawan</li>
      <li class="active"><a href="<?php echo base_url("admin/data_master/karyawan/data_karyawan/karyawan"); ?>" style="color: #777;" onclick="return confirm('Anda punya perubahan yang belum diubah; Anda yakin hendak meninggalkan halaman ini?')">Data Karyawan</a></li>
      <li class="active">Ubah</li>
    </ol>
  </h5>

  <div class="row">

    <div class="col-xs-1"></div>

    <div class="col-xs-10">

      <!-- /.box-header -->
      <div class="box box-warning">
        <div class="box-header with-border">
          <h3 class="box-title fa fa-pencil"> Form Ubah Data Karyawan</h3>
          <button type="button" class="close" data-dismiss="modal" onclick="history.back(-1)" title="kembali" data-content="Popover body content is set in this attribute.">&times;</button>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <form role="form" method="POST" enctype="multipart/form-data">
            <!-- text input -->
            <div class="col-md-12">
              <?php if ($error): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
              <?php endif ?>
              <div class="form-group">
                <div class="row">
                  <div class="col-xs-12">
                    <label>Nomor Induk Karyawan (NIK)</label>
                    <input type="text" class="form-control" name="nik" value="<?php echo $karyawan['nik']; ?>">  
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-xs-12">
                    <label>Nama Karyawan</label>
                    <input type="text" class="form-control" name="nama_karyawan" value="<?php echo $karyawan['nama_karyawan']; ?>">  
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-xs-12">
                    <label>Bagian</label>
                    <select class="form-control" name="id_bagian">
                      <?php foreach ($bagian as $key => $value): ?>
                        <option value="<?php echo $value['id_bagian']; ?>" <?php if($karyawan['id_bagian']==$value['id_bagian']){echo "selected";} ?>><?php echo $value['bagian']; ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-xs-12">
                    <label>Jabatan</label>
                    <select class="form-control" name="id_jabatan">
                      <?php foreach ($jabatan as $key => $value): ?>
                        <option value="<?php echo $value['id_jabatan']; ?>" <?php if($karyawan['id_jabatan']==$value['id_jabatan']){echo "selected";} ?>><?php echo $value['jabatan']; ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-xs-12">
                    <label>Tempat Lahir</label>
                    <input type="text" class="form-control" name="tmp_lhr" value="<?php echo $karyawan['tmp_lhr']; ?>">  
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-xs-12">
                    <label>Tanggal Lahir</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar-plus-o"></i>
                      </div>
                      <input type="text" id="datepicker" class="form-control" name="tgl_lhr" value="<?php echo date('d-m-Y', strtotime($karyawan['tgl_lhr'])); ?>">
                    </div>  
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-xs-12">
                    <label>Alamat</label>
                    <textarea class="ckeditor" id="ckeditor" name="alamat"><?php echo $karyawan['alamat']; ?></textarea>  
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <div class="row">
                  <div class="col-xs-12">
                    <label>Foto Karyawan</label>
                  </div>
                  <div class="col-xs-5"></div>
                  <div class="col-xs-2">
                    <br>
                    <center>
                      <?php if (!empty($karyawan['foto_karyawan'])): ?>
                        <img class="profile-user-img img-thumbnail" width="50" height="100" src="<?php echo base_url("assets/images/foto_karyawan/".$karyawan['foto_karyawan']); ?>"  alt="Foto Karyawan" id="img-upload">
                      <?php elseif (empty($karyawan['foto_karyawan'])): ?>
                        <img class="profile-user-img img-thumbnail" width="50" height="100" src="<?php echo base_url("assets/images/foto_karyawan/logo-user.png"); ?>" class="profile-user-img img-thumbnail" alt="Foto Karyawan" id="img-upload">
                      <?php endif ?>
                    </center>
                  </div>
                  <div class="col-xs-5"></div>
                  <div class="col-xs-12">
                    <br>
                    <div class="input-group">
                      <span class="input-group-btn">
                        <span class="btn btn-default btn-file">
                          Browse… <input type="file" id="imgInp" name="foto_karyawan">
                        </span>
                      </span>
                      <input type="text" class="form-control" value="<?php echo $karyawan['foto_karyawan']; ?>" readonly>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <div class="row">
                  <div class="col-xs-1">
                    <button class="btn btn-success fa fa-pencil" title="Simpan" data-content="Popover body content is set in this attribute."> Ubah</button>
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