<?php error_reporting(0); ?>

<section class="content">

  <h5>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url("admin/home"); ?>"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Data Master</li>
      <li class="active">Barang</li>
      <li class="active"><a href="<?php echo base_url("admin/data_master/barang/data_barang/barang"); ?>" style="color: #777;" onclick="return confirm('Anda punya perubahan yang belum diubah; Anda yakin hendak meninggalkan halaman ini?')">Data Barang</a></li>
      <li class="active">Ubah</li>
    </ol>
  </h5>

  <div class="row">

    <div class="col-xs-1"></div>

    <div class="col-xs-10">

      <!-- /.box-header -->
      <div class="box box-warning">
        <div class="box-header with-border">
          <h3 class="box-title fa fa-pencil"> Form Ubah Data Barang</h3>
          <button type="button" class="close" data-dismiss="modal" onclick="history.back(-1)" title="kembali" data-content="Popover body content is set in this attribute.">&times;</button>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <form role="form" method="POST" enctype="multipart/form-data">
            <!-- text input -->
            <div class="col-md-12">
              <!-- <?php //if ($error): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
              <?php //endif ?> -->
              <div class="form-group">
                <div class="row">
                  <div class="col-xs-12">
                    <label>Kode Barang</label>
                    <input type="text" class="form-control" name="kode_barang" value="<?php echo $barang['kode_barang']; ?>" readonly>  
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-xs-12">
                    <label>Jenis Barang</label>
                    <select class="form-control js-example-basic-single" name="id_jenis" onchange="submit()">
                      <option>----- Pilih -----</option>
                      <?php foreach ($jenis as $key => $value): ?>
                        <option value="<?php echo $value['id_jenis']; ?>" <?php if($barang['id_jenis']==$value['id_jenis']){echo "selected";} ?>><?php echo $value['jenis']; ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-xs-12">
                    <label>Sub Jenis Barang</label>
                    <select class="form-control js-example-basic-single" name="id_sub_jenis">
                      <option>----- Pilih -----</option>
                      <?php foreach ($ambil as $key => $value): ?>
                        <option value="<?php echo $value['id_sub_jenis']; ?>" <?php if($barang['id_sub_jenis']==$value['id_sub_jenis']){echo "selected";} ?>><?php echo $value['sub_jenis']; ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-xs-12">
                    <label>Nama Barang</label>
                    <input type="text" class="form-control" name="nama_barang" value="<?php echo $barang['nama_barang']; ?>">  
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-xs-12">
                    <label>Warna Barang</label>
                    <input type="text" class="form-control" name="warna" value="<?php echo $barang['warna']; ?>">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-xs-12">
                    <label>Stok</label>
                    <input type="number" class="form-control" step="any" name="stok" value="<?php echo number_format($barang['stok'], 2); ?>">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-xs-12">
                    <label>Satuan Barang</label>
                    <select class="form-control js-example-basic-single" name="id_satuan">
                      <?php foreach ($satuan as $key => $value): ?>
                        <option value="<?php echo $value['id_satuan']; ?>" <?php if($barang['id_satuan']==$value['id_satuan']){echo "selected";} ?>><?php echo $value['satuan']; ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <div class="row">
                  <div class="col-xs-12">
                    <label>Foto Barang</label>
                  </div>
                  <div class="col-xs-5"></div>
                  <div class="col-xs-2">
                    <br>
                    <center>
                      <?php if (!empty($barang['foto_barang'])): ?>
                      <img class="profile-user-img img-thumbnail" width="50" height="100" src="<?php echo base_url("assets/images/foto_barang/".$barang['foto_barang']); ?>"  alt="Foto Barang" id="img-upload">
                    <?php elseif (empty($barang['foto_barang'])): ?>
                      <img class="profile-user-img img-thumbnail" width="50" height="100" src="<?php echo base_url("assets/images/foto_barang/no-image.png"); ?>" class="profile-user-img img-thumbnail" alt="Foto Barang" id="img-upload">
                    <?php endif ?>
                    </center>
                  </div>
                  <div class="col-xs-5"></div>
                  <div class="col-xs-12">
                    <br>
                    <div class="input-group">
                      <span class="input-group-btn">
                        <span class="btn btn-default btn-file">
                          Browse… <input type="file" id="imgInp" name="foto_barang">
                        </span>
                      </span>
                      <input type="text" class="form-control" value="<?php echo $barang['foto_barang']; ?>" readonly>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <div class="row">
                  <div class="col-xs-12">
                    <label>Keterangan</label>
                    <textarea class="ckeditor" id="ckeditor" name="keterangan_barang" rows="2"><?php echo $barang['keterangan_barang']; ?></textarea>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <div class="row">
                  <div class="col-xs-1">
                    <button class="btn btn-success fa fa-pencil" name="ubah" value="ubah" title="Ubah" data-content="Popover body content is set in this attribute."> Ubah</button>
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