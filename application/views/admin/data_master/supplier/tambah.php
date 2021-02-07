<section class="content">

  <h5>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url("admin/home"); ?>"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Data Master</li>
      <li class="active"><a href="<?php echo base_url("admin/data_master/supplier/supplier"); ?>" style="color: #777;" onclick="return confirm('Anda punya perubahan yang belum disimpan; Anda yakin hendak meninggalkan halaman ini?')">Supplier</a></li>
      <li class="active">Tambah</li>
    </ol>
  </h5>

  <div class="row">

    <div class="col-xs-1"></div>

    <div class="col-xs-10">

      <!-- /.box-header -->
      <div class="box box-warning">
        <div class="box-header with-border">
          <h3 class="box-title fa fa-plus"> Form Tambah Supplier</h3>
          <button type="button" class="close" data-dismiss="modal" onclick="history.back(-1)" title="kembali" data-content="Popover body content is set in this attribute.">&times;</button>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <form role="form" method="POST" enctype="multipart/form-data">
            <!-- text input -->
            <div class="col-md-12">
              <?php if ($error): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
                <!-- <meta http-equiv="refresh" content="2;url=<?php // echo base_url("admin/data_master/perusahaan/perusahaan/ubah"); ?>"> -->
              <?php endif ?>
              <div class="form-group">
                <div class="row">
                  <div class="col-xs-12">
                    <label>Kode Supplier</label>
                    <input type="text" class="form-control" name="kode_supplier" value="<?php echo $kode_otomatis; ?>" readonly>  
                  </div>
                </div>
              </div>  
              <div class="form-group">
                <div class="row">
                  <div class="col-xs-12">
                    <label>Nama Supplier</label>
                    <input type="text" class="form-control" name="nama_supplier" placeholder="Contoh: Abadi Steel">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-xs-12">
                    <label>No.Telepon</label>
                    <input type="text" class="form-control" name="no_telp" placeholder="Contoh: (0274) 6643555">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-xs-12">
                    <label>Kontak Person</label>
                    <input type="text" class="form-control" name="kontak_person" placeholder="Contoh: Bapak Taufik">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-xs-12">
                    <label>No.HP</label>
                    <input type="text" class="form-control" name="no_hp" placeholder="Contoh: 081392133039">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-xs-12">
                    <label>Alamat</label>
                    <textarea class="ckeditor" id="ckeditor" name="alamat" rows="1"></textarea>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-xs-12">
                    <label>Logo</label>
                  </div>
                  <div class="col-xs-5"></div>
                  <div class="col-xs-2">
                    <br>
                    <center>
                      <img class="profile-user-img img-thumbnail" width="50" height="100" src="<?php echo base_url("assets/images/logo_supplier/no-image.png"); ?>" class="profile-user-img img-thumbnail" alt="Logo Supplier" id="img-upload">
                    </center>
                  </div>
                  <div class="col-xs-5"></div>
                  <div class="col-xs-12">
                    <br>
                    <div class="input-group">
                      <span class="input-group-btn">
                        <span class="btn btn-default btn-file">
                          Browse… <input type="file" id="imgInp" name="logo_supplier">
                        </span>
                      </span>
                      <input type="text" class="form-control" readonly>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <div class="row">
                  <div class="col-xs-1">
                    <button class="btn btn-primary fa fa-save" title="Simpan" data-content="Popover body content is set in this attribute."> Simpan</button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="col-xs-1"></div>
  </div>

</section>