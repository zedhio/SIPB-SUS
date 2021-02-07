<section class="content">

  <h5>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url("user/home"); ?>"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Transaksi</li>
      <li class="active"><a href="<?php echo base_url("user/reject_barang_produksi/reject_barang_produksi"); ?>" style="color: #777;" onclick="return confirm('Anda punya perubahan yang belum disimpan; Anda yakin hendak meninggalkan halaman ini?')">Data Reject Barang Produksi</a></li>
      <li class="active">Ubah</li>
    </ol>
  </h5>

  <div class="row">

    <div class="col-xs-1"></div>

    <div class="col-xs-10">

      <!-- /.box-header -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title fa fa-pencil"> Form Ubah Data Reject Barang Produksi</h3>
          <button type="button" class="close" data-dismiss="modal" onclick="history.back(-1)" title="kembali" data-content="Popover body content is set in this attribute.">&times;</button>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <form role="form" method="POST">
            <!-- text input -->
            <div class="col-md-12">
              <div class="form-group">
                <div class="row">
                  <div class="box-body">
                    <div class="col-xs-12">
                      <label>No.Reject Barang Produksi</label>
                      <input type="text" class="form-control" name="no_reject" value="<?php echo $ambil_reject['no_reject_barang_produksi']; ?>" readonly="readonly">
                    </div>
                    <div class="col-xs-12" style="padding-top: 15px;">
                      <label>Tanggal Reject</label>
                      <input type="text" class="form-control" name="tgl_reject" value="<?php echo $ambil_reject['tgl_reject']; ?>" readonly="readonly">
                    </div>
                    <div class="col-xs-12" style="padding-top: 15px;">
                      <label>Untuk P.O</label>
                      <select class="form-control js-example-basic-single" required="" name="id_po" onchange="submit()">
                        <option value="">------ Pilih -----</option>
                        <?php foreach ($po as $key => $value): ?>
                          <?php if (!empty($value['konfirmasi'])): ?>
                            <option value="<?php echo $value['id_po']; ?>" <?php if($ambil_reject['id_po']==$value['id_po']){echo "selected";} ?>><?php echo $value['nama_po']; ?></option>
                          <?php endif ?>
                        <?php endforeach ?>
                      </select>
                    </div>
                    <div class="col-xs-12" style="padding-top: 15px;">
                      <label>Buyer</label>
                      <input type="text" class="form-control" value="<?php echo $ambil_po['nama_buyer']; ?>" readonly="readonly">
                    </div>
                    <div class="col-xs-12" style="padding-top: 15px;">
                      <label>Style Glove</label>
                      <input type="text" class="form-control" value="<?php echo $ambil_po['nama_style']; ?>" readonly="readonly">
                    </div>
                    <div class="col-xs-12" style="padding-top: 15px;">
                      <label>Qty</label>
                      <input type="text" class="form-control" value="<?php echo $ambil_po['qty']; ?>" readonly="readonly">
                    </div>

                    <div class="col-xs-12">
                      <h3 class="box-title" style="font-size: 16px;"> Input Data</h3>
                    </div>

                    <div class="box-body">
                      <div class="col-xs-3">
                        <label>Nama Barang</label>
                        <select class="form-control js-example-basic-single" name="nama_barang">
                          <option value="Kosong">- Pilih -</option>
                          <?php foreach ($barang as $key => $value): ?>
                            <option value="<?php echo $value['nama_barang']; ?>"<?php if($ambil_reject['nama_barang']==$value['nama_barang']){echo "selected";} ?>><?php echo $value['nama_barang']; ?></option>
                          <?php endforeach ?>
                        </select>
                      </div>
                      <div class="col-xs-2">
                        <label>Qty Reject</label>
                        <input type="number" class="form-control" name="qty_reject" value="<?php echo $ambil_reject['qty_reject']; ?>">
                      </div>
                      <div class="col-xs-12">
                        <br>
                        <label>Alasan Reject</label>  
                        <textarea class="ckeditor" id="ckeditor" name="alasan_reject" row="5"><?php echo $ambil_reject['alasan_reject']; ?></textarea>
                      </div>
                      <div class="col-xs-12">
                        <br>
                        <button class="btn btn-success fa fa-pencil" name="ubah" value="ubah" title="Ubah Data" data-content="Popover body content is set in this attribute."> Ubah Data</button>
                      </div>
                    </div>

                  </div>
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