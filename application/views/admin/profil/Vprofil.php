<h5>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url("admin/home"); ?>"><i class="fa fa-home"></i> Home</a></li>
    <li class="active">Profil</li>
    <li class="active">Pengaturan Profil</li>
  </ol>
</h5>

<form class="form-horizontal" enctype="multipart/form-data" method="post">
  <section class="content">
    <div class="row">

      <div class="col-md-1"></div>

      <div class="col-md-2">

        <!-- Profile Image -->
        <div class="box box-primary">
          <div class="box-body box-profile">
            <center>
              <img class="profile-user-img img-thumbnail" width="100" height="100" src="<?php echo base_url("assets/images/foto_admin/".$admin['foto']); ?>"  alt="Foto Profil" id="img-upload">
            </center>
            <p class="text-muted text-center" style="margin-top: 10px;"><?php echo $admin['nama_admin']; ?></p>
            <p class="text-center" style="margin-top: 10px;">Anda seorang Administrator</p>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->

      <div class="col-md-8">
        <div class="nav-tabs-custom">
          <div class="tab-content">     
            <div class="box-header">
              <h3 class="box-title fa fa-user"> <b>Pengaturan Profil</b></h3>
            </div>
            <div class="tab-pane active" id="activity">
              <div class="tab-pane" id="settings">
                <hr>
                <div class="form-group">
                  <label for="inputName" class="col-sm-2 control-label" style="text-align: left; padding-left: 24px;">NIK</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="nik" id="inputName" value="<?php echo $admin['nik']; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputName" class="col-sm-2 control-label" style="text-align: left; padding-left: 24px;">Password</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="password" id="inputName" placeholder="Jika password tidak diubah, kosongkan inputan password." value="">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail" class="col-sm-2 control-label" style="text-align: left; padding-left: 24px;">Nama Admin</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="nama_admin" id="inputEmail" value="<?php echo $admin['nama_admin']; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail" class="col-sm-2 control-label" style="text-align: left; padding-left: 24px;">Bagian</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="bagian" id="inputEmail" value="<?php echo $admin['bagian']; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail" class="col-sm-2 control-label" style="text-align: left; padding-left: 24px;">Jabatan</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="jabatan" id="inputEmail" value="<?php echo $admin['jabatan']; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail" class="col-sm-2 control-label" style="text-align: left; padding-left: 24px;">Tempat Lahir</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="tmp_lhr" id="inputEmail" value="<?php echo $admin['tmp_lhr']; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail" class="col-sm-2 control-label" style="text-align: left; padding-left: 24px;">Tanggal Lahir</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="tgl_lhr" id="datepicker" value="<?php echo date('Y-m-d', strtotime($admin['tgl_lhr'])); ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail" class="col-sm-2 control-label" style="text-align: left; padding-left: 24px;">Alamat</label>

                  <div class="col-sm-10">
                    <textarea class="ckeditor" name="alamat" id="ckeditor" rows="1"><?php echo $admin['alamat']; ?></textarea>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputName" class="col-sm-2 control-label" style="text-align: left; padding-left: 24px;">Foto</label>

                  <div class="col-sm-10">
                    <div class="input-group">
                      <span class="input-group-btn">
                        <span class="btn btn-default btn-file">
                          Browse… <input type="file" id="imgInp" name="foto">
                        </span>
                      </span>
                      <input type="text" class="form-control" readonly>
                    </div>
                    <!-- <input type="file" class="form-control" name="foto" id="imgInp" placeholder="Name"> -->
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-danger fa fa-print"> Save Change</button>
                  </div>
                </div>
              </form>
            </div>
            <!-- /.tab-pane -->
          </div>
          <!-- /.tab-content -->
        </div>
        <!-- /.nav-tabs-custom -->
      </div>
      <!-- /.col -->

      <div class="col-md-1"></div>

    </div>
    <!-- /.row -->
  </section>