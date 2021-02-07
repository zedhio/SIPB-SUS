<section class="content">

  <h5>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url("admin/home"); ?>"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Data Master</li>
      <li class="active"><a href="<?php echo base_url("admin/data_master/buyer/buyer"); ?>" style="color: #777;" onclick="return confirm('Anda punya perubahan yang belum disimpan; Anda yakin hendak meninggalkan halaman ini?')">Data Buyer</a></li>
      <li class="active">Tambah</li>
    </ol>
  </h5>

  <div class="row">

    <div class="col-xs-1"></div>

    <div class="col-xs-10">

      <!-- /.box-header -->
      <div class="box box-warning">
        <div class="box-header with-border">
          <h3 class="box-title fa fa-plus"> Form Tambah Data Buyer</h3>
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
                    <label>Kode Buyer</label>
                    <input type="text" class="form-control" name="kode_buyer" value="<?php echo $kode_otomatis; ?>" readonly>  
                  </div>
                </div>
              </div>  
              <div class="form-group">
                <div class="row">
                  <div class="col-xs-12">
                    <label>Nama Buyer</label>
                    <input type="text" class="form-control" name="nama_buyer" placeholder="Contoh: PT. Sinar Utama Sejahtera (Logo)">
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
                    <label>No.Telepon</label>
                    <input type="text" class="form-control" name="no_telp" placeholder="Contoh: 0274-4398374">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-xs-12">
                    <label>No.Faximile</label>
                    <input type="text" class="form-control" name="no_fax" placeholder="Contoh: 0274-4398374">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-xs-12">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Contoh: kothis.jogja@gmail.com">
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
                    <img class="profile-user-img img-thumbnail" width="50" height="100" src="<?php echo base_url("assets/images/logo_buyer/no-image.png"); ?>" class="profile-user-img img-thumbnail" alt="Logo Buyer" id="img-upload">
                    </center>
                  </div>
                  <div class="col-xs-5"></div>
                  <div class="col-xs-12">
                    <br>
                    <div class="input-group">
                      <span class="input-group-btn">
                        <span class="btn btn-default btn-file">
                          Browse… <input type="file" id="imgInp" name="logo_buyer">
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