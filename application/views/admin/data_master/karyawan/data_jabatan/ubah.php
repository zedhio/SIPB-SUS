<section class="content">

  <h5>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url("admin/home"); ?>"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Data Master</li>
      <li class="active">Karyawan</li>
      <li class="active"><a href="<?php echo base_url("admin/data_master/karyawan/data_jabatan/jabatan"); ?>" style="color: #777;" onclick="return confirm('Anda punya perubahan yang belum diubah; Anda yakin hendak meninggalkan halaman ini?')">Data Jabatan</a></li>
      <li class="active">Ubah</li>
    </ol>
  </h5>

  <div class="row">
    
    <div class="col-xs-2"></div>

    <div class="col-xs-8">

      <!-- /.box-header -->
      <div class="box box-warning">
        <div class="box-header with-border">
          <h3 class="box-title fa fa-pencil"> Form Ubah Data Jabatan</h3>
          <button type="button" class="close" data-dismiss="modal" onclick="history.back(-1)" title="kembali" data-content="Popover body content is set in this attribute.">&times;</button>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <form role="form" method="POST">
            <!-- text input -->
            <div class="col-md-12">
              <?php if ($error): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
              <?php endif ?>
              <div class="form-group">
                <div class="row">
                  <div class="col-xs-12">
                    <label>Nama Jabatan</label>
                    <input type="text" class="form-control" name="jabatan" value="<?php echo $jabatan['jabatan']; ?>">  
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-xs-12">
                    <label>Keterangan</label>
                    <textarea class="ckeditor" id="ckeditor" name="keterangan" rows="2"><?php echo $jabatan['keterangan']; ?></textarea>
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
    </div>

    <div class="col-xs-2"></div>

  </div>
</section>