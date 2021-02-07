<form class="form-horizontal" enctype="multipart/form-data" method="post">
  <section class="content">

    <h5>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url("admin/home"); ?>"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Pengaturan</li>
        <li><a href="<?php echo base_url("admin/pengaturan/pengaturan_umum/pengaturan_umum"); ?>" style="color: #777;" onclick="return confirm('Anda punya perubahan yang belum diubah; Anda yakin hendak meninggalkan halaman ini?')"> Pengaturan Umum</a></li>
      </ol>
    </h5>

    <div class="row">

      <div class="col-md-9">
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#pengaturan_umum" data-toggle="tab" aria-expanded="true">Umum</a></li>
            <li><a href="#tampilan" data-toggle="tab" aria-expanded="false">Tampilan</a></li>
            <li class="pull-right" style="padding-top: 7px;padding-right: 5px;"><button type="submit" class="btn  fa fa-save"> Apply</button></li>
          </ul>

          <div class="tab-content">

            <div class="tab-pane active" id="pengaturan_umum">

              <!-- Post -->
              <div class="form-group">
                <label for="inputName" class="col-sm-2 control-label" style="text-align: left; padding-left: 22px;">Nama SIPB</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="nama_sipb" id="inputName" value="<?php echo $pengaturan['nama_sipb']; ?>">
                </div>
              </div>
              <div class="form-group">
                <label for="inputName" class="col-sm-2 control-label" style="text-align: left; padding-left: 22px;">Slogan SIPB</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="slogan_sipb" id="inputName" value="<?php echo $pengaturan['slogan_sipb']; ?>">
                </div>
              </div>
              <div class="form-group">
                <label for="inputName" class="col-sm-2 control-label" style="text-align: left; padding-left: 22px;">Deskripsi</label>
                <div class="col-sm-10">
                  <textarea class="ckeditor" id="ckeditor" name="deskripsi"><?php echo $pengaturan['deskripsi']; ?></textarea>
                </div>
              </div>
              <div class="form-group">
                <label for="inputName" class="col-sm-2 control-label" style="text-align: left; padding-left: 22px;">Lokasi Gudang</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="lokasi_gudang" id="inputName" value="<?php echo $pengaturan['lokasi_gudang']; ?>">
                </div>
              </div>
              <div class="form-group">
                <label for="inputName" class="col-sm-2 control-label" style="text-align: left; padding-left: 22px;">No.Telp</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="no_telp" id="inputName" value="<?php echo $pengaturan['no_telp']; ?>">
                </div>
              </div>
              <div class="form-group">
                <label for="inputName" class="col-sm-2 control-label" style="text-align: left; padding-left: 22px;">No.Fax</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="no_fax" id="inputName" value="<?php echo $pengaturan['no_fax']; ?>">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail" class="col-sm-2 control-label" style="text-align: left; padding-left: 22px;">Email</label>
                <div class="col-sm-10">
                  <input type="email" class="form-control" name="email" id="inputEmail" value="<?php echo $pengaturan['email']; ?>">
                </div>
              </div>
              <div class="form-group">
                <label for="inputName" class="col-sm-2 control-label" style="text-align: left; padding-left: 22px;">Website</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="Website" id="inputName" value="<?php echo $pengaturan['website']; ?>">
                </div>
              </div>
              <hr class="dashed" />
              <!-- /.post -->
              
            </div>
            <!-- /.tab-pane -->

            <div class="tab-pane" id="tampilan">

              <!-- Post -->
              <div class="form-group">
                <label for="inputName" class="col-sm-2 control-label" style="text-align: left; padding-left: 22px;">Logo SIPB</label>
              </div>
              <div class="form-group">
                <label for="inputName" class="col-sm-1 control-label"></label>
                <div class="col-sm-10">
                  Current Logo : <img src="<?php echo base_url("assets/images/logo/".$pengaturan['logo']); ?>" style="width:100px; height: 50px;" id="img-upload">
                </div>
              </div>
              <div class="form-group">
                <label for="inputName" class="col-sm-1 control-label"></label>
                <div class="col-sm-10">
                  <!-- <input type="file" class="form-control" name="logo"> -->
                  <div class="input-group">
                    <span class="input-group-btn">
                      <span class="btn btn-default btn-file">
                        Browse… <input type="file" id="imgInp" name="logo">
                      </span>
                    </span>
                    <input type="text" class="form-control" readonly>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="inputName" class="col-sm-1 control-label">Favicon</label>
              </div>
              <div class="form-group">
                <label for="inputName" class="col-sm-1 control-label"></label>
                <div class="col-sm-10">
                  Current Logo : <img src="<?php echo base_url("assets/images/logo/".$pengaturan['logo']); ?>" style="width:100px; height: 50px;" id="img-upload">
                </div>
              </div>
              <div class="form-group">
                <label for="inputName" class="col-sm-1 control-label"></label>
                <div class="col-sm-10">
                  <!-- <input type="file" class="form-control" name="logo"> -->
                  <div class="input-group">
                    <span class="input-group-btn">
                      <span class="btn btn-default btn-file">
                        Browse… <input type="file" id="imgInp" name="logo">
                      </span>
                    </span>
                    <input type="text" class="form-control" readonly>
                  </div>
                </div>
              </div>

              <!-- /.post -->
            </div>
            <!-- /.tab-pane -->

          </div>
          <!-- /.tab-content -->

        </div>
        <!-- /.nav-tabs-custom -->
      </div>
      <!-- /.col -->

      <div class="col-md-3">

        <!-- Profile Image -->
        <div class="box box-primary">
          <div class="box-body box-profile">
            Time
            <center>
              <h3 style="font-size: 40px; font-family: verdana;" id="jam"></h3>
            </center>
            <p class="text-muted text-center">&#9925; Hari yang cerah</p>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->

        <!-- About Me Box -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Tentang Aplikasi</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <strong><i class="fa fa-book margin-r-5"></i> Aplikasi ini dibuat oleh:</strong>
            <p class="text-muted" style="padding-left: 19px">Zedhio Pratama Zulzaq</p>
            <hr>
            <strong><i class="fa fa-map-marker margin-r-5"></i> Ditujukan untuk:</strong>
            <p class="text-muted" style="padding-left: 19px">PT Sinar Utama Sejahtera</p>
            <hr>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->

      </div>
      <!-- /.col -->

    </div>
    <!-- /.row -->
  </section>
</form>